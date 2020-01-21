<?php
namespace sige\zhetaoke\util;
/**
 * @author Sige
 */
trait ZtkApiParamHandlerTrait {
    /**
     * 参数列表
     * @var array
     */
    private $params = array();
    
    /**
     * 设置参数
     * @param string $name
     * @param mixed $value
     */
    protected function setParam ( $name, $value ) {
        $this->params[$name] = $value;
    }
    
    /**
     * 获取调用参数
     * @return array
     */
    protected function getParams() {
        return $this->params;
    }
}