<?php
/**
 * Represents the view for the administration dashboard.
 *
 * This includes the header, options, and other information that should provide
 * The User Interface to the end user.
 *
 * @package   PluginName
 * @author    Your Name <email@example.com>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2013 Your Name or Company Name
 */
 
include_once("table.view.php");
if(!class_exists('WP_List_Table')){
	require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

//Prepare Table of elements
$wp_list_table = new CommentsTable();
$comments = $this->comments;
$wp_list_table->prepare_items($comments);
?>


<div class="wrap">

	<?php screen_icon('content-comments'); ?>
	<h2><?php echo esc_html( get_admin_page_title() ); ?></h2>

	<?php $wp_list_table->display(); ?>

</div>
