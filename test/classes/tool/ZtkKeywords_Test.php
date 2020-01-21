<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkKeywords_Test extends TestCase {
    public function test_fetchAll() {
        $response = ZheTaoKe::getInstance()->keywords()->setPageSize(10)->fetchAll();
        $this->assertCount(10, $response);
    }
}