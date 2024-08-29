<!DOCTYPE html>
<html lang="en">

<head>
    <base href="./">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="description" content="CoreUI - Open Source Bootstrap Admin Template">
    <meta name="author" content="Łukasz Holeczek">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keyword" content="Bootstrap,Admin,Template,Open,Source,jQuery,CSS,HTML,RWD,Dashboard">
    <title>Login - Informasi Kepegawaian</title>
    <link rel="apple-touch-icon" href="{{ asset('assets/logo/mini-logo-bengkulu-selatan.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/logo/logo-bengkulu-selatan.png') }}">
    <meta name="theme-color" content="#ffffff">

    <!-- font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Rubik:ital,wght@0,300..900;1,300..900&family=Source+Sans+3:ital,wght@0,200..900;1,200..900&display=swap" rel="stylesheet">

    <!-- Vendors styles-->
    <link rel="stylesheet" href="{{ asset('vendors/simplebar/css/simplebar.css') }}">
    <link rel="stylesheet" href="{{ asset('css/vendors/simplebar.css') }}">

    {{-- Other --}}
    <link href="{{ asset('vendors/@coreui/chartjs/css/coreui-chartjs.css') }}" rel="stylesheet">
    <link href="https://cdn.datatables.net/2.0.3/css/dataTables.dataTables.css" rel="stylesheet">
    <link href="{{ asset('vendors/remixicon/fonts/remixicon.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/my-style.css') }}" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="login-form">
            <div class="inside-login-form">
                <div class="primary-text">
                    Login
                </div>
                <div class="primary-text-2 me-2">
                    Silahkan login menggunakan username dan password yang telah dibuatkan oleh superadmin
                </div>
                <form action="" method="POST" class="form-input" id="formLogin">
                    @csrf
                        <div class="input-primary">
                            <div class="padding-input"><i class="ri-user-line"></i></div>
                            <div class="input-form"><input type="text" name="username" placeholder="@error('username'){{ $message }}@else{{ 'Username/NIP' }}@enderror" @error('username') class="error" @enderror></div>
                        </div>
                        <div class="input-primary">
                            <div class="padding-input"><i class="ri-lock-line"></i></div>
                            <div class="input-form" style="display: flex; position: relative;">
                                <input type="password" name="password" id="passwordInput" placeholder="@error('password'){{ $message }}@else{{ 'Password' }}@enderror" @error('password') class="error" @enderror style="padding-right: 40px;">
                                <span class="toggle-password" onclick="togglePasswordVisibility()" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%);">
                                    <i class="ri-eye-fill"></i>
                                </span>
                            </div>
                        </div>

                </form>
                <button class="login-button" id="loginButton">Login</button>
            </div>
        </div>
        <div class="welcome">
            <div>
                <div>
                    <p class="p1">Selamat Datang</p>
                </div>
                <div class="d-flex" style="justify-content: center">
                    <p class="text-sub">di </p>
                    <img src="{{ asset('/assets/logo/logo-bengkulu-selatan.png') }}" alt="" style="width: 50px; height:50px;display:inline">
                    <div class="text-wrapper">
                        <p class="sub-text-2" style="margin-bottom: 5px;">Aplikasi Kepegawaian</p>
                        <p style="line-height: 0px" class="sub-text-2">Dinkes Bengkulu Utara</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function(){
            const loginButton = document.getElementById('loginButton');
            const formLogin = document.getElementById('formLogin');
            loginButton.addEventListener('click', ()=>{
                formLogin.submit();
            })
        })
        function togglePasswordVisibility() {
        var passwordInput = document.getElementById("passwordInput");
        var icon = document.querySelector(".toggle-password i");

        if (passwordInput.type === "password") {
            passwordInput.type = "text";
            icon.classList.remove("ri-eye-fill");
            icon.classList.add("ri-eye-off-fill");
        } else {
            passwordInput.type = "password";
            icon.classList.remove("ri-eye-off-fill");
            icon.classList.add("ri-eye-fill");
        }
    }
    </script>
</body>

<style>
    @import url('https://fonts.googleapis.com/css2?family=Rubik:ital,wght@0,300..900;1,300..900&display=swap');
    body{
        background-color: #EBEDEF;
        font-family: "Rubik";
    }
    .container {
        margin: auto;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }
    .container .login-form{
        background-color: #FFFFFF;
        width: 452.5px;
        height: 332px;

    }
    .container .login-form .inside-login-form{
        margin-top: 25px;
        margin-left: 41px;
        margin-right: 41px;
    }
    .container .welcome {
        display: flex;
        justify-content: center;
        align-items: center;
        background-color: #222831;
        width: 427.5px;
        height: 332px;
        color: #fff;
    }
    .form-input{
        margin-bottom: 1.5rem;
    }
    .form-input .input-primary{
        display: flex;
        width: 327.5px;
        height: 36px;
        margin-bottom: 15px;
    }
    .p1{
        font-family: "Rubik", sans-serif;
        color: #ffff;
        font-size: 32px;
        font-weight: bold;
    }
    .primary-text{
        font-size: 32px;
        color: #2C384A;
        opacity: 95%;
        margin-bottom: 5px;
    }
    .primary-text-2{
        font-size: 14px;
        color: #2C384A;
        opacity: 68.2%;
        margin-bottom: 10px;
    }
    .padding-input {
        background-color: #D8DBE0;
        display: flex;
        justify-content: center;
        align-items: center;
        border-radius: 6px 0px 0px 6px;
        border: 1px solid #cbcbcb;
    }

    .padding-input i{
        padding: 10px;
    }
    .input-form input{
        width: 327.5px;
        height: 36px;
        border: 1px solid #cbcbcb;
        padding: 8px 12px;
        font-size: 16px;
    }
    .input-form::placeholder{
        font-size: 16px;
        color: #8A93A2;
    }
    .login-button{
        border: none;
        background-color: #00ADB5;
        color: #ffff;
        height: 38px;
        font-size: 16px;
        padding: 7px 25px 7px 25px;
        border-radius: 6px;
    }
    input.error::placeholder {
        color: red;
    }
    .text-sub{
        display: inline;
        font-family: "Rubik", sans-serif;
        font-size: 32px;
        font-weight: bold;
        padding-right: 10px;
    }
    .sub-text-2{
        font-family: "Rubik", sans-serif;
        font-size: 10px;
        font-weight: bold;
    }
    .text-wrapper{
        padding-top: 10px;
    }
</style>
</html>
