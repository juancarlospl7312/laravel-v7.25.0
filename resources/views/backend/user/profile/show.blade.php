<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-6">
                <div class="panel panel-default">
                    <div class="panel-heading">User | Profile</div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="box box-primary">
                            <div class="box-header with-border">
                                <a data-href="{{ action('Backend\UserController@editProfile') }}" class="btn btn-primary pull-right form-ajax-action">Edit</a>
                            </div>
                            <div class="box-body box-profile">
                                <div class="col-sm-12">
                                    <img class="profile-user-img img-responsive img-circle" src="{{ asset('storage/' . Auth::user()->path) }}" alt="User profile picture">
                                </div>
                                <div class="col-sm-12">
                                    <hr>
                                    <strong><i class="fa fa-book margin-r-5"></i> Name</strong>
                                    <p class="text-muted">{{ Auth::user()->name }}</p>

                                    <hr>
                                    <strong><i class="fa fa-map-marker margin-r-5"></i> Email</strong>
                                    <p class="text-muted">{{ Auth::user()->email }}</p>
                                </div>
                            </div>
                            <!-- /.box-body -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 page-content-crud"></div>
        </div>
    </div>
</div>

<script>

    let page_content = $(".page-content");
    let form_ajax_action = $('.form-ajax-action');

    form_ajax_action.on('click', function(){
        page_content.empty().load($(this).attr("data-href"));
    });

</script>