<?php

namespace App\Http\Controllers;

use App\Church;
use App\Baptismal;
use Illuminate\Http\Request;
use App\BaptismalFacilitator;

class ImportController extends Controller
{
    public function index()
    {
        $baptismal_columns = ['first_name', 'middle_name', 'last_name', 'date_of_birth', 'gender' , 'place_of_birth', 'fathers_name', 'mothers_maiden_name', 'parents_address' , 'contact_number', 'parents_type_of_marriage', 'parents_marriage_place', 'church', 'date_of_seminar', 'date_of_baptismal' , 'facilitator_1', 'facilitator_2', 'facilitator_3'];
        return view('import.index',compact('baptismal_columns'));
    }

    public function baptismal(Request $request)
    {
        $data_count = 0;
        if ($request->import) {
            foreach ($request->import as $i => $import) {
                if (isset($import['church'])) {
                    $church = ucwords($import['church']);
                    $church_exist = Church::where('name',$church)->first();
                    if ($church_exist) {
                        $c = $church_exist;
                        $c->name = $church;   
                        $c->save();                     
                    } else {
                        $c = new Church;
                        $c->name = $church;
                        $c->address = 'Not Specified';
                        $c->save();
                    }

                    $first_name = ucwords($import['first_name']);
                    $middle_name = ucwords($import['middle_name']);
                    $last_name = ucwords($import['last_name']);
                    $exist = Baptismal::where('first_name',$first_name)
                                      ->orWhere('last_name',$last_name)
                                      ->orWhere('middle_name',$middle_name)
                                      ->first();
                    if ($exist) {
                        $baptismal = $exist;
                        $baptismal->is_deleted = false;
                    } else {
                        $baptismal = new Baptismal;
                        $baptismal->first_name = $first_name;
                        $baptismal->middle_name = $middle_name;
                        $baptismal->last_name = $last_name;                  
                    } 
                    $baptismal->church_id = $c->id;
                    $baptismal->date_of_birth = date('Y-m-d',strtotime($import['date_of_birth']));
                    $baptismal->gender = ucwords($import['gender']);
                    $baptismal->place_of_birth = ucwords($import['place_of_birth']);
                    $baptismal->fathers_name = ucwords($import['fathers_name']);
                    $baptismal->mothers_maiden_name = ucwords($import['mothers_maiden_name']);
                    $baptismal->parents_address = ucwords($import['parents_address']);
                    $baptismal->contact_number = $import['contact_number'];
                    $baptismal->parents_type_of_marriage = ucwords($import['parents_type_of_marriage']);
                    $baptismal->parents_marriage_place = ucwords($import['parents_marriage_place']);
                    $baptismal->date_of_seminar = date('Y-m-d',strtotime($import['date_of_seminar']));
                    $baptismal->date_of_baptismal = date('Y-m-d',strtotime($import['date_of_baptismal']));
                    $baptismal->save();
                    $data_count ++;

                    $facilitator_exist = BaptismalFacilitator::where('baptismal_id',$baptismal->id)->first();
                    if ($facilitator_exist) {
                        $facilitator = $facilitator_exist;
                    } $facilitator = new BaptismalFacilitator;

                    $facilitator->baptismal_id = $baptismal->id;
                    $facilitator->facilitator_1 = ucwords($import['facilitator_1']);
                    $facilitator->facilitator_2 = ucwords($import['facilitator_2']);
                    $facilitator->facilitator_3 = ucwords($import['facilitator_3']);
                    $facilitator->save();   
                }
            }
            return redirect()->back()->with('success','Successfully imported '.$data_count.' Baptismal Record!');
        } return redirect()->back()->with('error','Empty File');
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
