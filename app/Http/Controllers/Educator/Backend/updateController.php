<?php

namespace App\Http\Controllers\Educator\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\DocStore;
use App\Models\Educator;
use App\Models\NotifyEdu;
use App\Models\VideoStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class updateController extends Controller
{
    
    //profile update
    public function updateProfile(Request $request)
    {
        $profileURL = '';
        $coverURL = '';
        $educator = Educator::where('id', '=', $request->id)->first();

        $request->validate([
            'name' => 'required|string',
        ]);

        if (($educator->educatorEmail) != ($request->email)) {
            $request->validate([
                'email' => 'email|unique:educators,educatorEmail',
            ]);
        }

        if ($request->file('profile') != '') {
            $image = $request->file('profile');
            $imageURL = $input['profileimagename'] = time() . '.' . $image->getClientOriginalExtension();
            $dpath = public_path('/images/profile');

            // if(($dpath.'/'.$imageURL)!=$educator->educatorProfileImage){
            $image->move($dpath, $input['profileimagename']);
            $profileURL = 'images/profile/' . $imageURL;
            // }
        } else {
            $profileURL = $educator->educatorProfileImage;
        }

        if ($request->file('cover') != '') {
            $imageCover = $request->file('cover');
            $coverImageURL = $coverInput['coverimagename'] = time() . '.' . $imageCover->getClientOriginalExtension();
            $de = public_path('/images/cover');
            $imageCover->move($de, $coverInput['coverimagename']);
            $coverURL = 'images/cover/' . $coverImageURL;

        } else {
            $coverURL = $educator->educatorCoverImage;
        }

        if ($request->password == '') {
            $newPass = $educator->educatorPassword;
        } else {
            $newPass = Hash::make($request->password);
        }

        try {
            Educator::where('id', $request->id)->update([
                'educatorName' => $request->name,
                'educatorEmail' => $request->email,
                'educatorPassword' => $newPass,
                'educatorBio' => $request->bio,
                'educatorProfileImage' => $profileURL,
                'educatorCoverImage' => $coverURL,
                'blockEducator' => $educator->blockEducator,
                'resetCode' => 0,
                'created_at' => $educator->created_at,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data'.$th);
        }

        return redirect('profile')->with('success', 'Updated');

    }
    public function updatePassword(Request $request){
        try {
            $newPass = Hash::make($request->password);
            Educator::where('id', $request->eID)->update([
                'educatorPassword' => $newPass,
                'resetCode' => 0,
            ]);
        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Changing Password'.$th);
        }
        return redirect('login')->with('success', 'Password Changed');
        // return view('Educator.Auth.login');

    }
    

    public function updateCourse(Request $request){
        $course = CourseDetail::where('id', '=', $request->crsId)->first();
        try {
            $educatorID = $course->educator_id;
            $cTopic = $request->course_category;
            $cTitle = $request->course_title;
            $cDescription = $request->course_description;
            $cPrice = $request->course_price;
            $cViews = $course->courseViews;
            $cDelete = $course->deleteCourse;
            $cUploadDate = $course->uploadDate;
            $cThumb = $request->file('course_thumbnile');

            if(($cThumb =='')){
                $thumbURL = $course->courseThumbnile;
            }else{
                // $thumbURL = 'Newfile';
                //save thumbnile
                $imageThumb = $cThumb;
                $thumbImageURL = $thumInput['thumbimagename'] = time() . '.' . $imageThumb->getClientOriginalExtension();
                $de = public_path('/images/thumb');
                $imageThumb->move($de, $thumInput['thumbimagename']);
                $thumbURL = 'images/thumb/' . $thumbImageURL;

                // File::delete($cThumb);
            }

            $cData = [
                'educator_id' =>$educatorID,
                'topic_id' =>$cTopic,
                'courseName' =>$cTitle ,
                'courseDescription' => $cDescription,
                'coursePrice'=> $cPrice,
                'courseThumbnile' => $thumbURL,
                'courseViews' => $cViews,
                'publishCourse' => 1,
                'uploadDate' => $cUploadDate
            ];
       
            $courseDetUpdate = CourseDetail::where('id', $request->crsId)->update($cData);


        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data');
        }

        return back()->with('success', 'Updated');
     
    }

    public function updateVideo(Request $request){
        $totalVideo = VideoStore::where('id', '=', $request->vID[0])->first();
        $video = $request->file('course_video');
        $vTitle = $request->video_title;
        $video_thumb = $request->file('video_thumb');
        $vDescription = $request->video_description;

        if($video){
            $randomId = rand(2,50);
           //save video
           $courseVideoUrl = $videoInput['videoname'] = time() . $randomId. '.' . $video[0]->getClientOriginalExtension();
           $videoDir = public_path('/video/course');
           $video[0]->move($videoDir, $videoInput['videoname']);
           $videoURL = 'video/course/' . $courseVideoUrl;

        if(\File::exists(public_path($totalVideo->video_url))){
            \File::delete(public_path($totalVideo->video_url));
            // dd('File exists.');
        }
        
        }else{
            $videoURL = $totalVideo->video_url;
        }

        //video thumbnile upload
        if($video_thumb){
            $randomtId       =   rand(2,50);
             //save video thumb
             $VideoThumbUrl = $videoThumbInput['vdothumbname'] = time() . $randomtId. '.' . $video_thumb[0]->getClientOriginalExtension();
             $videoThumbDir = public_path('/images/videoThumb');
             $video_thumb[0]->move($videoThumbDir, $videoThumbInput['vdothumbname']);
             $videoThumbURL = 'images/videoThumb/' . $VideoThumbUrl;

             if(\File::exists(public_path($totalVideo->video_thumb_url))){
                \File::delete(public_path($totalVideo->video_thumb_url));
                // dd('File exists.');
            }

        }else{
            $videoThumbURL = $totalVideo->video_thumb_url;
        }


       try {
            $videoData = [
                'course_id' => $totalVideo->course_id,
                'video_url' => $videoURL,
                'video_title' => $vTitle[0],
                'video_thumb_url' => $videoThumbURL,
                'video_description' => $vDescription[0],
                'video_order' => $totalVideo->video_order,
                'created_at' =>$totalVideo->created_at
            ];

            $videoResponse = VideoStore::where('id', $request->vID)->update($videoData);


            $video_document = $request->file('video_document0');
            //upload document
            if($video_document){

                for ($i=0; $i < count($video_document); $i++) { 
                    $docDetails = new DocStore();

                    $randomdId = rand(2,50);

                    // save documents
                    $videoDocUrl = $docInput['docname'] = time() .$randomdId. '.' . $video_document[$i]->getClientOriginalExtension();
                    
                    $docDir = public_path('/documents/video');
                    $video_document[$i]->move($docDir, $docInput['docname']);
                    $docURL = 'documents/video/' . $videoDocUrl;

                    $docDetails->video_id = $request->vID[0];
                    $docDetails->course_id = $totalVideo->course_id;
                    $docDetails->doc_url = $docURL;
                    $docResponse = $docDetails->save();


                }
            }

       } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Updating data'.$th);
       }
       
       return back()->with('success', 'Updated');

    }

    // public function readStatus(Request $request){
    //     $noti = NotifyEdu::where('id', $request->nid)->update([
    //         'isRead' => 1,
    //     ]);
    //     if(!$noti){
    //         return back();//->with('fail', 'Error in Updating Status');
    //     }
    //     return back();
    // }
}
