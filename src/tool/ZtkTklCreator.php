<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkTklCreator {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 口令弹框内容，长度大于5个字符，如：美美小编精心推荐。请注意，该参数需要进行Urlencode编码后传入。。尽量不要带特殊符号或特殊词，否则生成的淘口令手淘里可能打不开。 
     * @param string $text 
     * @return self 
    */
    public function setText( $text ) {
        $this->setParam('text', $text); 
        return $this;
    }

    /**
     * 口令跳转目标页，如：https://uland.taobao.com/，必须以https开头，可以是二合一链接、长链接、短链接等各种淘宝高佣链接； 
     * @param string $url 
     * @return self 
    */
    public function setUrl( $url ) {
        $this->setParam('url', $url); 
        return $this;
    }

    /**
     * 口令弹框logoURL，如：https://img.alicdn.com/bao/uploaded/i2.jpg_200x200.jpg 
     * @param string $logo 
     * @return self 
    */
    public function setLogo( $logo ) {
        $this->setParam('logo', $logo); 
        return $this;
    }

    /**
     * 值为1或者2，表示返回淘宝联盟请求地址，大家拿到地址后再用自己的服务器二次请求即可获得最终结果，值为1返回http链接，值为2返回https安全链接，值为0表示直接返回淘口令最终结果。 
     * @param int $signurl 
     * @return self 
    */
    public function setSignurl( $signurl ) {
        $this->setParam('signurl', $signurl); 
        return $this;
    }
    
    /**
     * 
     */
    public function generate() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $response = ZheTaoKe::getInstance()->call('open_tkl_create', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("生成失败：[{$response['status']}]{$response['content']}");
        }
        return $response['model'];
    }
}