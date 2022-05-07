<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    protected $fillable = [
        'category_id',
        'name',
        'url',
        'whatsapp',
        'email',
        'phone',
        'facebook',
        'instagram',
        'youtube',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
