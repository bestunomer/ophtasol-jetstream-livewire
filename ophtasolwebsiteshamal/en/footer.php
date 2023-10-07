<?php
include('../connectdb.php');
?>
<style>

@import url(//fonts.googleapis.com/earlyaccess/notokufiarabic.css);
.droid{
font-family: 'Noto Kufi Arabic', sans-serif;
font-size:13px;
}
Style Attribute {
    font-size: 13px !important;
}


</style>

    <div class="container">
      <div class="row">
        <div class="span4">
          <div class="widget">
       
            <ul class="regular">
              <li><a href="about-us-detail.php?abid=1">About Us</a></li>
			   <li><a href="service-detail.php?sid=1">Services</a></li>
              <li><a href="our-doctors.php">Our Team</a></li>

              <li><a href="surgery-detail.php?suid=1">Surgeries</a></li>
              <li><a href="visit-detail.php?vid=1">Your Visit</a></li>
              <li><a href="info-detail.php?inid=1">Know Your Eyes Better</a></li>
              <li><a href="news-activities.php">News & Activities</a></li>
              <li><a href="faq.php" >FAQs</a></li>
              <li><a href="contact.php">Contact Us</a></li>
            </ul>

          </div>
        </div>
        <div class="span4">
          <div class="widget">
            <h5>Contact Us</h5>
            <ul class="regular">
            	<?php
			$result = $dbh->prepare("SELECT * from contact_us where language_id=1 and publish_id=1 " );
			$result->execute();
		  $row=$result->fetch(PDO::FETCH_ASSOC);  

              print"<li>Korek : ".$row['mobile1']."</li>";
              print"<li>Asiacell : ".$row['mobile2']."</li>";
              print"<li>Email: <a href='mailto:".$row['email']."'>".$row['email']."</a></li>";
              print"<li>Working Hours: ".$row['working_hours']."</li>";
			  print"<li  style='color: #dedede;'>Address: ".$row['address']."</li>";
          ?>
            </ul>
          </div>
        </div>
        <div class="span4">
          <div class="widget">
            
            <h4>Social network</h4>
              <ul class="social-links" style='margin:0'>
              	<?php
			$result1 = $dbh->prepare("SELECT * from contact_us where language_id=1 and publish_id=1 " );
			$result1->execute();
			  $row=$result1->fetch(PDO::FETCH_ASSOC);  

				print"<li><a href=".$row['facebook']." title='Facebook'><i class='icon-rounded icon-32 icon-facebook'></i></a></li>";
				print"<li><a href=".$row['youtube']." title='Youtube'><i class='icon-rounded icon-32 icon-youtube'></i></a></li>";
				print"<li><a href=".$row['instagram']." title='Instagram'>
				<i class='icon-rounded icon-32 icon-camera-retro'></i>
				</a></li>";                
          ?>
                
              </ul>
              <?php
			$result = $dbh->prepare("SELECT * from about_us where language_id=1 and publish_id=1 and about_id =1 " );
			$result->execute();
			  $row=$result->fetch(PDO::FETCH_ASSOC);  

             print"<p style='text-align: justify;'>".$row['short_detail']."</p>";
            
              ?>
          </div>
        </div>
      </div>
    </div>
    <div class="verybottom">
      <div class="container">
        <div class="row" style="margin-bottom: 0;">
          <div class="span6">
            <p>
              Copyright © <?php echo date('Y');?> Ibinsina
            </p>
          </div>
          <div class="span6">
            <div class="credits">
              
              Powered by <a href="https://chwarsoft.com/" target="_blank">Chwarsoft</a>
            </div>
          </div>
        </div>
      </div>
    </div>
