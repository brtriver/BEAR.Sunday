<?php

namespace BEAR\Framework\Module\Provider;

use BEAR\Framework\Inject\TmpDirInject;
use BEAR\Framework\Module\AbstractSingletonProvider;
use BEAR\Framework\Inject\TmpDir;
use PDO;

/**
 * PDO provider
 */
class PdoProvider extends AbstractSingletonProvider
{
    use TmpDirInject;

    /**
     * Return instance
     *
     * @return PDO
     */
    public function newInstance()
    {
        $dbfile = $this->tmpDir . 'demo01.sqlite3';
        $instance = new PDO('sqlite:' .$dbfile, null, null);
        $instance->query("CREATE TABLE User (Id INTEGER PRIMARY KEY, Name TEXT, Age INTEGER)");

        return $instance;
    }
}
