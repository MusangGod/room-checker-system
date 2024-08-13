@extends('layouts.main')
@section('title', 'Detail Postingan')
@section('main')

    <div class="table-wrapper mt-[20px] input-teacher">
        <form class="grid grid-cols-12 gap-4">
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="title" class="text-second mb-1">Title</label>
                <input type="text" class="input-crud" value="{{ $post->title }}" disabled />
            </div>
            <div class="col-span-12 md:col-span-6 flex flex-col">
                <label for="status" class="text-second mb-1">Status</label>
				<input type="text" class="input-crud" value="{{ $post->status->label() }}" disabled />
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="tag_ids" class="text-second mb-1">Tag</label>
				<div class="input-crud">
					@foreach ($post->tags as $tag)
						<span class="bg-purple-100 text-purple-800 text-xs font-medium me-2 px-2 py-1 rounded">
							{{ $tag->name }}
						</span>
					@endforeach
				</div>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="image_path" class="text-second mb-1">Foto Profil</label>
                <label for="image_path" class="d-block mb-3">
                    <img src="{{ asset($post->image_path) }}" class="border"
                        width="300" alt="">
                </label>
            </div>
            <div class="col-span-12 flex flex-col">
                <label for="content" class="text-second mb-1">Content</label>
                <textarea id="content" disabled>{!! $post->content !!}</textarea>
            </div>
            <div class="col-span-12 flex items-center gap-3 mt-2">
				<a href="{{ route('posts.index') }}" class="button btn-second text-white" type="reset">Kembali</a>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script>
        let content = new RichTextEditor("#content");
		content.setReadOnly(true);
    </script>
@endpush
