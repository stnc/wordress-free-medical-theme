<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.st
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage wow
 * @since wow 2.5
 *
 */

global $CHfw_rdx_options, $wp_query, $page_setting_class, $scFW_globals;
$scFW_globals['is_archive_page_ref'] = true;
$scFW_globals['page_type_'] = "archive_page";


get_template_part('page', 'masonry');