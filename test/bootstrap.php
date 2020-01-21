<?php
use sige\zhetaoke\ZheTaoKe;
require __DIR__.'/../src/__autoloader.php';
require __DIR__.'/config.php';

ZheTaoKe::getInstance()
    ->setConfig('appkey', ZHETAOKE_TEST_APPKEY)
    ->setConfig('sid', ZHETAOKE_TEST_SID)
    ->setConfig('pid', ZHETAOKE_TEST_PID);