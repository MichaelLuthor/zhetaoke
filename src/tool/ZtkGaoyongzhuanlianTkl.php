<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
/**
 * 高佣转链API接口
 * @author 四格
 * @link http://www.zhetaoke.com/user/open/open_gaoyongzhuanlian.aspx
 */
class ZtkGaoyongzhuanlianTkl {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 返回结果整合高拥转链API、解析商品编号API、全网商品详情API、淘口令创建API，已经自动判断和拼接使用全网G券还是全网S券。
     * @var integer
     */
    const SIGNURL_FULL = 5;
    
    /**
     * 返回结果整合高拥转链API、解析商品编号API、商品简版详情API、淘口令创建API，已经自动判断和拼接使用全网G券还是全网S券。
     * @var integer
     */
    const SIGNURL_MID = 4;
    
    /**
     * 返回结果整合高拥转链API、解析商品编号API，已经自动判断和拼接使用全网G券还是全网S券。
     * @var integer
     */
    const SIGNURL_LESS = 3;
    
    /**
     * 返回官方高拥转链接口结果，需要自行判断和拼接使用全网G券或者全网S券。
     * 表示返回淘宝联盟请求地址，大家拿到地址后再用自己的服务器二次请求即可获得最终结果，返回https安全链接。
     * @var integer
     */
    const SIGNURL_OFFICIAL_HTTPS = 2;
    /**
     * 返回官方高拥转链接口结果，需要自行判断和拼接使用全网G券或者全网S券。
     * 表示返回淘宝联盟请求地址，大家拿到地址后再用自己的服务器二次请求即可获得最终结果，返回http链接。
     * @var integer
     */
    const SIGNURL_OFFICIAL_HTTP = 1;
    
    /**
     * 直接返回最终结果。返回官方高拥转链接口结果，需要自行判断和拼接使用全网G券或者全网S券。
     * @var integer
     */
    const SIGNURL_RAW = 0;
    
    /**
     * 设置商品链接
     * @param string $link
     * @return self
     */
    public function setLink( $link ) {
        $this->setParam('tkl', $link);
        return $this;
    }
    
    /**
     * 设置淘口令
     * @param string $link
     * @return self
     */
    public function setTkl( $tkl ) {
        $this->setParam('tkl', $tkl);
        return $this;
    }
    
    /**
     * 渠道关系ID，仅适用于渠道推广场景。
     * @param string $id
     * @return self
     */
    public function setRelationId( $id ) {
        $this->setParam('relation_id', $id);
        return $this;
    }
    
    /**
     * 返回链接类型
     * @param integer $type
     * @return self
     */
    public function setSignUrlType ( $type ) {
        $this->setParam('signurl', $type);
        return $this;
    }
    
    /**
     * 转换
     * @return array
     */
    public function convert() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $this->setParam('pid', ZheTaoKe::getInstance()->getConfig('pid'));
        
        $response = ZheTaoKe::getInstance()->call('open_gaoyongzhuanlian_tkl', $this->getParams());
        return $response['tbk_privilege_get_response']['result']['data'];
    }
}