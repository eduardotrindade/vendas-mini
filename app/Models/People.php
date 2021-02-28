<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

/**
 * App\Models\People
 *
 * @property int $id
 * @property string $name
 * @property string $document_number
 * @property string $cellphone
 * @property string $email
 * @property string $address
 * @property string $number
 * @property string|null $complement
 * @property string|null $neighborhood
 * @property string $zip_code
 * @property string $resume
 * @property int $terms_accepted
 * @property int $is_active
 * @property int $city_id
 * @property City $city
 * @property int|null $profile_id
 * @property Profile|null $profile
 * @property string $conta_azul_code
 * @property int|null $user_id
 * @property User $user
 * @property int|null $people_id
 * @property People $people
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class People extends Model
{
    protected $fillable = [
        'name', 'document_number', 'cellphone', 'email', 'address', 'number', 'complement', 'neighborhood',
        'zip_code', 'city_id', 'resume', 'terms_accepted', 'is_active', 'profile_id', 'people_id', 'user_id',
        'conta_azul_code'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }

    public function people()
    {
        return $this->belongsTo(People::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getReferralLink()
    {
        $referralSecret = Str::random(10);

        return url('/seja-nosso-representante/' . $referralSecret . base64_encode($this->id));
    }

    public function setPeopleId(string $indicatedBy)
    {
        $indicatedByEncode = substr($indicatedBy, 10);

        $this->people_id = base64_decode($indicatedByEncode);
    }
}
