<?php


function changeDateFormate($date,$date_format){
    return \Carbon\Carbon::createFromFormat('Y-m-d', $date)->format($date_format);
}

function productImagePath($image_name)
{
    return public_path('images/products/'.$image_name);
}

function getIndianCurrency(float $number)
{
    $decimalVal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Sixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $decimal_length = strlen($decimalVal);

    $j = 0;
    $str1 = array();
    while( $j < $decimal_length ) {
        $divider = ($j == 2) ? 10 : 100;
        $number = floor($decimalVal % $divider);
        $decimal = floor($decimalVal / $divider);
        $j += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str1)) && $number > 9) ? 's' : null;
            //$hundred = ($counter == 1 && $str1[0]) ? ' and ' : null;
            $hundred = null;
            $str1 [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str1[] = null;
    }
    $paise = implode('', array_reverse($str1));
    //$paise = ($decimal > 0) ? " and " . ($words[(int)($decimal/10)*10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    $paiseText = ($decimalVal > 0) ? " and " . $paise . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paiseText;
}
