<?php

/** Hero compartilhada pelo arquivo de produtos e pelas categorias. */
$term = isset($args['term']) && $args['term'] instanceof WP_Term ? $args['term'] : null;
$slug = $term ? $term->slug : '';
$images = array(
    'velas' => 'velas-produto.png',
    'gesso' => 'pecas-gesso.png',
    'decoracao' => 'decoracao-1.png',
    'presentes' => 'presente-produtos.png',
    'bem-estar' => 'pecas-gesso.png',
);
$descriptions = array(
    'velas' => 'Uma linha de velas feitas à mão para transformar pequenos momentos em grandes sensações. Aromas, luz e bem-estar para todos os dias.',
    'gesso' => 'Peças em gesso feitas à mão para trazer textura e personalidade aos ambientes. Formas delicadas que valorizam cada detalhe.',
    'decoracao' => 'Composições artesanais que transformam cada canto da casa. Beleza natural para acompanhar seus momentos.',
    'presentes' => 'Presentes preparados com carinho para celebrar pessoas e momentos especiais. Um gesto de afeto em cada detalhe.',
    'bem-estar' => 'Peças criadas para tornar seus rituais mais leves. Um convite a desacelerar e aproveitar o agora.',
);
$image = isset($images[$slug]) ? $images[$slug] : 'todos-produtos.png';
if (!file_exists(get_template_directory() . '/assets/imgs/' . $image)) {
    $image = 'imagem-topo.png';
}
$title = $term ? $term->name : 'Nossas peças';
$subtitle = $term ? rtrim(wp_strip_all_tags($term->description), " .\t\n\r\0\x0B") : 'Essência & Gesso';
$description = $term ? ($descriptions[$slug] ?? ($term->description ?: 'Peças artesanais para trazer beleza e significado ao seu espaço.')) : 'Peças feitas à mão para transformar pequenos detalhes em ambientes especiais.';
?>
<section class="relative isolate flex min-h-[700px] items-start overflow-hidden bg-cream sm:min-h-[740px] lg:min-h-[430px] lg:items-center" aria-labelledby="colecao-hero-titulo">
    <div class="absolute inset-0 -z-20 bg-right-bottom bg-[length:auto_58%] bg-no-repeat lg:bg-right lg:bg-[length:auto_190%] lg:[mask-image:linear-gradient(to_right,transparent_58%,black_75%)]" style="background-image: url('<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/' . rawurlencode($image)); ?>');" aria-hidden="true"></div>
    <div class="absolute inset-0 -z-10 bg-gradient-to-b from-cream via-cream/95 via-45% to-transparent lg:hidden" aria-hidden="true"></div>
    <div class="mx-auto w-full max-w-[1440px] px-5 py-14 md:px-9 lg:px-12 lg:py-16">
        <div class="max-w-[540px]">
            <nav class="flex items-center gap-2 text-[10px] font-normal uppercase tracking-[.2em] text-olive-dark/60" aria-label="Caminho de navegação">
                <a class="hover:text-olive-dark" href="<?php echo esc_url(home_url('/')); ?>">Início</a>
                <span aria-hidden="true">›</span>
                <?php if ($term) : ?>
                    <a class="hover:text-olive-dark" href="<?php echo esc_url(get_post_type_archive_link('produto')); ?>">Coleções</a>
                    <span aria-hidden="true">›</span>
                    <span aria-current="page"><?php echo esc_html($term->name); ?></span>
                <?php else : ?>
                    <span aria-current="page">Coleções</span>
                <?php endif; ?>
            </nav>
            <h1 id="colecao-hero-titulo" class="mt-5 font-serif text-[clamp(3.25rem,7vw,6rem)] font-normal uppercase leading-[.95] tracking-[-.05em] text-olive-dark"><?php echo esc_html($title); ?></h1>
            <?php if ($subtitle) : ?><p class="mt-2 text-[11px] font-normal uppercase tracking-[.3em] text-olive-dark md:text-[13px]"><?php echo esc_html($subtitle); ?></p><?php endif; ?>
            <p class="mt-6 max-w-[420px] text-[15px] font-normal normal-case leading-[1.55] tracking-normal text-brown md:text-[16px]"><?php echo esc_html($description); ?></p>
        </div>
    </div>
</section>