<!DOCTYPE html>
<html lang="en">
  <head>
    <title> </title>
    <meta charset="UTF-8" />
    <style>
      td {
        vertical-align: top;
        padding: 5px;
      }

      td td {
        padding: 0;
      }
      @media print {
        #printPageButton {
            display: none;
        }
        #backButton {
            display: none;
        }
      }
    </style>
  </head>

  <body style="font-size: 14px; font-family: arial;">
  <?php

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

?>
<a href="{{route('addorder')}}" id="backButton" class="btn btn-success text-center backBtn">Back</a></br>
    <div style="max-width: 800px; width: 100%; margin: 0 auto;">
      <table style="border-collapse: collapse;width: 100%;">
        <tr>
          <td colspan="2" align="center" style="font-size: 30px;">
            <strong>Rampari Ausadhalaya</strong>
            <h5 style="font-size: 15px;margin-top: 3px;">GSTIN NO - 10BCLPK9104P1ZE</h5>
            <h5 style="font-size: 15px;margin-top: -15px;">DL NO - 150308/309</h5>
            <h5 style="font-size: 15px;margin-top: -15px;">(A Unit of Shree Pradhan Healthcare Pvt Ltd)</h5>
            <h5 style="font-size: 15px;margin-top: -15px;">N.H-28, Khabra Muzaffarpur, Bihar-843136</h5>
            <h5 style="font-size: 15px;margin-top: -15px;">Email:shreepradhanhospital@gmail.com | Ph. 9199654999</h5>
          </td>
        </tr>
        <tr>
          <td style="border: 1px solid;">
            <table>
              <tr>
                <td><strong>Customer Name</strong></td>
                <td>: <strong>{{$customer->name}}</strong></td>
              </tr>

              <!-- <tr>
                <td><strong>Mobile No.</strong></td>
                <td>: +91 9948473495</td>
              </tr> -->

              <!-- <tr>
                <td><strong>Doctor Name</strong></td>
                <td>: {{$customer->doctor_name}}</td>
              </tr> -->
              @if(!empty($customer->ipd_id))
                <tr>
                    <td><strong>IPD No</strong></td>
                    <td>: <strong>{{$customer->ipd_id}} </strong></td>
                </tr>
              @endif
              <tr>
                <td><strong>Bill Date:</strong></td>
                <td>: <strong>{{date('d-m-Y',strtotime($customer->created_at))}}</strong></td>
              </tr>
            </table>
          </td>
          <td  style="border: 1px solid;">
            <table>
            <tr>
                <td><strong>Doctor Name</strong></td>
                <td>: {{$customer->doctor_name}} </td>
              </tr>
              <tr>
                <td><strong>Bill No</strong></td>
                <td>: {{$customer->order__id}} </td>
              </tr>
              <tr>
                <td><strong>Bill Type</strong></td>
                <td>: {{ucwords($customer->sale_type)}} </td>
              </tr>
            </table>
          </td>
        </tr>
      </table>

      <table style="border-collapse: collapse;width: 100%; border: 1px solid; text-align: center;">
        <tr>
          <td style="border-bottom: 1px solid;"><strong>S.No.</strong></td>
          <td style="border-bottom: 1px solid;"><strong>Medicine Category</strong></td>
          <td style="border-bottom: 1px solid;"><strong>Medicine Name</strong></td>
          <td style="border-bottom: 1px solid;"><strong>Price</strong></td>
          <td style="border-bottom: 1px solid;"><strong>Quantity</strong></td>
        </tr>
        <?php $count=1; $totalamt = 0.0; ?>
        @foreach($orderitems as $orderitem)
        <?php $totalamt += $orderitem->total_amount; ?>
        <tr>
          <td>{{$count++}}</td>
          <td style="text-align: leftt;">
            {{$orderitem->medicine_category}}
            <!-- <div>Bed Room Charges/ General Room</div> -->
          </td>
          <td>{{$orderitem->medicine_name}}</td>
          <td>{{round($orderitem->price)}}</td>
          <td>{{$orderitem->quantity}}</td>
        </tr>
        @endforeach
        <tr>
          <td colspan="3" rowspan="4" style="border-top:1px solid; text-align: left;">
            <!-- <div><strong style="border-bottom: 1px solid;">Receipt Details :</strong></div>
           <div style="padding-top: 10px;">Dr. xyz kumar yadav</div>getIndianCurrency
           <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div> -->
          </td>

          <td style="border-top:1px solid;">Total Amount :</td>
          <td style="border-top:1px solid;">{{round($totalamt)}}</td>
        </tr>
        <?php $discountamt = 0;?>
        @if($customer->discount_amount > 0)
        <?php $discountamt = $customer->discount_amount ?>
          <tr>
            <td>Discount: </td>
          <td>{{$customer->discount_amount}}</td>
        </tr>
        <?php $returnamt = 0; $returnamt = $customer->paid_amount - $customer->amount; ?>
        <tr>
          <td>Total Amount : </td>
          <td>{{$totalamt - $customer->discount_amount}}</td>
        </tr>
        @endif
        <tr>
          <td>Paid Amount :</td>
          <td>{{$customer->paid_amount}}</td>
        </tr>
        <tr>
          <td>Change Amount :</td>
          <td>{{round($customer->paid_amount - $customer->amount)}}</td>
        </tr>
        <tr>
          <td style="border-top:1px solid;">In Words :</td>
          <td style="border-top:1px solid;">{{getIndianCurrency(round($totalamt))}}</td>
        </tr>
      </table>

      <table style="width: 100%;">
        <tr>
          <td style="height: 60px;"></td>
        </tr>
        <tr>

          <!-- <td style="text-align: right;">
            (Authorized Signatory)
          </td> -->
        </tr>
      </table>
	  <div>
	  <input type="button" id="printPageButton" value="Print this page" onClick="window.print()">
      </div>
	</div>
  </body>
</html>
