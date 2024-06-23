<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Subject;
use App\Models\Exam;

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
                'time' => $request->time
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
    //edit
    public function updateExam(Request $request)
    {
        try {
            $exam = Exam::find($request->exam_id);
            $exam -> exam_name = $request->exam_name;
            $exam -> subject_id = $request->subject_id;
            $exam -> date = $request->date;
            $exam -> time = $request->time;
            $exam->save();

            return response()->json(['success' => true, 'msg' => 'Exam update successfully!']);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'msg' => $e->getMessage()]);
        }
    }

    //delete
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



}