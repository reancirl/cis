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
        if ($request->husband_name) {
            $baptismal = Baptismal::active();
            $baptismal = search_name($request->husband_name);
            $baptismal = $baptismal->husband();
            return $baptismal->get();
        }
        if ($request->wife_name) {
            $baptismal = Baptismal::active();
            $baptismal = search_name($request->wife_name);
            $baptismal = $baptismal->wife();
            return $baptismal->get();
        }        
        return view('marriage.create',compact('request'));
    }

    public function show(Request $request,$id)
    {
        $bap = Baptismal::findOrFail($id);
        if ($request->couple) {
            if ($request->gender == 'Male') {
                $label = 'Husband';
            } else {
                $label = 'Wife';
            }
            $age = $bap->age;
            $full_name = $bap->full_name;
            return response()->json([
                'bap' => $bap,
                'label' => $label,
                'age' => $age,
                'full_name' => $full_name
            ]);
        }
        return view('marriage._show',compact('bap'));
    }

    public function store(Request $request)
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
