@extends('layouts.app')

@section('title','Import Records')

@section('content')
    <div class="container-fluid">  
    	<div class="row mb-3">
    		<div class="col-sm-12">
    			<h2 class="pt-2"> 
    				Import Records
    			</h2>
    		</div>
    		<div class="col-sm-12">
    			<button class="btn btn-outline-primary btn-md" type="button"><i class="fa fa-file-import"></i> Import Baptismal Records</button>
    			<button class="btn btn-outline-secondary btn-md ml-3 mr-3" type="button"><i class="fa fa-file-import"></i> Import First Communion Records</button>  
    			<button class="btn btn-primary btn-md" type="button"><i class="fa fa-file-import"></i> Import Confirmation Records</button>  			
    		</div>
    	</div>      
		<hr>
		<div class="row baptismal_import" style="display:none">
			<div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-inline">
                            <div class="form-group">
                                <label>Attach File: </label>&nbsp
                                <input type="file" name="file" required id="fileUpload">
                            </div>
                            <button type="button" class="btn btn-primary" id="upload">Attach</button>
                        </form>
                    </div>
                </div>
            </div>
		</div>

		<div class="col-lg-12 baptismal_import" style="display:none">
		    <form method="post" action="{{ url('import-records/baptismal') }}" id="submit">
		        @csrf
		        <div class="card">
		            <div class="card-block">
		                <div class="table-responsive">
		                    <table class="table table-xxs table-bordered" id="table-import">
		                        <thead>
		                            <tr>
		                                @foreach($columns as $i => $col)
		                                <th>{{ $col }}</th>
		                                @endforeach
		                            </tr>
		                        </thead>
		                        <tbody></tbody>
		                    </table>
		                </div>
		                <div class="float-right m-3">
		                    <a href="#!" id="cancel" class="btn btn-default m-r-20">Cancel</a>
		                    <button type="submit" class="btn btn-primary">Submit</button>
		                </div> 
		            </div>
		        </div>
		    </form>
		</div>
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('.btn-outline-primary').click(function(e){
			$('.baptismal_import').show();
		});

		var inputs = {!! json_encode($columns) !!}; 
		$(function () {
		    
		    $("#upload").bind("click", function () {

		        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
		        var table = $("#table-import tbody");
		        table.empty();
		        if (regex.test($("#fileUpload").val().toLowerCase())) {
		            if (typeof (FileReader) != "undefined") {
		                var reader = new FileReader();
		                reader.onload = function (e) {
		                    var rows = e.target.result.split("\n");
		                    for (var i = 1; i < rows.length; i++) {
		                        var row = $("<tr />");
		                        var cells = rows[i].split(",");
		                        for (var j = 0; j < cells.length; j++) {
		                            var cell_text = cells[j];
		                            var input = '<input type="text" class="border-0 text-center" name="import['+i+']['+inputs[j]+']" title="'+inputs[j]+'" value="'+cell_text+'" >';
		                            var cell = $("<td />");
		                            cell.html(input);
		                            row.append(cell);
		                        }
		                        table.append(row);
		                    }
		                    
		                }
		                reader.readAsText($("#fileUpload")[0].files[0]);
		            } else {
		                alert("This browser does not support HTML5.");
		            }
		        } else {
		            alert("Please upload a valid CSV file.");
		        }
		    });
		});

		$('#cancel').on('click', function(e) { 
		    swal ({
		        text: 'This will delete all data in the table?',
		        showCancelButton: true,
		        icon: 'info',
		        buttons: true,
		        closeModal: false,
		    }).then(result => {
		        if (result == true) {
		            $('#table-import tbody').empty();
		        }
		    });
		});
	</script>
@endsection
