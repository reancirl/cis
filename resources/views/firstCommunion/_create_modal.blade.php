<div class="modal fade" id="create_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Create First Communion</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('first-communion') }}" method="post" id="form-create">
          @csrf
          <input type="hidden" name="baptismal_id" value="{{ $bap->id }}">
          <label>Full Name</label>
          <input type="text" class="form-control" value="{{ $bap->full_name }}" readonly>

          <label class="pt-3">Church</label>
          <select class="form-control" name="church_id" required id="church">
            <option value="">-- Select --</option>
            @foreach($churches as $c)
              <option value="{{$c->id}}">{{$c->name ?? ''}}</option>
            @endforeach
            <option value="others">Others (Please Specify)</option>
          </select>

          <div id="other_church" style="display:none">
            <label class="pt-3">Specify Church here:</label>
            <input type="text" class="form-control other_church" name="other_church">
          </div>

          <label class="pt-3">Date of First Communion:</label>
          <input type="date" class="form-control" id="date" name="date_of_communion" placeholder="dd/mm/yyyy">

        </form> 
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" form="form-create" class="btn btn-primary"><i class="fa fa-check"></i> Submit</button>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#church').change(function() {
      let value = this.value;
      if (value == 'others') {
        $('#other_church').show();
      }
      else $('#other_church').hide();
  });
</script>