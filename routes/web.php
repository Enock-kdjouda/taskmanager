<?php

use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\InterfaceController;

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Auth\Events\PasswordReset;
use App\Models\User;

// Affiche le formulaire de demande de lien de réinitialisation
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// Traite l'envoi du lien de réinitialisation
Route::post('/forgot-password', function (Request $request) {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
        $request->only('email')
    );

    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// Affiche le formulaire de réinitialisation du mot de passe
Route::get('/reset-password/{token}', function (string $token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// Traite la réinitialisation du mot de passe
Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function (User $user, string $password) {
            $user->forceFill([
                'password' => Hash::make($password)
            ])->setRememberToken(Str::random(60));

            $user->save();

            event(new PasswordReset($user));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('auth.login')->with('status', __($status))
                : back()->withErrors(['email' => [__($status)]]);
})->middleware('guest')->name('password.update');

Route::get('/', function () {
    return view('welcome');
});
// Routes ouvertes à tous les authentifiés
Route::middleware('auth')->group(function(){
    Route::get('/interface', [InterfaceController::class,'index'])->name('interface.index');
    Route::resource('projects', ProjectController::class) ->middleware('role:admin');
    Route::resource('tasks', TaskController::class);
});
Route::middleware('guest')->group(function(){
    Route::view('register','auth.register')->name('auth.register');
    Route::post('register',[RegisterController::class,'register'])->name('auth.register');
    Route::view('login','auth.login')->name('auth.login');
    Route::post('login',[LoginController::class,'login'])->name('auth.login');
  });
Route::delete('logout',[LoginController::class,'logout'])->middleware('auth')->name('auth.logout');  





