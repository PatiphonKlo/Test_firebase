<?php
 
use App\Http\Controllers\FirebaseController;
 
Route::get('get-firebase-data', [FirebaseController::class, 'index'])->name('firebase.index');

