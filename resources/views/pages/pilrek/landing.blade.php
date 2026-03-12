@extends('layouts.pilrekLayout')

@section('title', 'Pemilihan Rektor USN Kolaka 2026-2030')

@section('content')
   <!-- ========== HERO SECTION ========== -->
   <section id="beranda" class="pilrek-hero">
      <div class="hero-pattern"></div>
      <div class="hero-decoration"></div>
      <div class="hero-decoration"></div>
      <div class="hero-decoration"></div>

      <div class="container">
         <div class="row align-items-center">
            <div class="col-lg-7 hero-content" data-aos="fade-right">
               <div class="hero-badge">
                  <i class="ri-calendar-check-line"></i>
                  Periode 2026 – 2030
               </div>
               <h1 class="hero-title">
                  Pemilihan <span class="text-gold">Rektor</span>
               </h1>
               <p class="hero-university">Universitas Sembilanbelas November Kolaka</p>
               <p class="hero-description">
                  Website resmi publikasi informasi, dokumentasi tahapan, dan dokumen resmi
                  Pemilihan Rektor USN Kolaka. Diselenggarakan oleh Senat Universitas
                  sesuai Permenristekdikti No. 19 Tahun 2017.
               </p>
               <div class="hero-cta">
                  <a href="#timeline" class="btn-hero-primary">
                     <i class="ri-time-line"></i> Lihat Timeline
                  </a>
                  <a href="#dokumen" class="btn-hero-outline">
                     <i class="ri-download-2-line"></i> Unduh Dokumen
                  </a>
               </div>
            </div>
            <div class="col-lg-5" data-aos="fade-left" data-aos-delay="200">
               <div class="hero-stats">
                  <div class="hero-stat">
                     <div class="hero-stat-value" data-counter="23">0</div>
                     <div class="hero-stat-label">Anggota Senat</div>
                  </div>
                  <div class="hero-stat">
                     <div class="hero-stat-value" data-counter="3">0</div>
                     <div class="hero-stat-label">Tahap Pilrek</div>
                  </div>
                  <div class="hero-stat">
                     <div class="hero-stat-value" data-counter="{{ $candidates->count() }}">0</div>
                     <div class="hero-stat-label">Bakal Calon</div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>

   <!-- ========== PROGRESS SECTION ========== -->
   <section class="progress-section">
      <div class="container">
         <div class="progress-card" data-aos="fade-up">
            <div class="d-flex flex-wrap align-items-center justify-content-between mb-3">
               <div>
                  <h6 class="mb-1" style="font-family:var(--font-heading);font-weight:700;color:var(--pilrek-navy)">
                     Progres Tahapan Pilrek
                  </h6>
                  <small style="color:var(--pilrek-gray-dark)">
                     {{ $completedEvents }} dari {{ $totalEvents }} tahapan selesai
                  </small>
               </div>
               <span
                  style="font-family:var(--font-heading);font-size:1.5rem;font-weight:800;color:var(--pilrek-blue-accent)">
                  {{ $progress }}%
               </span>
            </div>
            <div class="progress-bar-pilrek">
               <div class="bar" data-width="{{ $progress }}" style="width:0%"></div>
            </div>
         </div>
      </div>
   </section>

   <!-- ========== TIMELINE SECTION ========== -->
   <section id="timeline" class="section-pilrek bg-light">
      <div class="container">
         <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="ri-time-line"></i> TIMELINE</div>
            <h2 class="section-title">Tahapan Pemilihan Rektor</h2>
            <p class="section-subtitle">
               Seluruh proses pemilihan rektor dilaksanakan berdasarkan Permenristekdikti No. 19 Tahun 2017.
               <br><small class="text-muted"><em>*) Jadwal bertanda bintang bersifat tentatif, mengikuti jadwal dari
                     Mendiktisaintek.</em></small>
            </p>
         </div>

         @php $phaseIndex = 0; @endphp
         @foreach ($timelineGroups as $phaseName => $events)
            @php
               $phaseIndex++;
               $phaseStatuses = $events->map(fn($e) => $e->computed_status);
               if ($phaseStatuses->every(fn($s) => $s === 'selesai')) {
                   $phaseStatus = 'selesai';
                   $phaseLabel = 'Selesai';
               } elseif ($phaseStatuses->contains('berlangsung')) {
                   $phaseStatus = 'berlangsung';
                   $phaseLabel = 'Berlangsung';
               } else {
                   $phaseStatus = 'akan_datang';
                   $phaseLabel = 'Akan Datang';
               }
            @endphp
            <div class="timeline-phase" data-aos="fade-up" data-aos-delay="{{ $phaseIndex * 100 }}">
               <div class="phase-header">
                  <div class="phase-number">{{ $phaseIndex }}</div>
                  <div>
                     <h3 class="phase-title">{{ $phaseName }}</h3>
                  </div>
                  <span class="phase-status {{ $phaseStatus }}">
                     @if ($phaseStatus === 'selesai')
                        <i class="ri-check-line me-1"></i>
                     @elseif($phaseStatus === 'berlangsung')
                        <i class="ri-loader-4-line me-1"></i>
                     @else
                        <i class="ri-time-line me-1"></i>
                     @endif
                     {{ $phaseLabel }}
                  </span>
               </div>

               <div class="timeline-events">
                  @foreach ($events as $event)
                     @php $eventStatus = $event->computed_status; @endphp
                     <div class="timeline-event {{ $eventStatus }}">
                        <div class="d-flex align-items-start gap-3">
                           <div class="event-icon {{ $eventStatus }}">
                              <i class="{{ $event->icon ?? 'ri-calendar-check-line' }}"></i>
                           </div>
                           <div class="flex-grow-1">
                              <div class="d-flex flex-wrap align-items-center justify-content-between gap-2">
                                 <h5 class="event-name mb-0">{{ $event->event_name }}</h5>
                                 <span class="event-status-badge {{ $eventStatus }}">{{ $event->status_label }}</span>
                              </div>
                              <div class="event-date mt-1">
                                 <i class="ri-calendar-line me-1"></i>
                                 {{ $event->start_date->translatedFormat('d F Y') }}
                                 @if ($event->end_date && $event->end_date->ne($event->start_date))
                                    – {{ $event->end_date->translatedFormat('d F Y') }}
                                 @endif
                              </div>
                              @if ($event->description)
                                 <p class="mb-0 mt-2" style="font-size:0.85rem;color:var(--pilrek-gray-dark)">
                                    {{ $event->description }}
                                 </p>
                              @endif
                           </div>
                        </div>
                     </div>
                  @endforeach
               </div>
            </div>
         @endforeach
      </div>
   </section>

   <!-- ========== KANDIDAT SECTION ========== -->
   <section id="kandidat" class="section-pilrek">
      <div class="container">
         <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="ri-user-star-line"></i> PROFIL KANDIDAT</div>
            <h2 class="section-title">Bakal Calon Rektor</h2>
            <p class="section-subtitle">
               Profil bakal calon rektor USN Kolaka periode 2026-2030
            </p>
         </div>

         @if ($candidates->count() > 0)
            <div class="row g-4">
               @foreach ($candidates as $candidate)
                  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                     <div class="candidate-card">
                        <div class="candidate-photo">
                           @if ($candidate->photo)
                              <img src="{{ $candidate->photo_url }}" alt="{{ $candidate->name }}">
                           @else
                              <i class="ri-user-3-line placeholder-icon"></i>
                           @endif
                        </div>
                        <div class="candidate-info">
                           <h4 class="candidate-name">{{ $candidate->title }} {{ $candidate->name }}</h4>
                           @if ($candidate->position)
                              <p class="candidate-position">{{ $candidate->position }}</p>
                           @endif
                           @if ($candidate->bio)
                              <p class="candidate-bio">{{ $candidate->bio }}</p>
                           @endif
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         @else
            <div class="candidate-empty" data-aos="fade-up">
               <i class="ri-user-search-line d-block mb-3"></i>
               <h5 style="color:var(--pilrek-navy);font-family:var(--font-heading)">Pendaftaran Segera Dibuka</h5>
               <p style="color:var(--pilrek-gray-dark);max-width:400px;margin:0 auto">
                  Profil bakal calon rektor akan ditampilkan setelah proses pendaftaran dan verifikasi administrasi
                  selesai.
               </p>
            </div>
         @endif
      </div>
   </section>

   <!-- ========== PENGUMUMAN SECTION ========== -->
   <section id="pengumuman" class="section-pilrek bg-light">
      <div class="container">
         <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="ri-megaphone-line"></i> PENGUMUMAN & BERITA</div>
            <h2 class="section-title">Informasi Terkini</h2>
            <p class="section-subtitle">Pengumuman resmi dan berita terbaru seputar Pemilihan Rektor</p>
         </div>

         @if ($announcements->count() > 0)
            <div class="row g-4">
               @foreach ($announcements as $item)
                  <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                     <div class="announcement-card position-relative">
                        @if ($item->is_pinned)
                           <div class="announcement-pinned" title="Disematkan">
                              <i class="ri-pushpin-fill"></i>
                           </div>
                        @endif
                        <span class="announcement-category {{ $item->category }}">{{ $item->category_label }}</span>
                        <h4 class="announcement-title">
                           <a href="{{ route('pilrek.announcement', $item->slug) }}">{{ $item->title }}</a>
                        </h4>
                        <p class="announcement-excerpt">
                           {{ $item->excerpt ?? Str::limit(strip_tags($item->content), 120) }}</p>
                        <div class="announcement-meta">
                           <i class="ri-calendar-line"></i>
                           {{ $item->published_at?->translatedFormat('d F Y') ?? $item->created_at->translatedFormat('d F Y') }}
                        </div>
                     </div>
                  </div>
               @endforeach
            </div>
         @else
            <div class="text-center py-5" data-aos="fade-up">
               <i class="ri-article-line" style="font-size:3rem;color:var(--pilrek-blue-accent);opacity:0.3"></i>
               <p class="mt-2" style="color:var(--pilrek-gray-dark)">Belum ada pengumuman.</p>
            </div>
         @endif
      </div>
   </section>

   <!-- ========== DOKUMEN SECTION ========== -->
   <section id="dokumen" class="section-pilrek">
      <div class="container">
         <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="ri-download-2-line"></i> UNDUH DOKUMEN</div>
            <h2 class="section-title">Dokumen Resmi</h2>
            <p class="section-subtitle">Formulir pendaftaran dan dokumen resmi Pemilihan Rektor</p>
         </div>

         <div class="row g-3">
            @foreach ($documents as $doc)
               <div class="col-lg-6" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                  <div class="document-card">
                     <div class="document-icon">
                        <i class="{{ $doc->file_icon }}"></i>
                     </div>
                     <div class="document-info">
                        <h5 class="document-title">{{ $doc->title }}</h5>
                        <p class="document-meta mb-0">
                           {{ strtoupper($doc->file_type) }} · {{ $doc->file_size_formatted }}
                           · <i class="ri-download-line"></i> {{ $doc->download_count }}x diunduh
                        </p>
                     </div>
                     <a href="{{ route('pilrek.download', $doc->id) }}" class="btn-download">
                        <i class="ri-download-2-line"></i> Unduh
                     </a>
                  </div>
               </div>
            @endforeach

            @if ($documents->count() === 0)
               <div class="col-12 text-center py-5">
                  <i class="ri-file-search-line" style="font-size:3rem;color:var(--pilrek-blue-accent);opacity:0.3"></i>
                  <p class="mt-2" style="color:var(--pilrek-gray-dark)">Belum ada dokumen yang tersedia.</p>
               </div>
            @endif
         </div>
      </div>
   </section>

   <!-- ========== DASAR HUKUM SECTION ========== -->
   <section id="dasar-hukum" class="section-pilrek bg-light">
      <div class="container">
         <div class="section-header" data-aos="fade-up">
            <div class="section-badge"><i class="ri-scales-3-line"></i> DASAR HUKUM</div>
            <h2 class="section-title">Landasan Hukum Pemilihan</h2>
            <p class="section-subtitle">Dasar hukum penyelenggaraan pemilihan rektor universitas negeri</p>
         </div>

         <div class="row g-4">
            <div class="col-lg-6" data-aos="fade-up">
               <div class="legal-card h-100">
                  <div class="legal-icon"><i class="ri-book-open-line"></i></div>
                  <h4 class="legal-title">Permenristekdikti No. 19 Tahun 2017</h4>
                  <p class="legal-description">
                     Peraturan Menteri Riset, Teknologi, dan Pendidikan Tinggi tentang
                     <strong>Pengangkatan dan Pemberhentian Pemimpin Perguruan Tinggi Negeri</strong>.
                     Mengatur mekanisme dan persyaratan pemilihan rektor oleh Senat Universitas.
                  </p>
               </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="100">
               <div class="legal-card h-100">
                  <div class="legal-icon"><i class="ri-calendar-todo-line"></i></div>
                  <h4 class="legal-title">Pelantikan Rektor</h4>
                  <p class="legal-description">
                     Pelantikan Rektor USN Kolaka periode 2026-2030 dijadwalkan pada
                     <strong>8 Juli 2026*</strong>. Calon Rektor terpilih akan disampaikan kepada
                     <strong>Menteri Pendidikan Tinggi, Sains dan Teknologi</strong> untuk ditetapkan
                     dan dilantik. <em>*) Jadwal tentatif mengikuti jadwal dari Mendiktisaintek.</em>
                  </p>
               </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="200">
               <div class="legal-card h-100">
                  <div class="legal-icon"><i class="ri-government-line"></i></div>
                  <h4 class="legal-title">Kewenangan Senat Universitas</h4>
                  <p class="legal-description">
                     Pemilihan rektor dilakukan oleh Senat Universitas
                     melalui mekanisme pemungutan suara langsung. Senat bertanggung jawab atas seluruh
                     proses mulai dari penjaringan, penyaringan, hingga pengusulan ke Kementerian.
                  </p>
               </div>
            </div>
            <div class="col-lg-6" data-aos="fade-up" data-aos-delay="300">
               <div class="legal-card h-100">
                  <div class="legal-icon"><i class="ri-shield-check-line"></i></div>
                  <h4 class="legal-title">Prinsip Pemilihan</h4>
                  <p class="legal-description">
                     Pemilihan dilaksanakan dengan prinsip <strong>transparan, akuntabel, dan demokratis</strong>.
                     Setiap tahapan didokumentasikan dan dipublikasikan kepada seluruh civitas
                     akademika USN Kolaka melalui website resmi ini.
                  </p>
               </div>
            </div>
         </div>
      </div>
   </section>
@endsection
