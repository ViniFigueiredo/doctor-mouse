# Como fazer o pagamento via PIX (fake) funcionar

Criar uma conta no ngrok, baixar e logar pela linha de comando

Instalar dependências npm:

npm i

Rodar o site com:

composer run dev

e logo em seguida, em outro terminal

ngrok http 8000

(8000 é a porta do site no meu caso)

o ngrok vai gerar uma url externa alguns segundos depois,

e adicione no .env:

NGROK_TUNNEL=url-que-o-ngrok-gerou

agora é só testar, apontando a câmera do celular para o qr code quando pedir.