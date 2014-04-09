<?php
/*
Template name: Reviews
*/

/**
 * Root files are ment to be only to generate output - something like views if you like.
 * All advanced functionality sould be put into .template classes and only called from this file.
 */

$r = lumi_template('Reviews');
$r->enqueue_review_style();

?>
<?php get_header(); ?>

<article class="main_content">

	<h1 class="article_title"><?php the_title(); ?></h1>

	<?php the_content(); ?>

	<?= $r->generate_reviews(); ?>

</article>

<?php get_footer(); ?>