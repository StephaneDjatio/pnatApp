<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class DataUpload extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id','filename', 'database_name', 'data_color', 'link_uploaded_file'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
