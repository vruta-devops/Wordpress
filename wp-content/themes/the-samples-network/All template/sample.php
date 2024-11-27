<?php
/**
 * Template Name: sample
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>

<main>
    <section class="cp-sec">
        <div class="container">
            <div class="cp-main">
                <h4 class="cp-header cp-headder-hidden"><?= (get_field('tittle')); ?></h4>
                <div class="cp-left">
                    <h4 class="cp-header"><?= (get_field('tittle')); ?></h4>
                    <p class="cp-para"><?= (get_field('text')); ?></p>
                    <?php
                    // Get current page number for pagination
                    $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                    // Query for custom posts (sample_post), 10 posts per page
                    $args = array(
                        'post_type' => 'sample_post',
                        'posts_per_page' => 10,
                        'paged' => $paged
                    );
                    $sample_posts = new WP_Query($args);?>
                     <!-- Pagination -->
                     <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $sample_posts->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'prev_text' => __('&laquo; Previous'),
                            'next_text' => __('Next &raquo;'),
                        ));
                        ?>
                    </div>
                    <a href="javascriptvoid(0)"><img src="<?= (get_field('image')); ?>"></a>
                </div>
                <div class="cp-right">
                    <?php

                    if ($sample_posts->have_posts()) :
                        while ($sample_posts->have_posts()) : $sample_posts->the_post(); ?>
                       
                            <div class="cp-content-offers sp-offer">
                                <div class="cp-content sp-content">
                                    <div class="cp-content-left sp-img">
                                        <?php if (has_post_thumbnail()) : ?>
                                            <img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>">
                                        <?php else : ?>
                                            <img src="<?php echo bloginfo('template_directory'); ?>/assets/images/default-image.webp" alt="Default Image">
                                        <?php endif; ?>
                                        <p class="weekly-roundup sp-rounup">
                                            <?php
                                            // Display the first taxonomy term from 'sample_category'
                                            $terms = get_the_terms(get_the_ID(), 'sample_category');
                                            if ($terms && !is_wp_error($terms)) {
                                                echo esc_html($terms[0]->name);
                                            } else {
                                                echo 'Uncategorized';
                                            }
                                            ?>
                                        </p>
                                    </div>
                                    <div class="roundup-right roundup-right-two sp-right-content">
                                        <p class="rounded-text text-two"><?php echo get_the_date(); ?></p>
                                        <h2 class="rounded-header roundheader-two"><?php the_title(); ?></h2>
                                        <p class="rounded-text-other text-other-two"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                                        <p class="btn-main">
                                            <a href="<?php the_permalink(); ?>" class="btn-nobg">
                                                <span>See Deals</span>
                                                <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/arrowright-green.svg">
                                            </a>
                                        </p>
                                    </div>
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
    </section>
</main>

<?php
get_footer();
?>
