<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\DefaultController@dashboard') }}" class="sidebar-ajax">
                    <i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\CarouselController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-sliders fa-fw"></i> Carousel</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\PageController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-file-text-o fa-fw"></i> Page</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\NewsController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-newspaper-o fa-fw"></i> News</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\CategoryController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-folder-o fa-fw"></i> Category</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\TagController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-tags fa-fw"></i> Tag</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\GalleryController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-image fa-fw"></i> Gallery</a>
            </li>
            <li>
                <a href="javascript:;" data-href="{{ action('Backend\UserController@index') }}" class="sidebar-ajax">
                    <i class="fa fa-user-o fa-fw"></i> User</a>
            </li>
        </ul>
    </div>
</div>


<script>
    jQuery(document).ready(function() {
        $(".sidebar-ajax").click(function() {
            $(".page-content").empty().load($(this).attr("data-href"));
            $(".main-sidebar ul.sidebar-menu li").each(function(){
                $(this).removeClass("active");
            });
            $(this).parent().addClass('active');
            $(".sidebar-nav").removeClass("in");
            $(".sidebar-nav").attr("aria-expanded", "false");
        });
    });
</script>
