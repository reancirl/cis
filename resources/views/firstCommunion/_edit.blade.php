<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title pr-5">First Communion Record</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="{{ url('first-communion/update', $fc->id) }}" method="post" id="form-update">
          @csrf
          @method('PATCH')
          <input type="hidden" name="baptismal_id" value="{{ $fc->baptismal_id }}">
          <label>Full Name</label>
          <input type="text" class="form-control" value="{{ $fc->baptismal->full_name }}" readonly>

          <label class="pt-3">Church</label>
          <select class="form-control" name="church_id" required id="church">
            <option value="">-- Select --</option>
            @foreach($churches as $c)
              <option value="{{$c->id}}" {{ $fc->church_id == $c->id ? 'selected' : '' }}>{{$c->name ?? ''}}</option>
            @endforeach
            <option value="others" {{ $fc->other_church ? 'selected' : '' }}>Others (Please Specify)</option>
          </select>

          <div id="other_church" style="{{$fc->other_church ? '' : 'display:none' }}">
            <label class="pt-3">Specify Church here:</label>
            <input type="text" class="form-control other_church" name="other_church" value="{{ $fc->other_church ?? '' }}">
          </div>

          <label class="pt-3">Date of First Communion:</label>
          <input type="date" class="form-control" id="date" name="date_of_communion" value="{{ $fc->date_of_communion }}">

        </form> 
      </div>
      <div class="modal-footer">
        <a href="{{ url('baptismal/edit',$fc->baptismal_id) }}" class="btn btn-outline-primary" target="_blank"><i class="fa fa-eye"></i> Show Baptismal Record</a>
        <button type="submit" form="form-update" class="btn btn-primary"><i class="fa fa-check"></i> Edit</button>
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