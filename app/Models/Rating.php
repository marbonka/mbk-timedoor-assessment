<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Rating extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['rating_value','book_id'];

    public function book():BelongsTo{
        return $this->belongsTo(Book::class);
    }
}
