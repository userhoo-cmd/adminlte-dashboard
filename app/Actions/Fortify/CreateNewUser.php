<?php
use Illuminate\Support\Str;

public function create(array $input)
{
    Validator::make($input, [
        'first_name' => ['required', 'string', 'max:255'],
        'last_name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => $this->passwordRules(),
    ])->validate();

    return User::create([
        'first_name' => $input['first_name'],
        'last_name'  => $input['last_name'],
        'email'      => $input['email'],
        'password'   => Hash::make($input['password']),
        'role'       => 'user',
        'is_admin'   => 0,
    ]);
}
