<?php get_header(); ?>
<main id="conteudo" class="min-h-screen pt-20 lg:pt-24">
	<?php get_template_part('template-parts/hero', 'colecao'); ?>
	<section id="lista-produtos" class="bg-cream py-16 lg:py-24">
		<div class="mx-auto max-w-[1500px] px-5 md:px-9 lg:px-12">
			<?php $categories = get_terms( array( 'taxonomy' => 'categoria_produto', 'hide_empty' => false ) ); ?>
			<nav class="mb-12 flex justify-center gap-5 overflow-x-auto border-b border-olive/20 pb-4 md:gap-8" aria-label="Filtrar produtos por categoria">
				<a class="filter-link active" aria-current="page" href="<?php echo esc_url( get_post_type_archive_link( 'produto' ) ); ?>">Todos</a>
				<?php if ( $categories && ! is_wp_error( $categories ) ) : foreach ( $categories as $category ) : ?><a class="filter-link" href="<?php echo esc_url( get_term_link( $category ) ); ?>"><?php echo esc_html( $category->name ); ?></a><?php endforeach; endif; ?>
			</nav>
			<?php if ( have_posts() ) : ?>
				<div class="grid grid-cols-1 gap-x-5 gap-y-12 sm:grid-cols-2 md:gap-x-6 lg:grid-cols-4">
					<?php while ( have_posts() ) : the_post(); get_template_part( 'template-parts/card', 'produto' ); endwhile; ?>
				</div>
				<div class="mt-14 text-sm text-olive-dark"><?php the_posts_pagination( array( 'mid_size' => 1, 'prev_text' => '← Anteriores', 'next_text' => 'Próximos →' ) ); ?></div>
			<?php else : ?><p class="py-12 text-brown">Ainda não há peças cadastradas. Volte em breve.</p><?php endif; ?>
		</div>
	</section>
</main>
<?php get_footer(); ?>
