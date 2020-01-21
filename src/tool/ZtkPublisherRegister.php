<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkPublisherRegister {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 淘宝客邀请渠道的邀请码
     * @param string $
     * @return self
     */
    public function setInviterCode( $code ) {
        $this->setParam('code', $code);
        return $this;
    }
    
    /**
     * 淘宝客邀请会员的邀请码
     * @param string $code
     * @return self
     */
    public function setInviterCodeS($code) {
        $this->setParam('inviter_code_s', $code);
        return $this;
    }
    
    /**
     * 代理授权，并登记备案后，返回渠道信息至回调地址。
     * @param string $url
     * @return self
     */
    public function setBackUrl( $url ) {
        $this->setParam('backurl', $url);
        return $this;
    }
    
    /**
     * 渠道备注，此内容建议填写用户唯一标识（比如用户编号，账号等唯一字段），跟返回的relation_id字段做关联。
     * @param string $note
     * @return self
     */
    public function setSNote( $note ) {
        $this->setParam('s_note', $note);
        return $this;
    }
    
    /**
     * 淘客授权页面类型，1：电脑版授权页面，0：手机版授权页面，默认值1
     * @param string $type
     * @return self
     */
    public function set($type) {
        $this->setParam('type', $type);
        return $this;
    }
    
    /**
     * 注册
     * @return mixed
     */
    public function register() {
        $response = ZheTaoKe::getInstance()->call('open_sc_publisher_save', $this->getParams());
        return $response;
    }
}