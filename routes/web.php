<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PublicFormController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/forms/{form:slug}', [PublicFormController::class, 'show'])->name('public.form.show');
Route::post('/forms/{form:slug}', [PublicFormController::class, 'store'])->name('public.form.store');
Route::get('/forms/{form:slug}/thanks', [PublicFormController::class, 'thanks'])->name('public.form.thanks');

