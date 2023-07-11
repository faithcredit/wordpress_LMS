<?php
/*
Template Name: Food Kingdom Index-Page
*/

get_header(); 

if ( have_posts() ) {

    // Load posts loop.
    while ( have_posts() ) {
        
        the_post(); ?>

        <h2><?php the_title() ?></h2>
		<?php the_content();

    }
} else {

}

get_footer(); 

?>