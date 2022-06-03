<?php

namespace App\Http\Controllers;

use App\Repositories\CategoryRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    private CategoryRepository $categoryRepository;

    public function __construct(CategoryRepository $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function dashboard(Request $request) {
        $role = $request->session()->get("role");
        $categories = $this->categoryRepository->all();

        return view("layouts.admin.dashboard", [
            "categories" => $categories, 
            "role" => $role
        ]);
    }

    public function add(Request $request) {
        $title = $request->input("title");

        $this->categoryRepository->add([
            "title" => $title
        ]);

        return redirect()->route("admin/dashboard");
    }

    public function getEdit(int $id, Request $request) {
        $category = $this->categoryRepository->one($id);

        return view("layouts.admin.edit", [
            "category" => $category,
            "role"     => $request->session()->get("role")
        ]);
    }

    public function edit(Request $request, int $id) {
        $title = $request->input("title");
        $this->categoryRepository->edit($id, ["title" => $title]);

        return redirect()->route("admin/dashboard");
    }

    public function delete(int $id) {
        $result = $this->categoryRepository->delete($id);

        if (!$result) {
            throw new ModelNotFoundException();
        };
        
        return redirect()->route("admin/dashboard");
    }

    public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->save();
        
        return redirect()->route("admin/login");
    }
    
    public function getAdminRegister(Request $request) {
        return view("layouts.admin.register", ["role" => $request->session()->get("role")]);
    }
}
