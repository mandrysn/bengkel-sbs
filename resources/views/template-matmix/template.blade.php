<!doctype html>
<html lang="{{ app()->getLocale() }}">
   
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin inventory by: Matmix. Edit by: GreenNusa developer Alg">
        <meta name="author" content="Westilian, Alg">
        
        <title>MatMix - A Components Mix Admin</title>
        
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/font-awesome.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/bootstrap.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/animate.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/waves.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/layout.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/components.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/plugins.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/common-styles.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/pages.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/responsive.css') }}" type="text/css">
        <link rel="stylesheet" href="{{ asset('admin/matmix/css/matmix-iconfont.css') }}" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Roboto:400,300,400italic,500,500italic" rel="stylesheet" type="text/css">
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet" type="text/css">
    </head>
    
    <body>
        <div class="page-container list-menu-view">
            <!--Leftbar Start Here -->
            <div class="left-aside desktop-view">
                @include('template.leftbar')
            </div>
            
            <div class="page-content">
                <!--Topbar Start Here -->
                <header class="top-bar">
                    @include('template.topbar')
                </header>
                
                <div class="main-container">
                    @yield('content')
                </div>
                
                <!--Footer Start Here -->
                <footer class="footer-container">
                    @include('template.footer')
                </footer>
            </div>
            
        </div>
        
        <!--Rightbar Start Here -->
        <div class="right-aside">
            @include('template.rightbar')
        </div>
        
        
        <script src="{{ asset('admin/matmix/js/jquery-1.11.2.min.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/jquery-migrate-1.2.1.min.js') }}"></script>
        <!--Load Mask-->
        <script src="{{ asset('admin/matmix/js/jquery.loadmask.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/jRespond.min.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/nav-accordion.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/hoverintent.js') }}"></script>
        <!--Materialize Effect-->
        <script src="{{ asset('admin/matmix/js/waves.js') }}"></script>
        <!--iCheck-->
        <script src="{{ asset('admin/matmix/js/icheck.js') }}"></script>
        <!--Select2-->
        <script src="{{ asset('admin/matmix/js/select2.js') }}"></script>
        <!--jquery.mentionsInput-->
        <script src="{{ asset('admin/matmix/js/underscore.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/jquery.elastic.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/jquery.events.input.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/jquery.mentionsInput.js') }}"></script>
        <!--Syntax Higlighter-->
        <script src="{{ asset('admin/matmix/js/jquery.syntaxhighlighter.js') }}"></script>
        <!--Text Editor-->
        <script src="{{ asset('admin/matmix/js/summernote.min.js') }}"></script>
        <!--CHARTS-->
        <script src="{{ asset('admin/matmix/js/chart/sparkline/jquery.sparkline.js') }}"></script>
        <script src="{{ asset('admin/matmix/js/chart/easypie/jquery.easypiechart.min.js') }}"></script>
        <!--Smart Resize-->
        <script src="{{ asset('admin/matmix/js/smart-resize.js') }}"></script>
        <!--Layout Initialize-->
        <script src="{{ asset('admin/matmix/js/layout.init.js') }}"></script>
        <!--Template Plugins Initialize-->
        <script src="{{ asset('admin/matmix/js/matmix.init.js') }}"></script>
        <!--High Resolution Ready-->
        <script src="{{ asset('admin/matmix/js/retina.min.js') }}"></script>
</body>
</html>