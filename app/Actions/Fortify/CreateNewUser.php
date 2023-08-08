<?php

namespace App\Actions\Fortify;

use App\Models\Paciente;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */

     protected function separateFullName($fullName)
    {
        $names = explode(' ', $fullName, 2);
        $primer_nombre = $names[0];
        $primer_apellido = isset($names[1]) ? $names[1] : '';

        return compact('primer_nombre', 'primer_apellido');
    }

    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ])->validate();

        $user =  User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => Hash::make($input['password']),
        ]);

        // separa el nombre completo en dos partes
        $nameParts = $this->separateFullName($input['name']);
        $input = array_merge($input, $nameParts);

        // TODO: actualizar la vista de registro para que ingresen
        // los datos reales de fecha_nac, y telefono
        $paciente = new Paciente();
        $paciente->primer_nombre = $input['primer_nombre'];
        $paciente->primer_apellido = $input['primer_apellido'];
        $paciente->fecha_nacimiento = $input['fecha_nacimiento']; // '1985-06-15 00:00:00.000';
        $paciente->telefono = $input['telefono']; // '0000000000';
        $paciente->correo = $input['email'];
        $paciente->id_cuenta = $user->id;
        $paciente->save();

        return $user;
    }
}
