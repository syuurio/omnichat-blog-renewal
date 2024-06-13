<?php
$frontpage_id = get_option('page_on_front');
$sticky_posts = get_field('article_sticky_links', $frontpage_id);

if ($sticky_posts) :
foreach ($sticky_posts as $post) :
$permalink = get_permalink($post->ID);
$title = get_the_title($post->ID);
$featuredImage = get_the_post_thumbnail($post->ID, 'medium');
?>
<div class="sticky-item">
  <figure class="sticky-item__img aspect-img">
    <?= $featuredImage ?>
  </figure>
  <h3 class="sticky-item__title text-overflow-lines-3">
    <a href="<?= $permalink ?>" target="_blank" title="<?= $title ?>"><?= $title ?></a>
  </h3>
</div>
<?php
endforeach;
endif;
?>
