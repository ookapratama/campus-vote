@extends('layouts/layoutMaster')

@section('title', 'Kelola Bakal Calon')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Pilrek /</span> Bakal Calon
         </h4>
         <a href="{{ route('admin.pilrek-candidate.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Tambah Kandidat
         </a>
      </div>

      <div class="card">
         <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Daftar Bakal Calon Rektor</h5>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th style="width:50px">#</th>
                     <th>Foto</th>
                     <th>Nama</th>
                     <th>Jabatan</th>
                     <th>Status</th>
                     <th class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($data as $index => $item)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                           <img src="{{ $item->photo_url }}" class="rounded"
                              style="width:50px;height:50px;object-fit:cover">
                        </td>
                        <td>
                           <span class="fw-bold">{{ $item->title }} {{ $item->name }}</span>
                        </td>
                        <td><small class="text-muted">{{ $item->position ?? '-' }}</small></td>
                        <td>
                           @if ($item->is_active)
                              <span class="badge bg-success">Aktif</span>
                           @else
                              <span class="badge bg-secondary">Non-Aktif</span>
                           @endif
                        </td>
                        <td class="text-center">
                           <div class="d-flex justify-content-center gap-2">
                              <a href="{{ route('admin.pilrek-candidate.edit', $item->id) }}"
                                 class="btn btn-sm btn-outline-primary"><i class="ri-pencil-line"></i></a>
                              <button type="button" class="btn btn-sm btn-outline-danger delete-record"
                                 data-id="{{ $item->id }}" data-name="{{ $item->name }}"><i
                                    class="ri-delete-bin-line"></i></button>
                           </div>
                        </td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="6" class="text-center py-5">
                           <div class="text-muted"><i class="ri-user-search-line ri-3x mb-2"></i>
                              <p>Belum ada data kandidat.</p>
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
            let url = "{{ route('admin.pilrek-candidate.destroy', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm('Hapus Kandidat?', `Hapus "${name}"?`, 'Ya, Hapus!', function() {
               $.ajax({
                  url,
                  method: 'DELETE',
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
