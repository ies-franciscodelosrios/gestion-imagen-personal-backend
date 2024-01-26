<?php

namespace App\Imports;

use App\Models\User;
use App\Rules\DniValidation;
use App\Rules\EmailValidation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Validator;

class UserImport implements ToModel, WithHeadingRow
{
    private $importedCount = 0;
    private $notimportedCount = 0;

    public function model(array $row)
    {

        $rules = [
            'email' => ['required', 'string', 'max:255', new EmailValidation, 'unique:users,dni'],
            'dni' => ['required', 'string', 'max:255', new DniValidation, 'unique:users,dni'],
        ];

        $validator = Validator::make($row, $rules);

        if ($validator->fails()) {
            $this->notimportedCount++;
            return null;
        }

        $user = new User([
            'dni' => $row['dni'],
            'rol' => $row['rol'],
            'course_year' => $row['course_year'],
            'cycle' => $row['cycle'],
            'name' => $row['name'],
            'surname' => $row['surname'],
            'email' => $row['email'],
            'password' => bcrypt($row['password']), //De esta manera ciframos la contraseña en hash
            'others' => $row['others'],
        ]);

        $this->importedCount++;

        return $user;
    }

    public function getImportedCount()
    {
        return $this->importedCount;
    }

    public function getNotImportedCount()
    {
        return $this->notimportedCount;
    }
}
