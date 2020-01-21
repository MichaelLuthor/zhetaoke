<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkActivity_Test extends TestCase {
    public function test_activity() {
        $activity = ZheTaoKe::getInstance()->activity()->fetchOneById('1571715733668');
        $this->assertEquals('1571715733668', $activity->activityId);
        
        $link = $activity->getShareLinkConverter()
            ->setAdzoneId(ZHETAOKE_TEST_ADZONE_ID)
            ->setSiteId(ZHETAOKE_TEST_SITE_ID)
            ->convert();
        $this->assertNotEmpty($link);
    }
}