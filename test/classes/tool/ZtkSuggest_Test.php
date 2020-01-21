<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkSuggest_Test extends TestCase {
    public function test_fetchAll() {
        $response = ZheTaoKe::getInstance()->suggest()->setcontent('手机')->fetchAll();
        $this->assertNotEmpty($response);
    }
}