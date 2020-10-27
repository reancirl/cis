@extends('layouts.app')

@section('title','Add Baptismal')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Add Baptismal 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>    			   		        
    			</h2>
    		</div>
    	</div>    
    	<hr>
		@include('layouts.include.alerts') 			
		<form method="POST" action="{{ url('/baptismal') }}" id="form_create">
			@csrf
			<div>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="first_name">First Name</label>
				        <input type="text" class="form-control" id="first_name" name="first_name" required autocomplete="off" value="{{ old('first_name') }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="last_name">Last Name</label>
				      <input type="text" class="form-control" id="last_name" name="last_name" required autocomplete="off" value="{{ old('last_name') }}">
				    </div>
				  </div>
				</div>


				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="middle_name">Middle Name</label>
				      <input type="text" class="form-control" id="middle_name" name="middle_name" required autocomplete="off" value="{{ old('middle_name') }}">
				    </div>
				  </div>

				  <div class="col">
				     <div class="form-group">
				      <label for="place_of_birth">Place of Birth</label>
				      <input type="text" class="form-control" id="place_of_birth" name="place_of_birth" required autocomplete="off" value="{{ old('place_of_birth') }}">
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="gender">Gender</label>
				      <select class="form-control" id="gender" name="gender">
				        <option value="Male" {{ old('gender') == 'Male' ? 'selected' : ''}}>Male</option>
				        <option value="Female" {{ old('gender') == 'Female' ? 'selected' : ''}}>Female</option>
				      </select>
				    </div>
				  </div>  

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Birth</label>
				      <input type="date" class="form-control" id="date_of_birth date" name="date_of_birth" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ old('date_of_birth') }}">
				    </div>
				  </div>
				</div>

				<div class="row">		   
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Seminar</label>
				      <input type="date" class="form-control" id="date_of_seminar date" name="date_of_seminar" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ old('date_of_seminar') }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Baptismal</label>
				      <input type="date" class="form-control" id="date_of_baptismal date" name="date_of_baptismal" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ old('date_of_baptismal') }}">
				    </div>
				  </div>
				</div>

				<div class="row">	
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="gender">Church of Baptism</label>
				      <select class="form-control" name="church_id" required id="church">
				        <option value="">-- Select --</option>
				        @foreach($church as $c)
				        	<option value="{{$c->id}}">{{$c->name ?? ''}}</option>
				        @endforeach
				        <option value="others">Others (Please Specify)</option>
				      </select>
				    </div>
				  </div> 

				  <div class="col-sm-6" style="display:none" id="other_church">
				    <div class="form-group">
				      <label for="fathers_name">Specify Church here:</label>
				      <input type="text" class="form-control" id="fathers_name" name="other_church" autocomplete="off">
				    </div>
				  </div> 		  		  	   		  
				</div>

				<h3 class="mt-5">Parents Information</h3>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="fathers_name">Father's Name</label>
				      <input type="text" class="form-control" id="fathers_name" name="fathers_name" required autocomplete="off" value="{{ old('fathers_name') }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="mothers_maiden_name">Mother's maiden Name</label>
				      <input type="text" class="form-control" id="mothers_maiden_name" name="mothers_maiden_name" required autocomplete="off" value="{{ old('mothers_maiden_name') }}">
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="parents_type_of_marriage">Parents type of Marriage</label>
				       <select class="form-control" id="parents_type_of_marriage" name="parents_type_of_marriage" value="{{ old('parents_type_of_marriage') }}">
				        <option value="Church">Church</option>
				        <option value="Civil">Civil</option>
				        <option value="Not-married">Not-married</option>
				      </select>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="contact_number">Contact Number</label>
				      <input type="text" class="form-control" id="contact_number" name="contact_number"  required autocomplete="off" value="{{ old('contact_number') }}">
				    </div>
				  </div>
				</div>

				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="parents_address">Parents Address</label>
				      <input type="text" class="form-control" id="parents_address" name="parents_address" placeholder="Parents Address" required autocomplete="off" value="{{ old('parents_address') }}">
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
				       <tr class="sponsor_rows">
				         <td><input type="text" name="sponsor_name[]" class="form-control" required autocomplete="off"></td>
				         <td>
				          <select type="text" name="sponsor_gender[]" class="form-control" required autocomplete="off">
				            <option value="Godfather">Godfather</option>
				            <option value="Godmother">Godmother</option>
				          </select>
				         </td>
				       </tr>
				      </tbody>
				      <tfoot>
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
				      <input type="text" class="form-control" id="facilitator_1" name="facilitator_1" required autocomplete="off" placeholder="Priest Name" value="{{ old('facilitator_1') }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_2">Facilitator 2</label>
				      <input type="text" class="form-control" id="facilitator_2" name="facilitator_2" autocomplete="off" value="{{ old('facilitator_2') }}">
				    </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="facilitator_3">Facilitator 3</label>
				      <input type="text" class="form-control" id="facilitator_3" name="facilitator_3" autocomplete="off" value="{{ old('facilitator_3') }}">
				    </div>
				  </div>
				</div>

				<button type="button" class="btn btn-primary btn-lg btn-block mt-5" id="btn_submit">Add Record</button>
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
	        '<td><input type="text" name="sponsor_name[]" class="form-control" required autocomplete="off"></td>'+
	        '<td><select type="text" name="sponsor_gender[]" class="form-control" required autocomplete="off"><option value="Godfather">Godfather</option><option value="Godmother">Godmother</option></select></td>'+
	        '</tr>';
	        $('#sponsor_table').append(tr);
	    };

	    $('#btn_submit').on('click', function() {
            swal({
			    text: 'Are you sure you want to submit this data?',
			    showCancelButton: true,
			    icon: "warning",
			    buttons: true,
			    closeModal: false,
			}).then(result => {
				if (result == true) {
		            $('#form_create').submit();
		        }
	        });
        });

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
	</script>
@endsection
