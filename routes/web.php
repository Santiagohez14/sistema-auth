<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Mail;
use App\Mail\CodigoVerificacionMail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

// ✅ Ruta de inicio (necesaria para que funcione la raíz /)
Route::get('/', function () {
    return view('welcome');
});

// ✅ Ruta del dashboard
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verificacion.codigo', 'verified'])->name('dashboard');

// ✅ Ruta para probar correo (requiere sesión iniciada)
Route::get('/probar-correo', function () {
    $user = auth()->user();
    $codigo = rand(100000, 999999);

    // Guardar código y bandera de verificación
    Session::put('codigo_verificacion', $codigo);
    Session::put('codigo_verificado', false);

    Mail::to($user->email)->send(new CodigoVerificacionMail($codigo));

    return redirect()->route('verificacion')->with('success', 'Se ha enviado un código a tu correo.');
})->middleware('auth');


// ✅ Rutas para el perfil de usuario
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Rutas de autenticación (login, register, etc.)
require __DIR__.'/auth.php';

// Mostrar formulario
Route::get('/verificacion', function () {
    return view('verificacion-codigo');
})->middleware('auth')->name('verificacion');

// Procesar código
Route::post('/verificar-codigo', function (Request $request) {
    $codigoIngresado = $request->input('codigo');
    $codigoEsperado = Session::get('codigo_verificacion');

    if ($codigoIngresado == $codigoEsperado) {
        Session::forget('codigo_verificacion');
        Session::put('codigo_verificado', true); // ← MARCAMOS QUE YA VERIFICÓ

        return redirect('/dashboard');
    }

    return redirect()->route('verificacion')->with('error', 'El código ingresado no es correcto.');
})->middleware('auth')->name('verificar.codigo');


// Ruta de prueba para verificar si el middleware está bien registrado
Route::get('/prueba-middleware', function () {
    return '✅ Middleware verificacion.codigo fue reconocido correctamente.';
})->middleware('verificacion.codigo');
