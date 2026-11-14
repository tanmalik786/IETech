<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;
use App\Models\ActionPlan;
use App\Models\Institute;
use App\Models\User;
use Illuminate\Http\Request;

class ActionPlanController extends Controller
{

	public function show(Institute $institute, User $user) {
		$action_plans = ActionPlan::where('created_by', $user->id)->orderBy('date', 'desc')->get();
		return view('page-action-plans', compact('action_plans'));
    }
}
