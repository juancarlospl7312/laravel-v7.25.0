<div id="page-wrapper">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"></h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="row">
            <div class="col-sm-12 page-content-list">
                <div class="panel panel-default">
                    <div class="panel-heading">Page | List
                        <div class="pull-right">
                            <a class="btn btn-primary form-ajax-action" data-href="{{ action('Backend\PageController@create') }}">New</a>
                        </div>
                    </div>
                    <!-- /.panel-heading -->
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="datatable_ajax" style="width: 100%;">
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-12 page-content-crud"></div>
        </div>
    </div>
</div>

<script>
    jQuery(document).ready(function(){
        $('#datatable_ajax').DataTable({
            "processing": true,
            "serverSide": true,
            "searching": true,
            "ajax": {
                "url": "{{ action('Backend\PageController@table') }}",
                "type": "POST",
                "data": { _token: "{{ csrf_token() }}" }
            },
            "order": [[ 3, "desc" ]],
            "columns": [
                {
                    "data": "id",
                    "visible": false,
                },
                {
                    "data": "path",
                    "sortable": false,
                    "title": "Image",
                    "width": "60"
                },
                {
                    "data": "title",
                    "title": "Title"
                },
                {
                    "data": "updated_at",
                    "title": "Updated at",
                    "width": "80"
                },
                {
                    "data": "actions",
                    "sortable": false,
                    "width": "80"
                }
            ]
        });
    });
</script>

@include('backend.includes.actions_datatable')
