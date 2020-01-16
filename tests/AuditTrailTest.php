<?php

namespace Kingsleyudenewu\AuditTrail\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Kingsleyudenewu\AuditTrail\AuditTrailFacade;
use Kingsleyudenewu\AuditTrail\AuditTrailServiceProvider;
use Orchestra\Testbench\TestCase;

class AuditTrailTest extends TestCase
{
    use RefreshDatabase;

    public function setUp() : void
    {
        parent::setUp();

        $this->artisan('migrate', ['--database' => 'testbench'])->run();
    }
    protected function getPackageProviders($app)
    {
        return [AuditTrailServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'AuditTrail' => AuditTrailFacade::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }

    /** @test */
    public function create_audit_trails()
    {
        $this->withoutExceptionHandling();
        $a = $this->json('GET','/audit/logs');
        dd($a);
    }
}
