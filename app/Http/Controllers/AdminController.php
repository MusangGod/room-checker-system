<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Admin\StoreAdminRequest;
use App\Http\Requests\Admin\UpdateAdminRequest;
use App\Interfaces\AdminRepositoryInterface;
use App\Models\Admin;
use App\Utils\UploadFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class AdminRepositoryInterface
    public function __construct(
        private readonly AdminRepositoryInterface $adminRepositoryInterface,
        private readonly UploadFile $uploadFile
    ) {
    }

    /**
     * Menampilkan daftar resource (admin).
     */
    public function index()
    {
        // Mengambil semua data admin melalui repository
        $admins = $this->adminRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data admin
        return view('dashboard.users.admins.index', compact('admins'));
    }

    /**
     * Menampilkan view create admin
     */
    public function create()
    {
        return view('dashboard.users.admins.create');
    }

    /**
     * Menyimpan resource baru (admin) ke dalam penyimpanan.
     */
    public function store(StoreAdminRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data baru ke dalam variabel
            $newAdmin = $request->validated();
            $newAdmin["status"] = $request->status == 'on' ? true : false;

            $filename = $this->uploadFile->uploadSingleFile($newAdmin["image_path"], "users");
            $newAdmin["image_path"] = $filename;

            $newAdmin["role"] = Role::ADMIN;
            
            // Menyimpan admin baru melalui repository
            $admin = $this->adminRepositoryInterface->store($newAdmin);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "admin berhasil ditambahkan" beserta data admin yang ditambahkan
            return redirect()->route("admins.index")->with('success', 'admin berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'admin gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (admin berdasarkan ID).
     */
    public function show(Admin $admin)
    {
        try {
            // Mengambil data admin berdasarkan ID melalui repository
            $admin = $this->adminRepositoryInterface->getById($admin->id);
            // Mengirim respon sukses dengan data admin
            return view('dashboard.users.admins.show', compact('admin'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

        /**
     * Menampilkan resource yang ditentukan (admin berdasarkan ID).
     */
    public function showJSON(Admin $admin)
    {
        try {
            // Mengambil data admin berdasarkan ID melalui repository
            $admin = $this->adminRepositoryInterface->getById($admin->id);
            // Mengirim respon dengan data admin
            return response()->json([
                "admin" => $admin
            ]);

        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Menampilkan view edit admin
     */
    public function edit(Admin $admin)
    {
        return view('dashboard.users.admins.edit', compact('admin'));
    }

    /**
     * Memperbarui resource yang ditentukan (admin berdasarkan ID).
     */
    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updateAdmin = $request->validated();
            $updateAdmin["status"] = $request->status == 'on' ? true : false;

            if($request->has('image_path')) {
                $this->uploadFile->deleteExistFile($admin->user->image_path);

                $filename = $this->uploadFile->uploadSingleFile($updateAdmin["image_path"], "users");
                $updateAdmin["image_path"] = $filename;
            }

            $updateAdmin["password"] = $request->password ? bcrypt($request->password) : $admin->user->password;

            // Memperbarui admin melalui repository
            $admin = $this->adminRepositoryInterface->update($updateAdmin, $admin);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil update admin" beserta data admin yang diupdate
            return redirect()->route("admins.index")->with('success', 'admin berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'admin gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (admin).
     */
    public function destroy(Admin $admin)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus admin melalui repository
            $admin = $this->adminRepositoryInterface->delete($admin->id);
            // Jika gambar ada, maka dihapus
            // if (File::exists($admin->image_path)) {
            //     File::delete($admin->image_path);
            // }

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil menghapus admin" beserta data admin yang dihapus
            return redirect()->route("admins.index")->with('success', 'admin berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'admin gagal dihapus');
        }
    }
}

