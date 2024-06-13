add_filter( 'render_block', function( $block_content, $block ) {
    // add class to target block
    $target_class = 'omni-field';
	$block_classes = ! empty( $block['attrs']['className'] ) ? explode(" ", $block['attrs']['className']) : [];
	
    if (
		in_array($target_class, $block_classes) && 
		count($block_classes) > 1
	) {
        // get the ID
        $post_id = get_the_ID();
        // build and return  my shortcode
        $short_code = '[omnif id="' . $block_classes[1] . '"]';
        return do_shortcode($short_code);
    }

    return $block_content;
}, 10, 2 );

function render_acf_field( $attrs ) {
	$mapping = array(
		'success-case-logo' => 'render_success_case_logo',
		'article-excerpt' => 'render_excerpt'
	);


	return $mapping[$attrs['id']]();
}

add_shortcode( 'omnif', 'render_acf_field' );

function render_success_case_logo () {
	$size = 'large';
	$img = get_field('company_logo');
	
	if ($img) :
	$imgURL = $img['sizes'][$size];
	$width = $img['sizes'][ $size . '-width' ];
	$height = $img['sizes'][ $size . '-height' ];
	$alt = $img['alt'] ? $img['alt'] : 'Brand Logo';
	
	ob_start();
	?>
	<div class="case-card__logo aspect-img">
		<figure>
			<img src="<?= $imgURL ?>" alt="<?= $alt ?>" width="<?= $width ?>" height="<?= $height ?>" />
		</figure>
	</div>
	<?php
	endif;
	return ob_get_clean();
}
function render_excerpt () {
	$content = wp_strip_all_tags(get_the_content(), true);
	$excerpt = substr($content, 0, 500);
	ob_start();
	?>
	<p><?= $excerpt ?></p>
	<?php
	return ob_get_clean();
}
