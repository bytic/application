<?php

namespace Nip\Application\Traits;

/**
 * Class BindPathsTrait
 * @package Nip\Application\Traits
 */
trait BindPathsTrait
{
    /**
     * The base path for the Laravel installation.
     *
     * @var string
     */
    protected $basePath = null;

    /**
     * The custom database path defined by the developer.
     *
     * @var string
     */
    protected $databasePath;

    /**
     * The custom storage path defined by the developer.
     *
     * @var string
     */
    protected $storagePath;

    /**
     * Set the base path for the application.
     *
     * @param string $basePath
     * @return $this
     */
    public function setBasePath($basePath)
    {
        $this->basePath = rtrim($basePath, '\/');
        return $this;
    }

    /**
     * Get the path to the application "app" directory.
     *
     * @return string
     */
    public function path()
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'application';
    }

    /**
     * Get the base path of the Laravel installation.
     *
     * @return string
     */
    public function basePath()
    {
        if ($this->basePath === null) {
            $this->initBasePath();
        }
        return $this->basePath;
    }

    protected function initBasePath()
    {
        $this->setBasePath($this->generateBasePath());
    }

    /**
     * @return string
     */
    protected function generateBasePath()
    {
        if (defined('ROOT_PATH')) {
            return ROOT_PATH;
        }
        return '';
    }

    /**
     * Get the path to the language files.
     *
     * @return string
     */
    public function langPath()
    {
        return $this->resourcePath() . DIRECTORY_SEPARATOR . 'lang';
    }

    /**
     * Get the path to the resources directory.
     *
     * @return string
     */
    public function resourcePath()
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'resources';
    }

    /**
     * Get the path to the application configuration files.
     *
     * @return string
     */
    public function configPath()
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'config';
    }

    /**
     * Get the path to the public / web directory.
     *
     * @return string
     */
    public function publicPath()
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'public';
    }

    /**
     * Get the path to the storage directory.
     *
     * @return string
     */
    public function storagePath()
    {
        return $this->storagePath ?: $this->basePath() . DIRECTORY_SEPARATOR . 'storage';
    }

    /**
     * Get the path to the database directory.
     *
     * @return string
     */
    public function databasePath()
    {
        return $this->databasePath ?: $this->basePath() . DIRECTORY_SEPARATOR . 'database';
    }

    /**
     * Get the path to the bootstrap directory.
     *
     * @param string $path Optionally, a path to append to the bootstrap path
     * @return string
     */
    public function bootstrapPath($path = '')
    {
        return $this->basePath() . DIRECTORY_SEPARATOR . 'bootstrap' . ($path ? DIRECTORY_SEPARATOR . $path : $path);
    }
}
