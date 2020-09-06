<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">Page | Details</div>
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
                                    <div class="col-lg-2"><label class="control-label">Title:</label></div>
                                    <div class="col-lg-10"><div>{{ $entity->title }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Slug:</label></div>
                                    <div class="col-lg-10"><div>{{ $entity->slug }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Description:</label></div>
                                    <div class="col-lg-10"><div>{{ $entity->description }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Content:</label></div>
                                    <div class="col-lg-10"><div>{!! $entity->content !!}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                @if($entity->category())
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Category:</label></div>
                                    <div class="col-lg-10"><div>{!! $entity->category()->title !!}</div></div>
                                </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_es">
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Título:</label></div>
                                    <div class="col-lg-10"><div>{{ $translations['es']->title }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Slug:</label></div>
                                    <div class="col-lg-10"><div>{{ $translations['es']->slug }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Descripción:</label></div>
                                    <div class="col-lg-10"><div>{{ $translations['es']->description }}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Contenido:</label></div>
                                    <div class="col-lg-10"><div>{!! $translations['es']->content !!}</div></div>
                                </div>
                                <div class="clearfix"></div><br>
                                @if($category_translations)
                                <div class="form-group">
                                    <div class="col-lg-2"><label class="control-label">Categoría:</label></div>
                                    <div class="col-lg-10"><div>{{ $category_translations['es'][0] }}</div></div>
                                </div>
                                @endif
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <div class="clearfix"></div><br>
                    @if($entity->path != null)
                        <div class="form-group">
                            <div>
                                <label class="control-label">Image:</label>
                                <img class="img-responsive" src="{{ asset('storage/' . $entity->path) }}" style="max-width: 300px;">
                            </div>
                        </div>
                    @endif

                </div>
                <div class="box-footer">
                    <button type="button" class="btn btn-danger form-action-cancel">OK</button>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.includes.actions_form')
