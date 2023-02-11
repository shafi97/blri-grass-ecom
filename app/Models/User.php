<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Traits\Hasid;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes, HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'role',
        'organization_name',
        'division_id',
        'district_id',
        'upazila_id',
        'union_id',
        'image',
        'phone',
        'address',
        'd_o_b',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    public function district()
    {
        return $this->belongsTo(District::class, 'district_id', 'id')->withDefault();
    }
    public function upazila()
    {
        return $this->belongsTo(Upazila::class, 'upazila_id', 'id')->withDefault();
    }
    public function union()
    {
        return $this->belongsTo(Union::class, 'union_id', 'id')->withDefault();
    }
}
