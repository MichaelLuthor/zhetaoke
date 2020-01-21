<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkShortLink {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 淘宝短连接
     * @param string $url
     * @return string
     */
    public function taobao( $url ) {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $this->setParam('content', $url);
        $response = ZheTaoKe::getInstance()->call('open_shorturl_taobao_get', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("转换失败：[{$response['status']}]{$response['content']}");
        }
        return $response['shorturl'];
    }
    
    /**
     * 新浪短连接
     * @param string $url
     * @return string
     */
    public function sina( $url ) {
        $this->setParam('type', 0);
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $this->setParam('content', $url);
        
        $response = ZheTaoKe::getInstance()->call('open_shorturl_sina_get', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("转换失败：[{$response['status']}]{$response['content']}");
        }
        return $response['shorturl'];
    }
    
    /**
     * 搜狐短连接
     * @param string $url
     * @return string
     */
    public function sohu( $url ) {
        $this->setParam('type', 1);
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $this->setParam('content', $url);
        
        $response = ZheTaoKe::getInstance()->call('open_shorturl_sina_get', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("转换失败：[{$response['status']}]{$response['content']}");
        }
        return $response['shorturl'];
    }
    
    /**
     * 百度短连接
     * @param string $url
     * @return string
     */
    public function baidu( $url ) {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $this->setParam('content', $url);
        
        $response = ZheTaoKe::getInstance()->call('open_shorturl_baidu_get', $this->getParams());
        if ( 200 !== $response['status'] ) {
            throw new \Exception("转换失败：[{$response['status']}]{$response['content']}");
        }
        return $response['shorturl'];
    }
}