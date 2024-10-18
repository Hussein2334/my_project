<?php

namespace App\Http\Controllers;

use App\Mail\WelcomeMail;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PostController extends Controller
{
    /**
     * Apply the middleware to the controller's methods.
     */
    public static function middleware()
    {
        return[
             new Middleware('auth', except: ['index', 'show']),
        ];
    }
    public function index()
    {
        $posts = Post::latest()->paginate(6);
        return view('posts.index', ['posts' => $posts]);
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);
        return view('posts.show', ['post' => $post]);
    }

    public function store(Request $request)
    {
        try {
            // Validate the request
            $request->validate([
                'tittle' => ['required', 'max:255'],
                'body' => ['required'],
                'image' => ['nullable', 'file', 'max:1000', 'mimes:webp,jpg,png']
            ]);

            // Store the image if it exists
            $path = null;
            if ($request->hasFile('image')) {
                $path = Storage::disk('public')->put('posts_image', $request->image);
            }

            // Create a new post for the authenticated user
            $post = Auth::user()->posts()->create([
                'tittle' => $request->tittle,
                'body' => $request->body,
                'image' => $path
            ]);

            // Send the welcome email
            $user = Auth::user();
            if ($user) {
                Mail::to($user->email)->send(new WelcomeMail($user, $post));
            } else {
                return redirect()->route('login')->withErrors('You must be logged in to view this page.');
            }

            // Redirect with success message
            return back()->with('success', 'Your post was created successfully.');
        } catch (\Exception $e) {
            // Log the error
            Log::error('Error creating post or sending email: ' . $e->getMessage());

            // Return with error
            return back()->withErrors('There was an issue creating the post or sending the email.');
        }
    }

    public function update(Request $request, $id)
    {
        // Validation and update logic
        $post = Post::findOrFail($id);
        
        $request->validate([
            'tittle' => 'required|max:255',
            'body' => 'required',
            'image' => 'nullable|file|max:1000|mimes:webp,jpg,png',
        ]);

        // Update the post
        $post->update([
            'tittle' => $request->tittle,
            'body' => $request->body,
        ]);

        // Handle image if it exists
        if ($request->hasFile('image')) {
            $path = Storage::disk('public')->put('posts_image', $request->image);
            $post->update(['image' => $path]);
        }

        return back()->with('success', 'Post updated successfully.');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();
        
        return back()->with('success', 'Post deleted successfully.');
    }
}
