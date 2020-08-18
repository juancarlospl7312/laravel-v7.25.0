<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">User | New</div>
            <!-- /.panel-heading -->
            <div class="panel-body">
                <form data-action="{{ action('Backend\UserController@add') }}" role="form"
                      class="form-crud-edit" enctype="multipart/form-data">
                    <div class="box-body">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="name">Name *</label>
                            <input type="text" class="form-control" name="name" id="name" required="required">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email *</label>
                            <input type="email" class="form-control" name="email" id="email" required="required">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="password">Password *</label>
                            <input type="password" class="form-control" name="password" id="password" required="required">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="password_confirmation">Password Confirmation *</label>
                            <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" required="required">
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="role_id">Role *</label>
                            <select class="form-control select2" name="role_id" id="role_id" data-value="" required="required" style="width: 100%;">
                                @foreach($roles as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="help-block"></span>
                        </div>
                        <div class="form-group">
                            <label for="path">Image</label>
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
