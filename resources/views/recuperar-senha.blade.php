<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Mouse - Recuperar Senha</title>
    <link rel="stylesheet" href="/login/css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;700&display=swap" rel="stylesheet">
            <style>
                body { background: #f7f7f7; }
                .container { display: flex; justify-content: center; align-items: center; height: 100vh; }
                .login-box { background: #fff; padding: 32px 24px; border-radius: 8px; max-width: 400px; width: 100%; }
            </style>

</head>
<body>
    <div class="container">
        <div class="login-box">
            <div class="logo" style="display: flex; align-items: center; gap: 8px;">
                <img src="/login/logo.png" alt="Doctor Mouse" class="logo-img" style="width:90px; height:90px; object-fit:contain;">
                <div class="logo-text" style="display: flex; flex-direction: column; justify-content: center;">
                    <span class="logo-title" style="font-weight:bold; color:#6847BB; font-size:36.48px; font-family:'Inter', Arial, sans-serif;">Doctor Mouse</span>
                    <span class="logo-subtitle" style="font-family:'Inter', Arial, sans-serif; font-weight:400;">Gaming Store</span>
                </div>
            </div>
                <h2 style="text-align:center; font-weight:bold; font-family:'Roboto', Arial, sans-serif;">RECUPERAR SENHA</h2>
                <div style="text-align:center; margin-bottom:18px; color:#555; font-size:1em;">Insira um endereço de email válido para recuperação de senha.</div>
                <form method="POST" action="#">
                    <label for="email">E-mail</label>
                    <div class="input-group">
                        <span class="input-icon"><i class="fa fa-envelope"></i></span>
                        <input type="email" id="email" name="email" placeholder="E-mail" required>
                    </div>
                    <div style="display: flex; gap: 10px; margin-top: 20px;">
                        <a href="/" class="btn-login" style="background: #e3342f; color: #fff; flex: 1; text-align: center; text-decoration: none; border-radius: 4px; padding: 10px 0; font-weight: bold;">CANCELAR</a>
                        <button type="submit" class="btn-login" style="background: #6847BB; color: #fff; flex: 1;">ENVIAR LINK</button>
                    </div>
                </form>
        </div>
    </div>
</body>
</html>
