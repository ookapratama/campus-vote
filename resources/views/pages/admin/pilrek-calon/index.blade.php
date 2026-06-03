@extends('layouts/layoutMaster')

@section('title', 'Kelola Bakal Calon')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Pilrek /</span> Calon (3 Besar)
         </h4>
         <a href="{{ route('admin.pilrek-candidate.index') }}" class="btn btn-outline-secondary">
            <i class="ri-arrow-left-line me-1"></i> Lihat Bakal Calon
         </a>
      </div>

      <div class="card">
         <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Daftar Calon Rektor (3 Besar Terpilih)</h5>
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
                     <th>3 Besar</th>
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

                        <td>
                           @if ($item->is_top_three)
                              <button type="button" class="btn btn-sm btn-warning toggle-top-three"
                                 data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-status="1">
                                 <i class="ri-star-fill me-1"></i> 3 Besar
                              </button>
                           @else
                              <button type="button" class="btn btn-sm btn-outline-warning toggle-top-three"
                                 data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-status="0">
                                 <i class="ri-star-line me-1"></i> Pilih
                              </button>
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
                        <td colspan="7" class="text-center py-5">
                           <div class="py-4 text-center">
                              <div class="text-secondary mb-2">
                                 <i class="ri-user-search-line ri-2x opacity-75"></i>
                              </div>
                              <h6 class="text-secondary fw-semibold mb-1">Belum Ada Calon 3 Besar</h6>
                              <p class="text-muted small mb-0 px-3">
                                 Silakan tandai kandidat terpilih melalui menu <span class="fw-medium text-primary">Bakal Calon</span> terlebih dahulu.
                              </p>
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
         $('.toggle-top-three').on('click', function() {
            let id = $(this).data('id'),
               name = $(this).data('name'),
               status = $(this).data('status');
            let title = status == "1" ? 'Batalkan 3 Besar?' : 'Pilih Jadi 3 Besar?';
            let text = status == "1" ? `Keluarkan "${name}" dari daftar 3 besar?` : `Masukkan "${name}" ke dalam daftar 3 besar?`;
            let confirmText = status == "1" ? 'Ya, Batalkan!' : 'Ya, Pilih!';

            let url = "{{ route('admin.pilrek-candidate.toggle-top-three', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm(title, text, confirmText, function() {
               $.ajax({
                  url,
                  method: 'POST',
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

         $('.delete-record').on('click', function() {
            let id = $(this).data('id'),
               name = $(this).data('name');
            let url = "{{ route('admin.pilrek-candidate.destroy', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm('Hapus Kandidat?', `Hapus "${name}"?`, 'Ya, Hapus!', function() {
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
