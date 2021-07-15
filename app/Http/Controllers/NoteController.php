<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class NoteController extends Controller
{
    function index()
    {
        return view('note.form');
    }

    function saveNotes(Request $request)
    {

        //validating requests
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required_if:link,null|file|nullable|max:10000|mimes:pdf',
            'link' => 'required_if:file,null|nullable|url'
        ]);

        $note = new Note;

        $note->title = $request->title;
        $note->link = $request->link;

        //checking if the input field has file or not
        if ($request->hasFile('file')) {

            //destination in storage folder
            $destination_path = 'public/docs';

            //getting original name of file with extensiom
            $file  = $request->file('file')->getClientOriginalName();
            

            //getting only original filename without extension
            $fname = pathinfo($file, PATHINFO_FILENAME);
            
            //getting extension of file
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            

            //modifying the name of the file with the current timestamp
            $file_name = str_replace(' ', '-',strtolower($request->title).$fname).time().'.'. $file_ext;
            
            
            //saving file in the storage folder
            $path = $request->file('file')->storeAs($destination_path, $file_name);

            //storage link is created for accessing the file from public folder using 'php artisan storage:link' command

            //insertig in db field
            $note->document = $file_name;
        }

        //saving in db
        $note->save();

        //returning back to the another route
        return redirect()->route('notes.all');
    }

    function getNotes()
    {

        $notes = Note::get();
        $count = 1;
        return view('note.notes', ['notes' => $notes, 'count' => $count]);
    }
}
