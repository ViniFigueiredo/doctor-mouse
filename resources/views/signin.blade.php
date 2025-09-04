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
            <form>
                <label for="email">Email</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="email" id="email" placeholder="jadiennesilva@admin.com" required>
                </div>
                <label for="password">Senha</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" placeholder="123456" required>
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