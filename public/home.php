<?php require_once("../includes/initialize.php");?>
<?php include_layout_template('header');

$grp=Groups::find_all();

//create an arrays of all contacts objects
$contact_count=Contacts::count_all();

?>
<script type="text/javascript">
//javascript code to go one step backwards
function go_back(){
history.back();
}
</script>	
<nav class="art-nav">
    <ul class="art-hmenu"><li><a href="home.php" class="active">Home</a></li><li><a href="manage-groups.php">Manage Groups</a></li><li><a href="manage-contacts.php">Manage Contacts</a></li></ul> 
      <ul class="art-hmenu" style="float:right;"><li> <span style="text-align:justify;"><p><img src="images/back.png" alt="logout" onClick=go_back()></p>
	</span>	</li>	</ul> 
   </nav>
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
                                        <h2 class="art-postheader"><span class="art-postheadericon">My contact Groups</span></h2>
                                                            
                                    </div>
                                <div class="art-postcontent art-postcontent-0 clearfix">
								
								<a href="view_group_contact.php?group_id=36 &action=view">
								<div class="folder">					
								<div class="folder_icon">							
								<img src="images/full.jpg" title="Group Used By The System. It Cannot Be Deleted And Contains All The Contacts" width="95%" height="95%" >
								</div>
								<div class="folder_caption" align="center">
								<b>Default (<?php echo $contact_count;?>)</b>
								</div>
								</div>
								
								<?php $no=1; foreach($grp as $grp): 
								// diplays the Icons Of All Groups Created
								if($grp->group_name=="Default"){
								}
								else{
								$member_count=Group_members::count_all_members($grp->group_id);
								
								?>
								
								<a href="view_group_contact.php?group_id=<?php echo $grp->group_id?>&action=view">
								<div class="folder">					
								<div class="folder_icon">							
								<img src="images/full.jpg" title="<?php echo $grp->group_description;?>" width="95%" height="95%" >
								</div>
								<div class="folder_caption" align="center">
								<?php echo "<b>". $grp->group_name ." (".$member_count.")</b>"; ?>
								</div>
								</div>
								</a>
		
				               <?php }	 endforeach;?>
								
								</div>
								<br/>
								<br/>
								<h5>TIP:The Default Group Contains All The Contacts In The System. It Cannot Be Deleted Or Modified. Hover On Icon To Get Group Description</h5>


</article></div>
                    </div>
                </div>
            </div>
			<?php include_layout_template('footer'); ?>