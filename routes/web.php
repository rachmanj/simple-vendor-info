<?php


use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LegalitasTypeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SpecificationController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'index'])->name('login');
    Route::post('/login', [LoginController::class, 'authenticate'])->name('authenticate');

    Route::get('/register', [RegisterController::class, 'index'])->name('register');
    Route::post('/register', [RegisterController::class, 'store'])->name('register.store');
});

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return redirect()->route('dashboard.index');
    });

    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

    // USERS
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('data', [UserController::class, 'data'])->name('data');
        Route::put('activate/{id}', [UserController::class, 'activate'])->name('activate');
        Route::put('deactivate/{id}', [UserController::class, 'deactivate'])->name('deactivate');
        Route::put('roles-update/{id}', [UserController::class, 'roles_user_update'])->name('roles_user_update');
    });

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);

    // DASHBOARD
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        Route::get('/', [DashboardController::class, 'index'])->name('index');
    });

    // SUPPLIERS
    Route::prefix('suppliers')->name('suppliers.')->group(function () {
        Route::get('data', [SupplierController::class, 'data'])->name('data');
        Route::get('/{supplier_id}/legalitas', [SupplierController::class, 'legalitas'])->name('legalitas');
        Route::post('/{supplier_id}/legalitas/store', [SupplierController::class, 'legalitas_store'])->name('legalitas.store');
        Route::put('/legalitas/{document_id}/update', [SupplierController::class, 'legalitas_update'])->name('legalitas.update');
        Route::delete('/legalitas/{document_id}/delete', [SupplierController::class, 'legalitas_destroy'])->name('legalitas.destroy');
        Route::post('/contact/store', [SupplierController::class, 'contact_store'])->name('contact.store');
        Route::put('/contact/{contact_id}/update', [SupplierController::class, 'contact_update'])->name('contact.update');
        Route::delete('/contact/{contact_id}/delete', [SupplierController::class, 'contact_destroy'])->name('contact.destroy');
        Route::post('/branch/store', [SupplierController::class, 'branch_store'])->name('branch.store');
        Route::put('/branch/{branch_id}/update', [SupplierController::class, 'branch_update'])->name('branch.update');
        Route::delete('/branch/{branch_id}/delete', [SupplierController::class, 'branch_destroy'])->name('branch.destroy');
    });
    Route::resource('suppliers', SupplierController::class);

    // BRANCHES
    Route::resource('branches', BranchController::class);

    // SPECIFICATIONS
    Route::prefix('specifications')->name('specifications.')->group(function () {
        Route::get('data', [SpecificationController::class, 'data'])->name('data');
    });
    Route::resource('specifications', SpecificationController::class);

    // LEGALITAS TYPES
    Route::prefix('legalitas_types')->name('legalitas_types.')->group(function () {
        Route::get('data', [LegalitasTypeController::class, 'data'])->name('data');
    });
    Route::resource('legalitas_types', LegalitasTypeController::class);
});
