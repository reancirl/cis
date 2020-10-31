@extends('layouts.app')

@section('title','Marriage Record')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Create Marriage Record
    				<a class="btn btn-outline-primary btn-sm" href="{{ url()->previous() }}"><i class="fa fa-arrow-left"></i> Go back</a>     			   		        
    			</h2>
    		</div>
    	</div>      
		<hr>
		<form id="filter">
			<input type="hidden" name="filter" value="true">
			<div class="row">

				<div class="col-sm-5">
					<div class="input-group">
				    	<input type="text" class="form-control" name="husband_name" placeholder="Search Parishioner..." value="{{ $request->husband_name ?? '' }}" required>
				    	<div class="input-group-btn">
				    	    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
				    	    @if($request->husband_name)
				    	    	<a href="{{ url('confirmation/create') }}" class="btn btn-outline-danger">Clear Filter</a>
				    	    @endif
				    	</div>		    
					</div>
				</div>
				<div class="col-sm-2"></div>
				<div class="col-sm-5">
					<div class="input-group">
				    	<input type="text" class="form-control" name="husband_name" placeholder="Search Parishioner..." value="{{ $request->husband_name ?? '' }}" required>
				    	<div class="input-group-btn">
				    	    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i> Search</button>
				    	    @if($request->husband_name)
				    	    	<a href="{{ url('confirmation/create') }}" class="btn btn-outline-danger">Clear Filter</a>
				    	    @endif
				    	</div>		    
					</div>
				</div>

			</div>			

		</form>


    </div>
@endsection
@section('scripts')
	<script type="text/javascript">

	</script>
@endsection
