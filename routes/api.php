<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/user',function(Request $request){
//     return "Hello World";
// });

// Route::post('/example', function () {
//     return response()->json([
//         'message' => 'Hello, this is a JSON response!',
//         'status' => 'success',
//         'data' => [
//             'item1' => 'value1',
//             'item2' => 'value2',
//         ],
//     ]);
// });

// Route::delete('user/{id}',function($id){
//     return response($id,200);
// });

Route::Post('User/Store','App\Http\Controllers\Api\UserController@Store');

Route::get('/test',function(){
    p("Running");
});
Route::post('/todo/add', [TaskController::class, 'addTask']);
Route::post('/login', [UserController::class, 'login']);
Route::post('/todo/status', [TaskController::class, 'changeStatus']);
Route::get('/todo/tasks', [TaskController::class, 'getTasks']);
Route::get('/todo/tasks/{user_id}', [TaskController::class, 'getUserTasks']);
Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);