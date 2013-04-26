<?php

// Shows full content for the first three "standard" format posts in the loop

if (__FILE__ == $_SERVER['SCRIPT_FILENAME']) { die(); }
if (CFCT_DEBUG) { cfct_banner(__FILE__); }

global $post;

if (have_posts()) {
	$i = 0;
	while (have_posts()) {
		the_post();
		if ($i < 3 && get_post_format($post) === false) {
			cfct_content();
			$i++;
		}
		else {
			cfct_excerpt();
		}
	}
}