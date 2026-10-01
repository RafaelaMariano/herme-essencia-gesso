<?php get_header(); ?>
<main id="conteudo" class="min-h-screen bg-cream pt-20 lg:pt-24">
	<?php while ( have_posts() ) : the_post();
		$gallery = get_post_meta( get_the_ID(), '_herme_gallery_ids', true );
		$gallery = is_array( $gallery ) ? array_filter( array_map( 'absint', $gallery ) ) : array();
		$terms = get_the_terms( get_the_ID(), 'categoria_produto' );
	?>
		<article class="mx-auto max-w-[1440px] px-5 pb-20 pt-8 md:px-9 lg:px-12 lg:pb-32 lg:pt-12">
			<nav aria-label="Caminho de navegação" class="mb-8 text-xs text-brown"><a href="<?php echo esc_url( get_post_type_archive_link( 'produto' ) ); ?>" class="text-link">Peças</a><span class="mx-2" aria-hidden="true">/</span><span aria-current="page"><?php the_title(); ?></span></nav>
			<div class="product-layout grid grid-cols-[minmax(0,1fr)] gap-10 lg:grid-cols-[minmax(0,58%)_minmax(0,1fr)] lg:gap-16 xl:gap-24">
				<div class="product-visual min-w-0">
					<div class="product-main bg-sand" id="product-main-image">
						<?php if ( has_post_thumbnail() ) : echo get_the_post_thumbnail( get_the_ID(), 'herme-detail', array( 'class' => 'aspect-[4/5] w-full object-cover', 'loading' => 'eager', 'fetchpriority' => 'high', 'alt' => get_post_meta( get_post_thumbnail_id(), '_wp_attachment_image_alt', true ) ?: 'Peça artesanal: ' . get_the_title(), 'sizes' => '(max-width: 1024px) 100vw, 58vw' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
						<?php else : ?><img class="aspect-[4/5] w-full object-cover" src="<?php echo esc_url( herme_product_placeholder() ); ?>" alt="Foto principal de <?php echo esc_attr( get_the_title() ); ?> a adicionar" width="800" height="1000"><?php endif; ?>
					</div>
					<?php if ( $gallery ) : ?><div class="product-gallery mt-4 grid grid-cols-4 gap-3 md:grid-cols-5" aria-label="Fotos do produto">
                        <?php if ( has_post_thumbnail() ) : $main_id = get_post_thumbnail_id(); ?>
                            <button class="gallery-thumb is-active overflow-hidden bg-sand" type="button" aria-pressed="true" data-gallery-image="<?php echo esc_url( wp_get_attachment_image_url( $main_id, 'herme-detail' ) ); ?>" data-gallery-srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $main_id, 'herme-detail' ) ); ?>" data-gallery-alt="<?php echo esc_attr( get_post_meta( $main_id, '_wp_attachment_image_alt', true ) ?: get_the_title() ); ?>" aria-label="Mostrar foto principal de <?php echo esc_attr( get_the_title() ); ?>">
                                <?php echo wp_get_attachment_image( $main_id, 'thumbnail', false, array( 'class' => 'aspect-square h-full w-full object-cover', 'loading' => 'lazy', 'alt' => get_post_meta( $main_id, '_wp_attachment_image_alt', true ) ?: 'Foto principal de ' . get_the_title() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                            </button>
                        <?php endif; ?>
						<?php foreach ( $gallery as $image_id ) : ?>
							<?php $full = wp_get_attachment_image_url( $image_id, 'herme-detail' ); if ( ! $full ) { continue; } ?>
							<button class="gallery-thumb overflow-hidden bg-sand" type="button" aria-pressed="false" data-gallery-image="<?php echo esc_url( $full ); ?>" data-gallery-srcset="<?php echo esc_attr( wp_get_attachment_image_srcset( $image_id, 'herme-detail' ) ); ?>" data-gallery-alt="<?php echo esc_attr( get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: get_the_title() ); ?>" aria-label="Mostrar foto adicional de <?php echo esc_attr( get_the_title() ); ?>">
								<?php echo wp_get_attachment_image( $image_id, 'thumbnail', false, array( 'class' => 'aspect-square h-full w-full object-cover', 'loading' => 'lazy', 'alt' => get_post_meta( $image_id, '_wp_attachment_image_alt', true ) ?: 'Detalhe de ' . get_the_title() ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
							</button>
						<?php endforeach; ?>
					</div><?php endif; ?>
				</div>
				<div class="product-copy min-w-0 lg:sticky lg:top-36 lg:self-start lg:py-10">
					<p class="product-kicker eyebrow mb-6 text-olive">Peças artesanais</p><h1 class="product-title font-display text-[clamp(2.4rem,4vw,4.5rem)] leading-[1.6] tracking-[.16em]"><?php the_title(); ?></h1>
					<div class="product-description mt-8 max-w-lg leading-[1.6] text-brown"><?php echo wp_kses_post( apply_filters( 'the_content', get_the_content() ) ); ?></div>
					<?php if ( $terms && ! is_wp_error( $terms ) ) : ?><div class="product-category mt-9 border-t border-olive/20 pt-6"><p class="eyebrow mb-3 text-olive">Categoria</p><?php foreach ( $terms as $term ) : ?><a class="mr-3 text-link" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a><?php endforeach; ?></div><?php endif; ?>
					<div class="product-cta mt-10"><?php get_template_part( 'template-parts/whatsapp-button', null, array( 'product_name' => get_the_title(), 'label' => 'Quero saber mais pelo WhatsApp →', 'class' => 'button button-dark' ) ); ?></div>
				</div>
			</div>
		</article>
	<?php endwhile; ?>
</main>
<?php get_footer(); ?>
