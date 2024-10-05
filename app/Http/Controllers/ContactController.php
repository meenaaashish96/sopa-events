<?php

namespace App\Http\Controllers;

use App\Models\contact;
use App\Models\Event as ModelsEvent;
use App\Models\Venues;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return redirect('/#Contactus');
        // return view('contact');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $validated = $request->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'subject'=> 'required',
            'message'=> 'required',
        ]);
        // dd($request->all());
        $dataArray = array(
            "name" => $request->name,
            "email" => $request->email,
            "subject" => $request->subject,
            "message" => $request->message
        );
        // dd($dataArray);
        $status = contact::create($dataArray);
        $adminEmail = env('ADMINEMAIL');
        $from = $request->email;
        $first_name =  $request->name;
        $subject =  $request->subject;
        $email =  $request->email;
        $message_text =  $request->message;
        // To send HTML mail, the Content-type header must be set
		$headers  = 'MIME-Version: 1.0' . "\r\n";
		$headers .= 'Content-type: text/html; charset=utf-8\n' . "\r\n";
		// $headers .= 'Cc: ' . $cc_email . "\r\n";
		// $headers .= 'Bcc:' . $bcc_email . "\r\n";
		// Create email headers
		$headers .= 'From: ' . $from . "\r\n" .
			'Reply-To: ' . $from . "\r\n" .
			'X-Mailer: PHP/' . phpversion();
		/* Start mail template */
        $message = '';
		$message .= '<html><head></head><body style="">';
		$message .= '<style>
            table.center {
            margin-left: auto;
            margin-right: auto;
            }
            img{
            max-width: 100%;
            }
        </style>';
		$message .= "<table class='center' style='width: 1000px;margin: auto;font-family:'Roboto', sans-serif;background-color: #c1b8ce26;'>";
		$message .= '<tr>';
		$message .= '<td style="background-color: #25223b;padding: 30px 30px;">
                                             <a target="_blank" href="http://event.sopa.org">';
		$message .= '<img src="http://event.sopa.org/ui/images/logo-white.png" style="margin: 0 auto;display: flex;width: 200px;">';
		$message .= '</a>';
		$message .= '</td>';

		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td>';
		$message .= '<h4 style="text-align: center;font-size: 40px;line-height: 0;">';
		$message .= 'Hi,';
		$message .= '</h4>';
		$message .= '<p style="text-align: center;">Please check new request for</p>';
		$message .= '<h4 style="text-align: center;font-size: 22px;
                                             color: #25223b;">';
		$message .= 'CONTACT DETAILS';
		$message .= '</h4>';
		$message .= '</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td>';
		$message .= '<table align="center">';

		$message .= '<tr>
                                                   <td style="padding-bottom: 15px;"><b>Name</b></td>
                                                   <td style="padding-bottom: 15px;">' . $first_name . '</td>
                                                </tr>';
	
		$message .= '<tr>
                                                 <td style="padding-bottom: 15px;">
                                                    <b>Subject</b>
                                                 </td>
                                                 <td style="padding-bottom: 15px;">' . $subject . '</td>
                                              </tr>';
		$message .= '<tr>
                                                 <td style="padding-bottom: 15px;">
                                                    <b>Email</b>
                                                 </td>
                                                 <td style="padding-bottom: 15px;">
                                                  ' . $email . '
                                                 </td>
                                              </tr>';
		$message .= '<tr>
                                                 <td style="padding-bottom: 15px;">
                                                    <b>message</b>
                                                 </td>
                                                 <td style="padding-bottom: 15px;">
                                                ' . $message_text . '
                                                 </td>
                                              </tr>';

		$message .= '</table>';
		$message .= '</td>';
		$message .= '</tr>';
		$message .= '<tr>
                                          <td style="background-color: #F8C400;padding: 30px 30px;">
                                            <h4 style="text-align: center;color:#25223b;">Copyright © 2021 International Soya Conclave. All Rights Reserved.</h4>
                                          </td>
                                         
                                       </tr>';
		$message .= '</table>';
		$message .= '</body>';
		$message .= '</html>';
        mail($adminEmail, 'Contact Information', $message, $headers);
    //     Mail::send('pages.mail.contactmail', [
    //         "data" => $dataArray
    //    ],function($message) use ($request) {
           
    //         $message->from($request->email);
    //         $message->to('info@codesolution.co.in', 'CodeSolution')->subject($request->subject);
           
    //      });
        if($status){
            return view('thankyoucontact')->with(compact('event', 'venue'));
            // return  redirect('sopa/admin/advertisement')->with('status', 'Advertisement has been created.');
            // return  redirect('/become-sponsor')->with('status', 'Become Sponsor  created.');
        }else{
            return redirect('/')->with('status', 'Message sent successfully. Admin will  contact you soon');
            // return  redirect('/become-sponsor')->with('status', 'Become Sponsor not created.');
        }
        
        // return redirect()->back()->with('message', 'Message sent successfully. Admin will  contact you soon');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
