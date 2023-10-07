<?php
include('../connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>Ibinsina Hospital - FAQ</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="Ibinsina Hospital - FAQ" />
  <meta name="description" content="Ibinsina Modern eye & retina center" />
  <meta name="author" content="Ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="http://chwarsoft.com" />
  <meta property="og:image" content="../assets/img/logo.png"/>
  
  
  
  
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
                  while ($row = $result->fetch()) 
                  {
                  print"<a href=about-us-detail.php?abid=1>About Us</a>";
                }
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
            
                  $result = $dbh->prepare("SELECT * from service where language_id=1 and publish_id=1 and service_id ='1'  " );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<a href=service-detail.php?sid=1>Services</a>";
                }
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
            
                  $result = $dbh->prepare("SELECT * from doctor_cat where publish_id=1

                   " );
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
            
                  $result = $dbh->prepare("SELECT * from surgery where language_id=1 and publish_id=1 and surgery_id ='1'  " );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<a href=surgery-detail.php?suid=1>Surgery</a>";
                }
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
            
                  $result = $dbh->prepare("SELECT * from your_visit where language_id=1 and publish_id=1 and visit_id ='1'  " );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<a href=visit-detail.php?vid=1>Your Visit</a>";
                }
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
            
                  $result = $dbh->prepare("SELECT * from general_information where language_id=1 and publish_id=1 and info_id ='1'  " );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<a href=info-detail.php?inid=1>Know Your Eyes Better</a>";
                }
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
                 <li class="dropdown active">
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
   
 
  <section id="maincontent" >
    <div class="container" style="padding-top:15px">
      
       
      <!--Start FAQ-->
      <div class="row">
        <div class="span12">
          <h4>Frequently Asked Questions</h4>
          <!-- start: Accordion -->
          <div class="accordion" id="accordion2">

          <?php
          $result = $dbh->prepare("SELECT * from faq where language_id=1 and publish_id=1 ORDER BY faq_id DESC");
          $result->execute();
          $counter=0;
		  $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

          while ($row = $result->fetch()) 
          { 
            if($counter==0 && ($actual_link=="http://www.ibinsina.org/en/faq.php" || $actual_link=="https://www.ibinsina.org/en/faq.php" ))
            {
            print"<div class='accordion-group'>";
              print"<div class='accordion-heading'>";
                print"<a class='accordion-toggle active' data-toggle='collapse' data-parent='#accordion2' 
                href='#collapse".$counter."'>";
            print"<i class='icon-minus'></i>".$row['title']."</a>";
			
              print"</div>";
              print"<div id='collapse".$counter."' class='accordion-body collapse in'>";
                print"<div class=accordion-inner>";
                print"<div class=row>";
                print"<div class='span8 zoom'>".$row['detail']."<br /><a href=".$row['video']." target=-blank>".$row['video']."</a></div>";
                print"<div class=span3><img src=../assets/img/faq/".$row['photo']." /></div>";
				
                print"</div>";

          print"</div>";
		   echo" <div class='btn-group pull-right'>
            <button type='button' class='btn btn-default pull-right' onclick='zoomout();'>A+</button>
            <button type='button' class='btn btn-default pull-right' onclick='removezoom();'>A</button>
            <button type='button' class='btn btn-default pull-right' onclick='zoomin();'>A-</button>
            </div>";
             print"</div>";
            print"</div>";
          }
		  
		  else
		  
			  if($actual_link=="http://www.ibinsina.org/en/faq.php#collapse".$counter."'" or $actual_link=="https://www.ibinsina.org/en/faq.php#collapse".$counter."'")
          {
           print"<div class='accordion-group'>";
              print"<div class='accordion-heading'>";
                print"<a href='#collapse".$counter."' class='accordion-toggle active' data-toggle='collapse' data-parent='#accordion2'>";
            print"<i class='icon-minus'></i>".$row['title']."</a>";
              print"</div>";
              print"<div id='collapse".$counter."' class='accordion-body collapse in'>";
                print"<div class=accordion-inner>";
                print"<div class=row>";
                print"<div class='span8 zoom'>".$row['detail']."<br /><a href=".$row['video']." target=-blank>".$row['video']."</a></div>";
                print"<div class=span3><img src=assets/img/faq/".$row['photo']." /></div>";
                print"</div>";

				
					echo" <div class='btn-group pull-left'>
            <button type='button' class='btn btn-default pull-right' onclick='zoomout();'>A+</button>
            <button type='button' class='btn btn-default pull-right' onclick='removezoom();'>A</button>
            <button type='button' class='btn btn-default pull-right' onclick='zoomin();'>A-</button>
            </div><br/><br/>";
				
				
          print"</div>";
             print"</div>";
            print"</div>";

          }
		  
		  
		  else
          {
           print"<div class='accordion-group'>";
              print"<div class='accordion-heading'>";
                print"<a class='accordion-toggle' data-toggle='collapse' data-parent='#accordion2' 
                href='#collapse".$counter."'>";
            print"<i class='icon-plus'></i>".$row['title']."</a>";
			 
              print"</div>";
              print"<div id='collapse".$counter."' class='accordion-body collapse'>";
                print"<div class=accordion-inner>";
                print"<div class=row>";
                print"<div class='span8 zoom'>".$row['detail']."<br /><a href=".$row['video']." target=-blank>".$row['video']."</a></div>";
                print"<div class=span3><img src=../assets/img/faq/".$row['photo']." /></div>";
			
                print"</div>";
	echo" <div class='btn-group pull-right'>
            <button type='button' class='btn btn-default pull-right' onclick='zoomout();'>A+</button>
            <button type='button' class='btn btn-default pull-right' onclick='removezoom();'>A</button>
            <button type='button' class='btn btn-default pull-right' onclick='zoomin();'>A-</button>
            </div>";
          print"</div>";
             print"</div>";
            print"</div>";

          }
            $counter++;
          

          }
          ?>

            



            



          </div>
          <!--end: Accordion -->
        </div>
      </div>
      <!--End FAQ-->
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
