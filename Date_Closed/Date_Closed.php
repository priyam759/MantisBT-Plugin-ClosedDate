<?php




require_once( 'core/columns_api.php' );

class Date_ClosedColumn extends MantisColumn
{
	public $title = "Closed";
	//public $column = "column";
	public $sortable = false;
	public function display( $p_bug, $p_columns_target )
	{
		$date = db_query("SELECT CASE
			WHEN bughistory.[field_name] = 'status' AND bughistory.[new_value] = '90' AND bugtable.[status] = '90'
			THEN DATEADD(SECOND, bughistory.[date_modified], '19700101') ELSE null
			END AS 'date_closed' FROM mantis_bug_history_table bughistory LEFT JOIN mantis_bug_table bugtable ON bughistory.bug_id = bugtable.id
			WHERE bug_id={$p_bug->id} ORDER BY date_closed DESC");
			
		$row = db_fetch_array($date);
	    $string = $row['date_closed'];
		if (!empty($string))
		{
			$date = strtotime($string);
			echo date('Y-m-d', $date);
		}
		
	}
}

class Date_ClosedPlugin extends MantisPlugin 
{
	function register() 
	{
		$this->name = 'Closed Date';
		$this->description = 'Creates a column with the date a ticket is marked as closed.';
		$this->version = '2.25.1';
		$this->author = 'Priyam Patel';
		$this->contact = 'priyam.patel@us.glory-global.com';
		$this->requires = array(
			'MantisCore' => '2.0.0',
		);
		
	}
	
	public $basename = date_closed;
	
	
	function init() 
	{
		plugin_event_hook( 'EVENT_FILTER_COLUMNS', 'addColumn' );
	}
	
	function addColumn()
	{
		return array( 'Date_ClosedColumn' );
	}
}
?>