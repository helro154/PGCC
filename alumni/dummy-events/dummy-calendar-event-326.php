<!doctype html>
<!--[if IE 8 ]>    <html class="lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->


  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="fb:pages" content="532077856961197" />
    <title>Dummy Events: Dummy Calendar Event 326 - TERMINALFOUR University</title>
     <!-- Inner page right nav -->
        <link rel="stylesheet" href="/media/sample-site---php-events-calendar/css/php-blade-calendar.css" /> <!-- calendar.css -->
    <link rel="stylesheet" href="/media/sample-site/site-assets/css/style-local.css" /> <!-- style-local.css -->
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >
    <link rel="stylesheet" href="/media/sample-site/site-assets/css/print.css" type="text/css" media="print" /> <!-- print.css -->
    <!--Slick CSS-->
   <link rel="stylesheet" href="/media/sample-site/site-assets/css/slick.css" /> <!-- slick.css -->
   <link rel="stylesheet" href="/media/sample-site/site-assets/css/slick-theme.css" /> <!-- slick-theme.css -->
 
<link rel="apple-touch-icon" sizes="180x180" href="/media/sample-site/site-assets/images/favicons/apple-touch-icon.png?v=1">
<link rel="icon" type="image/png" href="/media/sample-site/site-assets/images/favicons/favicon-32x32.png?v=1" sizes="32x32">
<link rel="icon" type="image/png" href="/media/sample-site/site-assets/images/favicons/favicon-16x16.png?v=1" sizes="16x16">
<link rel="manifest" href="/media/sample-site/site-assets/images/favicons/manifest.json?v=1">
<link rel="mask-icon" href="/media/sample-site/site-assets/images/favicons/safari-pinned-tab.svg?v=1" color="#990616">
<link rel="shortcut icon" href="/media/sample-site/site-assets/images/favicons/favicon.ico?v=1">
<meta name="msapplication-config" content="/media/sample-site/site-assets/images/favicons/browserconfig.xml?v=1">
<meta name="theme-color" content="#ffffff">

 <!-- header assets -->
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M5QJJZ');</script>
<!-- End Google Tag Manager -->

    <?php
/*   <!-- generate download.php --> */

/* Version 0.1.126 */
$t4_module['config']      = '/alumni/events/calendar/';
$t4_module['allevents']   = '';
$t4_module['module']      = 'Results-Single';
$t4_module['options']     = '';


try {
  //Check if we are in preview
  if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
    throw new Exception("Sorry, PHP Events Calendar is not available in preview.", 1);
  }

  //load T4EventsCalendar
  if(!is_file($_SERVER['DOCUMENT_ROOT']  . $t4_module['config'].'config.php')) {
    throw new Exception("You need to load the T4EventsCalendar Class", 1);
  }

  //load PHAR file
  include_once($_SERVER['DOCUMENT_ROOT']  . $t4_module['config'].'config.php');
  if (in_array($t4_module['module'], array('Results-2Years','Results--5Years','Results-Page','Calendar-Page'))) {
      $moduleClass = T4EventsCalendar::module($t4_config,$t4_module,'Results-Canonical');
      unset($t4_module);
  }

/* Start Catch */
} catch(\Exception $e) {
  echo '<!--'.$e->getMessage().'-->';
}
/* End Catch */
?>
<!--canonical-->
    <!-- description -->
    <!-- keywords -->
     <!-- course code -->
    <!-- course type -->
    <!-- location -->
    <!-- category -->
    <!-- course accreditation -->
    <!-- start date -->
    <meta name="enddate" content="Sat, 11 Mar 2017 21:00:00 EST" /><!-- end date -->
    
    <!-- og:description -->
    <!-- og:image -->
    <meta property="og:type" content="article" /><!-- og:type -->
    
    <!-- article:author -->
    <!-- article:publish_time -->
    <!-- article:section -->
    <!-- article:tag -->
    
    <!-- profile:first_name -->
    <!-- profile:last_name -->
   
  </head>

<body>

<div class="off-canvas-wrap" data-offcanvas>
  <div class="inner-wrap">

          <header class="site-header">
      <div class="row">
        <div class="small-12 small-centered medium-uncentered medium-4 columns">
          <a href="/" title="Home" >
            <img src="/media/sample-site/site-assets/images/t4u-logo.svg" alt="" height="123" width="100%" >
            <span class="wai hidden">Home</span>
          </a>
        </div>
        <div class="small-8 columns text-right hide-for-small-only">
          <div class="header-links clearfix">
            <ul class="inline-list right">
             	<li><a href="/social/">Social Stream</a></li><li><a href="/sitemap.html">Sitemap</a></li><!-- header > top links -->
             	 <!-- language switcher -->
            </ul>
          </div>
          <div class="contact-links clearfix">
            <ul class=" inline-list right">
               <li><span class="fa fa-phone"></span> <a href="tel://+1555123456">+1 555 123 456</a></li>
              <li><span class="fa fa-envelope"></span> <a href="mailto:info&#64;t4u&#46;edu">info&#64;t4u&#46;edu</a></li>
            </ul>
          </div>
        </div>
      </div><!-- row -->
    </header>

  <div class="contain-to-grid sticky">
  
    <nav class="primary-nav top-bar" data-topbar data-options="sticky_on: large">
      
      <ul class="title-area">
        <li class="name"><a href="/"><span class="wai hidden">Home</span></a></li><!-- need to leave this in but empty for menu to function correctly -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>
      
      <div class="top-bar-section">
        <div class="row collapse">
        <ul class="left large-8 columns">

          <li><a href="/course-hub/">Course Hub</a></li><li><a href="/life-at-t4u/">Life at T4U</a></li><li><a href="/research/">Research</a></li><li><span class="currentbranch0"><a href="/alumni/">Alumni</a></span></li><li><a href="/admissions/">Admissions</a></li>
          <li class="show-for-small-only"><a href="#">Student gateway</a></li>

        </ul>

                   <ul class="right large-4 columns hide-for-medium-only">
          <li class="has-form">
            <form action="/search/" method="get">
            <div class="row collapse">
              <div class="small-10 columns">
                 <label for="site-search" class="sr-only">Search</label>
                <input type="text" id="site-search" name="q" placeholder="Search" aria-label="Search" />
              </div>
              <div class="small-2 columns"><button type="submit" class="button expand"><span class="fa fa-search"></span><span class="wai hidden">Search</span></button></div>
            </div>
            </form>
          </li>
        </ul>


        </div>
      </div>
      
    </nav>
  </div><!-- /.sticky -->

<div class="emergencynotice" aria-live="assertive"></div>



<div class="row main-content">
  <div class="small-12 medium-8 columns">

    <!-- breadcrumbs -->
<div class="row">
	<div class="small-12 columns">
		    <nav class="breadcrumbs">
	            <ul><li><a href="/">Home</a></li><li><a href="/alumni/">Alumni</a></li><li><a href="/alumni/dummy-events/">Dummy Events</a></li><li>Dummy Calendar Event 326</li></ul>
            </nav>
	</div>
</div>
<!-- ./breadcrumbs -->

      
    
<!-- end of SM header -->

<article>
  <h1>Dummy Calendar Event 326</h1>
  <p class="meta">
<?php
try {
/* Version 0.1.126 */
  $_GET['event_id'] = '4385';
  $event_type = isset($_GET['event_type']) ? filter_var($_GET['event_type'], FILTER_SANITIZE_STRING) : '';

  //Check if we are in preview
  if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
    throw new Exception("Sorry, PHP Events Calendar is not available in preview.", 1);
  }

  //load T4EventsCalendar
  if(!is_file($_SERVER['DOCUMENT_ROOT']  . $t4_module['config'].'config.php')) {
    throw new Exception("You need to load the T4EventsCalendar Class", 1);
  }

  //load PHAR file
  include_once($_SERVER['DOCUMENT_ROOT']  . $t4_module['config'].'config.php');
  $moduleClass = T4EventsCalendar::module($t4_config,$t4_module);

  /* Start Catch */
} catch(\Exception $e) {
    echo '<!--'.$e->getMessage().'-->';
    ?>
    <time class="sdate" datetime="2017-11-03">March 11, 2017</time><span class="to-date sr-only"> to <time datetime="2017-11-03">March 11, 2017</time></span> - <a href="#location-map">Dummy Event Plaza</a>
    <?php
}
/* End Catch */
?>
  </p>
  <p class="intro">This is a dummy description. Consectetur temporibus illo molestiae unde sunt debitis minima ea a!</p>

  <p>This is the main text for Dummy Calendar Event 326</p> 
<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Minima voluptatum neque aliquam consequatur iusto aut libero vel voluptatem molestiae soluta.</p> 
<p>Ea eligendi, eaque. Adipisci omnis, nemo obcaecati accusantium, voluptatibus cumque amet delectus maxime odit ipsa non alias animi autem ad!</p> 
<p>Dicta libero quis veniam repellat numquam, animi modi, error quo. Voluptatum illum quasi cumque voluptates nesciunt fuga et vero ad!</p> 
<p>Iste adipisci facere cum a deleniti quas consequuntur ut minima, architecto corporis blanditiis sint autem esse fugit at doloremque ducimus?</p>

  <h2 id="h3 location-map">Dummy Event Plaza</h2>
  <div class="row">
    <div class="small-10 small-centered large-12 columns">
      <div id="event-map"></div>
    </div>
  </div><!-- /.row -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCbsBU6J6ivi_YqZkc2XVeyU7hcbj_EHPE&sensor=false"></script>
  <script type="text/javascript">
    function initialize() {
      var myLatlng = new google.maps.LatLng(32.2685214, -97.17768);
      var mapOptions = {
        center: myLatlng,
        zoom: 15
      };
      var map = new google.maps.Map(document.getElementById("event-map"),mapOptions);
      var eventMarker = new google.maps.Marker({
        position: myLatlng,
        map: map,
        animation: google.maps.Animation.DROP
      });
    }
    google.maps.event.addDomListener(window, 'load', initialize);
  </script>
</article>
<div class="ical">
    <a class="button btn btn-default calendar-button" href="<?php echo $t4_module['allevents']; ?>download.php?event_id=4385<?php echo isset($event_type) && !empty($event_type) ? '&event_type='.$event_type : ''; ?>">Download Event to Outlook</a>
</div>
<!-- start of SM footer -->
  </div>



  <div class="small-12 medium-4 columns">
    <nav>
     <header>
    <div class="h4 side-nav-header"><a href="/alumni/">Alumni</a></div>
      </header>
       <ul class="side-nav">
      <li><a href="/alumni/events/">Events</a></li><li><a href="/alumni/news/">News</a></li>
    </ul>
    </nav>
    
          <div class="panel quicklinks is-hidden" id="QL-Undergraduate">

        <div class="h3">UG Quicklinks</div>

        <ul class="side-nav">
           
	      	<li>
				<a href="/course-hub/undergraduate-courses/" >UG Courses</a>
			</li>
		

		
	      	<li>
				<a href="/course-hub/course-catalog-builder/" >Course Catalog</a>
			</li>
		

      	
	      	<li>
				<a href="/life-at-t4u/" >T4U Experience</a>
			</li>
		

      	

		
        </ul>
      </div>      <div class="panel quicklinks is-hidden" id="QL-Default">

        <div class="h3">Quicklinks</div>

        <ul class="side-nav">
           
	      	<li>
				<a href="/life-at-t4u/faq/" >FAQ</a>
			</li>
		

		
	      	<li>
				<a href="/admissions/" >Admissions</a>
			</li>
		

      	
	      	<li>
				<a href="/alumni/events/" >Upcoming Events</a>
			</li>
		

      	
	      	<li>
				<a href="/research/" >Research at T4U</a>
			</li>
		

		
	      	<li>
				<a href="/life-at-t4u/" >Life at T4U</a>
			</li>
		
        </ul>
      </div>      <div class="panel quicklinks is-hidden" id="QL-Postgraduate">

        <div class="h3">PG Quicklinks</div>

        <ul class="side-nav">
           
	      	<li>
				<a href="/life-at-t4u/" >Life at T4U</a>
			</li>
		

		
	      	<li>
				<a href="/alumni/news/" >T4U News</a>
			</li>
		

      	
	      	<li>
				<a href="/alumni/events/" >T4U Events</a>
			</li>
		

      	
	      	<li>
				<a href="/research/" >Research at T4U</a>
			</li>
		

		
	      	<li>
				<a href="/life-at-t4u/campuses/austin/residential-services/" >Residential services</a>
			</li>
		
        </ul>
      </div><div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<div style="margin-bottom: 2em;" class="fb-page" data-href="https://www.facebook.com/TERMINALFOUR" data-tabs="timeline" data-width="350" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><div class="fb-xfbml-parse-ignore"></div></div>
    
  </div><!-- /.medium-3 -->
</div>
  
    <footer class="social-footer">
      <div class="row">
        

<div class="small-12 columns"><div class="h3" >What's New in T4U?</div></div>



        <div class="small-12 medium-4 columns">
                    <div class="soc">
            <div class="h4">Instagram</div>
            <script type="text/javascript" src="/media/sample-site/site-assets/javascript/instafeed.min.js"></script>
            <script type="text/javascript">
                var userFeed = new Instafeed({
                    get: 'user',
                    userId: '4482755543',
                    accessToken: '4482755543.1677ed0.4018b8c47c7444e6b40262b3243bef6d',
                    limit: '4',
                    template: '<a href="{{link}}"><img src="{{image}}" alt="{{caption}}"></a>'
                });
                userFeed.run();
            </script>
            <div id="instafeed"></div>
          </div>
        </div>
        
        <div class="small-12 medium-5 columns">
          <div class="soc twitter-footer">
           <div class="h4">What's New in T4U?</div>
            <a class="twitter-timeline" href="https://twitter.com/TERMINALFOUR" data-widget-id="486091207441793024"  data-tweet-limit="1" data-theme="dark" data-link-color="#fff" data-chrome="nofooter noborders noheader transparent" >Tweets by @TERMINALFOUR</a>
            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
          </div>
        </div>
        
        <div class="small-12 medium-3 columns">
          <div class="soc clearfix">
            <div class="social clearfix">

              
              <a href="https://www.facebook.com/TERMINALFOUR/">
                
                  <img src="/media/sample-site/site-assets/images/footer-social-icons/facebook-square.svg" alt="Facebook Page" width="48" height="48" >
                <span class="wai hidden">Facebook</span>
              </a>
              
              <a href="https://www.twitter.com/TERMINALFOUR/">
                <img src="/media/sample-site/site-assets/images/footer-social-icons/twitter.svg" alt="Twitter Page" width="48" height="48" >
              <span class="wai hidden">Twitter</span>
              </a>
              
              
              <a href="https://www.linkedin.com/company-beta/108396/">
                <img src="/media/sample-site/site-assets/images/footer-social-icons/linkedin.svg" alt="LinkedIn Page" width="48" height="48" >
               
                <span class="wai hidden">LinkedIn</span>

              </a>
              
            </div>
          </div>
        </div>
           
      </div>
    </footer>    
    <footer class="global-footer">
      <div class="row">
        <div class="small-12 large-4 columns">
          <p>&copy; <strong>TERMINAL</strong>FOUR University 2016</p>
        </div>
        <div class="small-12 large-8 columns">
          <ul>
           <li><a href="/course-hub/">Course Hub</a></li><li><a href="/research/">Research</a></li><li><a href="/alumni/">Alumni</a></li><li><a href="/alumni/events/">Events</a></li><li><a href="/life-at-t4u/faq/">FAQ</a></li><li><a href="/demo/">Demo</a></li> <!-- footer bottom links -->
          </ul>
        </div>
      </div>


    </footer>

    
    <a class="exit-off-canvas"></a>
  </div><!-- /.inner-wrap -->
</div><!-- /.off-canvas-wrap -->

      <script src="/media/sample-site/site-assets/javascript/modernizr.js"></script> <!-- modernizr.js -->
    
    <!--[if lt IE 9]>
      <script src="/media/sample-site/site-assets/javascript/html5shiv.min.js"></script> 
      <script src="/media/sample-site/site-assets/javascript/nwmatcher-1.2.5-min.js"></script>
      <script src="/media/sample-site/site-assets/javascript/selectivizr-1.0.3b.js"></script>
      <script src="/media/sample-site/site-assets/javascript/respond.min.js"></script>
      <script type="text/javascript">
          document.expando = true;
      </script>
    <script src="/media/sample-site/site-assets/javascript/jquery1-11.js"></script>
    <script type="text/javascript" src="/media/sample-site/site-assets/javascript/excanvas.js"></script>

<style>
/*course search styling for selectboxes */
#course-category,#course-a-z {padding:9px 0;}

</style>
    <![endif]-->


<script src="/media/sample-site/site-assets/javascript/jquery.min.js"></script> <!-- jquery -->

  <script src="/media/sample-site/site-assets/javascript/foundation.min.js"></script> <!-- foundation.min.js -->
 <script src="/media/sample-site/site-assets/javascript/foundation-datepicker.js"></script> <!-- foundation.datepicker.js -->
  <script src="/media/sample-site/site-assets/javascript/combined-js-files.js"></script> <!-- foundation plugins combined -->
 

  <script src="/media/sample-site/site-assets/javascript/responsive-tables.js"></script> <!-- responsive tables.js -->

  
  <script src="/media/sample-site---php-events-calendar/js/php-events-calendar.js"></script> <!--php-blade-calendar.js --> 
  <script src="/media/sample-site/site-assets/javascript/slick.js"></script> <!--slick.js --> 

  <script src="/media/sample-site/site-assets/javascript/t4-custom.min.js"></script> <!-- t4-custom.min.js --> 


  <!--[if lt IE 9]>
<script src="/media/sample-site/site-assets/javascript/rangeslider.min.js"></script> 
    <script src="/media/sample-site/site-assets/javascript/rem.min.js" type="text/javascript"></script> 

  <script type="text/javascript">
$('.range-slider').rangeslider({

    // Feature detection the default is `true`.
    // Set this to false if you want to use
    // the polyfill also in Browsers which support
    // the native <input type="range"> element.
    polyfill: true,

    // Default CSS classes
    rangeClass: 'rangeslider',
    fillClass: 'rangeslider__fill',
    handleClass: 'rangeslider__handle'

});
</script>



  <![endif]-->



</body>
</html>