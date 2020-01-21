<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
/**
 * 关键词词典API：返回top10w词表，搜索量极大，曝光量极高的词（适合用来优化标题和了解买家实时需求）。
 * @author michael
 * @link http://www.zhetaoke.com/user/extend/extend_lingquan_guanjianci.aspx
 */
class ZtkKeywords {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * PC端
     * @var integer
     */
    const TYPE_PC = 0;
    
    /**
     * 移动端 
     * @var integer
     */
    const TYPE_MOBILE = 1;
    
    /**
     * 分页获取数据,第几页 
     * @param int $page 
     * @return self 
    */
    public function setPage( $page ) {
        $this->setParam('page', $page); 
        return $this;
    }

    /**
     * 每页数据条数（默认每页1000条）,可自定义。 
     * @param int $page_size 
     * @return self 
    */
    public function setPageSize( $size ) {
        $this->setParam('page_size', $size); 
        return $this;
    }
    
    /**
     * 类型
     * @param string $type 
     * @return self 
    */
    public function setType( $type ) {
        $this->setParam('type', $type); 
        return $this;
    }
    
    /**
     * 拉取关键词
     * @return array
     */
    public function fetchAll() {
        $response = ZheTaoKe::getInstance()->call('api_guanjianci', $this->getParams());
        $list = array();
        foreach ( $response['content'] as $item ) {
            $list[] = $item['keywords'];
        }
        return $list;
    }
}