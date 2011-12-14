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

function akv3_social_comment_block_order($order) {
	return array('comments', 'form');
}
add_filter('social_comment_block_order', 'akv3_social_comment_block_order');
