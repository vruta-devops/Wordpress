<?php
/**
 * Theme functions and definitions.
 *
 * For additional information on potential customization options,
 * read the developers' documentation:
 *
 * https://developers.elementor.com/docs/hello-elementor-theme/
 *
 * @package HelloElementorChild
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'HELLO_ELEMENTOR_CHILD_VERSION', '2.0.0' );

/**
 * Load child theme scripts & styles.
 *
 * @return void
 */
function hello_elementor_child_scripts_styles() {

	wp_enqueue_style(
		'hello-elementor-child-style',
		get_stylesheet_directory_uri() . '/style.css',
		[
			'hello-elementor-theme-style',
		],
		HELLO_ELEMENTOR_CHILD_VERSION
	);

}
add_action( 'wp_enqueue_scripts', 'hello_elementor_child_scripts_styles', 20 );

// SHORTCODE

function weekly_roundup_shortcode() {
    ob_start(); // Start output buffering
    ?>
    <section class="Weekly-Roundup">
        <div class="container">
            <p class="artical-latest">Latest Articles</p>
            <?php
            // Query for the latest normal post
            $args_latest = array(
                'post_type' => 'post', // Use normal posts
                'posts_per_page' => 1,
                'category_name' => '', // Adjust the category slug as needed
            );
            $latest_post = new WP_Query($args_latest);

            if ($latest_post->have_posts()) :
                while ($latest_post->have_posts()) : $latest_post->the_post();
                    // Get post featured image and title
                    $featured_image = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/default-roundup.webp';
                    $post_title = get_the_title();
                    $post_date = get_the_date();
                    $post_excerpt = wp_trim_words(get_the_excerpt(), 20);
                    $post_permalink = get_the_permalink();

                    // Get category
                    $terms = get_the_terms(get_the_ID(), 'category'); // Using default categories
                    $category = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Uncategorized';
            ?>
                    <div class="section-roundup">
                        <div class="roundup-left">
							<a href="<?php echo $post_permalink; ?>">
                            <img src="<?php echo $featured_image; ?>" alt="<?php echo $post_title; ?>"></a>
                            <p class="weekly-roundup"><?php echo $category; ?></p>
                        </div>
                        <div class="roundup-right">
						 <a href="<?php echo $post_permalink; ?>" style="Color:#171E33" class="btn-nobg">
                            <h2 class="rounded-header"><?php echo $post_title; ?></h2>
                            <p class="rounded-text"><?php echo $post_date; ?></p>
                            <p class="rounded-text-other"><?php echo $post_excerpt; ?></p>
                            <p class="btn-main">
                                <a href="<?php echo $post_permalink; ?>" class="btn-nobg">
                                    <span>See Deals</span>
                                    <img src="/wp-content/uploads/2024/10/ArrowRight-1.png" alt="Arrow Icon">
                                </a>
                            </p></a>
                        </div>
							  
                    </div>
                <?php endwhile;
                wp_reset_postdata();
            else : ?>
                <p>No latest post found.</p>
            <?php endif; ?>

            <div class="roundup-main">
                <?php
                // Query for the remaining normal posts, excluding the latest one
                $args_others = array(
                    'post_type' => 'post', // Use normal posts
                    'posts_per_page' => 3, // Adjust as necessary
                    'offset' => 1 // Skip the first (latest) post
                );
                $other_posts = new WP_Query($args_others);

                if ($other_posts->have_posts()) :
                    while ($other_posts->have_posts()) : $other_posts->the_post();
                        // Get post featured image and title
                        $featured_image = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/nulla-roundup.webp';
                        $post_title = get_the_title();
                        $post_date = get_the_date();
                        $post_excerpt = wp_trim_words(get_the_excerpt(), 20);
                        $post_permalink = get_the_permalink();

                        // Get category
                        $terms = get_the_terms(get_the_ID(), 'category');
                        $category = ($terms && !is_wp_error($terms)) ? $terms[0]->name : 'Uncategorized';
                ?>
				 
                        <div class="section-roundup round-col tc-two">
                            <div class="roundup-left rounded-left-two">
                                 <a href="<?php echo $post_permalink; ?>">
								<img  src="<?php echo $featured_image; ?>" alt="<?php echo $post_title; ?>">
								</a>
                                <p class="weekly-roundup"><?php echo $category; ?></p>
                            </div>
							<a href="<?php echo $post_permalink; ?>" style="Color:#171E33" class="btn-nobg">
                            <div class="roundup-right roundup-right-two">
                                <p class="rounded-text"><?php echo $post_date; ?></p>
                                <h2 class="rounded-header roundheader-two"><?php echo $post_title; ?></h2>
                                <p class="rounded-text-other text-other-two"><?php echo $post_excerpt; ?></p>
                                <p class="btn-main">
                                    <a href="<?php echo $post_permalink; ?>" class="btn-nobg">
                                        <span>See Deals</span>
                                         <img src="/wp-content/uploads/2024/10/ArrowRight-1.png" alt="Arrow Icon">
                                    </a>
                                </p>
                            </div>
								    </a>
                        </div>
					
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <?php
    return ob_get_clean(); // End output buffering and return the content
}


add_shortcode('weekly_roundup', 'weekly_roundup_shortcode');
function sample_post_pagination_shortcode() {
    ob_start(); // Start output buffering

    // Get current page number for pagination
    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

    // Query for custom posts (sample_post), 10 posts per page
    $args = array(
        'post_type' => 'post', // Change this to 'post' if you want normal posts
        'posts_per_page' => 10,
        'paged' => $paged
    );
    $sample_posts = new WP_Query($args);

    if ($sample_posts->have_posts()) :
        echo '<div class="sample-posts-list">';
        while ($sample_posts->have_posts()) : $sample_posts->the_post(); ?>
          
        <?php endwhile;
        echo '</div>';

        // Pagination
        echo '<div class="pagination">';
        echo paginate_links(array(
            'total' => $sample_posts->max_num_pages,
            'current' => max(1, get_query_var('paged')),
            'format' => '?paged=%#%',
            'prev_text' => __('&laquo; Previous'),
            'next_text' => __('Next &raquo;'),
        ));
        echo '</div>';

    else :
        echo '<p>No posts found.</p>';
    endif;

    wp_reset_postdata(); // Restore global post data

    return ob_get_clean(); // End output buffering and return the content
}
add_shortcode('sample_post_pagination', 'sample_post_pagination_shortcode');
// sample post shortcode
// // Add this code to your theme's functions.php file or a custom plugin

function custom_post_shortcode() {
    ob_start(); // Start output buffering
    ?>

    <div class="container">
        <div class="cp-main">
            <div class="cp-right">

                <?php
                // Query for custom posts
                $args = array(
                    'post_type' => 'post', // Changed from 'sample_post' to 'post'
                    'posts_per_page' => 10 // Adjust the number of posts as needed
                );
                $custom_posts = new WP_Query($args);

                if ($custom_posts->have_posts()) :
                    while ($custom_posts->have_posts()) : $custom_posts->the_post(); ?>
                        <div class="cp-content-offers sp-offer">
                            <div class="cp-content sp-content">
                                <div class="cp-content-left sp-img">
                                    <?php if (has_post_thumbnail()) : ?>
                                       <a href="<?php the_permalink(); ?>">   
									<img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
										   	</a>
                                    <?php else : ?>
                                        <img src="<?php echo esc_url(bloginfo('template_directory')); ?>/assets/images/default-roundup.webp" alt="Default Image">
								
                                    <?php endif; ?>
                                    <p class="weekly-roundup sp-rounup">
                                        <?php
                                        // Fetch and display the first 'sample_category' term associated with the post
                                        $terms = get_the_terms(get_the_ID(), 'sample_category');
                                        if ($terms && !is_wp_error($terms)) {
                                            echo esc_html($terms[0]->name);
                                        } else {
                                            echo 'Uncategorized';
                                        }
                                        ?>
                                    </p>
                                </div>
								<a href="<?php echo $post_permalink; ?>" style="Color:#171E33;text-decoration: none;" class="btn-nobg">
                                <div class="roundup-right roundup-right-two sp-right-content">
                                    <p class="rounded-text text-two"><?php echo get_the_date(); ?></p>
                                    <h2 class="rounded-header roundheader-two"><?php the_title(); ?></h2>
                                    <p class="rounded-text-other text-other-two"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                    <p class="btn-main ">
                                        <a href="<?php the_permalink(); ?>"  style="text-decoration: none;"  class="btn-nobg">
                                            <span>See Deals</span>
                                            <img src="/wp-content/uploads/2024/10/ArrowRight-1.png" alt="Arrow Icon">
                                        </a>
                                    </p>
                                </div>
								</a>
                            </div>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata();
                else : ?>
                    <p>No posts found.</p>
                <?php endif; ?>

            </div>
        </div>
    </div>

    <?php
    return ob_get_clean(); // Return the buffered content
}

// Register the shortcode
add_shortcode('custom_post_shortcode', 'custom_post_shortcode');


