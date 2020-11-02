@extends('layouts.app')

@section('title','Edit Marriage')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Edit Marriage 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>    			   		        
    			</h2>
    		</div>
    	</div>    
    	<hr>
		@include('layouts.include.alerts') 			
		<form method="POST" action="{{ url('marriage/update',$m->id) }}" id="form_create">
			@csrf
			@method('PATCH')
			<div>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="first_name">Husband Name</label>
				        <input type="text" class="form-control" value="{{ $m->husband->full_name }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="first_name">Wife Name</label>
				        <input type="text" class="form-control" value="{{ $m->wife->full_name }}" readonly>
				    </div>
				  </div>
				</div>


				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="middle_name">Husband Date of Birth</label>
				      <input type="text" class="form-control" value="{{ $m->husband->birthday }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="middle_name">Wife Date of Birth</label>
				      <input type="text" class="form-control" value="{{ $m->wife->birthday }}" readonly>
				    </div>
				  </div>
				</div>


				<div class="row">		   
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Husband Place of Birth</label>
				      <input type="text" class="form-control" value="{{ $m->husband->place_of_birth }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Wife Place of Birth</label>
				      <input type="text" class="form-control" value="{{ $m->wife->place_of_birth }}" readonly>
				    </div>
				  </div>
				</div>

				<h3 class="mt-5">Husband Personal Details</h3>
				<div class="row">	
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Status</label>
				      <select class="form-control" name="husband_status">
				      	<option value="">-- Select --</option>
				      	@foreach($status as $s)
				        	<option value="{{$s}}" {{$s == $m->husband_status ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Education Status</label>
				      <select class="form-control" name="husband_education">
				      	<option value="">-- Select --</option>
				      	@foreach($educ_status as $s)
				        	<option value="{{$s}}" {{$s == $m->husband_education ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>				  				  				  
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Parents types of Marriage</label>
				      <select class="form-control" name="husband_parents_type_of_marriage">
				      	<option value="">-- Select --</option>
				      	@foreach($parents as $s)
				        	<option value="{{$s}}" {{$s == $m->husband->parents_type_of_marriage ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>			  
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Parents Marriage Place</label>
				      <input type="text" name="husband_parents_marriage_place" class="form-control" value="{{ $m->husband->parents_marriage_place ?? '' }}">
				    </div>
				  </div>				  				  
				</div>

				<h3 class="mt-5">Wife Personal Details</h3>
				<div class="row">	
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Status</label>
				      <select class="form-control" name="wife_status">
				      	<option value="">-- Select --</option>
				      	@foreach($status as $s)
				        	<option value="{{$s}}" {{$s == $m->wife_status ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Education Status</label>
				      <select class="form-control" name="wife_education">
				      	<option value="">-- Select --</option>
				      	@foreach($educ_status as $s)
				        	<option value="{{$s}}" {{$s == $m->wife_education ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>				  				  				  
				</div>

				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Parents types of Marriage</label>
				      <select class="form-control" name="wife_parents_type_of_marriage">
				      	<option value="">-- Select --</option>
				      	@foreach($parents as $s)
				        	<option value="{{$s}}" {{$s == $m->wife->parents_type_of_marriage ? 'selected' : ''}}>{{$s ?? ''}}</option>
				        @endforeach
				      </select>
				    </div>
				  </div>			  
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Parents Marriage Place</label>
				      <input type="text" name="wife_parents_marriage_place" class="form-control" value="{{ $m->wife->parents_marriage_place }}">
				    </div>
				  </div>				  				  
				</div>

				<h3 class="mt-5">Marriage Details</h3>
				<div class="row">	
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Seminar</label>
				      <input type="date" class="form-control" name="date_of_seminar" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $m->date_of_seminar ?? '' }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Marriage</label>
				      <input type="date" class="form-control" name="date_of_marriage" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $m->date_of_marriage ?? '' }}">
				    </div>
				  </div>				  
				</div>

				<div class="row">	
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="church">Church of Baptism</label>
				      <select class="form-control" name="church_id" id="church">
				        <option value="">-- Select --</option>
				        @foreach($church as $c)
				        	<option value="{{$c->id}}" {{ $m->church_id == $c->id ? 'selected' : '' }}>{{$c->name ?? ''}}</option>
				        @endforeach
				        <option value="others" {{ $m->other_church ? 'selected' : '' }}>Others (Please Specify)</option>
				      </select>
				    </div>
				  </div> 

				  <div class="col-sm-6" style="{{$m->other_church ? '' : 'display:none' }}" id="other_church">
				    <div class="form-group">
				      <label for="fathers_name">Specify Church here:</label>
				      <input type="text" class="form-control form_data" id="fathers_name" name="other_church" autocomplete="off" value="{{ $m->other_church ?? '' }}">
				    </div>
				  </div> 		  		  	   		  
				</div>							

				<div class="form-group mt-5">
				   <table class="table">
				      <thead>
				       <tr>
				         <th class="text-center">Sponsor Name</th>
				       </tr>
				      </thead>

				      <tbody id="sponsor_table">
				      	@foreach($m->sponsors as $s)
							<tr class="sponsor_rows">
								<input type="hidden" name="sponsor_id[]" value="{{ $s->id }}">
								<td><input type="text" name="sponsor_name[]" class="form-control text-center" required autocomplete="off" value="{{$s->sponsor_name}}"></td>				         
							</tr>
						@endforeach
				      </tbody>
				      <tfoot>
				      	<tr>
				      		<td colspan="3" class="text-center">
				      			<button type="button" class="btn btn-sm btn-success" id="add-btn"><i class="fa fa-plus"></i> Add Row</button>
				      			<button type="button" class="btn btn-sm btn-outline-danger" id="remove-btn"><i class="fa fa-trash"></i> Remove Row</button>
				      		</td>
				      	</tr>				      					      	
				      </tfoot>
				   </table>
				</div>

				<div class="row mt-5">
				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_1">Primary Facilitator</label>
				      <input type="text" class="form-control" id="facilitator_1" name="facilitator_1" required autocomplete="off" placeholder="Priest Name" value="{{ $m->facilitator->facilitator_1 ?? '' }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_2">Facilitator 2</label>
				      <input type="text" class="form-control" id="facilitator_2" name="facilitator_2" autocomplete="off" value="{{ $m->facilitator->facilitator_2 ?? '' }}">
				    </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="facilitator_3">Facilitator 3</label>
				      <input type="text" class="form-control" id="facilitator_3" name="facilitator_3" autocomplete="off" value="{{ $m->facilitator->facilitator_3 ?? '' }}">
				    </div>
				  </div>
				</div>

				<button type="button" class="btn btn-primary btn-lg btn-block mt-5" id="btn_submit">Edit Record</button>
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
	        '<td><input type="text" name="sponsor_name[]" class="form-control text-center" required autocomplete="off"></td>'+
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
        		    text: 'Marriage must have atleast 1 sponsor',
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
