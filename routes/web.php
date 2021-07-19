<?php

use App\Models\Note;
use App\Http\Controllers\NoteController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/register');
});

Route::get('/dashboard', [NoteController::class, 'index'])->middleware(['auth'])->name('note.add');
Route::post('/dashboard/upload-notes', [NoteController::class, 'saveNotes'])->middleware(['auth'])->name('note.upload');
Route::get('/notes', [NoteController::class, 'getNotes'])->middleware(['auth'])->name('notes.all');
Route::get('/notes/delete/{note}', [NoteController::class, 'removeNote'])->middleware(['auth'])->name('notes.remove');

//Route for linking storage to public folder in production stage
// Route::get('/storage/docs/{note:document}', function(Note $note){
//     Artisan::call('storage:link');
//     return redirect("/storage/docs/$note");
// });

require __DIR__.'/auth.php';
