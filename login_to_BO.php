<?php
require 'vendor/autoload.php';
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;

$host = 'http://localhost:4444';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

$driver->get('http://afafi.bmas.fr/login');

$mail = $driver->findElement(WebDriverBy::NAME('_username'));
$mail->sendKeys('sadmin_');
$pass = $driver->findElement(WebDriverBy::NAME('_password'));
$pass->sendKeys('philoctet');
$pass->submit();

sleep(5);

$driver->quit();