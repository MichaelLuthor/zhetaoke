<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkGoods;
class ZtkGoodsFetcher_Test extends TestCase {
    /**
     * 
     */
    public function test_fetchAll() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchAll();
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchByVideo(){
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchByVideo();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchByGuess() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchByGuess();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchTwoHoursHotTopList() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchTwoHoursHotTopList();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchTodayHotTopList() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchTodayHotTopList();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchPopTopList() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchPopTopList();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchYongJinTopList() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchYongJinTopList();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchInvalid() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchInvalid();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchDongdongQiang() {
        $goods = ZheTaoKe::getInstance()->goods()->setPageSize(10)->fetchDongdongQiang();
        $this->assertNotEmpty($goods);
        $this->assertEquals(10, count($goods));
        $this->assertInstanceOf(ZtkGoods::class, $goods[0]);
    }
    
    /**
     * 
     */
    public function test_fetchOneByTaoId() {
        $goods = ZheTaoKe::getInstance()->goods()->fetchOneByTaoId('599424494783');
        $this->assertInstanceOf(ZtkGoods::class, $goods);
        $this->assertEquals(599424494783, $goods->taoId);
        
        $goods = ZheTaoKe::getInstance()->goods()->fetchOneByTaoId('099424494783');
        $this->assertNull($goods);
    }
}