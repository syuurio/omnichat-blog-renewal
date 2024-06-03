<?php
/**
 * Put shortcode [polylang_langswitcher] to post/page for display flags
*/
function custom_polylang_langswitcher() {
	ob_start();
	?>
  	<ul class="lang-switcher"><?php pll_the_languages(); ?></ul>
	<?php
	return ob_get_clean();
}

add_shortcode( 'polylang_langswitcher', 'custom_polylang_langswitcher' );
?>