<?php

namespace Kingsleyudenewu\AuditTrail\Tests;

use Kingsleyudenewu\AuditTrail\AuditTrailFacade;
use Kingsleyudenewu\AuditTrail\AuditTrailServiceProvider;
use Kingsleyudenewu\AuditTrail\database\migrations\CreateAuditTrailTable;
use Kingsleyudenewu\AuditTrail\Models\AuditTrail;
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

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        include_once __DIR__ . '/../database/migrations/create_audit_trail_table.php.stub';
        (new CreateAuditTrailTable)->up();
    }

    public function test_create_audit_trails()
    {
        $this->withoutExceptionHandling();

        $audit_trail = new AuditTrail();
        $audit_trail->user_id = 1;
        $audit_trail->action = 'Created audit trail';
        $audit_trail->save();

        $new_audit_trail = AuditTrail::first();

        $this->assertNotNull($audit_trail);
        $this->assertSame($new_audit_trail->action, 'Created audit trail');
    }
}
