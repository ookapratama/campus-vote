@extends('layouts/layoutMaster')

@section('title', isset($data) ? 'Edit Event Timeline' : 'Tambah Event Timeline')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold mb-4">
         <span class="text-muted fw-light">Pilrek / Timeline /</span>
         {{ isset($data) ? 'Edit' : 'Tambah' }} Event
      </h4>

      <div class="card">
         <div class="card-body">
            <form
               action="{{ isset($data) ? route('admin.pilrek-timeline.update', $data->id) : route('admin.pilrek-timeline.store') }}"
               method="POST">
               @csrf
               @if (isset($data))
                  @method('PUT')
               @endif

               <div class="row g-3">
                  <div class="col-md-6">
                     <label class="form-label">Nama Tahap <span class="text-danger">*</span></label>
                     <input type="text" name="phase_name" class="form-control @error('phase_name') is-invalid @enderror"
                        value="{{ old('phase_name', $data->phase_name ?? '') }}"
                        placeholder="Contoh: Tahap Penjaringan Bakal Calon Rektor" list="phaseList" required>
                     <datalist id="phaseList">
                        @if (isset($phases))
                           @foreach ($phases as $order => $name)
                              <option value="{{ $name }}">
                           @endforeach
                        @endif
                     </datalist>
                     @error('phase_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-6">
                     <label class="form-label">Urutan Tahap <span class="text-danger">*</span></label>
                     <input type="number" name="phase_order"
                        class="form-control @error('phase_order') is-invalid @enderror"
                        value="{{ old('phase_order', $data->phase_order ?? 1) }}" min="1" required>
                     @error('phase_order')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <div class="form-text">1 = Penjaringan, 2 = Penyaringan, 3 = Pemilihan, 4 = Pelantikan</div>
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Nama Event <span class="text-danger">*</span></label>
                     <input type="text" name="event_name" class="form-control @error('event_name') is-invalid @enderror"
                        value="{{ old('event_name', $data->event_name ?? '') }}"
                        placeholder="Contoh: Sosialisasi dan Pengumuman" required>
                     @error('event_name')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Deskripsi</label>
                     <textarea name="description" class="form-control @error('description') is-invalid @enderror" rows="3"
                        placeholder="Deskripsi singkat event...">{{ old('description', $data->description ?? '') }}</textarea>
                     @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Tanggal Mulai <span class="text-danger">*</span></label>
                     <input type="date" name="start_date" class="form-control @error('start_date') is-invalid @enderror"
                        value="{{ old('start_date', isset($data) ? $data->start_date->format('Y-m-d') : '') }}" required>
                     @error('start_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Tanggal Selesai</label>
                     <input type="date" name="end_date" class="form-control @error('end_date') is-invalid @enderror"
                        value="{{ old('end_date', isset($data) && $data->end_date ? $data->end_date->format('Y-m-d') : '') }}">
                     @error('end_date')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <div class="form-text">Kosongkan jika hanya 1 hari</div>
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Ikon (Remix Icon)</label>
                     <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror"
                        value="{{ old('icon', $data->icon ?? '') }}" placeholder="ri-calendar-check-line">
                     @error('icon')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <div class="form-text">Referensi: <a href="https://remixicon.com" target="_blank">remixicon.com</a>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive"
                           {{ old('is_active', $data->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Aktif (tampilkan di landing page)</label>
                     </div>
                  </div>
               </div>

               <hr class="my-4">
               <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.pilrek-timeline.index') }}" class="btn btn-outline-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary">
                     <i class="ri-save-line me-1"></i> {{ isset($data) ? 'Perbarui' : 'Simpan' }}
                  </button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
