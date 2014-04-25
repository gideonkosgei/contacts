<?php require_once("../includes/initialize.php");?>
<?php include_layout_template('header');

 $group=Groups::find_by_group_id($_SESSION['group_id']);
 $conts=Contacts::find_all();

 // adds contacts to a group
if(isset($_POST['add'])){
if(empty($_POST['contact_id'])){
$message_type="error";
$message="You Must Select Alleast One Contact.Process Failed";
}

else{
$contact_id_array=$_POST['contact_id'];

foreach($contact_id_array as $id):
//create a new object
$members=new Group_members();
$members->group_id=$_SESSION['group_id'];
$members->contact_id=$id;
if($members->save()){
		$message_type="success";
		$message="Selected Contacts Have Been Succesfully Saved In the Group";
		}
		else{
		$message_type="error";
		$message="not success";
		}
endforeach;

		}
} 

?>
<script type="text/javascript">
//javascript code to go one step backwards
function go_back(){
history.back();
}
</script>	

<nav class="art-nav">
    <ul class="art-hmenu"><li><a href="home.php" class="">Home</a></li><li><a href="manage-groups.php" class="active">Manage Groups</a></li><li><a href="manage-contacts.php">Manage Contacts</a></li></ul> 
     <ul class="art-hmenu" style="float:right;"><li> <span style="text-align:justify;"><p><img src="images/back.png" alt="logout" onClick=go_back()></p>
	</span>	</li>	</ul> 
	</nav>
<div class="art-layout-wrapper">
                <div class="art-content-layout">
                    <div class="art-content-layout-row">
                        <div class="art-layout-cell art-sidebar1"><div class="art-vmenublock clearfix">
        <div class="art-vmenublockheader">
            <h3 class="t">MENU</h3>
        </div>
        <div class="art-vmenublockcontent">
<ul class="art-vmenu"><li><a href="home.php" class="">Home</a></li><li><a href="manage-groups.php" class="active">Manage Groups</a></li><li><a href="manage-contacts.php">Manage Contacts</a></li></ul>
                
        </div>
</div></div>
                       <div class="art-layout-cell art-content"><article class="art-post art-article">
					   
<?php if($message==""){}else if($message_type=="success"){ echo "<div class='success'>".$message."</div>";} else{ echo "<div class='error'>".$message."</div>";}?>
                               
							   <div class="art-postmetadataheader">
                                        <h2 class="art-postheader"><span class="art-postheadericon">Add Contacts To <?php echo $group->group_name;?></span></h2>
                                                            
                                    </div>
                                <div class="art-postcontent art-postcontent-0 clearfix"><br>
				
				
                				
			<div class="details">
				
				
				
				<table>
				
				<tr><th>#</th><th><u>Name</u></th><th><u>Email</u></th><th><u>Phone Number</u></th><th><u>select Contacts</u></th></tr>
				<form action="add_contacts_to_group.php" method="post">
				
				<?php $no=1; foreach($conts as $contacts): 
				//display All Group Members
				 $check_contacts=Group_members::find_by_contact_group_id($contacts->contact_id,$_SESSION['group_id']);
				 if($check_contacts){
				 }
				 else{
				 ?>
				 
				<tr><td><?php echo $no; ?></td><td><?php echo $contacts->first_name ." ".$contacts->second_name; ?></td><td><?php echo $contacts->email_address; ?></td><td><?php echo $contacts->phone_number; ?></td><td><input type='checkbox' name='contact_id[]' value="<?php echo $contacts->contact_id;?>" /> </td></tr>
				 <?php $no++;} endforeach;?>
				 <tr><td colspan="4"></td><td><input type="submit" name="add" value="add contacts"></td></tr>
				 </form>
				</table>
					
						<h6>NB: The Contacts Displayed Are The Ones That Belong To The default Group But Not In this Group. Contacts Of This group Are Not Visible Here.
						
						If the Table is Empty, It Means That there Is No More Contacts To Add And The Group Contains All Contacts</h6>		 
		
		        
			</div>
			
			
								</div>


</article></div>
                    </div>
                </div>
            </div>
			
			<?php include_layout_template('footer'); ?>