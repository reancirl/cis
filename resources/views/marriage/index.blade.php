@extends('layouts.app')

@section('title','Marriage')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Marriage 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url('marriage/create') }}"><i class="fa fa-plus"></i> Add Marriage</a>    			   		        
    			</h2>
    		</div>
    	</div>      
		<hr>
		<div class="row">
		    <div class="col-sm-12">
		        <div class="card m-b-10">
		            <div class="card-block">
		                <form id="filter">
		                	<input type="hidden" name="filter" value="true">
		                    <table class="table table-bordered table-sm mb-0">
		                        <thead class="table-secondary">
		                            <tr>
		                            	<th class="text-center">Name</th>
		                                <th class="text-center">Church</th>		                               
		                                <th class="text-center" width="15%">
		                                    <i class="fa fa-filter"></i>
		                                </th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr>
		                            	<th>
		                            		<input type="text" name="name" class="form-control" placeholder="Search .." value="{{ $request->name ?? '' }}">
		                            	</th>
		                                <th>
		                                    <select class="form-control" name="church">
		                                    	<option value="">-- Select --</option>
		                                        @foreach($churches as $c)
		                                        	<option value="{{ $c->id }}" {{ $request->church == $c->id ? 'selected' : '' }}>{{$c->name ?? ''}}</option>
		                                        @endforeach
		                                        <option value="others" {{$request->church == 'others' ? 'selected' : ''}}>Others</option>
		                                    </select>
		                                </th>   
		                                <th>
		                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
		                                    @if($request->filter)
		                                    	<a href="{{ url('/marriage') }}" class="btn btn-outline-danger btn-block">Clear Filter</button>
		                                    @endif
		                                </th>
		                            </tr>
		                        </tbody>
		                    </table>
		                </form>
		            </div>
		        </div>
		    </div>
		</div>
		@if($request->filter)
	        <div class="card">
	            <div class="card-block">
	                <table id="" class="table table-hover table-responsive-sm">
	                    <thead>
	                        <tr>
	                            <th width="3%">#</th>
	                            <th>Husband Name</th>
	                            <th>Wife Name</th>
	                            <th>Church</th>
	                            <th>Date of Marriage</th>
	                            <th class="text-center">Action</th>                 
	                        </tr>
	                    </thead>
	                    <tbody>
	                        @foreach ($marriages as $i => $m)
	                            <tr>
	                            	<td>{{++$i}}</td>
	                            	<td>{{$m->husband->full_name ?? ''}}</td>
	                            	<td>{{$m->wife->full_name ?? ''}}</td>
	                            	<td>{{$m->church->name ?? $m->other_church}}</td>
	                            	<td>{{ $m->marriage_date ?? '' }}</td>
	                            	<td class="text-center">
	                            		<div class="dropdown show">
	                            			<a class="dropdown-toggle btn-sm" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
	                            		    	Actions
	                            		  	</a>
	                            		  	<div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
	                            		    	<a class="dropdown-item edit-button" href="{{ url('marriage/edit', $m->id) }}"><i class="fa fa-eye"></i> Edit Record</a>
	                            		    	<form action="{{ url('marriage/delete', $m->id )}}" method="post" class="form-delete">
	                            		    		@csrf
	                            		    		@method('DELETE')
	                            		    		<button type="submit" class="dropdown-item delete_btn" href="#"><i class="fa fa-trash"></i> Delete</button>                         		    	
	                            		    	</form>
	                            		  	</div>
	                            		</div>
	                            	</td>
	                            </tr>
	                        @endforeach
	                    </tbody>                                                                            
	                </table>
	            </div>
	        </div>
	        <div class="row">
	        	<div class="col d-flex justify-content-center">
	            	{{ $marriages->links() }}       		
	        	</div>
	        </div>
        @endif
    </div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('.form-delete').on('submit',function(e){
			e.preventDefault();
			swal({
			    text: 'Are you sure you want to delete this?',
			    showCancelButton: true,
			    icon: "warning",
			    buttons: true,
			    closeModal: false,
			}).then(result => {
				if (result == true) {
		            $(this).submit();
		        }
	        });
		});
	</script>
@endsection
