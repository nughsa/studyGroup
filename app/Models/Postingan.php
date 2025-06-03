<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Postingan extends Model
{
    use HasFactory;

    protected $fillable = ['category_id', 'title', 'slug', 'desc', 'group', 'img', 'views', 'status', 'publish_date', 'user_id'];

    //relasi ke kategori
    public function Category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
