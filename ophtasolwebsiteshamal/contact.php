<?php
require_once 'connectdb.php';
session_start();
//error_reporting(E_ALL);
error_reporting(E_ERROR | E_PARSE);
 
require_once 'classUser.php';

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
 $language_id=2;
 


 if($reg_user->register($full_name,$phone,$email,$question_cat, $subject, $message,$ip_address,$language_id))
  {   
    
   
  
$message1 = "     
 Dear Ophtasol Staff,<br>
Please be noted that  $full_name has sent a message via contact form, incase, 
 To contact the user, here is the the  email (<a href='mailto:$email'>$email</a> ).<br>
 The message is:<br>$message.<br>
Best Regards,<br/>
Ophtasol Auto Email Generation";

   $subject1 = "ophtasol.com - New message";
   $reg_user->send_mail('ophtasol@gmail.com',$email,$message1,$subject1);
   
 
 $msg = "
    <div class='alert alert-success fade in'>
    <a href='#' class='close' data-dismiss='alert'>&times;</a>
    <strong>Success!</strong> سوپاس، بەم زووانە وەڵامت دەدەینەوە.
     </div>
     ";
  }
  else
  {
   echo "sorry , Query couldn't execute...";
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
  <title>پەیوەندی - ئۆفتاسۆل</title>

  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="title" content="پەیوەندی - ئۆفتاسۆل" />

  <meta name="description" content="Ophtasol Co. Ltd. - Eye Health & Vision Care" />
  <meta name="author" content="Ophtasol Co. Ltd. - Eye Health & Vision Care" />
  <meta name="Powered By" content="https://ophtasol.com" />
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
  <header>    <?php include_once 'header.php';?>
  </header>
  <!-- Subhead
================================================== -->
  <section id="maincontent" dir='rtl'>
    <div class="jumbotron subhead" id="overview">
      <div class="container" style="padding-top:15px">
        

      <div class="row">
  
        <div class="span8">
<?php
$result = $dbh->prepare("SELECT * from contact_us where language_id=2 and publish_id=1" );
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
                  data-msg='ژمارەی مۆبایلت بنوسە' />
                <div class='validation'></div>
              </div>
              
			  
			  <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='text' name='full_name' class='form-control' id='full_name' placeholder='ناوی تەواو' data-rule='minlen:4'
                  data-msg='ناوی تەواوت بنوسە' />
                <div class='validation'></div>
              </div>

        
              <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='email' class='form-control' name='email' id='email' placeholder='ئیمێڵ' data-rule='email'
                  data-msg='ئیمێڵێکی تەواو بنوسە' />
                <div class='validation'></div>
              </div>
                

              <div class='span4 form-group' style='padding-left:15px;padding-right: 0;'>
                
                <select class='span4 custom-select'  name='question_cat' required>
                 <option value=''>هەڵبژێرە</option>";
              
                  $result = $dbh->prepare("SELECT * from contact_cat where language_id=2 and publish_id=1" );
                  $result->execute();
                  while ($row = $result->fetch()) 
                  {
                  print"<option value='".$row['contact_cat_id']."' >".$row['contact_cat']."</option>";
                }
               
                echo"
				</select>
              </div>
              
              <div class='span8 form-group' style='padding-left:15px;padding-right: 0;'>
                <input type='text' class='form-control' name='subject' id='subject' placeholder='بابەت' data-rule='minlen:4'
                  data-msg='بابەتەکەت بنوسە' />
                <div class='validation'></div>
              </div>
			  
              <div class='span8 form-group' style='padding-left:15px;padding-right: 0;'>
                <textarea class='form-control' name='message' id='message' rows='5' data-msg='ناماەکەت'
                  placeholder='پەیامەکەت لێرە بنوسە'></textarea>
                <div class='validation'></div>
				
                <div class='text-center'>
                  <button class='btn btn-color btn-rounded' type='submit' name='btn-signup'>پەیامەکەت بنێرە</button>
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
              <h4 class ='droid' align='right'>پەیوەندیمان پێوە بکە</h4>
              <ul class ='droid'  align='right'>
                <?php
      $result = $dbh->prepare("SELECT * from contact_us where language_id=2 and publish_id=1" );
      $result->execute();
      while ($row = $result->fetch()) 
      {
                print"<li><label><strong>کۆڕەک : </strong></label>
                  <p dir='ltr'>".$row['mobile1']."</p></li>";
                print"<li><label><strong>ئاسیاسێڵ : </strong></label>
                  <p dir='ltr'>".$row['mobile2']."</p></li>";
                print"<li><label><strong>ئیمێڵ : </strong></label>
                  <p><a href='mailto:".$row['email']."'>".$row['email']."</a></p></li>";
                print"<li><label><strong>کاتەکانی کارکردن : </strong></label>
                  <p>".$row['working_hours']."</p></li>";
                   print"<li><label><strong>ناونیشان : </strong></label>
                  <p>".$row['address']."</p></li>";
              }?>
              </ul>
            </div>
            <div class="widget">
              <h4 class ='droid'  align='right'>تۆڕی کۆمەڵایەتی</h4>
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
  

  <!-- Contact Form JavaScript File -->
  <script src="contactform/contactform.js"></script>

  

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
                        message: 'تکایە ناوت بنوسە'
                    }
                }
            },
			
           
            phone: {
                validators: {
                    notEmpty: {
                        message: 'تکایە ژمارەی مۆبایل بنوسە'
                    },
                   
                }
            },
            
                 subject: {
                validators: {
                    notEmpty: {
                        message: 'تکایە بابەت بنوسە'
                    },
                   
                }
            },
			
			     message: {
                validators: {
                    notEmpty: {
                        message: 'تکایە پەیامەکەت بنوسە'
                    },
                   
                }
            },
			
			
	
    	
			
	 email: {
                validators: {
                    notEmpty: {
                        message: 'تکایە ئیمێلەکەت بنوسە'
                    },
                    emailAddress: {
                        message: 'ئمێڵەکەت دروست نیە'
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

</body>

</html>
