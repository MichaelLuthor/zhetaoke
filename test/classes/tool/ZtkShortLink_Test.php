<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
class ZtkShortLink_Test extends TestCase {
    /**
     * 
     */
    public function test_convert() {
        $link = ZheTaoKe::getInstance()->shortUrl()->baidu('https://www.taobao.com');
        $this->assertNotEmpty($link);
        
        $link = ZheTaoKe::getInstance()->shortUrl()->sina('https://www.taobao.com');
        $this->assertNotEmpty($link);
        
        $link = ZheTaoKe::getInstance()->shortUrl()->sohu('https://www.taobao.com');
        $this->assertNotEmpty($link);
        
        $link = ZheTaoKe::getInstance()->shortUrl()->taobao('https://s.click.taobao.com/H4zazPx');
        $this->assertNotEmpty($link);
    }
}