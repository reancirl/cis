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
    			<button class="btn btn-primary btn-md btn-confirmation-primary" type="button"><i class="fa fa-file-import"></i> Import Confirmation Records</button>  			
    		</div>
    	</div>      
		<hr>
		<div id="baptismal_import" style="display:none;">
			@include('import._baptismal')
		</div>
		<div id="confirmation_import" style="display:none;">
			@include('import._confirmation')
		</div>
		<div id="communion_import" style="display:none;">
			@include('import._communion')
		</div>		
	</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('.btn-outline-primary').click(function(e){
			$('#baptismal_import').show();
			$('#confirmation_import').hide();
			$('#communion_import').hide();
		});
		$('.btn-outline-secondary').click(function(e){
			$('#communion_import').show();
			$('#baptismal_import').hide();
			$('#confirmation_import').hide();
		});
		$('.btn-confirmation-primary').click(function(e){
			$('#baptismal_import').hide();
			$('#confirmation_import').show();
			$('#communion_import').hide();
		});
		
		var baptismal_inputs = {!! json_encode($baptismal_columns) !!}; 
		$(function () {		    
		    $("#baptismal_attach").bind("click", function () {
		        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
		        var table = $("#baptismal_table tbody");
		        table.empty();
		        if (regex.test($("#baptismalUpload").val().toLowerCase())) {
		            if (typeof (FileReader) != "undefined") {
		                var reader = new FileReader();
		                reader.onload = function (e) {
		                    var rows = e.target.result.split("\n");
		                    for (var i = 1; i < rows.length; i++) {
		                        var row = $("<tr />");
		                        var cells = rows[i].split(",");
		                        for (var j = 0; j < cells.length; j++) {
		                            var cell_text = cells[j];
		                            var input = '<input type="text" class="border-0 text-center" name="import['+i+']['+baptismal_inputs[j]+']" title="'+baptismal_inputs[j]+'" value="'+cell_text+'" >';
		                            var cell = $("<td />");
		                            cell.html(input);
		                            row.append(cell);
		                        }
		                        table.append(row);
								$('.footer_submit').show();
		                    }
		                    
		                }
		                reader.readAsText($("#baptismalUpload")[0].files[0]);
		            } else {
		                alert("This browser does not support HTML5.");
		            }
		        } else {
		            alert("Please upload a valid CSV file.");
		        }
		    });
		});

		var communion_inputs = {!! json_encode($first_communion_columns) !!}; 
		$(function () {		    
		    $("#communion_attach").bind("click", function () {
		        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
		        var table = $("#communion_table tbody");
		        table.empty();
		        if (regex.test($("#communionUpload").val().toLowerCase())) {
		            if (typeof (FileReader) != "undefined") {
		                var reader = new FileReader();
		                reader.onload = function (e) {
		                    var rows = e.target.result.split("\n");
		                    for (var i = 1; i < rows.length; i++) {
		                        var row = $("<tr />");
		                        var cells = rows[i].split(",");
		                        for (var j = 0; j < cells.length; j++) {
		                            var cell_text = cells[j];
		                            var input = '<input type="text" class="border-0 text-center" name="import['+i+']['+communion_inputs[j]+']" title="'+communion_inputs[j]+'" value="'+cell_text+'" >';
		                            var cell = $("<td />");
		                            cell.html(input);
		                            row.append(cell);
		                        }
		                        table.append(row);
								$('.footer_submit').show();
		                    }
		                    
		                }
		                reader.readAsText($("#communionUpload")[0].files[0]);
		            } else {
		                alert("This browser does not support HTML5.");
		            }
		        } else {
		            alert("Please upload a valid CSV file.");
		        }
		    });
		});

		var confirmation_inputs = {!! json_encode($confirmation_columns) !!}; 
		$(function () {		    
		    $("#confirmation_attach").bind("click", function () {
		        var regex = /^([a-zA-Z0-9\s_\\.\-:])+(.csv|.txt)$/;
		        var table = $("#confirmation_table tbody");
		        table.empty();
		        if (regex.test($("#confirmationUpload").val().toLowerCase())) {
		            if (typeof (FileReader) != "undefined") {
		                var reader = new FileReader();
		                reader.onload = function (e) {
		                    var rows = e.target.result.split("\n");
		                    for (var i = 1; i < rows.length; i++) {
		                        var row = $("<tr />");
		                        var cells = rows[i].split(",");
		                        for (var j = 0; j < cells.length; j++) {
		                            var cell_text = cells[j];
		                            var input = '<input type="text" class="border-0 text-center" name="import['+i+']['+confirmation_inputs[j]+']" title="'+confirmation_inputs[j]+'" value="'+cell_text+'" >';
		                            var cell = $("<td />");
		                            cell.html(input);
		                            row.append(cell);
		                        }
		                        table.append(row);
								$('.footer_submit').show();
		                    }
		                    
		                }
		                reader.readAsText($("#confirmationUpload")[0].files[0]);
		            } else {
		                alert("This browser does not support HTML5.");
		            }
		        } else {
		            alert("Please upload a valid CSV file.");
		        }
		    });
		});

		$('.btn_cancel').on('click', function(e) { 
		    swal ({
		        text: 'This will delete all data in the table.',
		        showCancelButton: true,
		        icon: 'info',
		        buttons: true,
		        closeModal: false,
		    }).then(result => {
		        if (result == true) {
		            $('#baptismal_table tbody').empty();
					$('#confirmation_table tbody').empty();
					$('#communion_table tbody').empty();
					$('.footer_submit').hide();
		        }
		    });
		});
	</script>
@endsection
