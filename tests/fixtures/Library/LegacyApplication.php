<?php

namespace Nip\Application\Tests\Fixtures\Library;

use Nip\Application as BaseApplication;

/**
 * Class LegacyApplication
 * @package Nip\Application\Tests\Fixtures
 */
class LegacyApplication extends BaseApplication
{
    /**
     * @return string
     */
    public function generateBasePath()
    {
        return TEST_FIXTURE_PATH;
    }
}
