<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Contact.php';
    $contact = new Contact();
?>

<?php

    if (!isset($_GET['msgid']) || $_GET['msgid'] == null) {
       echo "<script>window.location = 'inbox.php';</script>";
    }else{
        $id = $_GET['msgid'];

    }
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
               echo "<script>window.location = 'inbox.php';</script>";
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>View Messages</h2>
                <div class="block">     
                <form action="" method="post">
                <?php
                    $viewMsg = $contact->getMessageById($id);
                    if ($viewMsg) {
                        while ($result = $viewMsg->fetch_assoc()) {
                ?>
                    <table class="form">
                       <tr>
                            <td width="10%">
                                <label>User Name</label>
                            </td>
                            <td width="60%">
                                <p class="medium" ><?php echo $result['firstname'].' '.$result['lastname']; ?></p> 
                            </td>
                        </tr>
                         <tr>
                            <td>
                                <label>Email</label>
                            </td>
                            <td>
                                <p class="medium" ><?php echo $result['email']; ?></p> 
                            </td>
                        </tr>
                     
                   
                         <tr>
                            <td>
                                <label>Message Body</label>
                            </td>
                            <td>
                                <textarea readonly class="tinymce"><?php echo $result['body']; ?></textarea>
                            </td>
                          </tr>
                        
                         <tr>
                            <td>
                                <label>Date</label>
                            </td>
                            <td>
                                <p class="medium" ><?php echo $fm->formatDate($result['date']); ?></p> 
                            </td>
                          </tr>

    					   <tr>
                            <td></td>
                            <td>
                             <input type="submit" name="submit" Value="Ok" />
                            </td>
                            </tr>
                    </table>
                    <?php } } ?>
                    </form>
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