<?php

namespace App\Http\Controllers;

use App\Fingerprint\BaseFingerprint;
use App\Helpers\DetermHash;
use App\Repositories\AdministratorRepository;
use App\Repositories\UserRepository;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller {
    private UserRepository $userRepository;
    private AdministratorRepository $adminRepository;

    public function __construct(UserRepository $userRepository, AdministratorRepository $adminRepository)
    {
        $this->userRepository  = $userRepository;
        $this->adminRepository = $adminRepository;
    }

    public function register(Request $request) {
        $email          = $request->input("email");
        $username       = $request->input("username");
        $firstPassword  = $request->input("firstPassword");
        $secondPassword = $request->input("secondPassword");

        $user = $this->userRepository->getByEmail($email);
        
        if ($user) {
            return redirect()->route("user/register")->with('error', 'User already exists!');
            throw new \Exception("User already exists!");
        }

        $user = $this->userRepository->getByUsername($username);
        if ($user) {
            return redirect()->route("user/register")->with('error', 'User already exists!');
            throw new \Exception("User already exists!");
        }

        if ($firstPassword !== $secondPassword) {
            return redirect()->route("user/register")->with('error', 'Password doesn\'t match!');
            throw new \Exception("Password doesn't match!");
        }

        $passwordHash = Hash::make($firstPassword);
        $response = $this->userRepository->add([
            "email" => $email, 
            "username" => $username, 
            "password" => $passwordHash
        ]);

        if (!$response) {
            return redirect()->route("user/register")->with('error', 'Couldn\'t create user!');
            throw new \Exception("Couldn't create user!");
        }

        return redirect()->route("user/login");
    }

    public function login(Request $request) {

        $username = $request->input("username");
        $password = $request->input("password");

        $user = $this->userRepository->getByUsername($username);
        if (!$user) {
            return redirect()->route("user/login")->with("error", "User doens't exist!");
            throw new \Exception("User doens't exist!");
        }
        
        if (!Hash::check($password, $user->password)) {
            return redirect()->route("user/login")->with("error", "Password doesn't match!");
            throw new \Exception("Password doesn't match!");
        }

        $request->session()->regenerate();
        $request->session()->put("user_id", $user->user_id);
        $request->session()->put("fingerprint", Hash::make(BaseFingerprint::makeFingerprint($request)));
        $request->session()->put("username", $user->username);
        $request->session()->save();

        return redirect()->route("user/dashboard");
    }

    public function adminRegister(Request $request) {
        $username           = $request->input("username");
        $password           = $request->input("password1");
        $repeatedPassword   = $request->input("password2");

        if ($password !== $repeatedPassword) {
            return redirect()->route("admin/register")->with("error", "Password doesn't match!");
            throw new \Exception("Password doesn't match!");
        }

        $admin = $this->adminRepository->getByUsername($username);
        if ($admin) {
            return redirect()->route("admin/register")->with("error", "Admin already exists!");
            throw new \Exception("Admin already exists!");
        }

        $passwordHash = Hash::make($password);

        $admin = $this->adminRepository->add([
            "username" => $username,
            "password" => $passwordHash
        ]);

        if (!$admin) {
            return redirect()->route("admin/register")->with("error", "Something went wrong!");
            throw new Exception("Something went wrong!");
        }

        return redirect()->route("admin/dashboard");
    }

    public function adminLogin(Request $request) {
        $username = $request->input("username");
        $password = $request->input("password");

        $admin = $this->adminRepository->getByUsername($username);
        if (!$admin) {
            return redirect()->route('admin/login')->with("error", "Administrator doens't exist!");
            throw new \Exception("Administrator doens't exist!");
        }

        if (!Hash::check($password, DetermHash::check($admin->password))) {
            return redirect()->route('admin/login')->with("error", "Password doesn't match!");
            throw new \Exception("Password doesn't match!");
        }

        $request->session()->regenerate();
        $request->session()->put("admin_id", $admin->administrator_id);
        $request->session()->put("role", $admin->role);
        $request->session()->put("fingerprint", Hash::make(BaseFingerprint::makeFingerprint($request)));
        $request->session()->save();

        return redirect()->route("admin/dashboard");
    }
}