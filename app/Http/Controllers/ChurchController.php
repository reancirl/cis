<?php

namespace App\Http\Controllers;

use App\Church;
use Illuminate\Http\Request;

class ChurchController extends Controller
{

    public function index()
    {
        $church = Church::all();
        return view('church.index',compact('church'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
        ]);

        $church = new Church;
        $church->fill($request->all());
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
        $church->fill($request->all());
        $church->update();
        return redirect()->back()->with('success','Church successfully updated');
    }

    public function destroy($id)
    {
        $data = Church::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success','Church deleted successfully');
    }
}
