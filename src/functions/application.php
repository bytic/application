<?php

use Nip\Container\Container;

if (!function_exists('app')) {
    /**
     * Get the available container instance.
     *
     * @param  string $make
     * @param  array $parameters
     * @return mixed|Container
     */
    function app($make = null, $parameters = [])
    {
        if (is_null($make)) {
            return Container::getInstance();
        }

        return Container::getInstance()->get($make, $parameters);
    }
}

if (! function_exists('storage_path')) {
    /**
     * Get the path to the storage folder.
     *
     * @param  string  $path
     * @return string
     */
    function storage_path($path = '')
    {
        return app('path.storage').($path ? DIRECTORY_SEPARATOR.$path : $path);
    }
}
