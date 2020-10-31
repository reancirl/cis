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
		                                    	<a href="{{ url('/baptismal') }}" class="btn btn-outline-danger btn-block">Clear Filter</button>
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
