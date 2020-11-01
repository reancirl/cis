@extends('layouts.app')

@section('title','Confirmation')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Create Confirmation
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>     			   		        
    			</h2>
    		</div>
    	</div>      
		<hr>
		<form id="filter">
			<input type="hidden" name="filter" value="true">
			<div class="input-group">
		    	<input type="text" class="form-control" name="name" placeholder="Search Parishioner..." value="{{ $request->name ?? '' }}" required>
		    	<div class="input-group-btn">
		    	    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
		    	    @if($request->filter)
		    	    	<a href="{{ url('confirmation/create') }}" class="btn btn-outline-danger">Clear Filter</a>
		    	    @endif
		    	</div>		    
			</div>
		</form>

		@if($request->filter)
	        <div class="card mt-4">
	            <div class="card-block">
	                <table id="" class="table table-hover table-responsive-sm">
	                    <thead>
	                        <tr>
	                            <th width="5%">#</th>
	                            <th>Name</th>
	                            <th>Gender</th>
	                            <th>Church of Baptismal</th>
	                            <th>Date of Baptismal</th>
	                            <th>Age</th>           
	                            <th class="text-center">Action</th>                 
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach ($baptismals as $i => $bap)
	                            <tr>
	                            	<td>{{++$i}}</td>
	                            	<td>{{$bap->full_name ?? ''}}</td>
	                            	<td>{{$bap->gender ?? ''}}</td>
	                            	<td>{{$bap->church->name ?? $bap->other_church}}</td>
	                            	<td>{{ $bap->baptismal_date ?? '' }}</td>
	                            	<td>{{ $bap->age ?? '' }}</td>
	                            	<td class="text-center">
	                            		<div class="dropdown show">
	                            			<a class="dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            		    	Actions
	                            		  	</a>
	                            		  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                            		    	<a class="dropdown-item edit_button" href="{{ url('confirmation/create',$bap->id) }}"><i class="fa fa-plus"></i> Add Record</a>
	                            		    	<a class="dropdown-item show_button" href="#!" data-id="{{ $bap->id }}" data-url="{{ url('first-communion/create') }}"><i class="fa fa-eye"></i> Show Personal Data</a>
	                            		  	</div>
	                            		</div>
	                            	</td>
	                            </tr>
	                        @endforeach
	                    </tbody>                                                                            
	                </table>
	            </div>
	        </div>
        @endif

    </div>
   	<div class="append-edit"></div>
@endsection
@section('scripts')
	<script type="text/javascript">
        $('.show_button').click(function(){
            let div = $('.append-edit');
            div.empty();

            let id = $(this).data('id');
            let url = $(this).data('url') + '/' + id + '?show=true';
            $.ajax({
                url: url,
                data: id,
                success:function(data){
                    div.append(data);   
                    $('#show_modal').modal('show');                 
                }
            });
        });
	</script>
@endsection
