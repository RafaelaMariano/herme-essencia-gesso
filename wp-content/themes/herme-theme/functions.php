<?php
/**
 * Funções essenciais do tema Hermé.
 *
 * @package herme-theme
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

function herme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support( 'custom-logo' );
	add_image_size( 'herme-card', 760, 950, true );
	add_image_size( 'herme-wide', 1440, 960, true );
	add_image_size( 'herme-detail', 1000, 1250, true );
}
add_action( 'after_setup_theme', 'herme_setup' );

function herme_register_products() {
	register_post_type( 'produto', array(
		'labels' => array(
			'name' => 'Produtos',
			'singular_name' => 'Produto',
			'add_new_item' => 'Adicionar produto',
			'edit_item' => 'Editar produto',
		),
		'public' => true,
		'has_archive' => 'produtos',
		'rewrite' => array( 'slug' => 'produtos', 'with_front' => false ),
		'menu_icon' => 'dashicons-art',
		'show_in_rest' => true,
		'supports' => array( 'title', 'editor', 'thumbnail' ),
	) );

	register_taxonomy( 'categoria_produto', 'produto', array(
		'labels' => array(
			'name' => 'Categorias de Produtos',
			'singular_name' => 'Categoria de Produto',
		),
		'public' => true,
		'hierarchical' => true,
		'show_in_rest' => true,
		'rewrite' => array( 'slug' => 'categoria-produto', 'with_front' => false ),
	) );
}
add_action( 'init', 'herme_register_products' );

function herme_activate_theme() {
    herme_register_products();
    $categories = array(
        'Velas' => array( 'slug' => 'velas', 'description' => 'Aromas que acolhem.' ),
        'Peças em gesso' => array( 'slug' => 'gesso', 'description' => 'Arte nos detalhes.' ),
        'Decoração' => array( 'slug' => 'decoracao', 'description' => 'Beleza em cada espaço.' ),
        'Presentes' => array( 'slug' => 'presentes', 'description' => 'Afeto em forma de peças.' ),
    );
    foreach ( $categories as $name => $details ) {
        if ( ! term_exists( $details['slug'], 'categoria_produto' ) ) {
            wp_insert_term( $name, 'categoria_produto', $details );
        }
    }
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'herme_activate_theme' );

function herme_assets() {
	$theme = get_template_directory_uri();
	$path  = get_template_directory();
	$css   = '/assets/css/app.css';
	wp_enqueue_style( 'herme-fonts', 'https://fonts.googleapis.com/css2?family=Inter:ital,wght@0,400;1,400&display=swap', array(), null );
	wp_enqueue_style( 'herme-app', $theme . $css, array( 'herme-fonts' ), file_exists( $path . $css ) ? filemtime( $path . $css ) : '1.0.0' );
	wp_enqueue_script( 'herme-main', $theme . '/assets/js/main.js', array(), '1.0.0', true );

	if ( is_front_page() && file_exists( $path . '/assets/js/vendor/gsap.min.js' ) && file_exists( $path . '/assets/js/vendor/ScrollTrigger.min.js' ) ) {
		wp_enqueue_script( 'herme-gsap', $theme . '/assets/js/vendor/gsap.min.js', array(), '3.14.0', true );
		wp_enqueue_script( 'herme-scrolltrigger', $theme . '/assets/js/vendor/ScrollTrigger.min.js', array( 'herme-gsap' ), '3.14.0', true );
		wp_enqueue_script( 'herme-animations', $theme . '/assets/js/animations.js', array( 'herme-scrolltrigger' ), '1.0.0', true );
	}
}
add_action( 'wp_enqueue_scripts', 'herme_assets' );

function herme_admin_assets( $hook ) {
	if ( ! in_array( $hook, array( 'post.php', 'post-new.php' ), true ) || 'produto' !== get_current_screen()->post_type ) {
		return;
	}
	wp_enqueue_media();
	wp_enqueue_script( 'herme-admin', get_template_directory_uri() . '/assets/js/admin.js', array(), '1.0.0', true );
}
add_action( 'admin_enqueue_scripts', 'herme_admin_assets' );

function herme_customize_register( $customize ) {
	$customize->add_section( 'herme_contact', array( 'title' => 'Contato Hermé', 'priority' => 30 ) );
	$customize->add_setting( 'herme_whatsapp', array(
		'default' => '',
		'sanitize_callback' => 'herme_sanitize_phone',
	) );
	$customize->add_control( 'herme_whatsapp', array(
		'label' => 'WhatsApp com DDI e DDD (somente números)',
		'section' => 'herme_contact',
		'type' => 'text',
	) );
	$customize->add_setting( 'herme_instagram', array(
		'default' => '',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$customize->add_control( 'herme_instagram', array(
		'label' => 'URL do Instagram',
		'section' => 'herme_contact',
		'type' => 'url',
	) );
}
add_action( 'customize_register', 'herme_customize_register' );

function herme_sanitize_phone( $phone ) {
	return preg_replace( '/\D+/', '', (string) $phone );
}

function herme_whatsapp_url( $product_name = '', $request_quote = false ) {
	$number = herme_sanitize_phone( get_theme_mod( 'herme_whatsapp', '' ) );
	if ( ! $number ) {
		return '';
	}
	$message = $request_quote && $product_name
		? sprintf( 'Olá! Vim pelo site da Hermé e gostaria de pedir um orçamento para %s.', $product_name )
		: ( $product_name
			? sprintf( 'Olá! Vim pelo site da Hermé e gostaria de saber mais sobre %s.', $product_name )
			: 'Olá! Vim pelo site da Hermé e gostaria de saber mais sobre suas peças.' );
	return 'https://wa.me/' . $number . '?text=' . rawurlencode( $message );
}

function herme_image_url( $filename, $fallback = 'placeholder-peca.svg' ) {
	$relative = '/assets/imgs/' . $filename;
	if ( ! file_exists( get_template_directory() . $relative ) ) {
		$relative = '/assets/imgs/' . $fallback;
	}
	return get_template_directory_uri() . $relative;
}

function herme_product_placeholder() {
	return herme_image_url( 'produto-placeholder.jpg', 'placeholder-peca.svg' );
}

function herme_product_metaboxes() {
	add_meta_box( 'herme_gallery', 'Galeria do produto', 'herme_gallery_metabox', 'produto', 'normal', 'default' );
	add_meta_box( 'herme_featured', 'Produto em destaque', 'herme_featured_metabox', 'produto', 'side', 'default' );
}
add_action( 'add_meta_boxes', 'herme_product_metaboxes' );

function herme_gallery_metabox( $post ) {
	wp_nonce_field( 'herme_save_product', 'herme_product_nonce' );
	$ids = get_post_meta( $post->ID, '_herme_gallery_ids', true );
	$ids = is_array( $ids ) ? array_map( 'absint', $ids ) : array();
	echo '<p>Selecione fotos adicionais na Biblioteca de Mídia. A imagem destacada é a foto principal.</p>';
	echo '<div id="herme-gallery-preview" style="display:flex;flex-wrap:wrap;gap:12px;margin:12px 0">';
	foreach ( $ids as $id ) {
		$image = wp_get_attachment_image( $id, 'thumbnail' );
		if ( $image ) {
			echo '<div data-id="' . esc_attr( $id ) . '" style="position:relative">' . $image . '<button type="button" class="button-link herme-remove-image" aria-label="Remover imagem" style="display:block">Remover</button></div>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
	echo '</div>';
	echo '<input type="hidden" id="herme-gallery-ids" name="herme_gallery_ids" value="' . esc_attr( implode( ',', $ids ) ) . '">';
	echo '<button type="button" class="button" id="herme-add-images">Adicionar imagens</button>';
}

function herme_featured_metabox( $post ) {
	wp_nonce_field( 'herme_save_product', 'herme_product_nonce' );
	$checked = get_post_meta( $post->ID, 'produto_destaque', true );
	echo '<label><input type="checkbox" name="produto_destaque" value="1" ' . checked( '1', $checked, false ) . '> Mostrar na página inicial</label>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
}

function herme_save_product( $post_id ) {
	if ( ! isset( $_POST['herme_product_nonce'] ) || ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['herme_product_nonce'] ) ), 'herme_save_product' ) ) {
		return;
	}
	if ( ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) || ! current_user_can( 'edit_post', $post_id ) || 'produto' !== get_post_type( $post_id ) ) {
		return;
	}
	$raw = isset( $_POST['herme_gallery_ids'] ) ? sanitize_text_field( wp_unslash( $_POST['herme_gallery_ids'] ) ) : '';
	$ids = array_filter( array_unique( array_map( 'absint', explode( ',', $raw ) ) ) );
	$ids = array_values( array_filter( $ids, static function ( $id ) {
		return wp_attachment_is_image( $id );
	} ) );
	update_post_meta( $post_id, '_herme_gallery_ids', $ids );
	update_post_meta( $post_id, 'produto_destaque', isset( $_POST['produto_destaque'] ) && '1' === sanitize_text_field( wp_unslash( $_POST['produto_destaque'] ) ) ? '1' : '0' );
}
add_action( 'save_post_produto', 'herme_save_product' );

function herme_archive_query( $query ) {
	if ( ! is_admin() && $query->is_main_query() && ( $query->is_post_type_archive( 'produto' ) || $query->is_tax( 'categoria_produto' ) ) ) {
		$query->set( 'posts_per_page', 12 );
	}
}
add_action( 'pre_get_posts', 'herme_archive_query' );

/** Produtos são exibidos nas vitrines; links individuais antigos voltam ao catálogo. */
function herme_redirect_single_product() {
	if ( is_singular( 'produto' ) ) {
		$archive_url = get_post_type_archive_link( 'produto' );
		if ( $archive_url ) {
			wp_safe_redirect( $archive_url, 301 );
			exit;
		}
	}
}
add_action( 'template_redirect', 'herme_redirect_single_product' );

function herme_meta_description() {
	if ( is_admin() ) {
		return;
	}
	$description = 'Peças artesanais em gesso, velas e decoração. Feitas à mão para transformar ambientes e momentos.';
	if ( is_singular( 'produto' ) ) {
		$description = wp_trim_words( wp_strip_all_tags( get_the_excerpt() ?: get_the_content() ), 25, '…' );
	} elseif ( is_tax( 'categoria_produto' ) ) {
		$description = wp_strip_all_tags( term_description() ?: single_term_title( '', false ) . ' artesanais da Hermé.' );
	}
	$description = wp_html_excerpt( $description, 160, '…' );
	echo '<meta name="description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:title" content="' . esc_attr( wp_get_document_title() ) . '">' . "\n";
	echo '<meta property="og:description" content="' . esc_attr( $description ) . '">' . "\n";
	echo '<meta property="og:url" content="' . esc_url( is_singular() ? get_permalink() : ( is_tax( 'categoria_produto' ) ? get_term_link( get_queried_object() ) : ( is_post_type_archive( 'produto' ) ? get_post_type_archive_link( 'produto' ) : home_url( '/' ) ) ) ) . '">' . "\n";
	echo '<meta property="og:type" content="' . ( is_singular( 'produto' ) ? 'product' : 'website' ) . '">' . "\n";
	if ( is_singular( 'produto' ) && has_post_thumbnail() ) {
		echo '<meta property="og:image" content="' . esc_url( get_the_post_thumbnail_url( get_the_ID(), 'large' ) ) . '">' . "\n";
	}
}
add_action( 'wp_head', 'herme_meta_description', 2 );

/** Use the theme mark as the browser tab icon until a Site Icon is set in WordPress. */
function herme_favicon() {
    if ( has_site_icon() ) {
        return;
    }
    $images = get_template_directory_uri() . '/assets/imgs/';
    echo '<link rel="icon" href="' . esc_url( $images . 'favicon.svg' ) . '" type="image/svg+xml">' . "\n";
    echo '<link rel="icon" href="' . esc_url( $images . 'favicon-32.png' ) . '" sizes="32x32" type="image/png">' . "\n";
    echo '<link rel="apple-touch-icon" href="' . esc_url( $images . 'apple-touch-icon.png' ) . '">' . "\n";
}
add_action( 'wp_head', 'herme_favicon', 1 );
