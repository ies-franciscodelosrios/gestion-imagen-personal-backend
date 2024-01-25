<?php

namespace App\Imports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UserImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new User([
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
    }
}
