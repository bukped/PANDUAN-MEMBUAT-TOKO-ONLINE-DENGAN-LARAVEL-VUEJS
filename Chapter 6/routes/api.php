<?php
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Expose-Headers: Origin, Content-Type, X-Auth-Token, Authorization, Accept,charset,boundary,Content-Length');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Headers: *');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ProductController;
use App\Http\Controllers\API\CheckoutController;
use App\Http\Controllers\API\CustomersController;
use App\Http\Controllers\API\HistoryController;
use App\Http\Controllers\API\FileUploadController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [CustomersController::class, 'register']);

Route::post('/login', [CustomersController::class, 'login']);

Route::post('/logout', [CustomersController::class, 'logout']);

// Route::post('/login', 'App\Http\Controllers\API\CustomersController@login');

// Route::post('/register', 'App\Http\Controllers\API\CustomersController@register');


Route::get('/products', 'App\Http\Controllers\API\ProductController@all');

Route::post('/checkout', 'App\Http\Controllers\API\CheckoutController@checkout');

Route::get('/transactions/{id}', 'App\Http\Controllers\API\TransactionController@get');

Route::get('/history/{id}', [HistoryController::class, 'history']);
Route::get('/historyDetail/{id}', [HistoryController::class, 'historyDetail']);

Route::post('/updateProfile/{id}', [CustomersController::class, 'updateProfile']);

Route::get('/getProfileById/{id}', [CustomersController::class, 'getProfileById']);

Route::post('/store_file', [FileUploadController::class, 'fileStore']);

// Route::get('products', [API\ProductController::class, 'all']);
