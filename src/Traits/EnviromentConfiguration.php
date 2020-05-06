<?php

namespace Nip\Application\Traits;

use ByTIC\Dotenv\HasEnv\HasEnviroment;

/**
 * Class EnviromentConfiguration
 * @package Nip\Application\Traits
 */
trait EnviromentConfiguration
{
    use HasEnviroment;

    /**
     * @inheritDoc
     */
    public function environmentPathGeneric()
    {
        return $this->basePath();
    }

    /**
     * Get or check the current application environment.
     *
     * @return string|bool
     */
    public function environment()
    {
        if (func_num_args() > 0) {
            $patterns = is_array(func_get_arg(0)) ? func_get_arg(0) : func_get_args();
            foreach ($patterns as $pattern) {
                if ($pattern == $this['env']) {
                    return true;
                }
            }
            return false;
        }
        return $this['env'];
    }
}
