<?php

namespace App\Http\Controllers;

use App\Models\Institute;
use App\Models\Post;
use App\Models\Slide;
use App\Models\User;
use Illuminate\Http\Request;

class PortfolioController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @param \App\Models\User $user
     *
     * @return \Illuminate\View\View
     */
    public function index(Institute $institute,User $user): \Illuminate\View\View {
        $qualifications = Post::qualifications()->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $professional_experiences = Post::experiences()->where('user_id', $user->id)->where('category', 'professional')->orderBy('id', 'desc')->get();
        $research_experiences = Post::experiences()->where('user_id', $user->id)->where('category', 'research')->orderBy('id', 'desc')->get();
        $achievements = Post::achievements()->where('user_id', $user->id)->orderBy('id', 'desc')->get();
        $slides = Slide::where('user_id', $user->id)->orderBy('id', 'desc')->get();
        return view('portfolio', compact('user', 'qualifications', 'professional_experiences', 'research_experiences', 'slides', 'achievements'));
    }

}
