<?php
session_start();
$buku_list = [
['kode'=>'BK001','judul'=>'Algoritma Dasar','kategori'=>'Teknologi','pengarang'=>'Andi Saputra','penerbit'=>'Informatika','tahun'=>2020,'harga'=>75000,'stok'=>5],
['kode'=>'BK002','judul'=>'Pemrograman PHP','kategori'=>'Teknologi','pengarang'=>'Budi Hartono','penerbit'=>'Elex','tahun'=>2021,'harga'=>90000,'stok'=>0],
['kode'=>'BK003','judul'=>'Basis Data Modern','kategori'=>'Teknologi','pengarang'=>'Citra Dewi','penerbit'=>'Andi','tahun'=>2019,'harga'=>85000,'stok'=>3],
['kode'=>'BK004','judul'=>'Matematika Diskrit','kategori'=>'Pendidikan','pengarang'=>'Deni Kurniawan','penerbit'=>'Deepublish','tahun'=>2018,'harga'=>70000,'stok'=>7],
['kode'=>'BK005','judul'=>'Statistika Terapan','kategori'=>'Pendidikan','pengarang'=>'Eka Lestari','penerbit'=>'Graha Ilmu','tahun'=>2022,'harga'=>95000,'stok'=>2],
['kode'=>'BK006','judul'=>'Manajemen Bisnis','kategori'=>'Ekonomi','pengarang'=>'Fajar Nugroho','penerbit'=>'Salemba','tahun'=>2017,'harga'=>80000,'stok'=>0],
['kode'=>'BK007','judul'=>'Akuntansi Dasar','kategori'=>'Ekonomi','pengarang'=>'Gina Putri','penerbit'=>'Salemba','tahun'=>2023,'harga'=>99000,'stok'=>8],
['kode'=>'BK008','judul'=>'Desain UI UX','kategori'=>'Desain','pengarang'=>'Hana Pratiwi','penerbit'=>'Informatika','tahun'=>2024,'harga'=>110000,'stok'=>4],
['kode'=>'BK009','judul'=>'Jaringan Komputer','kategori'=>'Teknologi','pengarang'=>'Indra Maulana','penerbit'=>'Elex','tahun'=>2016,'harga'=>88000,'stok'=>1],
['kode'=>'BK010','judul'=>'Bahasa Inggris Akademik','kategori'=>'Bahasa','pengarang'=>'Joko Wibowo','penerbit'=>'Erlangga','tahun'=>2015,'harga'=>65000,'stok'=>6],
['kode'=>'BK011','judul'=>'Machine Learning Pemula','kategori'=>'Teknologi','pengarang'=>'Kiki Amelia','penerbit'=>'Andi','tahun'=>2025,'harga'=>125000,'stok'=>9],
];
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
$keyword=$_GET['keyword']??''; $kategori=$_GET['kategori']??''; $min_harga=$_GET['min_harga']??''; $max_harga=$_GET['max_harga']??''; $tahun=$_GET['tahun']??''; $status=$_GET['status']??'semua'; $sort=$_GET['sort']??'judul'; $page=max(1,(int)($_GET['page']??1));
$errors=[]; $now=(int)date('Y');
if($min_harga!=='' && $max_harga!=='' && $min_harga>$max_harga){$errors[]='Harga minimum tidak boleh lebih besar dari harga maksimum';}
if($tahun!=='' && ($tahun<1900 || $tahun>$now)){$errors[]='Tahun harus antara 1900 - '.$now;}
$hasil=$buku_list;
if(!$errors){
$hasil=array_filter($hasil,function($b) use($keyword,$kategori,$min_harga,$max_harga,$tahun,$status){
 if($keyword!==''){
  $k=strtolower($keyword);
  if(strpos(strtolower($b['judul']),$k)===false && strpos(strtolower($b['pengarang']),$k)===false) return false;
 }
 if($kategori!=='' && $b['kategori']!==$kategori) return false;
 if($min_harga!=='' && $b['harga']<$min_harga) return false;
 if($max_harga!=='' && $b['harga']>$max_harga) return false;
 if($tahun!=='' && $b['tahun']!=$tahun) return false;
 if($status==='tersedia' && $b['stok']<=0) return false;
 if($status==='habis' && $b['stok']>0) return false;
 return true;});
 usort($hasil,function($a,$b) use($sort){return $a[$sort]<=>$b[$sort];});
 $hasil=array_values($hasil);
 $_SESSION['recent_searches'][] = ['waktu'=>date('d/m H:i'),'keyword'=>$keyword,'kategori'=>$kategori];
 $_SESSION['recent_searches']=array_slice(array_reverse($_SESSION['recent_searches']),0,5);
}
if(isset($_GET['export']) && !$errors){header('Content-Type:text/csv');header('Content-Disposition: attachment; filename="hasil_buku.csv"');$out=fopen('php://output','w');fputcsv($out,['Kode','Judul','Kategori','Pengarang','Penerbit','Tahun','Harga','Stok']);foreach($hasil as $r){fputcsv($out,$r);}exit;}
$perPage=10; $total=count($hasil); $pages=max(1,ceil($total/$perPage)); $page=min($page,$pages); $offset=($page-1)*$perPage; $rows=array_slice($hasil,$offset,$perPage);
function highlight($text,$key){if($key==='') return e($text); return preg_replace('/('.preg_quote($key,'/').')/i','<mark>$1</mark>',e($text));}
$kategori_ops=array_unique(array_column($buku_list,'kategori')); sort($kategori_ops);
?>
<!DOCTYPE html><html lang='id'><head><meta charset='UTF-8'><meta name='viewport' content='width=device-width, initial-scale=1'><title>Pencarian Buku</title><link href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css' rel='stylesheet'></head><body class='bg-light'><div class='container py-4'>
<div class='card shadow'><div class='card-header bg-primary text-white'><h3 class='mb-0'>Sistem Pencarian Buku Lanjutan</h3></div><div class='card-body'>
<?php foreach($errors as $er): ?><div class='alert alert-danger'><?= e($er) ?></div><?php endforeach; ?>
<form method='get' class='row g-3'>
<div class='col-md-4'><input type='text' name='keyword' class='form-control' placeholder='Keyword judul/pengarang' value='<?=e($keyword)?>'></div>
<div class='col-md-2'><select name='kategori' class='form-select'><option value=''>Semua Kategori</option><?php foreach($kategori_ops as $k): ?><option value='<?=e($k)?>' <?=$kategori===$k?'selected':''?>><?=e($k)?></option><?php endforeach; ?></select></div>
<div class='col-md-2'><input type='number' name='min_harga' class='form-control' placeholder='Min Harga' value='<?=e($min_harga)?>'></div>
<div class='col-md-2'><input type='number' name='max_harga' class='form-control' placeholder='Max Harga' value='<?=e($max_harga)?>'></div>
<div class='col-md-2'><input type='number' name='tahun' class='form-control' placeholder='Tahun' value='<?=e($tahun)?>'></div>
<div class='col-md-6'>
<div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='status' value='semua' <?=$status==='semua'?'checked':''?>><label class='form-check-label'>Semua</label></div>
<div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='status' value='tersedia' <?=$status==='tersedia'?'checked':''?>><label class='form-check-label'>Tersedia</label></div>
<div class='form-check form-check-inline'><input class='form-check-input' type='radio' name='status' value='habis' <?=$status==='habis'?'checked':''?>><label class='form-check-label'>Habis</label></div></div>
<div class='col-md-3'><select name='sort' class='form-select'><option value='judul' <?=$sort==='judul'?'selected':''?>>Sort Judul</option><option value='harga' <?=$sort==='harga'?'selected':''?>>Sort Harga</option><option value='tahun' <?=$sort==='tahun'?'selected':''?>>Sort Tahun</option></select></div>
<div class='col-md-3 d-grid'><button class='btn btn-primary'>Cari</button></div>
</form>
<?php $qs=$_GET; $qs['export']=1; unset($qs['page']); ?>
<div class='mt-3 d-flex justify-content-between'><div><strong><?=$total?></strong> hasil ditemukan</div><a class='btn btn-success btn-sm' href='?<?=http_build_query($qs)?>'>Export CSV</a></div>
<div class='table-responsive mt-3'><table class='table table-bordered table-striped'><thead><tr><th>Kode</th><th>Judul</th><th>Kategori</th><th>Pengarang</th><th>Penerbit</th><th>Tahun</th><th>Harga</th><th>Stok</th></tr></thead><tbody>
<?php foreach($rows as $r): ?><tr><td><?=e($r['kode'])?></td><td><?=highlight($r['judul'],$keyword)?></td><td><?=e($r['kategori'])?></td><td><?=highlight($r['pengarang'],$keyword)?></td><td><?=e($r['penerbit'])?></td><td><?=$r['tahun']?></td><td>Rp <?=number_format($r['harga'],0,',','.')?></td><td><?=$r['stok']?></td></tr><?php endforeach; if(!$rows): ?><tr><td colspan='8' class='text-center'>Tidak ada data</td></tr><?php endif; ?>
</tbody></table></div>
<nav><ul class='pagination'><?php for($i=1;$i<=$pages;$i++): $q=$_GET; $q['page']=$i; ?><li class='page-item <?=$i==$page?'active':''?>'><a class='page-link' href='?<?=http_build_query($q)?>'><?=$i?></a></li><?php endfor; ?></ul></nav>
<?php if(!empty($_SESSION['recent_searches'])): ?><div class='mt-3'><h6>Recent Searches</h6><ul><?php foreach($_SESSION['recent_searches'] as $s): ?><li><?=e($s['waktu'].' - '.$s['keyword'].' '.$s['kategori'])?></li><?php endforeach; ?></ul></div><?php endif; ?>
</div></div></div></body></html>
