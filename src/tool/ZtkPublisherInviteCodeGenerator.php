<?php
namespace sige\zhetaoke\tool;
use sige\zhetaoke\util\ZtkApiParamHandlerTrait;
use sige\zhetaoke\ZheTaoKe;
class ZtkPublisherInviteCodeGenerator {
    /**
     * 
     */
    use ZtkApiParamHandlerTrait;
    
    /**
     * 渠道推广的物料类型，示例值：common
     * @param string $app
     * @return self
     */
    public function setRelationApp( $app ) {
        $this->setParam('relation_app', $app);
        return $this;
    }
    
    /**
     * 邀请码类型:1 - 渠道邀请，2 - 渠道裂变，3 -会员邀请
     * @param integer $type
     * @return self
     */
    public function setCodeType( $type ) {
        $this->setParam('code_type', $type);
        return $this;
    }
    
    /**
     * 渠道关系ID
     * @param string $id
     * @return self
     */
    public function RelationId( $id ) {
        $this->setParam('relation_id', $id);
        return $this;
    }
    
    /**
     * @return mixed
     */
    public function generate() {
        $this->setParam('sid', ZheTaoKe::getInstance()->getConfig('sid'));
        $response = ZheTaoKe::getInstance()->call('open_sc_invitecode_get', $this->getParams());
        if ( isset($response['status']) && 200 !== $response['status'] ) {
            throw new \Exception("邀请码生成失败：{$response['content']}");
        }
        if ( isset($response['error_response']) ) {
            throw new \Exception("邀请码生成失败：{$response['error_response']['sub_msg']}");
        }
        
        return $response;
    }
}