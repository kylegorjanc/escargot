<?php
/*
Plugin Name: Link First Image to Post
Plugin URI: https://wordpress.org/plugins/link-first-image-to-post/
Version: 1.0.1
Author: pipdig
Author URI: https://www.pipdig.co/
Description: Automatically link the first image of each post on the home page to that post.
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

*/

if (!defined('ABSPATH')) {
	exit;
}

if (!function_exists('pipdig_link_image_to_post')) {
	function pipdig_link_image_to_post($content){
		if (!is_singular()) {
			$old = '/(<img[^>]*\/>)/';
			$new = '<a href="'.esc_url(get_permalink()).'" title="'.esc_attr(get_the_title()).'">$1</a>';
			$content = preg_replace($old, $new, $content, 1);
		}
		return $content;
	}
	add_filter('the_content', 'pipdig_link_image_to_post');
}