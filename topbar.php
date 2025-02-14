<style>
	.logo {
    margin: auto;
    font-size: 20px;
    background: white;
    padding: 7px 11px;
    border-radius: 50% 50%;
    color: #000000b3;
}
.container-fluid{
  min-width: 100vh;
}
</style>

<nav class="navbar navbar-light fixed-top bg-primary" style="padding:0">
  <div class="container-fluid mt-2 mb-2">
  	<div class="col-lg-12">
  		<div class="col-md-1 float-left" style="display: flex;">
  		
  		</div>
      <div class="col-md-4 float-left text-white">
      <span class='icon-field' id="show-hide-menu"><i class="fa fa-bars "></i></span>
        <large><b><?php echo isset($_SESSION['system']['name']) ? $_SESSION['system']['name'] : '' ?></b></large>
      </div>
	  	<div class="float-right">
        <div class=" dropdown mr-4">
            <a href="#" class="text-white dropdown-toggle"  id="account_settings" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo $_SESSION['login_name'] ?> </a>
              <div class="dropdown-menu" aria-labelledby="account_settings" style="left: -2.5em;">
                <a class="dropdown-item" href="javascript:void(0)" id="manage_my_account"><i class="fa fa-cog"></i> Manage Account</a>
                <a class="dropdown-item" href="ajax.php?action=logout"><i class="fa fa-power-off"></i> Logout</a>
              </div>
        </div>
      </div>
  </div>
  
</nav>

<script>
  $('#manage_my_account').click(function(){
    uni_modal("Manage Account","manage_user.php?id=<?php echo $_SESSION['login_id'] ?>&mtype=own")
  })
  var sidebarVisible = true;
  var sidebarWidth = 200; // Width of the sidebar in pixels

  // Initial position of the sidebar
  $('#sidebar').css('margin-left', -sidebarWidth + 'px');

  $("#show-hide-menu").click(function(){
    sidebarVisible = !sidebarVisible;
        
    if (sidebarVisible) {
        // Show sidebar
        $('#sidebar').animate({ marginLeft: '0' }, 300);
        $('#view-panel').animate({ marginLeft: sidebarWidth + 'px' }, 300);
    } else {
        // Hide sidebar
        $('#view-panel').animate({ marginLeft: '0px' }, 300);
        $('#sidebar').animate({ marginLeft: -sidebarWidth + 'px' }, 300);
    }
  })
  
</script>