<?php 

namespace Devarthurbarboza\Caching\Cache;

use DateInterval;
use Psr\Cache\CacheItemInterface; 

class CacheItem implements CacheItemInterface {


    private $value;
    private $isHit;
    private $key;
    private $expiration;

    public function __construct($key) 
    {
        $this->key = $key
    }

    public function get() : mixed
    {
        return $this->value;
    }

    public function getKey(): string 
    {
        return $this->key;
    }

    public function isHit(): bool
    {
        return $this->isHit;
    }

    public function expiresAt(
        \DateTimeInterface|null $expiration
    ): self {
        $this->expiration = $expiration;
        return $this;
    }

    public function expiresAfter(
            int|DateInterval|null $time
        ): self {

        if ($time === null) {
            $this->expiration = null;
            return $this;
        }

        if ($time instanceof DateInterval) {
            $this->expiration = (new \DateTimeImmutable())->add($time);
            return $this;
        }

        $this->expiration = (new \DateTimeImmutable())->modify("+{$time} seconds");
        return $this;
    }

    public function set($value): self 
    {
        $this->value = $value;
        return $this;
    }

    public function getExpiration(): ?\DateTimeInterface
    {
        return $this->expiration;
    }

    public function create()
    {
        return new $this;
    }
}