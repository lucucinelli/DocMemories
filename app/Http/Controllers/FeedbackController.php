<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\FeedbackMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class FeedbackController extends Controller
{
    public function showFeedbacks(){
        return view('feedbacks.feedbacks');
    }

    public function sendFeedback(Request $request){
        $data = $request->validate([
            'feedback_type' => ['required', 'string', 'max:255'],
            'note' => ['required', 'string', 'max:255'],
        ]);
        $user = Auth::id();
        $user = User::find($user);
        Mail::to(['ludocuci04@gmail.com', 'andreacostantini03@gmail.com'])->send(new FeedbackMail($user, $data));
        // Here you can handle the feedback, e.g., save it to the database or send an email
        return redirect()->route('feedback')->with('status', __('feedback-sent'));
    }
}

