<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkAccount;
class ZtkAccountFetcher {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 第几页，每页最多返回100个 
     * @param string $page 
     * @return self 
    */
    public function setPage( $page ) {
        $this->setParam('page', $page); 
        return $this;
    }
    
    /**
     * 还剩下几天授权过期，取值范围0-7之间的整数，比如值为3，表示获取还剩下3天授权过期淘客账号信息 
     * @param string $expire_day 
     * @return self 
    */
    public function setExpireDay( $day ) {
        $this->setParam('expire_day', $day); 
        return $this;
    }
    
    /**
     * 拉取账号
     * @return array
     */
    public function fetchAll() {
        $response = ZheTaoKe::getInstance()->call('open_taokeshouquaninfo', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("无法拉取账号信息：[{$response['status']}]{$response['content']}");
        }
        
        $list = array();
        foreach ( $response['data'] as $gdata ) {
            $item = new ZtkAccount();
            $item->applyDataFromApiResponse($gdata);
            $list[] = $item;
        }
        return $list;
    }
}