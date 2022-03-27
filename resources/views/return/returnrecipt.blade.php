

<a href="{{route('return')}}" class="btn btn-success text-center backBtn">Back</a></br>

<div style="max-width: 800px; width: 100%; margin: 0 auto;">
        <table style="border-collapse: collapse;width: 100%;">
            <tr>
                <td colspan="2" align="center" style="font-size: 20px;">
                    <strong>Rampari Ausadhalaya</strong>
                    <h5>GSTIN NO - 10BCLPK9104P1ZE</h5>
                    <h5>DL NO - 150308/309</h5>
                    <h5>(A Unit of Shree Pradhan Healthcare Pvt Ltd)</h5>
                    <h5>N.H-28, Khabra Muzaffarpur, Bihar-843136</h5>
                    <h5>Email:shreepradhanhospital@gmail.com | Ph. 9199654999</h5>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid;padding: 10px;">
                    <table>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>: <strong>{{$customer->name}} </strong></td>
                        </tr>
                        <tr>
                            <td><strong>Doctor Name:</strong></td>
                            <td>: <strong>{{$customer->doctor_name}}</strong></td>
                        </tr>
                        @if(!empty($customer->ipd_id))
                        <tr>
                            <td><strong>IPD No</strong></td>
                            <td>: <strong>{{$customer->ipd_id}} </strong></td>
                        </tr>
                        @endif
                    </table>
                </td>
                <td style="border: 1px solid;padding: 10px;">
                    <table>
                        <tr>
                            <td><strong>Bill No</strong></td>
                            <td>: <strong>{{$customer->order__id}} </strong></td>
                        </tr>
                        <tr>
                            <td><strong>Bill Date:</strong></td>
                            <td>: <strong>{{date('d-m-Y',strtotime($customer->created_at))}}</strong></td>
                        </tr>
                        <tr>
                            <td><strong>Bill Type</strong></td>
                            <td>: <strong>{{ucwords($customer->sale_type)}} </strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>

            <table style="border-collapse: collapse;width: 100%; border: 1px solid; text-align: center;">+

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
                <td style="text-align: left;">{{$orderitem->medicine_category}}</td>
                <td style="text-align: left;">{{$orderitem->medicine_name}}</td>
                <td>{{$orderitem->price}}</td>
                <td>{{$orderitem->quantity}}</td>
            </tr>
            @endforeach

            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Total Amount :</strong></td>
                <td style="border-top:1px solid;"><strong>{{$totalamt}}</strong></td>
            </tr>
            <?php $discountamt = 0;?>
            @if($customer->discount_amount > 0)
            <?php $discountamt = $customer->discount_amount ?>
            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Discount :</strong></td>
                <td style="border-top:1px solid;"><strong>{{$customer->discount_amount}}</strong></td>
            </tr>
            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Total Amount :</strong></td>
                <td style="border-top:1px solid;"><strong>{{$totalamt - $customer->discount_amount}}</strong></td>
            </tr>
            @endif
            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Paid Amount :</strong></td>
                <td style="border-top:1px solid;"><strong>{{$customer->paid_amount}}</strong></td>
            </tr>
            @if($customer->paid_amount)
            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Change Amount :</strong></td>
                <td style="border-top:1px solid;"><strong>{{$customer->paid_amount - $customer->amount }}</strong></td>
            </tr>
            @endif

        </table>

        <table style="width: 100%;">
            <tr>
                <td style="height: 60px;"></td>
            </tr>
            <tr>
                <td style="text-align: right;">
                Medicines once sold will not be taken back or exchanged.
                </td>
            </tr>
        </table>
        <div>
            <button onclick="window.print()" class="btn no-print btn-lg btn-info">Print <i class="fas fa-print"></i></button>
        </div>
    </div>

