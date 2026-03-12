@extends('layouts/layoutMaster')

@section('title', 'Kelola Timeline Pilrek')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <div class="d-flex justify-content-between align-items-center mb-4">
         <h4 class="fw-bold mb-0">
            <span class="text-muted fw-light">Pilrek /</span> Timeline
         </h4>
         <a href="{{ route('admin.pilrek-timeline.create') }}" class="btn btn-primary">
            <i class="ri-add-line me-1"></i> Tambah Event
         </a>
      </div>

      <div class="card">
         <div class="card-header border-bottom">
            <h5 class="card-title mb-0">Daftar Event Timeline</h5>
         </div>
         <div class="table-responsive">
            <table class="table table-hover">
               <thead>
                  <tr>
                     <th style="width:50px">#</th>
                     <th>Tahap</th>
                     <th>Event</th>
                     <th>Tanggal</th>
                     <th>Status</th>
                     <th>Aktif</th>
                     <th class="text-center">Aksi</th>
                  </tr>
               </thead>
               <tbody>
                  @forelse($data as $index => $item)
                     <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                           <span class="badge bg-label-primary">Fase {{ $item->phase_order }}</span>
                           <br><small class="text-muted">{{ Str::limit($item->phase_name, 30) }}</small>
                        </td>
                        <td>
                           <span class="fw-bold">{{ $item->event_name }}</span>
                           @if ($item->icon)
                              <br><small class="text-muted"><i class="{{ $item->icon }}"></i> {{ $item->icon }}</small>
                           @endif
                        </td>
                        <td>
                           <small>{{ $item->start_date->format('d/m/Y') }}
                              @if ($item->end_date && $item->end_date->ne($item->start_date))
                                 <br>s.d. {{ $item->end_date->format('d/m/Y') }}
                              @endif
                           </small>
                        </td>
                        <td>
                           @php $status = $item->computed_status; @endphp
                           @if ($status === 'selesai')
                              <span class="badge bg-success">Selesai</span>
                           @elseif($status === 'berlangsung')
                              <span class="badge bg-warning">Berlangsung</span>
                           @else
                              <span class="badge bg-secondary">Akan Datang</span>
                           @endif
                        </td>
                        <td>
                           @if ($item->is_active)
                              <span class="badge bg-success">Ya</span>
                           @else
                              <span class="badge bg-secondary">Tidak</span>
                           @endif
                        </td>
                        <td class="text-center">
                           <div class="d-flex justify-content-center gap-2">
                              <a href="{{ route('admin.pilrek-timeline.edit', $item->id) }}"
                                 class="btn btn-sm btn-outline-primary">
                                 <i class="ri-pencil-line"></i>
                              </a>
                              <button type="button" class="btn btn-sm btn-outline-danger delete-record"
                                 data-id="{{ $item->id }}" data-name="{{ $item->event_name }}">
                                 <i class="ri-delete-bin-line"></i>
                              </button>
                           </div>
                        </td>
                     </tr>
                  @empty
                     <tr>
                        <td colspan="7" class="text-center py-5">
                           <div class="text-muted">
                              <i class="ri-calendar-line ri-3x mb-2"></i>
                              <p>Belum ada event timeline.</p>
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
            let id = $(this).data('id');
            let name = $(this).data('name');
            let url = "{{ route('admin.pilrek-timeline.destroy', ':id') }}".replace(':id', id);
            window.AlertHandler.confirm('Hapus Event?', `Hapus "${name}"?`, 'Ya, Hapus!', function() {
               $.ajax({
                  url: url,
                  method: 'DELETE',
                  data: {
                     _token: '{{ csrf_token() }}'
                  },
                  success: function(r) {
                     window.AlertHandler.handle(r);
                     setTimeout(() => window.location.reload(), 1500);
                  },
                  error: function(x) {
                     window.AlertHandler.handle(x.responseJSON);
                  }
               });
            });
         });
      });
   </script>
@endsection
