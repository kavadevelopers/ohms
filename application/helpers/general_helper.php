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

function get_one_day($hours_min){
    if ( strpos( $hours_min, "." ) !== false ) {
        $whole = floor($hours_min); 
        $fraction = $hours_min - $whole;
        $today = ($whole * 60) + ($fraction * 100);
        if($today > 10){
            return $today - 10;
        }
        else{
            return $today;
        }
    }
    else{
        $today = $hours_min * 60;
        if($today > 10){
            return $today - 10;
        }
        else{
            return $today;
        }
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

?>