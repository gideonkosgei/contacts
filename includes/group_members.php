<?php

//class definition of Contacts That Belong To a Group
require_once(LIB_PATH.DS.'database.php');

class Group_members extends DatabaseObject {
	
	protected static $table_name="group_members";
	protected static $db_fields = array('member_id','group_id','contact_id');
	protected static $primary_key="member_id";
		
	public $member_id;
	public $group_id;
	public $contact_id;


   public static function find_by_group_id($id){
    $sql="SELECT * FROM `".static::$table_name."`WHERE group_id='{$id}'";
   return static::find_by_sql($sql);
   }
   
   public static function find_by_contact_id($id){
    $sql="SELECT * FROM `".static::$table_name."`WHERE contact_id='{$id}'";
    $result_array = self::find_by_sql($sql);

   return !empty($result_array) ? array_shift($result_array) : false;
   }
	
	public static function count_all_members($group) {
	  global $database;
	  $sql = "SELECT COUNT(*) FROM ".static::$table_name." WHERE group_id='{$group}'";
    $result_set = $database->query($sql);
	  $rows = $database->fetch_array($result_set);
    return array_shift($rows);
	}
	
	 public static function find_by_contact_group_id($cid,$gid){
    $sql="SELECT * FROM `".static::$table_name."`WHERE contact_id='{$cid}' AND group_id='{$gid}'";

    $result_array = self::find_by_sql($sql);

   return !empty($result_array) ? array_shift($result_array) : false;
   }
	
	
}    

?>