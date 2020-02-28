<div class="grid_2">
            <div class="box sidemenu">
                <div class="block" id="section-menu">
                    <ul class="section menu">
                       <li><a class="menuitem">Site Option</a>
                            <ul class="submenu">
                                <li><a href="titleslogan.php">Title & Slogan</a></li>
                                <li><a href="social.php">Social Media</a></li>
                                <li><a href="copyright.php">Copyright</a></li>
                                
                            </ul>
                        </li>
						<li><a class="menuitem">Slider</a>
                            <ul class="submenu">
                                <li><a href="addslide.php">Add Slide</a> </li>
                                <li><a href="slides.php">Slides</a> </li>
                            </ul>
                        </li>
                         <li><a class="menuitem">Pages</a>
                            <ul class="submenu">
                                <li><a href="addpage.php">Add Page</a> </li>

                            <?php 
                                $query = "SELECT * FROM page ";
                                $showPages = $db->select($query);
                                if ($showPages) {
                                    while ($result = $showPages->fetch_assoc()) {
                             ?>
                                 <li><a href="page.php?pageid=<?php echo $result['pageId']; ?>"><?php echo $result['pageName']; ?></a> </li>
                              <?php } } ?>   
                            </ul>
                        </li>
                        <li><a class="menuitem">Category Option</a>
                            <ul class="submenu">
                                <li><a href="addcat.php">Add Category</a> </li>
                                <li><a href="catlist.php">Category List</a> </li>
                            </ul>
                        </li>
                        <li><a class="menuitem">Post Option</a>
                            <ul class="submenu">
                                <li><a href="addpost.php">Add Post</a> </li>
                                <li><a href="postlist.php">Post List</a> </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>