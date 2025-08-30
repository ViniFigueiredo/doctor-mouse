<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Mouse - Criar Conta</title>
    <link rel="stylesheet" href="/login/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="/login/img/logo.png" alt="Doctor Mouse" class="logo-img">
                <div class="logo-text">
                    <span class="logo-title">Doctor Mouse</span>
                    <span class="logo-subtitle">Gaming Store</span>
                </div>
            </div>
            <h2>CRIAR CONTA</h2>
            <form method="POST" action="#">
                <label for="name">Nome completo</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-user"></i></span>
                    <input type="text" id="name" name="name" placeholder="Nome completo" required>
                </div>
                <label for="phone">Telefone <span style="color: #888; font-size: 0.9em;">(opcional)</span></label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-phone"></i></span>
                    <input type="text" id="phone" name="phone" placeholder="(99) 99999-9999">
                </div>
                <label for="email">E-mail</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-envelope"></i></span>
                    <input type="email" id="email" name="email" placeholder="E-mail" required>
                </div>
                <label for="cpf">CPF</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-id-card"></i></span>
                    <input type="text" id="cpf" name="cpf" placeholder="000.000.000-00" required>
                </div>
                <label for="password">Senha</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password" name="password" placeholder="Senha" required>
                </div>
                <label for="password_confirmation">Confirmar Senha</label>
                <div class="input-group">
                    <span class="input-icon"><i class="fa fa-lock"></i></span>
                    <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar senha" required>
                </div>
                <div style="display: flex; gap: 10px; margin-top: 20px;">
                    <a href="/" class="btn-login" style="background: #e3342f; color: #fff; flex: 1; text-align: center; text-decoration: none; border-radius: 4px; padding: 10px 0; font-weight: bold;">CANCELAR</a>
                    <button type="submit" class="btn-login" style="background: #3490dc; color: #fff; flex: 1;">CRIAR CONTA</button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
