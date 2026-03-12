@php
   $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Admin Dashboard')

@section('vendor-style')
   @vite(['resources/assets/vendor/libs/apex-charts/apex-charts.scss', 'resources/assets/vendor/libs/swiper/swiper.scss'])
@endsection

@section('page-style')
   @vite(['resources/assets/vendor/scss/pages/cards-statistics.scss', 'resources/assets/vendor/scss/pages/cards-analytics.scss'])
@endsection

@section('vendor-script')
   @vite(['resources/assets/vendor/libs/apex-charts/apexcharts.js', 'resources/assets/vendor/libs/swiper/swiper.js'])
@endsection

@section('page-script')
   @vite(['resources/assets/js/dashboards-analytics.js'])
@endsection

@section('content')
   <div class="row g-6">
      <!-- Welcome Card -->
      <div class="col-md-12 col-xxl-8">
         <div class="card h-100">
            <div class="d-flex align-items-end row h-100">
               <div class="col-md-6 order-2 order-md-1">
                  <div class="card-body">
                     <h4 class="card-title mb-4">Selamat Datang, <span class="fw-bold">{{ auth()->user()->name }}!</span> 👑
                     </h4>
                     <p class="mb-5">Sistem siap digunakan. Anda memiliki akses penuh untuk mengelola master data,
                        user, dan permission di portal ini.</p>
                     <div class="d-flex gap-2">
                        <a href="{{ route('user.index') }}" class="btn btn-primary">Kelola User</a>
                        <a href="{{ route('permission.index') }}" class="btn btn-label-secondary">Cek Akses</a>
                     </div>
                  </div>
               </div>
               <div class="col-md-6 text-center text-md-end order-1 order-md-2">
                  <div class="card-body pb-0 px-0 pt-2 h-100 d-flex align-items-end justify-content-center">
                     <img src="{{ asset('assets/img/illustrations/illustration-john-' . $configData['style'] . '.png') }}"
                        height="186" class="scaleX-n1-rtl" alt="View Profile"
                        data-app-light-img="illustrations/illustration-john-light.png"
                        data-app-dark-img="illustrations/illustration-john-dark.png">
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!--/ Welcome Card -->

      <!-- Quick Stats Candidates -->
      <div class="col-xxl-2 col-sm-6">
         <div class="card h-100">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                  <div class="avatar">
                     <div class="avatar-initial bg-label-info rounded-3">
                        <i class="ri-group-line ri-24px"></i>
                     </div>
                  </div>
               </div>
               <div class="card-info mt-5">
                  <h5 class="mb-1">{{ $candidates->count() }}</h5>
                  <p>Bakal Calon</p>
                  <div class="badge bg-label-secondary rounded-pill">Total Terdaftar</div>
               </div>
            </div>
         </div>
      </div>

      <!-- Quick Stats Documents -->
      <div class="col-xxl-2 col-sm-6">
         <div class="card h-100">
            <div class="card-body">
               <div class="d-flex justify-content-between align-items-start flex-wrap gap-2">
                  <div class="avatar">
                     <div class="avatar-initial bg-label-primary rounded-3">
                        <i class="ri-file-download-line ri-24px"></i>
                     </div>
                  </div>
               </div>
               <div class="card-info mt-5">
                  <h5 class="mb-1">{{ $documents->count() }}</h5>
                  <p>Total Dokumen</p>
                  <div class="badge bg-label-secondary rounded-pill">File Publik</div>
               </div>
            </div>
         </div>
      </div>

      <!-- Pilrek Progress Overview -->
      <div class="col-12 col-xxl-8">
         <div class="card h-100">
            <div class="row row-bordered g-0 h-100">
               <div class="col-md-7 col-12 order-2 order-md-0">
                  <div class="card-header d-flex align-items-center justify-content-between">
                     <h5 class="mb-0">Progres Tahapan Pilrek</h5>
                     <small class="text-muted">Updated just now</small>
                  </div>
                  <div class="card-body d-flex flex-column justify-content-center align-items-center text-center">
                     <div class="mb-4">
                        <h2 class="display-4 fw-bold text-primary mb-0">{{ $progress }}%</h2>
                        <p class="text-muted">Tahapan Selesai</p>
                     </div>
                     <div class="progress w-75 mb-4" style="height: 12px;">
                        <div class="progress-bar progress-bar-striped progress-bar-animated bg-primary" role="progressbar"
                           style="width: {{ $progress }}%" aria-valuenow="{{ $progress }}" aria-valuemin="0"
                           aria-valuemax="100"></div>
                     </div>
                     <p class="mb-0">{{ $completedEvents }} dari {{ $totalEvents }} event timeline telah dilaksanakan.
                     </p>
                  </div>
               </div>
               <div class="col-md-5 col-12">
                  <div class="card-header">
                     <h5 class="mb-1">Aksi Cepat Pilrek</h5>
                     <p class="mb-0 card-subtitle">Kelola Tahapan Pemilihan</p>
                  </div>
                  <div class="card-body pt-6">
                     <ul class="list-unstyled mb-0">
                        <li class="d-flex align-items-center mb-4">
                           <div class="avatar avatar-sm me-3"
                              onclick="location.href='{{ route('admin.pilrek-candidate.create') }}'"
                              style="cursor:pointer">
                              <span class="avatar-initial rounded bg-label-success"><i
                                    class="ri-user-add-line ri-18px"></i></span>
                           </div>
                           <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                 <h6 class="mb-0">Tambah Bakal Calon</h6>
                                 <small class="text-muted">Manajemen Kandidat</small>
                              </div>
                              <a href="{{ route('admin.pilrek-candidate.create') }}"
                                 class="btn btn-sm btn-icon btn-text-secondary rounded-pill"><i
                                    class="ri-arrow-right-s-line"></i></a>
                           </div>
                        </li>
                        <li class="d-flex align-items-center mb-4">
                           <div class="avatar avatar-sm me-3"
                              onclick="location.href='{{ route('admin.pilrek-announcement.create') }}'"
                              style="cursor:pointer">
                              <span class="avatar-initial rounded bg-label-warning"><i
                                    class="ri-megaphone-line ri-18px"></i></span>
                           </div>
                           <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                 <h6 class="mb-0">Buat Pengumuman</h6>
                                 <small class="text-muted">Update Berita Pilrek</small>
                              </div>
                              <a href="{{ route('admin.pilrek-announcement.create') }}"
                                 class="btn btn-sm btn-icon btn-text-secondary rounded-pill"><i
                                    class="ri-arrow-right-s-line"></i></a>
                           </div>
                        </li>
                        <li class="d-flex align-items-center">
                           <div class="avatar avatar-sm me-3"
                              onclick="location.href='{{ route('admin.pilrek-document.create') }}'"
                              style="cursor:pointer">
                              <span class="avatar-initial rounded bg-label-info"><i
                                    class="ri-upload-cloud-line ri-18px"></i></span>
                           </div>
                           <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                              <div class="me-2">
                                 <h6 class="mb-0">Upload Dokumen</h6>
                                 <small class="text-muted">Repository File</small>
                              </div>
                              <a href="{{ route('admin.pilrek-document.create') }}"
                                 class="btn btn-sm btn-icon btn-text-secondary rounded-pill"><i
                                    class="ri-arrow-right-s-line"></i></a>
                           </div>
                        </li>
                     </ul>
                  </div>
               </div>
            </div>
         </div>
      </div>

      <!-- Performance Chart -->
      <div class="col-12 col-xxl-4 col-md-6">
         <div class="card h-100">
            <div class="card-header">
               <div class="d-flex justify-content-between">
                  <h5 class="mb-1">System Health</h5>
               </div>
            </div>
            <div class="card-body">
               <div id="performanceChart"></div>
            </div>
         </div>
      </div>
   </div>
@endsection
