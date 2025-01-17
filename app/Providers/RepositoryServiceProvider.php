<?php

namespace App\Providers;

use App\Interfaces\AdminRepositoryInterface;
use App\Interfaces\PostRepositoryInterface;
use App\Interfaces\RoomCategoryRepositoryInterface;
use App\Interfaces\RoomCheckerRepositoryInterface;
use App\Interfaces\RoomRepositoryInterface;
use App\Interfaces\StaffRepositoryInterface;
use App\Interfaces\TagRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Repositories\AdminRepository;
use App\Repositories\PostRepository;
use App\Repositories\RoomCategoryRepository;
use App\Repositories\RoomCheckerRepository;
use App\Repositories\RoomRepository;
use App\Repositories\StaffRepository;
use App\Repositories\TagRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */

    // Fungsi register ini digunakan untuk mengikat interface ke implementasi yang spesifik dalam konteks Dependency Injection (DI) di framework Laravel.
    // Ketika sebuah objek memerlukan object tersebut, Laravel akan memberikan instance dari object yang terkait.
    public function register(): void
    {
        // Mendaftarkan PostRepositoryInterface untuk diimplementasikan oleh PostRepository
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        // Mendaftarkan TagRepositoryInterface untuk diimplementasikan oleh TagRepository
        $this->app->bind(TagRepositoryInterface::class, TagRepository::class);
        // Mendaftarkan AdminRepositoryInterface untuk diimplementasikan oleh AdminRepository
        $this->app->bind(AdminRepositoryInterface::class, AdminRepository::class);
        // Mendaftarkan StaffRepositoryInterface untuk diimplementasikan oleh StaffRepository
        $this->app->bind(StaffRepositoryInterface::class, StaffRepository::class);
        // Mendaftarkan UserRepositoryInterface untuk diimplementasikan oleh UserRepository
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // Mendaftarkan UserRepositoryInterface untuk diimplementasikan oleh UserRepository
        $this->app->bind(RoomCategoryRepositoryInterface::class, RoomCategoryRepository::class);
        $this->app->bind(RoomRepositoryInterface::class, RoomRepository::class);
        $this->app->bind(RoomCheckerRepositoryInterface::class, RoomCheckerRepository::class);
    }


    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
