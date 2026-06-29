<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\Contracts\PasskeyUser;
use Laravel\Fortify\PasskeyAuthenticatable;
use Laravel\Fortify\TwoFactorAuthenticatable;

#[Fillable(['name', 'email', 'phone_number', 'password', 'role_id'])]
#[Hidden(['password', 'two_factor_secret', 'two_factor_recovery_codes', 'remember_token'])]
class User extends Authenticatable implements PasskeyUser, FilamentUser
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable, PasskeyAuthenticatable, TwoFactorAuthenticatable, SoftDeletes;

    public function canAccessPanel(Panel $panel): bool
    {
        return optional($this->role)->name == 'super_admin' || optional($this->role)->name == 'admin';
    }

    public function isSuperAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => optional($this->role)->name == 'super_admin',
        );
    }
    public function isAdmin(): Attribute
    {
        return Attribute::make(
            get: fn () => optional($this->role)->name == 'admin',
        );
    }
    public function isNormalUser(): Attribute
    {
        return Attribute::make(
            get: fn () => optional($this->role)->name != 'super_admin' && optional($this->role)->name != 'admin' ,
        );
    }

    public function hasPermission($method, $name)
    {
        try {
            return $this->permissions()->where('name', $name)->first()[$method];
        } catch (\Throwable $th) {
            return false;
            //throw $th;
        }
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function permissions()
    {
        return optional($this->role)->permissions;
    }

    public function bookings()
    {
        return $this->hasMany(Booking::class);
    }

    public function reviews()
    {
        return $this->hasManyThrough(Review::class, Booking::class);
    }

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
            'two_factor_confirmed_at' => 'datetime',
        ];
    }
}
