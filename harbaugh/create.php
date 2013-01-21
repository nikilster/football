<?php
  
  //Constants
  $EMAIL_ERROR = -2;
  $MISSING_DATA = -1;
  $NO_POST = 0;
  $SUCCESS = 1;
  
  

  $result = $NO_POST;

  //Check to see if we have a post
  if ($_SERVER['REQUEST_METHOD'] === 'POST')
      //Try to submit
      $result = submitInfo();


  //Checks the data and tries to submit!
  function submitInfo() 
  { 

    global $EMAIL_ERROR, $MISSING_DATA, $NO_POST, $SUCCESS;

     //Post variables
    $IMAGE_URL_KEY = "imageUrl";
    $CAPTION_KEY = "caption";
    $NAME_AND_EMAIL_KEY = "nameAndEmail";
    $COMMENTS_KEY = "comments";

    //Make sure the image url and caption is there
    if(!validInfo($_POST[$IMAGE_URL_KEY],$_POST[$CAPTION_KEY]))
      return $MISSING_DATA;

    //Get Data
    $imageUrl = $_POST[$IMAGE_URL_KEY];
    $caption = $_POST[$CAPTION_KEY];
    $nameAndEmail = $_POST[NAME_AND_EMAIL_KEY];
    $comments = $_POST[$COMMENTS_KEY];

    $data =  "Image Url: $imageUrl \n\n Caption: $caption \n\n";
    $data .= "Name And Email: $nameAndEmail \n\n Comments: $comments";

    $emailResult = sendEmail($data);

    if($emailResult)
      return $SUCCESS;
    else
      return $EMAIL_ERROR;
  }

  //Image + Comment?
  function validInfo($imageUrl, $caption) {
    
    return $imageUrl != NULL && $imageUrl != "" && 
           $caption != NULL && $caption != "";
  }


  function sendEmail($data) {

    //Send mail
    $to = "nikilster@gmail.com";
    $subject = "Submission for Faces of Harbaugh!";
    $message = $data;

    $result = mail($to, $subject, $message);

    return $result;
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Faces of Harbaugh</title>
    
    <!-- Bootstrap -->
    <link href="web/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="web/css/index.css" rel="stylesheet" media="screen">
    <link href="web/css/create.css" rel="stylesheet" media="screen">

    <!-- Open Graph -->
    <meta property="og:title" content="The Faces of Harbaugh" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="http://www.facesofharbaugh.com" />
    <meta property="og:image" content="http://www.facesofharbaugh.com/web/image/pictures/1.jpg" />
    <meta property="og:site_name" content="The Faces of Harbaugh" />
    <meta property="fb:admins" content="1534110256" />
  </head>
  <body>

    <!-- Facebook -->
    <div id="fb-root"></div>
    <script>(function(d, s, id) {
      var js, fjs = d.getElementsByTagName(s)[0];
      if (d.getElementById(id)) return;
      js = d.createElement(s); js.id = id;
      js.src = "//connect.facebook.net/en_US/all.js#xfbml=1";
      fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));</script>

    <!-- Google Analytics -->
    <script type="text/javascript">

      var _gaq = _gaq || [];
      _gaq.push(['_setAccount', 'UA-37650733-1']);
      _gaq.push(['_trackPageview']);

      (function() {
        var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
        ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
        var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
      })();

    </script>

    <div id="wrap">
      <div class="container">

        <div class="header">
          <h1>The Faces of Jim Harbaugh</h1>
          <div class="subheader">
            <div class="like">
              <div class="fb-like" data-href="http://www.facesofharbaugh.com" data-send="true" data-layout="button_count" data-width="90" data-show-faces="true" data-font="arial"></div>
            </div>
            <div class="link">
              <a href="http://www.facesofshaw.com"><h3>Harbaugh vs Shaw</h3></a>
            </div>
            <div class="tweet">
             <a href="https://twitter.com/share" class="twitter-share-button" data-url="http://www.facesofharbaugh.com">Tweet</a>
              <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
            </div>
          </div>
        </div>

        <div class="main">
          
          <?php if($result == $SUCCESS) {?>
            <div class="success">
              Awesome! We got it! We will let you know if we use it!
              <br/>
              <a href="create.php">Submit another one!</a>
              <br/>
              <a href="index.html">Back to Faces of Harbaugh!</a>
            </div>
          
          <?php } 
          
          else { ?>

          <div class="title">
            <h2>Submit your own caption!</h2>
          </div>
          
          <?php if($result == $MISSING_DATA) {?>
            <div class="errorMessage text-warning">
              Please at least submit a picture url and caption!
            </div>
          <?php } ?>

           <?php if($result == $EMAIL_ERROR) {?>
            <div class="errorMessage text-warning">
              Oh no! There was a problem submitting your caption.  
              <br/>
              Please try again or email <a href="mailto:nikilster@gmail.com">nikilster@gmail.com</a>!
            </div>
          <?php } ?>

          <!-- Submit Form -->
          <form class="form-horizontal" method="POST">
              
              <!-- Image Url -->
              <div class="control-group">
                <label class="control-label" for="imageUrl">Image Url</label>
                <div class="controls">
                  <input type="text" id="imageUrl" name="imageUrl" class="input-xlarge" placeholder="ex. http://www.phinnation.com/wp-content/uploads/2011/01/harbaugh.jpg">
                </div>
              </div>

              <!-- Caption -->
              <div class="control-group">
                <label class="control-label" for="caption">Caption</label>
                <div class="controls">
                  <input type="text" id="caption" name="caption" class="input-xlarge" placeholder="ex. Give me my muffins!!!">
                </div>
              </div>

              <!-- Name and Eamil -->
              <div class="control-group">
                <label class="control-label" for="nameAndEmail">Name and Email</label>
                <div class="controls">
                  <input type="text" id="nameAndEmail" name="nameAndEmail" class="input-xlarge" placeholder="ex. Nikil  nikilster@gmail.com">
                </div>
              </div>

              <!-- Comments -->
              <div class="control-group">
                <label class="control-label" for="comments">Any comments for us?</label>
                <div class="controls">
                  <input type="text" id="comments" name="comments" class="input-xlarge" placeholder="ex. Best site ever made!!!">
                </div>
              </div>

              <!-- Submit -->
              <div class="control-group">
                <div class="controls pull-right">
                  <button type="submit" class="btn btn-large btn-primary">Submit!</button>
                </div>
              </div>

          </form>
          
          <?php } //End if ?>

        </div> <!-- End Main -->

      </div><!-- End Container -->

      <div id="push"></div>

    </div><!-- End Wrap-->

    <div id="footer">
      <div class="container">
        <div class="text muted credit">
          Made by <a target="_BLANK" href="http://www.nikilster.com">Nikil</a> and
          <a target="_BLANK" href="http://stanford.edu/~taralv"> Tara</a> &nbsp;
          &middot;
          <a href="mailto:nikilster@gmail.com">Email Us!</a>
          &middot;
          &nbsp; &copy; 2013 &nbsp;
          &middot;
          &nbsp; Images from Google
        </div>
      </div>
    </div>  

    <script src="web/js/jquery-1.8.3.min.js"></script>
    <script src="web/bootstrap/js/bootstrap.min.js"></script>
    <script src="web/js/main.js"></script>
    <script src="web/js/images.js"></script>
    <script src="web/js/jquery.fittext.js"></script>


  </body>
</html>