<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use League\CommonMark\Extension\DescriptionList\Node\Description;

class IsBusinessRegistered extends Model
{

    protected $table = 'IsBusinessRegistered';

    protected $fillable = [
        'status',
    ];

    public static function description(): array
    {
        return [
            'status' => [true, false],
        ];
    }  
    use HasFactory;
}
