<?php

namespace App\Http\Controllers;

class UserController extends Controller
{
    public function referralTree(User $user)
    {
        $tree = $this->buildReferralTree($user);

        return response()->json($tree);
    }

    private function buildReferralTree($user)
    {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'referrals' => $user->referrals->map(fn ($ref) => $this->buildReferralTree($ref)),
        ];
    }
}
