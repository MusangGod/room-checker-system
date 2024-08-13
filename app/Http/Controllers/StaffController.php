<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Http\Requests\Staff\StoreStaffRequest;
use App\Http\Requests\Staff\UpdateStaffRequest;
use App\Interfaces\StaffRepositoryInterface;
use App\Models\Staff;
use App\Utils\UploadFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StaffController extends Controller
{
    // Constructor agar kita bisa menggunakan dependency injection untuk class staffRepositoryInterface
    public function __construct(
        private readonly StaffRepositoryInterface $staffRepositoryInterface,
        private readonly UploadFile $uploadFile
    ) {}

    /**
     * Menampilkan daftar resource (staff).
     */
    public function index()
    {
        // Mengambil semua data staff melalui repository
        $staffs = $this->staffRepositoryInterface->getAll();

        // Mengirim respon sukses dengan data staff
        return view('dashboard.users.staff.index', compact('staffs'));
    }

    /**
     * Menampilkan view create staff
     */
    public function create()
    {
        return view('dashboard.users.staff.create');
    }

    /**
     * Menyimpan resource baru (staff) ke dalam penyimpanan.
     */
    public function store(StoreStaffRequest $request)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data baru ke dalam variabel
            $newStaff = $request->validated();
            $newStaff["status"] = $request->status == 'on' ? true : false;

            $filename = $this->uploadFile->uploadSingleFile($newStaff["image_path"], "users");
            $newStaff["image_path"] = $filename;

            $newStaff["role"] = Role::STAFF;
            
            // Menyimpan staff baru melalui repository
            $staff = $this->staffRepositoryInterface->store($newStaff);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "staff berhasil ditambahkan" beserta data staff yang ditambahkan
            return redirect()->route("staffs.index")->with('success', 'staff berhasil ditambahkan');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'staff gagal ditambahkan');
        }
    }

    /**
     * Menampilkan resource yang ditentukan (staff berdasarkan ID).
     */
    public function show(Staff $staff)
    {
        try {
            // Mengambil data staff berdasarkan ID melalui repository
            $staff = $this->staffRepositoryInterface->getById($staff->id);
            // Mengirim respon sukses dengan data staff
            return view('dashboard.users.staff.show', compact('staff'));
        } catch (\Exception $ex) {
            // Mengirim respon error jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return abort(404);
        }
    }

    /**
     * Menampilkan view edit staff
     */
    public function edit(Staff $staff)
    {
        return view('dashboard.users.staff.edit', compact('staff'));
    }

    /**
     * Memperbarui resource yang ditentukan (staff berdasarkan ID).
     */
    public function update(UpdateStaffRequest $request, Staff $staff)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Memvalidasi request dan menyimpan data yang diupdate ke dalam variabel
            $updateStaff = $request->validated();
            $updateStaff["status"] = $request->status == 'on' ? true : false;

            if($request->has('image_path')) {
                $this->uploadFile->deleteExistFile($staff->user->image_path);

                $filename = $this->uploadFile->uploadSingleFile($updateStaff["image_path"], "users");
                $updateStaff["image_path"] = $filename;
            }

            $updateStaff["password"] = $request->password ? bcrypt($request->password) : $staff->user->password;

            // Memperbarui staff melalui repository
            $staff = $this->staffRepositoryInterface->update($updateStaff, $staff);

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil update staff" beserta data staff yang diupdate
            return redirect()->route("staffs.index")->with('success', 'staff berhasil diupdate');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'staff gagal diupdate');
        }
    }

    /**
     * Menghapus resource yang ditentukan (staff).
     */
    public function destroy(Staff $staff)
    {
        // Memulai transaksi database
        DB::beginTransaction();
        try {
            // Menghapus staff melalui repository
            $staff = $this->staffRepositoryInterface->delete($staff->id);
            // Jika gambar ada, maka dihapus
            // if (File::exists($staff->image_path)) {
            //     File::delete($staff->image_path);
            // }

            // Komit transaksi jika berhasil
            DB::commit();
            // mengembalikan response "Berhasil menghapus staff" beserta data staff yang dihapus
            return redirect()->route("staffs.index")->with('success', 'staff berhasil dihapus');
        } catch (\Exception $ex) {
            // Rollback transaksi jika terjadi kesalahan
            DB::rollBack();
            logger($ex->getMessage());
            return back()->with('error', 'staff gagal dihapus');
        }
    }
}
