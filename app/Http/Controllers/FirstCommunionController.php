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

        if ($request->name) {
            $fc = $fc->search($request->name);
        }        
        if ($request->church) {
            if ($request->church == 'others') {
                 $fc = $fc->whereNull('first_communions.church_id');
            } else {
                $fc = $fc->where('first_communions.church_id',$request->church); 
            }                       
        }
        $fc = $fc->orderByDesc('created_at')->paginate(10);
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
            $baptismals = $baptismals->orderByDesc('baptismals.created_at')->get();
        }                        
        return view('firstCommunion.create',compact('request','baptismals'));
    }

    public function fc_create(Request $request, $id)
    {
        $bap = Baptismal::findOrFail($id);
        $churches = Church::orderBy('name')->get();
        if ($request->show) {
            return view('firstCommunion._show_modal', compact('bap','churches'));
        }
        return view('firstCommunion._create_modal', compact('bap','churches'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'date_of_communion' => 'required',
            'baptismal_id' => 'required',
        ]);

        $fc = new FirstCommunion;
        if ($request->church_id == 'others') {
            $fc->other_church = $request->other_church;
            $fc->church_id = null;
        } else {
            $fc->church_id = $request->church_id;
            $fc->other_church = null;
        }
        $fc->baptismal_id = $request->baptismal_id;
        $fc->date_of_communion = $request->date_of_communion;
        $fc->created_by = auth()->user()->id;
        $fc->save();

        return redirect('/first-communion?filter=true')->with('success','Data succesfully added!');
    }

    public function show()
    {
        
    }

    public function edit(Request $request, $id)
    {
        $fc = FirstCommunion::findOrFail($id);
        $churches = Church::orderBy('name')->get();        
        return view('firstCommunion._edit', compact('fc','churches'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_communion' => 'required',
            'baptismal_id' => 'required',
        ]);

        $fc = FirstCommunion::findorFail($id);
        if ($request->church_id == 'others') {
            $fc->other_church = $request->other_church;
            $fc->church_id = null;
        } else {
            $fc->church_id = $request->church_id;
            $fc->other_church = null;
        }
        $fc->baptismal_id = $request->baptismal_id;
        $fc->date_of_communion = $request->date_of_communion;
        $fc->created_by = auth()->user()->id;
        $fc->update();

        return redirect()->back()->with('success','Data succesfully updated!');
    }

    public function destroy($id)
    {
        $data = FirstCommunion::findorFail($id);
        $data->is_deleted = 1;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = now();
        $data->save();
        return redirect()->back()->with('success','Record deleted successfully');
    }
}
