<?php 

namespace Devarthurbarboza\Caching\Data;

use Devarthurbarboza\Caching\Cache\CacheItem;
use Devarthurbarboza\Caching\Cache\CachePool;
use Devarthurbarboza\Caching\Connection;

class Product extends Connection
{
    public string $name;
    public float $price;
    public int $qty;

    private $cache;
    
    private const CACHE_KEY_PREFIX = 'product_';

    public function __construct()
    {
        $this->cache = new CachePool();
    }

    private function generateKey($param, $value){
        return self::CACHE_KEY_PREFIX . "{$param}_{$value}";
    }

    public function save()
    {
        return $this->getConnection()->exec("INSERT INTO products (name, price, qty) VALUES ('{$this->name}', '{$this->price}', '{$this->qty}')");
    }

    public function get($field, $value) 
    {
        $key = $this->generateKey($field, $value);
        if ($this->cache->hasItem($key)) {
            return $this->cache->getItem($key);
        }
        $item = $this->getConnection()->query("SELECT * FROM products where {$field} = '{$value}'")->fetchAll();

        $cacheItem = new CacheItem($key);
        $cacheItem->set($item)->expiresAfter(120);
        $this->cache->save($cacheItem);
        
        return $item;
    }

    public function getById($id) 
    {

        $key = $this->generateKey('id', $id);
        if ($this->cache->hasItem($key)) {
            return $this->cache->getItem($key);
        }

        $item = $this->getConnection()->query("SELECT * FROM products where id = {$id}")->fetch();

        $cacheItem = new CacheItem($key);
        $cacheItem->set($item)->expiresAfter(120);
        $this->cache->save($cacheItem);
        return $item;
    }
}