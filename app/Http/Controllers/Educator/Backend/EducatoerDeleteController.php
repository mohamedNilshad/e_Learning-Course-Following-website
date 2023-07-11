<?php

namespace App\Http\Controllers\Educator\Backend;

use App\Http\Controllers\Controller;
use App\Models\CourseReview;
use App\Models\DocStore;
use App\Models\ReviewReplay;
use App\Models\VideoStore;
use Illuminate\Http\Request;

class EducatoerDeleteController extends Controller
{
    public function deleteReview($id){
        // delete task
        $review=CourseReview::find($id);
        $review->delete();

        if($review){
            return back()->with('success', 'Deleted Successfuly');
        }else{
            return back()->with('fail', 'Error in deleting comment');
        }
        
    }

    public function deleteReplay($id){
        // delete task
        $replay=ReviewReplay::find($id);
        $replay->delete();

        if($replay){
            return back()->with('success', 'Deleted Successfuly');
        }else{
            return back()->with('fail', 'Error in deleting comment');
        }
        
    }

    public function deleteVideo($id){
        // delete task
        $video=VideoStore::find($id);
        $video->delete();

        if($video){
            return back()->with('success', 'Deleted Successfuly');
        }else{
            return back()->with('fail', 'Error in deleting video section');
        }
        
    }

    public function deleteDocument($id){
        // delete task
        $doc=DocStore::find($id);
        $doc->delete();

        if($doc){
            return back()->with('success', 'Deleted Successfuly');
        }else{
            return back()->with('fail', 'Error in deleting document');
        }
        
    }
}
