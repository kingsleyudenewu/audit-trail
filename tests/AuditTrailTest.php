<?php

namespace Kingsleyudenewu\AuditTrail\Tests;

use Kingsleyudenewu\AuditTrail\AuditTrailFacade;
use Kingsleyudenewu\AuditTrail\AuditTrailServiceProvider;
use Kingsleyudenewu\AuditTrail\database\migrations\CreateAuditTrailTable;
use Kingsleyudenewu\AuditTrail\Models\AuditTrail;
use Kingsleyudenewu\AuditTrail\AuditTrail as Audit;
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
        include_once __DIR__ . '/../database/migrations/2020_01_24_151838_create_audit_trail_table.php';
        (new CreateAuditTrailTable)->up();
    }

    private function createLog()
    {
        $audit_trail = new AuditTrail();
        $audit_trail->user_id = 1;
        $audit_trail->action = 'User logged in successfully';
        $audit_trail->model = "Kingsleyudenewu\AuditTrail\Models\AuditTrail";
        $audit_trail->save();
        return $audit_trail;
    }

    public function test_create_audit_trails()
    {
        $this->withoutExceptionHandling();

        $activity_log = $this->createLog();
        $new_log = AuditTrail::first();

        $this->assertNotNull($activity_log);
        $this->assertSame($new_log->action, 'User logged in successfully');
    }

    /**
     * @test
     */

    public function fetchAllLogs()
    {
        $this->createLog();
        $logs = new Audit();
        $activity_array = $logs->getAllLogs(10,false);
        $this->assertNotEmpty($activity_array);
    }

    /**
     * @test
     */

    public function fetchSingleLog()
    {
        $this->withoutExceptionHandling();
        $this->createLog();
        $log = AuditTrail::first();
        $this->assertInstanceOf("Kingsleyudenewu\AuditTrail\Models\AuditTrail", $log);
    }
}
