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

            // Wait for the table to load
            $wait = new WebDriverWait($this->driver, 10);
            $table = $wait->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('table.table.table-bordered.table-condensed.table-hover tbody'))
            );

            // Count the rows in the tbody
            $rows = $table->findElements(WebDriverBy::cssSelector('tr'));

            if (count($rows) === 1) {
                // Check if the row contains the "no results" message
                $noResultsRow = $rows[0];
                $noResultsText = $noResultsRow->findElement(WebDriverBy::cssSelector('td div strong'))->getText();

                if (strpos($noResultsText, '0 records') !== false) {
                    echo "No results found.\n";
                } else {
                    echo "Unexpected result: " . $noResultsText . "\n";
                }
            } else {
                echo "Number of rows found: " . count($rows) . "\n";

                // Process the rows
                foreach ($rows as $row) {
                    $cells = $row->findElements(WebDriverBy::cssSelector('td'));
                    foreach ($cells as $cell) {
                        echo $cell->getText() . "\t";
                    }
                    echo "\n";
                }
            }
            echo "Search done!\n";
        } catch (\Exception $e) {
            echo "SearchMemberTest failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
