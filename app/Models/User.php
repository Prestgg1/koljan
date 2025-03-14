<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class User extends Authenticatable implements FilamentUser
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
        'email',
        'password',
        'balance',
        'referral_revenue',
        'referral_code',
        'referred_by',
        'total_spent',
        'role',
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
        ];
    }

    public function canAccessPanel(Panel $panel): bool
    {

        return $this->role === 'admin';
    }

    public function referredBy()
    {
        return $this->belongsTo(User::class, 'referred_by');
    }

    public function referrals()
    {
        return $this->hasMany(User::class, 'referred_by')->with('referrals');
    }

    public function updateTotalSpent($amount)
    {
        $this->total_spent += $amount;
        $this->save();
        // Eğer 50$ geçtiyse ve önbellekte varsa, ödül sürecini başlat
        /*   if ($this->total_spent >= 50 && Cache::has("pending_bonus_{$this->id}")) {
              $this->processReferralBonus();
              Cache::forget("pending_bonus_{$this->id}"); // Ön bellekteki kaydı sil
          } */
    }

    public function processReferralBonus($amount)
    {
        $referrer = $this->referredBy;

        // Eğer referans yoksa işlemi durdur
        if (! $referrer) {
            return;
        }

        // Kullanıcı başına sabit bir ödül belirle (Örneğin, her 50$ için 3$)
        $bonusAmount = intval($amount / 50) * 2;

        if ($bonusAmount > 0) {
            $referrer->referral_revenue += $bonusAmount;
            $referrer->balance += $bonusAmount;
            $referrer->referral_cycle += $amount;
            $referrer->save();
        }

        // Recursive olarak bir üst referansı çağır
        $referrer->processReferralBonus($amount);
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($user) {
            $user->referral_code = Str::random(10);
        });
    }
}
