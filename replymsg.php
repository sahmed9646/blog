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
        $sentMsg = $contact->msgSentFromAdmin($_POST, $id);
    }
?>

        <div class="grid_10">
		
            <div class="box round first grid">
                <h2>Reply Messages</h2>
                <?php 
                    if (isset($sentMsg)) {
                        echo $sentMsg;
                    }
                ?>
                <div class="block">     
                <form action="" method="post">
                <?php
                    $viewMsg = $contact->getMessageById($id);
                    if ($viewMsg) {
                        while ($result = $viewMsg->fetch_assoc()) {
                ?>
                    <table class="form">
                         <tr>
                            <td>
                                <label>To</label>
                            </td>
                            <td>
                                <input type="text" readonly name="toEmail" value="<?php echo $result['email']; ?>" class="medium" />
                            </td>
                        </tr>
                     
                        <tr>
                            <td>
                                <label>From</label>
                            </td>
                            <td>
                                <input type="text" name="fromEmail" placeholder="Enter your Email Address" class="medium" />
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <label>Subject</label>
                            </td>
                            <td>
                                <input type="text" name="subject" placeholder="Enter your subject" class="medium" />
                            </td>
                        </tr>
                   
                   
                         <tr>
                            <td>
                                <label>Message Body</label>
                            </td>
                            <td>
                                <textarea class="tinymce" name="message"></textarea>
                            </td>
                          </tr>
                        <tr>
                            <td></td>
                            <td>
                             <input type="submit" name="submit" Value="Sent" />
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