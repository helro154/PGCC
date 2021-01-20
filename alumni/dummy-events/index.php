<!doctype html>
<!--[if IE 8 ]>    <html class="lt-ie9 ie8" lang="en"> <![endif]-->
<!--[if IE 9 ]>    <html class="ie9" lang="en"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html class="no-js" lang="en"> <!--<![endif]-->


  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta property="fb:pages" content="532077856961197" />
    <title>Dummy Events - TERMINALFOUR University</title>
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
    <meta name="enddate" content="Sat, 02 Jul 2016 20:00:00 EDT, Mon, 15 May 2017 15:00:00 EDT, Wed, 19 Oct 2016 21:00:00 EDT, Fri, 03 Mar 2017 16:00:00 EST, Sat, 09 Apr 2016 20:00:00 EDT, Fri, 22 Jul 2016 17:00:00 EDT, Sun, 01 Oct 2017 19:00:00 EDT, Mon, 22 Feb 2016 19:00:00 EST, Fri, 21 Jul 2017 23:00:00 EDT, Sun, 11 Dec 2016 17:00:00 EST, Wed, 13 Jan 2016 22:00:00 EST, Sat, 25 Feb 2017 20:00:00 EST, Sat, 18 Feb 2017 14:00:00 EST, Thu, 27 Oct 2016 14:00:00 EDT, Tue, 15 Mar 2016 17:00:00 EDT, Fri, 25 Nov 2016 17:00:00 EST, Fri, 01 Apr 2016 15:00:00 EDT, Tue, 12 Jul 2016 20:00:00 EDT, Fri, 24 Jun 2016 16:00:00 EDT, Thu, 08 Dec 2016 15:00:00 EST, Thu, 18 May 2017 22:00:00 EDT, Wed, 07 Sep 2016 18:00:00 EDT, Sun, 06 Aug 2017 19:00:00 EDT, Fri, 22 Jul 2016 18:00:00 EDT, Thu, 23 Feb 2017 19:00:00 EST, Tue, 17 Jan 2017 18:00:00 EST, Wed, 19 Oct 2016 23:00:00 EDT, Wed, 04 Jan 2017 19:00:00 EST, Thu, 06 Apr 2017 19:00:00 EDT, Wed, 20 Jul 2016 18:00:00 EDT, Wed, 01 Mar 2017 11:00:00 EST, Sat, 08 Apr 2017 15:00:00 EDT, Sun, 24 Dec 2017 12:00:00 EST, Mon, 13 Jun 2016 21:00:00 EDT, Tue, 03 Oct 2017 18:00:00 EDT, Sat, 07 Jan 2017 18:00:00 EST, Wed, 11 May 2016 19:00:00 EDT, Wed, 09 Aug 2017 13:00:00 EDT, Sun, 25 Sep 2016 19:00:00 EDT, Wed, 07 Sep 2016 15:00:00 EDT, Fri, 13 Jan 2017 19:00:00 EST, Sat, 04 Feb 2017 23:00:00 EST, Thu, 07 Apr 2016 17:00:00 EDT, Sun, 25 Dec 2016 16:00:00 EST, Fri, 26 Aug 2016 21:00:00 EDT, Wed, 13 Jul 2016 12:00:00 EDT, Mon, 08 May 2017 14:00:00 EDT, Sat, 23 Apr 2016 15:00:00 EDT, Sat, 20 Aug 2016 12:00:00 EDT, Tue, 24 Oct 2017 18:00:00 EDT, Sat, 22 Apr 2017 17:00:00 EDT, Sun, 24 Jan 2016 21:00:00 EST, Thu, 25 May 2017 20:00:00 EDT, Wed, 22 Jun 2016 19:00:00 EDT, Tue, 21 Nov 2017 10:00:00 EST, Tue, 10 May 2016 17:00:00 EDT, Sat, 15 Apr 2017 21:00:00 EDT, Sat, 13 Feb 2016 19:00:00 EST, Wed, 14 Dec 2016 13:00:00 EST, Thu, 21 Apr 2016 18:00:00 EDT, Fri, 10 Feb 2017 15:00:00 EST, Sat, 24 Jun 2017 17:00:00 EDT, Thu, 25 Aug 2016 13:00:00 EDT, Sat, 12 Aug 2017 11:00:00 EDT, Sun, 19 Jun 2016 12:00:00 EDT, Fri, 05 Aug 2016 19:00:00 EDT, Fri, 14 Jul 2017 22:00:00 EDT, Tue, 13 Jun 2017 22:00:00 EDT, Wed, 25 Oct 2017 18:00:00 EDT, Mon, 12 Jun 2017 10:00:00 EDT, Sun, 07 May 2017 10:00:00 EDT, Mon, 19 Dec 2016 11:00:00 EST, Fri, 11 Nov 2016 18:00:00 EST, Thu, 26 May 2016 15:00:00 EDT, Sat, 15 Apr 2017 12:00:00 EDT, Thu, 02 Feb 2017 21:00:00 EST, Sat, 23 Apr 2016 17:00:00 EDT, Sun, 17 Jul 2016 14:00:00 EDT, Thu, 14 Jan 2016 16:00:00 EST, Sat, 01 Apr 2017 16:00:00 EDT, Wed, 13 Jan 2016 17:00:00 EST, Sat, 16 Sep 2017 10:00:00 EDT, Sun, 24 Jul 2016 15:00:00 EDT, Wed, 06 Jul 2016 19:00:00 EDT, Mon, 04 Sep 2017 21:00:00 EDT, Tue, 23 Aug 2016 12:00:00 EDT, Thu, 20 Jul 2017 15:00:00 EDT, Fri, 08 Sep 2017 10:00:00 EDT, Thu, 11 Aug 2016 18:00:00 EDT, Wed, 13 Jul 2016 12:00:00 EDT, Mon, 04 Dec 2017 18:00:00 EST, Tue, 26 Jan 2016 15:00:00 EST, Mon, 15 Feb 2016 21:00:00 EST, Wed, 01 Jun 2016 14:00:00 EDT, Sun, 23 Oct 2016 16:00:00 EDT, Sun, 05 Feb 2017 18:00:00 EST, Wed, 11 Oct 2017 23:00:00 EDT, Mon, 01 Feb 2016 20:00:00 EST, Mon, 26 Sep 2016 18:00:00 EDT, Thu, 07 Dec 2017 13:00:00 EST, Thu, 25 Feb 2016 18:00:00 EST, Tue, 14 Mar 2017 19:00:00 EDT, Wed, 10 Aug 2016 16:00:00 EDT, Sun, 11 Jun 2017 13:00:00 EDT, Fri, 24 Feb 2017 23:00:00 EST, Sun, 13 Mar 2016 16:00:00 EDT, Fri, 22 Apr 2016 19:00:00 EDT, Tue, 10 May 2016 17:00:00 EDT, Wed, 19 Oct 2016 16:00:00 EDT, Sat, 16 Jul 2016 23:00:00 EDT, Wed, 20 Sep 2017 12:00:00 EDT, Sat, 16 Apr 2016 19:00:00 EDT, Mon, 05 Sep 2016 13:00:00 EDT, Thu, 03 Aug 2017 16:00:00 EDT, Sat, 25 Feb 2017 13:00:00 EST, Fri, 15 Sep 2017 12:00:00 EDT, Tue, 21 Nov 2017 22:00:00 EST, Tue, 23 Aug 2016 13:00:00 EDT, Mon, 09 May 2016 15:00:00 EDT, Sat, 19 Aug 2017 12:00:00 EDT, Fri, 22 Dec 2017 17:00:00 EST, Fri, 10 Jun 2016 13:00:00 EDT, Thu, 19 Jan 2017 22:00:00 EST, Sun, 15 Oct 2017 16:00:00 EDT, Tue, 23 May 2017 12:00:00 EDT, Mon, 27 Nov 2017 18:00:00 EST, Tue, 23 Feb 2016 13:00:00 EST, Wed, 13 Jan 2016 15:00:00 EST, Fri, 01 Dec 2017 14:00:00 EST, Fri, 18 Nov 2016 21:00:00 EST, Wed, 25 May 2016 19:00:00 EDT, Thu, 07 Jul 2016 15:00:00 EDT, Sun, 05 Feb 2017 14:00:00 EST, Wed, 15 Feb 2017 17:00:00 EST, Fri, 03 Feb 2017 16:00:00 EST, Sun, 04 Dec 2016 17:00:00 EST, Fri, 17 Jun 2016 14:00:00 EDT, Mon, 07 Nov 2016 13:00:00 EST, Thu, 04 Aug 2016 19:00:00 EDT, Fri, 28 Apr 2017 13:00:00 EDT, Sat, 04 Mar 2017 17:00:00 EST, Mon, 14 Mar 2016 20:00:00 EDT, Mon, 27 Mar 2017 20:00:00 EDT, Fri, 23 Jun 2017 14:00:00 EDT, Thu, 14 Apr 2016 19:00:00 EDT, Thu, 10 Aug 2017 12:00:00 EDT, Sat, 19 Nov 2016 17:00:00 EST, Sat, 25 Jun 2016 20:00:00 EDT, Fri, 25 Aug 2017 16:00:00 EDT, Mon, 19 Sep 2016 18:00:00 EDT, Wed, 20 Apr 2016 18:00:00 EDT, Tue, 16 Feb 2016 19:00:00 EST, Sat, 11 Mar 2017 21:00:00 EST, Mon, 17 Jul 2017 18:00:00 EDT, Tue, 05 Sep 2017 17:00:00 EDT, Tue, 01 Mar 2016 16:00:00 EST, Wed, 17 May 2017 15:00:00 EDT, Mon, 11 Apr 2016 18:00:00 EDT, Mon, 24 Oct 2016 14:00:00 EDT, Thu, 10 Nov 2016 18:00:00 EST, Mon, 19 Dec 2016 15:00:00 EST, Wed, 10 Feb 2016 17:00:00 EST, Tue, 12 Apr 2016 12:00:00 EDT, Fri, 27 May 2016 11:00:00 EDT, Wed, 04 Jan 2017 13:00:00 EST, Fri, 04 Aug 2017 19:00:00 EDT, Fri, 28 Oct 2016 18:00:00 EDT, Sat, 20 May 2017 17:00:00 EDT, Fri, 13 May 2016 12:00:00 EDT, Mon, 19 Sep 2016 14:00:00 EDT, Thu, 13 Apr 2017 23:00:00 EDT, Sat, 27 May 2017 17:00:00 EDT, Mon, 22 Feb 2016 18:00:00 EST, Wed, 21 Jun 2017 19:00:00 EDT, Tue, 12 Sep 2017 17:00:00 EDT, Tue, 13 Dec 2016 15:00:00 EST, Thu, 24 Nov 2016 20:00:00 EST, Tue, 26 Jan 2016 20:00:00 EST, Sat, 19 Mar 2016 14:00:00 EDT, Tue, 15 Mar 2016 16:00:00 EDT, Fri, 24 Jun 2016 14:00:00 EDT, Fri, 23 Jun 2017 17:00:00 EDT, Sun, 20 Mar 2016 17:00:00 EDT, Thu, 15 Sep 2016 18:00:00 EDT, Tue, 06 Dec 2016 14:00:00 EST, Wed, 17 Feb 2016 16:00:00 EST, Thu, 23 Mar 2017 12:00:00 EDT, Mon, 03 Oct 2016 12:00:00 EDT, Sat, 04 Nov 2017 18:00:00 EDT, Fri, 22 Jul 2016 14:00:00 EDT, Tue, 13 Sep 2016 19:00:00 EDT, Sat, 16 Jul 2016 13:00:00 EDT, Wed, 18 Oct 2017 14:00:00 EDT, Sun, 15 Jan 2017 21:00:00 EST, Wed, 28 Jun 2017 15:00:00 EDT, Thu, 19 Jan 2017 19:00:00 EST, Wed, 09 Aug 2017 20:00:00 EDT, Sat, 25 Mar 2017 22:00:00 EDT, Wed, 07 Dec 2016 12:00:00 EST, Thu, 21 Jan 2016 15:00:00 EST, Sun, 24 Sep 2017 12:00:00 EDT, Fri, 07 Oct 2016 14:00:00 EDT, Sat, 27 Feb 2016 21:00:00 EST, Fri, 21 Jul 2017 15:00:00 EDT, Tue, 05 Jan 2016 17:00:00 EST, Mon, 28 Nov 2016 17:00:00 EST, Fri, 05 Aug 2016 13:00:00 EDT, Mon, 22 May 2017 17:00:00 EDT, Tue, 11 Jul 2017 13:00:00 EDT, Tue, 05 Jul 2016 20:00:00 EDT, Sat, 21 May 2016 20:00:00 EDT, Fri, 22 Jan 2016 16:00:00 EST, Wed, 05 Apr 2017 20:00:00 EDT, Mon, 08 Feb 2016 11:00:00 EST, Sat, 12 Mar 2016 19:00:00 EST, Fri, 28 Oct 2016 13:00:00 EDT, Thu, 06 Apr 2017 18:00:00 EDT, Mon, 10 Jul 2017 14:00:00 EDT, Mon, 28 Aug 2017 17:00:00 EDT, Sat, 06 Aug 2016 11:00:00 EDT, Mon, 07 Nov 2016 21:00:00 EST, Mon, 27 Jun 2016 15:00:00 EDT, Sun, 26 Feb 2017 13:00:00 EST, Fri, 22 Jul 2016 19:00:00 EDT, Sun, 27 Aug 2017 14:00:00 EDT, Mon, 25 Jan 2016 20:00:00 EST, Tue, 06 Sep 2016 18:00:00 EDT, Wed, 08 Jun 2016 15:00:00 EDT, Mon, 09 Jan 2017 18:00:00 EST, Sun, 17 Jul 2016 12:00:00 EDT, Sun, 14 May 2017 19:00:00 EDT, Fri, 01 Sep 2017 14:00:00 EDT, Sat, 02 Sep 2017 20:00:00 EDT, Tue, 16 Feb 2016 12:00:00 EST, Sun, 14 Feb 2016 14:00:00 EST, Fri, 07 Oct 2016 17:00:00 EDT, Tue, 26 Jul 2016 16:00:00 EDT, Sun, 02 Jul 2017 23:00:00 EDT, Thu, 25 May 2017 14:00:00 EDT, Thu, 05 Oct 2017 15:00:00 EDT, Fri, 15 Jul 2016 12:00:00 EDT, Sat, 22 Apr 2017 22:00:00 EDT, Sat, 23 Apr 2016 20:00:00 EDT, Thu, 25 May 2017 16:00:00 EDT, Sun, 09 Apr 2017 16:00:00 EDT, Fri, 01 Dec 2017 15:00:00 EST, Sat, 27 May 2017 19:00:00 EDT, Fri, 22 Jul 2016 14:00:00 EDT, Wed, 23 Mar 2016 17:00:00 EDT, Sat, 27 Feb 2016 18:00:00 EST, Wed, 22 Mar 2017 21:00:00 EDT, Wed, 26 Apr 2017 18:00:00 EDT, Tue, 13 Jun 2017 20:00:00 EDT, Sun, 16 Apr 2017 22:00:00 EDT, Sat, 19 Aug 2017 15:00:00 EDT, Sat, 02 Apr 2016 19:00:00 EDT, Tue, 15 Aug 2017 20:00:00 EDT, Mon, 03 Apr 2017 14:00:00 EDT, Fri, 10 Feb 2017 13:00:00 EST, Wed, 03 Aug 2016 16:00:00 EDT, Sat, 15 Oct 2016 15:00:00 EDT, Mon, 23 Jan 2017 18:00:00 EST, Sun, 24 Jul 2016 15:00:00 EDT, Thu, 11 Feb 2016 16:00:00 EST, Wed, 18 Jan 2017 21:00:00 EST, Wed, 17 Aug 2016 14:00:00 EDT, Mon, 21 Nov 2016 15:00:00 EST, Sat, 21 Oct 2017 12:00:00 EDT, Sun, 18 Dec 2016 21:00:00 EST, Thu, 07 Dec 2017 12:00:00 EST, Fri, 13 Jan 2017 11:00:00 EST, Mon, 21 Mar 2016 17:00:00 EDT, Sun, 26 Mar 2017 17:00:00 EDT, Tue, 19 Jul 2016 18:00:00 EDT, Thu, 24 Nov 2016 17:00:00 EST, Wed, 06 Sep 2017 22:00:00 EDT, Thu, 02 Mar 2017 17:00:00 EST, Wed, 13 Jul 2016 16:00:00 EDT, Mon, 15 Feb 2016 14:00:00 EST, Sun, 13 Aug 2017 17:00:00 EDT, Sat, 13 Feb 2016 15:00:00 EST, Thu, 15 Dec 2016 12:00:00 EST, Sun, 10 Jul 2016 21:00:00 EDT, Fri, 10 Jun 2016 13:00:00 EDT, Tue, 20 Dec 2016 20:00:00 EST, Thu, 22 Dec 2016 18:00:00 EST, Thu, 02 Feb 2017 17:00:00 EST, Sun, 04 Dec 2016 18:00:00 EST, Wed, 02 Aug 2017 21:00:00 EDT, Fri, 18 Aug 2017 16:00:00 EDT, Fri, 22 Jul 2016 17:00:00 EDT, Mon, 05 Jun 2017 16:00:00 EDT, Fri, 09 Dec 2016 11:00:00 EST, Wed, 13 Jul 2016 10:00:00 EDT, Thu, 09 Nov 2017 19:00:00 EST, Sun, 25 Dec 2016 16:00:00 EST, Sun, 06 Aug 2017 18:00:00 EDT, Fri, 20 Oct 2017 11:00:00 EDT, Sat, 25 Feb 2017 21:00:00 EST, Sun, 27 Aug 2017 15:00:00 EDT, Sat, 16 Jul 2016 18:00:00 EDT, Mon, 27 Nov 2017 20:00:00 EST, Tue, 14 Feb 2017 13:00:00 EST, Sun, 03 Jan 2016 15:00:00 EST, Fri, 25 Nov 2016 13:00:00 EST, Thu, 05 Oct 2017 18:00:00 EDT, Sat, 02 Jan 2016 20:00:00 EST, Sun, 25 Jun 2017 23:00:00 EDT, Sat, 15 Oct 2016 19:00:00 EDT, Sat, 12 Aug 2017 17:00:00 EDT, Sat, 02 Jul 2016 17:00:00 EDT, Tue, 15 Mar 2016 13:00:00 EDT, Sat, 13 Feb 2016 18:00:00 EST, Sat, 23 Jul 2016 19:00:00 EDT, Tue, 03 Jan 2017 18:00:00 EST, Tue, 26 Jul 2016 15:00:00 EDT, Thu, 05 May 2016 15:00:00 EDT, Mon, 19 Dec 2016 18:00:00 EST, Mon, 13 Jun 2016 14:00:00 EDT, Tue, 08 Nov 2016 20:00:00 EST, Sat, 06 Feb 2016 22:00:00 EST, Fri, 20 May 2016 19:00:00 EDT, Sat, 22 Jul 2017 20:00:00 EDT, Sun, 15 Oct 2017 17:00:00 EDT, Mon, 14 Nov 2016 12:00:00 EST, Wed, 24 Feb 2016 20:00:00 EST, Thu, 18 Aug 2016 16:00:00 EDT, Sat, 14 May 2016 15:00:00 EDT, Sat, 25 Feb 2017 16:00:00 EST, Sat, 12 Nov 2016 16:00:00 EST, Fri, 13 May 2016 14:00:00 EDT, Mon, 04 Sep 2017 22:00:00 EDT, Wed, 23 Nov 2016 16:00:00 EST, Sat, 10 Sep 2016 14:00:00 EDT, Sat, 09 Jul 2016 11:00:00 EDT, Thu, 07 Jan 2016 10:00:00 EST, Thu, 14 Jul 2016 15:00:00 EDT, Fri, 03 Mar 2017 14:00:00 EST, Fri, 14 Jul 2017 18:00:00 EDT, Mon, 14 Mar 2016 14:00:00 EDT, Sun, 18 Jun 2017 19:00:00 EDT, Wed, 15 Jun 2016 14:00:00 EDT, Tue, 26 Apr 2016 13:00:00 EDT, Sun, 03 Jan 2016 13:00:00 EST, Thu, 19 May 2016 18:00:00 EDT, Sat, 21 Jan 2017 14:00:00 EST, Mon, 09 May 2016 14:00:00 EDT, Wed, 12 Jul 2017 12:00:00 EDT, Thu, 15 Dec 2016 14:00:00 EST, Thu, 20 Jul 2017 15:00:00 EDT, Thu, 27 Jul 2017 19:00:00 EDT, Mon, 21 Nov 2016 21:00:00 EST, Sat, 25 Feb 2017 22:00:00 EST, Wed, 01 Nov 2017 12:00:00 EDT, Tue, 04 Jul 2017 11:00:00 EDT, Thu, 18 Aug 2016 16:00:00 EDT, Sat, 16 Sep 2017 23:00:00 EDT, Fri, 15 Sep 2017 16:00:00 EDT, Sun, 13 Nov 2016 19:00:00 EST, Fri, 28 Oct 2016 23:00:00 EDT, Wed, 28 Jun 2017 19:00:00 EDT, Thu, 01 Jun 2017 11:00:00 EDT, Wed, 19 Oct 2016 17:00:00 EDT, Thu, 18 Aug 2016 19:00:00 EDT, Thu, 11 May 2017 21:00:00 EDT, Tue, 18 Apr 2017 12:00:00 EDT, Sat, 22 Apr 2017 11:00:00 EDT, Sat, 19 Aug 2017 13:00:00 EDT, Mon, 09 May 2016 18:00:00 EDT, Thu, 08 Dec 2016 17:00:00 EST, Thu, 02 Mar 2017 19:00:00 EST, Thu, 11 Feb 2016 19:00:00 EST, Wed, 06 Sep 2017 20:00:00 EDT, Tue, 19 Sep 2017 18:00:00 EDT, Fri, 13 Jan 2017 21:00:00 EST, Wed, 13 Jul 2016 17:00:00 EDT, Sun, 20 Nov 2016 20:00:00 EST, Fri, 16 Jun 2017 15:00:00 EDT, Mon, 18 Jul 2016 19:00:00 EDT, Fri, 06 Nov 2015 21:00:00 EST, Sun, 28 Aug 2016 17:00:00 EDT, Sun, 16 Apr 2017 11:00:00 EDT, Thu, 02 Feb 2017 19:00:00 EST, Tue, 18 Jul 2017 16:00:00 EDT, Sun, 03 Dec 2017 19:00:00 EST, Thu, 26 May 2016 17:00:00 EDT, Fri, 22 Dec 2017 13:00:00 EST, Sun, 16 Apr 2017 14:00:00 EDT, Wed, 16 Mar 2016 13:00:00 EDT, Sun, 04 Sep 2016 19:00:00 EDT, Sat, 06 Feb 2016 13:00:00 EST, Thu, 25 May 2017 13:00:00 EDT, Thu, 05 May 2016 13:00:00 EDT, Sat, 08 Jul 2017 20:00:00 EDT, Wed, 06 Jul 2016 16:00:00 EDT, Sun, 18 Jun 2017 18:00:00 EDT, Tue, 21 Feb 2017 11:00:00 EST, Sat, 26 Nov 2016 17:00:00 EST, Mon, 18 Sep 2017 19:00:00 EDT, Sun, 09 Jul 2017 16:00:00 EDT, Sun, 02 Oct 2016 22:00:00 EDT, Fri, 19 May 2017 14:00:00 EDT, Thu, 17 Aug 2017 19:00:00 EDT, Sun, 13 Mar 2016 19:00:00 EDT, Sat, 10 Dec 2016 13:00:00 EST, Fri, 07 Oct 2016 13:00:00 EDT, Wed, 05 Oct 2016 15:00:00 EDT, Tue, 26 Dec 2017 15:00:00 EST, Sat, 19 Aug 2017 19:00:00 EDT, Fri, 08 Apr 2016 18:00:00 EDT, Thu, 16 Jun 2016 15:00:00 EDT, Sat, 12 Nov 2016 14:00:00 EST, Wed, 22 Mar 2017 12:00:00 EDT, Tue, 26 Apr 2016 19:00:00 EDT, Wed, 25 Oct 2017 18:00:00 EDT, Fri, 19 Feb 2016 12:00:00 EST, Sat, 03 Sep 2016 19:00:00 EDT, Wed, 13 Apr 2016 13:00:00 EDT, Thu, 08 Jun 2017 17:00:00 EDT, Thu, 15 Dec 2016 13:00:00 EST, Tue, 08 Mar 2016 20:00:00 EST, Sun, 05 Nov 2017 13:00:00 EST, Sat, 09 Apr 2016 15:00:00 EDT, Mon, 03 Jul 2017 19:00:00 EDT, Sat, 09 Jan 2016 14:00:00 EST, Fri, 21 Apr 2017 21:00:00 EDT, Wed, 09 Mar 2016 17:00:00 EST, Thu, 26 Oct 2017 17:00:00 EDT, Tue, 19 Jan 2016 21:00:00 EST, Fri, 28 Jul 2017 11:00:00 EDT" /><!-- end date -->
    
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
	            <ul><li><a href="/">Home</a></li><li><a href="/alumni/">Alumni</a></li><li><a href="/alumni/dummy-events/">Dummy Events</a></li></ul>
            </nav>
	</div>
</div>
<!-- ./breadcrumbs -->

      <h1>Dummy Events</h1>
    
<!-- end of SM header -->

<?php
/* Version 0.1.126 */
$current_content_layout_name = 'text/html';

$position 				        = '';
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
  if($t4_module['module'] != 'Results-Single' && $position == $current_content_layout_name ) {
  	$moduleClass = T4EventsCalendar::module($t4_config,$t4_module);
    unset($t4_module);
  }

/* Start Catch */
} catch(\Exception $e) {
  if(!isset($displayedError)) {
    echo '<div class="eventCalError" style="background:rgb(250,200,200); padding: 1em; border: 1px solid rgb(180,20,20); border-radius: 3px; margin-bottom: 1em;color: rgb(130,20,20)">'.$e->getMessage().'</div>';
    $displayedError = true;
  }
}
/* End Catch */
?>
<!-- <a id="d.en.4147"></a> --><!-- <a id="d.en.4031"></a> --><!-- <a id="d.en.4471"></a> --><!-- <a id="d.en.4436"></a> --><!-- <a id="d.en.4380"></a> --><!-- <a id="d.en.4214"></a> --><!-- <a id="d.en.4398"></a> --><!-- <a id="d.en.4098"></a> --><!-- <a id="d.en.4135"></a> --><!-- <a id="d.en.4326"></a> --><!-- <a id="d.en.4022"></a> --><!-- <a id="d.en.4260"></a> --><!-- <a id="d.en.4202"></a> --><!-- <a id="d.en.4041"></a> --><!-- <a id="d.en.4047"></a> --><!-- <a id="d.en.4106"></a> --><!-- <a id="d.en.4502"></a> --><!-- <a id="d.en.4211"></a> --><!-- <a id="d.en.4498"></a> --><!-- <a id="d.en.4365"></a> --><!-- <a id="d.en.4116"></a> --><!-- <a id="d.en.4513"></a> --><!-- <a id="d.en.4206"></a> --><!-- <a id="d.en.4481"></a> --><!-- <a id="d.en.4212"></a> --><!-- <a id="d.en.4132"></a> --><!-- <a id="d.en.4259"></a> --><!-- <a id="d.en.4234"></a> --><!-- <a id="d.en.4379"></a> --><!-- <a id="d.en.4207"></a> --><!-- <a id="d.en.4208"></a> --><!-- <a id="d.en.4249"></a> --><!-- <a id="d.en.4073"></a> --><!-- <a id="d.en.4320"></a> --><!-- <a id="d.en.4218"></a> --><!-- <a id="d.en.4101"></a> --><!-- <a id="d.en.4075"></a> --><!-- <a id="d.en.4167"></a> --><!-- <a id="d.en.4171"></a> --><!-- <a id="d.en.4246"></a> --><!-- <a id="d.en.4253"></a> --><!-- <a id="d.en.4370"></a> --><!-- <a id="d.en.4389"></a> --><!-- <a id="d.en.4416"></a> --><!-- <a id="d.en.4340"></a> --><!-- <a id="d.en.4318"></a> --><!-- <a id="d.en.4231"></a> --><!-- <a id="d.en.4126"></a> --><!-- <a id="d.en.4344"></a> --><!-- <a id="d.en.4434"></a> --><!-- <a id="d.en.4327"></a> --><!-- <a id="d.en.4183"></a> --><!-- <a id="d.en.4017"></a> --><!-- <a id="d.en.4042"></a> --><!-- <a id="d.en.4272"></a> --><!-- <a id="d.en.4271"></a> --><!-- <a id="d.en.4315"></a> --><!-- <a id="d.en.4369"></a> --><!-- <a id="d.en.4484"></a> --><!-- <a id="d.en.4291"></a> --><!-- <a id="d.en.4428"></a> --><!-- <a id="d.en.4092"></a> --><!-- <a id="d.en.4448"></a> --><!-- <a id="d.en.4457"></a> --><!-- <a id="d.en.4114"></a> --><!-- <a id="d.en.4355"></a> --><!-- <a id="d.en.4045"></a> --><!-- <a id="d.en.4038"></a> --><!-- <a id="d.en.4444"></a> --><!-- <a id="d.en.4474"></a> --><!-- <a id="d.en.4180"></a> --><!-- <a id="d.en.4512"></a> --><!-- <a id="d.en.4125"></a> --><!-- <a id="d.en.4084"></a> --><!-- <a id="d.en.4051"></a> --><!-- <a id="d.en.4298"></a> --><!-- <a id="d.en.4131"></a> --><!-- <a id="d.en.4035"></a> --><!-- <a id="d.en.4314"></a> --><!-- <a id="d.en.4082"></a> --><!-- <a id="d.en.4468"></a> --><!-- <a id="d.en.4345"></a> --><!-- <a id="d.en.4228"></a> --><!-- <a id="d.en.4247"></a> --><!-- <a id="d.en.4366"></a> --><!-- <a id="d.en.4238"></a> --><!-- <a id="d.en.4160"></a> --><!-- <a id="d.en.4136"></a> --><!-- <a id="d.en.4376"></a> --><!-- <a id="d.en.4179"></a> --><!-- <a id="d.en.4507"></a> --><!-- <a id="d.en.4368"></a> --><!-- <a id="d.en.4088"></a> --><!-- <a id="d.en.4115"></a> --><!-- <a id="d.en.4414"></a> --><!-- <a id="d.en.4452"></a> --><!-- <a id="d.en.4189"></a> --><!-- <a id="d.en.4173"></a> --><!-- <a id="d.en.4068"></a> --><!-- <a id="d.en.4229"></a> --><!-- <a id="d.en.4138"></a> --><!-- <a id="d.en.4161"></a> --><!-- <a id="d.en.4192"></a> --><!-- <a id="d.en.4242"></a> --><!-- <a id="d.en.4169"></a> --><!-- <a id="d.en.4268"></a> --><!-- <a id="d.en.4402"></a> --><!-- <a id="d.en.4456"></a> --><!-- <a id="d.en.4289"></a> --><!-- <a id="d.en.4170"></a> --><!-- <a id="d.en.4511"></a> --><!-- <a id="d.en.4319"></a> --><!-- <a id="d.en.4352"></a> --><!-- <a id="d.en.4479"></a> --><!-- <a id="d.en.4064"></a> --><!-- <a id="d.en.4303"></a> --><!-- <a id="d.en.4353"></a> --><!-- <a id="d.en.4078"></a> --><!-- <a id="d.en.4227"></a> --><!-- <a id="d.en.4139"></a> --><!-- <a id="d.en.4363"></a> --><!-- <a id="d.en.4256"></a> --><!-- <a id="d.en.4024"></a> --><!-- <a id="d.en.4378"></a> --><!-- <a id="d.en.4175"></a> --><!-- <a id="d.en.4137"></a> --><!-- <a id="d.en.4240"></a> --><!-- <a id="d.en.4252"></a> --><!-- <a id="d.en.4270"></a> --><!-- <a id="d.en.4043"></a> --><!-- <a id="d.en.4305"></a> --><!-- <a id="d.en.4195"></a> --><!-- <a id="d.en.4382"></a> --><!-- <a id="d.en.4143"></a> --><!-- <a id="d.en.4146"></a> --><!-- <a id="d.en.4145"></a> --><!-- <a id="d.en.4311"></a> --><!-- <a id="d.en.4386"></a> --><!-- <a id="d.en.4134"></a> --><!-- <a id="d.en.4072"></a> --><!-- <a id="d.en.4407"></a> --><!-- <a id="d.en.4155"></a> --><!-- <a id="d.en.4265"></a> --><!-- <a id="d.en.4222"></a> --><!-- <a id="d.en.4472"></a> --><!-- <a id="d.en.4230"></a> --><!-- <a id="d.en.4243"></a> --><!-- <a id="d.en.4015"></a> --><!-- <a id="d.en.4423"></a> --><!-- <a id="d.en.4466"></a> --><!-- <a id="d.en.4080"></a> --><!-- <a id="d.en.4488"></a> --><!-- <a id="d.en.4385"></a> --><!-- <a id="d.en.4032"></a> --><!-- <a id="d.en.4182"></a> --><!-- <a id="d.en.4235"></a> --><!-- <a id="d.en.4508"></a> --><!-- <a id="d.en.4510"></a> --><!-- <a id="d.en.4037"></a> --><!-- <a id="d.en.4287"></a> --><!-- <a id="d.en.4100"></a> --><!-- <a id="d.en.4282"></a> --><!-- <a id="d.en.4040"></a> --><!-- <a id="d.en.4446"></a> --><!-- <a id="d.en.4312"></a> --><!-- <a id="d.en.4168"></a> --><!-- <a id="d.en.4086"></a> --><!-- <a id="d.en.4209"></a> --><!-- <a id="d.en.4216"></a> --><!-- <a id="d.en.4060"></a> --><!-- <a id="d.en.4360"></a> --><!-- <a id="d.en.4375"></a> --><!-- <a id="d.en.4200"></a> --><!-- <a id="d.en.4359"></a> --><!-- <a id="d.en.4055"></a> --><!-- <a id="d.en.4308"></a> --><!-- <a id="d.en.4397"></a> --><!-- <a id="d.en.4197"></a> --><!-- <a id="d.en.4293"></a> --><!-- <a id="d.en.4437"></a> --><!-- <a id="d.en.4501"></a> --><!-- <a id="d.en.4421"></a> --><!-- <a id="d.en.4019"></a> --><!-- <a id="d.en.4426"></a> --><!-- <a id="d.en.4420"></a> --><!-- <a id="d.en.4029"></a> --><!-- <a id="d.en.4317"></a> --><!-- <a id="d.en.4069"></a> --><!-- <a id="d.en.4087"></a> --><!-- <a id="d.en.4496"></a> --><!-- <a id="d.en.4199"></a> --><!-- <a id="d.en.4063"></a> --><!-- <a id="d.en.4275"></a> --><!-- <a id="d.en.4296"></a> --><!-- <a id="d.en.4059"></a> --><!-- <a id="d.en.4094"></a> --><!-- <a id="d.en.4157"></a> --><!-- <a id="d.en.4433"></a> --><!-- <a id="d.en.4364"></a> --><!-- <a id="d.en.4504"></a> --><!-- <a id="d.en.4198"></a> --><!-- <a id="d.en.4109"></a> --><!-- <a id="d.en.4095"></a> --><!-- <a id="d.en.4409"></a> --><!-- <a id="d.en.4099"></a> --><!-- <a id="d.en.4408"></a> --><!-- <a id="d.en.4497"></a> --><!-- <a id="d.en.4469"></a> --><!-- <a id="d.en.4487"></a> --><!-- <a id="d.en.4067"></a> --><!-- <a id="d.en.4290"></a> --><!-- <a id="d.en.4185"></a> --><!-- <a id="d.en.4196"></a> --><!-- <a id="d.en.4213"></a> --><!-- <a id="d.en.4425"></a> --><!-- <a id="d.en.4079"></a> --><!-- <a id="d.en.4346"></a> --><!-- <a id="d.en.4333"></a> --><!-- <a id="d.en.4244"></a> --><!-- <a id="d.en.4201"></a> --><!-- <a id="d.en.4033"></a> --><!-- <a id="d.en.4401"></a> --><!-- <a id="d.en.4460"></a> --><!-- <a id="d.en.4245"></a> --><!-- <a id="d.en.4166"></a> --><!-- <a id="d.en.4455"></a> --><!-- <a id="d.en.4158"></a> --><!-- <a id="d.en.4388"></a> --><!-- <a id="d.en.4219"></a> --><!-- <a id="d.en.4020"></a> --><!-- <a id="d.en.4431"></a> --><!-- <a id="d.en.4490"></a> --><!-- <a id="d.en.4128"></a> --><!-- <a id="d.en.4263"></a> --><!-- <a id="d.en.4307"></a> --><!-- <a id="d.en.4350"></a> --><!-- <a id="d.en.4324"></a> --><!-- <a id="d.en.4387"></a> --><!-- <a id="d.en.4449"></a> --><!-- <a id="d.en.4052"></a> --><!-- <a id="d.en.4322"></a> --><!-- <a id="d.en.4283"></a> --><!-- <a id="d.en.4277"></a> --><!-- <a id="d.en.4451"></a> --><!-- <a id="d.en.4485"></a> --><!-- <a id="d.en.4349"></a> --><!-- <a id="d.en.4503"></a> --><!-- <a id="d.en.4046"></a> --><!-- <a id="d.en.4297"></a> --><!-- <a id="d.en.4108"></a> --><!-- <a id="d.en.4089"></a> --><!-- <a id="d.en.4152"></a> --><!-- <a id="d.en.4186"></a> --><!-- <a id="d.en.4300"></a> --><!-- <a id="d.en.4070"></a> --><!-- <a id="d.en.4392"></a> --><!-- <a id="d.en.4304"></a> --><!-- <a id="d.en.4439"></a> --><!-- <a id="d.en.4374"></a> --><!-- <a id="d.en.4400"></a> --><!-- <a id="d.en.4181"></a> --><!-- <a id="d.en.4124"></a> --><!-- <a id="d.en.4384"></a> --><!-- <a id="d.en.4057"></a> --><!-- <a id="d.en.4372"></a> --><!-- <a id="d.en.4499"></a> --><!-- <a id="d.en.4506"></a> --><!-- <a id="d.en.4441"></a> --><!-- <a id="d.en.4221"></a> --><!-- <a id="d.en.4163"></a> --><!-- <a id="d.en.4159"></a> --><!-- <a id="d.en.4463"></a> --><!-- <a id="d.en.4090"></a> --><!-- <a id="d.en.4066"></a> --><!-- <a id="d.en.4056"></a> --><!-- <a id="d.en.4204"></a> --><!-- <a id="d.en.4269"></a> --><!-- <a id="d.en.4028"></a> --><!-- <a id="d.en.4306"></a> --><!-- <a id="d.en.4205"></a> --><!-- <a id="d.en.4325"></a> --><!-- <a id="d.en.4493"></a> --><!-- <a id="d.en.4341"></a> --><!-- <a id="d.en.4062"></a> --><!-- <a id="d.en.4299"></a> --><!-- <a id="d.en.4396"></a> --><!-- <a id="d.en.4058"></a> --><!-- <a id="d.en.4104"></a> --><!-- <a id="d.en.4362"></a> --><!-- <a id="d.en.4494"></a> --><!-- <a id="d.en.4232"></a> --><!-- <a id="d.en.4112"></a> --><!-- <a id="d.en.4018"></a> --><!-- <a id="d.en.4021"></a> --><!-- <a id="d.en.4286"></a> --><!-- <a id="d.en.4014"></a> --><!-- <a id="d.en.4467"></a> --><!-- <a id="d.en.4044"></a> --><!-- <a id="d.en.4188"></a> --><!-- <a id="d.en.4215"></a> --><!-- <a id="d.en.4129"></a> --><!-- <a id="d.en.4267"></a> --><!-- <a id="d.en.4492"></a> --><!-- <a id="d.en.4027"></a> --><!-- <a id="d.en.4030"></a> --><!-- <a id="d.en.4440"></a> --><!-- <a id="d.en.4025"></a> --><!-- <a id="d.en.4475"></a> --><!-- <a id="d.en.4295"></a> --><!-- <a id="d.en.4328"></a> --><!-- <a id="d.en.4237"></a> --><!-- <a id="d.en.4435"></a> --><!-- <a id="d.en.4454"></a> --><!-- <a id="d.en.4110"></a> --><!-- <a id="d.en.4096"></a> --><!-- <a id="d.en.4309"></a> --><!-- <a id="d.en.4278"></a> --><!-- <a id="d.en.4336"></a> --><!-- <a id="d.en.4404"></a> --><!-- <a id="d.en.4393"></a> --><!-- <a id="d.en.4371"></a> --><!-- <a id="d.en.4210"></a> --><!-- <a id="d.en.4377"></a> --><!-- <a id="d.en.4153"></a> --><!-- <a id="d.en.4473"></a> --><!-- <a id="d.en.4430"></a> --><!-- <a id="d.en.4264"></a> --><!-- <a id="d.en.4491"></a> --><!-- <a id="d.en.4279"></a> --><!-- <a id="d.en.4280"></a> --><!-- <a id="d.en.4119"></a> --><!-- <a id="d.en.4144"></a> --><!-- <a id="d.en.4077"></a> --><!-- <a id="d.en.4251"></a> --><!-- <a id="d.en.4111"></a> --><!-- <a id="d.en.4281"></a> --><!-- <a id="d.en.4203"></a> --><!-- <a id="d.en.4162"></a> --><!-- <a id="d.en.4390"></a> --><!-- <a id="d.en.4412"></a> --><!-- <a id="d.en.4329"></a> --><!-- <a id="d.en.4149"></a> --><!-- <a id="d.en.4453"></a> --><!-- <a id="d.en.4127"></a> --><!-- <a id="d.en.4321"></a> --><!-- <a id="d.en.4097"></a> --><!-- <a id="d.en.4016"></a> --><!-- <a id="d.en.4598"></a> --><!-- <a id="d.en.4543"></a> --><!-- <a id="d.en.4545"></a> --><!-- <a id="d.en.4608"></a> --><!-- <a id="d.en.4590"></a> --><!-- <a id="d.en.4604"></a> --><!-- <a id="d.en.4539"></a> --><!-- <a id="d.en.4540"></a> --><!-- <a id="d.en.4594"></a> --><!-- <a id="d.en.4117"></a> --><!-- <a id="d.en.4599"></a> --><!-- <a id="d.en.4554"></a> --><!-- <a id="d.en.4602"></a> --><!-- <a id="d.en.4536"></a> --><!-- <a id="d.en.4515"></a> --><!-- <a id="d.en.4519"></a> --><!-- <a id="d.en.4601"></a> --><!-- <a id="d.en.4556"></a> --><!-- <a id="d.en.4577"></a> --><!-- <a id="d.en.4565"></a> --><!-- <a id="d.en.4076"></a> --><!-- <a id="d.en.4541"></a> --><!-- <a id="d.en.4582"></a> --><!-- <a id="d.en.4611"></a> --><!-- <a id="d.en.4537"></a> --><!-- <a id="d.en.4551"></a> --><!-- <a id="d.en.4555"></a> --><!-- <a id="d.en.4534"></a> --><!-- <a id="d.en.4575"></a> --><!-- <a id="d.en.4581"></a> --><!-- <a id="d.en.4591"></a> --><!-- <a id="d.en.4337"></a> --><!-- <a id="d.en.4570"></a> --><!-- <a id="d.en.4332"></a> --><!-- <a id="d.en.4054"></a> --><!-- <a id="d.en.4148"></a> --><!-- <a id="d.en.4288"></a> --><!-- <a id="d.en.4427"></a> --><!-- <a id="d.en.4470"></a> --><!-- <a id="d.en.4093"></a> --><!-- <a id="d.en.4048"></a> --><!-- <a id="d.en.4422"></a> --><!-- <a id="d.en.4190"></a> --><!-- <a id="d.en.4429"></a> --><!-- <a id="d.en.4049"></a> --><!-- <a id="d.en.4395"></a> --><!-- <a id="d.en.4142"></a> --><!-- <a id="d.en.4465"></a> --><!-- <a id="d.en.4276"></a> --><!-- <a id="d.en.4461"></a> --><!-- <a id="d.en.4343"></a> --><!-- <a id="d.en.4193"></a> --><!-- <a id="d.en.4406"></a> --><!-- <a id="d.en.4233"></a> --><!-- <a id="d.en.4373"></a> --><!-- <a id="d.en.4313"></a> --><!-- <a id="d.en.4339"></a> --><!-- <a id="d.en.4164"></a> --><!-- <a id="d.en.4226"></a> --><!-- <a id="d.en.4065"></a> --><!-- <a id="d.en.4250"></a> --><!-- <a id="d.en.4176"></a> --><!-- <a id="d.en.4464"></a> --><!-- <a id="d.en.4381"></a> --><!-- <a id="d.en.4489"></a> --><!-- <a id="d.en.4150"></a> --><!-- <a id="d.en.4261"></a> --><!-- <a id="d.en.4432"></a> --><!-- <a id="d.en.4301"></a> --><!-- <a id="d.en.4172"></a> --><!-- <a id="d.en.4331"></a> --><!-- <a id="d.en.4418"></a> --><!-- <a id="d.en.4036"></a> --><!-- <a id="d.en.4039"></a> --><!-- <a id="d.en.4083"></a> --><!-- <a id="d.en.4294"></a> --><!-- <a id="d.en.4419"></a> --><!-- <a id="d.en.4023"></a> --><!-- <a id="d.en.4248"></a> --><!-- <a id="d.en.4220"></a> --><!-- <a id="d.en.4500"></a> --><!-- <a id="d.en.4394"></a> --><!-- <a id="d.en.4316"></a> --><!-- start of SM footer -->
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