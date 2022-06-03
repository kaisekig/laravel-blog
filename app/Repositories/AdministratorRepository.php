<?php
namespace App\Repositories;

use App\Interfaces\AdministratorRepositoryInterface;
use App\Models\Administrator;


class AdministratorRepository implements AdministratorRepositoryInterface {
    public function all()
    {
            
        return Administrator::all();
    }

    public function one(int $adminId)
    {
        return Administrator::findOrFail($adminId);
    }

    public function add(array $adminData)
    {
        return Administrator::firstOrCreate($adminData);
    }

    public function edit(int $adminId, array $adminData)
    {
        return Administrator::where("administrator_id", $adminId)
                        ->update($adminData);
    }

    public function delete(int $adminId)
    {
        return Administrator::destroy($adminId);
    }

    public function getByEmail(string $mail)
    {
        return Administrator::where("email", $mail)->first();
    }

    public function getByUsername(string $username)
    {
        return Administrator::where("username", $username)->first();
    }

    }
?>