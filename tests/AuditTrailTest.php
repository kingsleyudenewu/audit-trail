<?php

namespace Kingsleyudenewu\AuditTrail\Tests;

use Kingsleyudenewu\AuditTrail\AuditTrailFacade;
use Kingsleyudenewu\AuditTrail\AuditTrailServiceProvider;
use Orchestra\Testbench\TestCase;

class AuditTrailTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [AuditTrailServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'AuditTrail' => AuditTrailFacade::class,
        ];
    }
}
