<?php get_header(); ?>
<main id="conteudo" class="min-h-screen bg-cream px-5 pb-24 pt-36 md:px-9 lg:px-12">
	<div class="mx-auto max-w-[1000px]">
		<h1 class="section-title mb-10"><?php echo is_404() ? 'Página não encontrada' : esc_html( wp_get_document_title() ); ?></h1>
		<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
			<article class="border-t border-olive/20 py-7"><h2 class="font-display text-3xl"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2><div class="mt-3 text-brown"><?php the_excerpt(); ?></div></article>
		<?php endwhile; the_posts_pagination(); else : ?><p class="text-brown">Não encontramos conteúdo aqui.</p><a class="text-link mt-6 inline-block" href="<?php echo esc_url( home_url( '/' ) ); ?>">Voltar ao início →</a><?php endif; ?>
	</div>
</main>
<?php get_footer(); ?>
