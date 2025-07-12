<?php

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

Route::get('/', function () {
    return view('welcome');
});


Route::get('/test-auth', function () {
    return view('auth-tester');
});


Route::get('/entreprise', function () {
    return view('entreprise');
});


Route::get('/entreprises', function () {
    return view('entreprises.index'); })->name('entreprises.index'); // Liste
Route::get('/entreprises/create', function () {
    return view('entreprises.create'); })->name('entreprises.create'); // Formulaire de création
Route::post('/entreprises', function () {
    return view('entreprises.store'); })->name('entreprises.store'); // Soumission création

Route::get('/entreprises/{id}', function () {
    return view('entreprises.show'); })->name('entreprises.show'); // Affichage d'une entreprise
Route::get('/entreprises/{id}/edit', function () {
    return view('entreprises.edit'); })->name('entreprises.edit'); // Formulaire d’édition
Route::put('/entreprises/{id}', function () {
    return view('entreprises.update'); })->name('entreprises.update'); // Soumission édition
Route::delete('/entreprises/{id}', function () {
    return view('entreprises.destroy'); })->name('entreprises.destroy'); // Suppression