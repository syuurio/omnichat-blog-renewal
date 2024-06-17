<div class="sticky-articles">
<?php
$frontpage_id = get_option('page_on_front');
$has_event = get_field('pickup_event_show_event', $frontpage_id);
$sticky_posts = get_field('sticky_articles', $frontpage_id);

if ($has_event) :
$event = get_field('pickup_event_info', $frontpage_id);
$event_title = $event['title'];
$event_link = $event['link'];
$event_image = $event['image']['sizes']['medium'];
?>
<div class="sticky-item"><figure class="sticky-item__img aspect-img"><img src="<?= esc_url($event_image) ?>" alt="<?= esc_attr($event_title)?>"></figure><h3 class="sticky-item__title dynamic-title text-overflow-lines-3"><a href="<?= esc_url($event_link) ?>" target="_blank" title="<?= esc_attr($event_title) ?>"><?= esc_html($event_title) ?></a></h3></div>
<?php endif; ?>
<?php if ($sticky_posts) :
foreach ($sticky_posts as $post) :
$permalink = get_permalink($post->ID);
$title = get_the_title($post->ID);
$featuredImage = get_the_post_thumbnail($post->ID, 'medium');
?>
<div class="sticky-item"><figure class="sticky-item__img aspect-img"><?= $featuredImage ?></figure><h3 class="sticky-item__title dynamic-title text-overflow-lines-3"><a href="<?= $permalink ?>" target="_blank" title="<?= $title ?>"><?= $title ?></a></h3></div>
<?php
endforeach;
endif;
?>
</div>