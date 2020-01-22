<?php
namespace sige\zhetaoke\fetcher;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
use sige\zhetaoke\entity\ZtkOrder;
use sige\zhetaoke\result\ZtkOrderFetchResult;
/**
 * 新订单查询
 * @author 四格
 */
class ZtkOrderFetcher {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 订单查询开始时间，2019-04-05 12:18:22 
     * @param string $time 
     * @return self 
    */
    public function setStartTime( $time ) {
        $this->setParam('start_time', $time); 
        return $this;
    }

    /**
     * 订单查询结束时间，2019-04-25 15:18:22，目前最大可查3个小时内的数据 
     * @param string $time 
     * @return self 
    */
    public function setEndTime( $time ) {
        $this->setParam('end_time', $time); 
        return $this;
    }

    /**
     * 查询时间类型，1：按照订单淘客创建时间查询，2:按照订单淘客付款时间查询，3:按照订单淘客结算时间查询 
     * @param string $type 
     * @return self 
    */
    public function setQueryType( $type ) {
        $this->setParam('query_type', $type); 
        return $this;
    }

    /**
     * 位点，除第一页之外，都需要传递；前端原样返回。注意：从第二页开始，位点必须传递前一页返回的值，否则翻页无效。 
     * @param string $index 
     * @return self 
    */
    public function setPositionIndex( $index ) {
        $this->setParam('position_index', $index); 
        return $this;
    }

    /**
     * 页大小，默认20，1~100 
     * @param string $page_size 
     * @return self 
    */
    public function setPageSize( $size ) {
        $this->setParam('page_size', $size); 
        return $this;
    }

    /**
     * 推广者角色类型,2:二方，3:三方，不传，表示所有角色 
     * @param string $type 
     * @return self 
    */
    public function setMemberType( $type ) {
        $this->setParam('member_type', $type); 
        return $this;
    }

    /**
     * 淘客订单状态，12-付款，13-关闭，14-确认收货（暂时无法结算佣金），3-结算成功;不传，表示所有状态 
     * @param string $status 
     * @return self 
    */
    public function setTkStatus( $status ) {
        $this->setParam('tk_status', $status); 
        return $this;
    }

    /**
     * 跳转类型，当向前或者向后翻页必须提供,-1: 向前翻页,1：向后翻页 
     * @param string $jump_type 
     * @return self 
    */
    public function setJumpType( $type ) {
        $this->setParam('jump_type', $type);
        return $this;
    }

    /**
     * 第几页，默认1，1~100 
     * @param string $page_no 
     * @return self 
    */
    public function setPageNo( $pageNo ) {
        $this->setParam('page_no', $pageNo); 
        return $this;
    }

    /**
     * 场景订单场景类型，1:常规订单，2:渠道订单，3:会员运营订单，默认为1 
     * @param string $order_scene 
     * @return self 
    */
    public function setOrderScene( $scene ) {
        $this->setParam('order_scene', $scene); 
        return $this;
    }

    /**
     * 值为1或者2，表示返回淘宝联盟请求地址，大家拿到地址后再用自己的服务器二次请求即可获得最终结果，值为1返回http链接，值为2返回https安全链接。 
     * @param int $signurl 
     * @return self 
    */
    public function setSignurl( $signurl ) {
        $this->setParam('signurl', $signurl); 
        return $this;
    }
    
    /**
     * 拉取订单
     * @return array
     */
    public function fetchAll() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $response = ZheTaoKe::getInstance()->call('open_dingdanchaxun2', $this->getParams());
        if ( isset($response['status']) && 200 !== $response['status'] ) {
            throw new \Exception("无法拉取订单信息：[{$response['status']}]{$response['content']}");
        }
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $response['url']);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 2);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        $responseString = curl_exec($ch);
        curl_close($ch);
        
        $response = json_decode($responseString, true);
        if ( false === $response ) {
            throw new \Exception("Failed to parse response content to json : ".json_last_error_msg());
        }
        if ( isset($response['error_response']) ) {
            throw new \Exception("数据解析失败：{$response['error_response']['sub_msg']}");
        }
        
        $listInfo = $response['tbk_sc_order_details_get_response']['data'];
        $result = new ZtkOrderFetchResult();
        $result->hasNextPage = $listInfo['has_next'];
        $result->hasPrePage = $listInfo['has_pre'];
        $result->pageNo = $listInfo['page_no'];
        $result->pageSize = $listInfo['page_size'];
        $result->positionIndex = $listInfo['position_index'];
        
        if ( !empty($listInfo['results']['publisher_order_dto']) ) {
            foreach ( $listInfo['results']['publisher_order_dto'] as $index => $orderData ) {
                $order = new ZtkOrder();
                $order->applyDataFromApiResponse($orderData);
                $result->addOrder($order);
            }
        }
        return $result;
    }
}