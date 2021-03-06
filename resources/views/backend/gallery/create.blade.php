<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Gallery | New</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\GalleryController@add') }}" role="form" class="form-crud-edit" enctype="multipart/form-data">
                    <div class="box-body">
                    {{ csrf_field() }}
                    <!-- Custom Tabs -->
                        <div class="nav-tabs-custom">
                            <ul class="nav nav-tabs">
                                <li class="active"><a href="#tab_en" data-toggle="tab">EN</a></li>
                                <li><a href="#tab_es" data-toggle="tab">ES</a></li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_en">
                                    <div class="form-group">
                                        <label for="title_en">Title *</label>
                                        <input type="text" class="form-control" name="title_en" id="title_en" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">Description *</label>
                                        <input type="text" class="form-control" name="description_en" id="description_en" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_es">
                                    <div class="form-group">
                                        <label for="title_es">Título *</label>
                                        <input type="text" class="form-control" name="title_es" id="title_es" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_es">Descripción *</label>
                                        <input type="text" class="form-control" name="description_es" id="description_es" required="required">
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->

                            <div class="form-group">
                                <label for="path">Images *</label>
                                <input class="files-input" type="file" id="path" name="gallery_files[]" required="required" multiple="multiple">
                                <span class="help-block"></span>
                            </div>
                            <div class="form-group">
                                <div class="gallery-files-list row"></div>
                            </div>
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
