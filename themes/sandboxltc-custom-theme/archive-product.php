<?php
/*
Template Name: Food Kingdom Index-Page
*/

get_header(); 
?>

<h1>1. sandboxltc-custom-post-type plugin</h1>
<h1>2. archive-product.php theme</h1>
<h1>3. .../product url</h1>

<?php 
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