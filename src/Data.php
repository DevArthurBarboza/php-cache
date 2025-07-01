<?php

namespace Devarthurbarboza\Caching;

class Data {

    private $data = [];
    public function __construct(){
        for ($i = 0; $i < 10000; $i++) {
            $this->data[$i] = [
                'value' => $i * $i
            ]; 
        }        
    }

    public function getData($parameter) {
        foreach ($this->data as $data) {
            if ($data['value'] == $parameter) {
                return $data;
            }
        }
    }
}