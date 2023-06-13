<?php

namespace App\Imports;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class UsersImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return Model|null
     */
    public function model(array $row)
    {
        if($row['email'])
        {
            $user = User::where('email', $row['email'])->first();
            if ($user) {
                $user->update([
                    'first_name' => $row['name'],
                    'last_name' => "",
                    'mobile' => $row['student_mobile'],
                    'parent_mobile' => $row['parent_mobile'],
                ]);
            }
            return $user;
        }
        return null;
    }
}
