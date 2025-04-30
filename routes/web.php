<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\TestMail; // Asegúrate de tener esta clase de correo configurada

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Ruta para probar el envío de correo
Route::get('/probar-correo', function () {
    $user = auth()->user(); // Obtener al usuario autenticado
    
    // Aquí puedes enviar un correo a ese usuario (o a cualquier otro)
    Mail::to($user->email)->send(new TestMail($user)); // Usando un correo de prueba (TestMail)
    
    return 'Correo enviado con éxito a ' . $user->email;
})->middleware('auth'); // Solo los usuarios autenticados pueden acceder a esta ruta

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
