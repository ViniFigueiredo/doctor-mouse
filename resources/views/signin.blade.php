@extends('layouts.base')

@section('contents')
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="/login/img/logo.png" alt="Doctor Mouse" class="logo-img">
                <div class="logo-text">
                    <span class="logo-title">Doctor Mouse</span>
                    <span class="logo-subtitle">Gaming Store</span>
                </div>
            </div>
            <h2>LOGIN</h2>
            
            @if(session('status'))
                <div style="text-align:center; color:green; margin-bottom:18px; font-size:1em;">
                    {{ session('status') }}
                </div>
            @endif
            
            @if($errors->any())
                <div style="text-align:center; color:red; margin-bottom:18px; font-size:1em;">
                    @foreach($errors->all() as $error)
                        {{ $error }}<br>
                    @endforeach
                </div>
            @endif
            
            <form method="POST" action="/signin">
                @csrf
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="email" id="email" name="email" placeholder="jadiennesilva@admin.com" value="{{ old('email') }}" required>
                </div>
                <label for="password">Senha</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" name="password" placeholder="123456" required>
                    <span class="input-icon eye" id="togglePassword"><i class="fa fa-eye"></i></span>
                </div>
                <button type="submit" class="btn-login">ENTRAR</button>
            </form>
            <div class="links">
                <a href="/recuperar-senha" class="forgot">Recuperar Senha?</a>
                <a href="/register" class="register">Criar Conta</a>
            </div>

        </div>
    </div>
    <script src="/login/js/script.js"></script>
@endsection