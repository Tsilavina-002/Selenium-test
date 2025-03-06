<?php
require 'vendor/autoload.php';
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;
use Facebook\WebDriver\WebDriverWait;

// Start ChromeDriver
$host = 'http://localhost:4444';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

// Navigate to Google
$driver->get('http://afafi.bmas.fr/login');

//detecter les champs email et mot de passe puis les remplir
$mail = $driver->findElement(WebDriverBy::NAME('_username'));
$mail->sendKeys('sadmin_');
$pass = $driver->findElement(WebDriverBy::NAME('_password'));
$pass->sendKeys('philoctet');
$pass->submit();

sleep(5);

$driver->quit();