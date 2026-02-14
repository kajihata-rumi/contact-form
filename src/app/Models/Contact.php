<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'first_name',
        'last_name',
        'gender',
        'email',
        'tel',
        'address',
        'building',
        'detail',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function scopeKeyword($query, $keyword)
    {
        if (empty($keyword)) return $query;

        return $query->where(function ($q) use ($keyword) {
            $q->where('name', 'like', "%{$keyword}%")
                ->orWhere('email', 'like', "%{$keyword}%");
        });
    }

    public function scopeGender($query, $gender)
    {
        if (empty($gender)) return $query;
        return $query->where('gender', $gender);
    }

    public function scopeCategory($query, $categoryId)
    {
        if (empty($categoryId)) return $query;
        return $query->where('category_id', $categoryId);
    }

    public function scopeDate($query, $date)
    {
        if (empty($date)) return $query;

        // created_atの日付で絞る（仕様が「年月日」ならこれが一番ズレない）
        return $query->whereDate('created_at', $date);
    }
}
