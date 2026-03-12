@extends('layouts/layoutMaster')

@section('title', isset($data) ? 'Edit Pengumuman' : 'Tambah Pengumuman')

@section('content')
   <div class="container-xxl flex-grow-1 container-p-y">
      <h4 class="fw-bold mb-4">
         <span class="text-muted fw-light">Pilrek / Pengumuman /</span> {{ isset($data) ? 'Edit' : 'Tambah' }}
      </h4>

      <div class="card">
         <div class="card-body">
            <form
               action="{{ isset($data) ? route('admin.pilrek-announcement.update', $data->id) : route('admin.pilrek-announcement.store') }}"
               method="POST">
               @csrf
               @if (isset($data))
                  @method('PUT')
               @endif

               <div class="row g-3">
                  <div class="col-md-12">
                     <label class="form-label">Judul <span class="text-danger">*</span></label>
                     <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                        value="{{ old('title', $data->title ?? '') }}" required>
                     @error('title')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Kategori <span class="text-danger">*</span></label>
                     <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                        <option value="pengumuman"
                           {{ old('category', $data->category ?? '') == 'pengumuman' ? 'selected' : '' }}>Pengumuman
                        </option>
                        <option value="berita" {{ old('category', $data->category ?? '') == 'berita' ? 'selected' : '' }}>
                           Berita</option>
                        <option value="informasi"
                           {{ old('category', $data->category ?? '') == 'informasi' ? 'selected' : '' }}>Informasi</option>
                     </select>
                     @error('category')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">Tanggal Publikasi</label>
                     <input type="datetime-local" name="published_at" class="form-control"
                        value="{{ old('published_at', isset($data) && $data->published_at ? $data->published_at->format('Y-m-d\TH:i') : now()->format('Y-m-d\TH:i')) }}">
                  </div>

                  <div class="col-md-4">
                     <label class="form-label">&nbsp;</label>
                     <div class="d-flex flex-column gap-2">
                        <div class="form-check form-switch">
                           <input class="form-check-input" type="checkbox" name="is_published" value="1"
                              id="isPublished" {{ old('is_published', $data->is_published ?? true) ? 'checked' : '' }}>
                           <label class="form-check-label" for="isPublished">Publikasikan</label>
                        </div>
                        <div class="form-check form-switch">
                           <input class="form-check-input" type="checkbox" name="is_pinned" value="1" id="isPinned"
                              {{ old('is_pinned', $data->is_pinned ?? false) ? 'checked' : '' }}>
                           <label class="form-check-label" for="isPinned">Sematkan di Atas</label>
                        </div>
                     </div>
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Ringkasan (Excerpt)</label>
                     <textarea name="excerpt" class="form-control" rows="2"
                        placeholder="Ringkasan singkat untuk ditampilkan di halaman utama...">{{ old('excerpt', $data->excerpt ?? '') }}</textarea>
                  </div>

                  <div class="col-md-12">
                     <label class="form-label">Konten <span class="text-danger">*</span></label>
                     <textarea name="content" class="form-control @error('content') is-invalid @enderror" rows="12" id="contentEditor"
                        required>{{ old('content', $data->content ?? '') }}</textarea>
                     @error('content')
                        <div class="invalid-feedback">{{ $message }}</div>
                     @enderror
                     <div class="form-text">Mendukung format HTML. Gunakan tag &lt;h4&gt;, &lt;p&gt;, &lt;ul&gt;,
                        &lt;ol&gt; untuk format.</div>
                  </div>
               </div>

               <hr class="my-4">
               <div class="d-flex justify-content-end gap-2">
                  <a href="{{ route('admin.pilrek-announcement.index') }}" class="btn btn-outline-secondary">Batal</a>
                  <button type="submit" class="btn btn-primary"><i class="ri-save-line me-1"></i>
                     {{ isset($data) ? 'Perbarui' : 'Simpan' }}</button>
               </div>
            </form>
         </div>
      </div>
   </div>
@endsection
