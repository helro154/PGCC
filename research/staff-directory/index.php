<?php

mb_http_output('utf-8');
mb_internal_encoding('utf-8');

try {
   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        throw new Exception("Sorry, Staff Directory is not available in preview.", 1);
    }

// Configuration Options
$documentsSource = '/assets/faculty-search-json//index.json';

error_reporting(E_ALL ^ E_NOTICE);
require_once(realpath($_SERVER['DOCUMENT_ROOT']).'/media/sample-site/site-assets/php/search/php-search.php');

} catch (\UnderflowException $e) {
} catch (\RuntimeException $e) {
} catch (\InvalidArgumentException $e) {
} catch (\LengthException $e) {
} catch(\Exception $e) {
}
?>

<!doctype html>
<!--[if IE 8 ]>    <html class="lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<!-- conditional statements -->
  
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Staff Directory - TERMINALFOUR University</title>
      <!--  Faculty Search -->
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


    <script src="//cdn.jsdelivr.net/jquery/1.11.0/jquery.min.js"></script>
    <script src="//cdn.jsdelivr.net/jquery.ui/1.11.0/jquery-ui.min.js"></script>
    <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.ui/1.11.0/themes/smoothness/jquery-ui.min.css">
    <style>
    /* Overriding styles for autocomplete widget */
    .ui-autocomplete {
      max-height: 250px;
      overflow-y: auto;
      overflow-x: hidden;
    }
    .ui-menu-item:first-child {
      border-bottom: 1px solid black;
      padding-bottom: 5px;
      margin-bottom: 5px;
    }
  </style>
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M5QJJZ');</script>
<!-- End Google Tag Manager -->
 <!-- google analytics -->
    <!-- description -->
    <!-- keywords -->
    
    <!-- course code -->
    <!-- course type -->
    <!-- location -->
    <!-- category -->
    <!-- course accreditation -->
    <!-- start date -->
    <!-- end date -->
    
    <!-- og:title -->
    <!-- og:description -->
    <!-- og:image -->
    <!-- og:type -->
    
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
    </header> <!-- header code -->

  <div class="contain-to-grid sticky">
  
    <nav class="primary-nav top-bar" data-topbar data-options="sticky_on: large">
      
      <ul class="title-area">
        <li class="name"><a href="/"><span class="wai hidden">Home</span></a></li><!-- need to leave this in but empty for menu to function correctly -->
        <li class="toggle-topbar menu-icon"><a href="#"><span>Menu</span></a></li>
      </ul>
      
      <div class="top-bar-section">
        <div class="row collapse">
        <ul class="left large-8 columns">

          <li><a href="/course-hub/">Course Hub</a></li><li><a href="/life-at-t4u/">Life at T4U</a></li><li><span class="currentbranch0"><a href="/research/">Research</a></span></li><li><a href="/alumni/">Alumni</a></li><li><a href="/admissions/">Admissions</a></li> <!-- visible links at level 2 -->
          <li class="show-for-small-only"><a href="#">Student gateway</a></li> <!-- Small screen only main navigation -->

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
 <!-- search box code -->

        </div>
      </div>
      
    </nav>
  </div><!-- /.sticky -->
<div class="emergencynotice" aria-live="assertive"></div>
 <!-- parallax current section -->


<div class="row main-content">
  
      
<!-- breadcrumbs -->    
<div class="row"><div class="small-12 columns">
  <nav class="breadcrumbs">
  <ul><li><a href="/">Home</a></li><li><a href="/research/">Research</a></li><li><a href="/research/staff-directory/">Staff Directory</a></li></ul>
  </nav>
</div>
</div>
  <!-- ./breadcrumbs -->    
  
  
  <div class="small-12 columns">
      <h1>Staff Directory</h1>
    
<!-- end of SM header -->

<!-- -->
<!-- start of SM footer -->
    </div>

    <?php
        // Start benchmarking

        // Initialise our query handler
        try {

				   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Staff Directory is not available in preview.", 1);
    			}
            $queryHandler = QueryHandlerFactory::getInstance('QueryHandler', $_SERVER['QUERY_STRING']);
            $queryHandler->setDontTokenize(array('title', 'department'));
            $queryHandler->setDontRemoveStopwords(array('title'));
            $queryHandler->stemQuery(array('query'));
            $queryHandler->handleQuery();

        // Initialise our search handler and filters
            $search = SearchFactory::getInstance('Search', $documentsSource);
            $substringSearch = FilterFactory::getInstance('FilterBySubstring', $search);
            $wordSearch = FilterFactory::getInstance('FilterByWord', $search);
            $letterComparisonSearch = FilterFactory::getInstance('FilterByLetterComparison', $search);

        if ($queryHandler->isQuerySet('lastname')) {
            $letterComparisonSearch->setMember('element', 'lastname');
            $letterComparisonSearch->setMember('query', $queryHandler->getQueryValue('lastname'));
            $letterComparisonSearch->setMember('startPosition', 0);
            $letterComparisonSearch->setMember('endPosition', 1);
            $letterComparisonSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('type')) {
            $wordSearch->setMember('element', 'type');
            $wordSearch->setMember('query', $queryHandler->getQueryValue('type'));
            $wordSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('title')) {
            $wordSearch->setMember('element', 'title');
            $wordSearch->setMember('query', $queryHandler->getQueryValue('title'));
            $wordSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('department')) {
            $wordSearch->setMember('element', 'department');
            $wordSearch->setMember('query', $queryHandler->getQueryValue('department'));
            $wordSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('query')) {
            $substringSearch->setMember('element', 'firstname');
            $substringSearch->setMember('query', $queryHandler->getQueryValue('query'));
            $substringSearch->setMember('combinationOption', true);
            $substringSearch->runFilter();

            $substringSearch->setMember('element', 'lastname');
            $substringSearch->runFilter();

            $search->combineResults();
        }

        // Get the intersection of multiple result sets if necessary
        $search->intersectDocumentResults();

        // Instantiate the DocumentCollection
            $documentCollection = DocumentCollectionFactory::getInstance('DocumentCollection', $search->getDocuments(), $search->getDocumentResults(), $queryHandler->doQuerysExist());

        // Sort the document results

            $documentCollection->sort('lastname', SORT_ASC);

        // Initialise the Pagination
            $pagination = PaginationFactory::getInstance('Pagination', $documentCollection, $queryHandler, 10);
            $pagination->setMember('ulClass', 'pagination');
            $pagination->setMember('currentPage', '/research/staff-directory/');
            $pagination->setMember('currentPageClass', 'current');
            $pagination->setMember('ellipsisClass', 'unavailable');
            $pagination->setMember('ellipsisGap', 4);

        // Facets
            $categoryFacet = FacetFactory::getInstance('DropdownFacet', $documentCollection, $queryHandler);
            $atozFacet = FacetFactory::getInstance('DropdownFacet', $documentCollection, $queryHandler);

} catch (\UnderflowException $e) {
    //ExceptionFormatter::FormatException($e);
} catch (\RuntimeException $e) {
    //ExceptionFormatter::FormatException($e);
} catch (\InvalidArgumentException $e) {
   // ExceptionFormatter::FormatException($e);
} catch (\LengthException $e) {
    //ExceptionFormatter::FormatException($e);
} catch(\Exception $e) {
   //echo $e->getMessage();
}
    ?>

    <div id="searchForm" class="medium-4 push-8 columns ">
                      <?php
 try {
if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Staff Directory is not available in preview.", 1);
    			}
?>

        <div class="small-12 columns">

            <div class="h3">Refine your Results</div>
        </div>
      

        <?php
            // Facets
           
                $listFacet = FacetFactory::getInstance('ListFacet', $documentCollection, $queryHandler);
                $atozFacet = FacetFactory::getInstance('AtoZFacet', $documentCollection, $queryHandler);
        ?>
         <?php   
} catch (\UnderflowException $e) {
   // ExceptionFormatter::FormatException($e);
} catch (\RuntimeException $e) {
    //ExceptionFormatter::FormatException($e);
} catch (\InvalidArgumentException $e) {
   // ExceptionFormatter::FormatException($e);
} catch (\LengthException $e) {
   // ExceptionFormatter::FormatException($e);
} catch(\Exception $e) {
  // echo $e->getMessage();
}
?>
        <form method="get">
                          <?php
 try {
if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Staff Directory is not available in preview.", 1);
    			}
?>
            <?php
                // Output the current 'keyword' query as hidden input so it's preserved when updating results
                $formatQueryAsHiddenInput = QueryFormatterFactory::getInstance('FormatQueryAsHiddenInput', $queryHandler);
                $formatQueryAsHiddenInput->setMember('excludedQueries', array('cost', 'page', 'paginate', 'type', 'lastname', 'title', 'department'));
                echo $formatQueryAsHiddenInput->format();
            ?>
          
               
            <div class="small-12 columns">
                <div class="panel course-search-widget">
                    <div class="h4">Lastname of Staff</div>
                    <?php
                        $atozFacet->setMember('element', 'lastname');
                        $atozFacet->setMember('facetSource', 'documents');
												$atozFacet->setMember('firstOptionText', 'Select:');
                        $atozFacet->displayFacet();


                    ?>
                </div>
            </div>
            <div class="small-12 columns">
                <div class="panel course-search-widget">
                    <div class="h4">Type</div>
                    <?php
                        $listFacet->setMember('labelClass', 'course-search-label');
                        $listFacet->setMember('element', 'type');
                        $listFacet->setMember('sortingState', true);
                        $listFacet->setMember('multipleValueState', true);
                        $listFacet->setMember('multipleValueSeparator', ', ');
                        $listFacet->setMember('facetSource', 'documents');
                        $listFacet->setMember('capitaliseTerm', true);
                        $listFacet->displayFacet();
                    ?>
                </div>
            </div>
            <div class="small-12 columns">
                <div class="panel course-search-widget">
                    <div class="h4">Title</div>
                    <?php
                        $listFacet->setMember('labelClass', 'course-search-label');
                        $listFacet->setMember('element', 'title');
                        $listFacet->setMember('sortingState', true);
                        $listFacet->setMember('multipleValueState', true);
                        $listFacet->setMember('multipleValueSeparator', ', ');
                        $listFacet->setMember('facetSource', 'documents');
                        $listFacet->setMember('capitaliseTerm', true);
                        $listFacet->displayFacet();
                    ?>
                </div>
            </div>
            <div class="small-12 columns">
                <div class="panel course-search-widget">
                    <div class="h4">Department</div>
                    <?php
                        $listFacet->setMember('labelClass', 'course-search-label');
                        $listFacet->setMember('element', 'department');
                        $listFacet->setMember('sortingState', true);
                        $listFacet->setMember('multipleValueState', true);
                        $listFacet->setMember('multipleValueSeparator', ', ');
                        $listFacet->setMember('facetSource', 'documents');
                        $listFacet->setMember('capitaliseTerm', true);
                        $listFacet->displayFacet();
                    ?>
                </div>
            </div>
            <div class="small-12 columns">
                <div class="panel">
                    <button type="submit" class="button small secondary expand">Update Results</button>
                </div>
            </div>
        </form>
      
          <?php   
} catch (\UnderflowException $e) {
   // ExceptionFormatter::FormatException($e);
} catch (\RuntimeException $e) {
    //ExceptionFormatter::FormatException($e);
} catch (\InvalidArgumentException $e) {
   // ExceptionFormatter::FormatException($e);
} catch (\LengthException $e) {
   // ExceptionFormatter::FormatException($e);
} catch(\Exception $e) {
  // echo $e->getMessage();
}
?>
    </div>


    <div class="medium-8 small-12 pull-4 columns">

<?php try {
   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        throw new Exception("Sorry, Staff Directory is not available in preview.", 1);
    } ?>
<!-- added -->
<div class="small-12">
            <div class="panel course-search-widget">
                <form method="get">
                    <label for="search">Search by Name
                        <input type="text" id="search" name="query" placeholder="e.g. Robert">
                    </label>
                    <button type="submit" class="button small secondary">Search by Name</button>
                </form>
            </div>
        </div>

<!-- added -->





        <table class="results">
          
	<?php if($queryHandler->doQuerysExist() === true) { ?>

            <tr><th>Name</th><th>Type</th><th>Department</th><th>Phone</th></tr>
            <?php
                // Output results using the 'HTMLResult' element in the JSON file
                if ($documentCollection->displayResults('HTMLResult') === false) {
                    echo '<tr><td colspan="4" class="alert alert-error">No staff members found!</td></tr>';
                } 
            ?>
        </table>

        <?php
            // Output pagination links
            $pagination->displayNavigation();
        ?>
      
	<?php } else { ?>
   <tr><td colspan="4" class="message">Use the search box and filters to help find the staff member you're looking for.</td></tr>

	<?php } ?>
            </table>
      <?php 
} catch (\UnderflowException $e) {
    ExceptionFormatter::FormatException($e);
} catch (\RuntimeException $e) {
    ExceptionFormatter::FormatException($e);
} catch (\InvalidArgumentException $e) {
    ExceptionFormatter::FormatException($e);
} catch (\LengthException $e) {
    ExceptionFormatter::FormatException($e);
} catch(\Exception $e) {
   echo $e->getMessage()."<br />"."<br />";
}
?>

    </div>



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
 <!-- footer code -->
    
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
 <!-- footer assets -->

 <!-- Set range slider to current cost -->
 <script>
   jQuery(document).ready(function() {
        function getQueryVariable(variable) {
            var query = window.location.search.substring(1);
            var vars = query.split("&");
            for (var i=0;i<vars.length;i++) {
                var pair = vars[i].split("=");
                if(pair[0] == variable){return pair[1];}
            }
            return(false);
        }
        if (getQueryVariable('courseCost') !== false) {
            //$('.range-slider').foundation('slider', 'set_value', getQueryVariable('courseCost'));
            var courseCostVal = getQueryVariable('courseCost');
            $('.range-slider').val(courseCostVal);
            $('#sliderOutput').html(courseCostVal);

        }
     
     
     	jQuery("#search").on('keyup', function(event) {
			ajaxResults();
		});
		jQuery("#search").on('keydown', function(event) {
			//prevent search submitting form when user hits enter 
			if(event.which == 13) {
				event.preventDefault();
			}
        });

		// ajax loading of content
		jQuery("#searchForm input, #searchForm select, #searchForm range").change(function() {
			ajaxResults();
						
		});

		function ajaxResults(form_original_data) {
  				if (typeof form_original_data === "undefined" || form_original_data === null) { 
					var searchVal = jQuery("#search").serialize();
					var filtersVal = jQuery("#searchForm input:visible, #searchForm select").serialize();
					var form_original_data = searchVal + '&' + filtersVal;
				}

				//search for courses
				jQuery.get('/research/staff-directory/?'+ form_original_data, {}, function(data) {

					var response = jQuery('<div />').html(data);
					var noresults = response.find(".results > h3");
                          
					if(noresults.length > 0) {
						jQuery('.results').html('').append(noresults);
					} else {
						var courses = response.find(".results tbody");
						var pagination = response.find(".results .pagination");

						jQuery('.results').html('').append(courses).append(pagination);
					}

					},"html");
		}
				
		//Hide submit buttons              
		jQuery('input[type=submit], button[type=submit]').each(function() {
		  	jQuery(this).hide();
			var container = jQuery(this).parent().parent();
			//if empty container hide
			if(container.find('input').length == 0) {
				container.hide();
			}
		});
    });
</script>


</body>
</html>