<?php

/**
 * Template Name: Custom Archive Post Template

 */
get_header();

$paged = get_query_var('paged') ? get_query_var('paged') : 1;
?>

<div id="primary" class="content-area" style="margin-inline: 100px;">
	<main id="main" class="site-main">

		<?php if (have_posts()) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php _e('All Post', 'twentytwentyone'); ?></h1>
			</header>

			<?php
			$args = array(
				'post_type' => 'post',
				'post_status' => 'publish',
				'paged'          => $paged,
				'posts_per_page' => 6,
			);

			$custom_query = new WP_Query($args);

			if ($custom_query->have_posts()) {
				echo '<div class="post-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); grid-gap: 30px; padding: 30px;">';

				while ($custom_query->have_posts()) {
					$custom_query->the_post();
					$country = get_post_meta(get_the_ID(), '_country_location', true);
					echo '<div class="grid-item">';
					echo '<h2>' . '<a href="' . get_permalink() . '">' . get_the_title() . '</a></h2>';
					echo '<p>' . get_the_content() . '</p>';

					

					if (!empty($country) && !($country == 'Not Selected') && shortcode_exists("country_shortcodeTest")) {
						echo '<p><strong>Country:</strong> ' . esc_html($country) . '</p>';
					}

					echo '<p>' . get_the_date() . '</p>';
					echo '</div>';
				}

				echo '</div>';
				wp_reset_postdata();
			}

			?>

		<?php else : ?>

			<?php get_template_part('template-parts/content', 'none'); ?>

		<?php endif; ?>
		<?php wp_pagenavi(array('query' => $custom_query)); ?>
	</main>

</div>


<?php
get_footer();
