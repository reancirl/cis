<?php

namespace App\Http\Controllers;

use App\Church;
use App\Baptismal;
use App\Confirmation;
use Illuminate\Http\Request;

class ConfirmationController extends Controller
{

    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();

        return view('confirmation.index',compact('churches','request'));
    }

    public function create(Request $request)
    {
        $baptismals = [];
        if ($request->name) {
            $baptismals = Baptismal::active();
            $baptismals = search_name($request->name);
            $baptismals = $baptismals->confirmations();
            if ($baptismals->count() == 0) {
                return redirect()->back()->with('error','No record found!');
            }  
            $baptismals = $baptismals->orderBy('baptismals.last_name')->get();
        }                        
        return view('confirmation.create',compact('request','baptismals'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
