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

    /**
     * Determine if the application routes are cached.
     *
     * @return bool
     */
    public function routesAreCached()
    {
        return file_exists($this->getCachedRoutesPath());
    }

    /**
     * Get the path to the routes cache folder
     *
     * @return string
     */
    public function getCachedRoutesPath()
    {
        return $this->bootstrapPath('cache/routes');
    }
}
