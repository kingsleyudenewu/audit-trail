<?php


namespace Kingsleyudenewu\AuditTrail\Models;


class AuditTrail extends Model
{
    use SoftDeletes;

    protected $table = 'audit_trails';

    protected $guarded = ['id'];
}
