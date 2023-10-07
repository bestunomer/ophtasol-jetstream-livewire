<?php
include('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>  <?php
              if(isset($_REQUEST["sid"]))
               {
                 $sid=$_REQUEST["sid"];
                 if(is_numeric($sid)){
                    $result = $dbh->prepare("SELECT * FROM product WHERE language_id=2 and publish_id=1 and product_id=:sid");
                    $result->execute(array(":sid"=>$sid));
                $row=$result->fetch(PDO::FETCH_ASSOC);
                $count = $result->rowCount();
                    
                       echo  $row['title'];
                      

                    
                   
                 }
             }
              ?> - ئیبن سینا

</title>

   <link rel="icon" href="assets/img/title-logo.png">
  
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="<?php
              if(isset($_REQUEST["sid"])){				  $sid=$_REQUEST["sid"];                 if(is_numeric($sid)){					 $result = $dbh->prepare("SELECT * FROM products WHERE language_id=2 and publish_id=1 and product_id=:sid");                     $result->execute(array(":sid"=>$sid));				     $row=$result->fetch(PDO::FETCH_ASSOC);                     echo $row[title];				 }			  }
?> - ئیبن سینا "/>

  <meta name="description" content=<?php
              if(isset($_REQUEST["sid"])){				  $sid=$_REQUEST["sid"];                 if(is_numeric($sid)){					 $result = $dbh->prepare("SELECT * FROM products WHERE language_id=2 and publish_id=1 and product_id=:sid");                     $result->execute(array(":sid"=>$sid));				     $row=$result->fetch(PDO::FETCH_ASSOC);                     echo $row['detail'];				 }			  }			  ?> />
  <meta name="author" content="ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="assets/img/products/<?php
              if(isset($_REQUEST["sid"])){				  $sid=$_REQUEST["sid"];                  if(is_numeric($sid)){					  $result = $dbh->prepare("SELECT * from products where language_id=2 and publish_id=1 and product_id=:sid");                      $result->execute(array(":sid"=>$sid));				      $row=$result->fetch(PDO::FETCH_ASSOC);					  echo $row[photo];				  }			  }			  ?>"/>
  
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
  <link href="assets/color/default.css" rel="stylesheet">
  
  
   <link href="assets/css/custom_ku.css" rel="stylesheet">
  
  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">  
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
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

<body>
  <header>    <?php include_once 'header.php';?>
  </header>

  <!-- Subhead
================================================== -->
  
  
  <section id="maincontent">
    <div class="container" style="padding-top:15px">
      <div class="row">
	  
	  
	  
	  
	  
	       <div class="span4 droid">
          <aside>
            
            <div class="widget droid">
              <h4 class="droid" align='right'>بەرهەمەکانمان</h4>
              <ul class="cat" dir='rtl'>
               


<?php
              
                  $result = $dbh->prepare("SELECT * FROM products WHERE language_id=2 and publish_id=1 limit 10");
                  $result->execute();
                  $count = $result->rowCount();
                if ($count > 0) 
                { 
                  for($i=0; $row = $result->fetch(); $i++)
                      { 

                                             

			 echo"  <li style='background-image:none' ><a href='product-detail.php?sid=".$row['product_id']."'>".$row['title']."</a></li>";

                    }
                   
                 
             }
              ?>



				              
              </ul>
            </div>
              
           
          </aside>
        </div>
	  
	  
	  
	  
	  
	  
	  
	  
        <div class="span8 droid">
          <div class="well">
            <div class="centered">

              <?php
              if(isset($_REQUEST["sid"]))
               {
                 $sid=$_REQUEST["sid"];
                 if(is_numeric($sid))
                 {
                    $result = $dbh->prepare("SELECT * FROM products WHERE language_id=2 and publish_id=1 and service_id=:sid");
                  $result->execute(array(":sid"=>$sid));
              
                $row=$result->fetch(PDO::FETCH_ASSOC);  
	   
                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                      
                       print"<h3 align='right' class='droid'><a href='product-detail.php?sid=".$row['service_id']."'>".$row['title']."</a></h3>";
                       print"<img src=assets/img/products/".$row['photo']." />";
                       print"<div class=dotted_line></div>";
					   
					   
					   		       echo" <div class='btn-group pull-left'>
            <button type='button' class='btn btn-default pull-right' onclick='zoomout();'>A+</button>
            <button type='button' class='btn btn-default pull-right' onclick='removezoom();'>A</button>
            <button type='button' class='btn btn-default pull-right' onclick='zoomin();'>A-</button>
            </div><br/><br/>";
					  
					   
					   
                       print"<p class='zoom'>".$row['detail']."</p>";
					   
					   
					   
					   
					   if(!empty($row['video']))
					   {
                       echo "<iframe width='100%' height='400px' align='right' src='https://www.youtube.com/embed/".$row['video_link']."?autoplay=0'></iframe>";
					   }

                    }
                   
                 }
             }
              ?>
            
           
                <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
            
			       
            </div>
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
  <script src="../assets/js/script.js?v=20190602134248"></script>
</body>

</html>
