<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'users';
    protected $primaryKay = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'type'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The value of attributes that should have user access.
     *
     * 
     */

    protected function type(): Attribute
    {
        return new Attribute(
            get: fn ($value) =>  ["office", "teacher", "adviser", "student"][$value],
        );
    }
    /**
     * The has Many Relationship
     *
     * @var array
     */
    
    public function group_projects()
    {
        return $this->hasMany(GroupProject::class, 'user_id');
    }
    
    public function members()
    {
        return $this->hasMany(Member::class);
    }
} 
