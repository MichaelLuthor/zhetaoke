<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
/**
 * 联想词API：根据搜索关键词返回联想词，完善您的搜索功能，建议用户停止输入时进行接口请求。
 * @author michael
 * @link http://www.zhetaoke.com/user/extend/extend_lingquan_suggest.aspx
 */
class ZtkSuggest {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 搜索关键词。请注意，该参数需要进行Urlencode编码后传入。。 
     * @param string $content 
     * @return self 
    */
    public function setcontent( $content ) {
        $this->setParam('content', $content); 
        return $this;
    }
    
    /**
     * 拉取联想词
     * @return array
     */
    public function fetchAll() {
        $response = ZheTaoKe::getInstance()->call('api_suggest', $this->getParams());
        if ( isset($response['status']) && 200 !== $response['status'] ) {
            throw new \Exception("联想词拉取失败：{$response['content']}");
        }
        
        $list = array();
        foreach ( $response['result'] as $item ) {
            $list[] = $item[0];
        }
        return $list;
    }
}