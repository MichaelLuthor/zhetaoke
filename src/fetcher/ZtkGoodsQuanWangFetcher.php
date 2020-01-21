<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkGoods;
/**
 * 全网搜索商品
 * @author 四格
 * @link http://www.zhetaoke.com/user/extend/extend_lingquan_keywords.aspx
 */
class ZtkGoodsQuanWangFetcher {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 按照综合排序
     * @var string
     */
    const SORT_NEW = 'new';
    
    /**
     * 按照月销量从小到大排序
     * @var string
     */
    const SORT_SALE_NUM_ASC = 'sale_num_asc';
    
    /**
     * 按照月销量从大到小排序
     * @var string
     */
    const SORT_SALE_NUM_DESC = 'sale_num_desc';
    
    /**
     * 按照佣金比例从小到大排序
     * @var string
     */
    const SORT_COMMISSION_RATE_ASC = 'commission_rate_asc';
    
    /**
     * 按照佣金比例从大到小排序
     * @var string
     */
    const SORT_COMMISSION_RATE_DESC = 'commission_rate_desc';
    
    /**
     * 按照价格从小到大排序
     * @var string
     */
    const SORT_PRICE_ASC = 'price_asc';
    
    /**
     * 按照价格从大到小排序
     * @var string
     */
    const SORT_PRICE_DESC = 'price_desc';
    
    /**
     * 不过滤
     * @var integer
     */
    const FILTER_TYPE_NONE = 0;
    
    /**
     * 轻度过滤
     * @var integer
     */
    const FILTER_TYPE_LOW = 1;
    
    /**
     * 中度过滤，强烈推荐值为2
     * @var integer
     */
    const FILTER_TYPE_MID = 2;
    
    /**
     * 设置查询字符串
     * @param string $text
     * @return self
     */
    public function setQueryText( $text ) {
        $this->setParam('q', $text);
        return $this;
    }
    
    /**
     * 每页数据条数（默认每页20条），可自定义1-50之间
     * @param integer $size
     * @return self
     */
    public function setPageSize( $size ) {
        $this->setParam('page_size', $size);
        return $this;
    }
    
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
     * 仅仅显示有优惠券的商品
     * @return self
     */
    public function setHasCouponOnly() {
        $this->setParam('youquan', 1);
        return $this;
    }
    
    /**
     * 设置排序方式, ApiQuanWang::SORT_*
     * @param string $sort
     * @return self
     */
    public function setSort( $sort ) {
        $this->setParam('sort', $sort);
        return $this;
    }
    
    /**
     * 海外商品
     * @return self
     */
    public function setHaiwaiOnly() {
        $this->setParam('haiwai', 1);
        return $this;
    }
    
    /**
     * 好评商品
     * @return self
     */
    public function setHaopingOnly( ) {
        $this->setParam('haoping', 1);
        return $this;
    }
    
    /**
     * 天猫商品
     * @return self
     */
    public function setTmallOnly( ) {
        $this->setParam('tj', 'tmall');
        return $this;
    }
    
    /**
     * 商品所在地，值为空：全部商品，其它值：北京、上海、广州、深圳、重庆、杭州等。必须是城市名称，不能带省份。
     * @param string $itemloc
     * @return self
     */
    public function setLocation( $location ) {
        $this->setParam('itemloc', $location);
        return $this;
    }
    
    /**
     * 商品筛选-后台类目ID(category_id)。用,分割，最大10个，该ID可以加入折淘客开放平台API群来获取。
     * @param string $cat
     * @return self
     */
    public function setCategory( $cat ) {
        $this->setParam('cat', $cat);
        return $this;
    }
    
    /**
     * 淘客佣金比率下限。如：输入20，表示大于等于20%
     * @param string $rate
     * @return self
     */
    public function setStartTkRate( $rate ) {
        $this->setParam('start_tk_rate', $rate);
        return $this;
    }
    
    /**
     * 淘客佣金比率上限。如：输入50，表示小于等于50%
     * @param string $rate
     * @return self
     */
    public function setEndTkRate( $rate ) {
        $this->setParam('end_tk_rate', $rate);
        return $this;
    }
    
    /**
     * 折扣价格下限。如：输入100，表示大于等于100元
     * @param string $price 
     * @return self
     */
    public function setStartPrice( $price ) {
        $this->setParam('start_price', $price); 
        return $this;
    }
    
    /**
     * 折扣价格上限。如：输入200，表示小于等于200元
     * @param string $price 
     * @return self
     */
    public function setEndPrice( $price ) {
        $this->setParam('end_price', $price); 
        return $this;
    }
    
    /**
     * 过滤值 ApiQuanWang::FILTER_TYPE_*
     * @param string $type 
     * @return self
     */
    public function setFilterType( $type ) {
        $this->setParam('type', $type); 
        return $this;
    }
    
    /**
     * 获取商品列表
     * @return array
     */
    public function fetchAll() {
        $response = ZheTaoKe::getInstance()->call('api_quanwang', $this->getParams());
        if ( '无符合条件的数据' === $response['content'] ) {
            return [];
        }
        if ( 200 != $response['status'] ) {
            throw new \Exception("Response status code error : {$response['status']}");
        }
        
        $list = array();
        foreach ( $response['content'] as $gdata ) {
            $goods = new ZtkGoods();
            $goods->applyDataFromApiResponse($gdata);
            $list[] = $goods;
        }
        
        return $list;
    }
}