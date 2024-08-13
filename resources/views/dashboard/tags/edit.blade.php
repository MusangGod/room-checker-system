@extends('layouts.main')
@section('title', 'Edit Postingan')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form action="{{ route('posts.update', $post->id) }}" method="post" enctype="multipart/form-data" class="grid grid-cols-12 gap-4">
            @csrf
            @method('PUT')
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="title" class="text-second mb-1">Title</label>
                <input type="text" class="input-crud" name="title" id="title" value="{{ old('title', $post->title) }}"
                    placeholder="Masukkan Judul Postingan..." required />
                @error('title')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="status" class="text-second mb-1">Status</label>
                <select name="status" id="status" required>
                    <option value="1" {{ $post->status->value == 1 ? 'selected': '' }}>Draft</option>
                    <option value="2" {{ $post->status->value == 2 ? 'selected': '' }}>Published</option>
                </select>
                @error('status')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="tag_ids" class="text-second mb-1">Tag</label>
                <select name="tag_ids[]" id="tag_ids" required multiple>
                    @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}" 
                        {{ (collect(old('tag_ids'))->contains($tag->id) || $post->tags->contains('id', $tag->id)) ? 'selected' : '' }}>
                        {{ $tag->name }}
                    </option>
                    @endforeach
                </select>
                @error('tag_ids')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image_path" class="text-second mb-1">Foto Profil</label>
                <label for="image_path" class="d-block mb-3">
                    @if ($post->image_path)
                        <img src="{{ asset($post->image_path) }}" class="edit-post-preview-img border"
                        width="300" alt="">
                    @else
                        <img src="{{ asset('assets/img/upload-image.jpg') }}" class="edit-post-preview-img border"
                        width="300" alt="">
                    @endif
                </label>
                <input type="file" id="image_path" name="image_path"
                    class="input-crud py-0 edit-post-input hidden" />
                <label for="image_path" class="button btn-second text-center w-[300px]">Upload File</label>
                @error('image_path')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="content" class="text-second mb-1">Content</label>
                <textarea name="content" id="content" required>{!! old('content', $post->content) !!}</textarea>
                @error('content')
                    <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
                <button class="button btn-main" type="submit">Update Postingan</button>
                <a href="{{ route('posts.index') }}" class="button btn-second text-white" type="reset">Batal
                    Tambah</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        previewImg("edit-post-input", "edit-post-preview-img")
        $("#status").select2()
        $("#tag_ids").select2()
        let content = new RichTextEditor("#content");
    </script>
@endpush
