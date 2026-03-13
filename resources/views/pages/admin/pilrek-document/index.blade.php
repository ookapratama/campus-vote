@extends('layouts/layoutMaster')

@section('title', 'Kelola Dokumen')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Pilrek /</span> Dokumen
         </h4>
         <a href="{{ route('admin.pilrek-document.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Upload Dokumen
         </a>
      </div>

      <div class="card">
         <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Daftar Dokumen</h5>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th style="width:50px">#</th>
                     <th>Dokumen</th>
                     <th>Kategori</th>
                     <th>Ukuran</th>
                     <th>Unduhan</th>
                     <th>Status</th>
                     <th class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($data as $index => $item)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                           <span class="fw-bold">{{ $item->title }}</span>
                           <br><small class="text-muted">{{ $item->file_name }}</small>
                        </td>
                        <td><span class="badge bg-label-primary">{{ $item->category_label }}</span></td>
                        <td><small>{{ $item->file_size_formatted }}</small></td>
                        <td><span class="badge bg-label-info">{{ $item->download_count }}x</span></td>
                        <td>
                           @if ($item->is_active)
                              <span class="badge bg-success">Aktif</span>
                           @else
                              <span class="badge bg-secondary">Non-Aktif</span>
                           @endif
                        </td>
                        <td class="text-center">
                           <div class="d-flex justify-content-center gap-2">
                              <a href="{{ route('admin.pilrek-document.edit', $item->id) }}"
                                 class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i></a>
                              <button type="button" class="btn btn-sm btn-outline-danger delete-record"
                                 data-id="{{ $item->id }}" data-name="{{ $item->title }}"><i
                                    class="ri-delete-bin-line"></i></button>
                           </div>
                        </td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="7" class="text-center py-5">
                           <div class="text-muted"><i class="ri-file-line ri-3x mb-2"></i>
                              <p>Belum ada dokumen.</p>
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
            let url = "{{ route('admin.pilrek-document.destroy', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm('Hapus Dokumen?', `Hapus "${name}"?`, 'Ya, Hapus!', function() {
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
