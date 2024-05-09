<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MemberController extends Controller
{
    public function members()
    {
        $members = User::query()
            ->orderBy('id', 'desc')
            ->get();
        return returnData(true, $members);
    }

    public function member($user_id)
    {
        $user = User::query()->where('id', $user_id)->with('details.country', 'details.cities')->first();
        return returnData(true, $user);
    }

    public function search(Request $request)
    {

    }
}
