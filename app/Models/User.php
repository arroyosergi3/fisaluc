<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'phone',
        'google_id',
        'birthday',
        'role',
        'password',
        'google_access_token',
        'google_refresh_token',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'google_access_token' => 'array',

        ];
    }

public function appointmentsAsPhysio()
{
    return $this->hasMany(Appointment::class, 'physio_id');
}

public function appointmentsAsPatient()
{
    return $this->hasMany(Appointment::class, 'patient_id');
}


public function routeNotificationForGoogleCalendar()
{
    return [
        'access_token' => $this->google_access_token,
        'refresh_token' => $this->google_refresh_token,
        'token_expiry' => $this->google_token_expiry,
    ];
}

}
