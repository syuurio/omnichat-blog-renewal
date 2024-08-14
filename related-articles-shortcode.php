<?php
$lang = pll_current_language();
$ignore_posts = array(get_the_ID());
?>
<div id="related-articles" class="related-articles"><div class="related-articles__title dynamic-title"><h2><?= $lang === 'en' ? 'Recommended Articles' : '推薦文章' ?></h2></div><div class="article-grid-layout__grid">
<?php
$query_count = 3;
$related_articles_by_admin = get_field('related_articles');

if ($related_articles_by_admin) :
$query_count = $query_count - count($related_articles_by_admin);

foreach ($related_articles_by_admin as $post) :
$title = get_the_title($post->ID);
$content = wp_strip_all_tags($post->post_content, true);
$excerpt = substr($content, 0, 500);
$permalink = get_permalink($post->ID);
$featuredImage = get_the_post_thumbnail($post->ID);
$ignore_posts[] = $post->ID;
?>
<div class="article-card with-shadow related-card"><div class="article-card__img aspect-img"><figure><?= $featuredImage ?></figure></div><div class="article-card__info"><div class="article-card__title dynamic-title"><h2 class="text-overflow-lines-3"><a href="<?= $permalink ?>" target="_self"><?= $title ?></a></h2></div><div class="article-card__excerpt text-overflow-lines-3"><p><?= $excerpt ?></p></div></div><div class="article-card__footer"><div class="custom-read-more"><a class="read-more" href="<?= $permalink ?>" target="_self">Read more</a></div></div></div>
<?php endforeach; ?>
<?php endif; ?>
<?php
if ($query_count > 0) :
$categories = array();
$post_category = get_the_category();

foreach ($post_category as $category) {
  $categories[] = $category->term_id;
}

$args = array(
  'category__in' => $categories,
  'ignore_sticky_posts' => 1,
  'post__not_in' => $ignore_posts,
  'posts_per_page' => $query_count,
  'orderby' => 'date',
  'order' => 'DESC',
);

$related_posts = new WP_Query($args);

if ($related_posts->have_posts()) :
while ($related_posts->have_posts()) :
$related_posts->the_post();
$title = get_the_title();
$content = wp_strip_all_tags(get_the_content(), true);
$excerpt = substr($content, 0, 500);
$permalink = get_permalink();
$featuredImage = get_the_post_thumbnail();
?>
<div class="article-card with-shadow related-card"><div class="article-card__img aspect-img"><figure><?= $featuredImage ?></figure></div><div class="article-card__info"><div class="article-card__title dynamic-title"><h2 class="text-overflow-lines-3"><a href="<?= $permalink ?>" target="_self"><?= $title ?></a></h2></div><div class="article-card__excerpt text-overflow-lines-3"><p><?= $excerpt ?></p></div></div><div class="article-card__footer"><div class="custom-read-more"><a class="read-more" href="<?= $permalink ?>" target="_self">Read more</a></div></div></div>
<?php
endwhile;
wp_reset_postdata();
endif;
endif;
?>
</div></div>