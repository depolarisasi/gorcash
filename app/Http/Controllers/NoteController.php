<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\Notes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;

class NoteController extends Controller
{
    public function index()
    {
        $note = Notes::orderBy('note_id','ASC')->get();
        return view('note.index')->with(compact('note'));
    }

    public function create()
    {
        return view('note.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Notes::create($store->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }
        toast('Berhasil Membuat Note Baru','success');
        return redirect('note');
    }

    public function show($id)
    {
        $show = Notes::where('note_id', $id)->first();

        return view('note.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Notes::where('note_id', $id)->first();

        return view('note.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $note = Notes::where('note_id', $request->note_id)->first();
        $update = collect($request->all());
        try {
        $note->update($update->all());
        } catch (QE $e) {
            toast('Database Error','error');
            return redirect()->back();
        }

        toast('Pengubahan Note Berhasil','success');
        return redirect('note');
    }

    public function delete($id)
    {
        $note = Notes::where('note_id', $id)->first();

        try {
            $note->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        toast('Note Berhasil Dihapus!','success');

        return redirect('note');
    }
}
