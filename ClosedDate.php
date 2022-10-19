<?php

require_once('core/columns_api.php');

class ClosedDatePluginColumn extends MantisColumn
{
	public $title = "Closed Date";
	public $column = "col";
	public $sortable = false;
	public function display( $p_bug, $p_columns_target ){
	echo db_query(
	"SELECT CASE
	WHEN bughistory.[field_name] = 'status' AND bughistory.[new_value] = '90' THEN CONVERT(DATETIME2(0),DATEADD(SECOND, bughistory.[date_modified], '19700101'))
	ELSE NULL
	END AS 'date_closed' FROM mantis_bug_history_table bughistory WHERE bug_id={$p_bug->id}")->fields['date_closed'];
}

class ClosedDatePlugin extends MantisPlugin {

	function register() {
		$this->name = 'Closed Date';
		$this->description = 'Closed Date plugin will auto-fill the Closed Date custom field with the current timestamp when a ticket is marked as closed';
		//$this->page = '';

		$this->version = '2.25.1';
		$this->requires = array(
			'MantisCore' => '2.0.0'
		);

		$this->author = 'Priyam Patel';
		$this->contact = 'priyam.patel@us.glory-global.com';
		//$this->url = '';
	}
	
	//need to hook event that is called once ticket is closed, and populate custom field value for 'date_closed' once there 
	
	function init() {
		plugin_event_hook( 'EVENT_FILTER_COLUMNS', 'addColumn' );
	}
	
	function addColumn()
	{
		return array( 'ClosedDatePluginColumn' );
	}
}
?>
