<?php

namespace Nip\Application\Traits;

/**
 * Trait CacheBootstrapTrait
 * @package Nip\Application\Traits
 */
trait CacheBootstrapTrait
{
    /**
     * Determine if the application configuration is cached.
     *
     * @return bool
     */
    public function configurationIsCached()
    {
        return file_exists($this->getCachedConfigPath());
    }

    /**
     * Get the path to the configuration cache file.
     *
     * @return string
     */
    public function getCachedConfigPath()
    {
        return $this->bootstrapPath('cache/config.php');
    }
}
