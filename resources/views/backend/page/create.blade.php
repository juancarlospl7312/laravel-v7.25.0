<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Page | New</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\PageController@add') }}" role="form" class="form-crud-edit" enctype="multipart/form-data">
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
                                        <textarea class="form-control" name="description_en" rows="1" id="description_en" required="required"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ckeditor_en">Content *</label>
                                        <textarea id="ckeditor_en" class="form-control editor" name="content_en" rows="3" required="required"></textarea>
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
                                        <textarea class="form-control" name="description_es" rows="1" id="description_es" required="required"></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ckeditor_es">Contenido *</label>
                                        <textarea id="ckeditor_es" class="form-control editor" name="content_es" rows="3" required="required" ></textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <div class="form-group">
                            <label for="category_id">Category</label>
                            <select class="form-control select2" name="category_id" id="category_id" data-value="" style="width: 100%;">
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="path">Imagen</label>
                            <input type="file" id="path" name="path">
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
