<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

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
 * @property string $indicated_by
 * @property string $resume
 * @property int $terms_accepted
 * @property int $is_active
 * @property int $city_id
 * @property City $city
 * @property int|null $profile_id
 * @property Profile|null $profile
 * @property string $conta_azul_code
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|People newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|People newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|People query()
 * @method static \Illuminate\Database\Eloquent\Builder|People whereAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereCellphone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereCityId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereComplement($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereDocumentNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereIndicatedBy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereNeighborhood($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereNumber($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereProfileId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereResume($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereTermsAccepted($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|People whereZipCode($value)
 * @mixin \Eloquent
 */
class People extends Model
{
    protected $fillable = [
        'name', 'document_number', 'cellphone', 'email', 'address', 'number', 'complement', 'neighborhood',
        'zip_code', 'city_id', 'indicated_by', 'resume', 'terms_accepted', 'is_active', 'profile_id', 'conta_azul_code'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function profile()
    {
        return $this->belongsTo(Profile::class);
    }
}
