<?php $instagram = get_theme_mod('herme_instagram', ''); ?>
<footer class="bg-olive-dark text-cream">
	<div class="mx-auto flex max-w-[1440px] flex-col gap-10 px-5 py-12 md:px-9 lg:flex-row lg:items-end lg:justify-between lg:px-12 lg:py-14">
		<div>
			<a class="inline-flex items-center" href="<?php echo esc_url(home_url('/')); ?>">
				<?php if (file_exists(get_template_directory() . '/assets/imgs/logotipo.png')) : ?>
					<img class="block w-48" src="<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/logotipo.png'); ?>" alt="Hermé — Essência &amp; Gesso" width="1536" height="1024" loading="lazy" decoding="async" style="filter: brightness(0) invert(1);">
				<?php else : ?>
					<span class="font-display text-4xl font-normal tracking-[.16em]">HERMÉ</span>
				<?php endif; ?>
			</a>
		</div>
		<nav class="flex flex-wrap gap-x-6 gap-y-3 text-xs uppercase tracking-[.16em]" aria-label="Navegação do rodapé">
			<a href="<?php echo esc_url(home_url('/')); ?>">Início</a>
			<a href="<?php echo esc_url(get_post_type_archive_link('produto')); ?>">Produtos</a>
			<a href="<?php echo esc_url(home_url('/#personalizados')); ?>">Personalizados</a>
			<a href="<?php echo esc_url(home_url('/#sobre')); ?>">Sobre</a>
			<a href="<?php echo esc_url(home_url('/#contato')); ?>">Contato</a>
		</nav>
		<?php if ($instagram) : ?>
			<a class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-cream/40 text-cream transition-colors hover:bg-cream hover:text-olive-dark focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-cream" href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram da Hermé (abre em nova aba)">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
			</a>
		<?php else : ?>
			<span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-cream/40 text-cream/70" aria-label="Instagram da Hermé">
				<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
			</span>
		<?php endif; ?>

	</div>
	<div class="mx-auto flex max-w-[1440px] flex-col gap-2 border-t border-cream/20 px-5 py-5 text-[11px] text-cream/60 md:flex-row md:justify-between md:px-9 lg:px-12">
		<span>© <?php echo esc_html(gmdate('Y')); ?> Hermé — Essência &amp; Gesso.</span>
		<span>Feito à mão, com tempo e propósito.</span>
	</div>
</footer>
<?php wp_footer(); ?>
</body>

</html>