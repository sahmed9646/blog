<?php 
    include 'inc/header.php';
    include 'inc/sidebar.php';
?>
<?php 
    include '../classes/Contact.php';
    $contact = new Contact();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Inbox</h2>
                <?php
                	if (isset($_GET['seenid'])) {
                		$seenId = $_GET['seenid'];
                		$seenMsg = $contact->msgSentToSeenBox($seenId);
                		if (isset($seenMsg)) {
                			echo $seenMsg;
                		}
                	}
                ?>
                <?php
                	if (isset($_GET['drftmsgid'])) {
                		$drftmsgid = $_GET['drftmsgid'];
                		$draftMsg = $contact->msgSeenToDrafts($drftmsgid);
                		if (isset($draftMsg)) {
                			echo $draftMsg;
                		}
                	}
                ?>
                <?php
                	if (isset($_GET['unseenid'])) {
                		$unseenId = $_GET['unseenid'];
                		$unseenMsg = $contact->msgSeenToInBox($unseenId);
                		if (isset($unseenMsg)) {
                			echo $unseenMsg;
                		}
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$userMsg = $contact->getAllMessageFromUser();
						if ($userMsg) {
							$i = 0;
							while ($result = $userMsg->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id'];?> ">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
								<a href="?drftmsgid=<?php echo $result['id'];?>">Draft</a> ||
								 <a onclick="return confirm('Are You Sure To Move ?? U cant View it again..');" href="?seenid=<?php echo $result['id'];?>">Seen</a></td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>

            <div class="box round first grid">
                <h2>Seen Messages</h2>
                <?php
                	if (isset($_GET['delid'])) {
                		$delId = $_GET['delid'];
                		$deleteMsg = $contact->deleteMsg($delId);
                		if (isset($deleteMsg)) {
                			echo $deleteMsg;
                		}
                	}
                ?>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$seenMsg = $contact->getSeenMessageFromAdmin();
						if ($seenMsg) {
							$i = 0;
							while ($result = $seenMsg->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
							<a href="viewmsg.php?msgid=<?php echo $result['id'];?> ">View</a>
							 || 
							<a onclick="return confirm('Are You Sure To Delete ??');" href="?delid=<?php echo $result['id'];?>">Delete</a>
							||
							<a onclick="return confirm('Are You Sure To Move ?? U cant View it again..');" href="?unseenid=<?php echo $result['id'];?>">UnSeen</a></td>
							</td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>

            <div class="box round first grid">
                <h2>Drafts</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Name</th>
							<th>Email</th>
							<th>Message</th>
							<th>Date</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
					<?php 
						$draftMsg = $contact->getDraftsMessage();
						if ($draftMsg) {
							$i = 0;
							while ($result = $draftMsg->fetch_assoc()) {
								$i++;
					?>
						<tr class="odd gradeX">
							<td><?php echo $i; ?></td>
							<td><?php echo $result['firstname'].' '.$result['lastname']; ?></td>
							<td><?php echo $result['email']; ?></td>
							<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
							<td><?php echo $fm->formatDate($result['date']); ?></td>
							<td>
								<a href="viewmsg.php?msgid=<?php echo $result['id'];?> ">View</a> || 
								<a href="replymsg.php?msgid=<?php echo $result['id'];?>">Reply</a> ||
								 <a onclick="return confirm('Are You Sure To Move ?? U cant View it again..');" href="?seenid=<?php echo $result['id'];?>">Seen</a>
							</td>
						</tr>
					<?php } } ?>	
					</tbody>
				</table>
               </div>
            </div>
        </div>
        <div class="clear">
        </div>
    </div>

<script type="text/javascript">

    $(document).ready(function () {
        setupLeftMenu();

        $('.datatable').dataTable();
        setSidebarHeight();


    });
</script>
<?php include 'inc/footer.php'; ?>