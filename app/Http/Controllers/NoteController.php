<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class NoteController extends Controller
{

    public function index()
    {
        $notes=Note::query()->where('user_id',Auth::id())->latest('updated_at')->paginate(3);
        return view('notes.index')->with('notes',$notes);
    }


    public function create()
    {
        return view('notes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required|max:120',
            'text'=>'required'

        ]);

        Note::create([
            'uuid'=>Str::uuid(),
            'user_id'=>Auth::id(),
            'title'=>$request->title,
            'text'=>$request->text
        ]);
        return to_route('notes.index');
    }


    public function show(Note $note)
    {
       if($note->user_id != Auth::id()){
           return abort(403);
       }
        return view('notes.show')->with('note',$note);
    }


    public function edit(Note $note)
    {
        if(!$note->user != Auth::user()) {
            return abort(403);
        }

        return view('notes.edit')->with('note', $note);
    }

    public function update(Request $request, Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }

        $request->validate([
            'title'=>'required|max:120',
            'text'=>'required'

        ]);
        $note->update([
            'title'=>$request->title,
            'text'=>$request->text

        ]);
        return to_route('notes.show',$note)->with('success','Note updated successfully');
    }


    public function destroy(Note $note)
    {
        if($note->user_id != Auth::id()){
            return abort(403);
        }
        $note->delete();

        return to_route('notes.index')->with('success','Note moved to trash');
    }
}
