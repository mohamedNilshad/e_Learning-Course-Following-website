<?php

namespace App\Http\Controllers\Educator\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseDetail;
use App\Models\DocStore;
use App\Models\ReviewReplay;
use App\Models\VideoStore;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EducatorCreateController extends Controller
{
    public function createNew(Request $request){
        
        try {
           //update course_details table
            $courseDetails = new CourseDetail();
            $courseDetails->educator_id = $request->eduId;
            $courseDetails->topic_id = $request->course_category;
            $courseDetails->courseName = $request->course_title;
            $courseDetails->courseDescription = $request->course_description;
            $courseDetails->coursePrice = $request->course_price;
            $courseDetails->courseViews = 0;
            $courseDetails->publishCourse = 0;
            $courseDetails->deleteCourse = 0;

            $courseDetails->uploadDate = date('Y-m-d');

            //save thumbnile
            $imageThumb = $request->file('course_thumbnile');
            $thumbImageURL = $thumInput['thumbimagename'] = time() . '.' . $imageThumb->getClientOriginalExtension();
            $de = public_path('/images/thumb');
            $imageThumb->move($de, $thumInput['thumbimagename']);
            $thumbURL = 'images/thumb/' . $thumbImageURL;
            // $thumbURL = public_path('storage/images/thumb/'.$thumbImageURL.'');
            // $thumbURL = (public_path("storage/images/thumb/".$thumbImageURL));
            //set thumb on table
            $courseDetails->courseThumbnile = $thumbURL;
            $courseResponse = $courseDetails->save();

        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in Uploading course Details');
        }

        if($courseResponse){
            $videoCourse = $request->file('course_video');
            $videoThumb = $request->file('video_thumb');

            // $videoDetails = new VideoStore();
    
                 try {
                    for ($i=0; $i < count($videoCourse); $i++) { 
                        $videoDetails = new VideoStore();
                        //save video
                        $courseVideoUrl = $videoInput['videoname'] = time() . $i. '.' . $videoCourse[$i]->getClientOriginalExtension();
                        $videoDir = public_path('/video/course');
                        $videoCourse[$i]->move($videoDir, $videoInput['videoname']);
                        $videoURL = 'video/course/' . $courseVideoUrl;

                        //save video thumb
                        $VideoThumbUrl = $videoThumbInput['vdothumbname'] = time() . $i+$i. '.' . $videoThumb[$i]->getClientOriginalExtension();
                        $videoThumbDir = public_path('/images/videoThumb');
                        $videoThumb[$i]->move($videoThumbDir, $videoThumbInput['vdothumbname']);
                        $videoThumbURL = 'images/videoThumb/' . $VideoThumbUrl;

                        //save video table
                        $videoDetails->course_id = $courseDetails->id;
                        $videoDetails->video_url = $videoURL;
                        $videoDetails->video_thumb_url = $videoThumbURL;
                        $videoDetails->video_title = $request->video_title[$i];
                        $videoDetails->video_description = $request->video_description[$i];
                        $videoDetails->video_order = $i+1;
                        $videoResponse = $videoDetails->save();

                        //doccument update
                        $doc = $request->file('video_document'.$i);
                        if($doc && $videoResponse){
                            for ($v=0; $v <count($doc) ; $v++) { 

                                    $docDetails = new DocStore();
                                    
                                    //save documents
                                    $videoDocUrl = $docInput['docname'] = time() . $i.$v. '.' . $doc[$v]->getClientOriginalExtension();
                                    $docDir = public_path('/documents/video');
                                    $doc[$v]->move($docDir, $docInput['docname']);
                                    $docURL = 'documents/video/' . $videoDocUrl;

                                    
                                    $docDetails->course_id = $courseDetails->id;
                                    $docDetails->video_id = $videoDetails->id;
                                    $docDetails->doc_url = $docURL;
                                    $docResponse = $docDetails->save();

                            }
                        }

                    }

                     return redirect('home')->with('success', 'Course Sent To Review');

                    
                   
                 } catch (\Throwable $th) {
                    return back()->with('fail', 'Error in Uploading videos'.$th);

                 }

        }


          
    }

    //add new video
    public function addVideo(Request $request){
        
        
        $videoCourse = $request->file('course_video');
        $videoThumb = $request->file('video_thumb');
      
        // $lastVideo = VideoStore::where('course_id', '=', $request->crsID)->get();
        $lastVideo = VideoStore::where('course_id', $request->crsID)->orderBy('video_order', 'desc')->first();
        $lastOrderID = $lastVideo->video_order;


        $videoDetails = new VideoStore();

             try {
                for ($i=0; $i < count($videoCourse); $i++) { 
                    $videoDetails = new VideoStore();

                    //save video
                    $courseVideoUrl = $videoInput['videoname'] = time() . $i. '.' . $videoCourse[$i]->getClientOriginalExtension();
                    $videoDir = public_path('/video/course');
                    $videoCourse[$i]->move($videoDir, $videoInput['videoname']);
                    $videoURL = 'video/course/' . $courseVideoUrl;

                    //save video thumb
                    $VideoThumbUrl = $videoThumbInput['vdothumbname'] = time() . $i+$i. '.' . $videoThumb[$i]->getClientOriginalExtension();
                    $videoThumbDir = public_path('/images/videoThumb');
                    $videoThumb[$i]->move($videoThumbDir, $videoThumbInput['vdothumbname']);
                    $videoThumbURL = 'images/videoThumb/' . $VideoThumbUrl;

                    //save video table
                    $videoDetails->course_id = $request->crsID;
                    $videoDetails->video_url = $videoURL;
                    $videoDetails->video_thumb_url = $videoThumbURL;
                    $videoDetails->video_title = $request->video_title[$i];
                    $videoDetails->video_description = $request->video_description[$i];
                    $videoDetails->video_order = ++$lastOrderID;//$i+1;
                    $videoResponse = $videoDetails->save();


                    //doccument update
                    $doc = $request->file('video_document'.$i);


                    if($doc && $videoResponse){
                        for ($v=0; $v <count($doc) ; $v++) { 

                                $docDetails = new DocStore();
                                
                                //save documents
                                $videoDocUrl = $docInput['docname'] = time() . $i.$v. '.' . $doc[$v]->getClientOriginalExtension();
                                $docDir = public_path('/documents/video');
                                $doc[$v]->move($docDir, $docInput['docname']);
                                $docURL = 'documents/video/' . $videoDocUrl;

                                $docDetails->video_id = $videoDetails->id;
                                $docDetails->doc_url = $docURL;
                                $docResponse = $docDetails->save();
                                if($i == 1){
                                    dd($docResponse);

                                }


                        }
                    }

                }
                 return back()->with('success', 'Course Sent To Review');
               
             } catch (\Throwable $th) {
                return back()->with('fail', 'Error in Uploading videos'.$th);

             }
    }

    public function replayReview(Request $request){
        try {
            $replaytbl = new ReviewReplay();

            $replaytbl->review_id = $request->rID;
            $replaytbl->educator_id  = $request->eduID;
            $replaytbl->replay = $request->replay;
            $replaytbl->likes = 0;
            $replaytbl->save();

            return back()->with('success', 'Successfuly replaied');


        } catch (\Throwable $th) {
            return back()->with('fail', 'Error in posting replay');
        }
       
      
    } 
}
