<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/User.php';
    $user = new User();
?>
<?php
//get all values from a single id 
  if (isset($_GET['viewuserid'])) {
      $userid = $_GET['viewuserid'];
  }else{
     echo "<script>window.location='userlist.php';</script>";
  }

//For updating existing post
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        echo "<script>window.location='userlist.php';</script>";
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Update Your Profile</h2>
                <div class="block">     
                 
                <?php 
                  $getUser = $user->getUserFromUserlist($userid);  
                  if ($getUser) {
                      while ($values = $getUser->fetch_assoc()) {
                ?>         
                 <form action="" method="post">
                    <table class="form">
                       
                        <tr>
                            <td>
                                <label>Name</label>
                            </td>
                            <td>
                                <input type="text" readonly value="<?php echo $values['name'];?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>Username</label>
                            </td>
                             <td>
                                <input type="text" readonly value="<?php echo $values['userName'];?>" class="medium" />
                            </td>
                        </tr>
                   
                        <tr>
                            <td>
                                <label>Email</label>
                            </td>
                             <td>
                                <input type="text" readonly value="<?php echo $values['email'];?>" class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td style="vertical-align: top; padding-top: 9px;">
                                <label>Details</label>
                            </td>
                            <td>
                                <textarea class="tinymce" >
                                <?php echo $values['details'];?>
                                </textarea>
                            </td>
                        </tr>
                       
						<tr>
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Ok" />
                            </td>
                        </tr>
                    </table>
                    </form>
                  <?php } } ?>  
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<!-- /TinyMCE -->
<style type="text/css">
    #tinymce{font-size:15px !important;}
</style>    
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>    
<?php include 'inc/footer.php'; ?>