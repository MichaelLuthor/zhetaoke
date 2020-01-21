<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkPublisherFetcher_Test extends TestCase {
    /**
     * 
     */
    public function test_fetchAll() {
        $response = ZheTaoKe::getInstance()->publisher()->setRelationApp('common')->setInfoType(1)->fetchAll();
        $this->assertEquals(0, $response['total_count']);
    }
}