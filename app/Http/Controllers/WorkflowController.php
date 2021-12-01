<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkflowController extends Controller
{
    public function index()
    {
        $note = Workflow::orderBy('workflow_id','ASC')->get();
        return view('workflow.index')->with(compact('workflow'));
    }

    public function create()
    {
        return view('workflow.new');
    }

    public function store(Request $request)
    {
        $store = collect($request->all());
        try {
        Workflow::create($store->all());
        } catch (QE $e) {
            notify()->warning('Database Error');
            return redirect()->back();
        }
        notify()->success('Penambahan Workflow Berhasil');
        return redirect('workflow');
    }

    public function show($id)
    {
        $show = Workflow::where('workflow_id', $id)->first();

        return view('workflow.show')->with(compact('show'));
    }

    public function edit($id)
    {
        $edit = Workflow::where('workflow_id', $id)->first();

        return view('workflow.edit')->with(compact('edit'));
    }

    public function update(Request $request)
    {
        $note = Workflow::where('workflow_id', $request->workflow_id)->first();
        $update = collect($request->all());
        try {
        $note->update($update->all());
        } catch (QE $e) {
            return $e;
        }
        notify()->success('Pengubahan Workflow Berhasil');
        return redirect('workflow');
    }

    public function delete($id)
    {
        $note = Workflow::where('workflow_id', $id)->first();

        try {
            $note->delete();
        } catch (QE $e) {
            return $e;
        } //show db error message

        notify()->success('Workflow telah sukses dihapus !');

        return redirect('workflow');
    }
}
