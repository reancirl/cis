<?php

namespace App\Http\Controllers;

use App\Baptismal;
use Illuminate\Http\Request;

class BaptismalController extends Controller
{

    public function index()
    {
        return view('baptismal.index');
    }
    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
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
