<?php

namespace Nip\Application\Traits;

use Nip\Config\Config;
use Nip\Database\DatabaseManager;

/**
 * Trait HasDatabase
 * @package Nip\Application\Traits
 * @deprecated Rely on database service provider + config
 */
trait HasDatabase
{
    public function setupDatabase()
    {
        $stageConfig = $this->getStaging()->getStage()->getConfig();
        $dbManager = new DatabaseManager();
        $dbManager->setBootstrap($this);

        $this->getContainer()->set('db', $dbManager);

        if (app('config')->has('database.connections')) {
            return;
        }

        $config = new Config([
            'database' => [
                'connections' => [
                    'main' => $stageConfig->get('DB')
                ]
            ]
        ]);
        app('config')->merge($config);
        $connection = $dbManager->connection();

        if ($this->getDebugBar()->isEnabled()) {
            $adapter = $connection->getAdapter();
            $this->getDebugBar()->initDatabaseAdapter($adapter);
        }
    }
}
