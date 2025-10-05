<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Impact-D</title>

    {{-- CSS --}}
    @include('Layouts.css')


</head>

<body class="login">
    {{-- <div class="container">
        <div class="row">
            <div class="col-lg-12 login">
                <div class="row shadow">
                    <div class="col-lg-6 gmbrLogin">
                        <h1 class="">SISTEM AUDIT</h1>
                        <H3>PT INDOFOOD CBP | NDL - MKS</H3>
                        <div class="gmbrIcon text-center">
                            <img src="{{asset('admin/assets/img/auditLogin.png')}}" width="65%" alt="">
                        </div>
                    </div>

                    <div class="col-lg-6 textLogin">
                        <h3>LOGIN ACCOUNT</h3>
                        <div class="detLogin">
                            <img src="{{asset('admin/assets/img/user.png')}}" width="25px" alt="">
                            <p>Username</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


    {{-- test --}}
    <div class="container" id="container">
        <div class="form-container sign-in-container">
            <form method="POST" action="{{ route('login.process') }}">
                @csrf
                <h1>Sign in</h1>
                <span>or use your account</span>
                <input type="text" name="nik" class="form-control" placeholder="Nik" required autofocus>
                <input type="password" name="password" placeholder="Password" class="form-control" required>
                <button type="submit" class="btn btn-primary w-100">Login</button>
                @if ($errors->any())
                    <div>
                        {{ $errors->first() }}
                    </div>
                @endif
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-right">
                    <h3>SISTEM AUDIT</h3>
                    <P>PT INDOFOOD CBP | NDL - MKS</P>
                    <img src="{{ asset('admin/assets/img/auditLogin.png') }}" width="300px" alt="">
                </div>
            </div>
        </div>
    </div>

    {{-- <script>
const signUpButton = document.getElementById('signUp');
const signInButton = document.getElementById('signIn');
const container = document.getElementById('container');

signUpButton.addEventListener('click', () => {
	container.classList.add("right-panel-active");
});

signInButton.addEventListener('click', () => {
	container.classList.remove("right-panel-active");
});
</script> --}}

</body>

</html>
