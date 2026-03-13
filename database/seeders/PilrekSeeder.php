<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PilrekTimeline;
use App\Models\PilrekAnnouncement;
use App\Models\PilrekDocument;

class PilrekSeeder extends Seeder
{
    public function run(): void
    {
        // ========================================
        // TAHAP PENJARINGAN BAKAL CALON REKTOR
        // ========================================
        $phase1 = 'Tahap Penjaringan Bakal Calon Rektor';

        PilrekTimeline::create([
            'phase_name' => $phase1,
            'phase_order' => 1,
            'event_name' => 'Sosialisasi dan Pengumuman',
            'description' => 'Sosialisasi dan pengumuman resmi pendaftaran bakal calon rektor melalui media cetak, elektronik, dan website resmi.',
            'start_date' => '2026-03-13',
            'end_date' => '2026-03-31',
            'icon' => 'ri-megaphone-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase1,
            'phase_order' => 1,
            'event_name' => 'Pendaftaran',
            'description' => 'Periode pendaftaran bakal calon rektor dengan menyerahkan berkas persyaratan yang telah ditentukan.',
            'start_date' => '2026-04-01',
            'end_date' => '2026-04-10',
            'icon' => 'ri-file-edit-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase1,
            'phase_order' => 1,
            'event_name' => 'Perpanjangan Pendaftaran',
            'description' => 'Perpanjangan pendaftaran dilakukan jika tidak memenuhi 4 (Empat) Bakal Calon Rektor.',
            'start_date' => '2026-04-13',
            'end_date' => '2026-04-24',
            'icon' => 'ri-calendar-todo-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase1,
            'phase_order' => 1,
            'event_name' => 'Seleksi Administrasi',
            'description' => 'Verifikasi dan seleksi kelengkapan berkas administrasi bakal calon rektor.',
            'start_date' => '2026-04-27',
            'end_date' => '2026-05-04',
            'icon' => 'ri-checkbox-circle-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase1,
            'phase_order' => 1,
            'event_name' => 'Pengumuman Hasil Penjaringan',
            'description' => 'Pengumuman nama-nama bakal calon rektor yang lolos seleksi administrasi penjaringan.',
            'start_date' => '2026-05-19',
            'end_date' => '2026-05-19',
            'icon' => 'ri-notification-badge-line',
        ]);

        // ========================================
        // TAHAP PENYARINGAN BAKAL CALON REKTOR
        // ========================================
        $phase2 = 'Tahap Penyaringan Bakal Calon Rektor';

        PilrekTimeline::create([
            'phase_name' => $phase2,
            'phase_order' => 2,
            'event_name' => 'Penerimaan Dokumen Visi, Misi dan Program Kerja',
            'description' => 'Penerimaan dokumen visi, misi, dan program kerja dari bakal calon rektor yang lolos penjaringan.',
            'start_date' => '2026-05-22',
            'end_date' => '2026-05-25',
            'icon' => 'ri-presentation-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase2,
            'phase_order' => 2,
            'event_name' => 'Penyaringan Bakal Calon Rektor Menjadi 3 (Tiga) Calon Rektor',
            'description' => 'Penyaringan bakal calon rektor oleh Senat Universitas untuk menetapkan 3 (tiga) calon rektor. *) Jadwal tentatif.',
            'start_date' => '2026-05-25',
            'end_date' => '2026-06-02',
            'icon' => 'ri-zoom-in-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase2,
            'phase_order' => 2,
            'event_name' => 'Penetapan 3 (Tiga) Calon Rektor',
            'description' => 'Penetapan 3 (tiga) calon rektor yang lolos tahap penyaringan. *) Jadwal tentatif mengikuti jadwal dari Mendiktisaintek.',
            'start_date' => '2026-06-02',
            'end_date' => '2026-06-02',
            'icon' => 'ri-user-star-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase2,
            'phase_order' => 2,
            'event_name' => 'Penyampaian Hasil Penyaringan ke Menteri',
            'description' => 'Penyampaian hasil penyaringan 3 (tiga) Calon Rektor kepada Menteri Pendidikan Tinggi, Sains dan Teknologi beserta kelengkapannya. *) Jadwal tentatif.',
            'start_date' => '2026-06-02',
            'end_date' => '2026-06-02',
            'icon' => 'ri-mail-send-line',
        ]);

        // ========================================
        // TAHAP PEMILIHAN CALON REKTOR
        // ========================================
        $phase3 = 'Tahap Pemilihan Calon Rektor';

        PilrekTimeline::create([
            'phase_name' => $phase3,
            'phase_order' => 3,
            'event_name' => 'Pemilihan Calon Rektor',
            'description' => 'Pemilihan calon rektor oleh Senat Universitas melalui mekanisme pemungutan suara. *) Jadwal tentatif mengikuti jadwal dari Mendiktisaintek.',
            'start_date' => '2026-06-09',
            'end_date' => '2026-06-12',
            'icon' => 'ri-government-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase3,
            'phase_order' => 3,
            'event_name' => 'Penyerahan Hasil Pemilihan kepada Rektor',
            'description' => 'Penyerahan hasil pemilihan Calon Rektor kepada Rektor. *) Jadwal tentatif mengikuti jadwal dari Mendiktisaintek.',
            'start_date' => '2026-06-12',
            'end_date' => '2026-06-12',
            'icon' => 'ri-hand-heart-line',
        ]);

        PilrekTimeline::create([
            'phase_name' => $phase3,
            'phase_order' => 3,
            'event_name' => 'Penyampaian Calon Rektor Terpilih ke Menteri',
            'description' => 'Penyampaian Calon Rektor terpilih kepada Menteri Pendidikan Tinggi, Sains dan Teknologi untuk ditetapkan dan dilantik. *) Jadwal tentatif.',
            'start_date' => '2026-06-12',
            'end_date' => '2026-06-12',
            'icon' => 'ri-medal-line',
        ]);

        // ========================================
        // PELANTIKAN
        // ========================================
        $phase4 = 'Pelantikan Rektor';

        PilrekTimeline::create([
            'phase_name' => $phase4,
            'phase_order' => 4,
            'event_name' => 'Pelantikan Rektor USN Kolaka Periode 2026-2030',
            'description' => 'Pelantikan Rektor Universitas Sembilanbelas November Kolaka Periode 2026-2030. *) Jadwal tentatif mengikuti jadwal dari Mendiktisaintek.',
            'start_date' => '2026-07-08',
            'end_date' => '2026-07-08',
            'icon' => 'ri-award-line',
        ]);

        // ========================================
        // SAMPLE ANNOUNCEMENTS
        // ========================================
        PilrekAnnouncement::create([
            'title' => 'Pengumuman Pembentukan Panitia Pemilihan Rektor USN Kolaka',
            'slug' => 'pembentukan-panitia-pemilihan-rektor',
            'excerpt' => 'Senat Universitas Sembilanbelas November Kolaka telah resmi membentuk Panitia Pemilihan Rektor untuk periode 2026-2030.',
            'content' => '<p>Berdasarkan Rapat Pleno Senat Universitas Sembilanbelas November Kolaka, telah diputuskan pembentukan Panitia Pemilihan Rektor USN Kolaka Periode 2026–2030.</p><p>Panitia bertugas menyelenggarakan seluruh tahapan pemilihan rektor sesuai dengan Permenristekdikti Nomor 19 Tahun 2017 tentang Pengangkatan dan Pemberhentian Pemimpin Perguruan Tinggi Negeri.</p><p>Susunan Panitia Pemilihan akan diumumkan melalui Surat Keputusan Senat Universitas.</p>',
            'category' => 'pengumuman',
            'is_pinned' => true,
            'published_at' => '2026-03-09 10:00:00',
        ]);

        PilrekAnnouncement::create([
            'title' => 'Pendaftaran Bakal Calon Rektor USN Kolaka Dibuka 1-10 April 2026',
            'slug' => 'pendaftaran-bakal-calon-rektor-dibuka',
            'excerpt' => 'Panitia Pemilihan Rektor USN Kolaka membuka pendaftaran bakal calon rektor mulai 1 April hingga 10 April 2026.',
            'content' => '<p>Panitia Pemilihan Rektor Universitas Sembilanbelas November Kolaka mengumumkan bahwa pendaftaran bakal calon rektor periode 2026-2030 resmi dibuka.</p><h4>Jadwal Pendaftaran</h4><ul><li>Tanggal Mulai: 1 April 2026</li><li>Tanggal Berakhir: 10 April 2026</li><li>Perpanjangan (jika kurang dari 4 bakal calon): s.d. 24 April 2026</li><li>Waktu: Senin-Jumat, Pukul 08.00-16.00 WITA</li></ul><h4>Tempat Pendaftaran</h4><p>Sekretariat Panitia Pemilihan Rektor, Gedung Rektorat, Kampus USN Kolaka.</p><p>Formulir pendaftaran dan persyaratan lengkap dapat diunduh melalui website <strong>pilrek.usn.ac.id</strong> atau email <strong>panitia.pilrek@usn.ac.id</strong>.</p>',
            'category' => 'pengumuman',
            'is_pinned' => false,
            'published_at' => '2026-03-13 08:00:00',
        ]);

        PilrekAnnouncement::create([
            'title' => 'Persyaratan Bakal Calon Rektor Sesuai Permenristekdikti No. 19/2017',
            'slug' => 'persyaratan-bakal-calon-rektor',
            'excerpt' => 'Berikut persyaratan yang harus dipenuhi oleh bakal calon rektor USN Kolaka periode 2026-2030.',
            'content' => '<p>Berdasarkan Permenristekdikti Nomor 19 Tahun 2017, persyaratan bakal calon rektor antara lain:</p><ol><li>Beriman dan bertaqwa kepada Tuhan Yang Maha Esa</li><li>Warga Negara Indonesia</li><li>Sehat jasmani dan rohani</li><li>Memiliki integritas moral, etika, dan kepribadian yang baik</li><li>Memiliki kualifikasi akademik paling rendah doktor (S3)</li><li>Berusia paling tinggi 65 tahun pada saat pendaftaran</li><li>Memiliki pengalaman manajerial di bidang pendidikan tinggi</li><li>Tidak sedang menjalani sanksi hukum</li></ol>',
            'category' => 'informasi',
            'is_pinned' => false,
            'published_at' => '2026-03-10 09:00:00',
        ]);

        // ========================================
        // SAMPLE DOCUMENTS
        // ========================================
        PilrekDocument::create([
            'title' => 'Formulir Pendaftaran Bakal Calon Rektor',
            'description' => 'Formulir lengkap pendaftaran bakal calon rektor USN Kolaka periode 2026-2030.',
            'file_path' => 'documents/formulir-pendaftaran-pilrek.pdf',
            'file_name' => 'Formulir-Pendaftaran-Pilrek-USN-2026.pdf',
            'file_type' => 'pdf',
            'file_size' => 245760,
            'category' => 'formulir',
            'order' => 1,
        ]);

        PilrekDocument::create([
            'title' => 'SK Senat tentang Pembentukan Panitia',
            'description' => 'Surat Keputusan Senat USN Kolaka tentang Pembentukan Panitia Pemilihan Rektor.',
            'file_path' => 'documents/sk-panitia-pilrek.pdf',
            'file_name' => 'SK-Panitia-Pilrek-USN-2026.pdf',
            'file_type' => 'pdf',
            'file_size' => 156672,
            'category' => 'sk',
            'order' => 2,
        ]);

        PilrekDocument::create([
            'title' => 'Permenristekdikti No. 19 Tahun 2017',
            'description' => 'Peraturan Menteri tentang Pengangkatan dan Pemberhentian Pemimpin Perguruan Tinggi Negeri.',
            'file_path' => 'documents/permenristekdikti-19-2017.pdf',
            'file_name' => 'Permenristekdikti-No-19-Tahun-2017.pdf',
            'file_type' => 'pdf',
            'file_size' => 524288,
            'category' => 'peraturan',
            'order' => 3,
        ]);

        PilrekDocument::create([
            'title' => 'Tata Tertib Pemilihan Rektor',
            'description' => 'Tata tertib dan mekanisme pemilihan rektor USN Kolaka yang ditetapkan oleh Senat.',
            'file_path' => 'documents/tatib-pilrek.pdf',
            'file_name' => 'Tata-Tertib-Pilrek-USN-2026.pdf',
            'file_type' => 'pdf',
            'file_size' => 198656,
            'category' => 'peraturan',
            'order' => 4,
        ]);
    }
}
