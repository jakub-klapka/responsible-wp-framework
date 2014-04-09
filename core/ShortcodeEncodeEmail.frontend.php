<?php


namespace Lumi\Frontend;

/**
 * Class ShortcodeEncodeEmail
 * Shortcode functions are actually needed only on frontend!
 * @package Lumi\Frontend
 */
class ShortcodeEncodeEmail {

	public function __construct()
	{
		add_shortcode( 'zakoduj-email', array( $this, 'do_shortcode' ) );
	}

	public function do_shortcode( $atts, $content = null )
	{
		if( empty($content) || !is_email( $content ) ) {
			return '';
		}

		wp_enqueue_script('mail_decode');

		return sprintf( '<a href="%s" class="mail_decode">%s</a>',
			str_rot13( 'mailto:' . $content ), str_rot13( $content ));

	}

} 