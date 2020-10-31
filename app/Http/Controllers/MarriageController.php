<?php

namespace App\Http\Controllers;

use App\Church;
use App\Marriage;
use App\Baptismal;
use App\FirstCommunion;
use Illuminate\Http\Request;

class MarriageController extends Controller
{

    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();
        return view('marriage.index',compact('churches','request'));
    }

    public function create(Request $request)
    {
        return view('marriage.create',compact('request'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show(Marriage $marriage)
    {
        //
    }

    public function edit(Marriage $marriage)
    {
        //
    }

    public function update(Request $request, Marriage $marriage)
    {
        //
    }

    public function destroy(Marriage $marriage)
    {
        //
    }
}
