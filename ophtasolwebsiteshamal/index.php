<?php
include('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />

  <title>ئۆفتاسۆل - سەرەتا</title>
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="ئۆفتاسۆل - سەرەتا" />

  <meta name="description" content="ophtasol co. ltd. eye health & vision care" />
  <meta name="author" content="ophtasol co. ltd. eye health & vision care" />
  <meta name="Powered By" content="https://ophtasol.com" />
  <meta property="og:image" content="assets/img/logo-ku.png"/>
  


  
  
  <!-- styles -->
 
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:400italic,400,600,700" rel="stylesheet">
  <link href="assets/css/bootstrap-ku.css" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="assets/css/docs.css" rel="stylesheet">
  <link href="assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/flexslider.css" rel="stylesheet">
  <link href="assets/css/sequence.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  
  
      <link href="assets/css/custom_ku.css" rel="stylesheet">
	  
  <link href="assets/color/default.css" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">

  <!-- fav and touch icons -->
       <link rel="icon" href="assets/img/title-logo.png">

  <link rel="apple-touch-icon-precomposed" sizes="144x144" href="assets/ico/apple-touch-icon-144-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="114x114" href="assets/ico/apple-touch-icon-114-precomposed.png">
  <link rel="apple-touch-icon-precomposed" sizes="72x72" href="assets/ico/apple-touch-icon-72-precomposed.png">
  <link rel="apple-touch-icon-precomposed" href="assets/ico/apple-touch-icon-57-precomposed.png">

  
  

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
    <?php include_once 'header.php';?>
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
        
              $result = $dbh->prepare("SELECT * from slideshow where language_id=2 and publish_id=1 order by slide_order desc limit 5 " );
              $result->execute();
              while ($row = $result->fetch()) 
              {
                  print"<li>";
                     print"<div class='info' >";
                      print"<h2 class='droid'>".$row['slide_title']."</h2>";
                        print"<p class='droid'>".$row['short_detail']."</p>";
                          
                        print"<a class='btn btn-success droid' href='".$row['slide_link']."'>زیاتر بخوێنەوە</a>";
                      print"</div>";
                      print"<img class='slider_img animate-in' src=assets/img/slides/".$row['slide_image']." alt=''>";
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
      <div class="container homeborderbt margin-bottom-20" >
      	<div class="row">
        	<div class="span12 " style="direction:rtl;">

           <div class="headline" style='padding:0;margin:0' >
       <h4 style="padding: 10px;margin-bottom:0;font-size:14px" class="droid">ئەو کۆمپانیایانەی ئێمە نوێنەرایەتیان دەکەین</h4>
        </div>
        

            <ul class="thumbnails">

			<?php
		        
  
		

		
			$result1 = $dbh->prepare("select manufacturers.* , manufacturer_cat.manufacturer_cat,manufacturer_cat.manufacturer_cat_K
			 FROM manufacturers,manufacturer_cat WHERE
			 manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id and 
             manufacturers.active=1
			 ORDER BY RAND()
			
			LIMIT 4");			
			
			$result1->execute();
           
   
        	for($i=0; $row1 = $result1->fetch(); $i++)
			{
			
			   
			print"<li class='span3'>";
                print"<div class='thumbnail'>";
                  print"<img src=assets/img/manufacturers/".$row1['manufacturer_photo']." />";
                  print"<div class='caption' style='text-align: center;'>";
                    print"<h4 class='droid' style='direction:rtl'><a href=manufacturer-detail.php?did=".$row1['manufacturer_id'].">".$row1['fullname_k']."</a></h4>";
                    print"<p style='text-decoration:underline'>";
                     	print "<p class='droid' >".$row1['qualification_k']."</p>";
               
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
          $result = $dbh->prepare("SELECT * from homepage_activities where language_id=2 and publish_id=1 ORDER BY activities_id DESC LIMIT 2 ");
          $result->execute();
          while ($row = $result->fetch()) 
          { 
            print"<div class='span6 features' style='width: 550px;'>";
            
            print"<h4 dir='rtl' ><i class='".$row['activities_icon']."' style='margin-right: 0;'></i>
			<a href=home-activities-detail.php?aid=".$row['activities_id']." class='droid'>".$row['title']."</a></h4>";
            print"<p class='droid' style='direction: rtl;'>".$row['short_detail']."</p>";
            print"<a href=home-activities-detail.php?aid=".$row['activities_id']." class='droid' style='padding-left: 60px;'>زیاتر بخوێنەوە</a>";
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
                  <h2 class="droid">!بگەڕێ بۆ هەربابەتێک کە دەتەوێ</h2>
                  
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
              <h4 style="padding: 10px;margin-bottom:0;font-size:14px" class="droid">دواین هەواڵ و چالاکی| <span style="font-size:12px"><a href="news-activities.php">هەواڵی زیاتر</a></span></h4>
          
        </div>
   </div>
          <?php
          $result = $dbh->prepare("SELECT * from news_activities where language_id=2 and publish_id=1 ORDER BY news_id DESC LIMIT 4  ");
          $result->execute();
          while ($row = $result->fetch()) 
          { 
            print"<div class='span3' style='float: right;'>";
            print"<div class='post-image thumbnail'>";
            print"<a href=news-detail.php?nid=".$row['news_id'].">";
            print"<img src=assets/img/activities/news/".$row['photo1']." alt=''>";
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
  <script src="assets/js/jquery.min.js"></script>
  <script src="assets/js/jquery.easing.js"></script>
  <script src="assets/js/google-code-prettify/prettify.js"></script>
  <script src="assets/js/modernizr.js"></script>
  <script src="assets/js/bootstrap.js"></script>
  <script src="assets/js/jquery.elastislide.js"></script>
  <script src="assets/js/sequence/sequence.jquery-min.js"></script>
  <script src="assets/js/sequence/setting.js"></script>
  <script src="assets/js/jquery.prettyPhoto.js"></script>
  <script src="assets/js/application.js"></script>
  <script src="assets/js/jquery.flexslider.js"></script>
  <script src="assets/js/hover/jquery-hover-effect.js"></script>
  <script src="assets/js/hover/setting.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="assets/js/custom.js"></script>
  
  <!-- Google Search -->
 <?php
  include("assets/js/custom_ku.js");
  ?>

</body>
</html>
