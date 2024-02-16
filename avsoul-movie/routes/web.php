<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\DashboardController;
use App\Http\Controllers\admin\MovieController;
use Illuminate\Routing\RouteGroup;
use App\Http\Controllers\client\HomeController;
use App\Http\Controllers\admin\GenresController;
use App\Http\Controllers\admin\UserController;
use App\Http\Controllers\Auth\ProviderAuthenticationController;
use App\Http\Controllers\Auth\AuthenticationController;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\client\MovieController as ClientMovieController;
use App\Http\Controllers\admin\ViewersController;
use App\Http\Controllers\admin\ReviewController;
use App\Http\Controllers\admin\CommentController;

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

//Config for Authenticate
Route::get('/auth/signin', [ProviderAuthenticationController::class, 'Index'])->name('signin');
Route::get('/auth/identity/login', [AuthenticationController::class, 'Index'])->name('login');

Route::get('/auth/{socialite}/redirect', [ProviderAuthenticationController::class, 'redirect'])->name('provider.redirect');
Route::get('/auth/{socialite}/callback', [ProviderAuthenticationController::class, 'callback'])->name('provider.callback');
Route::get('/auth/logout', [ProviderAuthenticationController::class, 'logout'])->name('logout');

Route::get('/auth/{socialite}/redirect', [AuthenticationController::class, 'redirect'])->name('authentication');
Route::get('/auth/{socialite}/callback', [AuthenticationController::class, 'callback'])->name('authentication.callback');
Route::get('/auth/administrator/logout', [AuthenticationController::class, 'logout'])->name('logout-administrator');


//Config routes for admin
Route::prefix('administrator')->group(function () {
    Route::middleware(['check.role:1,2,3'])->group(function () {
        Route::get('/', [DashboardController::class, 'index']);
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

        Route::resource('/movie', MovieController::class);
        Route::resource('/genre', GenresController::class);

        Route::get('/movies/changestatus-{id}-{status}', [MovieController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('movie.changeStatus');

        Route::get('/genres/changestatus-{id}-{status}', [GenresController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('genre.changeStatus');

        Route::resource('genres', GenresController::class);
        Route::resource('movies', MovieController::class);

        Route::middleware(['check.role:1'])->group(function () {
            // Route::get('/users', [UserController::class, 'index'])->name('user.index');
        });

        Route::get('/users', [UserController::class, 'index'])->name('user.index');
        Route::get('/viewers', [ViewersController::class, 'index'])->name('viewers.index');
        Route::get('/comments', [CommentController::class, 'index'])->name('comment.index');
        Route::get('/reviews', [ReviewController::class, 'index'])->name('review.index');

        Route::get('/users/changestatus-{id}-{status}', [UserController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('user.changeStatus');

        Route::get('/users-{id}', [UserController::class, 'show'])->name('user.show');

        Route::post('/users/update-{id}', [UserController::class, 'update'])->name('user.update');


        Route::get('/comments/delete-{id}', [CommentController::class, 'destroy'])->name('comment.destroy');
        Route::get('/comments/changestatus-{id}-{status}', [CommentController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('comment.changeStatus');


        Route::get('/reviews/delete-{id}', [ReviewController::class, 'destroy'])->name('reviews.destroy');
        Route::get('/reviews/changestatus-{id}-{status}', [ReviewController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('reviews.changeStatus');



        Route::get('/viewers/changestatus-{id}-{status}', [ViewersController::class, 'changeStatus'])
        ->where(['id' => '[0-9]+', 'status' => '[0-9]+'])
        ->name('viewers.changeStatus');

        Route::get('/viewers-{id}', [ViewersController::class, 'show'])->name('viewers.show');

    });

});

//Config routes for client
Route::get('/avsoul', [HomeController::class, 'Index']);
Route::get('/avsoul/home', [HomeController::class, 'Index'])->name('home');
Route::get('/movie/{alias}-{id}', [ClientMovieController::class, 'details'])
    ->where('alias', '^[a-z0-9-]+')
    ->where('id', '[0-9]+$')
    ->name('mov.details');

Route::get('/movie/review', [ClientMovieController::class, 'review'])->name('mov.review');
Route::post('/save-comment', [ClientMovieController::class, 'comment'])->name('mov.comment');


Route::post('/check-toxic', [ClientMovieController::class, 'predict'])->name('mov.predict');
Route::post('/check-review-toxic', [ClientMovieController::class, 'predict_'])->name('mov.predict_');

Route::get('/testapi', [ClientMovieController::class, 'showForm']);

Route::get('/auth/profile', [AuthenticationController::class, 'profile'])->name('auth.profile');