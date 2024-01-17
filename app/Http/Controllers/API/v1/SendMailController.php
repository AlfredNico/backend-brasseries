<?php

namespace App\Http\Controllers\API\v1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\SampleMail;
use App\Http\Responses\ApiSuccessResponse;
use App\Http\Responses\ApiErrorResponse;
use Illuminate\Http\Response;

class SendMailController extends Controller
{
    public function index()
    {
        //
        try {
            $content = [
                'subject' => 'This is the mail subject',
                'body' => 'This is the email body of how to send email from laravel 10 with mailtrap.'
            ];

            Mail::to('alfrednicotsu@gmail.com')->send(new SampleMail($content));
            // Mail::to('alfred.andrianjatovo@camtrack.mg')->send(new Contact($request->except('_token')));

            return new ApiSuccessResponse(
                null,
                Response::HTTP_OK,
                "Email has been sent.",
                true
            );
            // return view('emails.reset-pass', ['content' => $content]);
        } catch (\Throwable $th) {
            return new ApiErrorResponse($th);
        }
    }

    public function testBody()
    {
        $content = [
            'subject' => 'This is the mail subject',
            'body' => 'This is the email body of how to send email from laravel 10 with mailtrap.'
        ];
        return view('emails.reset-pass', ['content' => $content]);
    }
}
