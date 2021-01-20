<?php
/* Version 0.1.126 */
$t4_module['config']      = '/alumni/events/calendar/';
$t4_module['allevents']   = '/alumni/events/calendar/';
$t4_module['module']      = 'Calendar-Page';
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
  //Download-Ical can be replaced with Download-IcalwithRecurring
  $moduleClass = T4EventsCalendar::module($t4_config,$t4_module,'Download-IcalwithRecurring');
  unset($t4_module);

/* Start Catch */
} catch(\Exception $e) {
  if(!isset($displayedError)) {
    echo $e->getMessage();
    $displayedError = true;
  }
}
/* End Catch */
?>
