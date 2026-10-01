<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>

<body <?php body_class('bg-cream text-ink antialiased'); ?>>
	<?php wp_body_open(); ?>
	<?php $instagram = get_theme_mod('herme_instagram', ''); ?>

	<header id="site-header" class="fixed inset-x-0 top-0 z-50 transition-colors duration-300 border-b site-header border-olive-dark/10 bg-cream">
		<div class="mx-auto flex h-20 max-w-[1440px] items-center justify-between gap-4 px-5 md:px-9 lg:grid lg:h-24 lg:grid-cols-[180px_1fr_224px] xl:grid-cols-[210px_1fr_224px] lg:gap-6 lg:px-12">
			<a href="<?php echo esc_url(home_url('/')); ?>" class="inline-flex items-center" aria-label="Hermé — página inicial">
				<?php if (file_exists(get_template_directory() . '/assets/imgs/logotipo.png')) : ?>
					<img class="h-14 w-auto origin-left scale-[1.8] lg:scale-[2.4]" src="<?php echo esc_url(get_template_directory_uri() . '/assets/imgs/logotipo.png'); ?>" alt="Hermé — Essência &amp; Gesso" width="1536" height="1024" fetchpriority="high" decoding="async">
				<?php else : ?>
					<span class="block text-2xl leading-[1.6]">HERMÉ</span><span class="block text-[8px]">Essência &amp; Gesso</span>
				<?php endif; ?>
			</a>
			<nav class="items-center justify-center hidden gap-6 font-semibold xl:gap-12 lg:flex" aria-label="Navegação principal">
				<a class="nav-link " href="<?php echo esc_url(home_url('/')); ?>">Início</a>
				<a class="nav-link " href="<?php echo esc_url(home_url('/#essencia')); ?>">Nossa Essência</a>
				<a class="nav-link " href="<?php echo esc_url(get_post_type_archive_link('produto')); ?>">Peças</a>
				<a class="nav-link " href="<?php echo esc_url(home_url('/#personalizados')); ?>">Personalizados</a>
			</nav>
			<div class="hidden items-center justify-end gap-3 lg:flex">
				<a class="group inline-flex h-[52px] items-center justify-center gap-3 rounded-full bg-olive-dark px-6 text-xs text-cream transition-colors duration-300 hover:bg-olive" href="<?php echo esc_url(home_url('/#contato')); ?>">Contato
				<svg class="h-6 w-6 transition-transform duration-300 group-hover:translate-x-0.5 group-hover:-translate-y-0.5" width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
					<path d="M7 17L17 7M17 16V7H8" stroke="#FBF8F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
				</svg>
				</a>
				<?php if ($instagram) : ?>
					<a class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-olive-dark/30 text-olive-dark transition-colors hover:bg-olive-dark hover:text-cream focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-olive-dark" href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram da Hermé (abre em nova aba)">
						<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
					</a>
				<?php else : ?>
					<span class="inline-flex h-11 w-11 shrink-0 items-center justify-center rounded-full border border-olive-dark/30 text-olive-dark/70" aria-label="Instagram da Hermé">
						<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
					</span>
				<?php endif; ?>
			</div>
			<div class="flex items-center gap-3 lg:hidden">
				<a class="flex items-center justify-center rounded-full h-11 w-11 bg-olive-dark text-cream" href="<?php echo esc_url(home_url('/#contato')); ?>" aria-label="Contato">
					<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" focusable="false">
						<path d="M7 17L17 7M17 16V7H8" stroke="#FBF8F2" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
					</svg>
				</a>
				<?php if ($instagram) : ?>
					<a class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-full border border-olive-dark/30 text-olive-dark min-[360px]:inline-flex focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-olive-dark" href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" aria-label="Instagram da Hermé (abre em nova aba)">
						<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
					</a>
				<?php else : ?>
					<span class="hidden h-10 w-10 shrink-0 items-center justify-center rounded-full border border-olive-dark/30 text-olive-dark/70 min-[360px]:inline-flex" aria-label="Instagram da Hermé">
						<svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg>
					</span>
				<?php endif; ?>
				<button id="menu-toggle" class="relative z-50 flex items-center justify-center border rounded-full menu-toggle h-11 w-11 border-olive-dark/30" type="button" aria-controls="mobile-menu" aria-expanded="false" aria-label="Abrir menu">
					<span class="menu-lines"><span></span><span></span></span>
				</button>
			</div>
		</div>
		<nav id="mobile-menu" class="absolute left-0 right-0 px-6 pt-4 pb-8 shadow-lg mobile-menu top-full bg-cream lg:hidden" aria-label="Navegação mobile" hidden>
			<a href="<?php echo esc_url(home_url('/')); ?>">Início</a>
			<a href="<?php echo esc_url(home_url('/#essencia')); ?>">Nossa Essência</a>
			<a href="<?php echo esc_url(get_post_type_archive_link('produto')); ?>">Peças</a>
			<a href="<?php echo esc_url(home_url('/#personalizados')); ?>">Personalizados</a>
			<a href="<?php echo esc_url(home_url('/#contato')); ?>">Contato</a>
			<?php if ($instagram) : ?>
				<a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer"><span class="inline-flex items-center gap-3"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg><span>Instagram<span class="sr-only"> (abre em nova aba)</span></span></span></a>
			<?php else : ?>
				<span class="flex items-center gap-3 border-b border-olive-dark/10 py-[.9rem] font-sans text-[1.4rem] leading-[1.6] text-olive-dark/70"><svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.7" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true" focusable="false">
					<rect x="2.5" y="2.5" width="19" height="19" rx="5"></rect>
					<circle cx="12" cy="12" r="4.2"></circle>
					<circle cx="17.6" cy="6.5" r="1" fill="currentColor" stroke="none"></circle>
				</svg><span>Instagram</span></span>
			<?php endif; ?>
		</nav>
	</header>