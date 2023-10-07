<?php
require_once '../connectdb.php';
session_start();
//error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);
 
require_once '../classUser.php';

$reg_user = new USER();


if(isset($_POST['btn-signup'], $_POST['full_name'],$_POST['phone'],$_POST['email'], $_POST['question_cat'],$_POST['subject'],$_POST['message']))
{

 if(empty($_POST['full_name']))
 {
 	$error[] = 'Please enter your full name';
 }
 $full_name = trim($_POST['full_name']);


 if(empty($_POST['phone']))
 {
 	$error[] = 'Please enter valid Phone';
 }
 $phone = trim($_POST['phone']);

 if(empty($_POST['email']) || !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL))
 {
 	$error[] = 'Please enter valid Email.';
 }
 
 $email = trim($_POST['email']);

 if(empty($_POST['question_cat']))
 {
 	$error[] = 'Please choose your message type';
 }
  $question_cat = trim($_POST['question_cat']);

 
 if(empty($_POST['subject']))
 {
 	$error[] = 'Please write your subject';
 }

 $subject = trim($_POST['subject']);
 
 
 if(empty($_POST['message']))
 {
 	$error[] = 'Please write your message';
 }

 $message = trim($_POST['message']);
 

 if(count($error) < 1)
 {

 $ip_address=$ip=$_SERVER['REMOTE_ADDR'];
 $language_id=3;
 


 if($reg_user->register($full_name,$phone,$email,$question_cat, $subject, $message,$ip_address,$language_id))
  {   
    
   
  
$message1 = "     
 Dear Ibinsina Staff,<br>
Please be noted that  $full_name has sent a message via contact form, incase, 
 To contact the user, here is the the  email (<a href='mailto:$email'>$email</a> ).<br>
 The message is:<br>$message.<br>
Best Regards,<br/>
Ibinsina Auto Email Generation";

   $subject1 = "Ibinsina.org - New message";
   $reg_user->send_mail('ibinsinacenter@gmail.com',$email,$message1,$subject1);
   
 
 $msg = "
    <div class='alert alert-success fade in'>
    <a href='#' class='close' data-dismiss='alert'>&times;</a>
    <strong>Success!</strong> شکرا، سوف نتصل بک باقرب وقت ممکن.
     </div>
     ";
  }
  else
  {
   echo "sorry , Query could no execute...";
  }  
  
 
  $_SESSION = array();

// If it's desired to kill the session, also delete the session cookie.
// Note: This will destroy the session, and not just the session data!
if (ini_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
        $params["path"], $params["domain"],
        $params["secure"], $params["httponly"]
    );
}

// Finally, destroy the session.
session_destroy();
 }else
 {
	//error 
 print_r($error);
 print_r($_REQUEST);
 }
}
?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <title>اتصل بنا - ابن سینا</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="اتصل بنا - ابن سینا" />

  <meta name="description" content="Ibinsina Modern eye & retina center" />
  <meta name="author" content="ibinsina Modern eye & retina center" />
  <meta name="Powered By" content="https://chwarsoft.com" />
  <meta property="og:image" content="../assets/img/logo.png"/>
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

  
  
  
<script src='https://www.google.com/recaptcha/api.js'></script>
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
        
      <div div class="col-xs-12 topmenu" style="text-align:left;"><small>
        <a href="../en" style="margin-left:2px">English</a> |
         <a href="../" class='droid' style="margin-left:2px">کوردی</a>
  
</small>
    </div>
          <!-- logo -->
           <a class="brand logo" href="index.php" style="margin-top: -5px; float: right;">
		  <img src="../assets/img/logo-ar.png" alt="logo" id="Logo" class="largeLogo"></a>
         
          <!-- end logo -->
          <!-- top menu -->
                    <div class="navigation">
             <nav class="droid" >
              <ul class="nav topnav" style="margin-top: 10px;margin-right: 0px;">
			                 
                
                 
                 
                <li class="dropdown active">
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
				
				
				 <li class="dropdown  droid">
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
  <!-- Subhead
================================================== -->
  <section id="maincontent" dir='rtl'>
    <div class="jumbotron subhead" id="overview">
      <div class="container" style="padding-top:15px">
        

      <div class="row">
  
        <div class="span8">
<?php
$result = $dbh->prepare("SELECT * from contact_us where language_id=3 and publish_id=1" );
      $result->execute();
      while ($row = $result->fetch()) 
      {
        print $row['google_map'];
      }
        ?>



     
          <form action="" method="post" role="form" class="contactForm" id="reg_form" style="margin-top: 15px;">
   <div class="error">
    <?php
    if(count($error) > 1){
    	echo "<ul>";
        foreach($error as $v){
        	echo "<li>$v</li>";
            
        }
        echo "</ul>";
    }
    
    ?>
    </div>
	
<?php if(!isset($msg))
	 {

	echo"
	
            <div class='row' >
			
			    <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='text' name='phone'  class='form-controlmobilenumber' id='phone'  placeholder='964XXX XXXX ' data-rule='minlen:4'
                  data-msg='اکتب رقم الهاتف' />
                <div class='validation'></div>
              </div>
              
			  
			  <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='text' name='full_name' class='form-control' id='full_name' placeholder='اسم الکامل' data-rule='minlen:4'
                  data-msg='اکتب الاسم الثلاثی' />
                <div class='validation'></div>
              </div>

        
              <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='email' class='form-control' name='email' id='email' placeholder='ایمیل' data-rule='email'
                  data-msg='اکتب ایمیل صحیح' />
                <div class='validation'></div>
              </div>
                

              <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                
                <select class='span4 custom-select'  name='question_cat' required>
                 <option value=''>الاختیارات</option>";
              
                  $result = $dbh->prepare("SELECT * from contact_cat where language_id=3 and publish_id=1" );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<option value='".$row['contact_cat_id']."' >".$row['contact_cat']."</option>";
                }
               
                echo"
				</select>
              </div>
              
              <div class='span8 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='text' class='form-control' name='subject' id='subject' placeholder='موضوع' data-rule='minlen:4'
                  data-msg='اکتب الموضوع' />
                <div class='validation'></div>
              </div>
			  
              <div class='span8 form-group' style='padding-left:15px;padding-right: 0;'>
                <textarea class='form-control' name='message' id='message' rows='5' data-msg='الرسالة'
                  placeholder='اکتب الرسالة هنا'></textarea>
                <div class='validation'></div>
				
                <div class='text-center'>
                  <button class='btn btn-color btn-rounded' type='submit' name='btn-signup'>ارسال</button>
                </div>
				
              </div>
			  
            </div>";
	 }else
		if(isset($msg)) { echo $msg;	} 
	 ?>
			
          </form>

	

 <div id="recaptcha" class="g-recaptcha" data-sitekey="6LfRg64UAAAAAASY_soMezc3Dn4yEyAHY6pjl2Q-" 
    data-callback="bootstrapValidator" data-size="invisible"></div>
  


		  
		  
		  
        </div>
		
		      <div class="span4">
          <aside>
            <div class="widget">
              <h4 class ='droid' align='right'>وسائل الاتصال بنا</h4>
              <ul class ='droid'  align='right'>
                <?php
      $result = $dbh->prepare("SELECT * from contact_us where language_id=3 and publish_id=1" );
      $result->execute();
      while ($row = $result->fetch()) 
      {
                print"<li><label><strong>کورک : </strong></label>
                  <p dir='ltr'>".$row['mobile1']."</p></li>";
                print"<li><label><strong>اسیاسیل : </strong></label>
                  <p dir='ltr'>".$row['mobile2']."</p></li>";
                print"<li><label><strong>ایمیل : </strong></label>
                  <p><a href='mailto:".$row['email']."'>".$row['email']."</a></p></li>";
                print"<li><label><strong>اوقات الدوام : </strong></label>
                  <p>".$row['working_hours']."</p></li>";
                
				
				  print"<li><label><strong>عنوان : </strong></label>
                  <p>".$row['address']."</p></li>";
				
				
              }?>
              </ul>
            </div>
            <div class="widget">
              <h4 class ='droid'  align='right'>شبکات التواصل الاجمتماعی </h4>
              <ul class="social-links" align='right'>
                <?php
      $result->execute();
      while ($row = $result->fetch()) 
      {
        print"<li><a href=".$row['facebook']." title='Facebook' target='_blank'><i class='icon-rounded icon-32 icon-facebook'></i></a></li>";
        print"<li><a href=".$row['youtube']." title='Youtube' target='_blank'><i class='icon-rounded icon-32 icon-youtube'></i></a></li>";
        print"<li ><a href=".$row['instagram']." title='Instagram' target='_blank'>
        <i class='icon-rounded icon-32 icon-camera-retro'></i>
        </a></li>";                
          }?>
              </ul>
            </div>
          </aside>
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

 
 <?php
  include("../assets/js/custom_ar.js");
  ?>
  
  
  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  <!-- Template Custom JavaScript File -->
  <script src="../assets/js/custom.js"></script>

<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src='https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js'></script>
<script src='https://cdnjs.cloudflare.com/ajax/libs/bootstrap-validator/0.4.5/js/bootstrapvalidator.min.js'></script>

<script type="text/javascript">
 
   $(document).ready(function() {
    $('#reg_form').bootstrapValidator({
        // To use feedback icons, ensure that you use Bootstrap v3.1.0 or later
        feedbackIcons: {
            valid: 'fa fa-thumbs-o-up',
            invalid: 'fa fa-times',
            validating: 'fa fa-refresh'
        },
        fields: {
            full_name: {
                validators: {
                        stringLength: {
                        min: 3,
                    },
                        notEmpty: {
                        message: 'اکتب الاسم رجاء'
                    }
                }
            },
			
           
            phone: {
                validators: {
                    notEmpty: {
                        message: 'اکتب رقم الهاتف'
                    },
                   
                }
            },
            
                 subject: {
                validators: {
                    notEmpty: {
                        message: 'اکتب نوع الموضوع'
                    },
                   
                }
            },
			
			     message: {
                validators: {
                    notEmpty: {
                        message: 'اکتب الرسالة'
                    },
                   
                }
            },
			
			
	
    	
			
	 email: {
                validators: {
                    notEmpty: {
                        message: 'اکتب الایمیل'
                    },
                    emailAddress: {
                        message: 'الایمیل غیر معرف'
                    }
                }
            },
					
	
		}
            
            
        })
		
		
	
        .on('success.form.bv', function(e) {
            $('#success_message').slideDown({ opacity: "show" }, "slow") 
			// Do something ...
                $('#reg_form').data('bootstrapValidator').resetForm();
 
            // Prevent form submission
            e.preventDefault();
            // Get the form instance
            var $form = $(e.target);

            // Get the BootstrapValidator instance
            var bv = $form.data('bootstrapValidator');
 
            // Use Ajax to submit form data
            $.post($form.attr('action'), $form.serialize(), function(result) {
                console.log(result);
				 grecaptcha.reset();
            }, 'json');
			
			
        });
});
 
</script>



</html>
