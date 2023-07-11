<?php

namespace App\Http\Controllers\Learner;

use App\Http\Controllers\Controller;
use App\Models\UserProfile;
use Illuminate\Http\Request;

class UserProfileController extends Controller
{
    public function addProfileImage(Request $request)
    {
        $user = UserProfile::where('id', '=', $request->id)->first();

        if ($request->file('profileImage') != '') {
            $image = $request->file('profileImage');
            $imageURL = $input['profileimagename'] = time() . '.' . $image->getClientOriginalExtension();
            $dpath = public_path('/images/profile/learner');

            if (($dpath . '/' . $imageURL) != $user->imageURL) {
                $image->move($dpath, $input['profileimagename']);
                $profileURL = 'images/profile/learner' . $imageURL;

                try {
                    UserProfile::where('id', $request->id)->update([
                        'imageURL' => $profileURL,
                    ]);
                } catch (\Throwable $th) {
                    return ('Error in Updating data'.$th);
                }
            }
        }
        return ('uploaded');
    }
}