<?php

/**
*	Class file for Prospectus Builder
*	@author Dave O'Dwyer
*	@date 16/05/2014
*
*/

ini_set('display_errors', '0');
error_reporting(E_ALL | E_STRICT);

class Config {

    // Location of the PDF library - Link to the media file in the media library entitled 'PDFMerger.php'
    const PDF_PHP_LIBRARY_FILE = '/media/sample-site/site-assets/php/course-catalog-builder/pdfmerger/PDFMerger.php';

    // Location of the main JSON file - Section details linking to the section that contains the JSON file
    const JSON_FILE = '/course-hub/course-catalog-builder/configuration/prospectus-builder-json/';

	// Location of the main PDF file
    const MAIN_PDF_FILE = '/course-hub/course-catalog-builder/configuration/prospectus-builder-container/UG-Course-Catalog-Master.pdf';
	
     // Name of downloadable PDF (value should not contain '.pdf')
    const PDF_NAME = 'custom-course-catalog';

    // PDF Timestamp
    const PDF_TIMESTAMP = 'd-m-y';

    // Show Lightbox on submission?
    // (SET TO FALSE IF LIGHTBOX AND EMAIL INFORMATION FROM END USER NOT WANTED)
    const SHOW_LIGHTBOX = false;
	
    // Use default prospectus style?
    const USE_DEFAULT_LIGHTBOX_STYLE = false;

    // Compulsory section to be included at all times on a per-section basis
    // Set to blank(string) or false(boolean) if not required
    const COMPULSORY_SECTION = 'Compulsory';

    const FIRST_PAGE_SECTION_NAME = 'First Page';

    const LAST_PAGE_SECTION_NAME = 'Last Page';

    // Only needs to be set if an email is set and lightbox is set to true
    CONST SMTP_HOST = 'treviso.terminalfour.com';

    // Only needs to be set if an email is set and lightbox is set to true
    CONST SMTP_PORT = '25';

    // Only needs to be set if an email is set and lightbox is set to true
    CONST EMAIL_ADDRESS_FROM = 'sample@terminalfour.com';

    // Only needs to be set if an email is set and lightbox is set to true
    // Defines the email addresses to receive an email on client side
    CONST EMAIL_ADDRESS_SITE = 'sample@terminalfour.com';

    /********************
    * Cached Config
    *********************/
    // Location of the CACHED JSON file
    const JSON_CACHED_FILE = 'prospectus-builder-json-cached/';

    // Enable caching or not. Set to false if not required. True by default
    const ENABLE_CACHING = false;

     /********************
    * HTML Config
    *********************/

    // Link to Colorbox Lightbox CSS ##### USE FORMATTER PATH/* #####
    const COLORBOX_CSS = '/media/sample-site/site-assets/php/course-catalog-builder/css/colorbox.css';

    // Link to Colorbox JS ##### USE FORMATTER PATH/* #####
    const COLORBOX_JQUERY ='/media/sample-site/site-assets/php/course-catalog-builder/js/jquery.colorbox.js'; 

    // Name of class container for parent HTML checkboxes
	const HTML_PARENT_CLASS = 'parent-selections';

    // Name of class container for child HTML checkboxes
	const HTML_CHILD_CLASS = 'child-selections';

	const LightboxHeaderText = 'Please enter your email address in the field below';

	public static function getEndUserMessage() {

		return <<<MESSAGE
			<p>This is a HTML message. <span style="text-decoration: underline;"><em><strong>Thanks for downloading the Prospectus!&nbsp;</strong></em></span></p>
MESSAGE;

	}
	
	public static function getEndUserSubject() {
					
		return <<<MESSAGE
			This is the End User Subject - Prospectus
MESSAGE;
	}
	
	
	public static function getUseDefaultLightboxStyle() {
		if(CONFIG::USE_DEFAULT_LIGHTBOX_STYLE) {
			return CONFIG::USE_DEFAULT_LIGHTBOX_STYLE;
		} else {
			return false;
		}
	}
	
	
	public static function getCOLORBOX_CSS() {
		if(CONFIG::COLORBOX_CSS) {
			return CONFIG::COLORBOX_CSS;
		} else {
			return false;
		}
	}

	public static function getCOLORBOX_JQUERY() {
		if(CONFIG::COLORBOX_JQUERY) {
			return CONFIG::COLORBOX_JQUERY;
		} else {
			return false;
		}
	}

	public static function getSMTP_HOST() {
    	if(CONFIG::SMTP_HOST) {
    		return CONFIG::SMTP_HOST;
    	} else {
    		return false;
    	}	
	}
	
	public static function getEmail_Address_From() {
    	if(CONFIG::EMAIL_ADDRESS_FROM) {
    		return CONFIG::EMAIL_ADDRESS_FROM;
    	} else {
    		return false;
    	}	
	}

	public static function getEmail_Address_Site() {
    	if(CONFIG::EMAIL_ADDRESS_SITE) {
    		return CONFIG::EMAIL_ADDRESS_SITE;
    	} else {
    		return false;
    	}	
	}

	public static function getSMTP_PORT() {
    	if(CONFIG::SMTP_PORT) {
    		return CONFIG::SMTP_PORT;
    	} else {
    		return false;
    	}	
	}

    public static function getPROSPECTUS_BUILDER_LOCATION() {
			$prospectus_parent_location = realpath(dirname(__FILE__));
			$prospectus_parent_location = str_replace('\\', '/', $prospectus_parent_location);
			$prospectus_parent_location = explode('/', $prospectus_parent_location);
			array_splice($prospectus_parent_location, count($prospectus_parent_location) - 1);
			$prospectus_parent_location = implode('/', $prospectus_parent_location);
			return $prospectus_parent_location;
    }

    public static function getSHOW_LIGHTBOX() {
    	if(CONFIG::SHOW_LIGHTBOX) {
    		return CONFIG::SHOW_LIGHTBOX;
    	} else {
    		return false;
    	}	
    }

    public static function getCOMPULSORY_SECTION() {
    	if(CONFIG::COMPULSORY_SECTION) {
    		return CONFIG::COMPULSORY_SECTION;
    	} else {
    		return false;
    	}
    }

    public static function getENABLE_CACHING() {
    	if(Config::ENABLE_CACHING === true || Config::ENABLE_CACHING === false ) {
			return Config::ENABLE_CACHING;
    	} else {
    		// default it is off
    		return false;
    	}
    }

    public static function getJSON_CACHED_FILE() {
    	if(Config::JSON_CACHED_FILE) {
            return realpath($_SERVER["DOCUMENT_ROOT"]) . Config::JSON_CACHED_FILE . 'index.json';
	    //return '..' . Config::JSON_CACHED_FILE . 'index.json';
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getJSON_FILE() {
    	if(Config::JSON_FILE) {
            return realpath($_SERVER["DOCUMENT_ROOT"]) . Config::JSON_FILE . 'index.json';
	    //return '..' . Config::JSON_FILE . 'index.json';
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getFirstPage() {
		if(Config::FIRST_PAGE_SECTION_NAME) {
			$first_page = strtolower(Config::FIRST_PAGE_SECTION_NAME);
            return replaceCommasHyphens($first_page);
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getLastPage() {
    	if(CONFIG::LAST_PAGE_SECTION_NAME) {
			$last_page = strtolower(Config::LAST_PAGE_SECTION_NAME);
 			return replaceCommasHyphens($last_page);
    	} else {
    		Config::throw_config_error();
    	}
    }
	
    public static function getHTML_PARENT_CLASS() {
    	if(Config::HTML_PARENT_CLASS) {
    		return Config::HTML_PARENT_CLASS;
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getHTML_CHILD_CLASS() {
    	if(Config::HTML_CHILD_CLASS) {
    		return Config::HTML_CHILD_CLASS;
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getPDF_PHP_LIBRARY_FILE() {
    	if(Config::PDF_PHP_LIBRARY_FILE) {
            return realpath($_SERVER["DOCUMENT_ROOT"]) . Config::PDF_PHP_LIBRARY_FILE;
    	    //return '..' . Config::PDF_PHP_LIBRARY_FILE;
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getMAIN_PDF_FILE() {
	if(Config::MAIN_PDF_FILE) {
            return realpath($_SERVER["DOCUMENT_ROOT"]) . Config::MAIN_PDF_FILE;
    	    //return '..' . Config::MAIN_PDF_FILE;
    	} else {
    		Config::throw_config_error();
    	}
    }

    public static function getPDF_TIMESTAMP() {
    	if(CONFIG::PDF_TIMESTAMP !== '' && CONFIG::PDF_TIMESTAMP !== 'none') {
    		return date(CONFIG::PDF_TIMESTAMP);
    	} else {
    		return false;
    	}
    }

    public static function getPDF_NAME() {
    	if(CONFIG::PDF_NAME && CONFIG::getPDF_TIMESTAMP()) {
    		return CONFIG::PDF_NAME . '-' . CONFIG::getPDF_TIMESTAMP() . '.pdf';
    	} else if (Config::PDF_NAME) {
    		return Config::PDF_NAME . '.pdf';
    	} else {
    		return 'prospectus.pdf';
    	}
    }


    public static function getLightboxHeaderText() {
    	if(CONFIG::LightboxHeaderText) {
    		return CONFIG::LightboxHeaderText;
    	} else {
    		return '';
    	}
    }

    public static function throw_config_error() {
    	die('Unable to obtain data');
    	return null;
    }

}

// END NEW CONFIG

class FormatJSON {

	public $json_data;

	function __construct() {

		$json_file = CONFIG::getJSON_FILE();
		if(file_exists($json_file)) {
			$json = file_get_contents($json_file);
		} else {
			die($json_file . " doesn't exist");
		}

		// attempt to get the latest cache
		$this->json_data = CacheHandler::CacheUpToDate($json);

		// if the latest cache is not the latest version of the JSON
		if($this->json_data == false) {

			// read the original JSON file
			$this->json_data = $this->returnStructure($json);

			// Write the new structure to the Cache
			CacheHandler::WriteNewerCache($this->json_data);
		}

	}

	function returnStructure($json) {

			//replace the last ',' from the file
			$json = $this->str_lreplace(',', '', $json);

			$json = json_decode($json);

			if($json === null) {
				die("JSON is invalid.");
			}

			// initialise structure array
			$structure = array();
			
			// foreach of the json prospectus keys
			foreach($json->prospectus as $obj => &$data) {

				// explode on the sectionParent and take second last element (this is the actual parent from the URL)
				$data->sectionParent = explode('/', $data->sectionParent);
				$data->sectionParent = $data->sectionParent[count($data->sectionParent) - 2];

				if(!isset($structure[$data->sectionParent]['display_title']) || ($structure[$data->sectionParent]['display_title'] !== CONFIG::getFirstPage() && $structure[$data->sectionParent]['display_title'] !== CONFIG::getLastPage())) {
	                $data->sectionParent = strtolower($data->sectionParent);

					$data->sectionParent = replaceCommasHyphens($data->sectionParent);
					$data->sectionTitle = replaceCommasHyphens((string)$data->sectionTitle);

					// if the sectionParent doesn't have a key in the structure array
					if(!isset($structure[$data->sectionParent])) {
						// set the array up with a total_ranges value of the current section ranges
						$structure[$data->sectionParent] = array ('total_ranges' => $data->sectionRanges );
					} else if($structure[$data->sectionParent]['total_ranges'] !== ''){
						// else just append onto what already exists
						$structure[$data->sectionParent]['total_ranges'] .= ',' . $data->sectionRanges;
					} else {
						// else set the total_ranges to the section_ranges value
						$structure[$data->sectionParent]['total_ranges'] = $data->sectionRanges;
					}

					if($data->sectionParent !== $data->sectionTitle) {
						$thisArray = array();
						$thisArray[$data->sectionTitle] = $data->sectionRanges;
						$structure[$data->sectionParent] = array_merge($structure[$data->sectionParent], $thisArray);
					}

					$structure[$data->sectionParent]['display_title'] = $data->sectionParentTitle; 
					
				}
			}

			$structure['md5_checksum'] = md5(file_get_contents(CONFIG::getJSON_FILE()));

		return $structure;
	}

	function str_lreplace($search, $replace, $subject) {
		$pos = strrpos($subject, $search);

	    if($pos !== false)
	    {
	        $subject = substr_replace($subject, $replace, $pos, strlen($search));
	    }

	    return $subject;
	}


}

class CacheHandler {

	public static function CacheUpToDate($json) {

		if(CONFIG::getENABLE_CACHING() === false) {
			return false;
		}

		$cached_file = CONFIG::getJSON_CACHED_FILE();

		// if the cached file exists
		if(file_exists($cached_file)) {

			$json_cached = json_decode(file_get_contents($cached_file), true);
			$md5_main_json = md5($json);

			// if the MD5 strings are the same, return the cached version
			if($json_cached['md5_checksum'] === $md5_main_json) {
				return $json_cached;
			} else {
				// else return false
				return false;
			}
		} else {
			// else return false
			return false;
		}
	}

	public static function WriteNewerCache($structure) {

		if(CONFIG::getENABLE_CACHING() === false) {
			return false;
		}

		if(file_exists(CONFIG::getJSON_CACHED_FILE())) {
			// we write the cached file
			file_put_contents(CONFIG::getJSON_CACHED_FILE(), json_encode($structure));
		} else {
			// else we make the directory, then write the cached file
			$dir_to_write_json = CONFIG::getPROSPECTUS_BUILDER_LOCATION() . '/' . CONFIG::getJSON_CACHED_FILE();
			$dir_to_write_json = str_replace('\\', '/', $dir_to_write_json);
			$dir_to_write_json = str_replace('/index.json', '', $dir_to_write_json);

			// check if the directory exists
			if(is_dir($dir_to_write_json)) {
				// write the file
				file_put_contents(CONFIG::getJSON_CACHED_FILE(), json_encode($structure));
			} else {
				if(mkdir($dir_to_write_json) === false) {
					die("error creating directory");
				} else {
					// we write the file
					file_put_contents(CONFIG::getJSON_CACHED_FILE(), json_encode($structure));
				}
			}
		}
	}
}

class send_emails {

	private $email_add;
	private $port;
	private $from;
	private $content;

	function __construct($email_addr) {
	
		ini_set('SMTP', CONFIG::getSMTP_HOST());
		ini_set('smtp_port', CONFIG::getSMTP_PORT());
		
		$this->sendEmailToEndUser($email_addr);
		$selections = $this->getUserSelections($_POST['selections']);
		$this->sendEmailToSite($selections, $email_addr);


	}
	
	private function getUserSelections($selections) {
		$selections = str_replace('-=-', ' ', $selections);
		$selections = ucwords($selections);
		
		 return $selections;
	
	}

	private function sendEmailToSite($selections, $email_addr)
	{
		$this->from = CONFIG::getEmail_Address_From();

		$this->msg = $this->formatSiteEmailMessage($_POST['selections'], $email_addr);

		$this->headers = "MIME-Version: 1.0" . "\r\n" .
		"Content-type: text/html; charset=UTF-8" . "\r\n" . 
		"From: " . $this->from . "\r\n" .
		"Reply-To: " . $this->from . "\r\n" .
		'X-Mailer: PHP/' . phpversion();


		$this->subject = "User downloaded a Prospectus";

		$client_email_address = CONFIG::getEmail_Address_Site();
		
		$sent = mail($client_email_address, $this->subject, $this->msg, $this->headers);

		if($sent === false) {
			die("false");
		}
	}

	private function sendEmailToEndUser($email_addr)
	{
	
		$this->from = CONFIG::getEmail_Address_From();

		$this->msg = $this->getEndUserEmailMessage();
	
		$this->subject = $this->getEndUserEmailSubject();
		

		$validEmail = filter_var($email_addr, FILTER_VALIDATE_EMAIL);

		if($validEmail === false) {
			die('Please enter a valid email address');
		}

		if($this->msg && $this->subject) {
			$this->headers = "MIME-Version: 1.0" . "\r\n" .
			"Content-type: text/html; charset=UTF-8" . "\r\n" . 
			"From: " . $this->from . "\r\n" .
			"Reply-To: " . $this->from . "\r\n" .
			'X-Mailer: PHP/' . phpversion();

			$sent = mail($email_addr, $this->subject, $this->msg, $this->headers);

			if($sent === false) {
				die("Failed to attempt sending email");
			}
		}
	}

	function formatSiteEmailMessage($subs, $end_user_email) {
		
		$msg = "A user downloaded a prospectus with an email address of " . $end_user_email;
		$msg .= "<br /><br />List of topics included in the Prospectus were: <br />";
		
		//$selections = implode('<br />', $subs );
		$selections = '';
		
		// add blank value to subs, in case only one value was selected.
		$subs[] = '';
		
		foreach($subs as &$selection) {
			$selection = str_replace('-=-', ' -> ', $selection);
			$selection = str_replace('_', ' ', $selection);
			$selection = ucwords($selection);
			
			$selections .= $selection . '<br />';
		}
		
		$msg .= $selections;
		
		return $msg;
	}


	function getEndUserEmailMessage() {
		return CONFIG::getEndUserMessage();
	}
	
	function getEndUserEmailSubject() {
		return CONFIG::getEndUserSubject();
	}


}

class GeneratePDF {

	public $ranges;
	public $pdf;

	function __construct($choices, $json_data) {

		$this->json_data = $json_data;

		$this->ranges = $this->getRanges($choices, $json_data);
		$this->ranges = $this->formatRanges($this->ranges);

		// check if the first and past page data is set, and if so, include it.
		$this->ranges = $this->addFirstLastPage($this->ranges, $json_data);

		$this->pdf = $this->returnPDF($this->ranges);


	}

	function getRanges($choices, $json_data) {

		$ranges = '';

		// add compulsory, if exists 	 	
		if(isset($json_data->json_data[CONFIG::getCOMPULSORY_SECTION()])) { 	 	
			$ranges .=  $json_data->json_data[CONFIG::getCOMPULSORY_SECTION()]['total_ranges'] . ','; 	 	
		} 

		// loop over the user selections
		foreach($choices['selections'] as $index => $course_selections) {

			// flag to append comma or not
			$append_comma = true;

			// if there is no hyphen, we are dealing with a main course
			if(strpos($course_selections, '-=-') === false) {	
				$ranges .= $json_data->json_data[$course_selections]['total_ranges'];
			} else {
				// else we explode by the hyphen to get the main course and sub course name
				$sections = explode('-=-', $course_selections);
				$course = $sections[0];
				$sub_section = $sections[1];

				if(!in_array($course, $choices['selections'])) {
					$ranges .= $json_data->json_data[$course][$sub_section];

					// we also need to include the compulsory section, if it is set
					if(CONFIG::getCOMPULSORY_SECTION() && isset($json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()]) && strpos($ranges, $json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()]) === false ) {
						$ranges .= ',' . $json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()];
					}
				} else {
					$append_comma = false;
				}
			}

			// if we are not on the last index of the choices, add a trailing comma
			if($index !== count($choices['selections']) -1 && $append_comma == true) {
				$ranges .= ',';
			}
/*
			// we also need to include the compulsory section, if it is set
			if(CONFIG::getCOMPULSORY_SECTION() && isset($json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()]) && strpos($ranges, $json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()]) === false ) {
				$ranges .= $json_data->json_data[$course][CONFIG::getCOMPULSORY_SECTION()] . ',';
			}
*/
		}

		// return the ranges
		return $ranges;

	}

	/**
	* Format the $range so that it is a comma delimitted string and replace all ranges with singular values
	* that are comma delimitted
	**/
	function formatRanges($ranges) {

			$ranges_array = array();
			$ranges_array = explode(',', $ranges);
			$ranges_array = array_filter($ranges_array);

			foreach($ranges_array as &$range) {

				// if there is a range
				if(strpos($range, '-') !== false) {

					// Explode by the hyphen
					$numbers = explode('-', $range);

					// Ensure the data is numeric, there are only 2 numbers, and the number on the left is less than the right
					if((is_numeric($numbers[0]) && is_numeric($numbers[1]) && count($numbers) == 2) && ($numbers[0] < $numbers[1])) {
						$new_range = '';

						// Create the new page numbers with comma delimmitted values
						for($i = $numbers[0]; $i<= $numbers[1]; $i++) {
							$new_range .= $i;

							if($i != $numbers[1]) {
								$new_range .= ',';
							}
						}

						$range = $new_range;
					} else {
						// there was an error with the data
						$this->throw_range_error();
					}
				}

			}

			// implode by comma
			$ranges = implode(',', $ranges_array);

			// explode again by comma
			$ranges = explode(',', $ranges);

			// make ranges unique (remove duplicates so that same pages dont appear twice)
			$ranges = array_unique($ranges);

			// sort ranges so pages appear in order
			sort($ranges, SORT_NUMERIC );

			// reimplode and return
			$ranges = implode(',', $ranges);

			return $ranges;
	}

	function addFirstLastPage($ranges, $json_data) {

		if(CONFIG::getFirstPage() && CONFIG::getLastPage()) {
			$first_page_name = CONFIG::getFirstPage();
			$last_page_name = CONFIG::getLastPage();			

			$first_page_range = $json_data->json_data[$first_page_name]['total_ranges'];
			$last_page_range = $json_data->json_data[$last_page_name]['total_ranges'];



			$ranges = $first_page_range . ',' . $ranges . ',' . $last_page_range;

			return $ranges;

		} else {
			return $ranges;
		}
	}

	function returnPDF($ranges, $type = 'download') {
		require_once(CONFIG::getPDF_PHP_LIBRARY_FILE());
		$pdf = new PDFMerger;
                try {
		    $pdf->addPDF(CONFIG::getMAIN_PDF_FILE(), $ranges)
			->merge($type, CONFIG::getPDF_NAME());
                } catch (Exception $e) {}

        return $pdf;

	}

	function checkExists($string, $json_data) {

	}

	function formatChoices($choices) {

	}

	function throw_range_error() {
		die("Data error.");
	}

}

class GetHTML {

	public $html;

	private $json_data;
	private $parent_class;
	private $child_class;

	function __construct($json_data) {
		$this->parent_class = CONFIG::getHTML_PARENT_CLASS();
		$this->child_class = CONFIG::getHTML_CHILD_CLASS();

		$this->json_data = $json_data;

		$this->html = $this->generateHTML($this->json_data);
		echo $this->html;
	}

function generateHTML($json_data) {

		$html = '';
						
					$html .= "<!-- jquery removed and added to seperate js -->";

		$html .= '<form id="prospectus-form" class="form-horizontal" role="form" method="POST" action="' . $_SERVER['PHP_SELF'] . '">';

		if(CONFIG::getSHOW_LIGHTBOX()) {
			$html .= '<link rel="stylesheet" type="text/css" href="'. CONFIG::getCOLORBOX_CSS() . '">
					<script src="'. CONFIG::getCOLORBOX_JQUERY() . '"></script>';

			$header_lightbox_text = CONFIG::getLightboxHeaderText();
			if(CONFIG::getUseDefaultLightboxStyle()) {
				$html .=	"<style>
								#prospectus_lb {
									margin: 15px 0 15px 20px;
								}
								
								#email_addr {
									margin-bottom: 0 !important;
									width: 220px;
								}

								input[name=submit_lb] {
									margin-top: 25px;
								}

								#cboxLoadedContent {
									overflow: initial !important;
								}
								
								.email_error { margin-top: 10px;  color: red; }
								
								#cboxContent {
									box-shadow: 0 0 30px #000;
									border-radius: 4px;
									padding: 10px 0 20px 0;
								}
							</style>";
			}
						
			$html .= "<div style='display:none'>
							<div id='prospectus_lb'>
								<p>{$header_lightbox_text}</p>
									<input type='text' id='email_addr' name='email_addr'> <br />
									<span class='email_error' style='display: none;'>Please enter a valid email address</span>
									<input type='button' value='Download' class='btn btn-large btn-info pull-left button [radius round]' name='submit_lb'>
									<br /><br /><br/>
						 	</div>
					 	</div>
					 	<input type='hidden' value='' class='emailVal' name='emailVal'/>";
		}

		foreach($json_data as &$array) {

			// Remove the 'MD5_CHECKSUM' key if it is set
			if(isset($array['md5_checksum'])) {
				unset($array['md5_checksum']);
			}

			$counter = 1;
			$option_counter = 1;


						foreach($array as $main_heading => $data) {

							if(replaceCommasHyphens(CONFIG::getFirstPage()) !== $main_heading && replaceCommasHyphens(CONFIG::getLastPage()) !== $main_heading) {
				
				$html .= <<<HTML
					<dl class="accordion" data-accordion>
<dt class="hidden">Choose Course</dt>
                        <dd class="accordion-navigation">
                            <a href="#collapse-{$counter}" data-parent="#accordion2" data-toggle="collapse" class="accordion-toggle">
                               {$data['display_title']}
                            </a>
                        
                        <div class="accordion-body content collapse" id="collapse-{$counter}">
                            <div class="accordion-inner">
                                <div class="row">
                                    <span class="medium-10 column"></span>
                                    <div class="medium-2 selectall column">
                                        <span class="fa fa-plus"></span>&nbsp; Select All
                                    </div>
                                    <div class="medium-2 removeall column">
                                        <span class="fa fa-times"></span>&nbsp; Remove All
                                    </div>
                                    <div class="checkbox medium-1 column">
                                        <label for="selection-{$counter}" class="hidden">{$main_heading}</label>
                                        <input type="checkbox" name="selections[]" value="{$main_heading}" id="selection-{$counter}">
                                    </div>
                                </div>
HTML;

				foreach($data as $option => $ranges) {

					// don't include the total_ranges sections or the compulsory sections in the HTML
					if($option !== 'total_ranges' && $option !== 'display_title' /*&& CONFIG::getCOMPULSORY_SECTION() !== false*/ && $option !== CONFIG::getCOMPULSORY_SECTION()) {
						$title = replaceUnderscoreWithSpace($option);
						
						$html .= <<<HTML
								<div class="row">
                                    <span class="medium-10 include-text column">{$title}</span>
                                    <div class="medium-2 include column">
                                        <span class="fa fa-plus"></span>&nbsp; Include
                                    </div>
                                    <div class="medium-2 added column">
                                        <span class="fa fa-check"></span>&nbsp; Added
                                    </div>
                                    <div class="checkbox medium-1 column">
                                        <label for="selection-{$counter}-{$option_counter}" class="hidden">{$main_heading} {$option}</label>
                                        <input type="checkbox"  name="selections[]" value="{$main_heading}-=-{$option}" id="selection-{$counter}-{$option_counter}">
                                    </div>
                                </div> <!-- end option row -->
HTML;
					}

					$option_counter++; 
				}

                $html .= '</div></div></dd></dl>';
				$counter++; 
			}
		}
                $html .= '<button class="btn btn-large btn-info pull-right" type="submit" id="submitBTN" name="submitBTN">Create Prospectus</button>';
				$html .= '</form>';

				
		}

		return $html;
	}
}

	function replaceCommasHyphens($string) {
		$string = str_replace(',', "_", $string);
		$string = str_replace('-', "_", $string);
		$string = str_replace(' ', "_", $string);
		
		return $string;
	}
	
	function replaceUnderscoreWithSpace($string) {
		$string = str_replace('_', ' ', $string);
		
		return $string;
	}