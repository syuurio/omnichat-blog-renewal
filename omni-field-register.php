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

function render_omni_field( $attrs ) {
	$mapping = array(
		'success-case-logo' => 'render_success_case_logo',
		'article-excerpt' => 'render_excerpt',
		'search-title' => 'render_search_title',
		'search-result' => 'render_search_result',
		'no-result' => 'render_no_result_found'
	);

	if (isset($mapping[$attrs['id']])) {
		return $mapping[$attrs['id']]();
	}

	return '';
}

add_shortcode( 'omnif', 'render_omni_field' );

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
function render_search_title () {
	$lang = pll_current_language();
	$title = $lang === 'en' ? 'Search results for ' . '“' . get_search_query() . '”' : '搜尋主題：' . get_search_query();

	ob_start();
	?>
	<h1><?= $title ?></h1>
	<?php
	return ob_get_clean();
}
function render_search_result () {
	global $wp_query;
	$lang = pll_current_language();
	$total_count = $wp_query->found_posts;
	$title = $total_count === 0 ?
		$lang === 'en' ? 'No results found.' : '沒有找到相關文章' : (
			$lang === 'en' ?
				$total_count . ' ' . ($total_count > 1 ? 'results' : 'result') . ' found.' :
				'找到 ' . $total_count . ' 篇相關文章'
			);

	ob_start();
	?>
	<p><?= $title ?></p>
	<?php
	return ob_get_clean();
}
function render_no_result_found () {
	$lang = pll_current_language();

	ob_start();
	?>
	<p><?= $lang === 'en' ? 'We did not find any articles matching your query, please try another search.' : '我們沒有找到任何符合您查詢的文章，請重新搜尋'; ?></p>
	<?php
	return ob_get_clean();
}