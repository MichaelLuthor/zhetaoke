<?php
namespace sige\zhetaoke\result;
use sige\zhetaoke\entity\ZtkOrder;
/**
 * 
 */
class ZtkOrderFetchResult implements \ArrayAccess, \Iterator {
    /**
     * @var string
     */
    public $positionIndex = null;
    
    /**
     * @var integer
     */
    public $pageSize = null;
    
    /**
     * @var integer
     */
    public $pageNo = null;
    
    /**
     * @var boolean
     */
    public $hasPrePage = null;
    
    /**
     * @var boolean
     */
    public $hasNextPage = null;
    
    /**
     * @var array
     */
    private $orders = array();
    
    /**
     * 添加订单
     * @param ZtkOrder $order
     */
    public function addOrder( ZtkOrder $order ) {
        $this->orders[] = $order;
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetExists()
     */
    public function offsetExists($offset) {
        return array_key_exists($offset, $this->orders);
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetGet()
     */
    public function offsetGet($offset) {
        return $this->orders[$offset];
    }
    
    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetSet()
     */
    public function offsetSet($offset, $value) {
        $this->orders[$offset] = $value;
    }

    /**
     * {@inheritDoc}
     * @see ArrayAccess::offsetUnset()
     */
    public function offsetUnset($offset) {
        unset($this->orders[$offset]);
    }
    
    /**
     * 
     */
    public function current ( ) {
        return current($this->orders);
    }
    
    /**
     * 
     */
    public function key ( ) {
        return key($this->orders);
    }
    
    /**
     * @return mixed
     */
    public function next ( ) {
        return next($this->orders);
    }
    
    /**
     * @return mixed
     */
    public function rewind ( ) {
        return reset($this->orders);
    }
    
    /**
     * @return boolean
     */
    public function valid ( ) {
        return null != key($this->orders);
    }
}