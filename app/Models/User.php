<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use App\Notifications\ResetPassword;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $guarded = ['id', 'created_at', 'updated_at', 'deleted_at'];
    protected $dates = ['date_of_birth'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();
        static::saved(function ($data) {
//            if (request()->hasFile('avatar')) {
//                if ($data->image()->whereNull('option')->exists()) {
//                    $image = $data->image()->whereNull('option')->first();
//                    if (file_exists(storage_path('app/public/uploads/user' . "/" . $image->image))) {
//                        \App\Http\Controllers\General\ImageController::delete_single_file($image->image, 'app/public/uploads/user');
//                    }
//                    AppImage::where(['app_imageable_type' => 'App\Models\User', 'app_imageable_id' => $data->id, 'image' => $image->image])->delete();
//                }
//                $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->avatar, 'app/public/uploads/user');
//                $data->image()->create(['image' => $image]);
//            }

            if (request()->hasFile('avatar')) {
                $images = \App\Http\Controllers\General\ImageController::upload_multi_files(request()->avatar, 'app/public/uploads/user', 'image');
//                data_set($images, '*.media_type', 'image');
                $data->image()->createMany($images);
            }

            if (request()->hasFile('cover')) {
                if ($data->image()->where(['option' => 'cover'])->exists()) {
                    $image = $data->image()->where(['option' => 'cover'])->first();
                    if (file_exists(storage_path('app/public/uploads/user' . "/" . $image->image))) {
                        \App\Http\Controllers\General\ImageController::delete_single_file($image->image, 'app/public/uploads/user');
                    }
                    AppImage::where(['app_imageable_type' => 'App\Models\User', 'app_imageable_id' => $data->id, 'image' => $image->image, 'option' => 'cover'])->delete();
                }
                $image = \App\Http\Controllers\General\ImageController::upload_single_file(request()->cover, 'app/public/uploads/user');
                $data->image()->create(['image' => $image, 'option' => 'cover']);
            }
        });
    }

    public function setPasswordAttribute($value)
    {
        if ($value) {
            $this->attributes['password'] = bcrypt($value);
        }
    }

    public function scopeActive($query)
    {
        $query->where(['is_active' => true, 'is_banned' => false]);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

    public function user_social()
    {
        return $this->hasMany(UserSocial::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class);
    }

    public function nationality()
    {
        return $this->belongsTo(Nationality::class);
    }

    public function user_setting()
    {
        return $this->hasOne(UserSetting::class);
    }

    public function friends()
    {
        return $this->belongsToMany(User::class, 'friend_users', 'user_id', 'friend_id');
    }

    public function my_friend_requests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'from_user_id', 'to_user_id');
    }

    public function other_friend_requests()
    {
        return $this->belongsToMany(User::class, 'friend_requests', 'to_user_id', 'from_user_id');
    }

    public function followers()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'to_user_id', 'from_user_id');
    }

    public function followings()
    {
        return $this->belongsToMany(User::class, 'follow_users', 'from_user_id', 'to_user_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function user_blocks()
    {
        return $this->hasMany(BlockUser::class, 'blocked_user_id');
    }

    public function delete()
    {
        if ($this->image()->exists()) {
            $images = AppImage::where(['app_imageable_type' => 'App\Models\User', 'app_imageable_id' => $this->id])->get();
            foreach($images as $image){
                if (file_exists(storage_path('app/public/uploads/user' . "/" . $image->image))) {
                    \App\Http\Controllers\General\ImageController::delete_single_file($image->image, 'app/public/uploads/user');
                }
            }
            AppImage::where(['app_imageable_type' => 'App\Models\User', 'app_imageable_id' => $this->id])->delete();
        }
        parent::delete();
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function screen_shots()
    {
        return $this->belongsToMany(Post::class, 'screen_shot_posts', 'user_id', 'post_id')->withTimestamps();
    }

    public function like_posts()
    {
        return $this->belongsToMany(Post::class, 'like_posts', 'user_id', 'post_id');
    }

    public function fav_posts()
    {
        return $this->belongsToMany(Post::class, 'fav_posts', 'user_id', 'post_id');
    }

    public function package_user()
    {
        return $this->hasMany(PackageUser::class);
    }

    public function hidden_ad()
    {
        return $this->hasMany(HiddenAd::class);
    }

    public function retweet()
    {
        return $this->morphMany(Post::class, 'postable');
    }

    public function image()
    {
        return $this->morphMany(AppImage::class, 'app_imageable');
    }

    public function getFullNameAttribute($value)
    {
        if ($this->attributes['fullname'] != null) {
            return $this->attributes['fullname'];
        } else {
            return $this->attributes['username'];
        }
    }

    public function getProfileImageAttribute()
    {
        if ($this->image()->whereNull('option')->exists()) {
            $image = $this->image->whereNull('option')->first();
            if (!file_exists(storage_path('app/public/uploads/user' . "/" . $image->image))) {
                return asset('storage/uploads/user-default.png');
            }
            return asset('storage/uploads/user') . '/' . $image->image;
        } else {
            return asset('storage/uploads/user-default.png');
        }
    }

    public function getCoverUrlAttribute()
    {
        if ($this->image()->where(['option' => 'cover'])->exists()) {
            $image = $this->image()->where(['option' => 'cover'])->first();
            if (!file_exists(storage_path('app/public/uploads/user' . "/" . $image->image))) {
                return asset('storage/uploads/default.png');
            }
            return asset('storage/uploads/user') . '/' . $image->image;
        } else {
            return asset('storage/uploads/default.png');
        }
    }

    public function hasPermissions($route, $method = null)
    {
        if ($this->user_type == 'superadmin') {
            return true;
        }
        if (is_null($method)) {
            if ($this->role->where('plan', 'LIKE', "dashboard." . $route . ".index")->exists()) {
                return true;
            } elseif ($this->role->where('plan', 'LIKE', "dashboard." . $route . ".store")->exists()) {
                return true;
            } elseif ($this->role->where('plan', 'LIKE', "dashboard." . $route . ".update")->exists()) {
                return true;
            } elseif ($this->role->where('plan', 'LIKE', "dashboard." . $route . ".destroy")->exists()) {
                return true;
            } elseif ($this->role->where('plan', 'LIKE', "dashboard." . $route . ".show")->exists()) {
                return true;
            }
        } else {
            return $this->role->where('plan', 'LIKE', "%dashboard." . $route . "." . $method . '%')->exists();
        }
        return false;
    }

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function sendPasswordResetNotification($token)
    {
        return $this->notify(new ResetPassword($token));
    }

    // For Notification Channel
    public function receivesBroadcastNotificationsOn()
    {
        return 'phew-notification.' . $this->id;
    }
}
