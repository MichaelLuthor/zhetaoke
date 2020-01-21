<?php
use PHPUnit\Framework\TestCase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkOrder;
class ZtkOrderFetcher_Test extends TestCase {
    /**
     * 
     */
    public function test_fetchAll() {
        # 四格的账号里这个时间是有数据的, 要不放进配置里？ 
        $time = 1579275870;
        $response = ZheTaoKe::getInstance()->order()
            ->setStartTime(date('Y-m-d H:i:s', $time))
            ->setEndTime(date('Y-m-d H:i:s', $time+600))
            ->fetchAll();
        $this->assertInstanceOf(ZtkOrder::class, $response['results']['publisher_order_dto'][0]);
    }
}