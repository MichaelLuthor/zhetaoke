<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\entity\ZtkGoods;

/**
 * 商品搜索
 * @author 四格
 * @link http://www.zhetaoke.com/user/extend/extend_lingquan_site.aspx
 */
class ZtkGoodsFetcher {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 按照总销量从小到大排序
     * @var string
     */
    const SORT_TOTAL_SALE_NUM_ASC = 'total_sale_num_asc';
    
    /**
     * 按照总销量从大到小排序
     * @var string
     */
    const SORT_TOTAL_SALE_NUM_DESC = 'total_sale_num_desc';
    
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
     * 按照优惠券金额从小到大排序
     * @var string
     */
    const SORT_COUPON_INFO_MONEY_ASC = 'coupon_info_money_asc';
    
    /**
     * 按照优惠券金额从大到小排序
     * @var string
     */
    const SORT_COUPON_INFO_MONEY_DESC = 'coupon_info_money_desc';
    
    /**
     * 按照店铺等级从低到高排序
     * @var string
     */
    const SORT_SHOP_LEVEL_ASC = 'shop_level_asc';
    
    /**
     * 按照店铺等级从高到低排序
     * @var string
     */
    const SORT_SHOP_LEVEL_DESC = 'shop_level_desc';
    
    /**
     * 按照返佣金额从低到高排序
     * @var string
     */
    const SORT_TKFEE_ASC = 'tkfee_asc';
    
    /**
     * 按照返佣金额从高到低排序
     * @var string
     */
    const SORT_TKFEE_DESC = 'tkfee_desc';
    
    /**
     * 按照code值从大到小排序
     * @var string
     */
    const SORT_CODE = 'code';
    
    /**
     * 按照更新时间排序
     * @var string
     */
    const SORT_DATE_TIME = 'date_time';
    
    /**
     * 按照随机排序
     * @var string
     */
    const SORT_RANDOM = 'random';
    
    /**
     * 女装
     * @var integer
     */
    const CID_WOMEN_CLOTHES = '1';
    
    /**
     * 母婴
     * @var integer
     */
    const CID_BABY = '2';
    
    /**
     * 美妆
     * @var integer
     */
    const CID_MAKE_UP = '3';
    
    /**
     * 居家日用
     * @var integer
     */
    const CID_DAILY = '4';
    
    /**
     * 鞋品
     * @var integer
     */
    const CID_SHOES = '5';
    
    /**
     * 美食
     * @var integer
     */
    const CID_FOOD = '6';
    
    /**
     * 文娱车品
     * @var integer
     */
    const CID_CAR = '7';
    
    /**
     * 数码家电
     * @var integer
     */
    const CID_ELECTRICAL = '8';
    
    /**
     * 男装
     * @var integer
     */
    const CID_MAN_CLOTHES = '9';
    
    /**
     * 内衣
     * @var integer
     */
    const CID_UNDERWARE = '10';
    
    /**
     * 箱包
     * @var integer
     */
    const CID_BAG = '11';
    
    /**
     * 配饰
     * @var integer
     */
    const CID_WIDGET = '12';
    
    /**
     * 户外运动
     * @var integer
     */
    const CID_OUTDOOR = '13';
    
    /**
     * 家装家纺
     * @var integer
     */
    const CID_TEXTILE = '14';
    
    /**
     * 拉取模式
     * @var string
     */
    private $fetchMode = null;
    
    /**
     * 每页数据条数（默认每页20条），可自定义1-50之间
     * @param integer $size
     * @return self
     */
    public function setPageSize( $size ){
        $this->setParam('page_size', $size);
        return $this;
    }
    
    /**
     * 分页获取数据,第几页
     * @param integer $page
     * @return self
     */
    public function setPage( $page ){
        $this->setParam('page', $page);
        return $this;
    }
    
    /**
     * 商品排序方式, ZtkGoodFetcher::SORT_*
     * @param string $sort
     * @return self
     */
    public function setSort( $sort ){
        $this->setParam('sort', $sort);
        return $this;
    }
    
    /**
     * 	品牌名称
     * @param string $name
     * @return self
     */
    public function setBrandName( $name ) {
        $this->setParam('pinpai_name', $name);
        return $this;
    }
    
    /**
     * 一级商品分类, ZtkGoodFetcher::CID_*
     * @param integer $cid
     * @return self
     */
    public function setCid( $cid ){
        $this->setParam('cid', $cid);
        return $this;
    }
    
    /**
     * 价格区间
     * @param number $min
     * @param number $max
     * @return self
     */
    public function setPrice($min, $max){
        $this->setParam('price', "{$min}-{$max}");
        return $this;
    }
    
    /**
     * 佣金比例≥
     * @param number $rate
     * @retun self
     */
    public function setCommissionRateStart( $rate ) {
        $this->setParam('commission_rate_start', $rate);
        return $this;
    }
    
    /**
     * 月销量≥ 
     * @param number $num
     * @retun self
     */
    public function setSaleNumStart( $num ) {
        $this->setParam('sale_num_start', $num);
        return $this;
    }
    
    /**
     * 动态评分≥
     * @param number $num
     * @retun self
     */
    public function setDsrStart( $dsr ) {
        $this->setParam('dsr_start', $dsr);
        return $this;
    }
    
    /**
     * 券面额≥
     * @param number $amount
     * @retun self
     */
    public function setCouponAmountStart( $amount ) {
        $this->setParam('coupon_amount_start', $amount);
        return $this;
    }
    
    /**
     * 设置查询字符串
     * @param string $text
     * @return self
     */
    public function setQueryText ( $text ){
        $this->setParam('q', $text);
        return $this;
    }
    
    /**
     * 数据更新开始时间
     * @param string $time
     * @return self
     */
    public function setStartDateTimeYongJin( $time ) {
        $this->setParam('start_date_time_yongjin', $time);
        return $this;
    }
    
    /**
     * 数据更新开始时间
     * @param string $time
     * @return self
     */
    public function setEndDateTimeYongJin( $time ) {
        $this->setParam('end_date_time_yongjin', $time);
        return $this;
    }
    
    /**
     * 一级类目ID
     * @param integer $id
     * @return self
     */
    public function setLevelOneCategoryId( $id ){
        $this->setParam('level_one_category_id', $id);
        return $this;
    }
    
    /**
     * 叶子类目ID
     * @param array|integer $id
     */
    public function setCategoryId( $id ){
        if ( is_array($id) ) {
            $id = implode(',', $id);
        }
        $this->setParam('category_id', $id);
    }
    
    /**
     * 极品爆单商品
     * @return self
     */
    public function filterBaoDan() {
        $this->setParam('baodan', 1);
        return $this;
    }
    
    /**
     * 预告商品
     * @return self
     */
    public function filterLive() {
        $this->setParam('live', 2);
        return $this;
    }
    
    /**
     * 店铺商品
     * @param string $sellerId
     * @return self
     */
    public function setSellerId ($sellerId ){
        $this->setParam('seller_id', $sellerId);
        return $this;
    }
    
    
    /**
     * 仅查询淘宝商品
     * @return self
     */
    public function filterTaobao(){
        $this->setParam('tj', 'taobao');
        return $this;
    }
    
    /**
     * 金牌卖家商品
     * @return self
     */
    public function filterGoldSeller(){
        $this->setParam('tj', 'gold_seller');
        return $this;
    }
    
    /**
     * 天猫商品
     * @return self
     */
    public function filterTmall(){
        $this->setParam('tj', 'tmall');
        return $this;
    }
    
    /**
     * 聚划算商品
     * @return self
     */
    public function filterJuHuaSuan(){
        $this->setParam('jt', 'juhuasuan');
        return $this;
    }
    
    /**
     * 淘抢购商品
     * @return self
     */
    public function filterTaoQiangGou(){
        $this->setParam('jt', 'taoqianggou');
        return $this;
    }
    
    /**
     * 海淘商品
     * @return self
     */
    public function filterHaiTao(){
        $this->setParam('jh', 'haitao');
        return $this;
    }
    
    /**
     * 极有家商品
     * @return self
     */
    public function filterJiYouJia(){
        $this->setParam('jh', 'jiyoujia');
        return $this;
    }
    
    /**
     * 今日商品
     * @return self
     */
    public function filterToday(){
        $this->setParam('today', 1);
        return $this;
    }
    
    /**
     * 含有运费险
     * @return self
     */
    public function filterFreightInsure() {
        $this->setParam('yunfeixian', 1);
        return $this;
    }
    
    /**
     * 精选品牌
     * @return self
     */
    public function filterBestBrand( ) {
        $this->setParam('pinpai', 1);
        return $this;
    }
    
    /**
     * 拉取所有商品数据
     * @return ZtkGoods[]
     */
    public function fetchAll() {
        $this->fetchMode = 'api_all';
        return $this->fetch();
    }
    
    /**
     * 全网视频商品列表，返回佣金≥15%，动态描述分≥4.6的商品列表
     * @return ZtkGoods[]
     */
    public function fetchByVideo(){
        $this->fetchMode = 'api_videos';
        return $this->fetch();
    }
    
    /**
     * 传入用户设备信息，即可返回个性化的推荐结果
     * @param string $devValue 设备号加密后的值（MD5加密需32位小写）
     * @param string $devEncrypt 设备号加密类型：MD5
     * @param string $devType 设备号类型：IMEI，或者IDFA，或者UTDID（UTDID不支持MD5加密）
     * @return ZtkGoods[]
     */
    public function fetchByGuessByDevice( $devValue, $devEncrypt, $devType) {
        $this->setParam('device_value', $devValue);
        $this->setParam('device_encrypt', $devEncrypt);
        $this->setParam('device_type', $devType);
        $this->fetchMode = 'open_item_guess_like';
        return $this->fetch();
    }
    
    /**
     * 传入用户设备信息，即可返回个性化的推荐结果
     * @param string $itemId 商品ID
     * @return ZtkGoods[]
     */
    public function fetchByGuessByItem( $itemId ) {
        $this->setParam('item_id', $itemId);
        $this->fetchMode = 'open_item_guess_like';
        return $this->fetch();
    }
    
    /**
     * 传入用户设备信息，即可返回个性化的推荐结果
     * @return ZtkGoods[]
     */
    public function fetchByGuess( ) {
        $this->fetchMode = 'open_item_guess_like';
        return $this->fetch();
    }
    
    /**
     * 两小时销量榜
     * @return ZtkGoods[]
     */
    public function fetchTwoHoursHotTopList() {
        $this->fetchMode = 'api_xiaoshi';
        return $this->fetch();
    }
    
    /**
     * 返回24小时内销量榜单商品列表
     * @return ZtkGoods[]
     * @link http://www.zhetaoke.com/user/extend/extend_lingquan_quantian.aspx
     */
    public function fetchTodayHotTopList() {
        $this->fetchMode = 'api_quantian';
        return $this->fetch();
    }
    
    /**
     * 实时返回销量榜单商品列表（前600个），返回佣金≥15%，动态描述分≥4.6的商品列表。
     * @return ZtkGoods[]
     * @link http://www.zhetaoke.com/user/extend/extend_lingquan_shishi.aspx
     */
    public function fetchPopTopList() {
        $this->fetchMode = 'api_shishi';
        return $this->fetch();
    }
    
    /**
     * 实时返回支出佣金榜单商品列表（前600个），返回佣金≥15%，动态描述分≥4.6的商品列表。
     * @return ZtkGoods[]
     * @link http://www.zhetaoke.com/user/extend/extend_lingquan_yongjin.aspx
     */
    public function fetchYongJinTopList() {
        $this->fetchMode = 'api_yongjin';
        return $this->fetch();
    }
    
    /**
     * 返回站内失效商品列表，按照失效时间倒序排序。
     * @param string $startTime 失效开始时间，如：2019-07-01 00:00:00
     * @param string $endTime 失效结束时间，如：2019-07-01 23:59:59
     * @return ZtkGoods[]
     * @link http://www.zhetaoke.com/user/extend/extend_lingquan_shixiao.aspx
     */
    public function fetchInvalid( $startTime=null, $endTime=null ) {
        $this->setParam('start_time', $startTime);
        $this->setParam('end_time', $endTime);
        $this->fetchMode = 'api_shixiao';
        return $this->fetch('inv');
    }
    
    /**
     * 返回咚咚抢商品列表，返回佣金≥15%，动态描述分≥4.6的商品列表。
     * @param unknown $startTime
     * @param unknown $endTime
     * @return ZtkGoods[]
     */
    public function fetchDongdongQiang( $startTime=null, $endTime=null ) {
        $this->setParam('start_dongdong_time', $startTime);
        $this->setParam('end_dongdong_time', $endTime);
        $this->fetchMode = 'api_dongdong';
        return $this->fetch();
    }
    
    /**
     * 通过TaoID获取商品详情
     * @param unknown $id
     * @return ZtkGoods
     */
    public function fetchOneByTaoId( $id ) {
        $this->setParam('tao_id', $id);
        $this->fetchMode = 'api_detail';
        $response = $this->fetch();
        return empty($response[0]) ? null : $response[0];
    }
    
    /**
     * 请求API接口拉取订单数据
     * @return ZtkGoods[]
     */
    private function fetch( $attrPre=null ) {
        $response = ZheTaoKe::getInstance()->call($this->fetchMode, $this->getParams());
        if ( '无符合条件的数据' === $response['content'] ) {
            return [];
        }
        if ( '对应宝贝已下架或非淘客宝贝' === $response['content'] ) {
            return [];
        }
        
        if ( 200 !== $response['status'] ) {
            throw new \Exception("Failed to fetch goods from zhetaoke, status error : {$response['status']}");
        }
        
        $list = array();
        foreach ( $response['content'] as $gdata ) {
            $goods = new ZtkGoods();
            $goods->applyDataFromApiResponse($gdata, $attrPre);
            $list[] = $goods;
        }
        
        return $list;
    }
}