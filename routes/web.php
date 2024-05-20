<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use PhpParser\Builder\Function_;
use PHPUnit\Framework\Attributes\Group;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('auth.login');
// });

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/logout',[ProfileController::class,'logout'])->name('logout');
});


Route::get('roles/index',[RoleController::class,'index'])->name('roles.index');
Route::middleware('auth')->prefix('role')->group(function () {
        Route::get('roles/create',[RoleController::class,'create'])->name('roles.create');
        Route::post('roles/store',[RoleController::class,'store'])->name('roles.store');
        Route::get('roles/{role}/edit',[RoleController::class,'edit'])->name('roles.edit');
        Route::put('roles/update/{role}',[RoleController::class,'update'])->name('roles.update');
        Route::get('/roles/delete/{role}', [RoleController::class,'destroy'])->name('roles.destroy');
        Route::get('/roles/view/{role}', [RoleController::class,'show'])->name('roles.show');

    });


    Route::middleware('auth')->prefix('user')->group(function () {
        Route::get('/users/index', [UserController::class, 'index'])->name('users.index');
        Route::get('/create/user', [UserController::class, 'create'])->name('users.create');
        Route::post('/store/user', [UserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('users.edit');
        Route::put('/users/update/{user}', [UserController::class, 'update'])->name('users.update');
        Route::get('/users/delete/{user}', [UserController::class, 'destroy'])->name('users.destroy');
        // Route::post('/users/{user}/roles', [UserController::class, 'assignRole'])->name('users.roles');
        // Route::delete('/users/{user}/roles/{role}', [UserController::class, 'removeRole'])->name('users.roles.remove');
        // Route::post('/users/{user}/permissions', [UserController::class, 'givePermission'])->name('users.permissions');
        // Route::delete('/users/{user}/permissions/{permission}', [UserController::class, 'revokePermission'])->name('users.permissions.revoke');
});

require __DIR__.'/auth.php';
