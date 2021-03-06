<?php
defined('BASEPATH') OR exit('No direct script access allowed');

function pre_print($array)
{   
    echo count($array);
    echo "<pre>";
    print_r($array);
}


function _vdatetime($datetime)
{
	return date('d-m-Y h:i A',strtotime($datetime));
}

function vd($date)
{
    return date('d-m-Y',strtotime($date));
}

function dd($date)
{
    return date('Y-m-d',strtotime($date));
}

function get_month_name($month)
{
    return date("F", mktime(0, 0, 0, $month, 10));
}

function getMinute($from,$to,$date){
    $to_time = strtotime($date." ".timeConverter($from));
    $from_time = strtotime($date." ".timeConverter($to));
    return round(abs($to_time - $from_time) / 60,2);
}

function timeConverter($str){
    $arr = explode(":", $str);
    $new = "";
    foreach ($arr as $key => $value) {
        if($key != 0){
            $c = ":";
        }else{
            $c = "";
        }
        $value = trim($value,"_");
        if($value != ""){
            if(strlen($value) == 2){
                $new .= $c.$value;
            }else{
                $new .= $c."0".$value;
            }
        }else{
            $new .= $c."00";
        }
    }

    if(count($arr) == 1){
        return dt($new.":00:00");
    }else if(count($arr) == 2){
        return dt($new.":00");
    }else{
        return dt($new);    
    }
}

function dt($time){
    return date('H:i:s',strtotime($time));   
}

// function get_one_day($hours_min,$minus){
//     if ( strpos( $hours_min, "." ) !== false ) {
//         $whole = floor($hours_min); 
//         $fraction = $hours_min - $whole;
//         $today = ($whole * 60) + ($fraction * 100);
//         if($today > $minus){
//             return $today - $minus;
//         }
//         else{
//             return $today;
//         }
//     }
//     else{
//         $today = $hours_min * 60;
//         if($today > $minus){
//             return $today - $minus;
//         }
//         else{
//             return $today;
//         }
//     }
// }   

function get_one_day($hours_min,$minus){
    $today = $hours_min;
    if($today > $minus){
        return $today - $minus;
    }
    else{
        return $today;
    }
}   

function moneyFormatIndia($amount): string {
    list ($number, $decimal) = explode('.', sprintf('%.2f', floatval($amount)));

    $sign = $number < 0 ? '-' : '';

    $number = abs($number);

    for ($i = 3; $i < strlen($number); $i += 3)
    {
        $number = substr_replace($number, ',', -$i, 0);
    }

    return $sign . $number . '.' . $decimal;
}

function rs()
{
    return "₹ ";
}  

function tsale(){
    return 1;
}

function tsalepay(){
    return 2;
}

function tpurchase(){
    return 3;
}

function tpurchasepay(){
    return 4;
}

function topening(){
    return 5;
}

function texpensepay(){
    return 6;
}

function tsalarypay(){
    return 7;
}

function tloanpay(){
    return 8;
}

function tsalereturn(){
    return 9;
}

function tpurchasereturn(){
    return 10;
}

function typestring($type){
    if($type == 1){
        return "Sales";
    }else if($type == 2){
        return "Payment";
    }else if($type == 3){
        return "Purchase";
    }else if($type == 4){
        return "Payment";
    }
    else if($type == 5){
        return "Opening";
    }
    else if($type == 9){
        return "Sales Return";
    }
    else if($type == 10){
        return "Purchase Return";
    }
    else{
        return "-";
    }
}

function vch_no($type,$tra_id,$tra_type)
{
    if($type == 1){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('sales',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('sales/edit/').$invoice['id'].'" target="_blank">'.$invoice['invoice'].'</a>';
        }else{
            $invoice = $CI->db->get_where('sales',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('sales/edit/').$invoice['id'].'" target="_blank">'.$invoice['chalan'].'</a>';
        }
    }else if($type == 3){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('purchase',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchase/edit/').$invoice['id'].'" target="_blank">'.$invoice['invoice'].'</a>';
        }else{
            $invoice = $CI->db->get_where('purchase',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchase/edit/').$invoice['id'].'" target="_blank">'.$invoice['chalan'].'</a>';
        }
    }else if($type == 9){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('salesreturn',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('salesreturn/edit/').$invoice['id'].'" target="_blank">'.$invoice['invoice'].'</a>';
        }else{
            $invoice = $CI->db->get_where('salesreturn',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('salesreturn/edit/').$invoice['id'].'" target="_blank">'.$invoice['chalan'].'</a>';
        }
    }else if($type == 10){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('purchasereturn',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchasereturn/edit/').$invoice['id'].'" target="_blank">'.$invoice['invoice'].'</a>';
        }else{
            $invoice = $CI->db->get_where('purchasereturn',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchasereturn/edit/').$invoice['id'].'" target="_blank">'.$invoice['chalan'].'</a>';
        }
    }else if($type == 2){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('sale_payments',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('salespayments/edit/').$invoice['id'].'" target="_blank">'.$invoice['id'].'</a>';
        }else{
            $invoice = $CI->db->get_where('sale_payments',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('salespayments/edit/').$invoice['id'].'" target="_blank">'.$invoice['id'].'</a>';
        }
    }else if($type == 4){
        $CI =& get_instance();
        if($tra_type == 'w'){
            $invoice = $CI->db->get_where('purchase_payments',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchasepay/edit/').$invoice['id'].'" target="_blank">'.$invoice['id'].'</a>';
        }else{
            $invoice = $CI->db->get_where('purchase_payments',['id' => $tra_id])->result_array()[0];
            return '<a href="'.base_url('purchasepay/edit/').$invoice['id'].'" target="_blank">'.$invoice['id'].'</a>';
        }
    }
    else{
        return "-";
    }
}

function ledamtd($debit,$credit){
    if($credit == 0){
        return "";
    }
    else{
        return moneyFormatIndia($credit);   
    }
}

function ledamtc($debit,$credit){
    if($debit == 0){
        return "";
    }
    else{
        return moneyFormatIndia($debit);   
    }
}

function tledamtd($debit,$credit){
    if($credit == 0){
        return 0;
    }
    else{
        return $credit;   
    }
}

function tledamtc($debit,$credit){
    if($debit == 0){
        return 0;
    }
    else{
        return $debit;   
    }
}

function dateRangeLoop( $first, $last, $step = '+1 day', $format = 'Y-m-d' ) {
    $dates = [];
    $current = strtotime( $first );
    $last = strtotime( $last );

    while( $current <= $last ) {

        $dates[] = date( $format, $current );
        $current = strtotime( $step, $current );
    }

    return $dates;
}

function amountCreDeb($credit,$debit){
    $amount = $credit - $debit;
    if($amount < 0){
        return [abs($amount),0.00];
    }else{
        return [0.00,$amount];
    }
}

function sendDbEmail($file)
{
    $CI =& get_instance();
    $CI->load->library('email');
    $config = array(
        'protocol'      => 'SMTP',
        'smtp_host'     => "mail.kavatechnologies.com",
        'smtp_port'     => "465",
        'smtp_user'     => "dbbackup@kavatechnologies.com",
        'smtp_pass'     => "dbbackup",
        'mailtype'      => 'html',
        'charset'       => 'utf-8'
    );
    $CI->email->initialize($config);
    $CI->email->set_mailtype("html");
    $CI->email->set_newline("\r\n");
    $CI->email->to("kavadevdbbackups@gmail.com");
    $CI->email->from("dbbackup@kavatechnologies.com","Kava Technologies");
    $CI->email->subject("OHMS CONTROL SYSTEM");
    $CI->email->message("DB Backup Dated :- ".date('d-M-Y h:i A'));
    $CI->email->attach('./dbbackupfolder/'.$file);
    if($CI->email->send()){
        echo "ok";
    }else{
        echo $CI->email->print_debugger();
    }
}
?>