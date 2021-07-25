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

    function saveFile(Request $request)
    {
        
        $file = $request->file('file');
        $file_name = time() . $file->getClientOriginalName();
        // $file->storeAs('public/docs', $file_name);
        return response()->json(['success' => $file_name]);
    }

    function saveNotes(Request $request)
    {

        // return $request;
        //validating requests
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required_if:link,null|file|nullable|max:10000|mimes:pdf',
            'link' => "required_if:$request->file,null|nullable|url"
        ]);

        $note = new Note;

        $note->title = $request->title;
        $note->link = $request->link;

        if($request->hasFile('file')){
            $destination_path = 'public/docs';
            $file  = $request->file('file')->getClientOriginalName();
            $fname = pathinfo($file, PATHINFO_FILENAME);
            $file_ext = pathinfo($file, PATHINFO_EXTENSION);
            $file_name = str_replace(' ', '-', strtolower($request->title) . $fname) . rand() . '.' . $file_ext;
            $path = $request->file('file')->storeAs($destination_path, $file_name);

            $note->document = $file_name;
            return response()->json(['success' => $file_name]);
        }
        return redirect()->route('notes.all');
    }



    function getNotes()
    {

        $notes = Note::get();
        return view('note.notes', ['notes' => $notes, 'count' => 1]);
    }

    function removeNote(Note $note)
    {

        Note::where('id', '=', $note->id)->delete();
        return redirect()->route('notes.all');
    }
}
