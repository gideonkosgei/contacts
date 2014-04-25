<?php require_once("../includes/initialize.php");?>
<?php include_layout_template('header');

$conts=Contacts::find_all();
// creates a new Contact Objects and adds It.
if(isset($_POST['add_contacts'])){
$check_duplicate_email=Contacts::find_by_email($_POST['email_address']);
$check_duplicate_telephone=Contacts::find_by_telephone($_POST['phone_number']);
        if($check_duplicate_telephone){
		$message_type="error";
	    $message="The Phone Number Already Exists In The System....Process Failed";
	    }else{		
        if($check_duplicate_email){
		$message_type="error";
		$message="The Email Already Exists In The System....Process Failed";
	    
	    }else{
        $contacts=new Contacts();
		$contacts->first_name=trim($_POST['first_name']);
		$contacts->second_name=trim($_POST['second_name']);
		$contacts->email_address=trim($_POST['email_address']);
		$contacts->phone_number=trim($_POST['phone_number']);
		

		if($contacts->save()){
		$message_type="success";
		$message="Contact Added Successfully";
		}
		else{
		$message_type="error";
		$message="not success";
		 }
	 }
  }
}
//code to edit group details	
if(isset($_POST['save_contact'])){
$check_duplicate_email=Contacts::find_by_email($_POST['email_address']);
$check_duplicate_telephone=Contacts::find_by_telephone($_POST['phone_number']);
$contact_save=Contacts::find_by_contact_id($_POST['contact_id']);
        
		if($check_duplicate_telephone && $contact_save->phone_number!=$_POST['phone_number']){
		$message_type="error";
	    $message="The New Phone Number Is Already Is Use By Another Contact....Process Failed";
	    }else{		
        if($check_duplicate_email && $contact_save->email_address != $_POST['email_address']){
		$message_type="error";
		$message="The New Email Address Is Already Is Use By Another Contact....Process Failed";
	    
	    }else{
		
       	$contact_save->first_name=trim($_POST['first_name']);
		$contact_save->second_name=trim($_POST['second_name']);
		$contact_save->email_address=trim($_POST['email_address']);
		$contact_save->phone_number=trim($_POST['phone_number']);		
	
		if($contact_save->save()){
		$message_type="success";
			$message="Changes Successfully Saved";
		}
		else{
		$message_type="error";
		$message="Nothing To Be Updated. Information Remained The same";
		 }	
	 }
  }
}
	
	
	
	//code to delete contact
	    if((isset($_GET['action']))&&($_GET['action']=='delete')){
		$del_contact=Contacts::find_by_contact_id($_GET['contact_id']);
		if(!empty($del_contact)){
		if($del_contact->delete()){
		$message_type="success";
		$message="Delete succesful";
		}
		else{
		$message_type="error";
		$message="Delete failed";
		}
		}
		else{
		$message_type="error";
		$message="No record";
		}
		}
		
		
		$conts=Contacts::find_all();
?>

<script type="text/javascript">
//javascript code to go one step backwards
function go_back(){
history.back();
}
</script>	
<nav class="art-nav">
    <ul class="art-hmenu"><li><a href="home.php" class="">Home</a></li><li><a href="manage-groups.php" class="">Manage Groups</a></li><li><a href="manage-contacts.php" class="active">Manage Contacts</a></li></ul> 
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
<ul class="art-vmenu"><li><a href="home.php" class="">Home</a></li><li><a href="manage-groups.php" class="">Manage Groups</a></li><li><a href="manage-contacts.php" class="active">Manage Contacts</a></li></ul>
                
        </div>
</div></div>
                        <div class="art-layout-cell art-content"><article class="art-post art-article">
						<?php if($message==""){}else if($message_type=="success"){ echo "<div class='success'>".$message."</div>";} else{ echo "<div class='error'>".$message."</div>";}?>
                                <div class="art-postmetadataheader">
                                        <h2 class="art-postheader"><span class="art-postheadericon">Contacts Management</span></h2>
                                                            
                                    </div>
                                <div class="art-postcontent art-postcontent-0 clearfix"><br>
				<?php 
				 if((isset($_GET['action']))&&($_GET['action']=='edit')){
				$cnt_edit=Contacts::find_by_contact_id($_GET['contact_id']);
				?>		
                 <!--form for contact information editing-->	
                <div class="register">								
			    <fieldset>		
				<legend><b>Edit</b></legend>				
				<form method="post" action="manage-contacts.php">
				<div class="fields"><b>First Name</b></div>
				<div class="fields"><input type="text" name="first_name" value="<?php echo $cnt_edit->first_name;?>" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>second Name</b></div>
				<div class="fields"><input type="text" name="second_name" value="<?php echo $cnt_edit->second_name;?>" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>Email Address</b></div>
				<div class="fields"><input type="email" name="email_address" value="<?php echo $cnt_edit->email_address;?>"/></div>
				<div class="fields"><b>Phone Number</b></div>
				<div class="fields"><input type="text" name="phone_number" value="<?php echo $cnt_edit->phone_number;?>"/></div>	
                 <input type="hidden" name="contact_id" value="<?php echo $cnt_edit->contact_id; ?>"/>				
				<div class="fields"><input type="submit" value="Save Changes" name="save_contact"></div>				
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
				<form method="post" action="manage-contacts.php">
				<div class="fields"><b>First Name</b></div>
				<div class="fields"><input type="text" name="first_name" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>second Name</b></div>
				<div class="fields"><input type="text" name="second_name" required title="characters Only" required pattern="[a-z A-Z]+"/></div>
				<div class="fields"><b>Email Address</b></div>
				<div class="fields"><input type="email" name="email_address" /></div>
				<div class="fields"><b>Phone Number</b></div>
				<div class="fields"><input type="text" name="phone_number" required title="Numbers Only.10 in size" required pattern="[0-9]{10}"/></div>				
				<div class="fields"><input type="submit" value="Add Contact" name="add_contacts"></div>				
				</form>								
				</fieldset>								
				</div>
				<?php }?>

				
			<div class="details">
				<fieldset>
				<legend><b>Details</b></legend>
				<table>
				<tr><th>#</th><th><u>Name</u></th><th><u>Email</u></th><th><u>Phone Number</u></th><th><u>ACTION</u></th></tr>
				
				<?php $no=1; foreach($conts as $contacts): //displays all contacts?>
			
				<tr><td><?php echo $no; ?></td><td><?php echo $contacts->first_name ." ".$contacts->second_name; ?></td><td><?php echo $contacts->email_address; ?></td><td><?php echo $contacts->phone_number; ?></td><td><a href="manage-contacts.php?contact_id=<?php echo $contacts->contact_id?>&action=edit"><input type="button" value="Edit"></a><a href="manage-contacts.php?contact_id=<?php echo $contacts->contact_id?>&action=delete"><input type="button" value="delete"></a></td></tr>
				 <?php $no++; endforeach;?>
				</table>				 
			</fieldset>
			</div>
			
			
								</div>


</article></div>
                    </div>
                </div>
            </div>
			
			<?php include_layout_template('footer'); ?>