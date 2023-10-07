<?php
include('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title><?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from manufacturers,manufacturer_cat 
                        WHERE manufacturers.active=1 and manufacturers.manufacturer_id=:did and
                        manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[fullname];
                }
              }
?> - ئیبن سینا

  
  
  </title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from manufacturers,manufacturer_cat 
                        where   manufacturers.active=1 and manufacturers.manufacturer_id=:did and
                        manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[fullname];
                }
              }
?>  - ئیبن سینا"/>
  <meta name="description" content="<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from manufacturers,manufacturer_cat 
                        where   manufacturers.active=1 and manufacturers.manufacturer_id=:did and
                        manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id");
                  $result->execute(array(":did"=>$did));
				
			      $row=$result->fetch(PDO::FETCH_ASSOC);  
	   
                   echo $row[detail_about_manufacturer_k];
                }
              }
?> "/>
  <meta name="author" content="Ophtasol Co. Ltd. - Eye Health & Vision Care" />
  <meta name="Powered By" content="https://ophtasol.com" />
  <meta property="og:image" content="assets/img/manufacturers/<?php
              if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from manufacturers,manufacturer_cat 
                        where manufacturers.active=1 and manufacturers.manufacturer_id=:did and
                        manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id
                        ");
                $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
               echo $row[manufacturer_photo];
                }
              }
?>"/>
  
  
  
  
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
  
  <link href="assets/css/custom_ku.css" rel="stylesheet">
  

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
    <div class="container">
      <div class="row">
        <div class="span12">
          <article>
            
            <div class="row">
			
			
			
			<div class="span7 droid" align='right' >
                <div class="project-widget droid" >
                  <h4 class='droid' style='font-size:18px'>  پڕۆفایل<i class="icon-48 icon-beaker"></i></h4>
                  <ul class="project-detail" dir='rtl'>
                  <?php
                  if(isset($_REQUEST["did"]))
               {
                 $did=$_REQUEST["did"];
                 if(is_numeric($did))
                 {
                      $result = $dbh->prepare("SELECT * from manufacturers,manufacturer_cat
                        where manufacturers.active=1 and manufacturers.manufacturer_id=:did and
                        manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id
                        ");
						    $result->execute(array(":did"=>$did));
				
				$row=$result->fetch(PDO::FETCH_ASSOC);  
	   
                if(!empty($row['fullname_k']))
				{
                   print"<li><label>ناو :</label> ".$row['fullname_k']."</li>";
				}
				   if(!empty($row['qualification_k']))
				{
                   print"<li><label>بڕوانامە :</label> ".$row['qualification_k']."</li>";
				}
				   if(!empty($row['manufacturer_cat_K']))
				{
                   print"<li><label>پسپۆڕی :</label> ".$row['manufacturer_cat_K']."</li>";
				}
                if(!empty($row['work_mobile']))
				{
                   print"<li dir='rtl'><label>ژمارەی مۆبایل :</label> ".$row['work_mobile']."</li>";
				}
				 if(!empty($row['work_email']))
				{
                   print"<li dir='rtl'><label>ئیمێڵ:</label> <a href=mailto:".$row['work_email'].">".$row['work_email']."</a></li>";
				}

				if(!empty($row['working_hours_k']))
				{  
                   print"<li dir='rtl'><label>ڕۆژانی دەوام لە سەنتەر:</label> ".$row['working_hours_k']."</li>";
				}
				   if(!empty($row['clinic_address_k']))
				{
				   print"<li dir='rtl'><label>ناونیشانی کلینیکی تایبەت:</label> ".$row['clinic_address_k']."</li>";
				}
				   if(!empty($row['clinic_mobile']))
				{
				   print"<li dir='rtl'><label>ژمارەی کلینیکی تایبەت:</label> ".$row['clinic_mobile']."</li>";
				}
				   if(!empty($row['video_link']))
				{
                   print"<li dir='rtl'><label>ڤیدیۆ :</label><a href=".$row['video_link']." target=_blank> ".$row['video_link']."</a></li>";
				}
				 }
			   }
                  ?>
                   <!-- Go to www.addthis.com/dashboard to customize your tools -->
                <div class="addthis_inline_share_toolbox"></div>
                  </ul>
                </div>
              </div>
			
              <div class="span5">


             <?php
              
            
                $count = $result->rowCount();
                  if ($count > 0) 
                  { 
                    
                        print"<img src=assets/img/manufacturers/".$row['manufacturer_photo']." />";
                        print"<p class='droid' align='right'>".$row['detail_about_manufacturer_k']."</p>";

                    
                 
              }
?> 


                 


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


 <?php
  include("assets/js/custom_ku.js");
  ?>
<script src="assets/js/script.js?v=20190602134248"></script>

</body>

</html>
