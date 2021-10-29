<?php

namespace Jumia\Tests;

use Jumia\Database\SQLiteConnection;
use PHPUnit\Framework\TestCase;

class DatabaseTest extends TestCase
{
    public function testConnectToDatabase()
    {
        $connection = (new SQLiteConnection())->connect();

        $this->assertInstanceOf('pdo', $connection);
    }
}
