<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:50'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'register_as' => ['required', 'integer'],
            'license' => 'required_if:register_as,2',
            'address' => 'required_if:register_as,2',
            'qualification' => 'required_if:register_as,3',
            'password' => $this->passwordRules(),
        ])->validate();
$data = [
    'name' => $input['name'],
    'username' => $input['username'],
    'email' => $input['email'],
    'password' => Hash::make($input['password']),
    'teacher_qualifications' => $input['qualification'] ?? null,
    'student_address'  => $input['address'] ?? null,
    'student_license_number' => $input['license'] ?? null,
    'role_id' => $input['register_as'],
];
if ($input['register_as'] == 2){
    //Student
    unset($data['teacher_qualifications']);
}else{
    //Staff
    unset($data['student_address']);
    unset($data['student_license_number']);
}
        return User::create($data);
    }
}
