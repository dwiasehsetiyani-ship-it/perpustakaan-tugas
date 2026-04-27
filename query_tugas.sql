-- =========================================
-- TUGAS 1 : EKSPLORASI DATABASE PERPUSTAKAAN
-- File : query_tugas.sql
-- =========================================


-- =========================================
-- A. STATISTIK BUKU (5 QUERY)
-- =========================================

-- 1. Total buku seluruhnya
SELECT COUNT(*) AS total_buku
FROM buku;

-- 2. Total nilai inventaris (harga × stok)
SELECT SUM(harga * stok) AS total_nilai_inventaris
FROM buku;

-- 3. Rata-rata harga buku
SELECT AVG(harga) AS rata_rata_harga
FROM buku;

-- 4. Buku termahal (judul dan harga)
SELECT judul, harga
FROM buku
ORDER BY harga DESC
LIMIT 1;

-- 5. Buku dengan stok terbanyak
SELECT judul, stok
FROM buku
ORDER BY stok DESC
LIMIT 1;


-- =========================================
-- B. FILTER DAN PENCARIAN (5 QUERY)
-- =========================================

-- 1. Semua buku kategori Programming yang harga < 100.000
SELECT *
FROM buku
WHERE kategori = 'Programming'
AND harga < 100000;

-- 2. Buku yang judulnya mengandung kata "PHP" atau "MySQL"
SELECT *
FROM buku
WHERE judul LIKE '%PHP%'
OR judul LIKE '%MySQL%';

-- 3. Buku yang terbit tahun 2024
SELECT *
FROM buku
WHERE tahun_terbit = 2024;

-- 4. Buku yang stoknya antara 5 - 10
SELECT *
FROM buku
WHERE stok BETWEEN 5 AND 10;

-- 5. Buku yang pengarangnya "Budi Raharjo"
SELECT *
FROM buku
WHERE pengarang = 'Budi Raharjo';


-- =========================================
-- C. GROUPING DAN AGREGASI (3 QUERY)
-- =========================================

-- 1. Jumlah buku per kategori + total stok per kategori
SELECT 
    kategori,
    COUNT(*) AS jumlah_buku,
    SUM(stok) AS total_stok
FROM buku
GROUP BY kategori;

-- 2. Rata-rata harga per kategori
SELECT 
    kategori,
    AVG(harga) AS rata_rata_harga
FROM buku
GROUP BY kategori;

-- 3. Kategori dengan total nilai inventaris terbesar
SELECT 
    kategori,
    SUM(harga * stok) AS total_nilai_inventaris
FROM buku
GROUP BY kategori
ORDER BY total_nilai_inventaris DESC
LIMIT 1;


-- =========================================
-- D. UPDATE DATA (2 QUERY)
-- =========================================

-- 1. Naikkan harga semua buku kategori Programming sebesar 5%
UPDATE buku
SET harga = harga * 1.05
WHERE kategori = 'Programming';

-- 2. Tambah stok 10 untuk semua buku yang stoknya < 5
UPDATE buku
SET stok = stok + 10
WHERE stok < 5;


-- =========================================
-- E. LAPORAN KHUSUS (2 QUERY)
-- =========================================

-- 1. Daftar buku yang perlu restocking (stok < 5)
SELECT *
FROM buku
WHERE stok < 5;

-- 2. Top 5 buku termahal
SELECT judul, harga
FROM buku
ORDER BY harga DESC
LIMIT 5;