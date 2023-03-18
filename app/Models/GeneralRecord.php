<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeneralRecord extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function children_records()
    {
        return $this->belongsToMany(self::class, 'general_record_to_general_record', 'parent_general_record_id', 'child_general_record_id')->withPivot(['id']);
    }

    public function parent_records()
    {
        return $this->belongsToMany(self::class, 'general_record_to_general_record', 'child_general_record_id', 'parent_general_record_id')->withPivot(['id']);
    }
}
