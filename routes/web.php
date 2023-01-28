<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TicketController;
use Illuminate\Support\Facades\Auth;


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

Route::middleware('banned')->group(function () {
    Route::middleware('auth')->group(function () {
        Route::middleware('admin')->prefix('/panel')->name('panel')->group(function () {
            Route::prefix('/users')->name('.users')->group(function () {
                Route::controller(AdminController::class)->group(function () {
                    Route::post('/restore/{id}', 'restoreUser')->name('.restore');
                    Route::post('/delete/{id}', 'deleteUser')->name('.delete');
                    Route::post('/forceDelete/{id}', 'forceDeleteUser')->name('.forceDelete');
                    Route::post('/edit/{id}', 'editUser');
                    Route::post('/ban/{id}', 'banUser')->name('.ban');
                    Route::post('/unban/{id}', 'unbanUser')->name('.unban');
                });

                Route::controller(PagesController::class)->group(function () {
                    Route::get('/edit/{id}',  'editUser')->name('.edit');
                    Route::get('',  'usersPanel');
                });
            });

            Route::prefix('/tickets')->name('.tickets')->group(function () {
                Route::controller(PagesController::class)->group(function () {
                    Route::get('/view/{id}', 'panelTicketSee')->name('.see');
                    Route::get('', 'panelTickets');
                });

                Route::controller(AdminController::class)->group(function () {
                    Route::post('/edit/{id}', 'editTicket')->name('.edit');
                    Route::post('/close/{id}', 'closeTicket')->name('.close');
                });
            });

            Route::get('', [PagesController::class, 'panel']);
        });

        Route::name('settings')->prefix('/settings')->group(function () {
            Route::name('.edit.')->prefix('/edit')->group(function () {
                Route::controller(PagesController::class)->group(function () {
                    Route::get('/firstName', 'editFirstName')->name('firstName');
                    Route::get('/lastName', 'editLastName')->name('lastName');
                    Route::get('/username', 'editUsername')->name('username');
                    Route::get('/email', 'editEmail')->name('email');
                    Route::get('/password', 'editPassword')->name('password');
                });

                Route::controller(UserController::class)->group(function () {
                    Route::post('/firstName', 'editFirstName');
                    Route::post('/lastName', 'editLastName');
                    Route::post('/username', 'editUsername');
                    Route::post('/email', 'editEmail');
                    Route::post('/password', 'editPassword');
                });
            });

            Route::get('', [PagesController::class, 'settings']);
        });

        Route::prefix('/ticket')->name('ticket.')->group(function () {
            Route::controller(PagesController::class)->group(function () {
                Route::get('/view/{id}', [PagesController::class, 'ticketSee'])->name('see');
                Route::get('/create', [PagesController::class, 'ticketCreate'])->name('create');
            });

            Route::controller(TicketController::class)->group(function () {
                Route::post('/create', 'create');
                Route::post('/edit/{id}', 'edit')->name('edit');
                Route::post('/close/{id}', 'close')->name('close');
                Route::get('/delete/{id}', 'delete')->name('delete');
            });
        });

        Route::get('/support', [PagesController::class, 'support'])->name('support');
    });

    Route::controller(PagesController::class)->group(function () {
        Route::get('/terms', 'terms')->name('terms');
        Route::get('/contact', 'contact')->name('contact');
        Route::get('/cookies', 'cookies')->name('cookies');
    });

    Auth::routes();

    Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});