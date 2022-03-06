<?php

// Documentation: https://symfony.com/doc/current/components/cache.html#cache-component-psr6-caching

namespace Core;

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Adapter\PdoAdapter;
use Core\DB;

class Cache {

    public static function file(): FilesystemAdapter {
        return new FilesystemAdapter();
    }

    public static function db(): PdoAdapter {
        return new PdoAdapter(DB::connect());
    }
    
}