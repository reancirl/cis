<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-8">
                        <form class="form-inline">
                            <div class="form-group">
                                <label>Attach File: </label>&nbsp
                                <input type="file" name="file" required id="confirmationUpload">
                            </div>
                            <button type="button" class="btn btn-primary" id="confirmation_attach">Attach</button>
                        </form>
                    </div>
                    <div class="col-sm-4 mt-2">
                        <a href="csv/confirmation_import_template.csv" download><i class="fa fa-download"></i> Download Confirmation Import Template </a>
                    </div>
                </div>                
            </div>
        </div>
    </div>
</div>

<div class="col-lg-12">
    <form method="post" action="{{ url('import-records/confirmation') }}">
        @csrf
        <div class="card">
            <div class="card-block">
                <div class="table-responsive">
                    <table class="table table-xxs table-bordered" id="confirmation_table">
                        <thead>
                            <tr>
                                @foreach($confirmation_columns as $i => $col)
                                    <th>{{ $col }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody></tbody>
                    </table>
                </div>
                <div class="float-right m-3 footer_submit" style="display:none;">
                    <a href="#!" class="btn btn-default m-r-20 btn_cancel">Cancel</a>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div> 
            </div>
        </div>
    </form>
</div>