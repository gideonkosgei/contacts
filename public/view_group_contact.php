<?php require_once("../includes/initialize.php");?>
<?php include_layout_template('header');

$grp=Groups::find_all();

 if((isset($_GET['action']))&&($_GET['action']=='view')){
		$group=Groups::find_by_group_id($_GET['group_id']);
		if($group->group_name=="Default"){
		$conts=Contacts::find_all();
		}
		else{
		$conts=Group_members::find_by_group_id($_GET['group_id']);
		
		
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
    <ul class="art-hmenu"><li><a href="home.php" class="active">Home</a></li><li><a href="manage-groups.php">Manage Groups</a></li><li><a href="manage-contacts.php">Manage Contacts</a></li></ul> 
    <ul class="art-hmenu" style="float:right;"><li> <span style="text-align:justify;"><p><img src="images/back.png" alt="logout"onClick=go_back()></p>
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
<ul class="art-vmenu"><li><a href="home.php" class="active">Home</a></li><li><a href="manage-groups.php">Manage Groups</a></li><li><a href="manage-contacts.php">Manage Contacts</a></li></ul>
                
        </div>
</div></div>
                        <div class="art-layout-cell art-content"><article class="art-post art-article">
                                <div class="art-postmetadataheader">
                                        <h2 class="art-postheader"><span class="art-postheadericon"><?php echo $group->group_name;?> contacts</span></h2>
                                                            
                                    </div>
                                <div class="art-postcontent art-postcontent-0 clearfix">
								<br/>
								
				<?php if($conts) { ?>				
				<table>
				<tr><th>#</th><th><u>Name</u></th><th><u>Email</u></th><th><u>Phone Number</u></th></tr>
				<?php $no=1; foreach($conts as $conts): 
				$contacts=Contacts::find_by_contact_id($conts->contact_id);
				?>
				<tr><td><?php echo $no; ?></td><td><?php echo $contacts->first_name ." ".$contacts->second_name; ?></td><td><?php echo $contacts->email_address; ?></td><td><?php echo $contacts->phone_number; ?></td></tr>
				 <?php $no++; endforeach;?>
								
				</table>
				<?php }
				else{
				echo "<p align='center'><h2>This Group Has No Contacts</h2></p>";
				}
				?>			
				
				
				<br/>							
				</div>


</article></div>
                    </div>
                </div>
            </div>
			<?php include_layout_template('footer'); ?>