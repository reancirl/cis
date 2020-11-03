<?php

namespace App\Http\Controllers;

use App\Church;
use App\Marriage;
use App\MarriageSponsor;
use App\MarriageFacilitator;
use App\Baptismal;
use App\FirstCommunion;
use Illuminate\Http\Request;

class MarriageController extends Controller
{

    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();
        $marriages = Marriage::active();

        if ($request->name) {
            $marriages = $marriages->husband($request->name);
            if ($marriages->count() == 0) {
                $marriages = Marriage::active();
                $marriages = $marriages->wife($request->name);
            }
        } 
        if ($request->church) {
            if ($request->church == 'others') {
                 $marriages = $marriages->whereNull('marriages.church_id');
            } else {
                $marriages = $marriages->where('marriages.church_id',$request->church); 
            }                       
        }
        $marriages = $marriages->orderByDesc('marriages.created_at')->paginate(10);
        $marriages = $marriages->appends($request->except('page'));
        return view('marriage.index',compact('churches','request','marriages'));
    }

    public function create(Request $request)
    {
        if ($request->husband_name) {
            $baptismal = Baptismal::active();
            $baptismal = $baptismal->search($request->husband_name);
            $baptismal = $baptismal->husband();
            return $baptismal->get();
        }
        if ($request->wife_name) {
            $baptismal = Baptismal::active();
            $baptismal = $baptismal->search($request->wife_name);
            $baptismal = $baptismal->wife();
            return $baptismal->get();
        }
        if ($request->Husband && $request->Wife) {
            $husband_valid = Baptismal::validity()
                                      ->where('gender','Male');
            $h = $husband_valid->where('baptismals.id',$request->Husband)                    
                       ->first(); 
            $wife_valid = Baptismal::validity()
                                      ->where('gender','FeMale');
            $w = $wife_valid->where('baptismals.id',$request->Wife)
                       ->first(); 
            if (!$h || !$w) {
                return redirect()->back()->with('error','Data not applicable');
            }
            $church = Church::orderBy('name')->get();
            $status = ['Never Married','Widowed','Common-law','Married','Annulled Marriage'];
            $educ_status = ['No Secondary','Trade/Apprenticeship','Non-university certificate/diploma','Secondary'];
            $parents = ['Not-married','Civil','Church'];
            return view('marriage.create',compact('h','w','church','status','educ_status','parents'));
        }
        return view('marriage.search',compact('request'));
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
        if (!$request->husband_id || !$request->wife_id) {
            return redirect()->back()->with('error','Request lacking information!');
        }
        $husband_bap = Baptismal::findOrFail($request->husband_id);
        $husband_bap->parents_type_of_marriage = ucwords($request->husband_parents_type_of_marriage);
        $husband_bap->parents_marriage_place = ucwords($request->husband_parents_marriage_place);
        $husband_bap->update();

        $wife_bap = Baptismal::findOrFail($request->wife_id);
        $wife_bap->parents_type_of_marriage = ucwords($request->wife_parents_type_of_marriage);
        $wife_bap->parents_marriage_place = ucwords($request->wife_parents_marriage_place);
        $wife_bap->update();

        $m = new Marriage;
        if ($request->church_id == 'others') {
            $m->other_church = $request->other_church;
            $m->church_id = null;
        } else {
            $m->church_id = $request->church_id;
            $m->other_church = null;
        }
        $m->husband_id = $request->husband_id;
        $m->wife_id = $request->wife_id;
        $m->wife_status = $request->wife_status;
        $m->wife_education = $request->wife_education;
        $m->husband_status = $request->husband_status;
        $m->husband_education = $request->husband_education;
        $m->date_of_seminar = $request->date_of_seminar;
        $m->date_of_marriage = $request->date_of_marriage;
        $m->created_by = auth()->user()->id;
        $m->save();
        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                $s = new MarriageSponsor;
                $s->marriage_id = $m->id;
                $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                $s->save();
            }
        }
        $facilitator = new MarriageFacilitator;
        $facilitator->marriage_id = $m->id;
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->save();

        return redirect('/marriage')->with('success','Data succesfully added!');
    }

    public function edit($id)
    {
        $m = Marriage::findOrFail($id);
        $church = Church::orderBy('name')->get();
        $status = ['Never Married','Widowed','Common-law','Married','Annulled Marriage'];
        $educ_status = ['No Secondary','Trade/Apprenticeship','Non-university certificate/diploma','Secondary'];
        $parents = ['Not-married','Civil','Church'];
        return view('marriage.edit',compact('m','church','status','educ_status','parents'));
    }

    public function update(Request $request, $id)
    {        
        $m = Marriage::findOrFail($id);
        if ($request->church_id == 'others') {
            $m->other_church = $request->other_church;
            $m->church_id = null;
        } else {
            $m->church_id = $request->church_id;
            $m->other_church = null;
        }
        $m->wife_status = $request->wife_status;
        $m->wife_education = $request->wife_education;
        $m->husband_status = $request->husband_status;
        $m->husband_education = $request->husband_education;
        $m->date_of_seminar = $request->date_of_seminar;
        $m->date_of_marriage = $request->date_of_marriage;
        $m->created_by = auth()->user()->id;
        $m->update();

        $husband_bap = Baptismal::findOrFail($m->husband_id);
        $husband_bap->parents_type_of_marriage = ucwords($request->husband_parents_type_of_marriage);
        $husband_bap->parents_marriage_place = ucwords($request->husband_parents_marriage_place);
        $husband_bap->update();

        $wife_bap = Baptismal::findOrFail($m->wife_id);
        $wife_bap->parents_type_of_marriage = ucwords($request->wife_parents_type_of_marriage);
        $wife_bap->parents_marriage_place = ucwords($request->wife_parents_marriage_place);
        $wife_bap->update();

        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                if (isset($request->sponsor_id[$i])) {
                    $s = MarriageSponsor::findOrFail($request->sponsor_id[$i]);
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->update();
                } else {
                    $s = new MarriageSponsor;
                    $s->marriage_id = $m->id;
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->save();
                }                           
            }
        }
        $facilitator = MarriageFacilitator::where('marriage_id',$m->id)->first();
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->update();

        return redirect()->back()->with('success','Record updated!');
    }

    public function destroy($id)
    {
        $data = Marriage::findOrFail($id);
        $data->is_deleted = 1;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = now();
        $data->save();
        return redirect()->back()->with('success','Record deleted successfully');
    }
}
