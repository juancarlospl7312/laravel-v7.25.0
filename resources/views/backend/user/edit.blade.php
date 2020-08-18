<div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">User | Edit</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\UserController@update') }}" role="form"
                      class="form-crud-edit" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" value="{{ $entity->id }}">
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" name="name" id="name" required="required" value="{{ $entity->name }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" id="email" required="required" value="{{ $entity->email }}">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" id="password">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Role *</label>
                            <select class="form-control select2" name="role_id" id="role_id" data-value="{{ $entity->role_id }}" required="required" style="width: 100%;">
                                @foreach($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group row">
                            <div class="col-md-9">
                                <label for="path">Image</label>
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
