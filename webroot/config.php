<?php
error_reporting(-1);              // Report all type of errors
ini_set('display_errors', 1);     // Display all errors 
ini_set('output_buffering', 0);   // Do not buffer outputs, write directly

/**
 * Define Me paths.
 *
 */
define('ME_INSTALL_PATH', __DIR__ . '/..');
define('ME_THEME_PATH', ME_INSTALL_PATH . '/theme/render.php');
 
/**
 * Include bootstrapping functions.
 *
 */
include(ME_INSTALL_PATH . '/src/bootstrap.php');
 
 
/**
 * Start the session.
 *
 */
session_name(preg_replace('/[:\.\/-_]/', '', __DIR__));
session_start();
 
 
/**
 * Create the me variable.
 *
 */
$me = array();
 
 
/**
 * Site wide settings.
 *
 */
 
$me['lang']         = 'sv';
$me['title_append'] = ' | MassMusik';

//Footer
$me['footer'] = <<<EOD
<footer class='sitefooter'>
<p>Copyright 2013+ www.massmusik.se | <a href='admin.php'>Administrera</a> |  <a href='http://validator.w3.org/unicorn/check?ucn_uri=referer&amp;ucn_task=conformance' target='blank'>Unicorn</a>
</footer>
EOD;

$me['navbar'] = array(
  'items' => array(
    'hem' => 
    array('text'=>'Hem', 'url'=>'index.php', 'title' => 'MassMusik'),
    'musik' => 
    array('text'=>'Musik', 'url'=>'musik.php', 'title' => 'Musik Bibliotek'),
    'nyheter' => 
    array('text'=>'Nyheter', 'url'=>'nyheter.php', 'title' =>  'Nyheter'),
    'om' => 
    array('text'=>'Om', 'url'=>'om.php', 'title' => 'Om MassMusik'),
	    'tävling' => 
    array('text'=>'Tävling', 'url'=>'game.php', 'title' => 'Tävling'),
    
  ),
  'callback' => function($url) {
    if(basename($_SERVER['SCRIPT_FILENAME']) == $url) {
      return true;
    }
  }
); 



function generateMenu($items) {
  $html = "<nav>\n";
  foreach($items as $item) {
    $html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
  }
  $html .= "</nav>\n";
  return $html;
}

class CNavigation {
  public static function GenerateMenu($items) {
    $html = "<nav>\n";
    foreach($items as $item) {
      $html .= "<a href='{$item['url']}'>{$item['text']}</a>\n";
    }
    $html .= "</nav>\n";
    return $html;
  }
};

/**
 * Theme related settings.
 *
 */
$me['stylesheets'] = array('css/style.css');
$me['favicon']    = 'logga.ico';

/**
 * Settings for JavaScript.
 *
 */
$me['modernizr'] = 'js/modernizr.js';

/**
 * Settings for JavaScript.
 *
 */
$me['jquery'] = '//ajax.googleapis.com/ajax/libs/jquery/1.10.1/jquery.min.js';
//$me['jquery'] = null; // To disable jQuery

/**
 * Settings for JavaScript.
 *
 */
$me['javascript_include'] = array();
//$me['javascript_include'] = array('js/main.js'); // To add extra javascript files

//Google analytics
$me['google_analytics'] = 'UA-22093351-1';// Set to null to disable google analytics 

/**
 * Settings for the database.
 *
 */
$me['database']['dsn']            = 'mysql:host=blu-ray.student.bth.se;dbname=mals13;';
$me['database']['username']       = 'mals13';
$me['database']['password']       = '724;K8=x';
$me['database']['driver_options'] = array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'UTF8'");
