<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InquiryItems extends Model
{
    protected $table = 'InquiryItems';
    protected $fillable = [
        'item',
    ];

    public function description()
    {
        return [
            'item' => [
                '報價',
                '諮詢',
            ],
        ];
    }
    use HasFactory;
}
