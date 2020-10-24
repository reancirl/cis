<?php

namespace App\Http\Controllers;

use App\Baptismal;
use App\Church;
use Illuminate\Http\Request;

class BaptismalController extends Controller
{

    public function index(Request $request)
    {
        $church = Church::orderBy('name')->get();
        return view('baptismal.index',compact('church','request'));
    }
    public function create()
    {
        $church = Church::orderBy('name')->get();
        return view('baptismal.create',compact('church'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'middle_name' => 'required',
            'place_of_birth' => 'required',
            'gender' => 'required',
            'date_of_birth' => 'required',
            'date_of_seminar' => 'required',
            'date_of_baptismal' => 'required',
        ]);
        $baptismal = new Baptismal;
    }

    public function show(Baptismal $baptismal)
    {
        //
    }

    public function edit(Baptismal $baptismal)
    {
        //
    }

    public function update(Request $request, Baptismal $baptismal)
    {
        //
    }

    public function destroy(Baptismal $baptismal)
    {
        //
    }
}
