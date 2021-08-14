<?php

use App\Http\Controllers\AlbumController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\MatchDetailController;
use App\Http\Controllers\MatchStadiumController;
use App\Http\Controllers\MatchStandingController;
use App\Http\Controllers\MatchTypeController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PhotoController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\StadiumController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\TeamMemberController;
use App\Http\Controllers\TeamPositionController;
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
Route::get('/viewalbums', [FrontController::class, 'viewalbums'])->name('viewalbums');
Route::get('/viewgallery/{id}/{slug}', [FrontController::class, 'viewgallery'])->name('viewgallery');
Route::get('/viewmerch', [FrontController::class, 'viewmerch'])->name('viewmerch');
Route::get('/sliderinfo/{id}/{slug}', [FrontController::class, 'sliderinfo'])->name('sliderinfo');
Route::get('/getmatches', [FrontController::class, 'getmatches'])->name('getmatches');
Route::get('/viewStandings', [FrontController::class, 'viewStandings'])->name('viewStandings');
Route::get('/viewPartners', [FrontController::class, 'viewPartners'])->name('viewPartners');
Route::get('/contactus', [FrontController::class, 'contactus'])->name('contactus');

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

    //Teams
    Route::resource('team', TeamController::class);
    Route::resource('teamposition', TeamPositionController::class);
    Route::resource('teammember', TeamMemberController::class);

    //Albums
    Route::resource('album', AlbumController::class);
    Route::resource('photo', PhotoController::class);

    //Slider
    Route::resource('slider', SliderController::class);

    //Match Type and Stadium
    Route::resource('matchtype', MatchTypeController::class);
    Route::resource('stadium', MatchStadiumController::class);
    Route::resource('match', MatchDetailController::class);
    Route::get('completedmatch', [MatchDetailController::class, 'completedindex'])->name('match.completedindex');
    Route::get('createresult/{id}', [MatchDetailController::class, 'createresult'])->name('match.createresult');
    Route::post('storeresult', [MatchDetailController::class, 'storeresult'])->name('match.storeresult');
    Route::get('editresult/{id}', [MatchDetailController::class, 'editresult'])->name('match.editresult');
    Route::put('updateresult/{id}', [MatchDetailController::class, 'updateresult'])->name('match.updateresult');

    //Standings
    Route::get('standing', [MatchStandingController::class, 'index'])->name('standing.index');
    Route::get('viewStanding', [MatchStandingController::class, 'viewStanding'])->name('standing.viewStanding');
    Route::post('initialize', [MatchStandingController::class, 'initialize'])->name('standing.initialize');
    Route::get('standing/create/{id}', [MatchStandingController::class, 'create'])->name('standing.create');
    Route::post('standing/store', [MatchStandingController::class, 'store'])->name('standing.store');
    Route::get('standing/edit/{id}', [MatchStandingController::class, 'edit'])->name('standing.edit');
    Route::put('standing/update/{id}', [MatchStandingController::class, 'update'])->name('standing.update');
    Route::delete('standing/delete/{id}', [MatchStandingController::class, 'destroy'])->name('standing.destroy');
    Route::delete('standing/deleteall/{id}', [MatchStandingController::class, 'destroyall'])->name('standing.destroyall');

});

