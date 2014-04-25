<?php require_once("../includes/initialize.php");

$_SESSION['group_id']=$_POST['group_id'];

if(isset($_POST['add'])){
redirect_to("add_contacts_to_group.php");
}

else{
redirect_to("remove_contacts_from_group.php");
}

?>
