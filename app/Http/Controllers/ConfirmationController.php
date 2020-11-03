<?php

namespace App\Http\Controllers;

use App\Church;
use App\Baptismal;
use App\Confirmation;
use App\ConfirmationSponsor;
use Illuminate\Http\Request;
use App\ConfirmationFacilitator;

class ConfirmationController extends Controller
{

    public function index(Request $request)
    {
        $churches = Church::orderBy('name')->get();
        $confirmations = Confirmation::active();
        if ($request->name) {
            $confirmations = $confirmations->search($request->name);
        }        
        if ($request->church) {
            if ($request->church == 'others') {
                 $confirmations = $confirmations->whereNull('confirmations.church_id');
            } else {
                $confirmations = $confirmations->where('confirmations.church_id',$request->church); 
            }                       
        }
        $confirmations = $confirmations->orderByDesc('confirmations.created_at')->paginate(10);
        $confirmations = $confirmations->appends($request->except('page'));
        return view('confirmation.index',compact('churches','request','confirmations'));
    }

    public function create(Request $request)
    {
        $baptismals = [];
        if ($request->name) {
            $baptismals = Baptismal::active();
            $baptismals = $baptismals->search($request->name);
            $baptismals = $baptismals->confirmations();
            if ($baptismals->count() == 0) {
                return redirect()->back()->with('error','No record found!');
            }  
            $baptismals = $baptismals->orderBy('baptismals.last_name')->get();
        }                        
        return view('confirmation.create',compact('request','baptismals'));
    }

    public function c_create($id)
    {
        $church = Church::orderBy('name')->get();
        $bap = Baptismal::find($id);
        return view('confirmation.confirmation_create',compact('church','bap'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date_of_confirmation' => 'required',
            'church_id' => 'required',
        ]);

        $c = Confirmation::find($request->baptismal_id);
        if (!$c) {
            $c = new Confirmation;
        }        
        if ($request->church_id == 'others') {
            $c->other_church = $request->other_church;
            $c->church_id = null;
        } else {
            $c->church_id = $request->church_id;
            $c->other_church = null;
        }
        $c->baptismal_id = $request->baptismal_id;
        $c->date_of_confirmation = $request->date_of_confirmation;
        $c->date_of_seminar = $request->date_of_seminar;
        $c->created_by = auth()->user()->id;
        $c->is_deleted = false;
        $c->deleted_by = null;
        $c->deleted_at = null;
        $c->save();
        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                $s = new ConfirmationSponsor;
                $s->confirmation_id = $c->id;
                $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                $s->sponsor_gender = $request->sponsor_gender[$i];
                $s->save();
            }
        }
        $facilitator = new ConfirmationFacilitator;
        $facilitator->Confirmation_id = $c->id;
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->save();
        return redirect('/confirmation?filter=true')->with('success','Data succesfully added!');
    }

    public function edit($id)
    {
        $c = Confirmation::findOrFail($id);
        $churches = Church::orderBy('name')->get();
        return view('confirmation.edit',compact('churches','c'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'date_of_confirmation' => 'required',
            'church_id' => 'required',
        ]);

        $c = Confirmation::find($id);      
        if ($request->church_id == 'others') {
            $c->other_church = $request->other_church;
            $c->church_id = null;
        } else {
            $c->church_id = $request->church_id;
            $c->other_church = null;
        }
        $c->date_of_confirmation = $request->date_of_confirmation;
        $c->date_of_seminar = $request->date_of_seminar;
        $c->created_by = auth()->user()->id;
        $c->is_deleted = false;
        $c->deleted_by = null;
        $c->deleted_at = null;
        $c->update();
        if ($request->sponsor_name) {
            foreach ($request->sponsor_name as $i => $value) {  
                if (isset($request->sponsor_id[$i])) {
                    $s = ConfirmationSponsor::findOrFail($request->sponsor_id[$i]);
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->sponsor_gender = $request->sponsor_gender[$i];
                    $s->update();
                } else {
                    $s = new ConfirmationSponsor;
                    $s->confirmation_id = $c->id;
                    $s->sponsor_name = ucwords($request->sponsor_name[$i]);
                    $s->sponsor_gender = $request->sponsor_gender[$i];
                    $s->save();
                }                           
            }
        }
        $facilitator = ConfirmationFacilitator::where('confirmation_id',$c->id)->first();
        $facilitator->facilitator_1 = ucwords($request->facilitator_1);
        $facilitator->facilitator_2 = ucwords($request->facilitator_2);
        $facilitator->facilitator_3 = ucwords($request->facilitator_3);
        $facilitator->update();
        return redirect()->back()->with('success','Record updated!');
    }

    public function destroy($id)
    {
        $data = Confirmation::findOrFail($id);
        $data->is_deleted = 1;
        $data->deleted_by = auth()->user()->id;
        $data->deleted_at = now();
        $data->save();
        return redirect()->back()->with('success','Record deleted successfully');
    }
}
