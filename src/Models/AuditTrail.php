<?php

namespace Kingsleyudenewu\AuditTrail\Models;

use Illuminate\Database\Eloquent\Model;

class AuditTrail extends Model
{
    protected $table = 'audit_trails';
    protected $guarded = ['id'];
}
