<?php

namespace App\Models;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'category_id', 'content', 'image', 'user_id'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function scopeFilter($query, array $filters){
        if ($filters['search'] ?? false) {
            $searchTerm = '%' . $filters['search'] . '%';
    
            $query->where('title', 'like', $searchTerm)
                ->orWhere('category_id', 'like', $searchTerm)
                ->orWhere('user_id', 'like', $searchTerm);
        }
    }    
}
