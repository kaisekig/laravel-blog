<?php
    namespace App\Repositories;

    use App\Interfaces\UserRepositoryInterface;
    use App\Models\User;
    use Illuminate\Database\Eloquent\ModelNotFoundException;

    class UserRepository implements UserRepositoryInterface {
        public function all()
        {
            return User::all()
                       ->whenEmpty(fn() => throw new ModelNotFoundException());
        }

        public function one(int $userId)
        {
            return User::findOrFail($userId);
        }

        public function add(array $userData)
        {
            return User::firstOrCreate($userData);
        }

        public function edit(int $userId, array $userData)
        {
            return User::where("user_id", $userId)
                       ->update($userData)
                       ->whenEmpty(fn() => throw new ModelNotFoundException());
        }

        public function getByUsername(string $username)
        {
            return User::where("username", $username)->first();
        }

        public function getByEmail(string $email)
        {
            return User::where("email", $email)->first();
        }

        public function delete(int $userId)
        {
            
        }
    }
?>