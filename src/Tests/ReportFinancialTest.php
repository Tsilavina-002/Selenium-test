<?php
namespace App\Tests;

use App\Utils\BaseTest;
use App\Utils\Config;
use Facebook\WebDriver\WebDriverBy;
use Facebook\WebDriver\WebDriverWait;
use Facebook\WebDriver\WebDriverExpectedCondition;

class ReportFinancialTest extends BaseTest
{
    public function filterReport($startDate, $endDate)
    {
        try {
            // Go to reportFinancial page
            $this->driver->get(Config::DOMAIN . '/report/policy/reportFinancial');

            echo "Filling search field... then wait 20s for result...\n";
            $startDateField = $this->driver->findElement(WebDriverBy::id('mas_policy_newreportform_start'));
            $startDateField->sendKeys($startDate);
            $endDateField = $this->driver->findElement(WebDriverBy::id('mas_policy_newreportform_end'));
            $endDateField->sendKeys($endDate);
            $paidContractCheckbox = $this->driver->findElement(WebDriverBy::id('mas_policy_newreportform_contrat_paid'));
            $paidContractCheckbox->click();

            $validateButton = $this->driver->findElement(WebDriverBy::cssSelector('.alignbutton button[type="submit"]'));
            $validateButton->click();

            // Wait for the table to load
            $wait = new WebDriverWait($this->driver, 20);
            $table = $wait->until(
                WebDriverExpectedCondition::presenceOfElementLocated(WebDriverBy::cssSelector('table.policyTable'))
            );
            
            // if ($table)
            //     echo "Table element found.";

            // Now, find the row with the label "Nombre de contrats payés"
            $row = $this->driver->findElement(WebDriverBy::xpath("//table[contains(@class, 'policyTable')]//td[contains(text(), 'Nombre de contrats payés')]"));
            
            // Get the next sibling <td> which contains the value "12 161"
            $value = $row->findElement(WebDriverBy::xpath('following-sibling::td'))->getText();
            
            // Echo the result
            echo "Nombre de contrats payés: " . $value . "\n";
            echo "Search done!\n";
        } catch (\Exception $e) {
            echo "SearchMemberTest failed: " . $e->getMessage() . "\n";
            throw $e;
        }
    }
}
