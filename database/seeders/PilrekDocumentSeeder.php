<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PilrekDocument;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PilrekDocumentSeeder extends Seeder
{
    public function run(): void
    {
        // Hapus data dokumen dummy sebelumnya
        PilrekDocument::truncate();

        // Pastikan folder documents di storage ada
        Storage::disk('public')->makeDirectory('documents');

        // Daftar dokumen dari public/docs/
        $documents = [
            [
                'file'        => 'PERSYARATAN BAKAL CALON REKTOR.docx',
                'title'       => 'Persyaratan Bakal Calon Rektor',
                'description' => 'Dokumen persyaratan yang harus dipenuhi oleh bakal calon rektor USN Kolaka periode 2026-2030.',
                'category'    => 'peraturan',
                'order'       => 1,
            ],
            [
                'file'        => 'F.01. FORMULIR PENDAFTARAN.docx',
                'title'       => 'F.01 – Formulir Pendaftaran',
                'description' => 'Formulir pendaftaran bakal calon rektor USN Kolaka periode 2026-2030.',
                'category'    => 'formulir',
                'order'       => 2,
            ],
            [
                'file'        => 'F.02. DAFTAR RIWAYAT HIDUP.docx',
                'title'       => 'F.02 – Daftar Riwayat Hidup',
                'description' => 'Formulir daftar riwayat hidup bakal calon rektor.',
                'category'    => 'formulir',
                'order'       => 3,
            ],
            [
                'file'        => 'F.03. PERNYATAAN MENJADI REKTOR DAN TIDAK MENGUNDURKAN DIRI.docx',
                'title'       => 'F.03 – Pernyataan Menjadi Rektor dan Tidak Mengundurkan Diri',
                'description' => 'Surat pernyataan kesediaan menjadi rektor dan tidak mengundurkan diri.',
                'category'    => 'formulir',
                'order'       => 4,
            ],
            [
                'file'        => 'F.04. PERNYATAAN TIDAK SEDANG MENJALANI TUGAS BELAJAR.docx',
                'title'       => 'F.04 – Pernyataan Tidak Sedang Menjalani Tugas Belajar',
                'description' => 'Surat pernyataan tidak sedang menjalani tugas belajar.',
                'category'    => 'formulir',
                'order'       => 5,
            ],
            [
                'file'        => 'F.05. PERNYATAAN TIDAK PERNAH MELAKUKAN PLAGIARISME.docx',
                'title'       => 'F.05 – Pernyataan Tidak Pernah Melakukan Plagiarisme',
                'description' => 'Surat pernyataan tidak pernah melakukan plagiarisme.',
                'category'    => 'formulir',
                'order'       => 6,
            ],
            [
                'file'        => 'F.06. PERNYATAAN TIDAK PERNAH DIPIDANA DAN TIDAK SEDANG MENJALANI HUKUMAN DISIPLIN.docx',
                'title'       => 'F.06 – Pernyataan Tidak Pernah Dipidana',
                'description' => 'Surat pernyataan tidak pernah dipidana dan tidak sedang menjalani hukuman disiplin.',
                'category'    => 'formulir',
                'order'       => 7,
            ],
        ];

        $sourceDir = public_path('docs');

        foreach ($documents as $doc) {
            $sourcePath = $sourceDir . '/' . $doc['file'];

            if (!File::exists($sourcePath)) {
                $this->command->warn("File tidak ditemukan: {$doc['file']}, dilewati.");
                continue;
            }

            // Copy file ke storage/app/public/documents/
            $storagePath = 'documents/' . $doc['file'];
            Storage::disk('public')->put($storagePath, File::get($sourcePath));

            // Buat record di database
            PilrekDocument::create([
                'title'          => $doc['title'],
                'description'    => $doc['description'],
                'file_path'      => $storagePath,
                'file_name'      => $doc['file'],
                'file_type'      => pathinfo($doc['file'], PATHINFO_EXTENSION),
                'file_size'      => File::size($sourcePath),
                'category'       => $doc['category'],
                'order'          => $doc['order'],
                'is_active'      => true,
                'download_count' => 0,
            ]);

            $this->command->info("✅ Dokumen berhasil di-seed: {$doc['title']}");
        }

        $this->command->info('');
        $this->command->info("🎉 Selesai! " . PilrekDocument::count() . " dokumen berhasil di-seed.");
    }
}
