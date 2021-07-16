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

            $file  = $request->file('file')->getClientOriginalName();
            
            $fname = pathinfo($file, PATHINFO_FILENAME);
            
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            
            //modifying the name of the file with the current timestamp
            $file_name = str_replace(' ', '-',strtolower($request->title).$fname).time().'.'. $file_ext;
            
            
            //saving file in the storage folder
            $path = $request->file('file')->storeAs($destination_path, $file_name);

            $note->document = $file_name;
        }

        //saving in db
        $note->save();
        
        return redirect()->route('notes.all');

    }

    function getNotes()
    {

        $notes = Note::get();
        return view('note.notes', ['notes' => $notes, 'count' => 1]);

    }

    function removeNote(Note $note){
        
        Note::where('id','=',$note->id)->delete();
        return redirect()->route('notes.all');

    }
}
