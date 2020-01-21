<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkActivity;
class ZtkActivityFetcher_Test extends TestCase {
    /**
     * 
     */
    public function test_fetchAll() {
        $activities = ZheTaoKe::getInstance()->activity()->fetchAll();
        $this->assertNotEmpty($activities);
        $this->assertInstanceOf(ZtkActivity::class, $activities[0]);
    }
    
    /**
     * 
     */
    public function test_fetchOneById() {
        $activity = ZheTaoKe::getInstance()->activity()->fetchOneById('1571715733668');
        $this->assertNotNull($activity);
        $this->assertInstanceOf(ZtkActivity::class, $activity);
    }
}