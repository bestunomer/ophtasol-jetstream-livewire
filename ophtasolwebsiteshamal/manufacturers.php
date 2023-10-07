<?php
include('connectdb.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>نوێنەرایەتی</title>
  
	
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="title" content="نوێنەرایەتی" />
  <meta name="description" content="Ophtasol Co. Ltd. - Healthy Eyes & Sharp Vision" />
  <meta name="author" content="Ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="assets/img/logo.png"/>
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
  <section id="maincontent" >
    
    <div class="container">
           
          <div class="row" style="margin:0">
            <ul class="thumbnails" style="float: right;">

			<?php
		        
  
		   $targetpage = "manufacturers.php"; 	
		   $limit = 12; 

			
			$result = $dbh->prepare("			SELECT COUNT(*) as num
			FROM manufactures		
			WHERE manufacturers.active=1");
			$result->execute();
			$total_pages = $result->fetchColumn();
	
			$stages = 3;
	
			$page =(isset($_GET['page'])) ? (int)$_GET['page'] : 1;
			if($page){
			$start = ($page - 1) * $limit; 
			}else{
			$start = 0;	
			}		
	
				// Get page data
		   
		   
		   

		
			$result1 = $dbh->prepare("			SELECT manufacturers.* , manufacturer_cat.manufacturer_cat,manufacturer_cat.manufacturer_cat_K
			FROM manufacturers,manufacturer_cat			WHERE manufacturers.manufacturer_cat_id = manufacturer_cat.manufacturer_cat_id AND manufacturers.active=1
			ORDER BY manufacturers.manufacturer_order
			LIMIT $start, $limit ");
			$result1->execute();
        	for($i=0; $row1 = $result1->fetch(); $i++)
			{
			
			   
		
			print"<li class='span3' style='float: right;'>";
                print"<div class='thumbnail'>";
                  print"<img src=assets/img/manufacturers/".$row1['manufacturer_photo']." />";
                  print"<div class='caption' style='text-align: center;'>";
                    print"<h4 class='droid' style='direction:rtl'><a href=manufacturer-detail.php?did=".$row1['manufacturer_id'].">".$row1['fullname_k']."</a></h4>";
                    print"<p style='text-decoration:underline'>";
                     	print "<p class='droid' >".$row1['manufacturer_cat_K']."</p>";
						print "<p class='droid' >".$row1['qualification_k']."</p>";
                     	
                    print"</p>";
                   
                  print"</div>";
                print"</div>";
              print"</li>";	
			  }
			  

			  
			  print"</div><br />";
          

 
 
 // Initial page num setup
	if ($page == 0){$page = 1;}
	$prev = $page - 1;	
	$next = $page + 1;							
	$lastpage = ceil($total_pages/$limit);		
	$LastPagem1 = $lastpage - 1;					
	
	
	$paginate = '';
	if($lastpage > 1)
	{	
	

	
		$paginate .= "<div class='paginate'>";
		// Previous
		if ($page > 1){
			$paginate.= "<a href='$targetpage?page=$prev'>Previous</a>";
		}else{
			$paginate.= "<span class='hidden'>Previous</span>";	}
			

		
		// Pages	
		if ($lastpage < 7 + ($stages * 2))	// Not enough pages to breaking it up
		{	
			for ($counter = 1; $counter <= $lastpage; $counter++)
			{
				if ($counter == $page){
					$paginate.= "<span class='current'>$counter</span>";
				}else{
					$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
			}
		}
		elseif($lastpage > 5 + ($stages * 2))	// Enough pages to hide a few?
		{
			// Beginning only hide later pages
			if($page < 1 + ($stages * 2))		
			{
				for ($counter = 1; $counter < 4 + ($stages * 2); $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// Middle hide some front and some back
			elseif($lastpage - ($stages * 2) > $page && $page > ($stages * 2))
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $page - $stages; $counter <= $page + $stages; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
				$paginate.= "...";
				$paginate.= "<a href='$targetpage?page=$LastPagem1'>$LastPagem1</a>";
				$paginate.= "<a href='$targetpage?page=$lastpage'>$lastpage</a>";		
			}
			// End only hide early pages
			else
			{
				$paginate.= "<a href='$targetpage?page=1'>1</a>";
				$paginate.= "<a href='$targetpage?page=2'>2</a>";
				$paginate.= "...";
				for ($counter = $lastpage - (2 + ($stages * 2)); $counter <= $lastpage; $counter++)
				{
					if ($counter == $page){
						$paginate.= "<span class='current'>$counter</span>";
					}else{
						$paginate.= "<a href='$targetpage?page=$counter'>$counter</a>";}					
				}
			}
		}
					
				// Next
		if ($page < $counter - 1){ 
			$paginate.= "<a href='$targetpage?page=$next'>Next</a>";
		}else{
			$paginate.= "<span class='hidden'>Next</span>";
			}
			
		$paginate.= "</div>";		
	
	}


 
 
  ?>            

<?php

echo " <div class='col-center-block'><div class='pagination pagination'>$paginate</div></div>";
?>   

            </ul>
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
  <script src="assets/js/portfolio/jquery.quicksand.js"></script>
  <script src="assets/js/portfolio/setting.js"></script>
  <script src="assets/js/application.js"></script>
  <script src="assets/js/jquery.flexslider.js"></script>
  <script src="assets/js/hover/jquery-hover-effect.js"></script>
  <script src="assets/js/hover/setting.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="assets/js/custom.js"></script>

 <?php
  include("assets/js/custom_ku.js");
  ?>

</body>

</html>