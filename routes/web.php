<?php

use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [FrontController::class, 'index'])->name('index');
Route::get('/getnews', [FrontController::class, 'getnews'])->name('getnews');
Route::get('/gettagnews/{id}/{slug}', [FrontController::class, 'gettagnews'])->name('gettagnews');
Route::get('/getauthornews/{name}', [FrontController::class, 'getauthornews'])->name('getauthornews');
Route::get('/newsdetails/{id}/{slug}', [FrontController::class, 'newsdetails'])->name('newsdetails');
Route::get('/search', [FrontController::class, 'pageSearch'])->name('page.search');
Route::get('/aboutus', [FrontController::class, 'aboutus'])->name('aboutus');
Route::get('/teaminfo', [FrontController::class, 'teaminfo'])->name('teaminfo');
Route::post('/comments/add', [FrontController::class, 'addComment'])->name('page.comment');
Route::post('/reply/add', [FrontController::class, 'addReply'])->name('page.reply');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

 Route::group(['middleware' => ['auth']], function() {
    Route::resource('user', UserController::class);
    Route::resource('permission', PermissionController::class);
    Route::resource('role', RoleController::class);
    // Route::resource('category', CategoryController::class);
    // Route::resource('subcategory', SubcategoryController::class);
    // Route::resource('vendor', VendorController::class);
    // Route::resource('product', ProductController::class);

    //Blogs
    Route::resource('blog', BlogController::class);
    Route::get('draftblog', [BlogController::class, 'draftblog'])->name('draftblog.index');
    Route::get('draftblog/{id}/edit', [BlogController::class, 'draftblogedit'])->name('draftblog.edit');
    Route::put('draftblog/{id}/update', [BlogController::class, 'draftblogupdate'])->name('draftblog.update');
    Route::delete('draftblog/{id}/delete', [BlogController::class, 'draftblogdestroy'])->name('draftblog.destroy');

    //Settings
    Route::resource('setting', SettingController::class);

    //Comments
    Route::resource('comment', CommentController::class);
    Route::get('reply/{id}', [CommentController::class, 'viewreplies'])->name('comment.reply');
    Route::put('disablecomment/{id}', [CommentController::class, 'disablecomment'])->name('comment.disablecomment');
    Route::put('enablecomment/{id}', [CommentController::class, 'enablecomment'])->name('comment.enablecomment');
    Route::put('disablereply/{id}', [CommentController::class, 'disablereply'])->name('comment.disablereply');
    Route::put('enablereply/{id}', [CommentController::class, 'enablereply'])->name('comment.enablereply');

});

