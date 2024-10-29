<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'password' => 'hashed',
        ];
    }

    /**
     * Return all standard users
     * 
     * @return
     */
    public static function getStandardUsers()
    {
        return self::select('id', 'name', 'surname');
    }

    /**
     * Return user
     * 
     * @param $id
     * @return
     */
    public static function getUserDetails($id)
    {
        return self::where('id', $id)->first();
    }

    /**
     * Populate the user registration fields
     * 
     * @param $user
     * @param $name
     * @param $surname
     * @param $email
     * @param $password
     * @param $confirmPassword
     */
    private static function populateRegisterUserFields($user, $name, $surname, $email, $password, $confirmPassword)
    {
        if($name !== '') {
            $user->name = $name;
        }
        if($surname !== '') {
            $user->surname = $surname;
        }
        if($email !== '') {
            $user->email = $email;
        }
        if($password !== '' && $confirmPassword !== '') {
            if($confirmPassword !== $password) {
                throw new \Exception('Passwords do not match.');
            } else {
                $user->password = Hash::make($password);
            }
        }
        
        return $user;
    }

    /**
     * Save the form fields to the database.
     *
     * @param $data
     * @return mixed
     */
    public static function registerUser($data)
    {
        $user = new User();
        $user = self::populateRegisterUserFields($user, $data['name'], $data['surname'], $data['email'], $data['password'], $data['confirm_password']);
        $user->save();
    }
}
