<?php
/**
 * Created by PhpStorm.
 * User: ctfang
 * Date: 2020-06-02
 * Time: 10:45
 */

namespace ChineseWordSegmentation;

/**
 * Class WordDict
 * @package ChineseWordSegmentation
 */
class WordDict implements \ArrayAccess
{
    public $container = [];

    public $isEnd = false;

    public $tf;

    public function offsetSet($offset, $value)
    {
        if (is_null($offset)) {
            $this->container[] = $value;
        } else {
            $this->container[$offset] = $value;
        }
    }

    public function offsetExists($offset)
    {
        return isset($this->container[$offset]);
    }

    public function offsetUnset($offset)
    {
        unset($this->container[$offset]);
    }

    public function offsetGet($offset)
    {
        return isset($this->container[$offset]) ? $this->container[$offset] : null;
    }
}