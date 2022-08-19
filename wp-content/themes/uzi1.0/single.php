<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package BPSD
 */

$phone = get_field('vendor_phone');
echo 'hello'.$phone;


get_header();
?>

	<p>post</p>

<?php
get_sidebar();
get_footer();
