<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Gallery | Details</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <div class="box-body">
                    <!-- Custom Tabs -->
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#tab_en" data-toggle="tab">EN</a></li>
                            <li><a href="#tab_es" data-toggle="tab">ES</a></li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_en">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Title:</label>
                                    <div class="col-md-10">{{ $entity->title }}</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Slug:</label>
                                    <div class="col-md-10">{{ $entity->slug }}</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Description:</label>
                                    <div class="col-md-10">{{ $entity->description }}</div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_es">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Título:</label>
                                    <div class="col-md-10">{{ $translations['es']->title }}</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Slug:</label>
                                    <div class="col-md-10">{{ $translations['es']->slug }}</div>
                                </div>
                                <div class="clearfix"></div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Descrpción:</label>
                                    <div class="col-md-10">{{ $translations['es']->description }}</div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <div class="clearfix"></div><br>
                    <div class="form-group">
                        <label class="control-label col-md-2">Images:</label>
                        <div class="clearfix"></div><br>
                        <div class="gallery-files-list">
                            @foreach($entity->galleryFiles() as $item)
                                <div class="col-lg-3 form-group">
                                    <img class="img-responsive" src="storage/{{ $item->path }}" />
                                </div>
                                @if($loop->iteration % 4 == 0)
                                    <div class="clearfix"></div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger form-action-cancel">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.includes.actions_form')
