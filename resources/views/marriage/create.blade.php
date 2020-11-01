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
		<div class="row">

			<div class="col-sm-5">
				<form id="form-husband-search">
				    <div class="row">
				        <div class="col-sm-10">
				            <input type="text" name="husband_name" class="form-control" placeholder="Search Husband Record .." autocomplete="off">
				            <div class="row">
				            	<div class="col-sm-10">
				            		<div class="search-result" style="display: none">
				            		    <div class="search-preloader">
				            		        <i class="fa fa-spin fa-spinner"></i>
				            		    </div>
				            		    <div class="card scrollit">
				            		        <div class="card-block p-0">
				            		            <table class="table table-xxs mb-0" id="table-search">
				            		                <tbody>
				            		                </tbody>
				            		            </table>
				            		        </div>
				            		    </div>
				            		</div>
				            	</div>
				            </div>				             
				        </div>
				        <div class="col-sm-2">
				            <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fa fa-search"></i><i class="fa fa-spin fa-spinner loader_icon" style="display:none"></i> Search</button>
				            <span class="badge badge-pill badge-success" style="display:none"><i class="fa fa-check"></i> Husband Added</span>
				        </div>
				    </div>
				</form>
			</div>

			<div class="col-sm-2"></div>	

			<div class="col-sm-5">
				<form id="form-wife-search">
				    <div class="row">
				        <div class="col-sm-10">
				            <input type="text" name="wife_name" class="form-control" placeholder="Search Wife Record .." autocomplete="off">
				            <div class="row">
				            	<div class="col-sm-10">
				            		<div class="search-result" style="display: none">
				            		    <div class="search-preloader">
				            		        <i class="fa fa-spin fa-spinner"></i>
				            		    </div>
				            		    <div class="card scrollit">
				            		        <div class="card-block p-0">
				            		            <table class="table table-xxs mb-0" id="table-search">
				            		                <tbody>
				            		                </tbody>
				            		            </table>
				            		        </div>
				            		    </div>
				            		</div>
				            	</div>
				            </div>				             
				        </div>
				        <div class="col-sm-2">
				            <button type="submit" class="btn btn-primary btn-md btn-block"><i class="fa fa-search"></i><i class="fa fa-spin fa-spinner loader_icon" style="display:none"></i> Search</button>
				            <span class="badge badge-pill badge-success" style="display:none"><i class="fa fa-check"></i> Wife Added</span>
				        </div>
				    </div>
				</form>
			</div>		
		</div>

		<div id="couple_data" style="display:none;">
			<div class="row">
				<div class="col-sm-3"></div>
				<div class="col-sm-6">
					<div class="card mt-4">
					    <div class="card-block">
					        <table id="couple_table" class="table table-responsive-xxs">
					            <thead>
					            	<th width="30%">Label</th>
					            	<th width="60%">Full Name</th>
					            	<th width="10%">Age</th>
					            </thead>
					            <tbody></tbody> 				                                                                                      
					        </table>
					    </div>
					</div>
				</div>
				<div class="col-sm-3"></div>
			</div>
			<div class="row">
				<div class="col-sm-12 d-flex justify-content-center">
					<a href="{{ url('marriage/create') }}" class="btn btn-secondary btn-md"><i class="fas fa-sync"></i> Refresh Page</a>&nbsp&nbsp
					<button type="button" class="btn btn-primary btn-md" style="display:none"><i class="fa fa-plus"></i> Create Marriage Record</button>
				</div>
			</div>
		</div>							
    </div>
    <div class="append-div"></div>
@endsection
@section('scripts')
	<script type="text/javascript">		
		$('#form-husband-search').on('submit', function(event) {
	        event.preventDefault();

	        let form = $(this);
	        let button = $(this).find('button');
	        let url = "{!! url('marriage/create') !!}";
	        let table = $('#form-husband-search .search-result table tbody');
	        let result = $('#form-husband-search .search-result');
	        let loader = $('#form-husband-search .search-preloader');
	        let search = $('#form-husband-search .fa-search');
	        let loader_icon = $('#form-husband-search .loader_icon');
	        table.empty();
	        result.show();
	        loader.show();
	        search.hide();
	        loader_icon.show();
	        button.attr('disabled', true);

	        $.ajax({
	            url: url,
	            data: form.serialize(),
	            success: function(data) {
	                loader.hide();
	                search.show();
	                loader_icon.hide();
	                button.removeAttr('disabled');
	                if (data.length > 0){
		                $.each(data, function(s, data) {
		                    let tr = $('<tr>');
		                    tr.append('<td>' + data['last_name'] +', '+ data['first_name'] +'&nbsp'+ data['middle_name'] +'</td>');
		                    tr.append('<td><a href="#!" data-id="'+ data['baptismal_id'] +'" data-url="{{ url('marriage/show') }}" class="btn btn-outline-primary btn-sm p-1 btn_view_husband">&nbsp<i class="fa fa-eye"></i>&nbspView Data &nbsp </a></td>');
		                    table.append(tr);
		                });   
	                } else {
	                	let tr = $('<tr class="clickable-row">');
	                	tr.append('<td> <span class="text-danger">-- NO DATA AVAILABLE --</span> </td>');
	                	table.append(tr);
	                }   
	            }
	        });
	    });

	    $('#form-wife-search').on('submit', function(event) {
	        event.preventDefault();

	        let form = $(this);
	        let button = $(this).find('button');
	        let url = "{!! url('marriage/create') !!}";
	        let table = $('#form-wife-search .search-result table tbody');
	        let result = $('#form-wife-search .search-result');
	        let loader = $('#form-wife-search .search-preloader');
	        let search = $('#form-wife-search .fa-search');
	        let loader_icon = $('#form-wife-search .loader_icon');
	        table.empty();
	        result.show();
	        loader.show();
	        search.hide();
	        loader_icon.show();
	        button.attr('disabled', true);

	        $.ajax({
	            url: url,
	            data: form.serialize(),
	            success: function(data) {
	                loader.hide();
	                search.show();
	                loader_icon.hide();
	                button.removeAttr('disabled');
	                if (data.length > 0){
		                $.each(data, function(s, data) {
		                    var tr = $('<tr>');
		                    tr.append('<td>' + data['last_name'] +', '+ data['first_name'] +'&nbsp'+ data['middle_name'] +'</td>');
		                    tr.append('<td><a href="#!" data-id="'+ data['baptismal_id'] +'" data-url="{{ url('marriage/show') }}" class="btn btn-outline-primary btn-sm p-1 btn_view_husband">&nbsp<i class="fa fa-eye"></i>&nbspView Data &nbsp </a></td>');
		                    table.append(tr);
		                });   
	                } else {
	                	var tr = $('<tr class="clickable-row">');
	                	tr.append('<td> <span class="text-danger">-- NO DATA AVAILABLE --</span> </td>');
	                	table.append(tr);
	                }   
	            }
	        });
	    });

	    $('.search-result').on('click','.btn_view_husband',function(e){
            let div = $('.append-div');
            div.empty();

            let id = $(this).data('id');
            let url = $(this).data('url') + '/' + id;
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
