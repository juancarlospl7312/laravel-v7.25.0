<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default">
                    <div class="panel-heading">User | Edit</div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <form id="user-profile-form" data-action="{{ action('Backend\UserController@update') }}" role="form"
                              class="form-crud-edit" enctype="multipart/form-data">
                            <div class="box-body">
                                {{ csrf_field() }}
                                <input type="hidden" name="id" value="{{ Auth::user()->id }}">
                                <div class="form-group">
                                    <label for="name">Name *</label>
                                    <input type="text" class="form-control" name="name" id="name" required="required" value="{{ Auth::user()->name }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control" name="email" id="email" required="required" value="{{ Auth::user()->email }}">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <a href="javascript:;" class="btn btn-default form-action-change-password">Change Password</a>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password</label>
                                    <input type="password" class="form-control" name="password" id="password" disabled="disabled">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Password Confirmation</label>
                                    <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" disabled="disabled">
                                    <span class="help-block"></span>
                                </div>
                                <div class="form-group row">
                                    <div class="col-md-9">
                                        <label for="path">Image</label>
                                        <input type="file" id="path" name="path">
                                        <span class="help-block"></span>
                                    </div>
                                    <div class="col-md-3">
                                        <img class="img-responsive" src="{{ asset('storage/' . Auth::user()->path) }}">
                                    </div>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <a href="javascript:;" class="btn btn-primary form-action-ok">Update</a>
                                <a href="javascript:;" data-href="{{ action('Backend\UserController@showProfile') }}"
                                   class="btn btn-danger form-action-cancel">Cancel</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@include('backend.includes.actions_form')
