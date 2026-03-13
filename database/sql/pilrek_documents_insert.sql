-- =====================================================
-- SQL Import untuk tabel pilrek_documents
-- Import via phpMyAdmin di cPanel Rumahweb
-- =====================================================

-- Hapus data dummy lama (jika ada)
DELETE FROM `pilrek_documents`;

-- Reset auto increment
ALTER TABLE `pilrek_documents` AUTO_INCREMENT = 1;

-- Insert 7 dokumen resmi
INSERT INTO `pilrek_documents` (`title`, `description`, `file_path`, `file_name`, `file_type`, `file_size`, `category`, `download_count`, `order`, `is_active`, `created_at`, `updated_at`) VALUES
('Persyaratan Bakal Calon Rektor', 'Dokumen persyaratan yang harus dipenuhi oleh bakal calon rektor USN Kolaka periode 2026-2030.', 'documents/PERSYARATAN BAKAL CALON REKTOR.docx', 'PERSYARATAN BAKAL CALON REKTOR.docx', 'docx', 39792, 'peraturan', 0, 1, 1, NOW(), NOW()),
('F.01 – Formulir Pendaftaran', 'Formulir pendaftaran bakal calon rektor USN Kolaka periode 2026-2030.', 'documents/F.01. FORMULIR PENDAFTARAN.docx', 'F.01. FORMULIR PENDAFTARAN.docx', 'docx', 50837, 'formulir', 0, 2, 1, NOW(), NOW()),
('F.02 – Daftar Riwayat Hidup', 'Formulir daftar riwayat hidup bakal calon rektor.', 'documents/F.02. DAFTAR RIWAYAT HIDUP.docx', 'F.02. DAFTAR RIWAYAT HIDUP.docx', 'docx', 54422, 'formulir', 0, 3, 1, NOW(), NOW()),
('F.03 – Pernyataan Menjadi Rektor dan Tidak Mengundurkan Diri', 'Surat pernyataan kesediaan menjadi rektor dan tidak mengundurkan diri.', 'documents/F.03. PERNYATAAN MENJADI REKTOR DAN TIDAK MENGUNDURKAN DIRI.docx', 'F.03. PERNYATAAN MENJADI REKTOR DAN TIDAK MENGUNDURKAN DIRI.docx', 'docx', 38395, 'formulir', 0, 4, 1, NOW(), NOW()),
('F.04 – Pernyataan Tidak Sedang Menjalani Tugas Belajar', 'Surat pernyataan tidak sedang menjalani tugas belajar.', 'documents/F.04. PERNYATAAN TIDAK SEDANG MENJALANI TUGAS BELAJAR.docx', 'F.04. PERNYATAAN TIDAK SEDANG MENJALANI TUGAS BELAJAR.docx', 'docx', 27691, 'formulir', 0, 5, 1, NOW(), NOW()),
('F.05 – Pernyataan Tidak Pernah Melakukan Plagiarisme', 'Surat pernyataan tidak pernah melakukan plagiarisme.', 'documents/F.05. PERNYATAAN TIDAK PERNAH MELAKUKAN PLAGIARISME.docx', 'F.05. PERNYATAAN TIDAK PERNAH MELAKUKAN PLAGIARISME.docx', 'docx', 20112, 'formulir', 0, 6, 1, NOW(), NOW()),
('F.06 – Pernyataan Tidak Pernah Dipidana', 'Surat pernyataan tidak pernah dipidana dan tidak sedang menjalani hukuman disiplin.', 'documents/F.06. PERNYATAAN TIDAK PERNAH DIPIDANA DAN TIDAK SEDANG MENJALANI HUKUMAN DISIPLIN.docx', 'F.06. PERNYATAAN TIDAK PERNAH DIPIDANA DAN TIDAK SEDANG MENJALANI HUKUMAN DISIPLIN.docx', 'docx', 24398, 'formulir', 0, 7, 1, NOW(), NOW());
