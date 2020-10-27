<?php

namespace App\Http\Controllers;

use App\Church;
use App\Baptismal;
use App\FirstCommunion;
use Illuminate\Http\Request;

class FirstCommunionController extends Controller
{
    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();
        $fc = FirstCommunion::active();

        $fc = $fc->paginate(10);
        $fc = $fc->appends($request->except('page'));
        return view('firstCommunion.index',compact('churches','request','fc'));
    }

    public function create(Request $request)
    {
        $baptismals = [];
        if ($request->name) {
            $baptismals = Baptismal::active();
            $baptismals = search_name($request->name);
            $baptismals = $baptismals->communions();
            if ($baptismals->count() == 0) {
                return redirect()->back()->with('error','No record found!');
            }  
            $baptismals = $baptismals->get();
        }                        
        return view('firstCommunion.create',compact('request','baptismals'));
    }

    public function fc_create($id)
    {
        $bap = Baptismal::findOrFail($id);
        $churches = Church::orderBy('name')->get();
        return view('firstCommunion._create_modal', compact('bap','churches'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'date_of_communion' => 'required',
            'baptismal_id' => 'required',
        ]);

        $f = new FirstCommunion;
        if ($request->other_church) {
            $f->other_church = $request->other_church;
            $f->church_id = null;
        } else {
            $f->church_id = $request->church_id;
            $f->other_church = null;
        }
        $f->baptismal_id = $request->baptismal_id;
        $f->date_of_communion = $request->date_of_communion;
        $f->date_of_communion = $request->date_of_communion;
        $f->created_by = auth()->user()->id;
        $f->save();

        return redirect()->back()->with('success','Data successfully added!');
    }

    public function show(FirstCommunion $firstCommunion)
    {
        
    }

    public function edit(FirstCommunion $firstCommunion)
    {
        //
    }

    public function update(Request $request, FirstCommunion $firstCommunion)
    {
        //
    }

    public function destroy(FirstCommunion $firstCommunion)
    {
        //
    }
}
