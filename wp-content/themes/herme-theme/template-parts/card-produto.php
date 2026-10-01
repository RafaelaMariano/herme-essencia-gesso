<?php
$product_id = get_the_ID();
$summary_source = has_excerpt($product_id) ? get_the_excerpt($product_id) : get_post_field('post_content', $product_id);
$summary = wp_trim_words(wp_strip_all_tags(strip_shortcodes($summary_source)), 18, '…');
$quote_url = herme_whatsapp_url(get_the_title($product_id), true);
?>
<article class="min-w-0">
	<div class="relative group">
		<div class="block aspect-[4/5] overflow-hidden rounded-[20px] bg-sand">
			<?php if (has_post_thumbnail($product_id)) : ?>
				<?php echo get_the_post_thumbnail($product_id, 'herme-card', array('class' => 'h-full w-full object-cover transition-transform duration-500 group-hover:scale-[1.03]', 'loading' => 'lazy', 'decoding' => 'async', 'sizes' => '(min-width: 1024px) 22vw, (min-width: 640px) 45vw, 90vw')); ?>
			<?php else : ?>
				<img class="h-full w-full object-cover" src="<?php echo esc_url(herme_product_placeholder()); ?>" alt="Foto de <?php echo esc_attr(get_the_title($product_id)); ?> a adicionar" loading="lazy" width="760" height="950">
			<?php endif; ?>
		</div>
		<?php if ($quote_url) : ?>
			<a class="w-full mt-3 tracking-normal normal-case rounded-full button button-dark lg:pointer-events-none lg:absolute lg:bottom-5 lg:left-1/2 lg:mt-0 lg:w-auto lg:-translate-x-1/2 lg:opacity-0 lg:transition-opacity lg:duration-300 lg:group-hover:pointer-events-auto lg:group-hover:opacity-100 lg:group-focus-within:pointer-events-auto lg:group-focus-within:opacity-100 lg:focus-visible:pointer-events-auto lg:focus-visible:opacity-100" href="<?php echo esc_url($quote_url); ?>" target="_blank" rel="noopener noreferrer">
				<svg class="w-6 h-6 shrink-0" width="64" height="64" viewBox="0 -0.5 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
											<g id="SVGRepo_iconCarrier">
												<path fill-rule="evenodd" clip-rule="evenodd" d="M5.50063 16.1407C5.46273 18.2335 7.1278 19.9613 9.22063 20.0007H15.7806C17.8735 19.9613 19.5385 18.2335 19.5006 16.1407L19.0636 11.4527C18.9527 9.68529 17.716 8.19053 16.0006 7.75065C15.6432 7.64667 15.2729 7.59348 14.9006 7.59265H10.1006C9.72837 7.59348 9.35808 7.64667 9.00063 7.75065C7.28636 8.19067 6.05026 9.68433 5.93863 11.4507L5.50063 16.1407Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												<path fill-rule="evenodd" clip-rule="evenodd" d="M10.0056 14.1216C9.33164 13.371 9.33164 12.2332 10.0056 11.4826C10.3288 11.155 10.7775 10.9824 11.237 11.009C11.6965 11.0356 12.1223 11.2588 12.4056 11.6216C12.429 11.6466 12.4618 11.6608 12.4961 11.6608C12.5304 11.6608 12.5631 11.6466 12.5866 11.6216C12.8699 11.2588 13.2956 11.0356 13.7551 11.009C14.2146 10.9824 14.6633 11.155 14.9866 11.4826C15.6605 12.2332 15.6605 13.371 14.9866 14.1216L13.7536 15.4626C13.4275 15.8061 12.9747 16.0006 12.5011 16.0006C12.0275 16.0006 11.5747 15.8061 11.2486 15.4626L10.0056 14.1216Z" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
												<path d="M16.0006 9.38862V7.36762C15.9629 5.4718 14.3965 3.96493 12.5006 4.00062C10.6047 3.96493 9.03835 5.4718 9.00061 7.36762V9.38762" stroke="#fff" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
											</g>
										</svg>
				Pedir orçamento<span class="sr-only"> (abre em nova aba)</span>
			</a>
		<?php endif; ?>
	</div>
	<div class="block">
		<h3 class="mt-5 font-serif text-[24px] font-normal normal-case leading-[1.2] tracking-[-.02em] text-olive-dark lg:text-[26px]"><?php echo esc_html(get_the_title($product_id)); ?></h3>
		<?php if ($summary) : ?><p class="mt-2 line-clamp-2 text-sm font-normal normal-case leading-[1.5] tracking-normal text-brown"><?php echo esc_html($summary); ?></p><?php endif; ?>
	</div>
</article>
