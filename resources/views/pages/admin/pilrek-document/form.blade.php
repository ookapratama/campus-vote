@extends('layouts/layoutMaster')

@section('title', isset($data) ? 'Edit Dokumen' : 'Upload Dokumen')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold mb-4">
         <span class="text-muted fw-light">Pilrek / Dokumen /</span> {{ isset($data) ? 'Edit' : 'Upload' }}
      </h4>

      <div class="card">
         <div class="card-body">
            <form
               action="{{ isset($data) ? route('admin.pilrek-document.update', $data->id) : route('admin.pilrek-document.store') }}"
               method="POST" enctype="multipart/form-data">
               @csrf
               @if (isset($data))
                  @method('PUT')
               @endif

               <div class="row g-3">
                  <div class="col-md-8">
                     <label class="form-label">Judul Dokumen <span class="text-danger">*</span></label>
                     <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $data->title ?? '') }}" required>
                     @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Kategori <span class="text-danger">*</span></label>
                     <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="formulir"
                           {{ old('category', $data->category ?? '') == 'formulir' ? 'selected' : '' }}>Formulir</option>
                        <option value="sk" {{ old('category', $data->category ?? '') == 'sk' ? 'selected' : '' }}>Surat
                           Keputusan</option>
                        <option value="peraturan"
                           {{ old('category', $data->category ?? '') == 'peraturan' ? 'selected' : '' }}>Peraturan</option>
                        <option value="lainnya"
                           {{ old('category', $data->category ?? '') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                     </select>
                     @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Deskripsi</label>
                     <textarea name="description" class="form-control" rows="2">{{ old('description', $data->description ?? '') }}</textarea>
                  </div>

                  <div class="col-md-8">
                     <label class="form-label">File {{ isset($data) ? '(kosongkan jika tidak ingin mengubah)' : '' }}
                        @if (!isset($data))
                           <span class="text-danger">*</span>
                        @endif
                     </label>
                     <input type="file" name="file" class="form-control @error('file') is-invalid @enderror"
                        accept=".pdf,.doc,.docx,.xls,.xlsx,.zip,.rar" {{ !isset($data) ? 'required' : '' }}>
                     @error('file')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <div class="form-text">Maksimal 10 MB. Format: PDF, DOC, DOCX, XLS, XLSX, ZIP, RAR.</div>
                     @if (isset($data))
                        <small class="text-muted mt-1 d-block">
                           File saat ini: <strong>{{ $data->file_name }}</strong> ({{ $data->file_size_formatted }})
                        </small>
                     @endif
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Urutan</label>
                     <input type="number" name="order" class="form-control"
                        value="{{ old('order', $data->order ?? 0) }}" min="0">
                  </div>

                  <div class="col-md-12">
                     <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" name="is_active" value="1" id="isActive"
                           {{ old('is_active', $data->is_active ?? true) ? 'checked' : '' }}>
                        <label class="form-check-label" for="isActive">Aktif (tampilkan di landing page untuk
                           diunduh)</label>
                     </div>
                  </div>
               </div>

               <hr class="my-4">
               <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.pilrek-document.index') }}" class="btn btn-outline-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>
                     {{ isset($data) ? 'Perbarui' : 'Upload' }}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
