<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exam;
use App\Models\QnaExam;
use App\Models\ExamAttempt;
use App\Models\ExamAnswer;

use Illuminate\Support\Facades\Auth;


class ExamController extends Controller
{
    public function loadExamDashboard($id){
        //lấy dữ liệu từ id của bảng enterance , lấy qna qua getQnaExam 
        $qnaExam = Exam::where('enterance_id', $id)->with('getQnaExam')->get();
        //sau khi ây, ktra xem co du lieu ket qua k 
        if(count($qnaExam) > 0){
            $attempCount = ExamAttempt::where(['exam_id'=> $qnaExam[0]['id'] , 'user_id'=>auth()->user()->id])->count();

            if($attempCount >= $qnaExam[0]['attempt']){
                return view('student.exam-dashboard', ['success' =>false,'msg'=>'Your exam attemption has been complated','exam'=>$qnaExam ]);

            }
            // ngay ki thi trùng ngày htai roi ktra xem co bai thi nao khong 
            else if($qnaExam[0]['date'] == date('Y-m-d')){
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

    public function examSubmit( Request $request){
        // Tạo một bản ghi trong bảng ExamAttempt và lấy ID của nó
        $attempt_id = ExamAttempt::insertGetId([
            'exam_id' => $request->exam_id,
            'user_id' => Auth::user()->id,
        ]);


        // Đếm số lượng câu hỏi đã được trả lời
        $qcount = count($request->q);

        if ($qcount > 0) {
            for ($i = 0; $i < $qcount; $i++) {
                // Lấy giá trị answer_id
                $answer_id = $request->input('ans_' . ($i + 1));

                // Kiểm tra nếu answer_id không phải là NULL thì mới chèn vào cơ sở dữ liệu
                if ($answer_id !== null) {
                    ExamAnswer::insert([
                        'attempt_id' => $attempt_id,
                        'question_id' => $request->q[$i],
                        'answer_id' => $answer_id,
                    ]);
                } else {
                    // Xử lý khi answer_id là NULL (nếu cần thiết)
                    // Ví dụ: bạn có thể lưu log hoặc thông báo cho người dùng về việc chưa trả lời câu hỏi
                }
            }
        }
           return view('thank-you');
        }

        public function resultsDashboard(){
            $attempts =  ExamAttempt::where('user_id', Auth()->user()->id)->with('exam')->orderBy('updated_at')->get();
            return view('student.results', compact('attempts'));
        }
}