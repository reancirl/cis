@extends('layouts.app')

@section('title','Church')

@section('content')
	@include('church._create')	
    <div class="container-fluid">      		
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Churches 
    				<button class="btn btn-outline-primary btn-sm" data-toggle="modal" data-target="#create_modal" type="button" id="create"><i class="fa fa-plus"></i> Add Church</button>
    			</h2>
    		</div>
    	</div>      
		@include('layouts.include.alerts')    	
    </div>		

	<div class="col-sm-12 grid-margin stretch-card">
		<div class="card">
		  <div class="card-body">
		    <table class="table table-sm table-hover table-bordered rounded" id="church-table">
		      <thead>
		      	<tr>
		      		<th>#</th>
		      		<th>Name</th>
		      		<th>Address</th>
		      		<th width="10%">Action</th>
		      	</tr>
		      </thead>
		      <tbody>
		      	@foreach($church as $i=>$c)
			      	<tr>
			      		<td>{{$i+1}}</td>
			      		<td>{{ $c->name ?? '' }}</td>
	                    <td>{{ $c->address ?? '' }}</td>
			      		<td class="text-center">
			      			<div class="dropdown show">
			      				<a class="dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			      			    	Actions
			      			  	</a>
			      			  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
			      			    	<a class="dropdown-item edit-button" href="#" data-id="{{ $c->id }}" data-url="{{ url('church/edit') }}"><i class="fa fa-edit"></i> Edit</a>
			      			    	<form action="{{ url('church/delete', $c->id )}}" method="post" class="form-delete">
			      			    		@csrf
			      			    		@method('DELETE')
			      			    	</form>
			      			    	<button type="button" class="dropdown-item delete_btn" href="#"><i class="fa fa-trash"></i> Delete</button>
			      			  	</div>
			      			</div>
			      		</td>
			      	</tr>
		      	@endforeach
			  </tbody>
		    </table>
		  </div>
		</div>
	</div>
<div class="append-edit"></div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('.delete_btn').click(function(e){
			e.preventDefault();
			swal({
			    text: 'Are you sure you want to delete this?',
			    showCancelButton: true,
			    icon: "warning",
			    buttons: true,
			    closeModal: false,
			}).then(result => {
				if (result == true) {
		            $('.form-delete').submit();
		        }
	        });
		});

		$(document).on('click', '.edit-button', function(){
            var div = $('.append-edit');
            div.empty();

            var id = $(this).data('id');
            var url = $(this).data('url') + '/' + id;
            $.ajax({
                url: url,
                data: id,
                success:function(data){
                    div.append(data);   
                    $('#edit_modal').modal('show');                 
                }
            });
        });
	</script>
@endsection