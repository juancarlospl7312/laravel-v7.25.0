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
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Title:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div>{{ $entity->title }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Slug:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div>{{ $entity->slug }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Description:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div>{{ $entity->description }}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Content:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            <div>{!! $entity->content !!}</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Categories:</label>
                                        </div>
                                        <div class="col-lg-10">
                                        @foreach($categories as $item)
                                            <i>{{ $item }} @if(!$loop->last), @endif</i>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Tags:</label>
                                        </div>
                                        <div class="col-lg-10">
                                        @foreach($tags as $item)
                                            <i>{{ $item }} @if(!$loop->last), @endif</i>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                            <div class="tab-pane" id="tab_es">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Título:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $translations['es']->title }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Slug:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $translations['es']->slug }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Descripción:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {{ $translations['es']->description }}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Contenido:</label>
                                        </div>
                                        <div class="col-lg-10">
                                            {!! $translations['es']->content !!}
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Categorias:</label>
                                        </div>
                                        <div class="col-lg-10">
                                        @foreach($category_translations['es'] as $item)
                                            <i>{{ $item }} @if(!$loop->last), @endif</i>
                                        @endforeach
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-2">
                                            <label class="control-label">Etiquetas:</label>
                                        </div>
                                        <div class="col-lg-10">
                                        @foreach($tag_translations['es'] as $item)
                                            <i>{{ $item }} @if(!$loop->last), @endif</i>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.tab-pane -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <div class="row">
                        <div class="col-lg-2">
                            <label class="control-label">Image:</label>
                        </div>
                        <div class="col-lg-10">
                            <img class="img-responsive" src="{{ asset('storage/' . $entity->path) }}" style="max-width: 200px;">
                        </div>
                    </div>
                    @if($entity->gallery() != null)
                        <div class="clearfix"></div><br>
                        <div class="form-group">
                            <label class="control-label">Gallery:</label>
                            <div class="clearfix"></div>
                            <div class="gallery-files-list">
                            @foreach($entity->gallery()->galleryFiles() as $item)
                                <div class="col-lg-3 form-group">
                                    <img class="img-responsive" src="storage/{{ $item->path }}" />
                                </div>
                                @if($loop->iteration % 4 == 0)
                                    <div class="clearfix"></div>
                                @endif
                            @endforeach
                            </div>
                        </div>
                    @endif
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
