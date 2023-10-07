<?php
include('../connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Ibinsina Hospital - <?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from doctor,doctor_cat 
                        where   doctor.active=1 and doctor.doctor_id=:did and
                        doctor.doctor_cat_id = doctor_cat.doctor_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[fullname];
                }
              }
?> 

  
  
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content=<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from doctor,doctor_cat 
                        where   doctor.active=1 and doctor.doctor_id=:did and
                        doctor.doctor_cat_id = doctor_cat.doctor_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[fullname];
                }
              }
?>/>
  <meta name="description" content="<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from doctor,doctor_cat 
                        where   doctor.active=1 and doctor.doctor_id=:did and
                        doctor.doctor_cat_id = doctor_cat.doctor_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[detail_about_doctor];
                }
              }
?>" />
  <meta name="author" content="ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="../assets/img/doctors/<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from doctor,doctor_cat 
                        where   doctor.active=1 and doctor.doctor_id=:did and
                        doctor.doctor_cat_id = doctor_cat.doctor_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[doctor_photo];
                }
              }
?>"/>
  
  
  
  
  <!-- styles -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="../assets/css/bootstrap.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="../assets/css/docs.css" rel="stylesheet">
  <link href="../assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="../assets/css/flexslider.css" rel="stylesheet">
  <link href="../assets/css/sequence.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
      <link href="../assets/css/custom.css" rel="stylesheet">
  <link href="../assets/color/default.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

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

<body>
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
            
                  $result = $dbh->prepare("SELECT * from about_us where language_id=1 and publish_id=1 and about_id =1" );
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
            
                  $result = $dbh->prepare("SELECT * from service where language_id=1 and publish_id=1 and service_id =1 " );
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
				
				
				
                <li class="dropdown active">
                  <a href="our-doctors.php">Our Team</a>
                  <ul class="dropdown-menu">

                    <?php
            
                  $result = $dbh->prepare("SELECT * from doctor_cat where publish_id=1" );
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
            
                  $result = $dbh->prepare("SELECT * from surgery where language_id=1 and publish_id=1 and surgery_id =1 " );
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
            
                  $result = $dbh->prepare("SELECT * from your_visit where language_id=1 and publish_id=1 and visit_id =1  " );
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
                <li class="dropdown">
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
  
  <section id="maincontent">
    <div class="container" style='padding-top:15px'>
      <div class="row">
        <div class="span12">
          <article>
            
            <div class="row">
              <div class="span5">


             <?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from doctor,doctor_cat 
                        where   doctor.active=1 and doctor.doctor_id=:did and
                        doctor.doctor_cat_id = doctor_cat.doctor_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                    
                        print"<img src=../assets/img/doctors/".$row['doctor_photo']." />";
                        print"<p>".$row['detail_about_doctor']."</p>";

                    
                  }
                }
              }
?> 


                 


              </div>
              <div class="span7">
                <div class="project-widget">
                  <h4><i class="icon-48 icon-beaker"></i> Profile</h4>
                  <ul class="project-detail">
                  <?php
                  
                
                  


				   
				   
				   
				   
				   
				   
				   
				    if(!empty($row['fullname']))
				{
                    print"<li><label>Name :</label> ".$row['fullname']."</li>";
				}
				   if(!empty($row['qualification']))
				{
                   print"<li><label>Qualification :</label> ".$row['qualification']."</li>";
				}
				   if(!empty($row['doctor_cat']))
				{
                   print"<li><label>Specialty Category :</label> ".$row['doctor_cat']."</li>";
				}
                if(!empty($row['work_mobile']))
				{
                   print"<li><label>Mobile :</label> ".$row['work_mobile']."</li>";
				}
				 if(!empty($row['work_email']))
				{
                   print"<li><label>Email :</label> <a href=mailto:".$row['work_email'].">".$row['work_email']."</a></li>";
				}

				if(!empty($row['working_hours']))
				{  
                   print"<li><label>Working Hours :</label> ".$row['working_hours']."</li>";
				}
				   if(!empty($row['clinic_address_k']))
				{
				   print"<li dir='rtl'><label>Clinic Address:</label> ".$row['clinic_address']."</li>";
				}
				   if(!empty($row['clinic_mobile']))
				{
				   print"<li dir='rtl'><label>Clinic Mobile:</label> ".$row['clinic_mobile']."</li>";
				}
				   if(!empty($row['video_link']))
				{
                   print"<li><label>Video link :</label><a href=".$row['video_link']." target=_blank> ".$row['video_link']."</a></li>";
				}
				   
				   
				   
				   
				   
				   
				   
				   
				   
				   
				   
				   
				   
                  ?>
                   <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
                  </ul>
                </div>
              </div>
              
                
            </div>
          </article>
              
          <!-- end article full post -->
        </div>
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

 <?php
  include("../assets/js/custom_en.js");
  ?>
</body>

</html>