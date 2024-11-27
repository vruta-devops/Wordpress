<?php

/**
 * Template Name: Coupons
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
// phpinfo();
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

                    // Query for custom posts (coupon), 10 posts per page
                    $args = array(
                        'post_type' => 'coupon',
                        'posts_per_page' => 10,
                        'paged' => $paged
                    );
                    $coupon = new WP_Query($args); ?>

                    <!-- Pagination -->
                    <div class="pagination">
                        <?php
                        echo paginate_links(array(
                            'total' => $coupon->max_num_pages,
                            'current' => max(1, get_query_var('paged')),
                            'format' => '?paged=%#%',
                            'prev_text' => __('&laquo; Previous'),
                            'next_text' => __('Next &raquo;'),
                        ));
                        ?>
                    </div>

                    <a href="javascriptvoid(0)"> <img src="<?= (get_field('image')); ?>"></a>
                </div>
                <div class="cp-right">
                    <!-- <div class="cp-content-offers">
                        <?php if ($coupon->have_posts()) :
                            while ($coupon->have_posts()) : $coupon->the_post(); ?>

                                <?php
                                // Get the coupon description field
                                $coupon_description = get_field('coupon_description');

                                // Split the description into an array of words
                                $words = explode(' ', $coupon_description);

                                // Limit to the first 7 words
                                $short_description = implode(' ', array_slice($words, 0, 7));
                                ?>

                                <div class="cp-content">
                                    <div class="cp-content-left">
                                        <p class="cp-content-header"><?php the_title(); ?></p>
                                        <p class="cp-content-link">
                                            <a href="<?php the_permalink(); ?>">
                                                <b><?= $short_description; ?>..</b>
                                            </a>
                                        </p>
                                        <p class="cp-content-para"><?= get_field('coupon_sub_title'); ?></p>
                                    </div>
                                    <div>
                                        <p class="btn-main cp-btn-main">
                                            <a href="<?php the_permalink(); ?>" class="btn">
                                                <span>Go to Offer</span>
                                                <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/ArrowRight.svg">
                                            </a>
                                        </p>
                                    </div>
                                </div>

                            <?php endwhile;

                            wp_reset_postdata();
                        else : ?>
                            <p><?php _e('No coupons found'); ?></p>
                        <?php endif; ?>
                    </div> -->
                    <div class="cp-content-offers">
                        <?php
                        
                        $xmlUrl = "https://www.rakuten.com/feed/offer-feed.xml";

                        $xmlContent = file_get_contents($xmlUrl);
                        $xmlObject = simplexml_load_string(trim($xmlContent));

                        foreach ($xmlObject->channel->item as $item) {
                            $title = (string) $item->title;
                            $link = (string) $item->link;
                            $description = (string) $item->description;

                            echo '<div class="coupon-item">';
                            echo '<h3><a href="' . esc_url($link) . '" target="_blank">' . esc_html($title) . '</a></h3>';
                            echo '<div class="coupon-description">' . wp_kses_post($description) . '</div>';
                            echo '</div>';
                        }

                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>
</main>

<?php get_footer(); ?>