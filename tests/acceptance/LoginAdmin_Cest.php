<?php


class LoginAdmin_Cest
{
    public function _before(AcceptanceTester $I)
    {
    }

    public function _after(AcceptanceTester $I)
    {
    }

    // tests
    public function tryToTest(AcceptanceTester $I)
    {
  /*      $I->amOnPage('admin/');
        $I->waitForElement(['class' => 'input-wrapper'],30);
        $I->fillField('username', 'admin');
        $I->fillField('password', 'admin');
        $I->click(['name' => 'login']);
        $I->waitForElement(['id' => 'sidebar']);
        $I->seeElement(['id' => 'widget-stats']);
  */

  $I->amOnUrl('https://codeception.com/docs/modules/WebDriver#Selenium');
  $I->wait(60);
    }
}
