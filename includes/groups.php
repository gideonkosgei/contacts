<?php
//group class definition
require_once(LIB_PATH.DS.'database.php');

class Groups extends DatabaseObject {
	
	protected static $table_name="groups";
	protected static $db_fields = array('group_id','group_name','group_description');
	protected static $primary_key="group_id";
		
	public $group_id;
	public $group_name;
	public $group_description;
	
   public static function find_by_group_id($id=""){
   return static::find_by_primary_key($id);
	
	}
	
   public static function find_by_group_name($name=""){
   	 $sql="SELECT * FROM `".static::$table_name."`WHERE group_name='{$name}'";
	 return static::find_by_sql($sql);
	
	}
	
}    

?>