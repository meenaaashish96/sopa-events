<?php

namespace App\Http\Controllers;
use App\Models\Event as ModelsEvent;
use App\Models\Venues;
use App\Models\SopnserInquiry;
use Illuminate\Http\Request;

class BecomeSopnserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        return view('becomesopnser')->with(compact('event', 'venue'));
        // ->with(compact('aboutus', 'whoshouldattend'));
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
        $event = ModelsEvent::where("status", "1")->first();
        $venue = Venues::where("status", "1")->where('event_id', $event->id)->first();
        $validated = $request->validate([
            'name' => 'required',
            'email'=> 'required|email',
            'mobile'=> 'required',
            'subject'=> 'required',
            'message'=> 'required',
        ]);

        $dataArray = array(
            "name" => $request->name,
            "email" => $request->email,
            "mobile" => $request->mobile,
            "subject" => $request->subject,
            "message" => $request->message,
            "status" => '1',
        );
        $status = SopnserInquiry::create($dataArray);
        $to = env('ADMINEMAIL');
        $subject = $request->subject;
        $from = $request->email;
        $name = $request->name;
        $mobile = $request->mobile;
        $message_text = $request->message;
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=utf-8\n' . "\r\n";
         
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
            'Reply-To: '.$from."\r\n" .
            'X-Mailer: PHP/' . phpversion();
        /* Start mail template */
        $message = '';
        $message .= '<html><head></head><body>';
        $message .= '<style>
            table.center {
            margin-left: auto;
            margin-right: auto;
            }
            img{
            max-width: 100%;
            }
        </style>';
              $message .= "<table class='center' style='width: 1000px;font-family:'Roboto', sans-serif;background-color: #c1b8ce26;'>";
                 $message .= '<tr>';
                 $message .= '<td style="background-color: #25223b;padding: 30px 30px;">
                 <a target="_blank" href="http://event.sopa.org">';
                    $message .= '<img src="http://event.sopa.org/ui/images/logo-white.png" style="margin: 0 auto;display: flex;width: 200px;">';
                           $message .= '</a>';                  
                     $message .= '</td>';
                   
                 $message .= '</tr>';
                 $message .= '<tr>';
                    $message .= '<td>';
                       
                       $message .= '<h4 style="text-align: center;font-size: 22px;
                       color: #25223b;">';
                          $message .= 'CONTACT DETAILS';
                       $message .= '</h4>';
                    $message .= '</td>';
                 $message .= '</tr>';
                 $message .= '<tr>';
                    $message .= '<td>';
                       $message .= '<table align="center">';
                           if(!empty($name)){
                              $message .= '<tr>
                                 <td style="padding-bottom: 15px;"><b>Name</b></td>
                                 <td style="padding-bottom: 15px;">'.$name.'</td>
                              </tr>';
                           }
                           if(!empty($mobile)){
                              $message .= '<tr>
                                 <td style="padding-bottom: 15px;"><b>Mobile</b></td>
                                 <td style="padding-bottom: 15px;">'.$mobile.'</td>
                              </tr>';
                           }
                           if(!empty($subject)){
                              $message .= '<tr>
                                 <td style="padding-bottom: 15px;">
                                    <b>Subject</b>
                                 </td>
                                 <td style="padding-bottom: 15px;">'.$subject.'</td>
                              </tr>';
                           }
                           if(!empty($email)){
                              $message .= '<tr>
                                 <td style="padding-bottom: 15px;">
                                    <b>Email</b>
                                 </td>
                                 <td style="padding-bottom: 15px;">
                                 '.$email.'
                                 </td>
                              </tr>';
                           }
                           if(!empty($message_text)){
                              $message .= '<tr>
                                 <td style="padding-bottom: 15px;">
                                    <b>message</b>
                                 </td>
                                 <td style="padding-bottom: 15px;">
                              '.$message_text.'
                                 </td>
                              </tr>';
                           }
                
                       $message .= '</table>';
                    $message .= '</td>';
                 $message .= '</tr>';
                 $message .= '<tr>
                    <td style="background-color: #F8C400;padding: 30px 30px;">
                      <h4 style="text-align: center;color:#25223b;">Copyright © 2022 International Soya Conclave. All Rights Reserved.</h4>
                    </td>
                   
                 </tr>';
              $message .= '</table>';
           $message .= '</body>';
        $message .= '</html>';

        /* End */                           
        // Sending email
        mail($to, $subject, $message, $headers);

    

        // mail($request->email,"Interested In Sponsorship", $html, $headers2);

        if($status){
            return view('thankyousponssor')->with(compact('event', 'venue'));
            // return  redirect('sopa/admin/advertisement')->with('status', 'Advertisement has been created.');
            // return  redirect('/become-sponsor')->with('status', 'Become Sponsor  created.');
        }else{
            
            return  redirect('/become-sponsor')->with('status', 'Become Sponsor not created.');
        }
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
