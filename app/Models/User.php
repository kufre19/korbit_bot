<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Filament\Models\Contracts\FilamentUser;
use App\Service\TelegramBotService;
use App\Service\AcademyService;




class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'tg_id',
        'referral_code',
        'name',
        'license',
        'academy_access',
        'referral_code',
        'email',
        'password'
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
        'password' => 'hashed',
    ];

    public function wallet(): HasOne
    {
        return $this->hasOne(Wallet::class, "user_id");
    }

    public function canAccessFilament(): bool
    {
        // return str_ends_with($this->email, '@yourdomain.com') && $this->hasVerifiedEmail();
        return true;
    }

    public function getFilamentName(): string
    {
        return "{$this->name}";
    }

    public function getReferralBalanceAttribute()
    {
        return $this->wallet->referral_balance ?? '0';
    }

    protected static function boot()
    {
        parent::boot();

        static::updated(function ($user) {
            if ($user->wasChanged('license') && $user->license === 'active') {
                $telegramService = new TelegramBotService();
                $telegramService->updateNewRegisteredUser($user->tg_id);
            }

            if ($user->wasChanged('academy_access') && $user->license === 'active') {
                $telegramService = new AcademyService();
                $telegramService->activationMessage($user->tg_id);
            }
        });
    }
}
