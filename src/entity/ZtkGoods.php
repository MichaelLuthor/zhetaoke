<?php
namespace sige\zhetaoke\entity;
use sige\zhetaoke\util\ZtkEntityBase;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\tool\ZtkGaoyongzhuanlianTkl;
/**
 * @property string $code 折淘客编号
 * @property string $typeOneId 分类ID，可参考折淘客分类
 * @property string $taoId 商品ID
 * @property string $title 商品短标题
 * @property string $jianjie 商品简介
 * @property string $pictUrl 商品主图
 * @property string $userType 是否天猫，0是淘宝，1是天猫
 * @property string $sellerId 卖家ID 
 * @property string $shopDsr 商品描述分
 * @property string $volume 月销量
 * @property string $size 折扣价
 * @property string $quanhouJiage 券后价
 * @property string $dateTimeYongjin 数据更新时间
 * @property string $tkrate3 佣金比率
 * @property string $yongjinType 佣金类型
 * @property string $couponId 优惠券ID
 * @property string $couponStart_time 优惠券开始时间
 * @property string $couponEndTime 优惠券结束时间
 * @property string $couponInfoMoney 优惠券金额
 * @property string $couponTotalCount 优惠券总数量
 * @property string $couponRemainCount 优惠券剩余数量
 * @property string $couponInfo 优惠券信息
 * @property string $juhuasuan 是否聚划算，1是
 * @property string $taoqianggou 是否淘抢购，1是
 * @property string $haitao 是否海淘，1是
 * @property string $jiyoujia 是否极有家，1是
 * @property string $jinpaimaijia 是否金牌卖家，1是
 * @property string $pinpai 是否精选品牌，1是
 * @property string $pinpaiName 品牌名称
 * @property string $yunfeixian 是否有运费险，1有
 * @property string $nick 卖家昵称
 * @property string $smallImages 商品小图列表
 * @property string $whiteImage 商品白底图
 * @property string $taoTitle 商品长标题
 * @property string $provcity 宝贝所在地
 * @property string $shopTitle 店铺名称
 * @property string $zhiboUrl 视频地址
 * @property string $sellCount 淘宝网页实时总销量
 * @property string $commentCount 评论数量
 * @property string $favcount 收藏数量
 * @property string $score1 宝贝描述分
 * @property string $score2 卖家服务分
 * @property string $score3 物流服务分
 * @property string $creditLevel 店铺等级（1-20），一星 二星 三星 四星 五星 一钻 二钻 三钻 四钻 五钻 一皇冠 二皇冠 三皇冠 四皇冠 五皇冠  一金冠 二金冠 三金冠 四金冠 五金冠
 * @property string $shopIcon 店铺logo
 * @property string $pcDescContent 图文详情图片地址
 * @property string $itemUrl 商品url
 * @property string $categoryId 叶子类目id
 * @property string $categoryName 叶子类目name
 * @property string $levelOneCategoryId 一级类目id
 * @property string $levelOneCategoryName 一级类目name
 * @property string $tkfee3 返佣金额
 * @property string $volumeShishi 两小时销量
 * @property string $volumeQuantian 全天销量
 * @property string $tkSaleCount 人气值
 * @property string $invId 原始商品编号code
 * @property string $invActivityId 优惠券id
 * @property string $invReasonType 失效原因
 * @property string $invDateTime 失效时间
 * @property string $presaleDiscountFeeText
 * @property string $presaleTailEndTime
 * @property string $presaleTailStartTime
 * @property string $presaleEndTime
 * @property string $presaleStartTime
 * @property string $presaleDeposit
 */
class ZtkGoods extends ZtkEntityBase {
    /**
     * 商品推广信息
     * @var array
     */
    private $shareInfo = null;
    
    /**
     * 设置小图
     * @param mixed $value
     * @return void
     */
    protected function setSmallImages( $value ) {
        if ( is_string($value) ) {
            $value = explode('|', $value);
        }
        $this->setAttributeValue('smallImages', $value);
    }
    
    /**
     * 设置描述图
     * @param mixed $value
     * @return void
     */
    protected function setPcDescContent( $value ) {
        if ( is_string($value) ) {
            $value = explode('|', $value);
        }
        $this->setAttributeValue('pcDescContent', $value);
    }
    
    /**
     * 获取推广信息
     * @return array
     */
    private function getShareInfo() {
        if ( null === $this->shareInfo ) {
            $convert = ZheTaoKe::getInstance()->goodsShareLinkConvert();
            $convert->setLink($this->itemUrl);
            $convert->setSignUrlType(ZtkGaoyongzhuanlianTkl::SIGNURL_MID);
            $this->shareInfo = $convert->convert();
        }
        return $this->shareInfo;
    }
    
    /**
     * 获取优惠券链接
     * @return string
     */
    public function getCouponLink() {
        $info = $this->getShareInfo();
        return $info['coupon_click_url'];
    }
    
    /**
     * 获取推广链接
     * @return string
     */
    public function getShareLink() {
        $info = $this->getShareInfo();
        return $info['item_url'];
    }
    
    /**
     * 获取淘口令
     * @return mixed
     */
    public function getTaoKouLing() {
        $info = $this->getShareInfo();
        return $info['tkl'];
    }
}