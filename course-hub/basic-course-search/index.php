<?php

mb_http_output('utf-8');
mb_internal_encoding('utf-8');
try {
   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        throw new Exception("Sorry, Basic Course Search is not available in preview.", 1);
    }

// Configuration Options
$documentsSource = '/assets/course-search-json//index.json';
$stopWords = array('/\band\b/is', '/\bof\b/is', '/\bin\b/is', '/\bor\b/is', '/\bwith\b/is', '/\bthe\b/is', '/\bat\b/is');

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


  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="description" content="">
    <title>Basic Course Search - TERMINALFOUR University</title>
      <!-- Inner page left nav -->
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


          <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-M5QJJZ');</script>
<!-- End Google Tag Manager -->

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

          <li><span class="currentbranch0"><a href="/course-hub/">Course Hub</a></span></li><li><a href="/life-at-t4u/">Life at T4U</a></li><li><a href="/research/">Research</a></li><li><a href="/alumni/">Alumni</a></li><li><a href="/admissions/">Admissions</a></li>
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
 <!-- search box code -->

        </div>
      </div>
      
    </nav>
  </div><!-- /.sticky -->
<div class="emergencynotice" aria-live="assertive"></div>
 <!-- current section parallax -->  

<div class="row main-content" id="basic-course-search">
  
      
<!-- breadcrumbs -->    
<div class="row"><div class="small-12 columns">
  <nav class="breadcrumbs">
	<ul><li><a href="/">Home</a></li><li><a href="/course-hub/">Course Hub</a></li><li><a href="/course-hub/basic-course-search/">Basic Course Search</a></li></ul>
  </nav>
</div>
</div>
  <!-- ./breadcrumbs -->    
  
  <div class="small-12 columns">
      <h1>Basic Course Search</h1>
    
<!-- end of SM header -->
<div class="general">
  
  
  <div class="content"><p>Use the tools below to search for the right course for you.</p></div>
</div><!-- start of SM footer -->
    </div>

    <?php

        // Initialise our query handler
       try {

				   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Basic Course Search is not available in preview.", 1);
    			}
            $queryHandler = QueryHandlerFactory::getInstance('QueryHandler', $_SERVER['QUERY_STRING']);
            $queryHandler->setStopWords($stopWords);
            //$queryHandler->setDontTokenize(array('courseDepartments'));
            $queryHandler->stemQuery(array('keyword'));
            $queryHandler->handleQuery();

        // Initialise our search handler and filters
            $search = SearchFactory::getInstance('Search', $documentsSource);
            $substringSearch = FilterFactory::getInstance('FilterBySubstring', $search);
            $wordSearch = FilterFactory::getInstance('FilterByWord', $search);
            $letterComparisonSearch = FilterFactory::getInstance('FilterByLetterComparison', $search);

        if ($queryHandler->isQuerySet('keyword')) {
            $substringSearch->setMember('element', 'courseName');
            $substringSearch->setMember('query', $queryHandler->getQueryValue('keyword'));
            $substringSearch->setMember('combinationOption', true);
            $substringSearch->runFilter();
            $substringSearch->setMember('element', 'courseOverview');
            $substringSearch->runFilter();
            $search->combineResults();
        }

        if ($queryHandler->isQuerySet('courseDepartments')) {
            $wordSearch->setMember('element', 'courseDepartments');
            $wordSearch->setMember('query', $queryHandler->getQueryValue('courseDepartments'));
            $wordSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('courseType')) {
            $wordSearch->setMember('element', 'courseType');
            $wordSearch->setMember('query', $queryHandler->getQueryValue('courseType'));
            $wordSearch->runFilter();
        }

        if ($queryHandler->isQuerySet('courseName')) {
            $letterComparisonSearch->setMember('element', 'courseName');
            $letterComparisonSearch->setMember('query', $queryHandler->getQueryValue('courseName'));
            $letterComparisonSearch->setMember('startPosition', 0);
            $letterComparisonSearch->setMember('endPosition', 1);
            $letterComparisonSearch->runFilter();
        }

        // Get the intersection of multiple result sets if necessary
        $search->intersectDocumentResults();

        // Instantiate the DocumentCollection
            $documentCollection = DocumentCollectionFactory::getInstance('DocumentCollection', $search->getDocuments(), $search->getDocumentResults(), $queryHandler->doQuerysExist());

        // Instantiate our Processors
            $frequencySearch = ProcessorFactory::getInstance('FrequencySearch', $documentCollection);
            $termOrderSearch = ProcessorFactory::getInstance('TermOrderSearch', $documentCollection);
            $proximitySearch = ProcessorFactory::getInstance('ProximitySearch', $documentCollection);
            $queryVolumeSearch = ProcessorFactory::getInstance('QueryVolumeSearch', $documentCollection);
            $radialSearch = ProcessorFactory::getInstance('RadialPatternSearch', $documentCollection);

        // Run the processor(s) if the 'keyword' parameter has been set
        if ($queryHandler->isQuerySet('keyword')) {
            // Finds the frequency of the search term in the courseName and courseOverview JSON elements
            $frequencySearch->setMember('element', 'courseName');
            $frequencySearch->setMember('boost', 1.2);
            $frequencySearch->setMember('query', $queryHandler->getQueryValue('keyword'));
            $frequencySearch->runProcessor();
            $frequencySearch->setMember('boost', 1);
            $frequencySearch->setMember('element', 'courseOverview');
            $frequencySearch->runProcessor();

            // Calculates where the search term(s) appears in the courseName JSON element (the earlier the higher the rank)
            $termOrderSearch->setMember('element', 'courseName');
            $termOrderSearch->setMember('query', $queryHandler->getQueryValue('keyword'));
            $termOrderSearch->runProcessor();

            // Calculates how close the search terms are to each other in the courseOverview JSON element
            $proximitySearch->setMember('element', 'courseOverview');
            $proximitySearch->setMember('query', $queryHandler->getQueryValue('keyword'));
            $proximitySearch->runProcessor();

            // Calculates how much of the courseName JSON element is occupied by the search term(s)
            $queryVolumeSearch->setMember('element', 'courseName');
            $queryVolumeSearch->setMember('query', $queryHandler->getQueryValue('keyword'));
            $queryVolumeSearch->runProcessor();

            // Looks in courseDepartments JSON element to see if the search terms appear there
            $radialSearch->setMember('element', 'courseDepartments');
            $radialSearch->setMember('multipleValueState', true);
            $radialSearch->setMember('multipleValueSeparator', ', ');
            $radialSearch->setMember('boost', 1);
            $radialSearch->runProcessor();

            $documentCollection->combineRankedResults();
        }

        // Sort the document results
            $documentCollection->sort('rank', SORT_DESC, 'courseName', SORT_ASC);
          //$documentCollection->sort('startDate', SORT_DESC);

        // Initialise the Pagination
            $pagination = PaginationFactory::getInstance('Pagination', $documentCollection, $queryHandler, 10);
            $pagination->setMember('ulClass', 'pagination');
            $pagination->setMember('currentPage', '/course-hub/basic-course-search/');
            $pagination->setMember('currentPageClass', 'current');
            $pagination->setMember('ellipsisClass', 'unavailable');
            $pagination->setMember('ellipsisGap', 4);

        // Facets
            $categoryFacet = FacetFactory::getInstance('DropdownFacet', $documentCollection, $queryHandler);
            $atozFacet = FacetFactory::getInstance('AtoZFacet', $documentCollection, $queryHandler);
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

    <div class="small-12 medium-4 columns">
                      <?php
 try {
if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Basic Course Search is not available in preview.", 1);
    			}
?>
        <div class="panel course-search-widget">
            <form method="get">
              	<fieldset>
                  <legend>Search by keyword</legend>
                  	<label for="search" class="hidden">Keyword</label>
                    <input type="text" id="search" name="keyword" placeholder="e.g. media">
                
                <button type="submit" class="button small secondary expand">Search by keyword</button>
                  </fieldset>
            </form>
        </div>
    </div>
    <div class="small-12 medium-4 columns">
        <div class="panel course-search-widget">
            <form method="get">
              	<fieldset>
                  <legend>Search by category</legend>
                    <?php
                        $categoryFacet->setMember('element', 'courseDepartments');
                        $categoryFacet->setMember('id', 'course-category');
                        $categoryFacet->setMember('isFirstOptionBlank', true);
                        $categoryFacet->setMember('sortingState', true);
                        $categoryFacet->setMember('facetSource', 'documents');
                        $categoryFacet->setMember('multipleValueState', true);
                        $categoryFacet->setMember('multipleValueSeparator', ', ');
												$categoryFacet->setMember('firstOptionText', 'Select:');
                        $categoryFacet->displayFacet();
                    ?>
                
                <button type="submit" class="button small secondary expand">Search by topic</button>
                  </fieldset>
            </form>
        </div>
    </div>
    <div class="small-12 medium-4 columns">
        <div class="panel course-search-widget">
            <form method="get">
              	<fieldset>
                <legend>Search by A-Z</legend>
                    <?php
                        $atozFacet->setMember('element', 'courseName');
                        $atozFacet->setMember('id', 'course-a-z');
                        $atozFacet->setMember('facetSource', 'documents');
                        $atozFacet->setMember('isFirstOptionBlank', true);		
												$atozFacet->setMember('firstOptionText', 'Select:');
                        $atozFacet->displayFacet();
                    ?>
                
                <button type="submit" class="button small secondary expand">Search by A-Z</button>
                  </fieldset>
            </form>
        </div>
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

    <div class="small-12 columns">
                           <?php
 try {
if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Basic Course Search is not available in preview.", 1);
    			}
?>
        <table style="width: 100%;">
            <thead>
                <tr>
                    <th>Course</th>
                    <th>Duration</th>
                    <th>Level</th>
                    <th style="width: 150px;">Course code</th>
                    <th style="width: 110px;"><span class="hidden">Actions</span></th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // Output results using the 'HTMLResult' element in the JSON file
                    if ($documentCollection->displayResults('HTMLBasicResult') === false) {
                        echo '<tr><td>No Results Found</td><td></td><td></td><td></td><td></td></tr>';
                    }
                ?>
            </tbody>
        </table>

        <?php
            // Output pagination links
            $pagination->displayNavigation();
        ?>
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


  <div class="small-12 medium-3 columns">
	 <a href="/course-hub/course-compare/?viewSavedCourses=true" class="button">View Saved Courses</a>
  </div>

</div>


    <a class="exit-off-canvas"></a>

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
    <script type="text/javascript" src="/media/sample-site/site-assets/javascript/course-compare/course-compare.js"></script> <!-- Course Compare JS -->
    <script src="//cdn.jsdelivr.net/jquery.ui/1.11.0/jquery-ui.min.js"></script>

<!-- text/scripts-->

<!-- text/scripts-->

 <script>
    $(function() {
        $("#search").autocomplete({
          delay: 400,
          minLength: 3,
          position: {
            my: 'left top',
            at: 'left bottom'
          },
          source: '/media/sample-site/site-assets/php/search/course-search-autocomplete.php',
          response: function (event, ui) {
            // event before the menu opens
          },
          select: function(event, ui) {
            $('#search').val(ui.item.value);
            $('#search').parents('form').trigger('submit');
          }
        });
    });
  </script>

</body>
</html>