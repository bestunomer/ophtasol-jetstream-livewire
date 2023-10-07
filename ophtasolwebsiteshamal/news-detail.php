<?php
include('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>ئیبن سینا -  <?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=2 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                   echo$row['title'];
				  }
				 }
			   }?></title>
     <link rel="icon" href="assets/img/title-logo.png">

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="ئیبن سینا - <?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=2 and publish_id=1 and news_id=:nid");
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
                $result = $dbh->prepare("SELECT * from news_activities where language_id=3 and publish_id=1 and news_id=:nid");
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
  <meta property="og:image" content="assets/img/<?php
              if(isset($_REQUEST["nid"]))
               {
                 $nid=$_REQUEST["nid"];
                 if(is_numeric($nid))
                 {
                $result = $dbh->prepare("SELECT * from news_activities where language_id=2 and publish_id=1 and news_id=:nid");
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
  <link href="assets/css/bootstrap-ku.css" rel="stylesheet">
  <link href="assets/css/bootstrap-responsive.css" rel="stylesheet">
  <link href="assets/css/flexslider.css" rel="stylesheet">
  <link href="assets/css/docs.css" rel="stylesheet">
  <link href="assets/css/prettyPhoto.css" rel="stylesheet">
  <link href="assets/js/google-code-prettify/prettify.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
  <link href="assets/color/default.css" rel="stylesheet">
  
    
  <link href="assets/css/custom_ku.css" rel="stylesheet">

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-5d31befc1062be36"></script>
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

<body data-spy="scroll" data-target=".bs-docs-sidebar">
  <header>    <?php include_once 'header.php';?>
  </header>

  <!-- Subhead
================================================== -->
 
  
  <section id="maincontent">
    <div class="container" style="padding-top:15px">
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
                $result = $dbh->prepare("SELECT * from news_activities where language_id=2 and publish_id=1 and news_id=:nid");
                $result->execute(array(":nid"=>$nid));
				$row=$result->fetch(PDO::FETCH_ASSOC);  

                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
			  if(!empty($row['photo1']))
			  {
                        echo"<li>";
                        echo"<img src=assets/img/activities/news/".$row['photo1']." />";
                        echo"</li>";
			  }
			  
			   if(!empty($row['photo2']))
			  {
                        echo"<li>";
                        echo"<img src=assets/img/activities/news/".$row['photo2']." />";
                        echo"</li>";
                       
			  }
			   if(!empty($row['photo3']))
			  {
					    echo"<li>";
                        echo"<img src=assets/img/activities/news/".$row['photo3']." />";
                        echo"</li>";
			  }
			   if(!empty($row['photo4']))
			  {
						
						echo"<li>";
                        echo"<img src=assets/img/activities/news/".$row['photo4']." />";
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
					
                      print"<div class='span4 droid' dir='rtl'>";
                      print"<h4 class='droid' align='right'><a href=news-detail.php?nid=".$row['news_id'].">".$row['title']."</a></h4>";
                   
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
 <footer class="footer droid" dir='rtl'>
 
<?php
  include("footer.php");
  ?>
  
    
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
<script src="assets/js/jquery.touchSwipe.min.js"></script>


<script src="assets/js/jquery.fancybox.min.js"></script>


 <?php
  include("assets/js/custom_ku.js");
  ?>
<script src="assets/js/script.js?v=20190602134248"></script>
</body>

</html>
