CREATE DATABASE perpustakaan_lengkap;
USE perpustakaan_lengkap;

-- =========================================
-- 1. TABEL KATEGORI BUKU
-- =========================================

CREATE TABLE kategori_buku (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(50) NOT NULL UNIQUE,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- 2. TABEL PENERBIT
-- =========================================

CREATE TABLE penerbit (
    id_penerbit INT AUTO_INCREMENT PRIMARY KEY,
    nama_penerbit VARCHAR(100) NOT NULL,
    alamat TEXT,
    telepon VARCHAR(15),
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- =========================================
-- 3. TABEL BUKU
-- =========================================

CREATE TABLE buku (
    id_buku INT AUTO_INCREMENT PRIMARY KEY,
    kode_buku VARCHAR(20) NOT NULL UNIQUE,
    judul VARCHAR(200) NOT NULL,
    id_kategori INT NOT NULL,
    pengarang VARCHAR(100) NOT NULL,
    id_penerbit INT NOT NULL,
    tahun_terbit YEAR NOT NULL,
    isbn VARCHAR(20) UNIQUE,
    harga DECIMAL(10,2) NOT NULL,
    stok INT DEFAULT 0,
    deskripsi TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    FOREIGN KEY (id_kategori) REFERENCES kategori_buku(id_kategori),
    FOREIGN KEY (id_penerbit) REFERENCES penerbit(id_penerbit)
);

-- =========================================
-- 4. INSERT DATA KATEGORI
-- =========================================

INSERT INTO kategori_buku (nama_kategori, deskripsi) VALUES
('Programming', 'Buku tentang pemrograman'),
('Database', 'Buku tentang basis data'),
('Web Design', 'Buku tentang desain web'),
('Networking', 'Buku tentang jaringan komputer'),
('Cyber Security', 'Buku tentang keamanan sistem');

-- =========================================
-- 5. INSERT DATA PENERBIT
-- =========================================

INSERT INTO penerbit (nama_penerbit, alamat, telepon, email) VALUES
('Gramedia', 'Jakarta', '0811111111', 'gramedia@email.com'),
('Andi Offset', 'Yogyakarta', '0822222222', 'andi@email.com'),
('Elex Media', 'Jakarta', '0833333333', 'elex@email.com'),
('Informatika', 'Bandung', '0844444444', 'informatika@email.com'),
('Deepublish', 'Yogyakarta', '0855555555', 'deepublish@email.com');

-- =========================================
-- 6. INSERT DATA BUKU (15 DATA)
-- =========================================

INSERT INTO buku
(kode_buku, judul, id_kategori, pengarang, id_penerbit, tahun_terbit, isbn, harga, stok, deskripsi)
VALUES
('BK-001', 'Pemrograman PHP untuk Pemula', 1, 'Budi Raharjo', 4, 2023, '978-111', 75000, 10, 'Belajar PHP dasar'),
('BK-002', 'Mastering MySQL Database', 2, 'Andi Nugroho', 1, 2022, '978-112', 95000, 5, 'Panduan MySQL'),
('BK-003', 'Laravel Framework Advanced', 1, 'Siti Aminah', 2, 2024, '978-113', 125000, 8, 'Framework Laravel'),
('BK-004', 'Web Design Principles', 3, 'Dedi Santoso', 2, 2023, '978-114', 85000, 15, 'Desain web modern'),
('BK-005', 'Network Security Basics', 4, 'Rina Putri', 5, 2022, '978-115', 110000, 6, 'Keamanan jaringan'),
('BK-006', 'Cyber Security Fundamental', 5, 'Rudi Hartono', 3, 2024, '978-116', 135000, 4, 'Dasar keamanan cyber'),
('BK-007', 'HTML CSS Lengkap', 3, 'Salsa', 1, 2021, '978-117', 65000, 12, 'Frontend dasar'),
('BK-008', 'Cisco Networking', 4, 'Joko', 4, 2023, '978-118', 145000, 7, 'Jaringan Cisco'),
('BK-009', 'Python untuk Data Science', 1, 'Rahmat', 3, 2024, '978-119', 150000, 9, 'Python modern'),
('BK-010', 'Database Design Expert', 2, 'Farhan', 2, 2020, '978-120', 99000, 5, 'Desain database'),
('BK-011', 'Java Programming', 1, 'Ahmad', 4, 2023, '978-121', 130000, 6, 'Java dasar'),
('BK-012', 'UI UX Modern', 3, 'Nadia', 5, 2024, '978-122', 89000, 10, 'UI UX design'),
('BK-013', 'Linux Server Admin', 4, 'Bagus', 1, 2021, '978-123', 119000, 3, 'Server linux'),
('BK-014', 'Etical Hacking', 5, 'Yusuf', 3, 2022, '978-124', 155000, 5, 'Penetration testing'),
('BK-015', 'PostgreSQL Advanced', 2, 'Putri', 2, 2024, '978-125', 140000, 7, 'Database PostgreSQL');

-- =========================================
-- 7. QUERY JOIN
-- =========================================

-- Menampilkan buku + kategori + penerbit
SELECT
    b.judul,
    k.nama_kategori,
    p.nama_penerbit,
    b.pengarang,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit p ON b.id_penerbit = p.id_penerbit;

-- Jumlah buku per kategori
SELECT
    k.nama_kategori,
    COUNT(b.id_buku) AS jumlah_buku
FROM kategori_buku k
JOIN buku b ON b.id_kategori = k.id_kategori
GROUP BY k.nama_kategori;

-- Jumlah buku per penerbit
SELECT
    p.nama_penerbit,
    COUNT(b.id_buku) AS jumlah_buku
FROM penerbit p
JOIN buku b ON b.id_penerbit = p.id_penerbit
GROUP BY p.nama_penerbit;

-- Detail lengkap buku
SELECT
    b.kode_buku,
    b.judul,
    k.nama_kategori,
    p.nama_penerbit,
    b.pengarang,
    b.tahun_terbit,
    b.isbn,
    b.harga,
    b.stok
FROM buku b
JOIN kategori_buku k ON b.id_kategori = k.id_kategori
JOIN penerbit p ON b.id_penerbit = p.id_penerbit;

-- rak--
CREATE TABLE rak (
    id_rak INT AUTO_INCREMENT PRIMARY KEY,
    kode_rak VARCHAR(20) NOT NULL UNIQUE,
    nama_rak VARCHAR(100) NOT NULL,
    lokasi VARCHAR(100),
    keterangan TEXT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

INSERT INTO rak (kode_rak, nama_rak, lokasi, keterangan) VALUES
('RK-001', 'Rak Programming', 'Lantai 1', 'Khusus buku pemrograman'),
('RK-002', 'Rak Database', 'Lantai 1', 'Khusus buku database'),
('RK-003', 'Rak Web Design', 'Lantai 2', 'Khusus desain web'),
('RK-004', 'Rak Networking', 'Lantai 2', 'Khusus jaringan komputer'),
('RK-005', 'Rak Security', 'Lantai 3', 'Khusus keamanan sistem');



