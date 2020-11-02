<?php

namespace App\Http\Controllers;

use App\Church;
use App\Baptismal;
use App\BaptismalSponsor;
use Illuminate\Http\Request;
use App\BaptismalFacilitator;

class BaptismalController extends Controller
{

    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();
        $baptismals = Baptismal::active();   

        if ($request->name) {
            $baptismals = search_name($request->name);
        }
        if ($request->church) {
            if ($request->church == 'others') {
                 $baptismals = $baptismals->whereNull('church_id');
            } else {
                $baptismals = $baptismals->where('church_id',$request->church); 
            }                       
        }

        $baptismals = $baptismals->orderByDesc('created_at')->paginate(10);
        $baptismals = $baptismals->appends($request->except('page'));
        return view('baptismal.index',compact('churches','baptismals','request'));
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
        $b = new Baptismal;
        $b->first_name = ucwords($request->first_name);
        $b->last_name = ucwords($request->last_name);
        $b->middle_name = ucwords($request->middle_name);
        $b->place_of_birth = ucwords($request->place_of_birth);
        $b->gender = $request->gender;
        $b->date_of_birth = $request->date_of_birth;
        $b->date_of_seminar = $request->date_of_seminar;
        $b->date_of_baptismal = $request->date_of_baptismal;
        if ($request->church_id == 'others') {
            $b->other_church = $request->other_church;
            $b->church_id = null;
        } else {
            $b->church_id = $request->church_id;
            $b->other_church = null;
        }
        $b->fathers_name = ucwords($request->fathers_name);
        $b->mothers_maiden_name = ucwords($request->mothers_maiden_name);
        $b->parents_address = ucwords($request->parents_address);
        $b->contact_number = $request->contact_number;
        $b->parents_type_of_marriage = ucwords($request->parents_type_of_marriage);
        $b->parents_marriage_place = ucwords($request->parents_marriage_place);
        $b->created_by = auth()->user()->id;
        $b->save();
        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                $s = new BaptismalSponsor;
                $s->baptismal_id = $b->id;
                $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                $s->sponsor_gender = $request->sponsor_gender[$i];
                $s->save();
            }
        }
        $facilitator = new BaptismalFacilitator;
        $facilitator->baptismal_id = $b->id;
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->save();

        return redirect('/baptismal?filter=true')->with('success','Data succesfully added!');
    }

    public function edit(Request $request,$id)
    {
        $b = Baptismal::findOrFail($id);
        $church = Church::orderBy('name')->get();
        return view('baptismal.edit',compact('church','b','request'));
    }

    public function update(Request $request, $id)
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
        $b = Baptismal::findOrFail($id);
        $b->first_name = ucwords($request->first_name);
        $b->last_name = ucwords($request->last_name);
        $b->middle_name = ucwords($request->middle_name);
        $b->place_of_birth = ucwords($request->place_of_birth);
        $b->gender = $request->gender;
        $b->date_of_birth = $request->date_of_birth;
        $b->date_of_seminar = $request->date_of_seminar;
        $b->date_of_baptismal = $request->date_of_baptismal;
        if ($request->church_id == 'others') {
            $b->other_church = $request->other_church;
            $b->church_id = null;
        } else {
            $b->church_id = $request->church_id;
            $b->other_church = null;
        }
        $b->fathers_name = ucwords($request->fathers_name);
        $b->mothers_maiden_name = ucwords($request->mothers_maiden_name);
        $b->parents_address = ucwords($request->parents_address);
        $b->contact_number = $request->contact_number;
        $b->parents_type_of_marriage = ucwords($request->parents_type_of_marriage);
        $b->parents_marriage_place = ucwords($request->parents_marriage_place);
        $b->created_by = auth()->user()->id;
        $b->update();
        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                if (isset($request->sponsor_id[$i])) {
                    $s = BaptismalSponsor::findOrFail($request->sponsor_id[$i]);
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->sponsor_gender = $request->sponsor_gender[$i];
                    $s->update();
                } else {
                    $s = new BaptismalSponsor;
                    $s->baptismal_id = $b->id;
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->sponsor_gender = $request->sponsor_gender[$i];
                    $s->save();
                }                           
            }
        }
        $facilitator = BaptismalFacilitator::where('baptismal_id',$b->id)->first();
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->update();
        
        return redirect()->back()->with('success','Record updated!');
    }

    public function destroy($id)
    {
        $data = Baptismal::findOrFail($id);
        $data->is_deleted = 1;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = now();
        $data->save();
        return redirect()->back()->with('success','Record deleted successfully');
    }
}
