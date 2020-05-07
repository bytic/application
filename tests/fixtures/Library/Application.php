<?php

namespace Nip\Application\Tests\Fixtures\Library;

use Nip\Application\Application as BaseApplication;

/**
 * Class Application
 * @package Nip\Application\Tests\Fixtures\Library
 */
class Application extends BaseApplication
{
    /**
     * @return string
     */
    public function generateBasePath()
    {
        return TEST_FIXTURE_PATH;
    }
}
