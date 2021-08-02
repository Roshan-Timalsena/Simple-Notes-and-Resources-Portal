<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    function index()
    {

        return view('note.form');
    }

    function saveFile(Request $request)
    {
        $fileNames = '';
        $files = $request->file('file');
        $count = count($files);

        for ($i = 0; $i < $count; $i++) {
            $f = $files[$i]->getClientOriginalName();
            $ext = pathinfo($f, PATHINFO_EXTENSION);
            $fname = pathinfo($f, PATHINFO_FILENAME) . time() . '.' . $ext;
            $files[$i]->storeAs('/public/docs', $fname);
            $fileNames .= $fname . ',';
        }
        return response()->json(['file' => $fileNames, 'message' => 'success']);
    }

    function saveNotes(Request $request)
    {

        // return $request;
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required_if:link,null|nullable',
            'link' => "required_if:$request->file,null|nullable|url"
        ]);

        $note = new Note;

        $note->title = $request->title;
        $note->link = $request->link;
        $note->document = $request->file;
        $note->save();
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
