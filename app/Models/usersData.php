<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class usersData extends Model
{
    protected $table = 'users_data'; // Pastikan nama tabel sesuai
    protected $primaryKey = 'user_data_id'; // Set primary key ke user_data_id
    public $incrementing = true;
    protected $keyType = 'int';
    protected $fillable = [
        'userId',
        'whatsapp_number',
        'line_id',
        'github_gitlab_id',
        'birthplace',
        'birthdate',
        'cv_path',
        'flazz_or_id_card_path',
    ];
}