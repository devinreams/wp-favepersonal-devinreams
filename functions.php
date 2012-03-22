<?php
// set format for status posts to exclude title
// if status post is short enough, do not include URL either
function akv3_social_broadcast_format($format, $post, $service) {
	if (get_post_format($post) == 'status') {
		$format = (strlen($post->post_content) <= $service->max_broadcast_length() ? '{content}' : 
'{content} {url}');
	}
	return $format;
}
add_filter('social_broadcast_format', 'akv3_social_broadcast_format', 10, 3);

// remove URL in comments if comment is short enough to be included
function akv3_social_comment_broadcast_format($format, $comment, $service) {
	return (strlen($comment->comment_content) <= $service->max_broadcast_length() ? '{content}' : '{content} 
{url}');
}
add_filter('social_comment_broadcast_format', 'akv3_social_comment_broadcast_format', 10, 3);

// move comment form after the comments themselves
function akv3_social_comment_block_order($order) {
	return array('comments', 'form');
}
add_filter('social_comment_block_order', 'akv3_social_comment_block_order');

// don't use ODP content when listing my site
function fpdr_noodp() {
	echo "<meta name=\"robots\" content=\"noodp\" />\n";
}
add_action('wp_head','fpdr_noodp');

// don't output custom colors, they're in styles.css
function fpdr_nocolors() {
	remove_action('wp_head', 'cfcp_color_css', 8);
}
add_action('wp_enqueue_scripts', 'fpdr_nocolors');

// enqueue mint JS for stats
function minty_javascript_enqueue() {
	if (!is_admin()) {
		$minty_js_path = get_bloginfo('home') . '/mint/?js';
		wp_enqueue_script('minty_js_include', $minty_js_path);
	}
}
add_action('init', 'minty_javascript_enqueue', 0);

// frame-buster for @alexkingorg's "vanity" domain purchases
function fpdr_noframes() {
	echo "<script type='text/javascript'>if (top != self) { top.location.replace(self.location.href); }</script>\n";
}
add_action('wp_head','fpdr_noframes');
