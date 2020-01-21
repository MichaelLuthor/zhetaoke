<?php
namespace sige\zhetaoke;
use sige\zhetaoke\fetcher\ZtkGoodsFetcher;
use sige\zhetaoke\fetcher\ZtkGoodsQuanWangFetcher;
use sige\zhetaoke\fetcher\ZtkOrderFetcher;
use sige\zhetaoke\fetcher\ZtkPublisherFetcher;
use sige\zhetaoke\fetcher\ZtkActivityFetcher;
use sige\zhetaoke\fetcher\ZtkAccountFetcher;
use sige\zhetaoke\tool\ZtkGaoyongzhuanlianTkl;
use sige\zhetaoke\tool\ZtkActivityLink;
use sige\zhetaoke\tool\ZtkPublisherInviteCodeGenerator;
use sige\zhetaoke\tool\ZtkPublisherRegister;
use sige\zhetaoke\tool\ZtkKeywords;
use sige\zhetaoke\tool\ZtkSuggest;
use sige\zhetaoke\tool\ZtkShortLink;
use sige\zhetaoke\tool\ZtkTklCreator;
/**
 * 折淘客非官方PHP版SDK
 * @author 四格
 * @link http://www.zhetaoke.com/user/index.html
 */
class ZheTaoKe {
    /**
     * 
     * @var self
     */
    private static $instance = null;
    
    /**
     * 配置项目
     * @var array
     */
    private $config = array(
        'api' => 'https://api.zhetaoke.com:10001/api/%s.ashx?%s', # 接口地址
        'appkey' => null, # 折淘客的对接秘钥appkey
        'sid' => null, # 对应的淘客账号授权ID
        'pid' => null, # 淘客PID，mm_xxx_xxx_xxx,三段格式
    );
    
    /**
     * @return self
     */
    public static function getInstance( ) {
        if ( null === self::$instance ) {
            self::$instance = new self();
        }
        return self::$instance;
    }
    
    /**
     * 获取配置信息
     * @param string $name
     * @return mixed
     */
    public function getConfig( $name ) {
        return $this->config[$name];
    }
    
    /**
     * 设置配置项目
     * @param string $name
     * @param mixed $value
     * @return self
     */
    public function setConfig( $name, $value ) {
        $this->config[$name] = $value;
        return $this;
    }
    
    /**
     * 商品查询
     * @return ZtkGoodsFetcher
     */
    public function goods() {
        return new ZtkGoodsFetcher();
    }
    
    /**
     * 商品查询
     * @return ZtkGoodsQuanWangFetcher
     */
    public function goodsQuanWang() {
        return new ZtkGoodsQuanWangFetcher();
    }
    
    /**
     * 订单查询
     * @return ZtkOrderFetcher
     */
    public function order() {
        return new ZtkOrderFetcher();
    }
    
    /**
     * 渠道信息查询
     * @return ZtkPublisherFetcher
     */
    public function publisher() {
        return new ZtkPublisherFetcher();
    }
    
    /**
     * 活动信息查询
     * @return ZtkActivityFetcher
     */
    public function activity() {
        return new ZtkActivityFetcher();
    }
    
    /**
     * 账号信息查询
     * @return ZtkAccountFetcher
     */
    public function account() {
        return new ZtkAccountFetcher();
    }
    
    /**
     * 商品推广链接转换
     * @return ZtkGaoyongzhuanlianTkl
     */
    public function goodsShareLinkConvert() {
        return new ZtkGaoyongzhuanlianTkl();
    }
    
    /**
     * 活动推广链接转换
     * @return ZtkActivityLink
     */
    public function activityShareLinkConvert() {
        return new ZtkActivityLink();
    }
    
    /**
     * 渠道邀请码生成
     * @return ZtkPublisherInviteCodeGenerator
     */
    public function publisherInviteCodeGenerator() {
        return new ZtkPublisherInviteCodeGenerator();
    }
    
    /**
     * 渠道注册
     * @return ZtkPublisherRegister
     */
    public function publisherRegister() {
        return new ZtkPublisherRegister();
    }
    
    /**
     * 关键词
     * @return ZtkKeywords
     */
    public function keywords() {
        return new ZtkKeywords();
    }
    
    /**
     * 联想词
     * @return ZtkSuggest
     */
    public function suggest() {
        return new ZtkSuggest();
    }
    
    /**
     * 短连接
     * @return ZtkShortLink
     */
    public function shortUrl() {
        return new ZtkShortLink();
    }
    
    /**
     * 淘口令生成
     * @return ZtkTklCreator
     */
    public function tklCreator() {
        return new ZtkTklCreator();
    }
    
    /**
     * 调用折淘客接口
     * @param string $name
     * @param array $params
     */
    public function call( $name, $params ) {
        $params['appkey'] = $this->config['appkey'];
        $params = http_build_query($params);
        $url = sprintf($this->config['api'], $name,$params);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $responseString = curl_exec($ch);
        if ( CURLE_OK !== curl_errno($ch) ) {
            curl_close($ch);
            throw new \Exception('折淘客接口请求失败：'.curl_error($ch));
        }
        
        curl_close($ch);
        $response = json_decode($responseString, true);
        if ( false === $response ) {
            throw new \Exception("折淘客接口响应内容解析失败：".json_last_error_msg());
        }
        
        return $response;
    }
}