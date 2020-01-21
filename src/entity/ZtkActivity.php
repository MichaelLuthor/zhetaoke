<?php
namespace sige\zhetaoke\entity;
use sige\zhetaoke\util\ZtkEntityBase;
use sige\zhetaoke\ZheTaoKe;
/**
 * 
 */
class ZtkActivity extends ZtkEntityBase {
    /**
     * 获取推广链接转换器
     * @return ZtkActivityLink
     */
    public function getShareLinkConverter() {
        $converter = ZheTaoKe::getInstance()->activityShareLinkConvert();
        $converter->setPromotionSceneId($this->activityId);
        return $converter;
    }
}