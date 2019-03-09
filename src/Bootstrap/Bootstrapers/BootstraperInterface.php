<?php

namespace Nip\Application\Bootstrap\Bootstrapers;

use Nip\Application\Application;

interface BootstraperInterface
{
    /**
     * @param Application $app
     * @return mixed
     */
    public function bootstrap(Application $app);
}
