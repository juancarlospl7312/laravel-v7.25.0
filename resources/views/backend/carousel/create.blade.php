<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Carousel | New</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\CarouselController@add') }}" role="form"
                      class="form-crud-edit" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="path">Image *</label>
                            <input type="file" id="path" name="path" required="required">
                            <span class="help-block"></span>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="javascript:;" class="btn btn-primary form-action-ok">Add</a>
                        <a href="javascript:;" class="btn btn-danger form-action-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('backend.includes.actions_form')
