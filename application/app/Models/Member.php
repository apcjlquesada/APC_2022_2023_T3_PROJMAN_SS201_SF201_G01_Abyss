<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';
    protected $primaryKay = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'group_project_id', 
        'user_id',
    ];

    /**
     * The belongs to Relationship
     *
     * @var array
     */
    public function group_project()
    {
        return $this->belongsTo(GroupProject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
