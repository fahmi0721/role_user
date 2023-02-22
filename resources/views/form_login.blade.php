<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="csrf-token" content="{{ csrf_token() }}" />

    <title>Login</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{ asset('public/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('public/login/css/login.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
 
    <!-- Sweetalrt plugin -->
    <link href="{{ asset('public/plugins/sweetalert/sweetalert.css') }}" rel="stylesheet" />

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="{{ asset('public/plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>
    <script type="text/javascript">
		    var tokenCSRF   = jQuery('meta[name="csrf-token"]').attr('content');
        var url_link    = "{{ asset('/') }}";
    </script>


  </head>
  <body>
    <div class="form-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-4 col-md-4 col-sm-offset-3 col-sm-6">
                    <div class="form-container">
                        <h3 class="title">My Account</h3>
                        <form class="form-horizontal" id="FormData">
                            @csrf
                            <div class="form-icon">
                                <i class="fa fa-user-secret"></i>
                            </div>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-user"></i></span>
                                <input type="username" name="username" class="form-control" placeholder="Username">
                            </div>
                            <div class="form-group">
                                <span class="input-icon"><i class="fa fa-lock"></i></span>
                                <input type="password" name="password" class="form-control" placeholder="Password">
                                <span class="forgot"><a href="">&nbsp;</a></span>
                            </div>
                            <button class="btn signin">Login</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap 3.3.5 -->
    <script src="{{ asset('public/bootstrap/js/bootstrap.min.js') }}"></script>

    <!-- Sweetalrt plugin -->
    <script src="{{ asset('public/plugins/sweetalert/sweetalert.min.js') }}"></script>
    <script>
        $("#FormData").submit(function(e){
            e.preventDefault();
            SubmitData();
        })
        function error_detail(error) {
            console.log(error);
            if(error.status=="500") {
                if(error.responseJSON.messages) {
                    swal(''+error.status+'',''+error.responseJSON.messages[2]+'','error');
                    return false;
                } else {	
                    response = error.responseJSON.messages?error.responseJSON.messages:error.statusText;
                    swal(''+error.status+'',''+response+'','error');
                    return false;
                }
            } else if(error.responseJSON.status=="warning") {
                swal('Warning',''+error.responseJSON.messages+'','warning');
                return false;

            } else if(error.responseJSON.status=="error") {
                swal('Error',''+error.responseJSON.messages+'','error');
                return false;
            }
        }

        function SubmitData() {
            var idata =new FormData($('#FormData')[0]);
            $.ajax({
                type	: "POST",
                dataType: "json",
                url		: "{{ route('login') }}",
                data	: idata,
                processData: false,
                contentType: false,
                cache 	: false,
                beforeSend: function () { 
                    // in_load();
                },
                success	:function(data) {
                    console.log(data);
                    if(data.status){
                        swal(
                            {
                                title: data.status,
                                text: data.messages,
                                type: "success",
                            },
                        function(){
                            window.location.href = "{{ url('/') }}";
                        });
                    }else{
                        swal(
                            {
                                title: "Warning",
                                text: data,
                                type: "warning",
                            });
                    }
                },
                error: function (error) {
                    error_detail(error);
                }
            });
        }
    </script>

  </body>
</html>
