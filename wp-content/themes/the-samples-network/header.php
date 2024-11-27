<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package The-Samples-Network
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link rel="stylesheet" href="<?php echo bloginfo('template_directory'); ?>/assests/css/layout.css">
	<link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@300..700&display=swap" rel="stylesheet">
 
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php
         // Include the header
         if (file_exists('header.php')) {
             echo file_get_contents('header.php');
         } else {
             echo '<!-- Header file not found -->';
         }
         ?>
		<header>
    <div class="container">
      <nav class="nav">
        <input type="checkbox" id="nav-check">
        <div class="nav-header">
          <?php if ( has_custom_logo() ) : ?>
            <?php the_custom_logo(); ?>
            <!-- <img src="<?php echo bloginfo('template_directory'); ?>/assests/images/logo-hero-net.svg" alt="Logo"> -->
            <?php else : ?>
              <div class="nav-title">
              <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
                            <?php bloginfo( 'name' ); ?>
                        </a>
                    </h1>
                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>
                <?php endif; ?>
          </div>
           
        </div>
       
        <div class="nav-btn">   
        <img src="<?php echo bloginfo('template_directory'); ?>/assests/icons/search.svg" alt="Search Icon" class="search-icon-small">
          <label for="nav-check">
            <span></span>
            <span></span>
            <span></span>
          </label>
         
        </div>
        <div class="nav-ul">
        <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'menu_id'        => 'primary-menu',
                ) );
                ?>
          <div class="search-container">
    <div class="hidden-search">
        <img src="<?php echo bloginfo('template_directory'); ?>/assests/icons/search.svg" alt="Search Icon" class="search-icon">
        <input type="text" class="search-input" placeholder="Search...">
    </div>
  </div>
        </div>
      </nav>
    </div>
</header>