<?php

use Illuminate\Support\Facades\Route;

use function Pest\Laravel\patch;

Route::get('/', function () {
return response()->file(base_path('public/frontend/index.html'));
});

Route::get('/{any}', function ($any){
    $path = base_path("public/frontend/$any");
    if (file_exists($path)){
        return response()->file($path);
    }
    abort(404);
})->where('any','.*');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
