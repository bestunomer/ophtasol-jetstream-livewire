<style>
@import url(//fonts.googleapis.com/earlyaccess/notokufiarabic.css);
.droid{
font-family: 'Noto Kufi Arabic', sans-serif;
font-size:13px;
}
</style>

<?php
include('connectdb.php');
?>


    <div class="container">
      <div class="row" >
        <div class="span4">
          <div class="widget">
            
            <h4 class="droid">تۆڕی کۆمەڵایەتی</h4>
              <ul class="social-links" style='margin:0'>
              	<?php
			$result1 = $dbh->prepare("SELECT * from contact_us where language_id=2 and publish_id=1 " );
			$result1->execute();
			$row=$result1->fetch(PDO::FETCH_ASSOC);  

	    print"<li><a href=".$row['facebook']." title='Facebook' target='_blank'><i class='icon-rounded icon-32 icon-facebook'></i></a></li>";
        print"<li><a href=".$row['youtube']." title='Youtube' target='_blank'><i class='icon-rounded icon-32 icon-youtube'></i></a></li>";
        print"<li ><a href=".$row['instagram']." title='Instagram' target='_blank'>
        <i class='icon-rounded icon-32 icon-camera-retro'></i>
				</a></li>";                
          ?>
                
              </ul>
              <?php
			$result = $dbh->prepare("SELECT * from about_us where language_id=2 and publish_id=1 and about_id =5" );
			$result->execute();
			$row=$result->fetch(PDO::FETCH_ASSOC);  

             print"<p style='color: #dedede;text-align: justify;'>".$row['short_detail']."</p>";
            
              ?>
          </div>
        </div>
		
		
		
        <div class="span4">
          <div class="widget">
            <h5 class="droid">پەیوەندی کردن</h5>
            <ul class="regular-ku">
            	<?php
			$result = $dbh->prepare("SELECT * from contact_us where language_id=2 and publish_id=1 " );
			$result->execute();
		  $row=$result->fetch(PDO::FETCH_ASSOC);  

              print"<li>کۆڕەک : <span dir='ltr'>".$row['mobile1']."</span></li>";
              print"<li>ئاسیاسێڵ : <span dir='ltr'>".$row['mobile2']."</span></li>";
              print"<li>ئیمێڵ:<a href='mailto:".$row['email']."'>".$row['email']."</a></li>";
              print"<li  style='color: #dedede;' dir='ltr'> کاتەکانی کارکردن: ".$row['working_hours']." </li>";
			  print"<li  class='droid' style='color: #dedede;'>ناونیشان: ".$row['address']."</li>";
          ?>
            </ul>
          </div>
        </div>
		
		
		
		
		
		
		<div class="span4">
          <div class="widget">
       
            <ul class="regular-ku" >
              <li><a href="about-us-detail.php?abid=1">دەربارەی ئێمە</a></li>
              <li><a href="our-doctors.php">تیمی ئێمە</a></li>
              <li><a href="product-detail.php?sid=1">بەرهەمەکانی ئێمە</a></li>
              <li><a href="surgery-detail.php?suid=1">نەشتەرگەری</a></li>
              <li><a href="supplies-detail.php?vid=1">پێداویستی پزیشکی</a></li>
              <li><a href="equipment-detail.php?inid=1">ئامێری پزیشکی</a></li>
              <li><a href="news-activities.php">هەواڵ و چالاکی</a></li>
              <li><a href="contact.php">پەیوەندی کردن</a></li>
            </ul>

          </div>
        </div>
		
		
		
      </div>
    </div>
	
	
	
	
	
	
    <div class="verybottom">
      <div class="container">
        <div class="row" style="margin-bottom: 0;">
          <div class="span6" style="float: right;">
            <p>
              Copyright © <?php echo date('Y');?> ophtasol
            </p>
          </div>
          <div class="span6">
            <div class="credits" style="float: left;">
              
              Powered by <a href="https://www.ophtasol.com/" target="_blank">Ophtasol IT</a>
            </div>
          </div>
        </div>
      </div>
    </div>
