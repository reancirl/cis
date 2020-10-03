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

    public function edit(Church $church)
    {
        //
    }

    public function update(Request $request, Church $church)
    {
        //
    }

    public function destroy($id)
    {
        $data = Church::findOrFail($id);
        $data->delete();
        return redirect()->back()->with('success','Church deleted successfully');
    }
}
