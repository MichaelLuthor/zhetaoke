<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkActivity;
/**
 *
 */
class ZtkActivityFetcher {
    /**
     *
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 平台类型：PC
     * @var integer
     */
    const PLATFORM__TYPE_PC = 1;
    
    /**
     * 平台类型：无线
     * @var integer
     */
    const PLATFORM_TYPE_MOBILE = 2;
    
    /**
     * 投放平台，无线或PC，1为PC，2为无线
     * @return self
     */
    public function setPlatformType( $type ) {
        $this->setParam('platformType',  $type);
        return $this;
    }
    
    /**
     * 拉取所有活动信息
     * @return array
     */
    public function fetchAll() {
        $response = ZheTaoKe::getInstance()->call('api_activity', $this->getParams());
        if ( '无符合条件的数据' === $response['content'] ) {
            return [];
        }
        
        if ( 200 !== $response['status'] ) {
            throw new \Exception("Failed to fetch activities from zhetaoke, status error : {$response['status']}");
        }
        
        $list = array();
        foreach ( $response['content'] as $gdata ) {
            $activity = new ZtkActivity();
            $activity->applyDataFromApiResponse($gdata);
            $list[] = $activity;
        }
        
        return $list;
    }
    
    /**
     * 根据ID获取活动信息
     * @param unknown $id
     * @return ZtkActivity
     */
    public function fetchOneById( $id ) {
        $this->setParam('activityId', $id);
        $response = $this->fetchAll();
        return isset($response[0]) ? $response[0] : null;
    }
}