<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Mouse - Recuperação de Senha</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            background-color: #f7fafc;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 0;
        }
        .header {
            background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
            padding: 40px 30px;
            text-align: center;
        }
        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .logo img {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-right: 15px;
        }
        .logo-text {
            color: white;
        }
        .logo-title {
            font-size: 28px;
            font-weight: bold;
            display: block;
        }
        .logo-subtitle {
            font-size: 14px;
            opacity: 0.9;
        }
        .content {
            padding: 40px 30px;
        }
        .title {
            font-size: 24px;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 20px;
            text-align: center;
        }
        .message {
            font-size: 16px;
            color: #4a5568;
            margin-bottom: 30px;
            line-height: 1.6;
        }
        .button-container {
            text-align: center;
            margin: 40px 0;
        }
        .reset-button {
            display: inline-block;
            background: linear-gradient(135deg, #6b46c1 0%, #8b5cf6 100%);
            color: white;
            text-decoration: none;
            padding: 16px 32px;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            transition: transform 0.2s ease;
        }
        .reset-button:hover {
            transform: translateY(-2px);
        }
        .link-fallback {
            background-color: #f7fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .link-fallback p {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #4a5568;
        }
        .link-fallback code {
            word-break: break-all;
            background-color: #e2e8f0;
            padding: 8px;
            border-radius: 4px;
            display: block;
            font-size: 12px;
            color: #2d3748;
        }
        .footer {
            background-color: #f7fafc;
            padding: 30px;
            text-align: center;
            border-top: 1px solid #e2e8f0;
        }
        .footer p {
            margin: 0;
            font-size: 14px;
            color: #718096;
        }
        .security-info {
            background-color: #fef5e7;
            border: 1px solid #f6e05e;
            border-radius: 8px;
            padding: 20px;
            margin: 30px 0;
        }
        .security-info h3 {
            margin: 0 0 10px 0;
            font-size: 16px;
            color: #744210;
        }
        .security-info p {
            margin: 0;
            font-size: 14px;
            color: #744210;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="logo">
                <div class="logo-text">
                    <span class="logo-title">Doctor Mouse</span>
                    <span class="logo-subtitle">Gaming Store</span>
                </div>
            </div>
        </div>

        <!-- Content -->
        <div class="content">
            <h1 class="title">Recuperação de Senha</h1>
            
            <div class="message">
                <p>Olá!</p>
                <p>Você está recebendo este email porque recebemos uma solicitação de recuperação de senha para sua conta na Doctor Mouse.</p>
                <p>Para redefinir sua senha, clique no botão abaixo:</p>
            </div>

            <div class="button-container">
                <a href="{{ $resetUrl }}" class="reset-button">Redefinir Senha</a>
            </div>

            <div class="link-fallback">
                <p><strong>Problemas com o botão?</strong> Copie e cole o link abaixo no seu navegador:</p>
                <code>{{ $resetUrl }}</code>
            </div>

            <div class="security-info">
                <h3>🔒 Informações de Segurança</h3>
                <p>Este link de recuperação expira em 24 horas. Se você não solicitou a recuperação de senha, ignore este email - sua conta permanece segura.</p>
            </div>

            <div class="message">
                <p>Se você continuar tendo problemas, entre em contato conosco respondendo este email.</p>
                <p><strong>Equipe Doctor Mouse</strong></p>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p>&copy; {{ date('Y') }} Doctor Mouse Gaming Store. Todos os direitos reservados.</p>
            <p>Este é um email automático, por favor não responda.</p>
        </div>
    </div>
</body>
</html>