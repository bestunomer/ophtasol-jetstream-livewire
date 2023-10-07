<?php
include('../connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <title>الصفحة الرئیسیة</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="الصفحة الرئیسیة" />

  <meta name="description" content="ibinsina Modern eye & retina center" />
  <meta name="author" content="ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="../assets/img/logo-ar.png"/>
  


  
  
  <!-- styles -->
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="../assets/css/bootstrap-ku.css" rel="stylesheet">
  <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="../assets/css/docs.css" rel="stylesheet">
  <link href="../assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="../assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="../assets/css/flexslider.css" rel="stylesheet">
  <link href="../assets/css/sequence.css" rel="stylesheet">
  <link href="../assets/css/style.css" rel="stylesheet">
  <link href="../assets/color/default.css" rel="stylesheet">
  
  
  
     <link href="../assets/css/custom_ku.css" rel="stylesheet">
  
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
    <div id="navbar" class="navbar navbar-fixed-top" >
      <div class="navbar-inner" style='border-bottom: 2px solid #3d5b9b;' >
        <div class="container">
        
          <a href="#" id="scroll" style="display: none;"><span></span></a>
        
        <div class="col-xs-12 topmenu" style="text-align:left;"><small>
        <a href="../en" style="margin-left:2px">English</a> |
         <a href="../" class='droid' style="margin-left:2px">کوردی</a>
  
</small>
    </div>
          <!-- logo -->
          <a class="brand logo" href="index.php" style="margin-top: -5px; float: right;">
		  <img src="../assets/img/logo-ar.png" alt="logo" id="Logo" class="largeLogo"></a>
          <!-- end logo -->
          <!-- top menu -->
                 <div class="navigation" >
            <nav class="droid"  >
              <ul class="nav topnav" style="margin-top: 10px;margin-right: 0px;">
			 
               
			   
			   



              
                
                
                 
                <li class="dropdown">
                  <a href="contact.php" style='font-size:11px;padding-left: 8px;padding-right: 8px;'>اتصل بنا</a>
                </li>
				
				
				
				<li class="dropdown">
                  <a href="faq.php" style='font-size:11px;padding-left: 8px;padding-right: 8px;'>الاسئلة الاکثر تکرارا</a>
                </li>
				
				
				
				<li class="dropdown">
                  <a href="news-activities.php" style='font-size:11px;padding-left: 8px;padding-right: 8px;'>الاخبار والنشاطات</a>
                </li>
				
				
				
				
				
				
				
				
				<li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from general_information where language_id=3 and publish_id=1 and info_id =7" );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  

                  print"<a href=info-detail.php?inid=7 style='font-size:11px;padding-left: 8px;padding-right: 8px;'>تعرف علی عیونك</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from general_information where language_id=3 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=info-detail.php?inid=".$row1['info_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				
				
				
				
				
				
				
				  <li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from your_visit where language_id=3 and publish_id=1 and visit_id =6 " );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  

                  print"<a href=visit-detail.php?vid=6 style='font-size:11px;padding-left: 8px;padding-right: 8px;'>زیارتك</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from your_visit where language_id=3 and publish_id=1" );
            
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
            
                  $result = $dbh->prepare("SELECT * from surgery where language_id=3 and publish_id=1 and surgery_id =9  " );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  

                  print"<a href=surgery-detail.php?suid=9 style='font-size:11px;padding-left: 8px;padding-right: 8px;'>العملیات الجراحیة</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from surgery where language_id=3 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=surgery-detail.php?suid=".$row1['surgery_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				
		
				
				
				<li class="dropdown">
                  <a href="our-doctors.php" >الطاقم الطبي</a>
                  <ul class="dropdown-menu">

                    <?php
            
                  $result = $dbh->prepare("SELECT * from doctor_cat where publish_id=1" );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                      echo"<li><a href=our-doctors-category.php?dcid=".$row['doctor_cat_id']." class='droid'>".$row['doctor_cat_A']."</a></li>";

                  }
                  ?>
                    
                  </ul>
                </li>
				
				
				
				
				
				<li class="dropdown">
                  <?php
            
                  $result = $dbh->prepare("SELECT * from service where language_id=3 and publish_id=1 and service_id =10" );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  

                  print"<a href=service-detail.php?sid=10 style='font-size:11px;padding-left: 8px;padding-right: 8px;'>الخدمات</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from service where language_id=3 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li><a href=service-detail.php?sid=".$row1['service_id'].">".$row1['title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				
				
				
				 <li class="dropdown">
                  <?php
				  
            
                  $result = $dbh->prepare("SELECT * from about_us where language_id=3 and publish_id=1 and about_id =6  " );
                  $result->execute();
                  $row=$result->fetch(PDO::FETCH_ASSOC);  

                  print"<a href=about-us-detail.php?abid=6 style='font-size:11px;padding-left: 8px;padding-right: 8px;'>من نحن</a>";
                
                ?>
                  <ul class="dropdown-menu">
                    <?php
                    $result1 = $dbh->prepare("SELECT * from about_us where language_id=3 and publish_id=1" );
            
                  $result1->execute();
                  while ($row1 = $result1->fetch()) 
                  {
                      echo"<li ><a href=about-us-detail.php?abid=".$row1['about_id'].">".$row1['tab_title']."</a></li>";

                  }
                  ?>
                  </ul>
                </li>
				
				
				 <li class="dropdown active droid">
                  <a href="index.php" style='font-size:11px;padding-left: 8px;padding-right: 8px;'>الرئیسیة</a>
                </li>
				
				
              </ul>
            </nav>
          </div>
          <!-- end menu -->
		  

        </div>
      </div>
    </div>
  </header>
  <!----------------------------------------------------------->
  <section id="intro">
    <div class="jumbotron masthead">
      <div class="container">
        <!-- slider navigation -->
        <div class="sequence-nav">
          <div class="prev">
            <span></span>
          </div>
          <div class="next">
            <span></span>
          </div>
        </div>
        <!-- end slider navigation -->
        <div class="row" >
          <div class="span12" dir="rtl" >
            <div id="slider_holder">
              <div id="sequence">
                <ul>
                  <!-- Layer 1 -->

              <?php
        
              $result = $dbh->prepare("SELECT * from slideshow where language_id=3 and publish_id=1 order by slide_order desc limit 5 " );
              $result->execute();
              while ($row = $result->fetch()) 
              {
                  print"<li>";
                     print"<div class='info' >";
                      print"<h2 class='droid'>".$row['slide_title']."</h2>";
                        print"<p class='droid'>".$row['short_detail']."</p>";
                          
                        print"<a class='btn btn-success droid' href='".$row['slide_link']."'>اقراء اکثر </a>";
                      print"</div>";
                      print"<img class='slider_img animate-in' src=../assets/img/slides/".$row['slide_image']." alt=''>";
                    print"</li>";
                }
                ?>        
                 
                </ul>
              </div>
            </div>
            <!-- Sequence Slider::END-->
          </div>
        </div>
      </div>
    </div>
  </section>
  
  
  
  
  
  
  
  
   <div>
      <div class="container homeborderbt margin-bottom-20">
      	<div class="row">
        	<div class="span12 " style="direction:rtl;">

           <div class="headline" style='padding:0;margin:0' >
       <h4 style="padding: 10px;margin-bottom:0;font-size:14px" class="droid">الطاقم الطبي</h4>
        </div>
        

            <ul class="thumbnails">

			<?php
		        
  
		

		
			$result1 = $dbh->prepare("select doctor.* , doctor_cat.doctor_cat,doctor_cat.doctor_cat_A
			 from doctor,doctor_cat where 
			 doctor.doctor_cat_id = doctor_cat.doctor_cat_id and 
             doctor.active=1
			 ORDER BY RAND()
			
			LIMIT 4");			
			
			$result1->execute();
           
   
        	for($i=0; $row1 = $result1->fetch(); $i++)
			{
			
			   
			print"<li class='span3'>";
                print"<div class='thumbnail'>";
                  print"<img src=../assets/img/doctors/".$row1['doctor_photo']." />";
                  print"<div class='caption' style='text-align: center;'>";
                    print"<h4 class='droid' style='direction:rtl'><a href=doctor-detail.php?did=".$row1['doctor_id'].">".$row1['fullname_a']."</a></h4>";
                    print"<p style='text-decoration:underline'>";
                     	print "<p class='droid' >".$row1['qualification_a']."</p>";
                     	
                    print"</p>";
                   
                  print"</div>";
                print"</div>";
              print"</li>";	
			  }
			  

 
  ?>            



            </ul>

  
       </div>

  
  
  </div>
  
  
  <div class="row">
     	<div class="span12 " style="direction:rtl;">
  
  
  
  
  
  
  
  
  
  
       <?php
          $result = $dbh->prepare("SELECT * from homepage_activities where language_id=3 and publish_id=1 ORDER BY activities_id DESC LIMIT 2 ");
          $result->execute();
          while ($row = $result->fetch()) 
          { 
            print"<div class='span6 features' style='width: 550px;'>";
            
            print"<h4 dir='rtl' ><i class='".$row['activities_icon']."' style='margin-right: 0;'></i>
			<a href=home-activities-detail.php?aid=".$row['activities_id']." class='droid'>".$row['title']."</a></h4>";
            print"<p class='droid' style='direction: rtl;'>".$row['short_detail']."</p>";
            print"<a href=home-activities-detail.php?aid=".$row['activities_id']." class='droid' style='padding-left: 60px;'>اقراء اکثر </a>";
            print"</div>";

          }
          ?>

</div>

      </div>
      <div class="row">
        <div class="span12">
          <!-- start tagline-->
          <div class="tagline centered">
            <div class="row">
              <div class="span12">
                <div class="tagline_text" ">
                  <h2 class="droid">!البحث</h2>
                  
                </div>
                <div class="btn-toolbar cta">
                 <div class="col-md-12 search">
 <gcse:search class="gsc-control-cse"></gcse:search>
 </div>
                </div>
              </div>
            </div>
          </div>
          <!-- end tagline -->
        </div>
      </div>
      <div class="row">
        <div class="home-posts">
    <div class="span12">
      <div class=" headline"  style='direction:rtl'>
          <h4 style="padding: 10px;margin-bottom:0;font-size:14px" class="droid">اخر الاخبار والنشاطات | <span style="font-size:12px"><a href="news-activities.php">اکثر</a></span></h4>
          
        </div>
   </div>
          <?php
          $result = $dbh->prepare("SELECT * from news_activities where language_id=3 and publish_id=1 ORDER BY news_id DESC LIMIT 4  ");
          $result->execute();
          while ($row = $result->fetch()) 
          { 
            print"<div class='span3' style='float: right;'>";
            print"<div class='post-image thumbnail'>";
            print"<a href=news-detail.php?nid=".$row['news_id'].">";
            print"<img src=../assets/img/activities/news/".$row['photo1']." alt=''>";
            print"</a>";
            print"</div>";
            
            
            print"<div class=entry-body>";
       
             print"<h4 style='margin-bottom: 2px;direction:rtl' class='droid' ><a href=news-detail.php?nid=".$row['news_id'].">".$row['title']."</a></h4>";
             print"</a>";
			  
             print"<p style='margin-bottom: 2px;direction:rtl' class='droid'>".$row['publish_date']."</p>";
             print"<p style='direction:rtl' class='droid'>".$row['short_detail']."</p>";
            print"</div>";
           
            print"</div>";
          }
          ?>
					
          <!--end span3-->
          
            
            <!-- end .entry-meta -->
            
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Footer
 ================================================== -->
 <footer class="footer droid" dir='rtl'>
 
<?php
  include("footer.php");
  ?>
  
    
  </footer>
  
    
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
  
  <!-- Google Search -->
<?php
  include("../assets/js/custom_ar.js");
  ?>

</body>
</html>
