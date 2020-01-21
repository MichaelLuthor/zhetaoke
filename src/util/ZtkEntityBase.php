<?php
namespace sige\zhetaoke\util;
/**
 * 
 */
abstract class ZtkEntityBase {
    /**
     * 属性列表
     * @var array
     */
    private $attributes = array();
    
    /**
     * 设置属性值
     * @param string $key
     * @param mixed $value
     */
    protected function setAttributeValue( $key, $value ) {
        $this->attributes[$key] = $value;
    }
    
    /**
     * 设置属性值
     * @param string $key
     * @param mixed $value
     */
    public function __set( $key, $value ) {
        $setter = 'set'.ucfirst($key);
        if ( method_exists($this, $setter) ) {
            $this->$setter($value);
        } else {
            $this->setAttributeValue($key, $value);
        }
    }
    
    /**
     * 获取属性
     * @param string $key
     * @return mixed
     */
    public function __get( $key ) {
        if ( !array_key_exists($key, $this->attributes) ) {
            throw new \Exception("无效的属性：{$key}");
        }
        return $this->attributes[$key];
    }
    
    /**
     * 判断属性是否存在
     * @param unknown $name
     * @return boolean
     */
    public function hasAttribute( $name ) {
        return array_key_exists($name, $this->attributes);
    }
    
    /**
     * 通过API相应设置数据
     * @param array $data
     */
    public function applyDataFromApiResponse ( $data, $attrPre=null ) {
        foreach ( $data as $key => $value ) {
            if ( false !== strpos($key, '_') ) {
                $key = explode('_', $key);
                $key = array_map('ucfirst', $key);
                $key = lcfirst(implode('', $key));
            }
            if ( null !== $attrPre && $this->hasAttribute($attrPre.ucfirst($key)) ) {
                $key = $attrPre.ucfirst($key);
            }
            $this->{$key} = $value;
        }
    }
}