@extends('layouts.app')

@section('title','Edit Confirmation')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Edit Confirmation 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>    			   		        
    			</h2>
    		</div>
    	</div>    
    	<hr>
		@include('layouts.include.alerts') 			
		<form method="POST" action="{{ url('confirmation/update',$c->id) }}" id="form_edit">
			@csrf
			@method('PATCH')
			<div>
				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="first_name">Full Name</label>
				        <input type="text" class="form-control" value="{{ $c->baptismal->full_name }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="last_name">Gender</label>
				      <input type="text" class="form-control" value="{{ $c->baptismal->gender }}" readonly>
				    </div>
				  </div>
				</div>


				<div class="row">
				  <div class="col">
				    <div class="form-group">
				      <label for="middle_name">Date of Birth</label>
				      <input type="text" class="form-control" value="{{ $c->baptismal->birthday }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				     <div class="form-group">
				      <label for="place_of_birth">Place of Birth</label>
				      <input type="text" class="form-control" value="{{ $c->baptismal->place_of_birth }}" readonly>
				    </div>
				  </div>
				</div>


				<div class="row">		   
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Mother's Maiden Name</label>
				      <input type="text" class="form-control" value="{{ $c->baptismal->mothers_maiden_name }}" readonly>
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Father's Name</label>
				      <input type="text" class="form-control" value="{{ $c->baptismal->fathers_name }}" readonly>
				    </div>
				  </div>
				</div>

				<div class="row">
					<div class="col-sm-12 text-center">
						<a href="{{ url('baptismal/edit',$c->baptismal->id) }}" class="btn btn-outline-primary btn-sm" target="_blank">View Baptismal Record</a>
					</div>
				</div>

				<h3 class="mt-5">Confirmation Details</h3>
				<div class="row">	
				  <div class="col">
				    <div class="form-group">
				      <label for="date_of_birth">Date of Confirmation</label>
				      <input type="date" class="form-control" name="date_of_confirmation" placeholder="dd/mm/yyyy" required autocomplete="off" value="{{ $c->date_of_confirmation }}">
				    </div>
				  </div>

				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="church">Church of Baptism</label>
				      <select class="form-control" name="church_id">
				        <option value="">-- Select --</option>
				        @foreach($churches as $ch)
				        	<option value="{{$ch->id}}" {{ $c->church_id == $ch->id ? 'selected' : '' }}>{{$ch->name ?? ''}}</option>
				        @endforeach
				        <option value="others" {{ $c->other_church ? 'selected' : '' }}>Others (Please Specify)</option>
				      </select>
				    </div>
				  </div> 

				  <div class="col-sm-6" style="{{$c->other_church ? '' : 'display:none' }}" id="other_church">
				    <div class="form-group">
				      <label>Specify Church here:</label>
				      <input type="text" class="form-control form_data" name="other_church" autocomplete="off" value="{{ $c->other_church ?? '' }}">
				    </div>
				  </div> 		  		  	   		  
				</div>							

				<div class="form-group mt-5">
				   <table class="table">
				      <thead>
				       <tr>
				         <th width="45%">Sponsor Name</th>
				         <th width="45%">Type</th>				      
				       </tr>
				      </thead>

				      <tbody id="sponsor_table">
				       @foreach($c->confirmationSponsors as $s)
				       	<tr class="sponsor_rows">
				       		<input type="hidden" name="sponsor_id[]" value="{{ $s->id }}">
				       		<td>
				       			<input type="text" name="sponsor_name[]" class="form-control form_data" required autocomplete="off" value="{{$s->sponsor_name}}">
				       		</td>
				       		<td>
				       			<select type="text" name="sponsor_gender[]" class="form-control sponsor_gender" required autocomplete="off">
				       				<option value="Godfather" {{ $s->sponsor_gender == 'Godfather' ? 'selected' : '' }}>Godfather</option>
				       				<option value="Godmother" {{ $s->sponsor_gender == 'Godmother' ? 'selected' : '' }}>Godmother</option>
				       			</select>
				       		</td>
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
				      <input type="text" class="form-control" id="facilitator_1" name="facilitator_1" required autocomplete="off" placeholder="Priest Name" value="{{ $c->confirmationFacilitator->facilitator_1 ?? '' }}">
				    </div>
				  </div>

				  <div class="col">
				    <div class="form-group">
				      <label for="facilitator_2">Facilitator 2</label>
				      <input type="text" class="form-control" id="facilitator_2" name="facilitator_2" autocomplete="off" value="{{ $c->confirmationFacilitator->facilitator_2 ?? '' }}">
				    </div>
				  </div>
				</div>
				<div class="row">
				  <div class="col-sm-6">
				    <div class="form-group">
				      <label for="facilitator_3">Facilitator 3</label>
				      <input type="text" class="form-control" id="facilitator_3" name="facilitator_3" autocomplete="off" value="{{ $c->confirmationFacilitator->facilitator_3 ?? '' }}">
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
		            $('#form_edit').submit();
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
