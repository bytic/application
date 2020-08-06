<?php

namespace Nip\Application\Tests;

use PHPUnit\Framework\TestCase;

/**
 * Class AbstractTest.
 */
abstract class AbstractTest extends TestCase
{
    protected $object;

    public function tearDown(): void
    {
        parent::tearDown();
        \Mockery::close();
    }
}
