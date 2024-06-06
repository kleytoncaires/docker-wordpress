<?php

// -----------
// REMOVE STRING WHITESPACE
// -----------
function clean($string)
{
	$string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

	return preg_replace('/[^a-zA-Z0-9]+/', '', $string); // Removes special chars.
}

// -----------
// ADD EXCERPT TO PAGES
// -----------
function add_excerpt_to_pages()
{
	add_post_type_support('page', 'excerpt');
}
add_action('init', 'add_excerpt_to_pages');

// -----------
// MODIFY EXCERPT LENGTH
// -----------
function custom_excerpt_length($length)
{
	return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length', 999);

// -----------
// CHANGE MORE EXCERPT
// -----------
// function custom_more_excerpt($more)
// {
//     return '...';
// }
// add_filter('excerpt_more', 'custom_more_excerpt');


// -----------
// SVG SUPPORT
// -----------
function allow_svg_upload($mimes)
{
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter('upload_mimes', 'allow_svg_upload');

function svg_thumbnail_support()
{
	if (function_exists('add_theme_support')) {
		add_theme_support('post-thumbnails');
		add_filter('wp_generate_attachment_metadata', 'svg_attachment_metadata', 10, 2);
	}
}

function svg_attachment_metadata($metadata, $attachment_id)
{
	$attachment = get_post($attachment_id);
	$mime_type  = get_post_mime_type($attachment);

	if ('image/svg+xml' === $mime_type) {
		$metadata['width']  = 0;
		$metadata['height'] = 0;
	}

	return $metadata;
}

add_action('after_setup_theme', 'svg_thumbnail_support');
