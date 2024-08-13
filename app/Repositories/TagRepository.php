<?php

namespace App\Repositories;

use App\Interfaces\TagRepositoryInterface;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;

class TagRepository implements TagRepositoryInterface
{
   // Fungsi untuk mendapatkan semua data Tag
   public function getAll(): Collection
   {
      // Mengambil semua tag dan mengurutkannya dari yang terbaru
      return Tag::with(["posts"])->latest()->get();
   }

   // Fungsi untuk mendapatkan data Tag berdasarkan ID
   public function getById($id): Tag
   {
      // Mencari tag berdasarkan ID, atau gagal jika tidak ditemukan
      return Tag::findOrFail($id);
   }

   // Fungsi untuk menyimpan data Tag baru
   public function store(array $data): Tag
   {
      // Membuat tag baru dengan data yang diberikan
      return Tag::create($data);
   }

   // Fungsi untuk mengupdate data Tag yang ada
   public function update(array $newData, Tag $tag): Tag
   {
      // Mengupdate tag berdasarkan ID dengan data baru yang diberikan
      $is_updated = Tag::whereId($tag->id)->update($newData);
      // Mengambil tag yang telah diperbarui
      $get_tag = $this->getById($tag->id);
      // Mengembalikan tag yang diperbarui jika berhasil, atau null jika gagal
      return $is_updated ? $get_tag : null;
   }

   // Fungsi untuk menghapus data Tag
   public function delete($id): Tag
   {
      // Mengambil tag berdasarkan ID sebelum dihapus
      $get_tag = $this->getById($id);
      $get_post_tags = PostTag::where('tag_id', $get_tag->id)->get();
      // dd($get_post_tags);
      foreach($get_post_tags as $post_tag) {
         $post_tag->delete();
      }

      // Menghapus tag berdasarkan ID
      $is_deleted = Tag::destroy($id);
      // Mengembalikan tag yang dihapus jika berhasil, atau null jika gagal
      return $is_deleted ? $get_tag : null;
   }
}

