@extends('layouts/layoutMaster')

@section('title', 'Kelola Pengumuman')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Pilrek /</span> Pengumuman
         </h4>
         <a href="{{ route('admin.pilrek-announcement.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Tambah Pengumuman
         </a>
      </div>

      <div class="card">
         <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Daftar Pengumuman & Berita</h5>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th style="width:50px">#</th>
                     <th>Judul</th>
                     <th>Kategori</th>
                     <th>Tanggal</th>
                     <th>Status</th>
                     <th class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($data as $index => $item)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                           <span class="fw-bold">{{ Str::limit($item->title, 50) }}</span>
                           @if ($item->is_pinned)
                              <i class="ri-pushpin-fill text-warning ms-1" title="Disematkan"></i>
                           @endif
                        </td>
                        <td>
                           @if ($item->category === 'pengumuman')
                              <span class="badge bg-label-danger">Pengumuman</span>
                           @elseif($item->category === 'berita')
                              <span class="badge bg-label-primary">Berita</span>
                           @else
                              <span class="badge bg-label-info">Informasi</span>
                           @endif
                        </td>
                        <td><small>{{ $item->published_at?->format('d/m/Y H:i') ?? '-' }}</small></td>
                        <td>
                           @if ($item->is_published)
                              <span class="badge bg-success">Dipublikasi</span>
                           @else
                              <span class="badge bg-secondary">Draft</span>
                           @endif
                        </td>
                        <td class="text-center">
                           <div class="d-flex justify-content-center gap-2">
                              <a href="{{ route('admin.pilrek-announcement.edit', $item->id) }}"
                                 class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i></a>
                              <a href="{{ route('pilrek.announcement', $item->slug) }}" target="_blank"
                                 class="btn btn-sm btn-outline-info"><i class="ri-eye-line"></i></a>
                              <button type="button" class="btn btn-sm btn-outline-danger delete-record"
                                 data-id="{{ $item->id }}" data-name="{{ $item->title }}"><i
                                    class="ri-delete-bin-line"></i></button>
                           </div>
                        </td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="6" class="text-center py-5">
                           <div class="text-muted"><i class="ri-article-line ri-3x mb-2"></i>
                              <p>Belum ada pengumuman.</p>
                           </div>
                        </td>
                     </tr>
                  @endforelse
               </tbody>
            </table>
         </div>
      </div>
   </div>
@endsection

@section('page-script')
   <script>
      document.addEventListener('DOMContentLoaded', function() {
         $('.delete-record').on('click', function() {
            let id = $(this).data('id'),
               name = $(this).data('name');
            let url = "{{ route('admin.pilrek-announcement.destroy', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm('Hapus Pengumuman?', `Hapus "${name}"?`, 'Ya, Hapus!', function() {
               $.ajax({
                  url,
                  method: 'DELETE',
                  dataType: 'json',
                  data: {
                     _token: '{{ csrf_token() }}'
                  },
                  success: r => {
                     window.AlertHandler.handle(r);
                     setTimeout(() => window.location.reload(), 1500);
                  },
                  error: x => window.AlertHandler.handle(x.responseJSON)
               });
            });
         });
      });
   </script>
@endsection
