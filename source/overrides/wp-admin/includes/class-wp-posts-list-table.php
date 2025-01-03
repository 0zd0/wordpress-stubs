<?php

declare(strict_types=1);

/**
 * Fires for each custom column of a specific post type in the Posts list table.
 *
 * The dynamic portion of the hook name, `$post->post_type`, refers to the post type.
 *
 * Possible hook names include:
 *
 *  - `manage_post_posts_custom_column`
 *  - `manage_page_posts_custom_column`
 *
 * @since 3.1.0
 *
 * @param string $column_name The name of the column to display.
 * @param int    $post_id     The current post ID.
 */
do_action("manage_{$post_type}_posts_custom_column", $column_name, $post->ID);
