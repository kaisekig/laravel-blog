<?php
namespace App\Http\Controllers;

use App\Models\Post;
use App\Repositories\CategoryRepository;
use App\Repositories\CommentRepository;
use App\Repositories\PostRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\Exception\HttpException;

class UserDashboardController extends Controller {
    private PostRepository $postRepository;
    private CategoryRepository $categoryRepository;
    private CommentRepository $commentRepository;

    public function __construct(PostRepository $postRepository, CategoryRepository $categoryRepository, CommentRepository $commentRepository)
    {
        $this->postRepository     = $postRepository;
        $this->categoryRepository = $categoryRepository;
        $this->commentRepository  = $commentRepository;
    }

    public function dashboard(Request $request) {
        $userId   = $request->session()->get("user_id");
        $username = $request->session()->get("username"); 

        return view("layouts.user.dashboard", [
            "username" => $username,
            "posts" => $this->postRepository->allByUser($userId), 
            "categories" => $this->categoryRepository->all(),
        ]);
    }

    public function post(Request $request, int $postId) {
        $post = $this->postRepository->one($postId);
        $userId = $request->session()->get("user_id");

        if (!Gate::forUser($userId)->allows("post", [$post])) {
            throw new HttpException(403, "Unauthorized");
        }

        return view("layouts.posts.post", [
            "post"     => $this->postRepository->one($postId),
            "comments" => $this->commentRepository->allByPost($postId)
        ]);
    }

    public function add(Request $request) {
        $userId = $request->session()->get("user_id"); 

        $path = null;
        if ($request->file('upload')) {
            $path = Storage::putFile('images', $request->file('upload'));
        }

        $title      = $request->input("title");
        $body       = $request->input("body");
        $categoryId = $request->input("category_id");

        $this->postRepository->add([
            "title"       => $title,
            "body"        => $body,
            "category_id" => $categoryId,
            "user_id"     => $userId,
            "image_path"  => $path
        ]);

        return redirect()->route("user/dashboard");
    }

    public function getEdit(Request $request, int $postId) {
        $userId = $request->session()->get("user_id");
        $post   = $this->postRepository->one($postId);

        if (!Gate::forUser($userId)->allows("post-update", [$post])) {
            throw new HttpException(403, "Unauthorized");
        }

        $categories = $this->categoryRepository->all();
        $post       = $this->postRepository->one($postId);

        return view("layouts.posts.edit", [
            "post" => $post, 
            "categories" => $categories
        ]);
    }

    public function edit(Request $request, int $postId) {
        $userId = $request->session()->get("user_id");
        $post = $this->postRepository->one($postId);

        if (!Gate::forUser($userId)->allows("post-update", [$post])) {
            throw new HttpException(403, "Unauthorized");
        }

        $path = null;
        if ($request->file('upload')) {
            $path = Storage::putFile('images', $request->file('upload'));
        }

        $title      = $request->input("title");
        $body       = $request->input("body");
        $categoryId = $request->input("category_id");

        $this->postRepository->edit($userId, $postId, [
            "title"       => $title, 
            "body"        => $body,
            "category_id" => $categoryId,
            "image_path"  => $path
        ]);

        return redirect()->route("user/dashboard");
    }

    public function delete(Request $request, int $postId) {
        $userId = $request->session()->get("user_id");
        $post   = $this->postRepository->one($postId);

        if (!Gate::forUser($userId)->allows("post-update", [$post])) {
            throw new HttpException(403, "Unauthorized");
        }

        $this->postRepository->delete($userId, $postId);

        return redirect()->route("user/dashboard");
    }

    public function logout(Request $request) {
        $request->session()->flush();
        $request->session()->save();
        
        return redirect()->route("home");
    }
}
