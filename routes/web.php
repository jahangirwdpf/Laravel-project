<?php
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontend\WebController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\CategoryController;
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
Route::get('', function () {
    return view('welcome');
});

//  Backend & Users ----------------
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

// Category -------------------
Route::post('/addcat', [CategoryController::class, 'addcat']);
Route::get('/add', [CategoryController::class, 'add']);
Route::get('delete.category/{cat_id}', [CategoryController::class, 'catDelete']);
Route::get('edit.category/{cat_id}', [CategoryController::class, 'editCat']);
Route::post('update.category/{cat_id}', [CategoryController::class, 'update']);
});

// Frontend ----------------
Route::get('/', [WebController::class, 'index']);
Route::get('/singlePost', [WebController::class, 'single']);

// News ------------------
Route::get('/main', [AdminController::class, 'main']);
Route::get('/newsAdd', [UserController::class, 'newsAdd']);
Route::get('/newsView', [UserController::class, 'newsView']);

require __DIR__.'/auth.php';
