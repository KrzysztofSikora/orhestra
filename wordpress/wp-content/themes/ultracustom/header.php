<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package ultrabootstrap
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="icon" href="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/images/favicon3.ico">
	<link href="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/css/scrolling-nav.css" rel="stylesheet">
	<link rel="stylesheet" href="/wordpress/wp-content/themes/bootstrap-my/fontasset/css/fontello.css"/>
	<link href="https://fonts.googleapis.com/css?family=Josefin+Sans|Poppins" rel="stylesheet">
	<link href="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.css" rel="stylesheet">
	<script src="https://cdn.rawgit.com/michalsnik/aos/2.1.1/dist/aos.js"></script>
	<link rel="stylesheet" type="text/css" href="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/parallax-vanilla/dist/css/parallax-vanilla.css">
	<script src="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/js/progressbar.js"></script>
<!--	<script src="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/js/bar.js"></script>-->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

	<?php wp_head(); ?>


</head>


<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top" <?php body_class(); ?>>
<?php $header_text_color = get_header_textcolor();?>
<script>
	$("body > div:nth-child(1)").remove();
</script>
<script>
	$("body > div:nth-child(1)").remove();
</script>

<script src="http://krzysztofsikora.pl/wordpress/wp-content/themes/ultrabootstrap/js/aos-run.js"></script>



<header>
<section class="logo-menu">
	<nav class="navbar navbar-default navbar-custom navbar-fixed-top">
		<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
				    <div class="navbar-header">
				      	<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					        <span class="sr-only"><?php _e('Toggle navigation' , 'ultrabootstrap' ); ?></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
					        <span class="icon-bar"></span>
				      	</button>
<!--				      	<div class="logo-tag margin-left-15 hidden-sm">-->
<!---->
<!--				      			--><?php //if ( has_custom_logo()): the_custom_logo(); else: ?>
<!---->
<!--				      			<a href="--><?php //echo esc_url( home_url( '/' ) ); ?><!--"><h1 class="site-title" style="color:--><?php //echo "#". $header_text_color;?><!--">--><?php //echo bloginfo( 'name' ); ?><!--</h1>-->
<!--				      			<h2 class="site-description" style="color:--><?php //echo "#". $header_text_color;?><!--">-->
<!--									--><?php //bloginfo('description'); ?><!--</h2>-->
<!---->
<!--									--><?php //endif; ?><!--</a>-->
<!---->
<!--      					</div>-->

				    </div>


					<!-- Collect the nav links, forms, and other content for toggling -->
					<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">

						<?php

						 if ($_SERVER['REQUEST_URI'] == "/wordpress/")
							 echo <<<EOD
						<ul class="nav navbar-nav">
						<!-- Hidden li included to remove active class from about link when scrolled up past about section -->
							<li class="hidden">
								<a class="page-scroll btn btn-pils" href="#page-top"></a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#about">O mnie</a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#news">News</a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#skills">Umiejętności</a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#achivments">Osiągnięcia</a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#other">Inne</a>
							</li>
							<li>
								<a class="page-scroll btn btn-pils" href="#contact">Kontakt</a>
							</li>
						</ul>
EOD;
					else {
						echo <<<EOD
						<ul class="nav navbar-nav">
						<li>
								<a class="page-scroll btn btn-pils" href="http://krzysztofsikora.pl">Home</a>
							</li>
						</ul>
EOD;
					}	?>
						<form  class="navbar-form navbar-right" role="search">
							<ul class="nav pull-right">
								<div class="main-search">
									<button class="btn btn-search" type="button" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
									  <i class="fa fa-search"></i>
									</button>
									<div class="search-box collapse" id="collapseExample">
											<div class="well search-well">
										    <form method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                          						<input type="text" class="form-control" placeholder="<?php echo __('Search a Keyword','ultrabootstrap');?>" value="<?php echo get_search_query(); ?>" name="s">
                          					</form>
											</div>
									</div>
								</div>
							</ul>
						</form>

						<?php
				            wp_nav_menu( array(
				                'menu'              => 'primary',
				                'theme_location'    => 'primary',
				                'depth'             => 8,
				                'container'         => 'div',
				                'menu_class'        => 'nav navbar-nav navbar-right text-center',
				                'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
				                'walker'            => new ultrabootsrap_wp_bootstrap_navwalker())
				            );
				        ?>
				    </div> <!-- /.end of collaspe navbar-collaspe -->
	</div> <!-- /.end of container -->
	</nav>
</section> <!-- /.end of section -->
</header>