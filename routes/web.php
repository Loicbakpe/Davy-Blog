<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\TagController as AdminTagController;
use App\Http\Controllers\Admin\CommentController as AdminCommentController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CommentController;
use Illuminate\Support\Facades\Route;

// Frontend Public
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\Admin\SubscriberController as AdminSubscriberController;

Route::get('/sitemap.xml', [SitemapController::class, 'index']);
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/auteur/{user:slug}', [AuthorController::class, 'show'])->name('authors.show');
Route::get('/blog', [PostController::class, 'index'])->name('posts.index');
Route::get('/blog/{post:slug}', [PostController::class, 'show'])->name('posts.show');
Route::get('/category/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');
Route::get('/tag/{tag:slug}', [TagController::class, 'show'])->name('tags.show');

Route::post('/blog/{post:slug}/comments', [CommentController::class, 'store'])->name('posts.comments.store')->middleware('auth');
Route::post('/newsletter', [NewsletterController::class, 'store'])->name('newsletter.store');
Route::view('/a-propos', 'about')->name('about');

// Espace Admin protégé
Route::middleware(['auth', 'verified', AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', AdminCategoryController::class);
    Route::resource('tags', AdminTagController::class);
    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
    Route::patch('comments/{comment}/approve', [AdminCommentController::class, 'approve'])->name('comments.approve');
    Route::resource('users', AdminUserController::class)->except(['show'])->names('users');
    Route::get('subscribers', [AdminSubscriberController::class, 'index'])->name('subscribers.index');
    Route::delete('subscribers/{subscriber}', [AdminSubscriberController::class, 'destroy'])->name('subscribers.destroy');
});

// Profile utilisateur (utilisé par admin et utilisateurs normaux)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
