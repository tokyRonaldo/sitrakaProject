<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomRegisterController;

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

Route::get('/', function () {
    return view('welcome');
});
// Route::get('/register', [CustomRegisterController::class, 'showRegistrationForm'])->name('register');
// Route::get('/login', [App\Http\Controllers\AuthController::class, 'showLoginForm'])->name('login');
Auth::routes();

Route::post('/authenticate', [App\Http\Controllers\Auth\LoginController::class, 'authenticate'])->name('authenticate');


//common route
Route::middleware(['auth'])->group(function () {
    // Route::get('/logout', 'LogoutController@logout')->name('logout');
    Route::get('/logout', [App\Http\Controllers\LogoutController::class, 'perform'])->name('logout'); 
    
    //home
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home'); 
    
    //produit
    // Route::get('/produit', [App\Http\Controllers\ProduitController::class, 'index'])->name('produit_index'); 
    // Route::get('/produit/create', [App\Http\Controllers\ProduitController::class, 'create'])->name('produit_create'); 
    // Route::post('/produit/update/{id}', [App\Http\Controllers\ProduitController::class, 'update'])->name('produit_update'); 
    // Route::post('/produit/store', [App\Http\Controllers\ProduitController::class, 'store'])->name('produit_store'); 
    // Route::get('/produit/get-produit-row', [App\Http\Controllers\ProduitController::class, 'getProduitRow'])->name('get_produit_row'); 
    // Route::get('/produit/list-produits', [App\Http\Controllers\ProduitController::class, 'listProduit'])->name('list_produit'); 
    // Route::get('/produit/edit/{id}', [App\Http\Controllers\ProduitController::class, 'edit'])->name('produit_edit'); 
    // Route::get('/produit/show/{id}', [App\Http\Controllers\ProduitController::class, 'show'])->name('produit_show'); 
    // Route::get('/produit/destroy/{id}', [App\Http\Controllers\ProduitController::class, 'destroy'])->name('produit_destroy');
    
    //role
    // Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role_index'); 
    // Route::get('/role/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role_create'); 
    // Route::post('/role/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role_update'); 
    // Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role_store'); 
    // Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role_edit'); 
    // Route::get('/role/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('role_show'); 
    // Route::get('/role/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role_destroy');

    //user
    // Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user_index'); 
    // Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user_create'); 
    // Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user_update'); 
    // Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user_store'); 
    // Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user_edit'); 
    // Route::get('/user/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user_show'); 
    // Route::get('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_destroy');

    //client
    Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client_index'); 
    Route::get('/client/create', [App\Http\Controllers\ClientController::class, 'create'])->name('client_create'); 
    Route::get('/client/create-modal', [App\Http\Controllers\ClientController::class, 'createModal'])->name('client_create_modal'); 
    Route::post('/client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client_update'); 
    Route::post('/client/store', [App\Http\Controllers\ClientController::class, 'store'])->name('client_store'); 
    // Route::get('/client/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('client_edit'); 
    Route::get('/client/show/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('client_show'); 
    // Route::get('/client/destroy/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client_destroy');

    //sell
    Route::get('/sell', [App\Http\Controllers\SellController::class, 'index'])->name('sell_index'); 
    Route::get('/sell/create', [App\Http\Controllers\SellController::class, 'create'])->name('sell_create'); 
    Route::get('/sell/sell-pdf/{id}', [App\Http\Controllers\SellController::class, 'SellPdf'])->name('sell_pdf'); 
    Route::get('/sell/print-invoice/{id}', [App\Http\Controllers\SellController::class, 'printInvoice'])->name('print_invoice'); 
    // Route::post('/sell/update/{id}', [App\Http\Controllers\SellController::class, 'update'])->name('sell_update'); 
    Route::post('/sell/store', [App\Http\Controllers\SellController::class, 'store'])->name('sell_store'); 
    // Route::get('/sell/edit/{id}', [App\Http\Controllers\SellController::class, 'edit'])->name('sell_edit'); 
    Route::get('/sell/show/{id}', [App\Http\Controllers\SellController::class, 'show'])->name('sell_show'); 
    // Route::get('/sell/destroy/{id}', [App\Http\Controllers\SellController::class, 'destroy'])->name('sell_destroy');


});


Route::middleware(['role:admin'])->group(function() {
    /**
    * Logout Route
    */

    Route::get('/sell/edit/{id}', [App\Http\Controllers\SellController::class, 'edit'])->name('sell_edit'); 
    Route::get('/sell/show/{id}', [App\Http\Controllers\SellController::class, 'show'])->name('sell_show'); 
    Route::get('/sell/destroy/{id}', [App\Http\Controllers\SellController::class, 'destroy'])->name('sell_destroy');

    Route::get('/produit', [App\Http\Controllers\ProduitController::class, 'index'])->name('produit_index'); 
    Route::get('/produit/create', [App\Http\Controllers\ProduitController::class, 'create'])->name('produit_create'); 
    Route::post('/produit/update/{id}', [App\Http\Controllers\ProduitController::class, 'update'])->name('produit_update'); 
    Route::post('/produit/store', [App\Http\Controllers\ProduitController::class, 'store'])->name('produit_store'); 
    Route::get('/produit/get-produit-row', [App\Http\Controllers\ProduitController::class, 'getProduitRow'])->name('get_produit_row'); 
    Route::get('/produit/list-produits', [App\Http\Controllers\ProduitController::class, 'listProduit'])->name('list_produit'); 
    Route::get('/produit/edit/{id}', [App\Http\Controllers\ProduitController::class, 'edit'])->name('produit_edit'); 
    Route::get('/produit/destroy/{id}', [App\Http\Controllers\ProduitController::class, 'destroy'])->name('produit_destroy');

        Route::get('/user', [App\Http\Controllers\UserController::class, 'index'])->name('user_index'); 
    Route::get('/user/create', [App\Http\Controllers\UserController::class, 'create'])->name('user_create'); 
    Route::post('/user/update/{id}', [App\Http\Controllers\UserController::class, 'update'])->name('user_update'); 
    Route::post('/user/store', [App\Http\Controllers\UserController::class, 'store'])->name('user_store'); 
    Route::get('/user/edit/{id}', [App\Http\Controllers\UserController::class, 'edit'])->name('user_edit'); 
    Route::get('/user/show/{id}', [App\Http\Controllers\UserController::class, 'show'])->name('user_show'); 
    Route::get('/user/destroy/{id}', [App\Http\Controllers\UserController::class, 'destroy'])->name('user_destroy');

        Route::get('/role', [App\Http\Controllers\RoleController::class, 'index'])->name('role_index'); 
    Route::get('/role/create', [App\Http\Controllers\RoleController::class, 'create'])->name('role_create'); 
    Route::post('/role/update/{id}', [App\Http\Controllers\RoleController::class, 'update'])->name('role_update'); 
    Route::post('/role/store', [App\Http\Controllers\RoleController::class, 'store'])->name('role_store'); 
    Route::get('/role/edit/{id}', [App\Http\Controllers\RoleController::class, 'edit'])->name('role_edit'); 
    Route::get('/role/show/{id}', [App\Http\Controllers\RoleController::class, 'show'])->name('role_show'); 
    Route::get('/role/destroy/{id}', [App\Http\Controllers\RoleController::class, 'destroy'])->name('role_destroy');


        Route::get('/client/update/{id}', [App\Http\Controllers\ClientController::class, 'update'])->name('client_update'); 
    Route::get('/client/edit/{id}', [App\Http\Controllers\ClientController::class, 'edit'])->name('client_edit'); 
    Route::get('/client/show/{id}', [App\Http\Controllers\ClientController::class, 'show'])->name('client_show'); 
    Route::get('/client/destroy/{id}', [App\Http\Controllers\ClientController::class, 'destroy'])->name('client_destroy');


});


