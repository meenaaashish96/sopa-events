<?php session_start();
ob_start();
// Start the session
//error_reporting(0);
$get_pay_amt = '2';
$to = 'sopa@sopa.org';
$cc_email = 'accounts@sopa.org';
$bcc_email = '';
?>
<!DOCTYPE html>
<!-- Eventer - Conference, Event and Meetup Landing Page Template design by DSAThemes -->
<!--[if lt IE 7 ]><html class="ie ie6" lang="en"> <![endif]-->
<!--[if IE 7 ]><html class="ie ie7" lang="en"> <![endif]-->
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!-->
<html lang="en">


<script>
   var SITEURL = window.location.origin + '/SoyConclave';
</script>

<?php

include('config.php');
$_SESSION["pay_amount"] = array('0' => '150000', '1' => '100000', '2' => '90000', '3' => '29500', '4' => '17700');
$target_dir = "/images/";
if (!empty($_POST['razorpay_payment_id'])) {

   $update_info = $_SESSION["payment_update_info"];
   $pay_index = $update_info['pay_amt'];
   // if(array_key_exists($pay_index,$_SESSION["pay_amount"])){
   //    $get_pay_amt = $_SESSION["pay_amount"][$pay_index];
   // }
   $get_pay_amt = $pay_index;
   $updateID = $update_info['update_id'];

   $payment_id = (!empty($_POST['razorpay_payment_id']) ? $_POST['razorpay_payment_id'] : '');
   $order_id = (!empty($_POST['razorpay_order_id']) ? $_POST['razorpay_order_id'] : '');
   $pay_signature  = (!empty($_POST['razorpay_signature']) ? $_POST['razorpay_signature'] : '');
   $payment_return_val = (!empty($_POST) ? json_encode($_POST) : '');
   $pay_status = 'Success';
   $updated_at = date('Y-m-d H:i:s');


   $sql_query = "UPDATE soyconclave_advertising_release SET `payment_id` ='$payment_id', `order_id` = '$order_id', `pay_signature` = '$pay_signature', `amt`='$get_pay_amt', `payment_return_val` = '$payment_return_val', `pay_status` = '$pay_status', `updated_at` = '$updated_at'
       WHERE id= $updateID ";
   if ($conn->query($sql_query) === TRUE) {

      $update_id = $_SESSION["last_insert_id"];
      $query = "SELECT * FROM soyconclave_advertising_release WHERE `id` = $updateID LIMIT 1";
      $records = mysqli_query($conn, $query); // 
      $record = mysqli_fetch_array($records);

      // $row_info = mysql_fetch_assoc($result);
      if (!empty($record)) {
         $subject = 'ADVERTISEMENT RELEASE PAYMENT';
         $user_from = $to;

         $from = (!empty($record['user_email']) ? $record['user_email'] : '');
         $user_to = $from;
         $user_name = (!empty($record['user_name']) ? $record['user_name'] : '');
         $company_name = (!empty($record['company_name']) ? $record['company_name'] : '');
         $user_email = (!empty($record['user_email']) ? $record['user_email'] : '');
         $phone_number = (!empty($record['phone_number']) ? $record['phone_number'] : '');
         $advertiseType = (!empty($record['advertise_type']) ? $record['advertise_type'] : '');

         $no_of_room = (!empty($record['no_of_room']) ? $record['no_of_room'] : '');
         $check_in_date = (!empty($record['check_in_date']) ? date('Y-m-d', strtotime($record['check_in_date'])) : '');
         $check_out_date = (!empty($record['check_out_date']) ? date('Y-m-d', strtotime($record['check_out_date'])) : '');

         $txn_id = (!empty($record['payment_id']) ? $record['payment_id'] : '');

         $order_id = (!empty($record['order_id']) ? $record['order_id'] : '');

         $amount_paid = (!empty($record['amt']) ? $record['amt'] : '');

         /* If attachment */
         $filename = $record['advertisement_file'];
         //$filename  = "certificate.jpg";
         $uid     = md5(uniqid(time()));
         if (!empty($filename)) {
            $path      = "https://sopa.org/SoyConclave/images/";
            $file      = $path . $filename;
            $file_size = filesize($file);
            $handle    = fopen($file, "r");
            $content   = fread($handle, $file_size);
            fclose($handle);

            $content = chunk_split(base64_encode($content));
            $uid     = md5(uniqid(time()));
            $name    = basename($file);

            $eol     = PHP_EOL;
         }


         $from_name = "sopa.org";
         $from_mail = $from;
         $replyto   = $to;
         $mailto    = $to;
         $header    = "From: " . $from_name . " <" . $from_mail . ">\n";
         $header .= "Reply-To: " . $replyto . "\n";
         $header .= "MIME-Version: 1.0\n";
         $header .= 'Cc: ' . $cc_email . "\r\n";
         $header .= 'Bcc:' . $bcc_email . "\r\n";
         $from_mail2 = $to;
         $replyto2   = $to;
         $mailto2    = $from;
         $header2    = "From: " . $from_name . " <" . $from_mail2 . ">\n";
         $header2 .= "Reply-To: " . $replyto2 . "\n";
         $header2 .= "MIME-Version: 1.0\n";

         if (empty($filename)) {
            $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
            $header2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
         } else {
            $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
            $header2 .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
         }
         // $header .= 'Bcc: varun.jain@syscraftonline.com' . "\r\n";
         $emessage .= "--" . $uid . "\n";



         // Compose a simple HTML email message

         $message .= '<!doctype html>';
         $message .= '<html class="no-js" lang="en">';
         $message .= '<head>
                     <meta charset="utf-8">
                     <meta http-equiv="x-ua-compatible" content="ie=edge">
                     <title>sopa</title>
                     <meta name="description" content="">
                     <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
                     <link rel="shortcut icon" type="image/x-icon" href="https://www.sopa.org/wp-content/themes/twentytwelve/images/logo.png">
                  </head>';
         $message .= '<body>';
         $message .= '<style>
                        table.center {
                        margin-left: auto;
                        margin-right: auto;
                        }
                        img{
                        max-width: 100%;
                        }
                     </style>';
         $message .= "<table class='center' style='width: 700px;font-family:'Roboto', sans-serif;background-color: #c1b8ce26;'>";
         $message .= '<tr>
                           <td style="background-color: #25223b;padding: 30px 30px;">
                              <a target="_blank" href="#">';
         $message .= '<img src="images/logos/logo.png" style="margin: 0 auto;display: flex;width: 200px;">';
         $message .= '</a>';
         $message .= '</td>
                          
                        </tr>';
         $message .= '<tr>
                           <td>
                              
                              <h4 style="text-align: center;font-size: 22px;
                              color: #25223b;">
                                 ADVERTISEMENT RELEASE 
                              </h4>
                           </td>
                        </tr>';
         $message .= '<tr>';
         $message .= '<td>';
         $message .= '<table align="center">';
         if (!empty($user_name)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;"><b>Name:</b></td>
               <td style="padding-bottom: 15px;">' . $user_name . '</td>
            </tr>';
         }
         if (!empty($company_name)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;"><b>Company name:</b></td>
               <td style="padding-bottom: 15px;">' . $company_name . '</td>
            </tr>';
         }
         if (!empty($user_email)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Email:</b>
               </td>
               <td style="padding-bottom: 15px;">' . $user_email . '</td>
            </tr>';
         }
         if (!empty($phone_number)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Mobile number:</b>
               </td>
               <td style="padding-bottom: 15px;">
               ' . $phone_number . '
               </td>
            </tr>';
         }
         if (!empty($advertiseType)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Advertisement Type:</b>
               </td>
               <td style="padding-bottom: 15px;">
                  ' . $advertiseType . '
               </td>
            </tr>';
         }
         if (!empty($txn_id)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Transaction id:</b>
               </td>
               <td style="padding-bottom: 15px;">
                  ' . $txn_id . '
               </td>
            </tr>';
         }
         if (!empty($order_id)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Order id:</b>
               </td>
               <td style="padding-bottom: 15px;">
                  ' . $order_id . '
               </td>
            </tr>';
         }
         if (!empty($amount_paid)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Pay amount:</b>
               </td>
               <td style="padding-bottom: 15px;">
                  ' . $amount_paid . '
               </td>
            </tr>';
         }
         if (!empty($no_of_room)) {
            $message .= '<tr>
                              <td style="padding-bottom: 15px;">
                                 <b>No. of room</b>
                              </td>
                              <td style="padding-bottom: 15px;">
                           ' . $no_of_room . '
                              </td>
                           </tr>';
         }
         if (!empty($single_Double)) {
            $message .= '<tr>
                              <td style="padding-bottom: 15px;">
                                 <b>Occupancy</b>
                              </td>
                              <td style="padding-bottom: 15px;">
                           ' . $single_Double . '
                              </td>
                           </tr>';
         }
         if (!empty($no_of_room) && $no_of_room>0 && !empty($check_in_date)) {
            $message .= '<tr>
                              <td style="padding-bottom: 15px;">
                                 <b>Check-In Date</b>
                              </td>
                              <td style="padding-bottom: 15px;">
                                 ' . date('d-m-Y', strtotime($check_in_date)) . '
                              </td>
                           </tr>';
         }
         if (!empty($no_of_room) && $no_of_room>0 && !empty($check_out_date)) {
            $message .= '<tr>
                              <td style="padding-bottom: 15px;">
                                 <b>Check-Out Date</b>
                              </td>
                              <td style="padding-bottom: 15px;">
                                 ' . date('d-m-Y', strtotime($check_out_date)) . '
                              </td>
                           </tr>';
         }
         $message .= '<tr>
            <td style="padding-bottom: 15px;">
               <b>Date:</b>
            </td>
            <td style="padding-bottom: 15px;">
               ' . date('d-m-Y') . '
            </td>
         </tr>';

         if (empty($filename)) {
            $message .= '<tr>
               <td style="padding-bottom: 15px;">
                  <b>Attachment:</b>
               </td>
               <td style="padding-bottom: 15px;">
                  Kindly send attachment as soon as possible
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

         $emessage .= "Content-type:text/html; charset=iso-8859-1\n";
         $emessage .= "Content-Transfer-Encoding: 7bit\n\n";
         $emessage .= $message . "\n\n";

         $emessage .= "--" . $uid . "\n";

         if (!empty($filename)) {
            $emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
            $emessage .= "Content-Transfer-Encoding: base64\n";
            $emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
            $emessage .= $content . "\n\n";
         } else {
            //$emessage .= "Content-Type: application/octet-stream;\"\"\n"; // use different content types here
            /*$emessage .= "Content-Transfer-Encoding: base64\n";
$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
$emessage .= $content . "\n\n";*/
         }

         $emessage .= "--" . $uid . "--";


         // Sending email
         if (mail($to, $subject, $emessage, $header)) {
            $success_message =  'Your mail has been sent successfully, we will contact you soon.';
            mail($user_to, $subject, $emessage, $header2);
            /*mail($user_to, $subject, $message, $headers2);*/
?>
            <script type="text/javascript">
               window.location = SITEURL + "/thankyou";
            </script>
         <?php



         }
      } else {
         ?>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <p>Something is wrong please contack the support66</p>
               </div>
            </div>
         </div>
         <script>
            window.location.href = SITEURL;
         </script>
<?php
      }
   }
}
?>

<?php
require('pay/razorpay-php/Razorpay.php');

require('pay/razorpay-php/config.php');

// Create the Razorpay Order

// if (isset($_SESSION["payment_update_info"])) {
//    $update_info = $_SESSION["payment_update_info"];
//    $pay_index = $update_info['pay_amt'];
//    // if(array_key_exists($pay_index,$_SESSION["pay_amount"])){
//    //    $get_pay_amt = $_SESSION["pay_amount"][$pay_index];
//    // }
//    $get_pay_amt = $pay_index;
// }
// $user_name = '';
// $user_email = '';
// $phone_number = '';
// if (isset($_POST['submit-form'])) {
//    extract($_POST);
//    $user_name = (!empty($user_name) ? $user_name : '');
//    $user_email = (!empty($user_email) ? $user_email : '');
//    $phone_number = (!empty($phone_number) ? $phone_number : '');
// }


use Razorpay\Api\Api;
?>

<!--  End Paypal Payment -->

<script src="https://checkout.razorpay.com/v1/checkout.js"></script>

<script>
   // function mypay(e) {
   //    rzp1.open();
   //    e.preventDefault();
   // }
</script>


<head>
   <link rel="stylesheet" href="//code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
   <?php
   include('styles.php');
   ?>

</head>

<body>

   <?php
   if (isset($_POST['submit-form'])) {

      extract($_POST);
      
      $user_name = (!empty($user_name) ? $user_name : '');
      $company_name = (!empty($company_name) ? $company_name : '');
      $user_email = (!empty($user_email) ? $user_email : '');
      $phone_number = (!empty($phone_number) ? $phone_number : '');
      $gstNo = (!empty($gst_no) ? $gst_no : '');
      $payment_type = (!empty($payment_type) ? $payment_type : '');

      // $no_of_room = (!empty($record['no_of_room']) ? $record['no_of_room'] : '');
      // $check_in_date = (!empty($record['check_in_date']) ? date('Y-m-d', strtotime($record['check_in_date'])) : '');
      // $check_out_date = (!empty($record['check_out_date']) ? date('Y-m-d', strtotime($record['check_out_date'])) : '');


      $advertiseTypeArr = array('Back Cover Page', 'Front Inside Cover Page', 'Back Inside Cover Page', 'Full Page (Colour)', 'Full Page (Black & White)');
      $advertise_Type = $advertiseTypeArr[$pay_to];



      $no_of_room = (!empty($no_of_room) ? $no_of_room : '');
      $no_Of_Room = (!empty($no_of_room) ? $no_of_room : '');

      $single_double = (!empty($single_double) ? $single_double : '');

      $check_in_date = (!empty($check_in_date) ? date('Y-m-d', strtotime($check_in_date)) : '');
      $check_out_date = (!empty($check_out_date) ? date('Y-m-d', strtotime($check_out_date)) : '');

      $singledouble = (!empty($single_double) ? $single_double : '');

      // $check_amount = (!empty($check_amount) ? $check_amount : '');


      /* Start calculation */
      $checkInDate = date("Y-m-d", strtotime($check_in_date));
      $checkOutDate = date("Y-m-d", strtotime($check_out_date));

      $delegate_amt = $_SESSION["pay_amount"][$pay_to];
      // if ($install_type == "2") { // type 2 = 
      //    $delegate_amt = 70800;
      // }
      // // if ($install_type == "3") { // type 3 = 
      // //    $delegate_amt = 76700;
      // // }
      //    else {
      //    $delegate_amt = 64900;
      // }

      // get delagate amount 
      //echo 'Delegate amount = '.$delegate_amt; // fix charge


      $actual_occpency_amt = 0;
      $no_occupency = $single_double;
      if ($single_double == "2") {
         $actual_occpency_amt = 7080; // select 2 ocupency
      } else {
         $actual_occpency_amt = 6490; // select 1 ocupency
      }
      //echo "<br>$single_double occupancy select = ".$actual_occpency_amt;

      $noofroom = 1;

      $no_of_room_charge = 0;

      if ($no_of_room > 0) { // no of room greater tha 0
         $no_of_room_charge = $actual_occpency_amt * $no_of_room;
      }

      // get charge no of room
      //echo "<br> $actual_occpency_amt occupancy and 2 rooms select = ".$no_of_room_charge;
      $checkInDate = date("Y-m-d", strtotime($check_in_date));
      $checkOutDate = date("Y-m-d", strtotime($check_out_date));

      $total_night_charges_check_in_check_out = 0;
      if ($no_of_room > 0) {

         $fromdate = date_create($checkInDate);
         $todate = date_create($checkOutDate);
         $diff = date_diff($fromdate, $todate);
         $no_nights = (int)$diff->d;

         if ($no_nights > 0) {
            $total_night_charges_check_in_check_out = $no_of_room_charge * $no_nights;
         }
      }

      /* Actual pay ampunt */
      $payable_amt = $total_night_charges_check_in_check_out + $delegate_amt;
      /* End date */





      $created_at = date('Y-m-d H:i:s');

      $advertisementFile = '';
      if (!empty($_FILES["advertisement_file"]["name"])) {
         //echo $_FILES["advertisement_file"]["name"].'<br>';
         $filt_target_dir = getcwd() . $target_dir;
         // Get file path
         $add_time = time();
         $target_file = $filt_target_dir . $add_time . '-' . basename($_FILES["advertisement_file"]["name"]);
         if (move_uploaded_file($_FILES["advertisement_file"]["tmp_name"], $target_file)) {
            $advertisementFile = $add_time . '-' . basename($_FILES["advertisement_file"]["name"]);
         }
      }

      $creat_at = date('Y-m-d');
      $sql_query = "INSERT INTO soyconclave_advertising_release (user_name, company_name, amt, user_email,payment_type, phone_number,gst_no,advertisement_file,advertise_type, no_of_room, check_in_date, check_out_date,single_double, created_at) VALUES ('$user_name', '$company_name', '$payable_amt', '$user_email','$payment_type', '$phone_number','$gstNo','$advertisementFile','$advertise_Type', '$no_Of_Room', '$check_in_date', '$check_out_date','$singledouble', '$created_at')";

      // echo $sql_query; die;

      /*$creat_at = date('Y-m-d');
               $sql_query = "INSERT INTO soyconclave_advertising_release (user_name, company_name, user_email, phone_number, created_at) VALUES ('$user_name', '$company_name', '$user_email', '$phone_number', '$created_at')";*/

      //$name = (!empty($name) ? $name : '');

      if ($conn->query($sql_query) === TRUE) {
         $last_id = $conn->insert_id;
         $_SESSION["payment_update_info"] = array('update_id' => $last_id, 'pay_amt' => $payable_amt);

         $api = new Api($key_id, $key_secret);

         $orderData = [

            'receipt'         => 3456,

            'amount'          => $payable_amt * 100, // 2000 rupees in paise

            'currency'        => 'INR',

            'payment_capture' => 1 // auto capture

         ];

         $razorpayOrder = $api->order->create($orderData);

         $razorpayOrderId = $razorpayOrder['id'];

         if ($payment_type == '2') {

            /* Start mail code */


            $query = "SELECT * FROM soyconclave_advertising_release WHERE `id` = $last_id LIMIT 1";
            // echo $query;
            // die();
            $records = mysqli_query($conn, $query); // 
            $record = mysqli_fetch_array($records);

            // $row_info = mysql_fetch_assoc($result);
            if (!empty($record)) {

               $subject = 'ADVERTISEMENT RELEASE';
               $user_from = $to;

               $from = (!empty($record['user_email']) ? $record['user_email'] : '');
               $user_to = $from;
               $user_name = (!empty($record['user_name']) ? $record['user_name'] : '');
               $company_name = (!empty($record['company_name']) ? $record['company_name'] : '');
               $user_email = (!empty($record['user_email']) ? $record['user_email'] : '');
               $phone_number = (!empty($record['phone_number']) ? $record['phone_number'] : '');

               $advertiseTypeArr = array('Back Cover Page', 'Front Inside Cover Page', 'Back Inside Cover Page', 'Full Page (Colour)', 'Full Page (Black & White)');
               $advertiseType = (!empty($record['advertise_type']) ? $record['advertise_type'] : '');

               $payment_type = ($record['payment_type'] == '2' ? 'Offline' : 'Online');

               /* If attachment */
               $filename = $record['advertisement_file'];
               //$filename  = "certificate.jpg";
               $uid     = md5(uniqid(time()));
               if (!empty($filename)) {
                  $path      = "https://sopa.org/SoyConclave/images/";
                  $file      =   $path . $filename;
                  $file_size = filesize($file);
                  $handle    = fopen($file, "r");
                  $content   = fread($handle, $file_size);
                  fclose($handle);

                  $content = chunk_split(base64_encode($content));
                  $uid     = md5(uniqid(time()));
                  $name    = basename($file);

                  $eol     = PHP_EOL;
               }


               $from_name = "sopa.org";
               $from_mail = $from;
               $replyto   = $to;
               $mailto    = $to;
               $header    = "From: " . $from_name . " <" . $from_mail . ">\n";
               $header .= "Reply-To: " . $replyto . "\n";
               $header .= "MIME-Version: 1.0\n";
               $header .= 'Cc: ' . $cc_email . "\r\n";
               $header .= 'Bcc:' . $bcc_email . "\r\n";

               $from_mail2 = $to;
               $replyto2   = $to;
               $mailto2    = $from;
               $header2    = "From: " . $from_name . " <" . $from_mail2 . ">\n";
               $header2 .= "Reply-To: " . $replyto2 . "\n";
               $header2 .= "MIME-Version: 1.0\n";

               if (empty($filename)) {
                  $header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                  $header2 .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
               } else {
                  $header .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
                  $header2 .= "Content-Type: multipart/mixed; boundary=\"" . $uid . "\"\n\n";
               }

               // $header .= 'Bcc: varun.jain@syscraftonline.com' . "\r\n";

               $emessage .= "--" . $uid . "\n";

               // Compose a simple HTML email message

               $message .= '<!doctype html>';
               $message .= '<html class="no-js" lang="en">';
               $message .= '<head>
      <meta charset="utf-8">
      <meta http-equiv="x-ua-compatible" content="ie=edge">
      <title>sopa</title>
      <meta name="description" content="">
      <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
      <link rel="shortcut icon" type="image/x-icon" href="https://www.sopa.org/wp-content/themes/twentytwelve/images/logo.png">
   </head>';
               $message .= '<body>';
               $message .= '<style>
         table.center {
         margin-left: auto;
         margin-right: auto;
         }
         img{
         max-width: 100%;
         }
      </style>';
               $message .= "<table class='center' style='width: 700px;font-family:'Roboto', sans-serif;background-color: #c1b8ce26;'>";
               $message .= '<tr>
               <td style="background-color: #25223b;padding: 30px 30px;">
                  <a target="_blank" href="#"><img src="https://www.sopa.org/wp-content/themes/twentytwelve/images/logo.png" style="margin: 0 auto;display: flex;width: 200px;"></a>                   
               </td>
              
            </tr>';
               $message .= '<tr>
            <td>
              
               <h4 style="text-align: center;font-size: 22px;
               color: #25223b;">
                  ADVERTISEMENT RELEASE 
               </h4>
            </td>
         </tr>';
               $message .= '<tr>';
               $message .= '<td>';
               $message .= '<table align="center">';

               if (!empty($user_name)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;"><b>Name:</b></td>
                     <td style="padding-bottom: 15px;">' . $user_name . '</td>
                  </tr>';
               }
               if (!empty($company_name)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;"><b>Company name:</b></td>
                     <td style="padding-bottom: 15px;">' . $company_name . '</td>
                  </tr>';
               }
               if (!empty($user_email)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;">
                        <b>Email:</b>
                     </td>
                     <td style="padding-bottom: 15px;">' . $user_email . '</td>
                  </tr>';
               }
               if (!empty($phone_number)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;">
                        <b>Mobile number:</b>
                     </td>
                     <td style="padding-bottom: 15px;">
                     ' . $phone_number . '
                     </td>
                  </tr>';
               }
               if (!empty($advertiseType)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;">
                        <b>Advertisement Type:</b>
                     </td>
                     <td style="padding-bottom: 15px;">
                        ' . $advertiseType . '
                     </td>
                  </tr>';
               }
               if (!empty($no_of_room)) {
                  $message .= '<tr>
                                    <td style="padding-bottom: 15px;">
                                       <b>No. of room</b>
                                    </td>
                                    <td style="padding-bottom: 15px;">
                                 ' . $no_of_room . '
                                    </td>
                                 </tr>';
               }
               if (!empty($single_Double)) {
                  $message .= '<tr>
                                    <td style="padding-bottom: 15px;">
                                       <b>Occupancy</b>
                                    </td>
                                    <td style="padding-bottom: 15px;">
                                 ' . $single_Double . '
                                    </td>
                                 </tr>';
               }
               if (!empty($no_of_room) && $no_of_room>0 && !empty($check_in_date)) {
                  $message .= '<tr>
                                    <td style="padding-bottom: 15px;">
                                       <b>Check-In Date</b>
                                    </td>
                                    <td style="padding-bottom: 15px;">
                                       ' . date('d-m-Y', strtotime($check_in_date)) . '
                                    </td>
                                 </tr>';
               }
               if (!empty($no_of_room) && $no_of_room>0 && !empty($check_out_date)) {
                  $message .= '<tr>
                                    <td style="padding-bottom: 15px;">
                                       <b>Check-Out Date</b>
                                    </td>
                                    <td style="padding-bottom: 15px;">
                                       ' . date('d-m-Y', strtotime($check_out_date)) . '
                                    </td>
                                 </tr>';
               }
               $message .= '<tr>
                  <td style="padding-bottom: 15px;">
                     <b>Date:</b>
                  </td>
                  <td style="padding-bottom: 15px;">
                     ' . date('d-m-Y') . '
                  </td>
               </tr>';
      
               if (empty($filename)) {
                  $message .= '<tr>
                     <td style="padding-bottom: 15px;">
                        <b>Attachment:</b>
                     </td>
                     <td style="padding-bottom: 15px;">
                        Kindly send attachment as soon as possible
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



               $emessage .= "Content-type:text/html; charset=iso-8859-1\n";
               $emessage .= "Content-Transfer-Encoding: 7bit\n\n";
               $emessage .= $message . "\n\n";

               $emessage .= "--" . $uid . "\n";

               if (!empty($filename)) {
                  $emessage .= "Content-Type: application/octet-stream; name=\"" . $filename . "\"\n"; // use different content types here
                  $emessage .= "Content-Transfer-Encoding: base64\n";
                  $emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
                  $emessage .= $content . "\n\n";
               } else {
                  //$emessage .= "Content-Type: application/octet-stream;\"\"\n"; // use different content types here
                  /*$emessage .= "Content-Transfer-Encoding: base64\n";
$emessage .= "Content-Disposition: attachment; filename=\"" . $filename . "\"\n\n";
$emessage .= $content . "\n\n";*/
               }

               $emessage .= "--" . $uid . "--";


               // Sending email
               if (mail($to, $subject, $emessage, $header)) {
                  $success_message =  'Your mail has been sent successfully, we will contact you soon.';
                  mail($user_to, $subject, $emessage, $header2);
                  /*mail($user_to, $subject, $message, $headers2);*/
   ?>
                  <script type="text/javascript">
                     window.location = SITEURL + "/offline";
                  </script>
               <?php



               }
            } else {
               ?>
               <div class="row">
                  <div class="col-md-12">
                     <div class="form-group">
                        <p>Something is wrong please contack the support66</p>
                     </div>
                  </div>
               </div>
            <?php
            }

            /* End mail code*/
         } else {


            ?>
            <script type="text/javascript">
               var amount = "<?php echo $payable_amt ?>";

               var options = {

                  //"key": "rzp_test_j46MjVWZHYOsxF",

                  "key": "<?php echo $key_id ?>",

                  "amount": amount * 100, // 2000 paise = INR 20

                  "name": "Sopa",

                  "description": "Payment",

                  "currency": "INR",

                  "callback_url": SITEURL + 'request-advertising',

                  "currency": "INR",

                  "order_id": "<?php echo $razorpayOrderId; ?>",

                  "modal": {

                     "ondismiss": function() {
                        //alert("Payment Failed")
                        window.location.replace(SITEURL + "/cancel");
                     },
                  },
                  "prefill": {
                     "name": "<?php echo $user_name; ?>",
                     "email": "<?php echo $user_email; ?>",
                     "contact": "<?php echo $phone_number; ?>"
                  },
                  "theme": {
                     "color": "#528FF0"
                  }

               };

               var rzp1 = new Razorpay(options);
               rzp1.open();
               // $(document).ready(function() {
               //    mypay();
               // });
            </script>

         <?php
         }
      } else {
         ?>
         <div class="row">
            <div class="col-md-12">
               <div class="form-group">
                  <p>Something is wrong please contack the support</p>
               </div>
            </div>
         </div>
         <script>
            window.location.href = SITEURL;
         </script>
   <?php
      }
   }

   ?>

   <!-- PRELOADER SPINNER
		============================================= -->
   <div id="loader-wrapper">
      <div id="loader">
         <div class="cssload-loader">
            <div class="cssload-spinner"></div>
         </div>
      </div>
   </div>


   <!-- PAGE CONTENT
		============================================= -->
   <div id="page" class="page">




      <?php
      include('header2.php');
      ?>



      <!-- INNER PAGE WRAPPER
			============================================= -->
      <div class="inner-page-wrapper">




         <!-- PAGE HERO
				============================================= -->
         <div id="about-page" class="page-hero-section division">
            <div class="container">
               <div class="row">
                  <div class="col-md-10">
                     <div class="hero-txt white-color"></div>
                  </div> <!-- END PAGE HERO TEXT -->
               </div> <!-- End row -->
            </div> <!-- End container -->
         </div> <!-- END PAGE HERO -->




         <!-- REGISTER-3
			    ============================================= -->
         <section id="register-3" class="bg-02-decor bg-lightgrey wide-100 contacts-section division">

            <!-- REGISTER-3 FORM -->
            <div class="register-3-form">
               <div class="container">
                  <div class="row">
                     <div class="col-lg-10 offset-lg-1">


                        <!-- REGISTER FORM -->
                        <div class="form-holder">
                           <div class="col-md-12 d-flex" style="position: absolute; top: 20px; justify-content: center;left: 0;">
                              <a href="hotel-room-reservation" style="margin: -1px;border-radius: 0;" class="btn btn-primary">Delegate Registration</a>
                              <a style="margin: -1px;border-radius: 0;border-right: 0px solid #fff;border-left: 0px solid #fff;" href="#" class="btn btn-tra-black black-hover">Advertise With Us</a>
                              <a style="margin: -1px;border-radius: 0;" href="exibihition-hall-booking" class="btn btn-primary">Exhibit With Us</a>
                           </div>
                           <br />
                           <br />
                           <!-- Title -->
                           <h3 class="h3-xs noto-font-900 purple-color">ADVERTISEMENT RELEASE FORM </h3>
                           <h5 class="h5-xs noto-font-900 purple-color">International Soy Conclave</h5>
                           <p class="p-sm grey-color"><b>8th -9th October 2022 at Brilliant Convention Centre, Indore </b></p>
                           <p class="p-sm grey-color">The Executive Director, The Soybean Processors Association of India,<br> Scheme No. 53, Malviya Nagar, A.B. Road, Indore - 452 008
                           </p>
                           <p class="p-sm grey-color m-0"><b>Dear Sir, </b></p>
                           <p class="p-sm grey-color">We would like to release an advertisement in International Soy Conclave 2022 Souvenir as specified in the box.
                           </p>


                           <form method="post" id="request_advertising_form" enctype="multipart/form-data" name="registerForm" class="row register-form">
                              <div class="row m-0  w-100">
                                 <div class="col-md-12">
                                    <div class="table-responsive">
                                       <table class="table table-bordered table-center">
                                          <thead>
                                             <tr>
                                                <th>S. No. </th>
                                                <th>Description</th>
                                                <th>Fee (Rs.) </th>
                                                <th> Tax (Rs.)</th>
                                                <th>Total (Rs.) </th>
                                                <th>Select an option</th>
                                             </tr>
                                          </thead>
                                          <tbody>

                                             <tr>
                                                <td>1.</td>
                                                <td>Hotel Room at Venue (Single)/day </td>
                                                <td>5,500 </td>
                                                <td>990 </td>
                                                <td>6,490 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to_hotel" value="2">
                                                </td>
                                             </tr>
                                             <tr>
                                                <td>2.</td>
                                                <td>Hotel Room at Venue (Double)/day </td>
                                                <td>6,000 </td>
                                                <td>1,080 </td>
                                                <td>7,080 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to_hotel" value="3">

                                                </td>
                                             </tr>

                                          </tbody>
                                       </table>
                                       <table class="table table-bordered table-center">
                                          <thead>
                                             <tr>
                                                <th>S. No. </th>
                                                <th>Description</th>
                                                <th>Print Area(WxH)</th>
                                                <th>Tariff(Inclusive of Tax)</th>
                                                <th>Complimentary delegates </th>
                                                <th>Select an option</th>
                                             </tr>
                                          </thead>
                                          <tbody>
                                             <tr>
                                                <td>1.</td>
                                                <td>Back Cover Page</td>
                                                <td>18 x 24</td>
                                                <td>Rs. 1,50,000 </td>
                                                <td>4</td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to" value="0" required="" checked="checked">

                                                </td>
                                             </tr>
                                             <tr>
                                                <td>2.</td>
                                                <td>Front Inside Cover Page</td>
                                                <td>18 x 24</td>
                                                <td>Rs. 1,00,000</td>
                                                <td>3 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to" value="1" required="">

                                                </td>
                                             </tr>
                                             <tr>
                                                <td>3.</td>
                                                <td>Back Inside Cover Page</td>
                                                <td>18 x 24</td>
                                                <td>Rs. 90,000 </td>
                                                <td>3 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to" value="2" required="">

                                                </td>
                                             </tr>
                                             <tr>
                                                <td>4.</td>
                                                <td>Full Page (Colour)</td>
                                                <td>18 x 24</td>
                                                <td>Rs. 29,500</td>
                                                <td>2 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to" value="3" required="">

                                                </td>
                                             </tr>
                                             <tr>
                                                <td>5.</td>
                                                <td>Full Page (Black & White)</td>
                                                <td>18 x 24</td>
                                                <td>Rs. 17,700 </td>
                                                <td>1 </td>
                                                <td>
                                                   <input type="radio" class="radio_btn" name="pay_to" value="4" required="">

                                                </td>
                                             </tr>
                                          </tbody>
                                       </table>

                                    </div>
                                    <h6 class="p-sm grey-color">Print Material: For printing of the colour advertisement,the design in Corel Draw open file along with fonts used in design or high resolution PDF file is required.</h6>
                                 </div>
                              </div>
                              <br />
                              <div class="row m-2 w-100" style="margin: 15px 0px 20px 0px !important;">
                                 <!-- <div class="col-md-8"></div> -->
                                 <div class="col-md-4">
                                    <input type="file" name="advertisement_file" id="advertisement_file" class="dropify" data-height="100" data-allowed-file-extensions="pdf cdr" data-default-file="" data-max-file-size="4M">
                                 </div>
                              </div>
                              <br />
                              <div class="row m-0">
                                 <div class="col-md-12 input-ticket">
                                    <p class="p-xs grey-color">The last date for releasing advertisement is 10th September 2022 and booking will not be accepted without full advance payment & printing material as specified above.</p>
                                 </div>


                                 <div class="col-md-6">
                                    <input type="text" name="user_name" class="form-control name" placeholder="Name*" required>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="company_name" class="form-control name" placeholder="Company Name*" required>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="gstin" class="form-control name gstin" minlength="15" maxlength="15" placeholder="GSTIN*" required>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="tel" name="phone_number" class="form-control phone" placeholder="Mobile*" required>
                                 </div>
                                 <div class="col-md-6">
                                    <input type="text" name="user_email" class="form-control email" placeholder="Email*" required>
                                 </div>
                                 <div class="col-md-6 input-ticket">
                                    <select id="payment_type" name="payment_type" class="custom-select ticket" required>
                                       <!-- <option value="">Choose Payment Mode</option> -->
                                       <option value="1">Online</option>
                                       <option value="2" selected>Offline</option>
                                    </select>
                                 </div>
                                 <div class="row m-0 room-booking" style="display:none;">
                                    <div class="col-md-8 input-ticket">
                                       <p class="p-xs grey-color">Hotel room at Brilliant Convention Centre required/not required: </p>
                                    </div>
                                    <div class="col-md-4 input-ticket">
                                       <select id="no_of_room" name="no_of_room" class="no_of_room custom-select ticket no_of_room_section" required>
                                          <!-- <option value="0">Number of room(s)</option> -->
                                          <option value="0">0</option>
                                          <option value="1">1</option>
                                          <option value="2">2</option>
                                          <option value="3">3</option>
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row m-0 occupancy_section" style="display:none;">
                                    <div class="col-md-4">
                                       <select id="single_double" name="single_double" class="custom-select ticket">
                                          <option value="">Occupancy</option>
                                          <option value="1">Single</option>
                                          <option value="2">Double</option>
                                       </select>
                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" name="check_in_date" id="check_in_date" class="form-control date" placeholder="Select date" />

                                    </div>
                                    <div class="col-md-4">
                                       <input type="text" name="check_out_date" id="check_out_date" class="form-control date" placeholder="Select date" />
                                    </div>
                                 </div>
                              </div>

                              <!-- Register Form Button -->
                              <div class="col-lg-12 form-btn">
                                 <button type="submit" name="submit-form" class="btn btn-md btn-primary tra-black-hover submit">Submit</button>
                              </div>

                              <!-- Register Form Message -->
                              <div class="col-lg-12 register-form-msg text-center">
                                 <div class="sending-msg"><span class="loading"></span></div>
                              </div>
                           </form>
                        </div> <!-- END REGISTER FORM -->
                     </div> <!-- End col-x -->
                  </div> <!-- End row -->
               </div> <!-- End container -->
            </div> <!-- END REGISTER-3 FORM -->
         </section> <!-- END REGISTER-3 -->
         <?php
         include('footer.php');
         ?>
      </div> <!-- END INNER PAGE WRAPPER -->
   </div> <!-- END PAGE CONTENT -->
   <?php
   include('scripts.php');
   ?>
</body>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
<script>
   var availableDates = ["7-10-2022", "8-10-2022", "9-10-2022", "10-10-2022"];
   // console.log(window.location);
   // $( "#check_in_date" ).datepicker({
   // changeYear: true,
   // dateFormat: 'yy-mm-dd',
   // maxDate: new Date()
   // });
   // $( "#check_out_date" ).datepicker({
   // changeYear: true,
   // dateFormat: 'yy-mm-dd',
   // maxDate: new Date()
   // });
   $("#check_in_date").datepicker({
      beforeShowDay: function(dt) {
         return [available(dt), ""];
      },
      changeMonth: false,
      changeYear: false,
      // numberOfMonths: 2,
      minDate: new Date(),
      dateFormat: "dd-mm-yy",
      onSelect: function(selected) {
         var dt = new Date(selected);
         dt.setDate(dt.getDate() + 1);
         $("#check_out_date").datepicker("option", "minDate", dt);
      }
   });
   $("#check_out_date").datepicker({
      beforeShowDay: function(dt) {
         return [available(dt), ""];
      },
      changeMonth: false,
      changeYear: false,
      dateFormat: "dd-mm-yy",
      // numberOfMonths: 2,
      onSelect: function(selected) {
         var dt = new Date(selected);
         dt.setDate(dt.getDate() - 1);
         $("#check_in_date").datepicker("option", "maxDate", dt);
      }
   });

   function available(date) {
      dmy = date.getDate() + "-" + (date.getMonth() + 1) + "-" + date.getFullYear();
      if ($.inArray(dmy, availableDates) != -1) {
         return true;
      } else {
         return false;
      }
   }

   $('input[name="pay_to_hotel"]').click(function() {
      $('.room-booking').show();
   })
   $('.no_of_room_section').on('change', function() {
      var curr_val = $(this).val();
      //alert(curr_val)
      if (curr_val == "" || curr_val == "0") {
         $('.occupancy_section').hide();
         $('input[name="pay_to_hotel"]').attr('required', false);
         $('#single_double').attr('required', false);
         $('#check_in_date').attr('required', false);
         $('#check_out_date').attr('required', false);
      } else {
         $('.occupancy_section').show();
         $('input[name="pay_to_hotel"]').attr('required', true);
         $('#single_double').attr('required', true);
         $('#check_in_date').attr('required', true);
         $('#check_out_date').attr('required', true);
      }
   })
</script>

</html>