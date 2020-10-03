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
			      			    	<a class="dropdown-item" href="#">Edit</a>
			      			    	<form action="{{ url('church/delete', $c->id )}}" method="post" class="form-delete">
			      			    		@csrf
			      			    		@method('DELETE')
			      			    	</form>
			      			    	<button type="button" class="dropdown-item delete-button" href="#">Delete {{$c->id}}</button>
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
<div class="append-lab">
	public function history($id)
    {
        $laboratory = LaboratoryFee::find($id);
        $histories = $laboratory->histories;
        return view('fees::laboratory._history', compact('laboratory', 'histories'));
    }
</div>
@endsection
@section('scripts')
	<script type="text/javascript">
		$('.delete-button').click(function(e){
			e.preventDefault();
			swal({
			    text: 'Are you sure you want to delete this?',
			    showCancelButton: true,
			    icon: "warning",
			    buttons: true,
			    closeModal: false,
			}).then(result => {
	            $('.form-delete').submit();
	        });
		});

		$(document).on('click', '.btn-lab', function(){
            var div = $('.append-lab');
            div.empty();

            var id = $(this).data('id');
            var url = $(this).data('url') + '/' + id;

            var form = $('#form-update');
            var form_url = '{{ url('admin/fees/laboratory') }}' + '/' + id;
            form.prop('action', form_url);

            $.ajax({
                url: url,
                data: id,
                success:function(data){
                    div.append(data);
                    $('#edit_fee').modal('show');
                }
            });
        });
	</script>
@endsection