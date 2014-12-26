<?php
/*
Template Name: Contact Us
*/
get_header(); 
if(isset($_POST['submitted'])) {
  if(trim($_POST['contactName']) === '') {
    $nameError = 'Please enter your name.';
    $hasError = true;
  } else {
    $name = trim($_POST['contactName']);
  }

  if(trim($_POST['email']) === '')  {
    $emailError = 'Please enter your email address.';
    $hasError = true;
  } else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
    $emailError = 'You entered an invalid email address.';
    $hasError = true;
  } else {
    $email = trim($_POST['email']);
  }

  if(trim($_POST['comments']) === '') {
    $commentError = 'Please enter a message.';
    $hasError = true;
  } else {
    if(function_exists('stripslashes')) {
      $comments = stripslashes(trim($_POST['comments']));
    } else {
      $comments = trim($_POST['comments']);
    }
  }

  if(!isset($hasError)) {
    $emailTo = of_get_option('contact-email');
    if (!isset($emailTo) || ($emailTo == '') ){
      $emailTo = get_option('admin_email');
    }
    $subject = '[PHP Snippets] From '.$name;
    $body = "Name: $name \n\nEmail: $email \n\nComments: $comments";
    $headers = 'From: '.$name.' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

    wp_mail($emailTo, $subject, $body, $headers);
    $emailSent = true;
  }

}
?>
<div class="row">
  <div class="span9">
  <?php
  if( of_get_option('map-url') ){
    echo '<div class="google-map"><iframe src="' .of_get_option('map-url'). '" width="640" height="480"></iframe></div>';
  } ?>
  <?php while ( have_posts() ) : the_post(); ?>  
   <article id="post-<?php the_ID(); ?>" <?php post_class('page-content post-content-shadow'); ?>>  
      <h1 class="title"><?php the_title(); ?></h1> 
       <div class="page-body"> 
      <?php the_content(); ?>
      <?php if(isset($emailSent) && $emailSent == true) { ?>
      <div class="alert alert-success">
      Thanks, your email was sent successfully.
      </div>
      <?php } else { if(isset($hasError) || isset($captchaError)) { ?>
      <span class="alert alert-error">Sorry, an error occured.</span>
      <?php } ?>
      <form action="<?php the_permalink(); ?>" id="contact-form" method="post">
        <input type="text" name="contactName" id="contactName" value="<?php if(isset($_POST['contactName'])) echo $_POST['contactName'];?>" class="required requiredField" placeholder="Name"/>
        <?php if($nameError != '') { ?>
          <div class="alert alert-error"><?php echo $nameError;?></div>
        <?php } ?>
        <input type="text" name="email" id="email" value="<?php if(isset($_POST['email']))  echo $_POST['email'];?>" class="required requiredField email" placeholder="Email"/>
        <?php if($emailError != '') { ?>
        <div class="alert alert-error"><?php echo $emailError;?></div>
        <?php } ?>
        <textarea name="comments" id="message-contact" rows="20" cols="30" class="required requiredField" placeholder="Message"><?php if(isset($_POST['comments'])) { if(function_exists('stripslashes')) { echo stripslashes($_POST['comments']); } else { echo $_POST['comments']; } } ?></textarea>
        <?php if($commentError != '') { ?>
        <div class="alert alert-error"><?php echo $commentError;?></div>
        <?php } ?>
        <input name="submit" type="submit" class="btn btn-comment" id="submit" value="submit" />
        <input type="hidden" name="submitted" id="submitted" value="true" />
      </form>
      <?php } ?>
      </div>
  </article>
  <?php endwhile; ?>  
  </div>
    <div class="widgets-right">
    <div class="span3">
      <?php get_sidebar(); ?>  
    </div>
    </div>
</div>
<div style="fix-alignment"></div>
<?php get_footer(); ?>