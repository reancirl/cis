<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Edit Church</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('church/update', $church->id) }}" method="post" id="form-update">
          @csrf
          @method('PATCH')
          <label>Name</label>
          <input type="text" class="form-control" placeholder="Church Name" name="name" value="{{$church->name ?? ''}}" required>
          <label class="pt-2">Address</label>
          <input type="text" class="form-control" placeholder="Church Address" name="address" value="{{$church->address ?? ''}}" required>
        </form>  
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="form-update" class="btn btn-primary"><i class="fa fa-check"></i> Update Church</button>
      </div>
    </div>
  </div>
</div>