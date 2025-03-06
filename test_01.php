<?php
require 'vendor/autoload.php';

use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverExpectedCondition;

// Start ChromeDriver
$host = 'http://localhost:4444';
$capabilities = DesiredCapabilities::chrome();
$driver = RemoteWebDriver::create($host, $capabilities);

// Navigate to Google
$driver->get('https://www.google.com');

// Find the search box and perform a search
$searchBox = $driver->findElement(WebDriverBy::name('q'));
$searchBox->sendKeys('Selenium WebDriver');
$searchBox->submit();

// Wait for the results to load and display the title
$driver->wait()->until(
    WebDriverExpectedCondition::titleContains('Selenium WebDriver')
);
echo "Title is: " . $driver->getTitle();

// Close the browser
$driver->quit();
?>
