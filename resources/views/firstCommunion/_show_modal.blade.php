<div class="modal fade" id="show_modal" tabindex="-1" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Personal Data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
          <label>Full Name</label>
          <input type="text" class="form-control" value="{{ $bap->full_name }}" readonly>

          <label class="pt-3">Gender</label>
          <input type="text" class="form-control" value="{{ $bap->gender }}" readonly>

          <label class="pt-3">Date of Birth:</label>
          <input type="date" class="form-control" value="{{ $bap->date_of_birth }}" readonly>

          <label class="pt-3">Place of Birth</label>
          <input type="text" class="form-control" value="{{ $bap->place_of_birth }}" readonly>

          <label class="pt-3">Mother's Maiden Name</label>
          <input type="text" class="form-control" value="{{ $bap->mothers_maiden_name }}" readonly>

          <label class="pt-3">Father's Name</label>
          <input type="text" class="form-control" value="{{ $bap->fathers_name }}" readonly>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="{{ url('baptismal/edit', $bap->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i> Show Baptismal Record</a>
      </div>
    </div>
  </div>
</div>