<?php

namespace LaravelEnso\Core\app\Models;

use Illuminate\Auth\Passwords\ResetPasswordNotification;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use LaravelEnso\Core\app\Classes\DefaultPreferences;
use LaravelEnso\Impersonate\app\Traits\Model\Impersonate;

class User extends Authenticatable
{
    use Notifiable, Impersonate;

    protected $hidden = ['password', 'remember_token'];

    protected $fillable = ['first_name', 'last_name', 'phone', 'nin', 'is_active', 'role_id'];

    protected $appends = ['avatar_id', 'full_name', 'preferences'];

    public function owner()
    {
        return $this->belongsTo('LaravelEnso\Core\app\Models\Owner');
    }

    public function avatar()
    {
        return $this->hasOne('LaravelEnso\AvatarManager\app\Models\Avatar');
    }

    public function getAvatarIdAttribute()
    {
        $id = $this->avatar ? $this->avatar->id : null;
        unset($this->avatar);

        return $id;
    }

    public function role()
    {
        return $this->belongsTo('LaravelEnso\RoleManager\app\Models\Role');
    }

    public function logins()
    {
        return $this->hasMany('LaravelEnso\Core\app\Models\Login');
    }

    public function preference()
    {
        return $this->hasOne('LaravelEnso\Core\app\Models\Preference');
    }

    public function getPreferencesAttribute()
    {
        $preferences = $this->preference ? $this->preference->value : (new DefaultPreferences())->getData();
        unset($this->preference);

        return $preferences;
    }

    public function action_logs()
    {
        return $this->hasMany('LaravelEnso\ActionLogger\app\Models\ActionLog');
    }

    public function isAdmin()
    {
        return $this->role_id === 1;
    }

    public function scopeActive($query)
    {
        return $query->whereIsActive(true);
    }

    public function scopeDisabled($query)
    {
        return $query->whereIsActive(false);
    }

    public function isActive()
    {
        return $this->is_active;
    }

    public function isDisabled()
    {
        return !$this->is_active;
    }

    public function hasAccessTo($route)
    {
        return $this->role->permissions->pluck('name')->search($route) !== false;
    }

    public function getFullNameAttribute()
    {
        return trim($this->first_name . ' ' . $this->last_name);
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPasswordNotification($this, $token));
    }
}
