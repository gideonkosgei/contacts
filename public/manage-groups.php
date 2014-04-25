<?php require_once("../includes/initialize.php");?>
<?php include_layout_template('header');

 // creates a new Group Object and Adds It.

if(isset($_POST['add_group'])){

 $check_duplicate_group=Groups::find_by_group_name($_POST['group_name']);
 
        if($check_duplicate_group){
		$message_type="error";
	    $message="A Group With Same Name Already Exists....Process Failed";
	    }else{
		
		$group=new Groups();
		$group->group_name=trim($_POST['group_name']);
		$group->group_description=trim($_POST['group_description']);
		if($group->save()){
		$message_type="success";
			$message="Group Added Successfully";
		}
		else{
		$message_type="error";
		$message="not success";
		}
	}
}
	
	//code to edit group details
 if(isset($_POST['save_group'])){
 $check_duplicate_group=Groups::find_by_group_name($_POST['group_name']);
 $group_save=Groups::find_by_group_id($_POST['group_id']);
 
        if($check_duplicate_group && $group_save->group_name!=$_POST['group_name']){
		$message_type="error";
	    $message="A Group With Same Name Already Exists....Process Failed";
	    }else{ 
		
       	$group_save->group_name=trim($_POST['group_name']);
		$group_save->group_description=trim($_POST['group_description']);		
	
		if($group_save->save()){
		$message_type="success";
		$message="Changes Successfully Saved";
		}
		else{
		$message_type="error";
		$message="Nothing To Be Updated. Information Remained The same";
		}		
	}
}
	//code to delete group
	    if((isset($_GET['action']))&&($_GET['action']=='delete')){
		$del_group=Groups::find_by_group_id($_GET['group_id']);
		$has_contacts=Group_members::find_by_group_id($_GET['group_id']);
		
	
		if($has_contacts){
		$message_type="error";
		$message="You Cannot Delete A Group With Contacts.To Delete A Group, First Remove It's Members";
		}
		else{
		
		if($del_group->delete()){
		$message_type="success";
		$message="Delete succesful";
		}
		else{
		$message_type="error";
		$message="Delete failed";
		
		}
	
	}
	
}


$grp=Groups::find_all();//creates an object array of group object.
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
                                        <h2 class="art-postheader"><span class="art-postheadericon">Group Management</span></h2>
                                                            
                                    </div>
                                <div class="art-postcontent art-postcontent-0 clearfix"><br>
				
				<?php 
				 if((isset($_GET['action']))&&($_GET['action']=='edit')){
				$grp_edit=Groups::find_by_group_id($_GET['group_id']);
								?>		
                 <!--form for contact information editing-->
				<div class="register">								
				<fieldset>		
				<legend><b>Edit</b></legend>
				<form method="post" action="manage-groups.php">
				<div class="fields"><b>Group Name</b></div>
				<div class="fields"><input type="text" name="group_name" value="<?php echo $grp_edit->group_name; ?>" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>Description</b></div>
				<div class="fields"><textarea cols="10" rows="3" name="group_description" wrap="off">
				<?php echo $grp_edit->group_description; ?>
				</textarea>
				</div>
				<input type="hidden" name="group_id" value="<?php echo $grp_edit->group_id; ?>"/>
				<div class="fields"><input type="submit" value="Save Changes" name="save_group"></div>				
				</form>								
				</fieldset>								
				</div>
				
				<?php 
				}
				else{
				?>		
                <!--form for contact Registration-->				
				<div class="register">								
				<fieldset>		
				<legend><b>Register</b></legend>
				<form method="post" action="manage-groups.php">
				<div class="fields"><b>Group Name</b></div>
				<div class="fields"><input type="text" name="group_name" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>Description</b></div>
				<div class="fields"><textarea cols="10" name="group_description"></textarea></div>
				<div class="fields"><input type="submit" value="Add Group" name="add_group"></div>				
				</form>								
				</fieldset>								
				</div>
				<?php }?>
                				
			<div class="details">
				<fieldset>
				<legend><b>Details</b></legend>
				<table>
				<tr><th>#</th><th><u>Group Name</u></th><th><u>Group Description</u></th><th><u>Group</u></th><th><u>Contacts</u></th></tr>
				
				<?php $no=1; foreach($grp as $grp): 
				if($grp->group_name=="Default"){
				}else{
				?>
				
				<tr><form action="redirect_add_contacts_to_group.php" method="post"><td><?php echo $no;?></td><td><?php echo $grp->group_name;?></td><td><?php echo $grp->group_description;?></td><td><a href="manage-groups.php?group_id=<?php echo $grp->group_id?>&action=edit"><input type="button" value="Edit"></a><a href="manage-groups.php?group_id=<?php echo $grp->group_id?>&action=delete"><input type="button" value="Del"></a></td><td><input type="hidden" name="group_id" value="<?php echo $grp->group_id; ?>"/><input type="submit" name="add"value="Add"><input type="submit" name="remove"value="Del"></form></td></tr>
				<?php $no++; } endforeach;?>
					
					</table>				 
			</fieldset>
			</div>
			
			
								</div>


</article></div>
                    </div>
                </div>
            </div>
			
			<?php include_layout_template('footer'); ?>