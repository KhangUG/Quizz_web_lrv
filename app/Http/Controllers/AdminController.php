<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;
use App\Models\Question;
use App\Models\Answer;
use App\Models\User;

use App\Imports\QnaImport;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{   
    //add subject
    public function addSubject(Request $request){
        
    try {
        // Thêm môn học mới vào cơ sở dữ liệu
        Subject::insert([
            'subject' => $request->subject,
        ]);

        // Trả về phản hồi JSON chỉ ra thành công
        return response()->json([
            'success' => true,
            'msg' => 'Thêm môn học thành công!'
        ]);
    } catch (\Exception $e) {
        // Trả về phản hồi JSON chỉ ra thất bại
        return response()->json([
            'success' => false,
            'msg' => $e->getMessage()
        ]);
    }

    }

    //edit subject
    public function editSubject(Request $request)
    {
        try {
            $subject = Subject::find($request->id);
            $subject->subject = $request->subject;
            $subject->save();
            // Trả về phản hồi JSON chỉ ra thành công
            return response()->json([
                'success' => true,
                'msg' => 'Sua môn học thành công!'
            ]);
        } catch (\Exception $e) {
            // Trả về phản hồi JSON chỉ ra thất bại
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    
    }
    //Delete subject
    public function deleteSubject(Request $request)
    {
        try {
            Subject::where('id', $request->id)->delete();
            // Trả về phản hồi JSON chỉ ra thành công
            return response()->json([
                'success' => true,
                'msg' => 'Xoas môn học thành công!'
            ]);
        } catch (\Exception $e) {
            // Trả về phản hồi JSON chỉ ra thất bại
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    
    }

    //Exam dashboard load
    public function examDashboard(){
        $subjects = Subject::all();
        $exams = Exam::with('subjects')->get();
        return view('admin.exam-dashboard',['subjects' => $subjects, 'exams' => $exams]);
    }

    //add exam
    public function addExam(Request $request)
    {
        try {
            Exam::insert([
                'exam_name' => $request->exam_name,
                'subject_id' => $request->subject_id,
                'date' => $request->date,
                'time' => $request->time,
                'attempt' => $request->attempt

            ]);

            return response()->json(['success' => true, 'msg' => 'Exam added successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }


    public function getExamDetail($id)
    {
        try {
            $exam = Exam::where('id', $id)->get();

            return response()->json(['success' => true, 'data' => $exam]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }
    //edit exam
    public function updateExam(Request $request)
    {
        try {
            $exam = Exam::find($request->exam_id);
            $exam -> exam_name = $request->exam_name;
            $exam -> subject_id = $request->subject_id;
            $exam -> date = $request->date;
            $exam -> time = $request->time;
            $exam -> attempt = $request->attempt;
            $exam->save();

            return response()->json(['success' => true, 'msg' => 'Exam update successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //delete exam
    public function deleteExam(Request $request)
    {
        try {
            Exam::where('id', $request->exam_id)->delete();
            
            return response()->json([
                'success' => true,
                'msg' => 'Xoas baithi thành công!'
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    
    }
    

    ///Q&A/////////////////////////////////////////////////////////////
    
    public function qnaDashboard()
    {
        $questions = Question::with('answers')->get();
        return view('admin.qnaDashboard', compact('questions'));
    }

    //add Qna 
    public function addQna(Request $request)
    {
        try {
            $questionId = Question::insertGetId([
                'question' => $request->question

            ]);

            foreach($request->answers as $answer){

                $is_correct = 0;
                if($request->is_correct ==  $answer){
                    $is_correct = 1;
                }

                Answer::insert([
                    'questions_id' => $questionId,
                    'answer' =>$answer,
                    'is_correct' => $is_correct
                ]);
            }

            return response()->json([
                'success' => true,
                'msg' => 'Xoas baithi thành công!'
            ]);
        } catch (\Exception $e) {
            
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    
    }

    public function getQnaDetails(Request $request)
    {
        $qna = Question::where('id', $request->qid)->with('answers')->get();

        return response() -> json(['data' => $qna]);
    }


    public function deleteAns(Request $request)
    {
        Answer::where('id', $request->id)->delete();
        return response()->json(['success'=>true,'msg'=>'Answer delete success!']);
    }

    public function updateQna(Request $request)
    {
        try{
            Question::where('id', $request->question_id)->update([
                'question' => $request->question
            ]);
            
            //cap nhat cau hoi ban dau 
            if (isset($request->answers)) {
                foreach ($request->answers as $key => $value) {
                    $is_correct = 0;
                    if ($request->is_correct == $value) {
                        $is_correct = 1;
                    }
            
                    Answer::where('id', $key)
                        ->update([
                            'questions_id' => $request->question_id,
                            'answer' => $value,
                            'is_correct' => $is_correct
                        ]);
                }
            }  
            
            //new answer added
            if (isset($request->new_answers)) {
                foreach ($request->new_answers as $answer) {
                    $is_correct = 0;
                    if ($request->is_correct == $answer) {
                        $is_correct = 1;
                    }
                    
                    Answer::insert([
                        'questions_id' => $request->question_id,
                        'answer' => $answer,
                        'is_correct' => $is_correct
                    ]);
                    
                }
            }  

            return response()->json(['success' => true, 'msg' => 'Q&A update thanh cong!']);
        
        } catch (\Exception $e) {
                
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        };
    }

    public function deleteQna(Request $request)
    {
        try {
            Question::where('id', $request->id)->delete();
            Answer::where('questions_id', $request->id)->delete();

            return response()->json(['success' => true, 'msg' => 'Q&A delete thành công!']);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }

    // import qna 
    public function importQna(Request $request)
    {
        try{
            Excel::import(new QnaImport, $request->file('file'));
            return response()->json([
                'success' => true,
                'msg' => 'Import Q&A thanh cong'
            ]);

        }catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'msg' => $e->getMessage()
            ]);
        }
    }



    // ========STUDENTS========== //

    public function studentsDashboard()
    {
        $students = User::where('is_admin', 0)->get();
        return view('admin.studentsDashboard', compact('students'));
    }


}