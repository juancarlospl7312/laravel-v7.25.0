<!-- Navigation -->
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="navbar-header">
        <a class="navbar-brand" href="{{ action('Backend\DefaultController@index') }}">Startmin</a>
    </div>

    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
    </button>

    <ul class="nav navbar-nav navbar-left navbar-top-links">
        <li><a href="{{ action('Frontend\DefaultController@index') }}" target="_blank"><i class="fa fa-home fa-fw"></i> Website</a></li>
    </ul>

    <ul class="nav navbar-right navbar-top-links">
        <li class="dropdown">
            <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="fa fa-user fa-fw"></i> <span class="user-name">{{ Auth::user()->name }}</span><b class="caret"></b>
            </a>
            <ul class="dropdown-menu dropdown-user">
                <li>
                    <a class="navbar-ajax" href="javascript:;" data-href="{{ action('Backend\UserController@showProfile') }}">
                        <i class="fa fa-user fa-fw"></i> User Profile
                    </a>
                </li>
                <li class="divider"></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                </li>
            </ul>
        </li>
    </ul>
    <!-- /.navbar-top-links -->
</nav>



<script>
    jQuery(document).ready(function() {
        $(".navbar-ajax").click(function() {
            $(".page-content").empty().load($(this).attr("data-href"));
            $(".main-sidebar ul.sidebar-menu li").each(function(){
                $(this).removeClass("active");
            });
        });

        /*Desktop*/
        if($(window).width() > 940){

        }
        /*Tablets*/
        if($(window).width() <= 940 && $(window).width() > 780){
            $(".user-name").remove();
            
        }
        /*Mobiles*/
        if($(window).width() <= 780){
            $(".user-name").remove();
            $(".sidebar-nav ul.nav").css({"margin-top":"50px"});
        }
    });
</script>
