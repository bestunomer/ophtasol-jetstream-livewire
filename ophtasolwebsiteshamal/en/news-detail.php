<?php
include('../connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Ibinsina -  <?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=1 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                   echo$row['title'];
				  }
				 }
			   }?></title>
    <link rel="icon" href="../assets/img/title-logo.png">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="<?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=1 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                   echo$row['title'];
				  }
				 }
			   }?>" />

  <meta name="description" content="<?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=1 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                   echo$row['detail'];
				  }
				 }
			   }?>" />
  <meta name="author" content="Ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="../assets/img/<?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=1 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                   echo$row['photo1'];
				  }
				 }
			   }?>"/>
  <!-- styles -->
   <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="../assets/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="../assets/css/flexslider.css" rel="stylesheet">
  <link href="../assets/css/docs.css" rel="stylesheet">
  <link href="../assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
      <link href="../assets/css/custom.css" rel="stylesheet">
  <link href="../assets/color/default.css" rel="stylesheet">

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d31befc1062be36"></script>
<!-- fav and touch icons -->
    <link rel="icon" href="../assets/img/title-logo.png">
  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">

<!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-144200766-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-144200766-1');
</script>

</head>

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <header>
    <!-- Navbar
    ================================================== -->
    <div class="navbar navbar-fixed-top">
      <div class="navbar-inner" style='border-bottom: 2px solid #3d5b9b;'>
        <div class="container">
        
          <a href="#" id="scroll" style="display: none;"><span></span></a>
        
        <div class="col-xs-12 topmenu" style="text-align:right;margin-right: 10px;"><small>
          <a href="../index.php" class="droid" style="margin-left:2px">کوردی</a> |
         <a href="../ar" class="droid"  style="margin-left:2px">عربی</a>
  
  
</small>
    </div>
          <!-- logo -->
         <a class="brand logo" href="index.php"  style="margin-top: -5px;float: left;">
		  <img src="../assets/img/logo.png" alt="logo" id="Logo" class="largeLogo"></a>
        <!-- end logo -->
          <!-- top menu -->
                    <div class="navigation">
            <nav>
              <ul class="nav topnav" style="margin-top: 10px;margin-right: 0px;">
			
                <li class="dropdown">
                  <a href="index.php">Home</a>
                </li>
                <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from about_us where language_id=1 and publish_id=1 and about_id =1");
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  
                  print"<a href=about-us-detail.php?abid=1>About Us</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from about_us where language_id=1 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=about-us-detail.php?abid=".$row1['about_id'].">".$row1['tab_title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				      <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from service where language_id=1 and publish_id=1 and service_id =1" );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  
                 
                  print"<a href=service-detail.php?sid=1>Services</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from service where language_id=1 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=service-detail.php?sid=".$row1['service_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				
				
                <li class="dropdown">
                  <a href="our-doctors.php">Our Team</a>
                  <ul class="dropdown-menu">

                     <?php
            
                  $result = $dbh->prepare("SELECT * from doctor_cat where publish_id=1 " );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                      echo"<li><a href=our-doctors-category.php?dcid=".$row['doctor_cat_id'].">".$row['doctor_cat']."</a></li>";

                  }
                  ?>
                    
                  </ul>
                </li>


          
                <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from surgery where language_id=1 and publish_id=1 and surgery_id =1");
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  
                 
                  print"<a href=surgery-detail.php?suid=1>Surgery</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from surgery where language_id=1 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=surgery-detail.php?suid=".$row1['surgery_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
                <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from your_visit where language_id=1 and publish_id=1 and visit_id =1");
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  
                 
                  print"<a href=visit-detail.php?vid=1>Your Visit</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from your_visit where language_id=1 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=visit-detail.php?vid=".$row1['visit_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
                <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from general_information where language_id=1 and publish_id=1 and info_id =1" );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  
                 
                  print"<a href=info-detail.php?inid=1>Know Your Eyes Better</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from general_information where language_id=1 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=info-detail.php?inid=".$row1['info_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
                <li class="dropdown active">
                  <a href="news-activities.php">News and Activity</a>
                </li>
                 <li class="dropdown">
                  <a href="faq.php">FAQ</a>
                </li>
                <li class="dropdown">
                  <a href="contact.php">Contact Us</a>
                </li>
              </ul>
            </nav>
          </div>
          <!-- end menu -->
        </div>
      </div>
    </div>
  </header>

  <!-- Subhead
================================================== -->
 
  
  <section id="maincontent" style="padding-top: 15px">
    <div class="container">
      <div class="row">

      
         

		 
		 
		 
		 
		 
		 
		 
		
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		 
		<div class=span8>
		 
		  <div class="flexslider">
                  <ul class="slides">
                 
              
		 
		 
		 
		 
               <?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=1 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
			  if(!empty($row['photo1']))
			  {
                        echo"<li>";
                        echo"<img src=../assets/img/activities/news/".$row['photo1']." />";
                        echo"</li>";
			  }
			  
			   if(!empty($row['photo2']))
			  {
                        echo"<li>";
                        echo"<img src=../assets/img/activities/news/".$row['photo2']." />";
                        echo"</li>";
                       
			  }
			   if(!empty($row['photo3']))
			  {
					    echo"<li>";
                        echo"<img src=../assets/img/activities/news/".$row['photo3']." />";
                        echo"</li>";
			  }
			   if(!empty($row['photo4']))
			  {
						
						echo"<li>";
                        echo"<img src=../assets/img/activities/news/".$row['photo4']." />";
                        echo"</li>";
			  }
				  }
				  
					?>
					
					  </ul>
					 
					 </div>
					 <?php
					 if(!empty($row['video']))
					 {
					 echo"<iframe width='100%' height='400px' src='https://www.youtube.com/embed/".$row['video']."?autoplay=0'></iframe>";
					 
					 }
                     ?>
                </div>
				
				
				
					<?php
					
                      print"<div class=span4>";
			
                      print"<h4><a href=news-detail.php?nid=".$row['news_id'].">".$row['title']."</a></h4>";

		  echo" <div class='btn-group pull-left'>
            <button type='button' class='btn btn-default pull-right' onclick='zoomout();'>A+</button>
            <button type='button' class='btn btn-default pull-right' onclick='removezoom();'>A</button>
            <button type='button' class='btn btn-default pull-right' onclick='zoomin();'>A-</button>
            </div><br/><br/>";
		print"<span class='dat'>".$row['publish_date']."    </span>";
                      print"<p class='zoom' style='text-align:justify'>".$row['detail']."</p>";
					  
					  
       
			 print"<div class='addthis_inline_share_toolbox'></div>";
             print"</div>";  
					  
             


                     
                  
                 }
             }
            ?>


                <!-- Go to www.addthis.com/dashboard to customize your tools -->
               
            
      </div>
    </div>
  </section>
  <!-- Footer
 ================================================== -->
   <footer class="footer">
<?php
  include("footer.php");
  ?>
  </footer>

  <!-- JavaScript Library Files -->
  <script src="../assets/js/jquery.min.js"></script>
  <script src="../assets/js/jquery.easing.js"></script>
  <script src="../assets/js/google-code-prettify/prettify.js"></script>
  <script src="../assets/js/modernizr.js"></script>
  <script src="../assets/js/bootstrap.js"></script>
  <script src="../assets/js/jquery.elastislide.js"></script>
  <script src="../assets/js/sequence/sequence.jquery-min.js"></script>
  <script src="../assets/js/sequence/setting.js"></script>
  <script src="../assets/js/jquery.prettyPhoto.js"></script>
  <script src="../assets/js/application.js"></script>
  <script src="../assets/js/jquery.flexslider.js"></script>
  <script src="../assets/js/hover/jquery-hover-effect.js"></script>
  <script src="../assets/js/hover/setting.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="../assets/js/custom.js"></script>
<script src="../assets/js/jquery.touchSwipe.min.js"></script>
<script src="../assets/js/script.js?v=20190602134248"></script>

<script src="../assets/js/jquery.fancybox.min.js"></script>

<script>
$(window).load(function() {
  $('.flexslider').flexslider({
    animation: "slide"
  }); 
});
</script>

 <?php
  include("../assets/js/custom_en.js");
  ?>
</body>

</html>
