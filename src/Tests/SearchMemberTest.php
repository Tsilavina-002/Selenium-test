<?php
namespace App\Tests;

use App\Utils\Config;
use App\Utils\BaseTest;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class SearchMemberTest extends BaseTest
{
    public function testSearchMember()
    {
        try {
            // Navigate to the form page
            // $this->driver->get(Config::DOMAIN . '/form-page');

            echo "Filling search field...";
            $nameField = $this->driver->findElement(WebDriverBy::id('mas_partner_searchform_firstname'));
            $nameField->sendKeys('softi');

            $submitButton = $this->driver->findElement(WebDriverBy::cssSelector('button[type="submit"]'));
            $submitButton->click();

            // Wait for the results to load (optional but recommended to ensure the page is ready)
            $wait = new WebDriverWait($this->driver, 10);  // Wait up to 10 seconds
            $wait->until(WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::tagName('tbody'))); // Wait until <tbody> is present

            // Find the <tbody> element
            $tbody = $this->driver->findElement(WebDriverBy::tagName('tbody'));

            // Count the number of <tr> elements inside <tbody>
            $rows = $tbody->findElements(WebDriverBy::tagName('tr'));

            // Check if the result is empty (e.g., no matching records)
            if (count($rows) == 1 && $rows[0]->getText() == "page 1/0 - 0 records") {
                echo "No results found.\n";
            } else {
                echo "Number of rows found: " . count($rows) . "\n";
                // You can now perform further operations based on the number of rows
            }
            
            echo "Search done!\n";
        } catch (\Exception $e) {
            echo "SearchMemberTest failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
