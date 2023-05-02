<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, BaseModel;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'phone',
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

    /**
     * Get all of the Roles
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function roles()
    {
        return $this->hasManyThrough(Role::class, UserRole::class, 'user_id', 'id', 'id', 'id');
        // return $this->belongsToMany(Role::class, 'user_role', 'user_id', 'role_id',);
    }

    /**
     * Get all of the Assigned Roles for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function userRoles()
    {
        return $this->hasMany(UserRole::class, 'user_id');
    }

    /**
     * Get all of the Seller for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function seller()
    {
        return $this->hasOne(Seller::class, 'user_id', 'id');
    }


    /**
     * Fetch Active Status
     */
    public function scopeActiveUser($query)
    {
        $query->where('status', ACTIVE);
    }

    /**
     * Description - Check Action Access
     * @author Umar A
     */
    public function hasAccess($module = "", $actionKey)
    {
        // dd($module);
        $mods = $action = [];
        // foreach ($modules as $actionKey => $module) {
        // $mod = getModulePermission($modules, $actionKey);
        $categ = explode('-', $module);
        $mods[] = $categ[1];
        $privs = array_flip(config('default-data.privileges'));
        $action[] = $privs[ucfirst($categ[0])];
        // }
        // check if the permission is available in any role
        foreach ($this->roles as $role) {
            if ($role->hasAccess($mods, $action)) {
                return true;
            }
        }

        return false;
    }

    public function updateUserDetails($request)
    {
        if (!$this->id) {
            $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.user'));
            $this->status = ACTIVE;
        }
        return $this->saveUpdateInfo($this, $request->only('name', 'email', 'phone'));
    }

    public function saveofficials($data)
    {
        $this->business_ref_id = generateBusinessReferenceId($this, config('default-data.ref_prefix.user'));
        $this->status = ACTIVE;
        $this->phone = $data['phone'];
        $this->name = $data['name'];
        $this->email = $data['email'];
        $this->password = \Hash::make($data['password']);
        if ($this->save()) {
            foreach ($data['roles'] as $key => $role) {
                $userRole = new UserRole();
                $userRole->user_id = $this->id;
                $userRole->role_id = $role;
                $userRole->status = ACTIVE;
                $userRole->created_by = $this->id;
                $userRole->updated_by = $this->id;
                if (!$userRole->save()) {
                    return false;
                }
            }
            return $this;
        }
        return false;
    }
}
