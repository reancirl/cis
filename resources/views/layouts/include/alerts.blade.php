@if (count($errors)>0)
	@foreach($errors->all() as $error)
		<div class="row">
			<div class="col-sm-12">
			    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color:#ffcccb;border: 1px solid black;">
			      	<span style="color:black">{{$error}}</span>
		            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
		                <span>&times;</span>
		            </button>
			    </div>
			</div>
		</div>
	@endforeach
@endif