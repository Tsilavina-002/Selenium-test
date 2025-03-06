<?php

namespace App\Utils;

class Config
{
    // Selenium Server URL
    const SELENIUM_HOST = 'http://localhost:4444';

    // Website domain name
    const DOMAIN = 'http://afafi.bmas.fr';

    // Input names for login form
    const USERNAME_INPUT_NAME = '_username';
    const PASSWORD_INPUT_NAME = '_password';

    // Corresponding test values
    const TEST_USERNAME = 'sadmin_';
    const TEST_PASSWORD = 'philoctet';

    // Success indicator CSS selector (if needed)
    const SUCCESS_INDICATOR_SELECTOR = '.navbar-text.pull-right';
}
