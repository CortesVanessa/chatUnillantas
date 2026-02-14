<?php

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;

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


////////////////////////

Route::get('/', function () {
    return view('welcome');
});
Auth::routes();


//Route::get('/chatbot', [\App\Http\Controllers\ChatbotController::class, 'index'])->name('chatbot.index');
//Route::post('/chatbot/send', [\App\Http\Controllers\ChatbotController::class, 'send'])->name('chatbot.send');



// Mostrar la vista del chat
use App\Http\Controllers\ChatbotController;
Route::get('/chatbot', [\App\Http\Controllers\ChatbotController::class, 'index'])->name('chatbot.index');

// Enviar mensaje desde el input (AJAX)
Route::post('/chatbot/send', [\App\Http\Controllers\ChatbotController::class, 'send'])->name('chatbot.send');


Route::get('/chat-public', [ChatbotController::class, 'publicChat'])
    ->name('chat.public');

//////////////////////////


Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('/productos', App\Http\Controllers\ProductoController::class);
Route::resource('/servicios', App\Http\Controllers\ServicioController::class);



//Route::resource('/roles', App\Http\Controllers\RoleController::class);
use App\Http\Controllers\UserController;

Route::resource('/sucursales', App\Http\Controllers\SucursaleController::class);
Route::resource('/users', App\Http\Controllers\UserController::class);
//las rutas que se encuentran aqui seran accesibles solo para el usuario administrador 
Route::middleware(['auth', 'is_admin'])->group(function () {
    Route::resource('/users', App\Http\Controllers\UserController::class);
    
    //Route::resource('roles', RoleController::class);
   
    
   

});


Route::resource('/citas', App\Http\Controllers\CitaController::class);
Route::resource('/solicitudes', App\Http\Controllers\SolicitudeController::class);

use App\Http\Controllers\Admin\ChatbotResponseController;

// CHATBOT (ruta pública)
//Route::post('/chatbot', [ChatBotController::class, 'handleMessage']);
//Route::resource('/chatbot', ChatbotResponseController::class);



Route::get('/chat', [ChatBotController::class, 'index']);
Route::post('/chatbot/send', [ChatBotController::class, 'send'])->name('chatbot.send');
;
// PANEL ADMIN (dashboard)
Route::middleware(['auth'])->prefix('dashboard')->group(function () {
    Route::resource('chatbot', ChatbotResponseController::class);

    Route::get('chats', [\App\Http\Controllers\Admin\ChatConversationController::class, 'index'])
        ->name('chats.index');

    Route::get('chats/{session}', [\App\Http\Controllers\Admin\ChatConversationController::class, 'show'])
        ->name('chats.show');
        //Route::get('/chat', function () {
    //return view('chatbot.chat',['messages' => []]);
    
  
});
//});

