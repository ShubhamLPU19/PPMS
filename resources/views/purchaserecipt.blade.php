@extends('layouts.app')

@section('content')

<div style="max-width: 800px; width: 100%; margin: 0 auto;">
        <table style="border-collapse: collapse;width: 100%;">
            <tr>
                <td colspan="2" align="center" style="font-size: 30px;">
                    <strong>Shree Pradhan Healthcare private limited</strong>
                    <h5>Reg. Off-At -Khabra P.S-Sadar,Musahari, Muzaffarpur Bihar PIN-842001</h5>
                    <h5>CIN-U85110BR2020PTCO47423</h5>
                    <h5>Email:shreepradhanhospital@gmail.com | Ph. 9199654999</h5>
                    <h5><strong>Discharge Receipt</strong></h5>
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid;padding: 10px;">
                    <table>
                        <tr>
                            <td><strong>Name</strong></td>
                            <td>: <strong> </strong></td>
                        </tr>
                        <tr>
                            <td><strong>Age & Gender</strong></td>
                            <td>: <strong> <span style="padding-left: 10px;"></span></strong></td>
                        </tr>
                        <tr>
                            <td><strong>Guardian Name</strong></td>
                            <td>: <strong> </strong></td>
                        </tr>

                        <tr>
                            <td><strong>Address</strong></td>
                            <td>: </td>
                        </tr>

                        <tr>
                            <td><strong>Mobile No.</strong></td>
                            <td>: </td>
                        </tr>

                        <tr>
                            <td><strong>Consultant Name</strong></td>
                            <td>: DR. </td>
                        </tr>
                    </table>
                </td>
                <td style="border: 1px solid;padding: 10px;">                    <table>
                        <tr>
                            <td><strong>Bill No.</strong></td>
                            <td>: </td>
                        </tr>
                        <tr>
                            <td><strong>IPD</strong></td>
                            <td>:</td>
                        </tr>

                        <tr>

                            <td><strong>Bill Date</strong></td>
                            <td>: </td>
{{--                            <td>: </td>--}}
                        </tr>

                        <tr>
                            <td>UHID No.</td>
                            <td>: <strong></strong></td>
                        </tr>

                        <tr>
                            <td><strong>DOA</strong></td>
                            <td>: </td>
                        </tr>

                        <tr>
                            <td><strong>DOD</strong></td>
                            <td>: </td>
                        </tr>

                    </table>
                </td>
            </tr>
        </table>

        <table style="border-collapse: collapse;width: 100%; border: 1px solid; text-align: center;">+

            <tr>
                <td style="border-bottom: 1px solid;"><strong>S.No.</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Date</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Description</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Rate</strong></td>
                <td style="border-bottom: 1px solid;"><strong>QTY.</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Amount</strong></td>
            </tr>


                <tr>
                    <td>
                    </td>
                    <td style="text-align: left;">
                        <?php //echo date('d/m/Y',strtotime($service_name['date'][$k])); ?>
                    </td>
                    <td style="text-align: left;">
                        <?php //echo $service_name['desc'][$k]; ?>
                    </td>
                    <td>
                            <?php //echo $service_name['rate'][$k]; ?>
                    </td>
                    <td>
                        <?php //echo $service_name['unit'][$k]; ?>
                    </td>

                    <td>
                        <?php //echo $service_name['amount'][$k]; ?>
                    </td>
                </tr>

           <?php //$amount = 0; ?>

            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Total Amount :</strong></td>
                <td style="border-top:1px solid;"><strong></strong></td>
            </tr>

                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Less Discount :</strong></td>
                <td style="border-top:1px solid;"><strong></strong></td>
            </tr>

{{--            <tr>--}}
{{--                <td>Discount: </td>--}}
{{--                <td>6457</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td><strong>Net Amount : </strong></td>--}}
{{--                <td>432432</td>--}}
{{--            </tr>--}}
{{--            <tr>--}}
{{--                <td>Payment Recd</td>--}}
{{--                <td>43243</td>--}}
{{--            </tr>--}}
        </table>

            <table style="border-collapse: collapse;width: 100%; border: 1px solid; text-align: center;">+

            <tr>
                <td style="border-bottom: 1px solid;"><strong>S.No.</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Payment Date</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Payment Type</strong></td>
                <td style="border-bottom: 1px solid;"><strong>Paid Amount</strong></td>
            </tr>

                <tr>
                    <td>}
                    </td>
                    <td style="text-align: left;">
                        <?php //echo date('d/m/Y',strtotime($payment->payment_date)); ?>
                    </td>
                    <td style="text-align: left;">

                    </td>
                    <?php //$paidsum+= $payment->paid_amount; ?>
                    <td>

                    </td>
                </tr>

            <tr>
                <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                    <div><strong style="border-bottom: 1px solid;"></strong></div>
                    <div style="padding-top: 10px;"></div>
{{--                    <div style="max-width: 80%; padding-top: 10px;">dslajf ldsajf; jasl;f jlksa jfdjdsaf lkjdsa f;lkdsajf ;jdsaf ;lks jfda;sjaf;l dsaf</div>--}}
                </td>

                <td style="border-top:1px solid;"><strong>Total Paid Amount :</strong></td>
                <td style="border-top:1px solid;"><strong></strong></td>
            </tr>


        </table>


        <tr>
            <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                <div><strong style="border-bottom: 1px solid;"></strong></div>
                <div style="padding-top: 10px;"></div>
            </td>

            <td style="border-top:1px solid;"><strong>Less Discount :</strong></td>
            <td style="border-top:1px solid;"><strong></strong></td>
        </tr>

         <tr>
            <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                <div><strong style="border-bottom: 1px solid;"></strong></div>
                <div style="padding-top: 10px;"></div>
            </td>
            <td colspan="3" rowspan="1" style="border-top:1px solid; text-align: left;">
                <div><strong style="border-bottom: 1px solid;"></strong></div>
                <div style="padding-top: 10px;"></div>
            </td>
            <td></td>
            <td></td>

            <td style="border-top:1px solid;"><strong>Total Amount :</strong></td>
            <td style="border-top:1px solid;"><strong></strong></td>
        </tr>

        <table style="width: 100%;">
            <tr>
                <td style="height: 60px;"></td>
            </tr>
            <tr>

                <td style="text-align: right;">
                    (Authorized Signatory)
                </td>
            </tr>
        </table>
        <div>
            <button onclick="window.print()" class="btn no-print btn-lg btn-info">Print <i class="fas fa-print"></i></button>
        </div>
    </div>
@endsection
