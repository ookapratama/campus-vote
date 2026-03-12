@extends('layouts/layoutMaster')

@section('title', isset($data) ? 'Edit Kandidat' : 'Tambah Kandidat')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold mb-4">
         <span class="text-muted fw-light">Pilrek / Bakal Calon /</span> {{ isset($data) ? 'Edit' : 'Tambah' }}
      </h4>

      <div class="card">
         <div class="card-body">
            <form
               action="{{ isset($data) ? route('admin.pilrek-candidate.update', $data->id) : route('admin.pilrek-candidate.store') }}"
               method="POST" enctype="multipart/form-data">
               @csrf
               @if (isset($data))
                  @method('PUT')
               @endif

               <div class="row g-3">
                  <div class="col-md-4">
                     <label class="form-label">Gelar / Title</label>
                     <input type="text" name="title" class="form-control"
                        value="{{ old('title', $data->title ?? '') }}" placeholder="Prof. Dr.">
                  </div>
                  <div class="col-md-8">
                     <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                     <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                        value="{{ old('name', $data->name ?? '') }}" required>
                     @error('name')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">Jabatan Saat Ini</label>
                     <input type="text" name="position" class="form-control"
                        value="{{ old('position', $data->position ?? '') }}" placeholder="Dekan Fakultas...">
                  </div>
                  <div class="col-md-3">
                     <label class="form-label">Urutan</label>
                     <input type="number" name="order" class="form-control"
                        value="{{ old('order', $data->order ?? 0) }}" min="0">
                  </div>
                  <div class="col-md-3">
                     <label class="form-label">Foto</label>
                     <input type="file" name="photo" class="form-control" accept="image/*">
                     @if (isset($data) && $data->photo)
                        <div class="mt-2 text-center border rounded p-1" style="width: 100px;">
                           <img src="{{ $data->photo_url }}" class="img-fluid rounded" style="max-height: 100px;">
                        </div>
                        <small class="text-muted">Foto saat ini terunggah. Upload baru untuk mengganti.</small>
                     @endif
                  </div>
                  <div class="col-md-12">
                     <label class="form-label">Biografi Singkat</label>
                     <textarea name="bio" class="form-control" rows="3">{{ old('bio', $data->bio ?? '') }}</textarea>
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">Visi</label>
                     <textarea name="vision" class="form-control" rows="4">{{ old('vision', $data->vision ?? '') }}</textarea>
                  </div>
                  <div class="col-md-6">
                     <label class="form-label">Misi</label>
                     <textarea name="mission" class="form-control" rows="4">{{ old('mission', $data->mission ?? '') }}</textarea>
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
                  <a href="{{ route('admin.pilrek-candidate.index') }}" class="btn btn-outline-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>
                     {{ isset($data) ? 'Perbarui' : 'Simpan' }}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
