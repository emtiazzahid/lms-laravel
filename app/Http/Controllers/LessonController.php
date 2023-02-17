<?php

namespace App\Http\Controllers;

use App\Models\Question;
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
        $lesson_files = DB::table('lesson_files')->where('lesson_id',$id)->where('teacher_id',$teacher_lesson->teacher_id)->get();
        $data = [
            'teacher_lesson' => $teacher_lesson,
            'lesson_id' => $id,
            'lesson_videos' => $lesson_videos,
            'lesson_files' => $lesson_files,
            'teacher_info' => $teacher_info
        ];
        
        return view('admin.lessons.lesson_details',$data);
    }

    public function getLessonDetailsForEdit($id)
    {
        $teacher_id = Auth::user()->id;
        $teacher_info = DB::table('users')->where('id',$teacher_id)->first();
        $teacher_lesson = DB::table('teacher_course_lessons')->where('id',$id)->first();
        if (!$teacher_lesson){
            Session::flash('Error Message', 'Lesson Data Not Found.');
            return redirect()->back();
        }$lesson_videos = DB::table('lesson_videos')->where('lesson_id',$id)->where('teacher_id',$teacher_id)->get();
        $lesson_documents = DB::table('lesson_files')->where('lesson_id',$id)->where('teacher_id',$teacher_id)->get();
        $data = [
            'teacher_lesson' => $teacher_lesson,
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
            'part_number'      => 'VIDEO - '.$request->part_number,
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
    
    public function lessonVideoDelete($id){
        DB::table('lesson_videos')->where('id',$id)->delete();

        Session::flash('Success Message', 'Video deleted successfully.');
        return redirect()->back();
    }

    public function postLessonsFileInfoSave(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'file_title'      => 'required',
            'file_url'     => 'required',
        ]);

        $dataForLessonVideo = [
            'lesson_id' => $request->lesson_id,
            'teacher_id' => Auth::user()->id,
            'part_number'      => 'FILE - '.$request->part_number,
            'file_title'      => $request->file_title,
            'file_url'     => $request->file_url,
            'description'     => $request->description,
        ];
        DB::table('lesson_files')->insert($dataForLessonVideo);

        Session::flash('Success Message', 'Document file attached to the lesson');
        return redirect()->route('getLessonDetailsForEdit',['id'=>$request->lesson_id]);
    }

    public function postLessonsFileInfoUpdate(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'file_title'      => 'required',
            'file_url'     => 'required',
        ]);

        $dataForLessonVideo = [
            'part_number'      => $request->part_number,
            'file_title'      => $request->file_title,
            'file_url'     => $request->file_url,
            'description'     => $request->description,
        ];
        DB::table('lesson_files')->where('id',$request->modal_id)->update($dataForLessonVideo);

        Session::flash('Success Message', 'Document file info updated for the lesson');
        return redirect()->route('getLessonDetailsForEdit',['id'=>$request->lesson_id]);
    }
    
    public function lessonFileDelete($id){
        DB::table('lesson_files')->where('id',$id)->delete();

        Session::flash('Success Message', 'File deleted successfully.');
        return redirect()->back();
    }

    public function getLessonQuestions($id)
    {
        
        $teacher_id = Auth::user()->id;
        $teacher_lesson = DB::table('teacher_course_lessons')->where('id',$id)->first();
        if (!$teacher_lesson){
            Session::flash('Error Message', 'Lesson Data Not Found.');
            return redirect()->back();
        }
        $questions = DB::table('teacher_course_lessons')
                                ->join('questions','teacher_course_lessons.id','questions.lesson_id')
                                ->where('questions.lesson_id',$id)
                                ->where('teacher_course_lessons.teacher_id',$teacher_id)
                                ->get();
        $lesson_file_part_numbers = DB::table('lesson_files')
                                ->where('lesson_files.lesson_id',$id)
                                ->select('part_number')
                                ->get();
        $lesson_video_part_numbers = DB::table('lesson_videos')
                                ->where('lesson_videos.lesson_id',$id)
                                ->select('part_number')
                                ->get();
        $part_numbers = [];
        if(count($lesson_file_part_numbers)>0){
            foreach ($lesson_file_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }
        if(count($lesson_video_part_numbers)>0){
            foreach ($lesson_video_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }
        
        $data = [
            'questions' => $questions,
            'teacher_lesson' => $teacher_lesson,
            'lesson_id' => $id,
            'part_numbers' => $part_numbers,
        ];
        return view('teacher.written_question.written_question_list',$data);
    }

    public function addNewQuestion(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'question'      => 'required',
            'default_mark'     => 'required',
        ]);

        $data = [
            'lesson_id'      => $request->lesson_id,
            'part_number'      => $request->part_number,
            'question'      => $request->question,
            'default_mark'     => $request->default_mark,
            'description'     => $request->description,
        ];
        DB::table('questions')->insert($data);

        Session::flash('Success Message', 'Question Added');
        return redirect()->route('lesson-questions',['id'=>$request->lesson_id]);
    }

    public function updateQuestion(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'question'      => 'required',
            'default_mark'     => 'required',
        ]);

        $data = [
            'part_number'      => $request->part_number,
            'question'      => $request->question,
            'default_mark'     => $request->default_mark,
            'description'     => $request->description,
        ];
        DB::table('questions')->where('id',$request->modal_id)->update($data);

        Session::flash('Success Message', 'Question Updated');
        return redirect()->route('lesson-questions',['id'=>$request->lesson_id]);
    }
    
    public function deleteQuestion($id){
        DB::table('questions')->where('id',$id)->delete();
        Session::flash('Success Message', 'Question deleted successfully.');
        return redirect()->back();
    }

    public function getLessonMcqs($id)
    {
        $teacher_id = Auth::user()->id;
        $teacher_lesson = DB::table('teacher_course_lessons')->where('id',$id)->first();
        if (!$teacher_lesson){
            Session::flash('Error Message', 'Lesson Data Not Found.');
            return redirect()->back();
        }
        $mcqs = DB::table('teacher_course_lessons')
            ->join('mcqs','teacher_course_lessons.id','mcqs.lesson_id')
            ->where('mcqs.lesson_id',$id)
            ->where('teacher_course_lessons.teacher_id',$teacher_id)
            ->get();
        $lesson_file_part_numbers = DB::table('lesson_files')
            ->where('lesson_files.lesson_id',$id)
            ->select('part_number')
            ->get();
        $lesson_video_part_numbers = DB::table('lesson_videos')
            ->where('lesson_videos.lesson_id',$id)
            ->select('part_number')
            ->get();
        $part_numbers = [];
        if(count($lesson_file_part_numbers)>0){
            foreach ($lesson_file_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }
        if(count($lesson_video_part_numbers)>0){
            foreach ($lesson_video_part_numbers as $data){
                array_push($part_numbers,$data->part_number);
            }
        }

        $data = [
            'mcqs' => $mcqs,
            'teacher_lesson' => $teacher_lesson,
            'lesson_id' => $id,
            'part_numbers' => $part_numbers,
        ];
        return view('teacher.mcq.mcq_list',$data);
    }
    
    public function addNewMcq(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'question'      => 'required',
            'option_1'      => 'required',
            'option_2'      => 'required',
            'right_answer'      => 'required',
            'default_mark'     => 'required',
        ]);

        $data = [
            'lesson_id'      => $request->lesson_id,
            'part_number'      => $request->part_number,
            'question'      => $request->question,
            'option_1'      => $request->option_1,
            'option_2'      => $request->option_2,
            'option_3'      => $request->option_3,
            'option_4'      => $request->option_4,
            'right_answer'      => $request->right_answer,
            'default_mark'     => $request->default_mark,
            'description'     => $request->description,
        ];
        DB::table('mcqs')->insert($data);

        Session::flash('Success Message', 'Mcq Added');
        return redirect()->route('lesson-mcqs',['id'=>$request->lesson_id]);
    }
    
    public function updateMcq(Request $request)
    {
        $this->validate($request,[
            'part_number'      => 'required',
            'question'      => 'required',
            'option_1'      => 'required',
            'option_2'      => 'required',
            'right_answer'      => 'required',
            'default_mark'     => 'required',
        ]);

        $data = [
            'part_number'      => $request->part_number,
            'question'      => $request->question,
            'option_1'      => $request->option_1,
            'option_2'      => $request->option_2,
            'option_3'      => $request->option_3,
            'option_4'      => $request->option_4,
            'right_answer'      => $request->right_answer,
            'default_mark'     => $request->default_mark,
            'description'     => $request->description,
        ];
        DB::table('mcqs')->where('id',$request->modal_id)->update($data);

        Session::flash('Success Message', 'Mcq Updated');
        return redirect()->route('lesson-mcqs',['id'=>$request->lesson_id]);
    }
    
    public function deleteMcq($id){
        DB::table('mcqs')->where('id',$id)->delete();
        Session::flash('Success Message', 'Mcq deleted successfully.');
        return redirect()->back();
    }




}
