<?php

namespace vektah\common\subscriber;

use ArrayObject;

class SubscriberList extends ArrayObject
{
    public function __call($method, $params) {
        foreach ($this as $observable) {
            // Keep stacktraces nice with 0 params
            if (count($params) === 0) {
                $observable->$method();
            } else {
                call_user_func_array([$observable, $method], $params);
            }
        }
    }
}
