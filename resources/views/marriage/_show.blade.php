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

          <label class="pt-3">Age</label>
          <input type="text" class="form-control" value="{{ $bap->age }}" readonly>

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
        <a href="#!" class="btn btn-primary btn_set" data-url="{{ url('marriage/show') }}" data-id="{{ $bap->id }}" data-gender="{{ $bap->gender }}"><i class="fa fa-check"></i> Add data</a>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $('#show_modal').on('click','.btn_set',function(e){
    let table = $('#couple_table');
    let div = $('#couple_data');    
    $('#show_modal').modal('hide');
    div.show();     
    let id = $(this).data('id');
    let gender = $(this).data('gender');
    let url = $(this).data('url') + '/' + id + '?couple=true&gender=' + gender;
    $.ajax({
      url: url,
      data: id,
      success: function(data) {
        var tr = $('<tr>');
        tr.append('<td>' + data.label +'</td>');
        tr.append('<td>' + data.full_name +'</td>');
        tr.append('<td>' + data.age +'</td>');
        table.append(tr);
        if (data.label == 'Husband') {
          $('#form-husband-search input').prop('readonly',true);
          $('#form-husband-search .search-result table tbody').hide();
          $('#form-husband-search button').hide();
          $('#form-husband-search .badge-success').show();
        } else {
          $('#form-wife-search input').prop('readonly',true);
          $('#form-wife-search .search-result table tbody').hide();
          $('#form-wife-search button').hide();
          $('#form-wife-search .badge-success').show();
        }

        if($('#couple_table tbody tr').length == 2) {
          $('#couple_data button').show();
        } else { 
          $('#couple_data button').hide();
        }
      }
    });
  });
</script>