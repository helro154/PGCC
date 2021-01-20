<?php

/**
 * CourseCompare allows end users to save courses and compare data associated with each course on a single page.
 *
 * Data that is compared is defined within the CourseCompare content type and processed in JSON format.
 * Any Navigation objects required for the application to function are all set within the Config class.
 * No other classes should be edited, unless you are comfortable working with PHP.
 *
 * PHP version 5
 *
 * @package    CourseCompare
 * @author     Dave O'Dwyer <david.odwyer@terminalfour.com>
 * @version    v1.0.0
 */

/**
 *	::::: NOTE NOTE NOTE :::::
 *	courseURL must be added to JSON course SEARCH using :: Section Details / Section Path / Choose the JSON Course Search JSON section
 *   "courseURL": "",
 */

class Config {

	/**
	 *	Navigation object below links to the Course Search JSON section.
	 *
	 *	Nav Details
	 *	-------------------
	 *	Name :: Path to Course Search JSON
	 *	Type :: Section Details
	 *	Display Method :: Specific Section
	 *	Section :: Choose the Course Search JSON section
	 *	Output :: Section Path
	 *
	 **/
	public static $dataSource = "/assets/course-search-json//index.json";

	/**
	 *	Navigation object below links to the Course Comapre Parent Section.
	 *
	 *	Nav Details
	 *	-------------------
	 *	Name :: Course Compare Path
	 *	Type :: Section Details
	 *	Display Method :: Specific Section
	 *	Section :: Choose the Course Compare Parent Section
	 *	Output :: Section Path
	 **/
	public static $course_compare_link = "/course-hub/course-compare/";

	/**
	 *	Navigation object below links to the Course Search Section.
	 *
	 *	Nav Details
	 *	-------------------
	 *	Name :: Course Search Path
	 *	Type :: Section Details
	 *	Display Method :: Specific Section
	 *	Section :: Choose the Course Search Section
	 *	Output :: Section Path
	 **/
	public static $course_search_link = "/course-hub/advanced-course-search/";

	/**
	 *	Navigation object below links to the CourseCompare `text/compare_nodes` formatter
	 *
	 *	Nav Details
	 *	-------------------
	 *	Name :: CourseCompare - JSON Link
	 *	Type :: Related Content Advanced
	 *	Fetch Method :: Use Current
	 *	Use Alternate Content Layout? :: Ticked (YES)
	 *	Alternate Content Layout :: text/compare_nodes
	 **/
	private static $node_json_string = <<<JSON
{"compare": {
    "menuitem": [
{"node_title": "courseOverview", "output_title": "Course Overview"},

{"node_title": "courseType", "output_title": "Course Type"},

{"node_title": "courseLocation", "output_title": "Course Location"},

{"node_title": "courseCost", "output_title": "Course Cost"},

{"node_title": "courseDuration", "output_title": "Course Duration"},

{"node_title": "courseFaculties", "output_title": "Course Faculties"},








    ]
  }
}
JSON;


	/**
	 *	Navigation object below links to "Comparison Page Content" child section
	 *
	 *	Nav Details ::
	 *	Name :: Course Compare - Comparison Page Content
	 * 	Type :: Related Content Advanced
	 *	Fetch Method :: Use Child
	 *	Name of Child Section :: 'Comparison Page Content'
	 *
	 *	NOTE ::	Ensure that there is NO WHITESPACE after "<<<COMPARISON_PAGE_CONTENT" as it will break the PHP.
	 **/
	public static $comparison_page_content = <<<COMPARISON_PAGE_CONTENT

COMPARISON_PAGE_CONTENT;

	/**
	 *	Navigation object below links to "Comparison Page Content" child section
	 *
	 *	Nav Details ::
	 *	Name :: Course Compare - Choose Courses Content
	 * 	Type :: Related Content Advanced
	 *	Fetch Method :: Use Child
	 *	Name of Child Section :: 'Choose Courses Content'
	 *
	 *	NOTE ::	Ensure that there is NO WHITESPACE after "<<<CHOOSE_COURSES_CONTENT" as it will break the PHP.
	 **/
	public static $choose_courses_content = <<<CHOOSE_COURSES_CONTENT

CHOOSE_COURSES_CONTENT;
	
	/**
	 *	Plain text about message alert if you do not select any courses
	 *
	 **/
	public static $no_courses_message = "You haven't saved any courses yet. Please click a course save button to compare courses here.";

	static $dataSourceType = '';

	public static function getComparisonPageContent() {
		return str_replace('"', "\\'", static::$comparison_page_content);
	}


	public static function getChooseCoursesContent() {
		return str_replace('"', "\\'", static::$choose_courses_content);
	}

	// returns the Node JSON file
	private static function getNodeJson() {
		$json = static::$node_json_string;
		$json = CourseData::removeLastComma($json);
		$json = json_decode($json);

		if(json_last_error() === 0) {
			return $json;
		} else {
			die("Error with JSON syntax");
		}
	}

	public static function getCourseDataSource() {
		if(isset(config::$dataSource)) {
			return $_SERVER['DOCUMENT_ROOT'] . config::$dataSource;
		}
	}

	public static function getCourseDataSourceType() {
		if(isset(config::$dataSource)) {
			Config::$dataSourceType = explode('.', config::$dataSource);
			Config::$dataSourceType = Config::$dataSourceType[count(Config::$dataSourceType) - 1];

			return Config::$dataSourceType;

		}
	}

	// returns an array with the nodes to show
	// array[] = $node1
	// array[] = $node2
	public static function getColNodesToShow() {

		$json = static::getNodeJson();
		$data = array();

		foreach($json->compare->menuitem as $node) {
			if(isset($node->node_title) && (trim($node->node_title) !== '')) {
				$data[] = $node->node_title;
			}
		}


		return $data;
	}

	// returns an array with the titles to show
	// indexes relate to the correct node array index obtained from above
	// array[] = $title1
	// array[] = $title2
	public static function getColHeadingsToShow() {

		$json = static::getNodeJson();
		$data = array();

		foreach($json->compare->menuitem as $node) {
			if(isset($node->output_title) && (trim($node->output_title) !== '')) {
				$data[] = $node->output_title;
			}
		}


		return $data;
	}

}


if(!isset($_COOKIE['saved_courses_compare'])) {
	CourseData::setCookie('saved_courses_compare');
}

// instantiate the CourseData class
$course_data = new CourseData();

// Instantiate the CourseList class
$course_list = CompareFactory::getInstance('CourseList', $course_data);


/**
 * Class used to contain all the HTML before output.
 *
 */
class HTMLOutputter {

	static $content;

	static function addHTML($html) {
		static::$content .= $html;
	}

	static function output() {
		echo static::$content;
	}

}

/*
*	Class used to get the course data, process the JSON file and sort the data in an easier to read format.
*	Also contains the methods used to manipulate the COOKIE present in the end users browser.
*	The methods are referenced in other classes.
*	The class is passed from one object to another to prevent dependancy injection.
*/
class CourseData {

	public $data_set_file_type;
	public $data_set_source;
	public $data_set;
	public static $expiry;

	function __construct() {

		$this->data_set_file_type = Config::getCourseDataSourceType();
		$this->data_set_source = Config::getCourseDataSource();

		if($this->data_set_file_type === 'json') {
			$data_set_json = file_get_contents($this->data_set_source);

			// replace any backslash apostrophes
			$this->data_set = str_replace("\'", "'", $data_set_json);

			// replacing trailing comma from JSON string
			$this->data_set = CourseData::removeLastComma($this->data_set);

			// decode the JSON string
			$this->data_set = json_decode($this->data_set);

			// sort the data
			$this->data_set = $this->sort_course_data_json($this->data_set);
		} else if($this->data_set_file_type === 'xml') {
			$this->data_set = simplexml_load_file($this->data_set_source);
			$this->data_set = $this->sort_course_data_xml($this->data_set);
		}

		if(isset($_COOKIE[''])) {
			self::$expiry = json_decode($_COOKIE['saved_courses_compare'])->expiry;
		} else {
			// expire in 30 days
			self::$expiry = time()+60*60*24*30;
		}
	}

	function sort_course_data_xml($data_set) {}


	function sort_course_data_json($data_set) {
		$courses_array = array();

		foreach($data_set as $data) {
			foreach($data as $course_data) {
				if(isset($course_data->contentID)) {
					$courses_array[$course_data->contentID] = (array)$course_data;
				}
			}
		}

		//// var_dump($courses_array);
		return $courses_array;
	}

	function courseExists($courseToAdd) {

		if(!is_array($courseToAdd)) {
			if(!isset($this->data_set[$courseToAdd])) {
				header("Location:" . $_SERVER['HTTP_REFERER']);
				return false;
			}
		} else {
			foreach($courseToAdd as $course_id) {
				if(!isset($this->data_set[$course_id])) {
					return false;
				}
			}
		}

		// if false was't returned, the course IDs exist
		return true;
	}

	function getCol($course_id, $col) {

		if(isset($this->data_set[$course_id][$col])) {
			return $this->data_set[$course_id][$col];
		} else {
			return false;
		}

	}

	function addToCookie($name, $value) {
		$this->expiry = json_decode($_COOKIE[$name])->expiry;
		$new_value = (array)json_decode($_COOKIE[$name]);
		$new_value[$value] = $value;
		setcookie($name, json_encode($new_value), (Int)static::$expiry, '/');
		// die( var_dump($_COOKIE[$name]));
	}

	function removeFromCookie($name, $value) {
		$new_value = array_diff((array)json_decode($_COOKIE['saved_courses_compare']), array($value));
		//var_dump($new_value);
		setcookie($name, json_encode($new_value), (Int)static::$expiry, '/');
	}

	public static function setCookie($name) {
		if(!isset($_COOKIE[$name]) && empty($_COOKIE[$name])) {
			setcookie($name, json_encode(array('expiry' => static::$expiry)), static::$expiry, '/');
		} else {
			return false;
		}
	}

	public static function removeLastComma($json) {

		$position = strrpos($json, ',');

		if ($position !== false) {
			$json = substr_replace($json, '', $position, strlen(','));
		}

		return $json;
	}


}

class CompareFactory {

	public static function getInstance($instance, $course_data, $course_selections = null) {
		switch($instance) {
			case 'Compare':
				return new Compare($course_data, $course_selections);
				break;
			case 'CourseList':
				return new CourseList($course_data);
			default:
				throw new RuntimeException('No instance of '.$instance.' could be created');
				break;
		}
	}
}

class CourseList {

	public $course_data;

	function __construct($course_data) {
		$this->course_data = $course_data;

		$this->processGETRequests();
	}

	function processGETRequests() {

		$get_vars = explode('?', $_SERVER['REQUEST_URI']);

		if(isset($get_vars[1])) {
			$get_vars = $get_vars[1];
			$get_vars = explode('&', $get_vars);
		} else {

			// set get_vars to empty
			$get_vars = array();

			// by default, load saved courses
			$this->viewSavedCourses();
		}


		foreach ($get_vars as $parameter) {
			list($name, $value) = explode('=', $parameter);
			//HTMLOutputter::addHTML('<!-- name 	= ' . $name . ' -->');

			//HTMLOutputter::addHTML( '<!-- value 	= ' . $value . ' -->');

			switch($name) {
				case 'compareCourses':
					if($this->course_data->courseExists($_GET['compare_course'])) {
						return CompareFactory::getInstance('Compare', $this->course_data, $_GET['compare_course']);
					}
					break;
				case 'viewSavedCourses':
					$this->viewSavedCourses();
					break;
				case 'removeAllSavedCourses':
					$this->removeAllSavedCourses();
					break;
				case 'addCourse':
					$courseToAdd = $value;
					if($this->course_data->courseExists($courseToAdd)) {
						$this->addCourse($courseToAdd);
					} else {
						//var_dump($this->data_set);
						die("An error occurred.");
					}
					break;
				case 'removeCourse':
					$courseToRemove = $value;
					$this->removeCourse($courseToRemove);
					break;

				//// var_dump($_COOKIE['saved_courses_compare']);
			}

		}
	}

	function removeCourse($courseToRemove) {

		if(array_search($courseToRemove, (array)json_decode($_COOKIE['saved_courses_compare'])) !== false) {
			$this->course_data->removeFromCookie('saved_courses_compare', $courseToRemove);
		} else {
			//	var_dump($_COOKIE['saved_courses_compare']);
		}

		header("Location:" . $_SERVER['HTTP_REFERER']);

	}

	function removeAllSavedCourses() {
		unset($_COOKIE['saved_courses_compare']);
		CourseData::setCookie('saved_courses_compare');
		header("Location:" . $_SERVER['HTTP_REFERER']);
	}

	function viewSavedCourses() {

		if(isset($_COOKIE['saved_courses_compare']) && (count((array)json_decode($_COOKIE['saved_courses_compare'])) >= 1)) {

			$html = Config::getChooseCoursesContent();
			$html .= "<p class='compare_error'>The maximum number of courses you can compare at a time is 3.</p>";
			$html .= '<form id="course_compare_form" method="GET">';
			$html .= '<input type="hidden" value="true" name="compareCourses">';

			$saved_courses_array = (array)json_decode($_COOKIE['saved_courses_compare']);
			unset($saved_courses_array['expiry']);

			$html .= '<div class="courses_loader"><div class="fa fa-spinner fa-spin"></div></div><table class="course_compare_saved" style="width: 100%;"><tr><th>Course Name</th><th class="small_col_centered">Code</th><th class="small_col_centered">Compare</th><th class="small_col_centered">Remove</th></tr>';
			foreach($saved_courses_array as $course_id) {
				if($course_name = $this->courseName($course_id)) {
					$course_url = $this->courseURL($course_id);
					$html .= '<tr class="compare_row">';
					$html .= '<td><label for="course-' . $course_id . '">' .($course_url!=false ? '<a href="'.$course_url.'" class="rd">'  : ''). $course_name .($course_url!=false ? '</a>'  : ''). '</label></td>';
					$html .= '<td class="small_col_centered"><span class="saved_coures_code">' . $this->course_data->getCol($course_id, 'courseCode') . '</span></td>';
					$html .= '<td class="small_col_centered"><input type="checkbox" id="course-' .$course_id . '" name="compare_course[]" value="' . $course_id . '"></td>';
					$html .= '<td class="small_col_centered course_compare_remove"><a href="' . Config::$course_compare_link . '?removeCourse=' .$course_id . '" class="course-' .$course_id . '"><span class="fa fa-times"></span></a></td>';
					$html .= '</tr>';
				}
			}
			$html .= '</table>';
			$html .= '<a href="' . Config::$course_search_link . '" class="button add-more-courses" type="button">Add More Courses</a>';
			$html .= '<input class="button disabled" type="submit" value="Compare Selected Courses"></form>';

			HTMLOutputter::addHTML($html);

		} else {
			$html =Config::$no_courses_message;
			$html .= '<a href="' . Config::$course_search_link . '" class="button add-more-courses" type="button">Add More Courses</a>';
			HTMLOutputter::addHTML( $html );
		}
	}

	function addCourse($courseToAdd) {

		$this->course_data->setCookie('saved_courses_compare');

		if(array_search($courseToAdd, (array)json_decode($_COOKIE['saved_courses_compare'])) === false) {
			if($this->course_data->courseExists($courseToAdd)) {
				$this->course_data->addToCookie('saved_courses_compare', $courseToAdd);
				// $_COOKIE['saved_courses_compare'][] = $courseToAdd;
			}
		}

		header("Location:" . $_SERVER['HTTP_REFERER']);
	}

	function courseName($course_id) {


		if(isset($this->course_data->data_set[$course_id]['courseName'])) {
			return $this->course_data->data_set[$course_id]['courseName'];
		}

		return false;

	}

	function courseURL($course_id) {


		if(isset($this->course_data->data_set[$course_id]['courseURL'])) {
			return $this->course_data->data_set[$course_id]['courseURL'];
		}

		return false;

	}

}


class Compare {

	public $course_data;

	function __construct($course_data, $course_selections) {

		$this->course_data = $course_data;

		if(is_array($course_selections) and !empty($course_selections) && count($course_selections) >= 2) {
			$this->compare_courses($course_selections);
		} else {
			HTMLOutputter::addHTML( 'You must choose more than one course to compare.' );
		}

	}

	public function compare_courses($course_selections) {

		$cols_to_show = Config::getColNodesToShow();
		$col_headings = Config::getColHeadingsToShow();

		$html = "<div class='row'>";
		$html .= "<div class='column small-12 medium-12'>";

		$html .= Config::getComparisonPageContent();

		$html .= "</div><div class='column small-12 medium-6 text-left'>";
		$html .= "<a class='button view_saved_c_btn' href='" . Config::$course_compare_link . "'>Back to Saved Courses</a></div>";

		$html .= <<<HTML
		<div class='column small-12 medium-6 expand-container text-right'>
			<a href='#' class='button excol expand-all'><span class='fa fa-expand'></span> Expand All</a>
			<a href='#' class='button excol collapse-all hidden'><span class='fa fa-compress'></span> Collapse All</a>
		</div>
HTML;
		$html .= '</div>';
		$html .= "<p>You are currently comparing the following courses: ";

		$course_selects_count = 1;
		if(count($course_selections) > 0 ) {
			$html .= "<ul class='course-compare-list'>";
			foreach($course_selections as $course_id) {
				$html .= "<li><a href='" .  $this->course_data->data_set[$course_id]['courseURL'] . "'>" . $this->course_data->data_set[$course_id]['courseName'] . "</a></li>";


				$course_selects_count++;
			}
			$html .= "</ul>";
		}
		$html .= '</p>';

		

		$html .= '<dl class="accordion course_compare_accordion" data-accordion>';
		$html .= '<dt class="hidden">Course Details</dt>';

		$rand_array = array();

		foreach($col_headings as $index => $heading) {

			$loop = true;
			while($loop) {
				$rand_val = rand(100, 999);
				if(!isset($rand_array[$rand_val])) {
					$rand_array[$rand_val] = '';
					$loop = false;
				}
			}

			$html .= '<dd class="accordion-navigation">
							<a href="#item-' . $rand_val . '">' . $heading . '</a>
							<div id="item-' . $rand_val . '" class="content">

							<table class="responsive cc-compare-table">
								<tr>';
			foreach($course_selections as $course_id) {
				$html .= "<th class=\"cc-data\"><a href='".  $this->course_data->data_set[$course_id]['courseURL'] . "'>". $this->course_data->data_set[$course_id]['courseName'] . "</a></th>";
			}
			$html .= '</tr>';
	          
			foreach($course_selections as $course_id) {
              
				$col = $cols_to_show[$index];

				if(isset($this->course_data->data_set[$course_id][$col]) && !empty($this->course_data->data_set[$course_id][$col])) {
					$html .= '<td class="cc-data">' . $this->course_data->data_set[$course_id][$col] . '</td>';
				} else {
					$html .= '<td class="cc-data">Data not available</td>';
				}
			}
			$html .='</table></div></dd>';
		}

		$html .= '</dl>';


		$html .= "<div class='small-12 medium-6'><a class='button view_saved_c_btn' href='" . Config::$course_compare_link . "'>Back to Saved Courses</a></div>";


		HTMLOutputter::addHTML($html);

	}
}


if(isset($_GET["ajax"])  && $_GET["ajax"] == "on"){
	die();
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
    <title>Course Compare - TERMINALFOUR University</title>
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

  </head>

<body class="course-compare">

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

<div class="row main-content">
  <div class="small-12 medium-9 columns">

    
<!-- breadcrumbs -->    
<div class="row"><div class="small-12 columns">
  <nav class="breadcrumbs">
	<ul><li><a href="/">Home</a></li><li><a href="/course-hub/">Course Hub</a></li><li><a href="/course-hub/course-compare/">Course Compare</a></li></ul>
  </nav>
</div>
</div>
  <!-- ./breadcrumbs -->    
    
    

      <h1>Course Compare</h1>
    
<!-- end of SM header -->

<?php HTMLOutputter::output(); ?><!-- start of SM footer -->
  </div>



  <div class="small-12 medium-3 columns">
	<nav>
      <header>
    	<div class="h4 side-nav-header">
        	<a href="/course-hub/">Course Hub</a>
        </div>
    </header>

    
    <ul class="side-nav">
      <li><a href="/course-hub/undergraduate-courses/">Undergraduate Courses</a></li><li><a href="/course-hub/postgraduate-courses/">Postgraduate Courses</a></li><li><a href="/course-hub/basic-course-search/">Basic Course Search</a></li><li><a href="/course-hub/advanced-course-search/">Advanced Course Search</a></li><li><span class="currentbranch0"><a href="/course-hub/course-compare/">Course Compare</a></span></li><li><a href="/course-hub/course-catalog-builder/">Course Catalog Builder</a></li>
    </ul>
    
    </nav>
    
    <?php
 try {

				   if (preg_match("/t4_([0-9]{16,20}+)\.php/Ui", $_SERVER['REQUEST_URI'] , $output_array)){
        			throw new Exception("Sorry, Course Search is not available in preview.", 1);
    			}
	mb_http_output('utf-8');
	mb_internal_encoding('utf-8');

	// Configuration Options
	$documentsSource = '/assets/course-search-json//index.json';

	require_once(realpath($_SERVER['DOCUMENT_ROOT']).'/media/sample-site/site-assets/php/search/php-search.php');

	// Initialise our query handler
    try {
    	$queryHandler = QueryHandlerFactory::getInstance('QueryHandler', $_SERVER['QUERY_STRING']);
        $queryHandler->handleQuery();
    } catch (RuntimeException $e) {
        ExceptionFormatter::FormatException($e);
    } catch (OutOfBoundsException $e) {
        ExceptionFormatter::FormatException($e);
    }

	// Initialise our search handler and filters
    try {
    	$search = SearchFactory::getInstance('Search', $documentsSource);
    } catch (RuntimeException $e) {
        ExceptionFormatter::FormatException($e);
    } catch (InvalidArgumentException $e) {
        ExceptionFormatter::FormatException($e);
    } catch (LengthException $e) {
        ExceptionFormatter::FormatException($e);
    }

	// Instantiate the DocumentCollection
    try {
    	$documentCollection = DocumentCollectionFactory::getInstance('DocumentCollection', $search->getDocuments(), $search->getDocumentResults(), $queryHandler->doQuerysExist());
    } catch (RuntimeException $e) {
        ExceptionFormatter::FormatException($e);
    } catch (UnderflowException $e) {
        ExceptionFormatter::FormatException($e);
    } catch (InvalidArgumentException $e) {
        ExceptionFormatter::FormatException($e);
    }

	// Facets
    try {
    	$categoryFacet = FacetFactory::getInstance('DropdownFacet', $documentCollection, $queryHandler);
		$levelFacet = FacetFactory::getInstance('DropdownFacet', $documentCollection, $queryHandler);
      	$atozFacet = FacetFactory::getInstance('AtoZFacet', $documentCollection, $queryHandler);
    } catch (RuntimeException $e) {
        ExceptionFormatter::FormatException($e);
    }
?>

	<div class="panel callout course-search-widget">
  		<header>
      	<div class="h4">Course search</div>
      	</header>
  		<form action="/course-hub/basic-course-search/" method="get" class="sidebar-course-search">
    		<div class="row">
      			<div class="small-12 columns">
        			<label for="keyword">Search
          				<input type="text" name="keyword" id="keyword" placeholder="Enter search term" />
        			</label>
      			</div>
    		</div>
    		<div class="row">
      			<div class="small-12 columns">
        			<label>Search by category</label>
          				<?php
                        	$categoryFacet->setMember('element', 'courseDepartments');
                        	$categoryFacet->setMember('id', 'course-category');
                        	$categoryFacet->setMember('isFirstOptionBlank', true);
							$categoryFacet->setMember('firstOptionText', 'All Categories');
                        	$categoryFacet->setMember('sortingState', true);
                        	$categoryFacet->setMember('facetSource', 'documents');
                        	$categoryFacet->setMember('multipleValueState', true);
                        	$categoryFacet->setMember('multipleValueSeparator', ', ');
                        	$categoryFacet->displayFacet();
                    	?>
        			
      			</div>
      			<div class="small-12 columns">
        			<label>Search by A-Z</label>
                      	<?php
							$atozFacet->setMember('element', 'courseName');
							$atozFacet->setMember('id', 'course-a-z');
							$atozFacet->setMember('facetSource', 'documents');
							$atozFacet->setMember('isFirstOptionBlank', true);
							$atozFacet->setMember('firstOptionText', 'All Courses');
							$atozFacet->displayFacet();
						?>
        			
      			</div>
      			<div class="small-12 columns">
        			<label>Course level</label>
          				<?php
                        	$levelFacet->setMember('element', 'courseType');
                        	$levelFacet->setMember('id', 'course-level');
                        	$levelFacet->setMember('isFirstOptionBlank', true);
							$levelFacet->setMember('firstOptionText', 'All Courses');
                        	$levelFacet->setMember('sortingState', true);
                        	$levelFacet->setMember('facetSource', 'documents');
                        	$levelFacet->setMember('multipleValueState', true);
                        	$levelFacet->setMember('multipleValueSeparator', ', ');
                        	$levelFacet->displayFacet();
                    	?>
        			
      			</div>
    		</div><!-- row -->
    		<input type="submit" value="Find a course" class="button small primary expand" />
  		</form>
	</div><!-- /.panel -->
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

		<script type="text/javascript" src="/media/sample-site/site-assets/javascript/course-compare/course-compare.js"></script><!-- Course Compare JS -->
	<script>
			$('.collapse-all').hide();
			$('.expand-all').click(function() {
				$('.accordion-navigation').addClass('active');
				$('.accordion-navigation>div').addClass('active');
				$('.button.excol').toggle();

				return false;
			});
			$('.collapse-all').click(function() {
				$('.accordion-navigation').removeClass('active');
				$('.accordion-navigation>div').removeClass('active');
				$('.button.excol').toggle();

				return false;
			});
		</script>

</body>
</html>