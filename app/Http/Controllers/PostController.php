<?php

namespace App\Http\Controllers;

use App\Http\Requests\Post\StorePostRequest;
use App\Http\Requests\Post\UpdatePostRequest;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Post;
use App\Utils\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class PostController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class PostRepositoryInterface
    public function __construct(
        private readonly PostRepositoryInterface $postRepositoryInterface,
        private readonly TagRepositoryInterface $tagRepositoryInterface,
        private readonly UploadFile $uploadFile
    ) {}

    /**
     * Menampilkan daftar resource (postingan).
     */
    public function index()
    {
        // Mengambil semua data postingan melalui repository
        $posts = $this->postRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data postingan
        return view('dashboard.posts.index', compact('posts'));
    }

    /**
     * Menampilkan view create post
     */
    public function create()
    {
        $tags = $this->tagRepositoryInterface->getAll();
        return view('dashboard.posts.create', compact('tags'));
    }

    /**
     * Menampilkan view edit post
     */
    public function edit(Post $post)
    {
        $tags = $this->tagRepositoryInterface->getAll();
        return view('dashboard.posts.edit', compact('post', 'tags'));
    }

    /**
     * Menyimpan resource baru (postingan) ke dalam penyimpanan.
     */
    public function store(StorePostRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data baru ke dalam variabel
            $newPost = $request->validated();
            // Mengatur slug berdasarkan judul postingan
            $newPost["slug"] = str()->slug($newPost["title"]);
            // Menyimpan ID pengguna yang sedang login
            $newPost["user_id"] = auth()->id();

            $filename = $this->uploadFile->uploadSingleFile($newPost["image_path"], "posts");
            $newPost["image_path"] = $filename;

            // Menyimpan postingan baru melalui repository
            $post = $this->postRepositoryInterface->store($newPost);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Postingan berhasil ditambahkan" beserta data postingan yang ditambahkan
            return redirect()->route("posts.index")->with('success', 'Postingan berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Postingan gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (postingan berdasarkan ID).
     */
    public function show($id)
    {
        try {
            // Mengambil data postingan berdasarkan ID melalui repository
            $post = $this->postRepositoryInterface->getById($id);

            // Mengirim respon sukses dengan data postingan
            return view('dashboard.posts.show', compact('post'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Memperbarui resource yang ditentukan (postingan berdasarkan ID).
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updatePost = $request->validated();
            // Mengatur slug berdasarkan judul postingan
            $updatePost["slug"] = str()->slug($updatePost["title"]);

            if($request->has('image_path')) {
                $this->uploadFile->deleteExistFile($post->image_path);

                $filename = $this->uploadFile->uploadSingleFile($updatePost["image_path"], "posts");
                $updatePost["image_path"] = $filename;
            }

            // Memperbarui postingan melalui repository
            $post = $this->postRepositoryInterface->update($updatePost, $post);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil update postingan" beserta data postingan yang diupdate
            return redirect()->route("posts.index")->with('success', 'Postingan berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Postingan gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (postingan).
     */
    public function destroy(Post $post)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus postingan melalui repository
            $post = $this->postRepositoryInterface->delete($post->id);
            // Jika gambar ada, maka dihapus
            if (File::exists($post->image_path)) {
                File::delete($post->image_path);
            }

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil menghapus postingan" beserta data postingan yang dihapus
            return redirect()->route("posts.index")->with('success', 'Postingan berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Postingan gagal dihapus');
        }
    }
}

