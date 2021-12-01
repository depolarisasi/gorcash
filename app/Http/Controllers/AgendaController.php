<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\Agenda;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException as QE;
use RealRashid\SweetAlert\Facades\Alert;
use App\Imports\AgendaImport;
use Maatwebsite\Excel\Facades\Excel;


class AgendaController extends Controller
{
    public function index()
    {
        $agenda = Agenda::get();
        return view('agenda.index')->with(compact('agenda'));
    }

    public function create()
    {
        return view('agenda.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Agenda::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Agenda Berhasil');
        return redirect('agenda');
    }

    public function show($id)
    {
        $show = Agenda::where('agenda_id', $id)->first();

        return view('agenda.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Agenda::where('agenda_id', $id)->first();

        return view('agenda.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $agenda = Agenda::where('agenda_id', $request->agenda_id)->first();
        $update = collect($request->all());
        try {
        $agenda->update($update->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Pengubahan Agenda Berhasil');
        return redirect('agenda');
    }

    public function delete($id)
    {
        $agenda = Agenda::where('agenda_id', $id)->first();

        try {
            $agenda->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Agenda telah sukses dihapus !');

        return redirect('agenda');
    }

    public function apimassdelete(Request $request){

        $ids = $request->ids;
        Agenda::whereIn('agenda_code',$ids)->delete();
        return response()->json(['success'=>"Agendas Deleted successfully."]);

}

    public function importdata(){
        return view('agenda.import');
    }

    public function importing(Request $request){
        if($request->file('agenda') != NULL) {
            Excel::import(new AgendaImport, request()->file('agenda'));
        }else {
            toast('File kosong','error');
            return redirect('/Agenda');
        }

        toast('Berhasil Menambah Warna','success');
        return redirect('/Agenda');
    }
}
