<?php

/**
 * Template Name:Home
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since Twenty Twenty 1.0
 */

get_header();
?>
<main>
  <!-- section-one -->
  <section class="section-hero">
    <div class="container">
      <h1 class="hero-text-two">
        Your Gateway to Free Samples & Discounts
      </h1>

      <div class="section-hero-main">

        <div class="section-hero-left">
          <h1 class="hero-text">
            <?= (get_field('tittle_text')); ?>
          </h1>
          <p class="hero-para"><?= (get_field('sub_text')); ?></p>
          <p class="btn-main">
            <a href="<?= (get_field('button_link')); ?>" class="btn">
              <span><?= (get_field('button_text')); ?></span>
              <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/ArrowRight.svg">
            </a>
          </p>
        </div>

        <div class="section-hero-right">
          <img src="<?= (get_field('home_image')); ?>">
        </div>
      </div>
    </div>
  </section>

  <section class="Weekly-Roundup">
    <div class="container">
      <p class="artical-latest">Latest Articles</p>
      <!-- <div class="section-roundup"> -->
      <?php
      // Query for the latest custom post
      $args_latest = array(
        'post_type' => 'sample_post',
        'posts_per_page' => 1,
        'taxonomy' => 'csr_category',
      );
      $latest_post = new WP_Query($args_latest);

      if ($latest_post->have_posts()) :
        while ($latest_post->have_posts()) : $latest_post->the_post();
          $terms = get_the_terms(get_the_ID(), 'sample_category');
          $category = '';
          if ($terms && !is_wp_error($terms)) {
            $category = $terms[0]->name;
          } else {
            $category = 'Uncategorized';
          }
      ?>
          <div class="section-roundup">
            <div class="roundup-left">
              <img src="<?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/default-roundup.webp'; ?>" alt="<?php the_title(); ?>">
              <p class="weekly-roundup"><?php echo $category; ?></p>
            </div>
            <div class="roundup-right">
              <h2 class="rounded-header"><?php the_title(); ?></h2>
              <p class="rounded-text"><?php echo get_the_date(); ?></p>
              <p class="rounded-text-other"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
              <p class="btn-main ">
                <a href="<?php the_permalink(); ?>" class=" btn-nobg">
                  <span>See Deals</span>
                  <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/arrowright-green.svg" alt="Arrow Icon">
                </a>
              </p>
            </div>
          </div>

        <?php endwhile;
        wp_reset_postdata();
      else : ?>
        <p>No latest post found.</p>
      <?php endif; ?>
      <!-- </div> -->

      <div class="roundup-main">
        <?php
        // Query for the remaining custom posts, excluding the latest one
        $args_others = array(
          'post_type' => 'sample_post',
          'posts_per_page' => 3,  // Adjust as necessary
          'offset' => 1 // Skip the first (latest) post
        );
        $other_posts = new WP_Query($args_others);

        if ($other_posts->have_posts()) :
          while ($other_posts->have_posts()) : $other_posts->the_post(); 
          $category = '';
          if ($terms && !is_wp_error($terms)) {
            $category = $terms[0]->name;
          } else {
            $category = 'Uncategorized';
          }
          ?>
            <div class="section-roundup round-col  tc-two">
              <div class="roundup-left rounded-left-two">
                <img src="<?php echo (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/images/nulla-roundup.webp'; ?>" alt="<?php the_title(); ?>">
                <p class="weekly-roundup"><?php echo $category; ?></p>
              </div>
              <div class="roundup-right roundup-right-two">
                <p class="rounded-text "><?php echo get_the_date(); ?></p>
                <h2 class="rounded-header roundheader-two"><?php the_title(); ?></h2>
                <p class="rounded-text-other text-other-two"><?php echo wp_trim_words(get_the_excerpt(), 20); ?></p>
                <p class="btn-main ">
                  <a href="<?php the_permalink(); ?>" class=" btn-nobg">
                    <span>See Deals</span>
                    <img src="<?php echo bloginfo('template_directory'); ?>/assets/icons/arrowright-green.svg" alt="Arrow Icon">
                  </a>
                </p>
              </div>
            </div>

          <?php endwhile;
          wp_reset_postdata();
        else : ?>
          <p>No posts found.</p>
        <?php endif; ?>
      </div>
    </div>
  </section>

  <!-- section three -->
 
</main>
<?php
get_footer();
