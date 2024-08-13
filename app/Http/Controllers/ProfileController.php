<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Profile\UpdateProfileRequest;
use App\Interfaces\UserRepositoryInterface;
use App\Utils\UploadFile;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class UserRepositoryInterface
    public function __construct(
        private readonly UserRepositoryInterface $userRepositoryInterface,
        private readonly UploadFile $uploadFile
    ) {}

    /**
     * Menampilkan halaman profile
     */
    public function index()
    {
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            $user = $this->userRepositoryInterface->getSuperAdminByUserID(auth()->id());
        } else if(auth()->user()->role === Role::ADMIN) {
            $user = $this->userRepositoryInterface->getAdminByUserID(auth()->id());
        } else {
            $user = $this->userRepositoryInterface->getStaffByUserID(auth()->id());
        }
        return view('dashboard.profile.index', compact('user'));
    }

    /**
     * Menampilkan view edit post
     */
    public function edit()
    {
        if(auth()->user()->role === Role::SUPER_ADMIN) {
            $user = $this->userRepositoryInterface->getSuperAdminByUserID(auth()->id());
        } else if(auth()->user()->role === Role::ADMIN) {
            $user = $this->userRepositoryInterface->getAdminByUserID(auth()->id());
        } else {
            $user = $this->userRepositoryInterface->getStaffByUserID(auth()->id());
        }
        return view('dashboard.profile.edit', compact('user'));
    }

    /**
     * Memperbarui resource yang ditentukan (profile berdasarkan ID).
     */
    public function update(UpdateProfileRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updateUser = $request->validated();
            if($request->has('image_path')) {
                $this->uploadFile->deleteExistFile(auth()->user()->image_path);

                $filename = $this->uploadFile->uploadSingleFile($updateUser["image_path"], "users");
                $updateUser["image_path"] = $filename;
            }

            $updateUser["password"] = $request->password ? bcrypt($request->password) : auth()->user()->password;

            // Memperbarui profile melalui repository
            $user = $this->userRepositoryInterface->update($updateUser);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "profile berhasil diupdate"
            return redirect()->route("profile.index")->with('success', 'profile berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'profile gagal diupdate');
        }
    }
}
