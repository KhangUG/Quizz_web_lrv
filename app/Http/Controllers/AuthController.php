<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exam;
use App\Models\Subject;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\PasswordReset; // Đảm bảo rằng model này đúng với tên của bảng reset password
use Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Carbon;

class AuthController extends Controller
{
    public function loadRegister()
    {
        if (Auth::user() && Auth::user()->is_admin == 1) {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }
        return view('register');
    }

    public function studentRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:2',
            'email' => 'required|string|email|max:100|unique:users',
            'password' => 'required|string|confirmed|min:6'
        ]);

        $user = new User;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->save();

        return back()->with('success', 'Registration successful');
    }

    public function loadLogin()
    {
        if (Auth::user() && Auth::user()->is_admin == 1) {
            return redirect('/admin/dashboard');
        } else if (Auth::user() && Auth::user()->is_admin == 0) {
            return redirect('/dashboard');
        }
        return view('login');
    }

    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);

        $userCredentials = $request->only('email', 'password');

        if (Auth::attempt($userCredentials)) {
            if (Auth::user()->is_admin == 1) {
                return redirect('/admin/dashboard');
            } else {
                return redirect('/dashboard');
            }
        } else {
            return back()->with('error', 'Username & Password is incorrect');
        }
    }

    //Hien thi tra ve view cuar sinh vien 
    public function loadDashboard()
    {
        $exams =Exam::with('subjects')->orderBy('date')->get();
        // die($exams);
        return view('student.dashboard', ['exams' => $exams]);
    }

    public function adminDashboard()
    {
        $subjects = Subject::all();
        return view('admin.dashboard', compact('subjects'));
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        Auth::logout();
        return redirect('/');
    }

    public function forgetPasswordLoad()
    {
        return view('forget-password'); 
    }

    public function forgetPassword(Request $request)
    {
        try {
            \Log::info('forgetPassword method called');
            
            // Validate the email input
            $request->validate(['email' => 'required|email']);
            \Log::info('Email validated: ' . $request->email);

            // Find the user by email
            $user = User::where('email', $request->email)->first();
            \Log::info('User found: ' . ($user ? 'Yes' : 'No'));

            if ($user) {
                // Generate a random token
                $token = Str::random(40);
                $domain = URL::to('/');
                $url = $domain . '/reset-password?token=' . $token;

                // Prepare data for the email
                $data = [
                    'url' => $url,
                    'email' => $request->email,
                    'title' => 'Password Reset',
                    'body' => 'Please click on the link below to reset your password.'
                ];

                \Log::info('Password reset data: ', $data);

                // Check if data array is correctly formed
                if (!isset($data['url']) || !isset($data['email']) || !isset($data['title']) || !isset($data['body'])) {
                    throw new \Exception('Missing data for the email');
                }

                // Log the email data before sending
                \Log::info('Sending email with data: ', $data);

                // Send the reset password email
                Mail::send('forgetPasswordMail', ['data' => $data], function ($message) use ($data) {
                    $message->to($data['email'])->subject($data['title']);
                });
                \Log::info('Reset password email sent to: ' . $data['email']);

                // Record the token and email in the password_reset table
                $dataTime = Carbon::now()->format('Y-m-d H:i:s');

                PasswordReset::updateOrCreate(
                    ['email' => $request->email],
                    [
                        'email' => $request->email,
                        'token' => $token,
                        'created_at' => $dataTime
                    ]
                );

                \Log::info('Password reset token recorded in database');

                return back()->with('success', 'Please check your email for password reset link.');
            } else {
                \Log::warning('Email does not exist: ' . $request->email);
                return back()->with('error', 'Email does not exist.');
            }
        } catch (\Exception $e) {
            \Log::error('Error in forgetPassword method: ' . $e->getMessage());
            return back()->with('error', 'An error occurred while trying to process your request.');
        }
    }
    public function resetPasswordLoad(Request $request)
    {
        $resetData = Passwordreset::where('token', $request->token)->get();

        if(isset($request->token) && count($resetData) > 0){

            $user = User::where('email', $resetData[0]['email']) -> get();

            return view('resetPassword', compact('user'));

            
        }
        else{
            return view('404');
        }

    }

    public function resetPassword(Request $request)
    {
        // Validate the password input
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ]);

        // Find the user by ID from the request
        $user = User::find($request->id);
        if (!$user) {
            return response()->json(['message' => 'User not found'], 404);
        }

        // Hash and update the user's password
        $user->password = Hash::make($request->password);
        $user->save();

        // Delete the password reset token
        PasswordReset::where('email', $user->email)->delete();

        // Return a success response
        return "<h2>reset mật khẩu thành công </h2>";
    }


}