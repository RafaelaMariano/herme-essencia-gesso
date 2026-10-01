<?php
$label = isset( $args['label'] ) ? $args['label'] : 'Fale pelo WhatsApp';
$class = isset( $args['class'] ) ? $args['class'] : 'button button-dark';
$name  = isset( $args['product_name'] ) ? $args['product_name'] : '';
$url   = herme_whatsapp_url( $name );
if ( $url ) :
	?>
	<a class="<?php echo esc_attr( $class ); ?>" href="<?php echo esc_url( $url ); ?>" target="_blank" rel="noopener noreferrer"><?php echo esc_html( $label ); ?><span class="sr-only"> (abre em nova aba)</span></a>
<?php endif; ?>
