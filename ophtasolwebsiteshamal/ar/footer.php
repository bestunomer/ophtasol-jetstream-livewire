<style>

@import url(//fonts.googleapis.com/earlyaccess/notokufiarabic.css);
.droid{
font-family: 'Noto Kufi Arabic', sans-serif;
font-size:13px;
}



</style>

<?php
include('../connectdb.php');
?>


    <div class="container">
      <div class="row" >
        
		
		
	
		
		
		
		
        <div class="span4">
          <div class="widget">
            
            <h4 class="droid">وسائل التواصل الاجتماعی</h4>
              <ul class="social-links" style='margin:0'>
              	<?php
			$result1 = $dbh->prepare("SELECT * from contact_us where language_id=3 and publish_id=1 " );
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
			$result = $dbh->prepare("SELECT * from about_us where language_id=3 and publish_id=1 and about_id =6" );
			$result->execute();
			$row=$result->fetch(PDO::FETCH_ASSOC);  

             print"<p style='color: #dedede;text-align: justify;'>".$row['short_detail']."</p>";
            
              ?>
          </div>
        </div>
		
		
		
        <div class="span4">
          <div class="widget">
            <h5 class="droid">وسائل الاتصال بنا</h5>
            <ul class="regular-ku">
            	<?php
			$result = $dbh->prepare("SELECT * from contact_us where language_id=3 and publish_id=1 " );
			$result->execute();
		  $row=$result->fetch(PDO::FETCH_ASSOC);  

              print"<li>کورک : <span dir='ltr'>".$row['mobile1']."</span></li>";
              print"<li>اسیاسیل : <span dir='ltr'>".$row['mobile2']."</span></li>";
              print"<li>ایمیل:<a href='mailto:".$row['email']."'>".$row['email']."</a></li>";
              print"<li  style='color: #dedede;' dir='ltr'> اوقات الدوام: ".$row['working_hours']."</li>";
			  print"<li  class='droid' style='color: #dedede;'> عنوان: ".$row['address']."</li>";
          ?>
            </ul>
          </div>
        </div>
		
		
		
		
		
		
		<div class="span4">
          <div class="widget">
       
            <ul class="regular-ku" >
              <li><a href="about-us-detail.php?abid=6">من نحن</a></li>
              <li><a href="our-doctors.php">الطاقم الطبي</a></li>
              <li><a href="service-detail.php?sid=10">الخدمات</a></li>
              <li><a href="surgery-detail.php?suid=9">العملیات الجراحیة</a></li>
              <li><a href="visit-detail.php?vid=6">زیارتك</a></li>
              <li><a href="info-detail.php?inid=7">تعرف علی عیونك</a></li>
              <li><a href="news-activities.php">الاخبار والنشاطات</a></li>
              <li><a href="faq.php" >الاسئلة الاکثر تکرارا</a></li>
              <li><a href="contact.php">اتصل بنا</a></li>
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
              Copyright © <?php echo date('Y');?> Ibinsina
            </p>
          </div>
          <div class="span6">
            <div class="credits" style="float: left;">
              
              Powered by <a href="https://chwarsoft.com/" target="_blank">Chwarsoft</a>
            </div>
          </div>
        </div>
      </div>
    </div>
