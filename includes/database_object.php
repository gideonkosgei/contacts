<?php
//contain definition operation on database objects.
require_once(LIB_PATH.DS.'database.php');
class DatabaseObject {
    
	protected static $table_name;
    protected static $db_fields;
	protected static $primary_key;		
		
// Common Database Methods to be inherited by classes that have use static data from database tables 
	public static function find_all() {
	$sql="SELECT * FROM `".static::$table_name."`";
 
		return static::find_by_sql($sql);
  } 

  
  public static function find_by_primary_key($primary_key_value="") {
    $sql="SELECT * FROM `".static::$table_name."` WHERE ".static::$primary_key." = '{$primary_key_value}'  LIMIT 1";
	
    $result_array = static::find_by_sql($sql);
		return !empty($result_array) ? array_shift($result_array) : false;
  }
  
  public static function find_by_id($id=""){
   return static::find_by_primary_key($id);
  }
  
  public static function find_by_sql($sql="") {
    global $database;
    $result_set = $database->query($sql);
    $object_array = array();
    while ($row = $database->fetch_array($result_set)) {
      $object_array[] = static::instantiate($row);
    }

    return $object_array;
  }
//function to get the number of rows returned by a query
	public static function count_all() {
	  global $database;
	  $sql = "SELECT COUNT(*) FROM ".static::$table_name;
    $result_set = $database->query($sql);
	  $rows = $database->fetch_array($result_set);
    return array_shift($rows);
	}

	private static function instantiate($record) {
		// Could check that $record exists and is an array
	 $class_name=get_called_class();
     $object = new $class_name;
		// More dynamic, short-form approach:
		foreach($record as $attribute=>$value){
		  if($object->has_attribute($attribute)) {
		    $object->$attribute = $value;
		  }
		}
		return $object;
	}
	
	private function has_attribute($attribute) {
	  // We don't care about the value, we just want to know if the key exists
	  // Will return true or false
	  return array_key_exists($attribute, $this->attributes());
	}

	protected function attributes() { 
		// return an array of attribute names and their values
	  $attributes = array();
	  foreach(static::$db_fields as $field) {
	    if(property_exists($this, $field)) {
	      $attributes[$field] = $this->$field;
	    }
	  }
	  return $attributes;
	}
	
	protected function sanitized_attributes() {
	  global $database;
	  $clean_attributes = array();
	  foreach($this->attributes() as $key => $value){
	    $clean_attributes[$key] = $database->escape_value($value);
	  }
	  return $clean_attributes;
	}
	
	public function save() {
	  $record_in_db=static::find_by_id($this->{static::$primary_key});
	  return (empty($record_in_db))? $this->create():$this->update() ;
	}
	
	public function create() {
		global $database;
		$attributes = $this->sanitized_attributes();
	    $sql = "INSERT INTO `".static::$table_name."` (";
		$sql .= join(", ", array_keys($attributes));
	    $sql .= ") VALUES ('";
		$sql .= join("', '", array_values($attributes));
		$sql .= "')";
	  if($database->query($sql)) {
	   if($database->get_last_autoIncrement_inserted_id()){
	    $this->{static::$primary_key} = $database->get_last_autoIncrement_inserted_id();
	   }
	    return true;
	  } else {
	    return false;
	  }
	}

	public function update() {
	  global $database;

		$attributes = $this->sanitized_attributes();
		$attribute_pairs = array();
		foreach($attributes as $key => $value) {
		  $attribute_pairs[] = "{$key}='{$value}'";
		}
		$sql = "UPDATE `".static::$table_name."` SET ";
		$sql .= join(", ", $attribute_pairs);
		$sql .=  " WHERE ".static::$primary_key." = '". $database->escape_value($this->{static::$primary_key})."'";
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;
	}

	public function delete() {
	  global $database;		
	  $sql = "DELETE FROM `".static::$table_name."`";
	  $sql .= " WHERE ".static::$primary_key." = '". $database->escape_value($this->{static::$primary_key})."'";
	  $sql .= " LIMIT 1";
	  
	  $database->query($sql);
	  return ($database->affected_rows() == 1) ? true : false;

	}	
}