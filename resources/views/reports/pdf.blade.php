<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF Generator</title>

<style>
    body {
        font-family: sans-serif;
        margin: 0;
        padding: 0;
    }

    #invoice {
        /* border: 1px solid #ddd;
        width: 900px;
        margin: auto; */
        width: 100%;
        max-width: 900px;
        margin: auto;
        border: 1px solid transparent;
        padding: 0 20px;
        box-sizing: border-box;
    }

    .header,
    .footer {
        text-align: center;
    }

    .header h1 {
        margin: 0;
    }

    .details,
    .items {
        width: 100%;
        margin-top: 20px;
        padding: 0 30px;
    }

    .details table,
    .items table {
        width: 100%;
        border-collapse: collapse;
    }

    .details td,
    .items td,
    .items th {

        padding: 8px;
        font-size: 14px;
    }

    .items th {
        background-color: #f4f4f4;
    }

    .total {
        text-align: right;
        margin-top: 20px;
    }

    .header .logo {
        width: 100px;
        height: auto;
        padding: 30px;
    }

    .header_imgs {
        width: 50%;
        display: flex;
        justify-content: end;
        align-items: start;
    }

    .header {
        display: flex;
        justify-content: space-between;
        align-items: start;
    }
    .details td strong {
        display: block;
    }

    .note-divider {
        display: flex;
        align-items: center;
        margin: 20px 10px;
        position: relative;
        font-size: 14px;
        color: #555;
        padding: 0 30px;
    }

    .note-divider::after {
        content: "";
        flex: 1;
        height: 1px;
        background: #ddd;

    }

    .note-divider::after {
        margin-left: 10px;
    }

    .details td strong.Invoices_number {
        display: inline;
    }

    .Materialsdetails {
        padding-bottom: 60px;
    }

    .Materialsdetails span {
        font-weight: 500;
    }

    .Materialsdetails td {
        padding: 20px 0;
    }

    .footer_style {
        background: #000;
        width: 100%;
        height: 50px;
        position: relative;
    }

    .footer_details_sec {
        background-color: #1f80c5;
        width: 70%;
        padding: 30px;
        position: absolute;
        bottom: 0;
        left: 0;
        border-top-right-radius: 5rem;
    }

    .footer_details_sec td {
        font-size: 12px;
        color: #fff;
        font-weight: 500;
    }

</style>
</head>

<body>
    <div id="invoice">
        <div class="header">
           <img class="logo" src="{{public_path('assets/image/logo.jpg')}}" alt="no found" style="margin-right: 150px">
           <img class="header_imgs" src="{{public_path('assets/image/logo-head.jpg')}}" alt="no found">
        </div>

        <div class="details">
            <table>

                <tr>
                    <td>
                        <strong class="Invoices_number">Invoices No #</strong> {{ $report->sr_number ?? '' }}
                        <br>
                        <br>
                        <br>
                    </td>
                    <td>

                    </td>
                    <td>

                    </td>

                </tr>
                <tr>
                    <td>
                        <strong>Customer Name #: </strong>
                        <span>
                            {{ $report->client ?? '' }}
                        </span>
                    </td>
                    <td>
                        <strong>Time Entry</strong>
                        <span>
                            @if(isset($report->time_in))
                                {{ \Carbon\Carbon::parse($report->time_in)->format('h:i A') ?? ''}}
                            @else

                            @endif
                        </span>
                    </td>
                    <td>
                        <strong>Date </strong>
                        <span>
                            {{-- {{ \Carbon\Carbon::parse($report->created_at)->format('M ') ?? ''}} --}}
                            {{ \Carbon\Carbon::parse($report->created_at)->format('l d F Y') ?? ''}}
                        </span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <strong> Driver Name </strong>
                        <span>
                            {{ $report->driver ?? '' }}
                        </span>
                    </td>
                    <td>
                        <strong>Time Out</strong>
                        <span>
                            {{-- {{ $report->time_out ?? '' }} --}}
                            @if(isset($report->time_out))
                                {{ \Carbon\Carbon::parse($report->time_out)->format('h:i A') ?? ''}}
                            @else

                            @endif
                        </span>
                    </td>
                    <td>
                        <strong> Date </strong>
                        <span>
                            {{-- {{ $report->created_at ?? '' }} --}}
                            {{ \Carbon\Carbon::parse($report->created_at)->format('l d F Y') ?? ''}}
                        </span>
                    </td>

                </tr>
                <tr>
                    <td>
                        <strong>Car No </strong>
                        <span>
                            {{ $report->car_number ?? '' }}
                        </span>
                    </td>
                    <td>
                        <strong> First Weight</strong>
                        <span>
                            {{ $report->minimum_weight ?? '' }}Kg
                        </span>
                    </td>
                    <td>

                    </td>

                </tr>
                <tr>
                    <td>
                        <strong> Driver Name </strong>
                        <span>
                            {{ $report->driver ?? '' }}
                        </span>
                    </td>
                    <td>
                        <strong> Second Weight</strong>
                        <span>
                            {{ $report->maximum_weight ?? '' }}Kg
                        </span>
                    </td>
                    <td>

                    </td>

                </tr>
                <tr>
                    <td>
                        <strong> Driver Signature </strong>
                        <span>

                        </span>
                    </td>
                    <td>
                        <strong> Net Weight</strong>
                        <span>
                            {{ $report->average_weight ?? '' }}Kg
                        </span>
                    </td>
                    <td>

                    </td>

                </tr>
                <tr>
                    <td>
                        <strong> Officer The Balence </strong>
                        <span>

                        </span>
                    </td>
                    <td>
                        <strong> Units</strong>
                        <span>
                            {{ $report->unit ?? '' }}
                        </span>
                    </td>
                    <td>

                    </td>

                </tr>

            </table>
        </div>
        <hr>
        <div class="note-divider" style="text-align:center">Note: </div>
        <div class="details Materialsdetails">
            <table>
                <tr>
                    <td>
                        <span>Type of Materials</span>
                        <span>
                            {{-- {{ $report->type_of_meterails ?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span>Transporter ticket No</span>
                        <span>
                            {{-- {{ $report->transporter_ticket_number?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span>Treatment Method </span>
                        <span>
                            {{-- {{ $report->treatment_method ?? '' }} --}}
                        </span>
                    </td>

                </tr>
                {{-- <tr>
                    <td>
                        <span>
                            {{ $report->type_of_meterails ?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->transporter_ticket_number?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->treatment_method ?? '' }}
                        </span>
                    </td>

                </tr> --}}
                <tr>
                    <td>
                        <span> Contract No </span>
                        <span>
                            {{-- {{ $report->contract_number ?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span>Disp. Ticket No</span>
                        <span>
                            {{-- {{ $report->disp_ticket_number ?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span> Dispossal Company </span>
                        <span>
                            {{-- {{ $report->disposal_company ?? '' }} --}}
                        </span>

                    </td>

                </tr>
                {{-- <tr>
                    <td>
                        <span>
                            {{ $report->contract_number ?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->disp_ticket_number ?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->disposal_company ?? '' }}
                        </span>

                    </td>

                </tr> --}}
                <tr>
                    <td>
                        <span> Properties Code</span>
                        <span>
                            {{-- {{ $report->properties_code ?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span> Dispossal Method</span>
                        <span>
                            {{-- {{ $report->disposal_method ?? '' }} --}}
                        </span>

                    </td>
                    <td>
                        <span> Dispossal Treatment</span>
                        <span>
                            {{-- {{ $report->disposal_treatment ?? '' }} --}}
                        </span>

                    </td>

                </tr>
                {{-- <tr>
                    <td>
                        <span>
                            {{ $report->properties_code ?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->disposal_method ?? '' }}
                        </span>

                    </td>
                    <td>
                        <span>
                            {{ $report->disposal_treatment ?? '' }}
                        </span>

                    </td>

                </tr> --}}
                <tr>
                    <td>
                        <span> Recycle , Resume Method</span>

                    </td>
                    <td>
                        <span> Waste Code</span>

                    </td>
                    <td>
                        <span>Date</span>

                    </td>

                </tr>


            </table>
        </div>



        <div class="footer_style">
            <div class="footer_details_sec">
                <table>
                    <tr>
                        <td>CR. 2052103508-Tel: 013 8308088-Fax: 013 8308087-P.O. Box 20019 Al-Khobar 31952-Saudi Arabia
                        </td>
                    </tr>
                </table>

            </div>

        </div>


    </div>
</body>

</html>
