<?php
require 'vendor/autoload.php';
use App\Tests\MainTest;
use App\Tests\SearchMemberTest;
use App\Tests\ReportFinancialTest;

try {
    // $test = new MainTest();
    // $test->goToPage();

    // $formFillingTest = new SearchMemberTest();
    // $formFillingTest->testSearchMember('softi');

    $reportFinancial = new ReportFinancialTest();
    $reportFinancial->filterReport('01-03-2016', '31-03-2021');
} catch (\Exception $e) {
    echo "\nTest failed: " . $e->getMessage() . "\n";
} finally {
    // Ensure the browser is closed, even if an error occurs
    echo "\nWaiting for 5 seconds before closing the browser...\n";
    sleep(5);
    
    // $test->tearDown();
    // $formFillingTest->tearDown();
    $reportFinancial->tearDown();
}