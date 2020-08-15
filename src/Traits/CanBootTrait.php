<?php

namespace Nip\Application\Traits;

/**
 * Trait CanBootTrait
 * @package Nip\Application\Traits
 */
trait CanBootTrait
{
    /**
     * Indicates if the application has "booted".
     *
     * @var bool
     */
    protected $booted = false;


    public function boot()
    {
        if ($this->isBooted()) {
            return;
        }

        $this->bootProviders();
        $this->booted = true;
    }

    /**
     * Determine if the application has booted.
     *
     * @return bool
     */
    public function isBooted()
    {
        return $this->booted;
    }
}
