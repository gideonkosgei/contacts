<?php
//contacts class Definition
require_once(LIB_PATH.DS.'database.php');

class Contacts extends DatabaseObject {	
	protected static $table_name="contacts";
	protected static $db_fields = array('contact_id','first_name','second_name','email_address','phone_number');
	protected static $primary_key="contact_id";
		
	public $contact_id;
	public $first_name;
	public $second_name;
    public $email_address;
	public $phone_number;
	
   public static function find_by_contact_id($id=""){
   return static::find_by_primary_key($id);
	
	}
	
	
	 public static function find_by_email($email){
   	 $sql="SELECT * FROM `".static::$table_name."`WHERE email_address='{$email}'";
	 $result_array = self::find_by_sql($sql);
     return !empty($result_array) ? array_shift($result_array) : false;
	
	}
	
	 public static function find_by_telephone($phone){
   	 $sql="SELECT * FROM `".static::$table_name."`WHERE phone_number='{$phone}'";
	 $result_array = self::find_by_sql($sql);
     return !empty($result_array) ? array_shift($result_array) : false;
	
	}
	
	
  }  



?>