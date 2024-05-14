<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IndustryCategories extends Model
{
    protected $table = 'industry_categories';

    protected $fillable = [
        'category_name',
    ];

    public static function description(): array
    {
        return [
            'category_name' => [
                '電子商務',
                '金融',
                '製造業',
                '科技',
                '醫療',
                '教育',
                '旅遊',
                '娛樂',
                '其他',
            ],
        ];
    }
    use HasFactory;
}
