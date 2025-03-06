<?php 
namespace App\Tests;

use App\Utils\Config;
use App\Utils\BaseTest;

class MainTest extends BaseTest
{
    public function testLogin()
    {
        try {
            echo "Logged in successfully.\n";

            // Navigate to another page after logging in
            $this->driver->get(Config::DOMAIN . '/partner/show/150411');

            // Verify that we're on the right page
            echo "Page title: " . $this->driver->getTitle() . "\n";
            echo "Current URL: " . $this->driver->getCurrentURL() . "\n";

        } catch (\Exception $e) {
            echo "Test failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
