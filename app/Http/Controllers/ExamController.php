<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\QnaExam;

class ExamController extends Controller
{
    public function loadExamDashboard($id){
        //lấy dữ liệu từ id của bảng enterance , lấy qna qua getQnaExam 
        $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->get();
        //sau khi ây, ktra xem co du lieu ket qua k 
        if(count($qnaExam) > 0){
            // ngay ki thi trùng ngày htai roi ktra xem co bai thi nao khong 
            if($qnaExam[0]['date'] == date('Y-m-d')){
                if(count($qnaExam[0]['getQnaExam']) > 0){

                    $qna = QnaExam::where('exam_id', $qnaExam[0]['id'])->with('question','answers')->inRandomOrder()->get();
                    return view('student.exam-dashboard', ['success' =>true,'exam'=>$qnaExam,'qna'=>$qna ]);

                }else{
                    return view('student.exam-dashboard', ['success' =>false,'msg'=>'Bai ktra nay khong co sẵn ','exam'=>$qnaExam ]);
                    
                }
            }
            else if ($qnaExam[0]['date'] > date('Y-m-d')){
                return view('student.exam-dashboard', ['success' =>false,'msg'=>'Bai ktra nay se bat dau vao '.$qnaExam[0]['date'],'exam'=>$qnaExam ]);
            }
            else{
                return view('student.exam-dashboard', ['success' =>false,'msg'=>'Bai ktra nay da het han  '.$qnaExam[0]['date'],'exam'=>$qnaExam ]);
                
            }

            
        }else{
            return view('404');
        }
    }
}