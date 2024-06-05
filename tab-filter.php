<?php
	$categories = array(
		'whatsapp',
		'line',
		'facebook',
		'instagram'
	);

	$tabs = [];
	
	foreach ($categories as $type) {
		$catName = $type . '-' . pll_current_language();
		$category = get_category_by_slug($catName);
		

		if ($category) {
			$tabs[] = $category;
		}
	}
?>

<div class="omni-channel__tab-list is-layout-flex wp-block-buttons-is-layout-flex">
	<?php foreach ($tabs as $i => $tab) : ?>
	<div class="<?= $i === 0 ? 'omni-channel__tab pill-styled-tab active' : 'omni-channel__tab pill-styled-tab' ?>"
		data-tab="<?= $tab->name ?>">
		<button class="wp-element-button">
			<?= $tab->name ?>
		</button>
	</div>
	<?php endforeach; ?>
</div>
<div class="omni-channel__container">
	<?php
		foreach ($tabs as $i => $tab) :
			$args = array(
				'posts_per_page' => 4,
				'orderby' => 'date',
				'order' => 'DESC',
				'cat' => $tab->term_id,
				'ignore_sticky_posts' => 1
			);

			$query = new WP_Query($args);
	?>
	<div class="<?= $i === 0 ? 'omni-channel__tab-content active' : 'omni-channel__tab-content' ?>"
		data-tab-content="<?= $tab->name ?>">
		<?php if ($query->have_posts()) : ?>
		<div class="omni-channel__gallery">
			<?php
	while ($query->have_posts()) :
	$query->the_post(); 
?>
			<div class="article-card group-hover">
				<div class="article-card__img aspect-img">
					<figure class="aspect-img wp-block-post-featured-image">
						<?php the_post_thumbnail(); ?>
					</figure>
				</div>

				<div class="article-card__info">
					<div class="article-card__category">
						<?php the_category(' '); ?>
					</div>
					<h2 class="article-card__title dynamic-title text-truncate">
						<a href="<?php the_permalink(); ?>" target="_blank" title="<?php the_title(); ?>">
							<?php the_title(); ?>
						</a>
					</h2>
					<div class="article-card__excerpt text-overflow-lines-3">
						<?php the_excerpt(); ?>
					</div>
				</div>
				<div class="wp-block-group custom-read-more group-hover">
					<a class="read-more" href="<?php the_permalink(); ?>" target="_blank">
						Read more
					</a>
				</div>
			</div>
			<?php
	endwhile;
	wp_reset_postdata();
?>
		</div>
		<div class="omni-channel__tab-footer">
			<div class="pill-styled-btn">
				<a class="wp-element-button" href="<?= get_category_link($tab->term_id) ?>" target="_blank">Show More</a>
			</div>
		</div>
		<?php else : ?>
		<div class="omni-channel__no-posts">
			Coming soon...
		</div>
		<?php	endif; ?>
	</div>
	<?php	endforeach; ?>
</div>

<script>
	const tabs = document.querySelectorAll('.omni-channel__tab')
	tabs.forEach(el => {
		el.addEventListener('click', () => {
			tabs.forEach(tab => {
				if (tab !== el) {
					tab.classList.remove('active')
				} else {
					tab.classList.add('active')
				}
			})
		})
	})

	const observer = new MutationObserver((mutationList) => {
		for (const { target, attributeName } of mutationList) {
			if (attributeName === 'class') {
				const tabId = target.dataset.tab
				const tabContent = document.querySelector(`.omni-channel__tab-content[data-tab-content="${tabId}"]`)
				if (target.classList.contains('active')) {
					tabContent.classList.add('active')
				} else {
					tabContent.classList.remove('active')
				}
			}
		}
	})
	observer.observe(document.querySelector('.omni-channel__tab-list'), {
		subtree: true,
		attributeFilter: ['class']
	})
</script>