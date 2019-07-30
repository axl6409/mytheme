<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage MyTheme
 * @since My Theme 1.0
 */

?>

<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<title>Theme WordPress</title>
		
		<?php wp_head(); ?>
	</head>

	<body id="body">

		<header id="header" class="site-header">

			<?php get_template_part( 'template-parts/header/header', 'image' ); ?>
		</header>