
<html lang="en">

    <head>
        <title>ADMIN LOGIN</title>
        <!-- Meta tag Keywords -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta charset="UTF-8" />
        <link rel="shortcut icon" href="{{asset('gambar')}}/naa.png">

        <link href="//fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
        <!--/Style-CSS -->
        <link rel="stylesheet" href="{{asset('asset_login')}}/css/style.css" type="text/css" media="all" />
        <link rel="stylesheet" href="{{asset("asset")}}/sweetalert2/sweetalert2.min.css">
        <!--//Style-CSS -->
        <script src="{{asset('asset')}}/plugins/jquery/jquery.min.js"></script>
        <script src="https://kit.fontawesome.com/af562a2a63.js" crossorigin="anonymous"></script>
        <script src="{{asset("asset")}}/sweetalert2/sweetalert2.min.js"></script>

        <style>
            #loading{
                height: 100%;
                width:100%;
                position: fixed;
                text-align: center; 
                display: flex; 
                align-items:center; 
                justify-content: center;
                left:0; 
                top: 0; 
                min-height:100%;
                height:auto; 
                background-color: rgba(0, 0, 0, .5); 
                z-index:99999;
                display:none;
            }
        </style>
    </head>
    <body>
        <div id="loading" class="col-md-12 text-center">
                <img src="{{asset('asset/loading/loading.png')}}" style="height:60px; width:300px; margin:0 auto; margin-top:270px;">
        </div>
        <!-- form section start -->
        <section class="w3l-workinghny-form">
            
            <!-- /form -->
            <div class="workinghny-form-grid">
                <div class="wrapper">
                    <div class="logo">
                        <h1>
                            <a class="brand-logo" href="index.html">
                                PSB OFFLINE NAA
                            </a>
                        </h1>
                    </div>
                    <div class="workinghny-block-grid">
                        <div class="form-right-inf">
                            <div class="login-form-content" style="padding-top:5px;">
                                <h2 style="margin:0;margin-bottom:17px;font-size:28px;">Login Admin</h2>
                                <form id="form_biasa" alamat="{{route('login_post')}}" rel="simpan"  method="post">
                                    {{ csrf_field()}}
                                    <div class="one-frm">
                                        <input id="username" name="username" placeholder="Username"  autofocus autocomplete="off">
                                    </div>
                                    <div class="one-frm">
                                        <input id="password" type="password" name="password" placeholder="Password" >
                                    </div>
                                    <button type="submit" class="btn btn-style mt-3">Masuk</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <script>
            $(document).ready(function () {
                $("#form_biasa").on('submit', function (e) {
                    e.preventDefault();
                    var kem = $(this).attr("kem");
                    var url = $(this).attr("alamat");
                    var form = $(this);
                    var data = $(this).serialize();
                    var username=$("#username").val();
                    var password=$("#password").val();
                    if(username==""){
                        $("#username").focus();
                        swal("Username harus diisi");
                    }else if(password==""){
                        $("#password").focus();
                        swal("Password harus diisi")
                    }else{
                        $("#loading").css("display", "block");
                        $.ajax({
                        type: 'POST',
                        url: url,
                        data: data,
                        success: function (hasil) {
                            $("#loading").css("display", "none");
                            //console.log(hasil);
                            //alert(hasil);
                            if (hasil == 1) {
                                swal({
                                    title: 'Login Sukses',
                                    text: '',
                                    type: 'success'
                                }).then(function () {
                                    window.location.href = "{{url('/')}}";
                                });

                            } else if (hasil == 2) {
                                swal({
                                    title: 'Gagal',
                                    text: '',
                                    type: 'error'
                                }).then(function () {

                                });
                            } else if (hasil == 3) {
                                swal({
                                    title: 'Email Sudah Digunakan',
                                    text: '',
                                    type: 'error'
                                }).then(function () {

                                });
                            } else if (hasil == 4) {
                                swal({
                                    title: 'Confirm Password Salah !',
                                    text: '',
                                    type: 'error'
                                }).then(function () {

                                });
                            }
                        }
                    }); 
                    }
                    
                });
            });
        </script>
    </body>
</html>
