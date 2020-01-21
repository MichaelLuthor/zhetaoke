<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkShopFetcher {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 备案的网站id, mm_xx_xx_xx pid三段式中的第二段 
     * @param string $id 
     * @return self 
    */
    public function setSiteId( $id ) {
        $this->setParam('site_id', $id); 
        return $this;
    }

    /**
     * 需返回的字段列表，如：user_id,click_url 
     * @param string $fields 
     * @return self 
    */
    public function setFields( $fields ) {
        $this->setParam('fields', $fields); 
        return $this;
    }

    /**
     * 卖家ID串，用','分割，可通过全网商品详情API接口获得,seller_id字段 
     * @param string $user_ids 
     * @return self 
    */
    public function setUserIds( $userIds ) {
        $this->setParam('user_ids', implode(',', $userIds)); 
        return $this;
    }

    /**
     * 链接形式：1：PC，2：无线，默认：1 
     * @param string $platform 
     * @return self 
    */
    public function setPlatform( $platform ) {
        $this->setParam('platform', $platform); 
        return $this;
    }

    /**
     * 广告位ID，区分效果位置 
     * @param string $adzone_id 
     * @return self 
    */
    public function setAdzoneId( $id ) {
        $this->setParam('adzone_id', $id); 
        return $this;
    }

    /**
     * 自定义输入串，英文和数字组成，长度不能大于12个字符，区分不同的推广渠道 
     * @param string $unid 
     * @return self 
    */
    public function setUnid( $unid ) {
        $this->setParam('unid', $unid); 
        return $this;
    }

    /**
     * 值为1或者2，表示返回淘宝联盟请求地址，大家拿到地址后再用自己的服务器二次请求即可获得最终结果，值为1返回http链接，值为2返回https安全链接，值为0表示直接返回最终结果。 
     * @param int $signurl 
     * @return self 
    */
    public function setSignUrl( $signurl ) {
        $this->setParam('signurl', $signurl); 
        return $this;
    }
    
    /**
     * 
     */
    public function fetchAll() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $response = ZheTaoKe::getInstance()->call('open_shop_convert', $this->getParams());
        $response = $response['tbk_sc_shop_convert_response']['results']['n_tbk_shop'];
        
        $list = array();
        foreach ( $response as $item ) {
            $list[$item['user_id']] = $item['click_url'];
        }
        return $list;
    }
}