		</div>
		<div class="sidebar clear">
			<div class="samesidebar clear">
				<h2>Categories</h2>
					<ul>
					<?php 
						$query = "SELECT * FROM category";
						$category = $db->select($query);
						if ($category) {
							while ($result=$category->fetch_assoc()) {
					?>
						<li><a href="posts.php?cat=<?php echo $result['catId'];?>"><?php echo $result['catName'];?></a></li>	
						<?php } } else{?>		
							<li>No Category Created</li>
						<?php } ?>				
					</ul>
			</div>
			
			<div class="samesidebar clear">
				<h2>Latest articles</h2>
					<div class="popular clear">
					<?php 
						$query = "SELECT * FROM post ORDER BY rand() limit 6";
						$post = $db->select($query);
						if ($post) {
							while ($result=$post->fetch_assoc()) {
					?>
						<h3 style="font-size: 16px; font-style: italic;"><a href="post.php?id=<?php echo $result['id']; ?>"><?php echo $result['title']; ?></a></h3>
						<a href="post.php?id=<?php echo $result['id']; ?>"><img src="admin/<?php echo $result['image'];?>" alt="post image"/></a>
						<p style="margin-bottom: 20px;"><?php echo $fm->textShorten($result['body'],125); ?></p>

						<?php } } else{?>		
							<li>No popular post here</li>
						<?php } ?>	
					</div>
					
			</div>
			
		</div>
	</div>
