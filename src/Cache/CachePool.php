<?php 
namespace Devarthurbarboza\Caching\Cache;

use Devarthurbarboza\Caching\Cache\CacheItem;
use Psr\Cache\CacheItemPoolInterface;
use Psr\Cache\CacheItemInterface;

class CachePool implements CacheItemPoolInterface 
{

    /**
     * 
     * @var CacheItem[]
     */
    private $items;

    /**
     * 
     * @var CacheItem[] 
     */
    private $itemsDeferred;

    public function clear(): bool
    {
        $this->items = [];
        $this->itemsDeferred = [];
        return true;
    }

    public function getItem(string $key): CacheItemInterface
    {
        if ($this->hasItem($key)) {
            return $this->items[$key];
        }

        return new CacheItem();
    }

    public function getItems(array $keys = []): iterable 
    {
        return array_filter($this->items,
         function ($v, $k) use ($keys) {
            return in_array($k, $keys);
        }, ARRAY_FILTER_USE_BOTH);
    }

    public function hasItem(string $key): bool 
    {
        return array_key_exists($key,$this->items);
    }

    public function deleteItem(string $key): bool 
    {
        if ($this->hasItem($key)) {
            unset($this->items[$key]);
            return true;
        }

        return false;
    }

    public function deleteItems(array $keys): bool
    {
        $success = true;
        foreach ($keys as $key) {
            if (!$this->deleteItem($key)) {
                $success = false;
            }
        }
        return $success;
    }

    public function save(CacheItemInterface $item): bool 
    {
        $this->items[$item->getKey()] = $item;
        return true;
    }

    public function saveDeferred(CacheItemInterface $item): bool
    {
        $this->itemsDeferred[$item->getKey()] = $item;
        return true;
    }

    public function commit(): bool
    {
        foreach ($this->itemsDeferred as $key => $item) {
            $this->items[$key] = $item;
        }
        $this->itemsDeferred = [];
        return true;
    }

}