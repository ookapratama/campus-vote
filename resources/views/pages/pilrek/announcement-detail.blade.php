@extends('layouts.pilrekLayout')

@section('title', $announcement->title)
@section('meta_description', $announcement->excerpt ?? Str::limit(strip_tags($announcement->content), 160))

@section('content')
   <!-- Detail Hero -->
   <div class="detail-hero">
      <div class="container">
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-3" style="font-size:0.85rem">
               <li class="breadcrumb-item"><a href="{{ route('pilrek.home') }}"
                     class="text-white-50 text-decoration-none">Beranda</a></li>
               <li class="breadcrumb-item"><a href="{{ route('pilrek.home') }}#pengumuman"
                     class="text-white-50 text-decoration-none">Pengumuman</a></li>
               <li class="breadcrumb-item active text-gold" aria-current="page">Detail</li>
            </ol>
         </nav>
         <span class="announcement-category {{ $announcement->category }}"
            style="margin-bottom:0.75rem;display:inline-block">
            {{ $announcement->category_label }}
         </span>
         <h1
            style="font-family:var(--font-heading);font-weight:700;font-size:clamp(1.4rem,3vw,2rem);color:#fff;max-width:700px">
            {{ $announcement->title }}
         </h1>
         <div class="d-flex align-items-center gap-3 mt-3" style="color:rgba(255,255,255,0.6);font-size:0.88rem">
            <span><i
                  class="ri-calendar-line me-1"></i>{{ $announcement->published_at?->translatedFormat('l, d F Y') }}</span>
         </div>
      </div>
   </div>

   <!-- Detail Content -->
   <div class="detail-content">
      <div class="container">
         <div class="row g-4">
            <div class="col-lg-8">
               <div class="card border-0 shadow-sm" style="border-radius:16px">
                  <div class="card-body p-4 p-lg-5">
                     <div class="content-body">
                        {!! $announcement->content !!}
                     </div>
                  </div>
               </div>

               <div class="mt-4">
                  <a href="{{ route('pilrek.home') }}#pengumuman" class="btn-hero-outline"
                     style="font-size:0.9rem;padding:10px 24px;color:var(--pilrek-blue-accent);border-color:var(--pilrek-blue-accent)">
                     <i class="ri-arrow-left-line"></i> Kembali ke Beranda
                  </a>
               </div>
            </div>

            <div class="col-lg-4">
               <div class="sidebar-card">
                  <h5 class="sidebar-title">Berita Lainnya</h5>
                  @forelse($recentAnnouncements as $recent)
                     <a href="{{ route('pilrek.announcement', $recent->slug) }}" class="sidebar-item">
                        <div class="item-title">{{ Str::limit($recent->title, 60) }}</div>
                        <div class="item-date">
                           <i class="ri-calendar-line me-1"></i>
                           {{ $recent->published_at?->translatedFormat('d F Y') }}
                        </div>
                     </a>
                  @empty
                     <p style="color:var(--pilrek-gray-dark);font-size:0.88rem">Tidak ada berita lainnya.</p>
                  @endforelse
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
