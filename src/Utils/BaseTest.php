<?php

namespace App\Utils;

use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\WebDriverExpectedCondition;

abstract class BaseTest
{
    protected RemoteWebDriver $driver;

    public function __construct()
    {
        // Automatically call setUp() when the test class is instantiated
        $this->setUp();
    }
    
    public function setUp(): void
    {
        // Use the SELENIUM_HOST constant from Config
        $host = Config::SELENIUM_HOST; 
        $capabilities = DesiredCapabilities::chrome();
        $this->driver = RemoteWebDriver::create($host, $capabilities);

        // Log in automatically before each test
        $this->login();
    }

    private function login(): void
    {
        $this->driver->get(Config::DOMAIN . '/login'); // Navigate to the login page

        // Wait for username field to load
        $wait = new WebDriverWait($this->driver, 20);
        $usernameField = $wait->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::name(Config::USERNAME_INPUT_NAME))
        );
        $usernameField->sendKeys(Config::TEST_USERNAME); // Enter username

        $passwordField = $this->driver->findElement(WebDriverBy::name(Config::PASSWORD_INPUT_NAME));
        $passwordField->sendKeys(Config::TEST_PASSWORD); // Enter password

        $passwordField->submit(); // Submit the login form

        // Wait for the page to load after login
        $wait->until(
            WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector(Config::SUCCESS_INDICATOR_SELECTOR))
        );
    }

    public function tearDown(): void
    {
        $this->driver->quit();
    }
}
