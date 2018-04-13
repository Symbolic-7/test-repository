<?php
/**
 * Created by PhpStorm.
 * User: ilopX
 * Date: 20.08.2015
 * Time: 12:45
 * Name: Web demos proj
 * Project: https://github.com/ilopX/web-demos-proj
 * Demo: https://github.com/ilopX/web-demos-proj/tree/master/projects/Codeception-install
 * This file: https://github.com/ilopX/web-demos-proj/blob/master/projects/Codeception-install/run-selenium-server.php
 */

define('STDIN', fopen('php://stdin', 'r'));

$thisPath = __DIR__ . '\\selenium-server\\';
$batFile = 'run-selenium-server.bat';
$seleniumURL = 'http://selenium-release.storage.googleapis.com/3.11/selenium-server-standalone-3.11.0.jar';
$chromeDriverURL = 'http://chromedriver.storage.googleapis.com/2.36/chromedriver_win32.zip';
$geckoDriverURL = 'https://github.com/mozilla/geckodriver/releases/download/v0.20.1/geckodriver-v0.20.1-win64.zip';
$phantomJsURL = 'https://bitbucket.org/ariya/phantomjs/downloads/phantomjs-2.1.1-windows.zip';

if (!file_exists($thisPath)) {
    mkdir($thisPath, 0777, true);
}

$seleniumBase = basename($seleniumURL);
if (!file_exists($thisPath . $seleniumBase)) {
    echo "Download $seleniumBase...\n";
    file_put_contents($thisPath . $seleniumBase, fopen($seleniumURL, 'r'));
}

downloadArchiveDriver($chromeDriverURL, 'chromedriver');
downloadArchiveDriver($geckoDriverURL, 'geckodriver');
#downloadArchiveDriver($phantomJsURL, 'phantomjs');

if (!is_file($thisPath . $batFile)) {
    echo "Create $batFile\n";
    file_put_contents($thisPath . $batFile, "java -Dwebdriver.chrome.driver={$thisPath}chromedriver.exe -jar {$thisPath}{$seleniumBase}");
    file_put_contents($thisPath . $batFile, "java -Dwebdriver.gecko.driver={$thisPath}geckodriver.exe -jar {$thisPath}{$seleniumBase}");
    #file_put_contents($thisPath . $batFile, "selenium-server {$thisPath}phantomjs.exe --webdriver=4444");
}
system("java -Dwebdriver.chrome.driver={$thisPath}chromedriver.exe -jar {$thisPath}{$seleniumBase}"); //запуск chrome
system("java -Dwebdriver.gecko.driver={$thisPath}geckodriver.exe -jar {$thisPath}{$seleniumBase}");
#system("{$thisPath}phantomjs-2.1.1-windows\bin\phantomjs.exe --webdriver=4444"); //запуск PhantomJS

/**
 * @param string $urlDriver
 * @param string $nameDriver
 */
function downloadArchiveDriver($urlDriver, $nameDriver)
{
    $driverBase = basename($urlDriver);
    $thisPath = __DIR__ . '\\selenium-server\\';
    if (!file_exists($thisPath . $nameDriver . '.exe')) {
        echo "Download $driverBase...\n";
        file_put_contents($thisPath . $driverBase, fopen($urlDriver, 'r'));

        echo "Unzip $driverBase...\n";
        $zip = new ZipArchive;
        $zip->open($thisPath . $driverBase);
        $zip->extractTo($thisPath);
        $zip->close();

        unlink($thisPath . $driverBase);
    }
}