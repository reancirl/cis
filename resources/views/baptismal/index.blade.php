@extends('layouts.app')

@section('title','Baptismal')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Baptismal 
    				<a class="btn btn-outline-primary btn-sm" href="{{ url('baptismal/create') }}"><i class="fa fa-plus"></i> Add Baptismal</a>    			   		        
    			</h2>
    		</div>
    	</div>      
		
		<div class="row">
		    <div class="col-sm-12">
		        <div class="card m-b-10">
		            <div class="card-block">
		                <form id="filter">
		                    <table class="table table-bordered table-sm mb-0">
		                        <thead class="table-secondary">
		                            <tr>
		                                <th class="text-center">Church</th>
		                                <th class="text-center">Type</th>
		                                <th class="text-center">Status</th>
		                                <th class="text-center" width="15%">
		                                    <i class="fa fa-filter"></i>
		                                </th>
		                            </tr>
		                        </thead>
		                        <tbody>
		                            <tr>
		                                <th>
		                                    <select class="form-control" name="student_type" id="type">
		                                        
		                                    </select>
		                                </th>
		                                <th>
		                                    <select class="form-control" name="student_type" id="type">
		                                        
		                                    </select>
		                                </th>
                   
		                                <th id="term">
		                                    <select class="form-control" name="term" required>
		                                        
		                                    </select>
		                                </th>    
		                                <th>
		                                    <button type="submit" class="btn btn-primary btn-block">Filter</button>
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
