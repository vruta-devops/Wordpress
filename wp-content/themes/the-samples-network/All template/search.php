<?php
/**
 * Template Name:search-result
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
                  <h4 class="cp-header cp-headder-hidden">Search Results</h4>
                  <div class="cp-left">
                     <h4 class="cp-header">Search Results</h4>
                     <p class="cp-para">Your search results are ready! Browse through the options below to find what fits your needs.</p>

                     <!-- Pagination Placeholder -->
                     <div class="pagination">
                        <?php 
                           // WordPress pagination
                           the_posts_pagination(array(
                               'mid_size'  => 2,
                               'prev_text' => __('« Previous', 'textdomain'),
                               'next_text' => __('Next »', 'textdomain'),
                           )); 
                        ?>
                     </div>
                  </div>
                  
                  <div class="cp-right">
                     <?php if ( have_posts() ) : ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                           <div class="cp-content-offers sp-offer">
                              <div class="cp-content sp-content">
                                 <div class="cp-content-left sp-img">
                                    <?php 
                                       if ( has_post_thumbnail() ) {
                                          the_post_thumbnail('medium'); 
                                       } else { 
                                          echo '<img src="' . get_template_directory_uri() . '/assets/images/default-image.webp" alt="Default Image">';
                                       } 
                                    ?>
                                    <p class="weekly-roundup sp-rounup">Search Result</p>
                                 </div>
                                 <div class="roundup-right roundup-right-two sp-right-content">
                                    <p class="rounded-text text-two"><?php the_time('F j, Y'); ?></p>
                                    <h2 class="rounded-header roundheader-two">
                                       <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h2>
                                    <p class="rounded-text-other text-other-two"><?php the_excerpt(); ?></p>
                                    <p class="btn-main">
                                       <a href="<?php the_permalink(); ?>" class="btn-nobg">
                                          <span>Read More</span>
                                          <img src="<?php echo get_template_directory_uri(); ?>/assets/icons/arrowright-green.svg" alt="Arrow Icon">
                                       </a>
                                    </p>
                                 </div>
                              </div>
                           </div>
                        <?php endwhile; ?>
                     <?php else : ?>
                        <p>No results found. Please try a different search.</p>
                     <?php endif; ?>
                     
                     <!-- Pagination (Repeating Pagination for Mobile) -->
                     <div class="pagination">
                        <?php 
                           // WordPress pagination
                           the_posts_pagination(array(
                               'mid_size'  => 2,
                               'prev_text' => __('« Previous', 'textdomain'),
                               'next_text' => __('Next »', 'textdomain'),
                           )); 
                        ?>
                     </div>
                  </div>
               </div>
            </div>
         </section>
      </main>

      <?php
get_footer();
