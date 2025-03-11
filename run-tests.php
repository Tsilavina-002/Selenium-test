<?php
require 'vendor/autoload.php';
use App\Tests\MainTest; // Import the MainTest class
use App\Tests\SearchMemberTest;

try {
    // $test = new MainTest();
    // $test->goToPage();

    $formFillingTest = new SearchMemberTest();
    $formFillingTest->testSearchMember('softi');

} catch (\Exception $e) {
    echo "\nTest failed: " . $e->getMessage() . "\n";
} finally {
    // Ensure the browser is closed, even if an error occurs
    echo "\nWaiting for 5 seconds before closing the browser...\n";
    sleep(5);
    
    // $test->tearDown();
    $formFillingTest->tearDown();
}