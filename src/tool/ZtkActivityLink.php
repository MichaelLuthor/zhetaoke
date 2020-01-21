<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkActivityLink {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 推广位id，mm_xx_xx_xx pid三段式中的第三段
     * @param string $id 
     * @return self
     */
    public function setAdzoneId( $id ) {
        $this->setParam('adzone_id', $id);
        return $this;
    }
    
    /**
     * 推广位id，mm_xx_xx_xx pid三段式中的第二段
     * @param int $site_id 
     * @return self
     */
    public function setSiteId( $id ) {
        $this->setParam('site_id', $id);
        return $this;
    }
    /**
     * 官方活动ID，从官方活动页获取。点击查看官方活动
     * @param string $promotion_scene_id 
     * @return self
     */
    public function setPromotionSceneId( $id ) {
        $this->setParam('promotion_scene_id', $id);
        return $this;
    }
    
    /**
     * 1：PC，2：无线，默认：１
     * @param string $platform 
     * @return self
     */
    public function setPlatform( $platform ) {
        $this->setParam('platform', $platform);
        return $this;
    }
    /**
     * 自定义输入串，英文和数字组成，长度不能大于12个字符，区分不同的推广渠道
     * @param string $union_id 
     * @return self
     */
    public function setUnionId( $id ) {
        $this->setParam('union_id', $id);
        return $this;
    }
    /**
     * 渠道关系ID，仅适用于渠道推广场景
     * @param string $relation_id 
     * @return self
     */
    public function setRelationId( $id ) {
        $this->setParam('relation_id', $id);
        return $this;
    }
    
    /**
     * 
     */
    public function convert() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        
        $response = ZheTaoKe::getInstance()->call('open_activitylink_get', $this->getParams());
        if ( isset( $response['status'] ) && 200 !== $response['status'] ) {
            throw new \Exception("转换失败：{$response['content']}");
        }
        
        return $response['tbk_sc_activitylink_toolget_response']['data'];
    }
}