

<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php if(Session::get('userRole')!='0') {  
    echo "<script>window.location='index.php';</script>";
}
?>
<?php 
    include '../classes/User.php';
    $user = new User();
?>


        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Add New User</h2>
               <div class="block copyblock">
               <?php
                if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                    $adduser = $user->addUserByAdmin($_POST);
                }
               ?> 
                <?php
                if (isset($adduser)) {
                    echo $adduser;
                }
               ?> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td><label>Username</label></td>
                            <td>
                                <input type="text" name="userName" placeholder="Enter Username..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Password</label></td>
                            <td>
                                <input type="text" name="password" placeholder="Enter Password..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>Email</label></td>
                            <td>
                                <input type="text" name="email" placeholder="Enter Valid Email..." class="medium" />
                            </td>
                        </tr>
                        <tr>
                            <td><label>User Role</label></td>
                            <td>
                                <select id="select" name="role">
                                    <option>select user role</option>
                                    <option value="0">Admin</option>
                                    <option value="1">Author</option>
                                    <option value="2">Editor</option>
                                </select>
                            </td>
                        </tr>
						<tr> 
                            <td></td>
                            <td>
                                <input type="submit" name="submit" Value="Create" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>
<?php include 'inc/footer.php'; ?>
