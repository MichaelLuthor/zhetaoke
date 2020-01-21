<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
/**
 * 淘宝客渠道信息查询
 * @author 四格
 * @link http://www.zhetaoke.com/user/open/open_sc_publisher_get.aspx
 * @todo 暂无测试数据
 */
class ZtkPublisherFetcher {
    use ZtkApiParamHandlerTrait;
    
    /**
     * 对应的淘客账号授权ID
     * @param string $sid
     * @return self
     */
    public function setSid($sid) {
        $this->setParam('sid', $sid);
        return $this;
    }
    
    /**
     *渠道推广的物料类型
     * @param string $app
     * @return self
     */
    public function setRelationApp( $app ) {
        $this->setParam('relation_app', $app );
        return $this;
    }
    
    /**
     * 类型,默认为1
     * @param integer $type
     * @return self
     */
    public function setInfoType( $type ) {
        $this->setParam('info_type', $type);
        return $this;
    }
    
    /**
     *渠道备案 - 渠道关系ID
     * @param string $id
     * @return self
     */
    public function setRelationId($id) {
        $this->setParam('relation_id', $id);
        return $this;
    }
    
    /**
     *第几页
     * @param integer $pageNo
     * @return self
     */
    public function setPageNo( $pageNo ) {
        $this->setParam('page_no', $pageNo);
        return $this;
    }
    
    /**
     * 每页大小
     * @param integer $size
     * @return self
     */
    public function setPageSize( $size ) {
        $this->setParam('page_size', $size);
        return $this;
    }
    
    /**
     * 拉取所有数据
     * @return array
     */
    public function fetchAll() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $response = ZheTaoKe::getInstance()->call('open_sc_publisher_get', $this->getParams());
        return $response['tbk_sc_publisher_info_get_response']['data'];
    }
}