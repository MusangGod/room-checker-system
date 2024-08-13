<?php

namespace App\Http\Controllers;

use App\Helpers\ApiResponse;
use App\Http\Requests\Tag\StoreTagRequest;
use App\Http\Requests\Tag\UpdateTagRequest;
use App\Http\Resources\TagResource;
use App\Interfaces\TagRepositoryInterface;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class TagController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class TagRepositoryInterface
    public function __construct(
        private readonly TagRepositoryInterface $tagRepositoryInterface
    ) {
    }

    /**
     * Menampilkan daftar resource (tag).
     */
    public function index()
    {
        // Mengambil semua data tag melalui repository
        $tags = $this->tagRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data tag
        return view('dashboard.tags.index', compact('tags'));
    }

    /**
     * Menampilkan view create tag
     */
    public function create()
    {
        return view('dashboard.tags.create');
    }

    /**
     * Menampilkan view edit tag
     */
    public function edit(Tag $tag)
    {
        return view('dashboard.tags.edit', compact('tag'));
    }

    /**
     * Menyimpan resource baru (tag) ke dalam penyimpanan.
     */
    public function store(StoreTagRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data baru ke dalam variabel
            $newTag = $request->validated();
            // Mengatur slug berdasarkan nama tag
            $newTag["slug"] = str()->slug($newTag["name"]);
            // Menyimpan tag baru melalui repository
            $post = $this->tagRepositoryInterface->store($newTag);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil ditambahkan"
            return redirect()->route("tags.index")->with('success', 'Tag berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Tag gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (tag berdasarkan ID).
     */
    public function show($id)
    {
        try {
            // Mengambil data tag berdasarkan ID melalui repository
            $tag = $this->tagRepositoryInterface->getById($id);

            // Mengirim respon sukses dengan data tag
            return view('dashboard.tags.show', compact('tag'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Memperbarui resource yang ditentukan (tag berdasarkan ID).
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updateTag = $request->validated();
            // Mengatur slug berdasarkan nama tag
            $updateTag["slug"] = str()->slug($updateTag["name"]);

            // Memperbarui tag melalui repository
            $tag = $this->tagRepositoryInterface->update($updateTag, $tag);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil diupdate"
            return redirect()->route("tags.index")->with('success', 'Tag berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Tag gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (tag).
     */
    public function destroy(Tag $tag)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus tag melalui repository
            $tag = $this->tagRepositoryInterface->delete($tag->id);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Tag berhasil dihapus"
            return redirect()->route("tags.index")->with('success', 'Tag berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'Tag gagal dihapus');
        }
    }
}
