# Hermé — Essência & Gesso

Projeto WordPress da Hermé, com tema próprio em `wp-content/themes/herme-theme`. O site apresenta coleções e produtos artesanais como vitrine, com pedidos de orçamento pelo WhatsApp. Não usa WooCommerce, carrinho ou checkout.

## Executar localmente

1. Copie `.env.example` para `.env` e substitua as senhas de exemplo por senhas fortes e diferentes entre si. O `.env` é local e não deve ser enviado ao Git.
2. Inicie o ambiente com `docker compose up -d --wait`.
3. Abra `http://localhost:18766/` (ou a porta definida em `HERME_PORT`) e conclua a instalação do WordPress.
4. Ative **Hermé — Essência & Gesso** em **Aparência → Temas**. Em **Configurações → Links permanentes**, selecione **Nome do post** e salve.
5. Cadastre os produtos e suas imagens pelo painel. Configure o WhatsApp e o Instagram em **Aparência → Personalizar → Contato Hermé**.

O `compose.yaml` usa o certificado em `/etc/ssl/cert.pem` para downloads HTTPS do WordPress. Em computadores sem esse arquivo, ajuste essa montagem para o caminho do certificado confiável local.

## Dados fora do repositório

O banco de dados, usuários, senhas, chaves do WordPress, `.env`, `wp-config.php`, uploads e dependências instaladas não são publicados. Os produtos e as configurações cadastrados no painel ficam no banco local e precisarão ser migrados separadamente por um método seguro. O WordPress base é fornecido pela imagem Docker; o tema e suas imagens institucionais estão neste repositório.

Para alterar o CSS do tema, execute `npm ci` e `npm run build` dentro de `wp-content/themes/herme-theme`. O CSS compilado já acompanha o tema.
