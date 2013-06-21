<?php

class CommentsTable extends WP_List_Table {

	/**
	 * Constructor, we override the parent to pass our own arguments
	 * We usually focus on three parameters: singular and plural labels, as well as whether the class supports AJAX.
	 */
	function __construct() {
		parent::__construct( array(
				'singular'=> 'wp_list_text_link', //Singular label
				'plural' => 'wp_list_test_links', //plural label, also this well be one of the table css class
				'ajax' => false //We won't support Ajax for this table
			) );
	}


	/**
	 * Add extra markup in the toolbars before or after the list
	 * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
	 */
	function extra_tablenav( $which ) {
		if ( $which == "top" ){
			//The code that goes before the table is here
			// echo"Hello, I'm before the table";
		}
		if ( $which == "bottom" ){
			//The code that goes after the table is there
			// echo"Hi, I'm after the table";
		}
	}

	/**
	 * Define the columns that are going to be used in the table
	 * @return array $columns, the array of columns to use with the table
	 */
	function get_columns() {
		return $columns= array(
			// ID, post_content, post_title, post_type
			'post'=>__('ID'),
			'comment'=>__('Comments'),
			'title'=>__('Title'),
			'type'=>__('Type'),
			'edit'=>__('Edit'),
		);
	}


	/**
	 * Decide which columns to activate the sorting functionality on
	 * @return array $sortable, the array of columns that can be sorted by the user
	 */
	public function get_sortable_columns() {
		return $sortable = array(
			'post'=>'post',
			'title'=>'title',
			'type'=>'type'
		);
	}



	/**
	 * Prepare the table with different parameters, pagination, columns and table elements
	 */
	function prepare_items($data) {

		/* -- Register the pagination -- */
		$perpage = 30;
		$this->set_pagination_args( array(
				"total_items" => sizeof($data),
				"total_pages" => sizeof($data) / $perpage,
				"per_page" => $perpage,
			) );
		//The pagination links are automatically built according to those parameters

		$columns = $this->get_columns();
		$hidden = array();
		$sortable = $this->get_sortable_columns();
		$this->_column_headers = array($columns, $hidden, $sortable);

		/* -- Fetch the items -- */
		$this->items = $data;
	}





	/**
	 * Display the rows of records in the table
	 * @return string, echo the markup of the rows
	 */
	function display_rows() {

		//Get the records registered in the prepare_items method
		$records = $this->items;

		//Get the columns registered in the get_columns and get_sortable_columns methods
		list( $columns, $hidden ) = $this->get_column_info();
		//Loop for each record
		if(!empty($records)){foreach($records as $rec){
				//print_r($rec);
				//Open the line
				echo '<tr id="record_'.$rec["post"].'">';
				foreach ( $columns as $column_name => $column_display_name ) {

					//Style attributes for each col
					$class = "class='$column_name column-$column_name'";
					$style = "";
					if ( in_array( $column_name, $hidden ) ) $style = ' style="display:none;"';
					$attributes = $class . $style;

					//edit link
					$editlink  = '/wp-admin/link.php?action=edit&link_id='.(int)$rec->link_id;

					//Display the cell

					switch ( $column_name ) {
					case "post":
						$attributes .= "class='fixed column-role'";
						echo '<td '.$attributes.'>'.stripslashes($rec["post"]).'</td>';
						break;
					case "type":
						echo '<td '.$attributes.'>'.stripslashes($rec["type"]).'</td>';
						break;
					case "title":
						echo '<td '.$attributes.'>'.stripslashes($rec["title"]).'</td>'; 
						break;
					case "comment":
						echo '<td '.$attributes.'><span class="code">'.stripslashes($rec["comment"]).'</pre></td>'; 
						break;
					}
				}
				echo '<td><a href="/wp-admin/post.php?post='.$rec["post"].'&action=edit">'.__('Edit').'</></td>'; 

				//Close the line
				echo'</tr>';
			}}
	}
}