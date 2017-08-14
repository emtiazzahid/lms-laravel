<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use DB;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{
    public function getLessonDetails($id)
    {
        $teacher_lesson = DB::table('teacher_course_lessons')->where('id',$id)->first();
        if (!$teacher_lesson){
            Session::flash('Error Message', 'Lesson Data Not Found.');
            return redirect()->back();
        }
        $teacher_info = DB::table('users')->where('id',$teacher_lesson->teacher_id)->first();
        $lesson_videos = DB::table('lesson_videos')->where('lesson_id',$id)->where('teacher_id',$teacher_lesson->teacher_id)->get();
        $data = [
            'teacher_lesson' => $teacher_lesson,
            'lesson_id' => $id,
            'lesson_videos' => $lesson_videos,
            'teacher_info' => $teacher_info
        ];
        
        return view('admin.lessons.lesson_details',$data);
    }

    public function getLessonDetailsForEdit($id)
    {
        $teacher_id = Auth::user()->id;
        $teacher_info = DB::table('users')->where('id',$teacher_id)->first();
        $lessons = DB::table('teacher_course_lessons')->where('id',$id)->where('teacher_id',$teacher_id)->get();
        $lesson_videos = DB::table('lesson_videos')->where('lesson_id',$id)->where('teacher_id',$teacher_id)->get();
        $lesson_documents = DB::table('lesson_files')->where('lesson_id',$id)->where('teacher_id',$teacher_id)->get();
        $data = [
            'lessons' => $lessons,
            'lesson_id' => $id,
            'videos' => $lesson_videos,
            'teacher_info' => $teacher_info,
            'files' => $lesson_documents
        ];
        return view('admin.lessons.lesson_details_edit',$data);
    }
    public function postLessonsVideoInfoSave(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'video_title'      => 'required',
            'video_embed_url'     => 'required',
        ]);

        $dataForLessonVideo = [
            'lesson_id' => $request->lesson_id,
            'teacher_id' => Auth::user()->id,
            'part_number'      => $request->part_number,
            'video_title'      => $request->video_title,
            'video_embed_url'     => $request->video_embed_url,
            'description'     => $request->description,
        ];
        DB::table('lesson_videos')->insert($dataForLessonVideo);

        Session::flash('Success Message', 'Video file attached to the lesson');
        return redirect()->route('getLessonDetailsForEdit',['id'=>$request->lesson_id]);
    }

    public function postLessonsVideoInfoUpdate(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'video_title'      => 'required',
            'video_embed_url'     => 'required',
        ]);

        $dataForLessonVideo = [
            'part_number'      => $request->part_number,
            'video_title'      => $request->video_title,
            'video_embed_url'     => $request->video_embed_url,
            'description'     => $request->description,
        ];
        DB::table('lesson_videos')->where('id',$request->modal_id)->update($dataForLessonVideo);

        Session::flash('Success Message', 'Video file info updated for the lesson');
        return redirect()->route('getLessonDetailsForEdit',['id'=>$request->lesson_id]);
    }
    //    Delete Video
    public function lessonVideoDelete($id){
        DB::table('lesson_videos')->where('id',$id)->delete();

        Session::flash('Success Message', 'Video deleted successfully.');
        return redirect()->back();
    }
}
