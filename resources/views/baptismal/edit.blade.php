@extends('layouts.app')

@section('title','Edit Baptismal')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-6">
    			<h2 class="pt-2"> 
    				Edit Baptismal 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>  
    			</h2>
    		</div>    		
    	</div>    
    	<hr>
    	<div class="row">
    		<div class="col-sm-12">
    			<button type="button" class="btn btn-danger btn-sm float-right" id="btn_edit"><i class="fa fa-edit"></i> Edit</button>  
    			<button type="button" class="btn btn-outline-secondary btn-sm float-right" id="btn_cancel" style="display:none"><i class="fa fa-times"></i> Cancel</button>    			   		            			
    		</div>
    	</div>
		@include('layouts.include.alerts') 			
		<form method="POST" action="{{ url('baptismal/update',$b->id) }}">
			@csrf
			@method('PATCH')
			<div>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="first_name">First Name</label>
				        <input type="text" class="form-control form_data" id="first_name" name="first_name" required autocomplete="off" value="{{ $b->first_name }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="last_name">Last Name</label>
				      <input type="text" class="form-control form_data" id="last_name" name="last_name" required autocomplete="off" value="{{ $b->last_name }}" readonly>
				    </div>
				  </div>
				</div>


				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="middle_name">Middle Name</label>
				      <input type="text" class="form-control form_data" id="middle_name" name="middle_name" required autocomplete="off" value="{{ $b->middle_name }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				     <div class="form-group">
				      <label for="place_of_birth">Place of Birth</label>
				      <input type="text" class="form-control form_data" id="place_of_birth" name="place_of_birth" required autocomplete="off" value="{{ $b->place_of_birth }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="gender">Gender</label>
				      <select class="form-control" id="gender" name="gender" disabled>
				        <option value="Male" {{$b->gender == 'Male' ? 'selected' : ''}}>Male</option>
				        <option value="Female" {{$b->gender == 'Female' ? 'selected' : ''}}>Female</option>
				      </select>
				    </div>
				  </div>  

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Birth</label>
				      <input type="date" class="form-control form_data" id="date_of_birth date" name="date_of_birth" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $b->date_of_birth }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">		   
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Seminar</label>
				      <input type="date" class="form-control form_data" id="date_of_seminar date" name="date_of_seminar" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $b->date_of_seminar }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Baptismal</label>
				      <input type="date" class="form-control form_data" id="date_of_baptismal date" name="date_of_baptismal" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $b->date_of_baptismal }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">	
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="church">Church of Baptism</label>
				      <select class="form-control" name="church_id" id="church" disabled>
				        <option value="">-- Select --</option>
				        @foreach($church as $c)
				        	<option value="{{$c->id}}" {{ $b->church_id == $c->id ? 'selected' : '' }}>{{$c->name ?? ''}}</option>
				        @endforeach
				        <option value="others">Others (Please Specify)</option>
				      </select>
				    </div>
				  </div> 

				  <div class="col-sm-6" style="{{$b->other_church ? '' : 'display:none' }}" id="other_church">
				    <div class="form-group">
				      <label for="fathers_name">Specify Church here:</label>
				      <input type="text" class="form-control form_data" id="fathers_name" name="other_church" autocomplete="off" value="{{ $b->other_church ?? '' }}" readonly>
				    </div>
				  </div> 		  		  	   		  
				</div>

				<h3 class="mt-5">Parents Information</h3>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="fathers_name">Father's Name</label>
				      <input type="text" class="form-control form_data" id="fathers_name" name="fathers_name" required autocomplete="off" value="{{ $b->fathers_name ?? '' }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="mothers_maiden_name">Mother's maiden Name</label>
				      <input type="text" class="form-control form_data" id="mothers_maiden_name" name="mothers_maiden_name" required autocomplete="off" value="{{ $b->mothers_maiden_name ?? '' }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="parents_type_of_marriage">Parents type of Marriage</label>
				       <select class="form-control" id="parents_type_of_marriage" name="parents_type_of_marriage" value="{{ $b->parents_type_of_marriage ?? '' }}" disabled>
				        <option value="Church">Church</option>
				        <option value="Civil">Civil</option>
				        <option value="Not-married">Not-married</option>
				      </select>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="contact_number">Contact Number</label>
				      <input type="text" class="form-control form_data" id="contact_number" name="contact_number"  required autocomplete="off" value="{{ $b->contact_number ?? '' }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="parents_address">Parents Address</label>
				      <input type="text" class="form-control form_data" id="parents_address" name="parents_address" placeholder="Parents Address" required autocomplete="off" value="{{ $b->parents_address ?? '' }}" readonly>
				    </div>
				  </div>
				</div>								

				<h3 class="mt-5">Sponsor Details</h3>
				<div class="form-group" >
					<table class="table">
						<thead>
							<tr>
								<th width="45%">Sponsor Name</th>
								<th width="45%">Type</th>				      
							</tr>
						</thead>

						<tbody id="sponsor_table">
							@foreach($b->baptismalSponsors as $s)
								<tr class="sponsor_rows">
									<input type="hidden" name="sponsor_id[]" value="{{ $s->id }}">
									<td>
										<input type="text" name="sponsor_name[]" class="form-control form_data" required autocomplete="off" value="{{$s->sponsor_name}}" readonly>
									</td>
									<td>
										<select type="text" name="sponsor_gender[]" class="form-control sponsor_gender" required autocomplete="off" disabled>
											<option value="Godfather" {{ $s->sponsor_gender == 'Godfather' ? 'selected' : '' }}>Godfather</option>
											<option value="Godmother" {{ $s->sponsor_gender == 'Godmother' ? 'selected' : '' }}>Godmother</option>
										</select>
									</td>
								</tr>
							@endforeach
						</tbody>
						<tfoot style="display:none" id="tfoot">
							<tr>
								<td colspan="3" class="text-center">
									<button type="button" class="btn btn-success" id="add-btn"><i class="fa fa-plus"></i> Add Row</button>
									<button type="button" class="btn btn-outline-danger" id="remove-btn"><i class="fa fa-trash"></i> Remove Row</button>
								</td>
							</tr>				      					      	
						</tfoot>
					</table>
				</div>

				<h3 class="mt-5">Facilitators Details</h3>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_1">Primary Facilitator</label>
				      <input type="text" class="form-control form_data" id="facilitator_1" name="facilitator_1" required autocomplete="off" placeholder="Priest Name" value="{{ $b->baptismalFacilitator->facilitator_1 ?? '' }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_2">Facilitator 2</label>
				      <input type="text" class="form-control form_data" id="facilitator_2" name="facilitator_2" autocomplete="off" value="{{ $b->baptismalFacilitator->facilitator_2 ?? '' }}" readonly>
				    </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="facilitator_3">Facilitator 3</label>
				      <input type="text" class="form-control form_data" id="facilitator_3" name="facilitator_3" autocomplete="off" value="{{ $b->baptismalFacilitator->facilitator_3 ?? '' }}" readonly>
				    </div>
				  </div>
				</div>

				<button type="submit" class="btn btn-primary btn-lg btn-block mt-5" id="btn_submit" style="display:none">Edit Record</button>
			</div>
		</form>		
    </div>
@endsection
@section('scripts')
	<script type="text/javascript">
	    $('#add-btn').click(function(){
	        addRow();
	    });

	    function addRow()
	    {
	        let tr='<tr class="sponsor_rows">'+
	        '<td><input type="text" name="sponsor_name[]" class="form-control form_data" required autocomplete="off"></td>'+
	        '<td><select type="text" name="sponsor_gender[]" class="form-control sponsor_gender" required autocomplete="off"><option value="Godfather">Godfather</option><option value="Godmother">Godmother</option></select></td>'+
	        '</tr>';
	        $('#sponsor_table').append(tr);
	    };


	    $('#remove-btn').click(function(){
	        let last=$('#sponsor_table tr').length;
	        if(last==1){
        		swal({
        		    text: 'Baptismal must have atleast 1 sponsor',
        		    icon: 'error',
        		    buttons: false,
        		});
	        }
	        else{
	            $('#sponsor_table tr:last').remove();
	        } 
	    });

	    $('#church').on('change', function() {
            let value = this.value;
            if (value == 'others') {
            	$('#other_church').show();
            }
            else $('#other_church').hide();
        });

        $('#btn_edit').click(function(){
        	$(this).hide();
        	$('#tfoot').show();
        	$('#btn_cancel').show();
        	$('#btn_submit').show();
        	$('.date').attr('readonly', false);
        	$('#gender').attr('disabled', false);
        	$('#church').attr('disabled', false);
        	$('.form_data').attr('readonly', false);        	
        	$('.sponsor_gender').attr('disabled', false);         	
        	$('#parents_type_of_marriage').attr('disabled', false);
        });

        $('#btn_cancel').click(function(){
        	$(this).hide();
        	$('#tfoot').hide();
        	$('#btn_edit').show();
        	$('#btn_submit').hide();
        	$('.date').attr('readonly', true);
        	$('#gender').attr('disabled', true);
        	$('#church').attr('disabled', true);
        	$('.form_data').attr('readonly', true);        	
        	$('.sponsor_gender').attr('disabled', true);         	
        	$('#parents_type_of_marriage').attr('disabled', true); 
        });
	</script>
@endsection
