# Hermé — Essência & Gesso

Tema WordPress customizado para vitrine artesanal. Não usa WooCommerce, carrinho, checkout, pagamentos nem preços.

## Instalação

1. Instale WordPress em um servidor com PHP e MySQL/MariaDB.
2. Copie `herme-theme` para `wp-content/themes/` e ative em **Aparência > Temas**.
3. Em **Configurações > Links permanentes**, escolha **Nome do post** e salve. A ativação do tema também registra as quatro categorias iniciais e atualiza as regras de URL.
4. Em **Aparência > Personalizar > Contato Hermé**, informe o WhatsApp com DDI e DDD, somente números, e a URL do Instagram. Enquanto o WhatsApp estiver vazio, os botões de contato não são exibidos.

## Produtos

Em **Produtos > Adicionar produto**, preencha o título e a descrição, escolha uma ou mais **Categorias de Produtos** e defina a **Imagem destacada**. Marque **Mostrar na página inicial** no metabox **Produto em destaque** e publique. A home mostra até quatro produtos marcados e completa os espaços com produtos recentes.

Os produtos aparecem na home e em `/produtos/` e `/categoria-produto/nome-da-categoria/`. O botão **Pedir orçamento** abre o WhatsApp com o nome da peça. URLs individuais antigas redirecionam para o catálogo.

## Fotos institucionais

Substitua os placeholders colocando fotos com estes nomes em `assets/imgs/`:

| Área | Arquivo |
| --- | --- |
| Hero | `imagem-topo.png` (original) e `imagem-topo.webp` (versão otimizada usada pelo navegador) |
| Processo | `processo-01.jpg`, `processo-02.jpg`, `processo-03.jpg` |
| Cotidiano | `ambiente-01.jpg`, `presente-01.jpg`, `momento-01.jpg` |
| Coleções | `colecao-velas.jpg`, `colecao-gesso.jpg`, `colecao-decoracao.jpg`, `colecao-presentes.jpg` |
| Personalizados | `personalizados.jpg` |
| Sobre | `sobre.jpg` |
| Produto sem imagem | `produto-placeholder.jpg` |

O favicon fica em `assets/imgs/favicon.svg`, com versões PNG em 32 px e 180 px. Se você definir um Ícone do Site no WordPress, ele terá prioridade.

Ao trocar a foto do hero, atualize também `imagem-topo.webp` para manter a versão otimizada em sincronia.

As ilustrações `placeholder-*.svg` são temporárias e identificadas como tal. Produtos cadastrados usam as fotos da Biblioteca de Mídia, com tamanhos responsivos gerados pelo WordPress. O header usa `assets/imgs/logotipo.png`; se esse arquivo não estiver presente, usa o nome em texto.

## Tailwind e animações

A tipografia do site usa Inter 400, com espaçamento de 0,16em, maiúsculas e entrelinha 1,6. O CSS compilado e os arquivos locais do GSAP já estão incluídos. Para alterar estilos:

```bash
cd wp-content/themes/herme-theme
npm ci
npm run dev
```

Antes de publicar alterações, execute `npm run build`. O código fonte está em `assets/css/source.css`; o resultado é `assets/css/app.css`. O build também copia GSAP e ScrollTrigger para `assets/js/vendor/`. Apenas a home carrega GSAP. As animações respeitam `prefers-reduced-motion`.

## Arquivos principais

- `functions.php`: CPT, taxonomia, metaboxes, Customizer, SEO básico e assets.
- `front-page.php`: narrativa da home.
- `archive-produto.php` e `taxonomy-categoria_produto.php`: listagem e categorias.
- `template-parts/card-produto.php`: apresentação dos produtos nas listagens.
- `assets/js/main.js`: menu e galeria no front-end.
- `assets/js/admin.js`: seleção de imagens na Biblioteca de Mídia.
- `assets/js/animations.js`: GSAP com ScrollTrigger.
