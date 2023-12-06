<?php

namespace App\Services;

use SendGrid;
use SendGrid\Mail\Mail;
use Illuminate\Support\Facades\View;


class EmailService
{
    protected $sendGrid;

    public function __construct()
    {
        $this->sendGrid = new SendGrid(getenv('SENDGRID_API_KEY'));
    }

    public function sendEmail($to, $from, $subject, $data)
    {
        $email = new Mail();
        $email->setFrom($from);
        $email->setSubject($subject);
        $email->addTo($to);

        $content = View::make('TemplateEmail.Template')->with($data)->render();

        $email->addContent("text/html", $content);


        $response = $this->sendGrid->send($email);
        // dd($response);
        return $response;
    }
}
