<?php

namespace App\Http\Controllers;

use App\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{

    public function index()
    {
        $church = Church::where('is_deleted',0)->get();
        return view('church.index',compact('church'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $church = new Church;
        $church->name = ucwords($request->name);
        $church->address = ucwords($request->address);
        $church->save();
        return redirect()->back()->with('success','Church successfully added');
    }

    public function edit($id)
    {        
        $church = Church::findOrFail($id);
        return view('church._edit', compact('church'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $church = Church::findOrFail($id);
        // $church->fill($request->all());
        $church->name = ucwords($request->name);
        $church->address = ucwords($request->address);
        $church->update();
        return redirect()->back()->with('success','Church successfully updated');
    }

    public function destroy($id)
    {
        $data = Church::findOrFail($id);
        $data->is_deleted = 1;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = now();
        $data->save();
        return redirect()->back()->with('success','Church deleted successfully');
    }
}
