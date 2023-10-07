/* <!-- Navbar

 ================================================== -->
*/

    <div id="navbar" class="navbar navbar-fixed-top">

        <div class="navbar-inner" style='border-bottom: 2px solid #3d5b9b;'>

            <div class="container">
                <a href="#" id="scroll" style="display: none;"><span></span></a>
                <div class="col-xs-12 topmenu" style="text-align:left;">
		        <small>
                    <a href="en" style="margin-left:2px">English</a> |
                    <a href="ar" class='droid' style="margin-left:2px">عربی</a>
			    </small>
		        </div>

          //<!-- logo -->
                <a class="brand logo" href="index.php"  style="margin-top: -5px; float: right;">
		        <img src="assets/img/logo-ku.png" alt="logo" id="Logo" class="largeLogo"></a>
          // <!-- end logo -->

          //<!-- top menu -->

                <div class="navigation">

                    <nav class="droid">

                        <ul class="nav topnav" style="margin-top: 10px;margin-right: 0px;">
                            <li class="dropdown">
                                <a href="contact.php" style='font-size:11px;padding-left: 8px;padding-right: 8px; '>پەیوەندی</a>
                            </li>
				            <li class="dropdown">

                                <a href="news-activities.php" style='font-size:11px;padding-left: 8px;padding-right: 8px; '>هەواڵ و چالاکی</a>
                            </li>
				            <li class="dropdown"><?php
                                $result = $dbh->prepare("SELECT * from medical_equipment WHERE language_id=2 and publish_id=1 and info_id =5" );
                                $result->execute();
                                $row=$result->fetch(PDO::FETCH_ASSOC);
                                print"<a href=equipment-detail.php?inid=5 style='font-size:11px;padding-left: 8px;padding-right: 8px; '>ئامێری پزیشکی</a>";
                            ?>

                                <ul class="dropdown-menu"><?php

                                    $result1 = $dbh->prepare("SELECT * from medical_equipment where language_id=2 and publish_id=1" );
                                    $result1->execute();
                                    while ($row1 = $result1->fetch()){
                                        echo"<li><a href=equipment-detail.php?inid=".$row1['equipment_id'].">".$row1['title']."</a></li>";
										}
                                ?>
                                </ul>
                            </li>
				            <li class="dropdown"><?php
                                $result = $dbh->prepare("SELECT * from medical_supplies where language_id=2 and publish_id=1 and supplies_id =4 " );
                                $result->execute();
                                $row=$result->fetch(PDO::FETCH_ASSOC);
                                print"<a href=supplies-detail.php?vid=4 style='font-size:11px;padding-left: 8px;padding-right: 8px; '>پێداویستی پزیشکی</a>";
                            ?>
                                <ul class="dropdown-menu"><?php
                                    $result1 = $dbh->prepare("SELECT * from medical_supplies where language_id=2 and publish_id=1" );
                                    $result1->execute();
                                    while ($row1 = $result1->fetch()){
                                        echo"<li><a href=supplies-detail.php?vid=".$row1['supplies_id'].">".$row1['title']."</a></li>";
										}
                                ?>
                                </ul>

                            </li>
                            <li class="dropdown"><?php
                                $result = $dbh->prepare("SELECT * from surgery where language_id=2 and publish_id=1 and surgery_id =7  " );
                                $result->execute();
                                $row=$result->fetch(PDO::FETCH_ASSOC);
                                print"<a href=surgery-detail.php?suid=7 style='font-size:11px;padding-left: 8px;padding-right: 8px; '>نەشتەرگەری</a>";
							?>
                                <ul class="dropdown-menu"><?php
                                    $result1 = $dbh->prepare("SELECT * from surgery where language_id=2 and publish_id=1" );
                                    $result1->execute();
                                    while ($row1 = $result1->fetch()){
                                        echo"<li><a href=surgery-detail.php?suid=".$row1['surgery_id'].">".$row1['title']."</a></li>";
										}
								?>
                                </ul>
                            </li>
				            <li class="dropdown">
                                <a href="manufacturers.php" >نوێنەرایەتی</a>
                                <ul class="dropdown-menu"><?php
                                    $result = $dbh->prepare("SELECT * from manufacturer_cat where publish_id=1" );
                                    $result->execute();
                                    while ($row = $result->fetch()){
                                        echo"<li><a href=our-manufacturers-category.php?dcid=".$row['manufacturer_cat_id']." class='droid'>".$row['manufacturer_cat_K']."</a></li>";
										}
								?>
                                </ul>
                            </li>
				            <li class="dropdown"><?php
                                    $result = $dbh->prepare("SELECT * from products WHERE language_id=2 and publish_id=1 and product_id =8" );
                                    $result->execute();
									$row=$result->fetch(PDO::FETCH_ASSOC);
									print"<a href=product-detail.php?sid=8 style='font-size:11px;padding-left: 8px;padding-right: 8px; '>بەرهەمەکانی ئێمە</a>";
							?>
                                <ul class="dropdown-menu"><?php
                                    $result1 = $dbh->prepare("SELECT * from products WHERE language_id=2 and publish_id=1" );
                                    $result1->execute();
                                    while ($row1 = $result1->fetch()){
                                        echo"<li><a href=product-detail.php?sid=".$row1['product_id'].">".$row1['title']."</a></li>";
								}
								?>
                                </ul>
                            </li>
				            <li class="dropdown"><?php
                                $result = $dbh->prepare("SELECT * from about_us where language_id=2 and publish_id=1 and about_id =5  " );
                                $result->execute();
                                $row=$result->fetch(PDO::FETCH_ASSOC);
                                print"<a href=about-us-detail.php?abid=5 style='font-size:11px;padding-left: 8px;padding-right: 8px; '>دەربارەی ئێمە</a>";
								?>
                                <ul class="dropdown-menu"><?php
                                    $result1 = $dbh->prepare("SELECT * from about_us where language_id=2 and publish_id=1" );
                                    $result1->execute();
                                    while ($row1 = $result1->fetch()){
                                        echo"<li ><a href=about-us-detail.php?abid=".$row1['about_id'].">".$row1['tab_title']."</a></li>";
										}
										?>
                                </ul>
                            </li>
				            <li class="dropdown active droid">
                                <a href="index.php" style='font-size:11px;padding-left: 8px;padding-right: 8px; '>سەرەتا</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
// End of Navbar.
