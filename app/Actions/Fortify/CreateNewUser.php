<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;    
use App\Enums\TypeOfDocuments;  
use Illuminate\Validation\Rules\Enum;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name'           => ['required', 'string', 'max:255'],
            'email'          => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password'       => $this->passwordRules(),
            'terms'          => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
            'lastname'       => ['required', 'string', 'max:255'],
            'phone'          => ['required', 'string', 'max:15', 'unique:users'],
            'document'       => ['required', 'string', 'between:6,15' , 'unique:users'],
            'typeofdocument' => ['required', 'integer', new Enum(TypeOfDocuments::class)],
        ])->validate();

        return User::create([
            'name'           => $input['name'],
            'email'          => $input['email'],
            'password'       => Hash::make($input['password']),
            'lastname'       => $input['lastname'],
            'phone'          => $input['phone'],
            'document'       => $input['document'],
            'typeofdocument' => $input['typeofdocument'],
        ]);
    }
}
