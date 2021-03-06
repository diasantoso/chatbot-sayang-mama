<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="SIATMA Bot : Bot penyedia informasi seputar perkuliahan" />
  	<meta name="author" content="Dito Raharjo" />

    <title>ChatBot Reminder</title>
    <link rel="icon" href="{{ asset('images/logo_tabbrowser.png') }}" type="image" sizes="16x16"> <!------------------------------------------ ICON-------------->

    <!-- Bootstrap -->
    <link href="{{ asset('Template/AdminPage/vendors/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('Template/AdminPage/vendors/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('Template/AdminPage/vendors/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ asset('Template/AdminPage/vendors/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- jQuery -->
    <script src="{{ asset('Template/AdminPage/vendors/jquery/dist/jquery.min.js') }}"></script>
    <!-- Select2 -->
    <link href="{{ asset('Template/AdminPage/vendors/select2/dist/css/select2.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ asset('Template/AdminPage/build/css/custom.min.css') }}" rel="stylesheet">
    <!-- Sweet Alert -->
    <link href="{{ asset('css/sweetalert/sweetalert2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sweetalert/sweetalert2.css') }}" rel="stylesheet">

    <!-- Social Login Button -->
    <link href="{{ asset('css/bootstrap-social/bootstrap-social.css') }}" rel="stylesheet">


  </head>

  <body class="login">

    <div>

      <a class="hiddenanchor" id="signup"></a>
      <a class="hiddenanchor" id="signin"></a>


      <div class="login_wrapper">

        <div id="register" class="animate form registration_form">
          <section class="login_content">
            <form action="{{ route('user.store') }}" method="post">
              {{ csrf_field() }}
              <h1>Create Account</h1>
              <div>
                <input name="fullname" type="text" class="form-control" placeholder="Fullname" required="" />
              </div>
              <div>
                <input name="npm" type="number" class="form-control" placeholder="NPM" required="" />
              </div>
              <div>
                </br>
              </div>
              <div>
                <select class="select2_group form-control" required="" name="prodi_id">
                  @foreach($semuaFakultas as $fakultas)
                    @if($fakultas->deleted_at == NULL)
                    <optgroup label="{{ $fakultas->nama }}">
                              @foreach($semuaProdi as $prodi)
                                @if($prodi->fakultas_id == $fakultas->id)
                                <option value="{{ $prodi->id }}">{{ $prodi->nama }}</option>
                                @endif
                              @endforeach
                    </optgroup>
                    @endif
                  @endforeach
                </select>
              </div>
              <div>
                </br>
              </div>
              <div>
                <input name="email" type="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input name="password" id="password" type="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div>
                <input name="password_confirmation" id="password_confirmation" type="password" class="form-control" placeholder="Password Confirmation" required="" />
              </div>
              <div>
                <button type="submit" class="btn btn-default submit" >Register</button>
              </div>
              <div class="clearfix"></div>


              <div class="separator">
                <p class="change_link">Already a member ?
                  <a href="#signin" class="to_register"> Log in </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>

                </div>
              </div>

            </form>
          </section>
        </div>

        <div class="animate form login_form" >
          <section class="login_content">

            <form action="{{ route('doLogin') }}" method="post">
              {{ csrf_field() }}
              <h2>CHATBOT REMINDER</h2>
              <h1>Login</h1>
              <div>
                <input type="email" name="email" class="form-control" placeholder="Email" required="" />
              </div>
              <div>
                <input type="password" name="password" class="form-control" placeholder="Password" required="" />
              </div>
              <div class="clearfix"></div>


              <div class="separator">
                <p class="change_link">New to site?
                  <a href="#signup" class="to_register"> Create Account </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>

                </div>
              </div>

            <button type="submit" class="btn btn-default submit" >Log in</button>


            </form>
          </section>
        </div>

      </div>
    </div>

    <!-- jQuery Tags Input -->
    <script src="{{ asset('Template/AdminPage/vendors/jquery.tagsinput/src/jquery.tagsinput.js') }}"></script>
    <!-- Select2 -->
    <script src="{{ asset('Template/AdminPage/vendors/select2/dist/js/select2.full.min.js') }}"></script>

    <!--<script src="{{ asset('js/loginadmin/index.js') }}"></script>-->
    <!-- Sweet Alert -->
    <script src="{{ asset('js/sweetalert/sweetalert2.js') }}"></script>

    <!-- Select2 -->
    <script>
      $(document).ready(function() {
        $(".select2_group").select2({});
      });
    </script>
    <!-- /Select2 -->

    <!-- Untuk Pencocokan Konfirmasi Password -->
    <script>
      var password = document.getElementById("password")
      , confirm_password = document.getElementById("password_confirmation");

      function validatePassword(){
      if(password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
      } else {
        confirm_password.setCustomValidity('');
      }
      }

      password.onchange = validatePassword;
      confirm_password.onkeyup = validatePassword;
    </script>
    <!-- Untuk Pencocokan Konfirmasi Password -->

    <!-- Include this after the sweet alert js file -->
    @include('sweet::alert')

  </body>
</html>
