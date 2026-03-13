<!DOCTYPE html>
<html lang="id">

<head>
   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>@yield('title', 'Pemilihan Rektor') | USN Kolaka 2026-2030</title>
   <meta name="description" content="@yield('meta_description', 'Website Resmi Pemilihan Rektor Universitas Sembilanbelas November Kolaka Periode 2026-2030')">
   <meta name="keywords" content="pilrek, pemilihan rektor, USN Kolaka, universitas sembilanbelas november">
   <meta name="csrf-token" content="{{ csrf_token() }}">
   <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/favicon/favicon.ico') }}">
   <link rel="preconnect" href="https://fonts.googleapis.com">
   <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
   <link
      href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;600;700;800&display=swap"
      rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link href="https://cdn.jsdelivr.net/npm/remixicon@4.1.0/fonts/remixicon.css" rel="stylesheet">
   <link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet">
   @yield('styles')
   <link rel="stylesheet" href="{{ asset('assets/css/pilrek.css') }}">
</head>

<body>
   <!-- Navbar -->
   <nav class="navbar navbar-expand-lg navbar-dark pilrek-navbar fixed-top" id="pilrekNavbar">
      <div class="container">
         <a class="navbar-brand d-flex align-items-center" href="{{ route('pilrek.home') }}">
            <div class="brand-icon me-2">
               <i class="ri-government-fill"></i>
            </div>
            <div class="brand-text">
               <span class="brand-title">PILREK USN</span>
               <span class="brand-subtitle">Kolaka 2026–2030</span>
            </div>
         </a>
         <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto align-items-lg-center">
               <li class="nav-item"><a class="nav-link" href="#beranda">Beranda</a></li>
               <li class="nav-item"><a class="nav-link" href="#timeline">Timeline</a></li>
               <li class="nav-item"><a class="nav-link" href="#kandidat">Kandidat</a></li>
               <li class="nav-item"><a class="nav-link" href="#pengumuman">Pengumuman</a></li>
               <li class="nav-item"><a class="nav-link" href="#dokumen">Dokumen</a></li>
               <li class="nav-item"><a class="nav-link" href="#dasar-hukum">Dasar Hukum</a></li>
               <li class="nav-item ms-lg-3">
                  <a class="btn btn-gold btn-sm px-3" href="{{ route('login') }}">
                     <i class="ri-lock-line me-1"></i> Admin
                  </a>
               </li>
            </ul>
         </div>
      </div>
   </nav>

   <!-- Content -->
   @yield('content')

   <!-- Footer -->
   <footer class="pilrek-footer">
      <div class="footer-wave">
         <svg viewBox="0 0 1440 120" preserveAspectRatio="none">
            <path d="M0,60 C360,120 720,0 1080,60 C1260,90 1380,80 1440,60 L1440,120 L0,120 Z" fill="currentColor" />
         </svg>
      </div>
      <div class="footer-content">
         <div class="container">
            <div class="row g-4">
               <div class="col-lg-5">
                  <div class="d-flex align-items-center mb-3">
                     <div class="brand-icon me-2"><i class="ri-government-fill"></i></div>
                     <div>
                        <h5 class="mb-0 text-white">PILREK USN Kolaka</h5>
                        <small class="text-white-50">Periode 2026–2030</small>
                     </div>
                  </div>
                  <p class="text-white-50 mb-0" style="max-width:400px">
                     Website resmi publikasi Pemilihan Rektor Universitas Sembilanbelas November Kolaka.
                     Diselenggarakan oleh Senat Universitas berdasarkan Permenristekdikti No. 19 Tahun 2017.
                  </p>
               </div>
               <div class="col-lg-3">
                  <h6 class="text-gold mb-3">Tautan Cepat</h6>
                  <ul class="list-unstyled footer-links">
                     <li><a href="#timeline"><i class="ri-arrow-right-s-line"></i> Timeline Pilrek</a></li>
                     <li><a href="#kandidat"><i class="ri-arrow-right-s-line"></i> Profil Kandidat</a></li>
                     <li><a href="#pengumuman"><i class="ri-arrow-right-s-line"></i> Pengumuman</a></li>
                     <li><a href="#dokumen"><i class="ri-arrow-right-s-line"></i> Unduh Dokumen</a></li>
                  </ul>
               </div>
               <div class="col-lg-4">
                  <h6 class="text-gold mb-3">Kontak Panitia</h6>
                  <ul class="list-unstyled footer-links">
                     <li><i class="ri-map-pin-line me-2 text-gold"></i> Gedung Rektorat, Kampus USN Kolaka</li>
                     <li><i class="ri-global-line me-2 text-gold"></i> <a href="https://pilrekusn.id/"
                           target="_blank">pilrekusn.id</a></li>
                     <li><i class="ri-mail-line me-2 text-gold"></i> <a
                           href="mailto: panitia@pilrekusn.id"> panitia@pilrekusn.id</a></li>
                  </ul>
               </div>
            </div>
            <hr class="border-white-50 my-4">
            <div class="d-flex flex-wrap justify-content-between align-items-center">
               <p class="text-white-50 mb-0 small">&copy; {{ date('Y') }} Panitia Pemilihan Rektor USN Kolaka. All
                  rights reserved.</p>
               <p class="text-white-50 mb-0 small">Universitas Sembilanbelas November Kolaka</p>
            </div>
         </div>
      </div>
   </footer>

   <a href="#beranda" class="back-to-top" id="backToTop"><i class="ri-arrow-up-line"></i></a>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
   <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
   @yield('scripts')
   <script src="{{ asset('assets/js/pilrek.js') }}"></script>
</body>

</html>
