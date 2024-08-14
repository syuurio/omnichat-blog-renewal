$lang = pll_current_language();
$lang_suffix = array(
  'en' => 'global',
  'tw' => 'tw',
  'hk' => 'hk'
);
$solution_list = array(
  'omo',
  'social-cdp',
  'marketing',
  'customer-service',
  'loyalty-cloud',
);
$post_tags = array_column(get_the_terms(get_the_ID(), 'post_tag'), 'slug');
$tags = array_map(function ($tag) {
  return str_replace(array('-tw', '-hk'), '', $tag);
}, $post_tags);
$is_solution = in_array('solution', $tags);

if ($is_solution) {
  [$solution_type] = array_values(array_filter($tags, fn($tag) => in_array($tag, $solution_list)));

	if ($solution_type) {
    $args = array(
      'post_type' => 'wp_block',
      'numberposts' => -1,
      'tax_query' => array(
        array(
          'taxonomy' => 'wp_pattern_category',
          'field' => 'slug',
          'terms' => 'solution-banner',
        )
      ),
    );
  
    $patterns = get_posts($args);
    $pattern_name = $solution_type . '-' . $lang_suffix[$lang];
    $pattern_id = array_column($patterns, 'ID', 'post_name')[$pattern_name];
  
    if ($pattern_id) {
      echo do_blocks('<!-- wp:block {"ref":' . $pattern_id . '} /-->');
    }
  }
}