<?php

namespace Nip\Application\Traits;

use Nip\Config\Config;

/**
 * Trait HasLocaleTrait
 * @package Nip\Application\Traits
 */
trait HasLocaleTrait
{
    /**
     * Get the current application locale.
     *
     * @return string
     */
    public function getLocale()
    {
        /** @var Config $config */
        $config = $this->get('config');
        return $config->get('app.locale.selected', 'en');
    }

    /**
     * Set the current application locale.
     *
     * @param  string $locale
     * @return void
     * @throws \Nip\Config\Exception\RuntimeException
     */
    public function setLocale($locale)
    {
        /** @var Config $config */
        $config = $this->get('config');
        $config->set('app.locale.selected', $locale);

        /** @noinspection PhpUndefinedMethodInspection */
        $this->get('translator')->setLocale($locale);
    }

    /**
     * Determine if application locale is the given locale.
     *
     * @param  string $locale
     * @return bool
     */
    public function isLocale($locale)
    {
        return $this->getLocale() == $locale;
    }

    /**
     * @return mixed
     */
    public function getEnabledLocale()
    {
        /** @var Config $config */
        $config = $this->get('config');
        $languages = $config->get('app.locale.enabled');

        return is_array($languages) ? $languages : explode(',', $languages);
    }

    /**
     * @return mixed
     */
    public function getDefaultLocale()
    {
        /** @var Config $config */
        $config = $this->get('config');
        return $config->get('app.locale.default');
    }
}
