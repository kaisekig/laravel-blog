<?php
    namespace App\Interfaces;

    interface AdministratorRepositoryInterface 
    {
        public function all();
        public function one(int $adminId);
        public function add(array $adminData);
        public function edit(int $adminId, array $adminData);
        public function delete(int $adminId);

        public function getByEmail(string $mail);
        public function getByUsername(string $username);
    }
?>