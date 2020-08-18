<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">News | Edit</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\NewsController@update') }}" role="form" class="form-crud-edit" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $entity->id }}">
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
                                        <input type="text" class="form-control" name="title_en" id="title_en" required="required" value="{{ $entity->title }}">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_en">Description *</label>
                                        <textarea class="form-control" name="description_en" rows="1" id="description_en" required="required">{{ $entity->description }}</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ckeditor_en">Content *</label>
                                        <textarea id="ckeditor_en" class="form-control editor" name="content_en" rows="3" required="required">{{ $entity->content }}</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                                <div class="tab-pane" id="tab_es">
                                    <div class="form-group">
                                        <label for="title_es">Título *</label>
                                        <input type="text" class="form-control" name="title_es" id="title_es" required="required" value="{{ $translations['es']->title }}">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="description_es">Descripción *</label>
                                        <textarea class="form-control" name="description_es" rows="1" id="description_es" required="required">{{ $translations['es']->description }}</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="form-group">
                                        <label for="ckeditor_es">Contenido *</label>
                                        <textarea id="ckeditor_es" class="form-control editor" name="content_es" rows="3" required="required" >{{ $translations['es']->content }}</textarea>
                                        <span class="help-block"></span>
                                    </div>
                                </div>
                                <!-- /.tab-pane -->
                            </div>
                            <!-- /.tab-content -->
                        </div>
                        <div class="form-group">
                            <label for="categories_many">Categories *</label>
                            <select class="form-control select2" multiple="multiple" name="categories_many[]" id="categories_many" data-value="{{ $entity->categories }}" required="required" style="width: 100%;">
                                @foreach($categories as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="tag_many">Tags *</label>
                            <select class="form-control select2" multiple="multiple" name="tags_many[]" id="tag_many" data-value="{{ $entity->tags }}" required="required" style="width: 100%;">
                                @foreach($tags as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="tag_many">Gallery</label>
                            <select class="form-control select2" name="gallery_id" id="gallery_id" data-value="{{ $entity->gallery_id }}" style="width: 100%;">
                                @foreach($galleries as $item)
                                    <option value="{{ $item->id }}">{{ $item->title }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <div class="col-md-9" style="padding-left: 0;">
                                <label for="path">Imagen</label>
                                <input type="file" id="path" name="path">
                                <span class="help-block"></span>
                            </div>
                            <div class="col-md-3">
                                <img class="img-responsive" src="{{ asset('storage/' . $entity->path) }}">
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <a href="javascript:;" class="btn btn-primary form-action-ok">Update</a>
                        <a href="javascript:;" class="btn btn-danger form-action-cancel">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('backend.includes.actions_form')

<script>
    jQuery(document).ready(function () {
        let select2 = $("select.select2");
        select2.each(function(){
            $(this).select2({
                placeholder: "Select",
                allowClear: true
            });
            let data_value_select2 = $(this).attr('data-value');
            if(data_value_select2 !== ''){
                data_value_select2 = jQuery.parseJSON(data_value_select2);
            }
            if($(this).attr('multiple') === undefined){
                $(this).val(data_value_select2).trigger('change');
            }
            else{
                let array_select2_multiple = [];
                for(let i = 0; i < data_value_select2.length; i++){
                    array_select2_multiple[i] = data_value_select2[i].pivot.tag_id || data_value_select2[i].pivot.category_id;
                }
                $(this).val(array_select2_multiple).trigger('change');
            }
        });
    });
</script>
