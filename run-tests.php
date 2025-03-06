<?php
require 'vendor/autoload.php';
use App\Tests\MainTest; // Import the MainTest class

try {
    // Run the test
    $test = new MainTest();
    $test->testLogin();
} catch (\Exception $e) {
    echo "Test failed: " . $e->getMessage() . "\n";
} finally {
    echo "Waiting for 5 seconds before closing the browser...\n";
    // Ensure the browser is closed, even if an error occurs
    sleep(5);
    $test->tearDown();
}