<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" />
        <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: "Open Sans", serif;
            margin: 0;
            padding: 0;
        }

        .invoice-container {
            max-width: 1100px;
            width: 100%;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
            border: 3px solid #3c3180;
        }

        th,
        td {
            border: 1px solid #3c3180;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            color: #3c3180;
            text-align: center;
        }

        .text-right {
            text-align: right;
        }

        .text-center {
            text-align: center;
        }

        input {
            width: 90%;
            padding: 0 10px;
            border: 0;
            outline: 0;
            box-shadow: none;
        }

        .logo {
            text-align: center;

            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            max-width: 100px;
        }

        .logo22 {
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo22 img {
            height: 100px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }

        th {
            background: #f1f0f7;
        }

        .Footer_heading p {
            color: #3c3180;
            font-size: 16px;
            font-weight: 600;
            text-align: center;
        }
    </style>



</head>

<body>
    <a href="#" class="btn pdf rounded-3 mt-2" id="print-invoice" style="visibility: hidden">print <i
        class="bi bi-file-earmark"></i>
    </a>

    <div class="invoice-container" id="invoice-container">
        <div style="overflow-x: auto">
            <table>
                <tbody>
                    <tr>
                        <td colspan="1">
                            <div class="logo">
                                {{-- <img src="{{public_path('assets/image/logo/logo.webp')}}" alt="Company Logo" /> --}}
                                <img src="{{asset('assets/image/logo/logo.webp')}}" alt="Company Logo" />
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="logo22">
                                <img src="{{asset('assets/image/logo/logov2.webp')}}" alt="Company Logo" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <th>Slip No</th>
                        <th>Client Name</th>
                        <th>Date</th>
                        <th>Manifest No.</th>
                        <th>1st Weight (KG)</th>
                    </tr>
                    <tr>
                        <td><input type="text" value="{{ $report->sr_number ?? '' }}" /></td>
                        <td><input type="text" value="{{ $report->client ?? '' }}" /></td>
                        <td><input type="text" value="{{ \Carbon\Carbon::parse($report->created_at)->format('l d F Y') ?? ''}}" /></td>
                        <td><input type="text" value="{{ $report->manifest ?? ''}}" /></td>
                        <td><input type="text" value="{{ $report->minimum_weight ?? ''}}" /></td>
                    </tr>
                    <tr>
                        <th>Waste Code</th>
                        <th>Waste Description</th>
                        <th>Time</th>
                        <th>Time Out</th>
                        <th>2nd Weight (KG)</th>
                    </tr>
                    <tr>
                        <td><input type="text" value="{{ $report->waste_type ?? ''}}" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" value="{{ \Carbon\Carbon::parse($report->time_in)->format('h:i A') ?? ''}}" /></td>
                        <td><input type="text" value="{{ \Carbon\Carbon::parse($report->time_out)->format('h:i A') ?? ''}}" /></td>
                        <td><input type="text" value="{{ $report->maximum_weight ?? ''}}"/></td>
                    </tr>
                    <tr>
                        <th>Transport Code</th>
                        <th>Unit</th>
                        <th>Truck Type</th>
                        <th>Plate No.</th>
                        <th>Deduction</th>
                    </tr>
                    <tr>
                        <td><input type="text"  /></td>
                        <td><input type="text" value="{{ $report->unit ?? ''}}" /></td>
                        <td><input type="text" value="{{ $report->truck ?? ''}}" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <th colspan="2">Delivery Note</th>
                        <th>Density</th>
                        <th>Net Volume</th>
                        <th>Net Weight (KG)</th>
                    </tr>
                    <tr>
                        <td colspan="2"><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" value="{{ $report->average_weight ?? ''}}" /></td>
                    </tr>
                    <tr>
                        <th>Driver Code</th>
                        <th>Driver Name</th>
                        <th>Nationality</th>
                        <th>Iqama/ID No.</th>
                        <th>Driver Signature</th>
                    </tr>
                    <tr>
                        <td><input type="text" /></td>
                        <td><input type="text" value="{{ $report->driver ?? ''}}" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                        <td><input type="text" /></td>
                    </tr>
                    <tr>
                        <th colspan="5">Remarks/Comments</th>
                    </tr>
                    <tr>
                        <td colspan="5"><input type="text" /></td>
                    </tr>
                    <tr>
                        <th>Operator Code</th>
                        <th colspan="2">Weighbridge Operator</th>
                        <th colspan="2">Operator Signature</th>
                    </tr>
                    <tr>
                        <td><input type="text" /></td>
                        <td colspan="2"><input type="text" /></td>
                        <td colspan="2"><input type="text" /></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
        </div>
        <div class="Footer_heading">
            <p>
                CR. 2052103508-Tel: 013 8308088-Fax: 013 8308087-P.O. Box 20019 Al-Khobar 31952-Saudi Arabia
            </p>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            $('#print-invoice').click(function() {
                var printContents = document.getElementById('invoice-container').innerHTML;

                // Open a new window for printing
                var printWindow = window.open('', '', 'height=600,width=800');

                printWindow.document.write(`
                    <html>
                        <head>
                            <title>Print Invoice</title>
                            <style>
                                body {
                                    font-family: "Open Sans", serif;
                                    margin: 0;
                                    padding: 0;
                                }

                                .invoice-container {
                                    max-width: 1100px;
                                    width: 100%;
                                    margin: auto;
                                }

                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                    margin-bottom: 20px;
                                    border: 3px solid #3c3180;
                                }

                                th,
                                td {
                                    border: 1px solid #3c3180;
                                }

                                th,
                                td {
                                    padding: 10px;
                                    text-align: left;
                                    color: #3c3180;
                                    text-align: center;
                                }

                                .text-right {
                                    text-align: right;
                                }

                                .text-center {
                                    text-align: center;
                                }

                                input {
                                    width: 90%;
                                    padding: 0 10px;
                                    border: 0;
                                    outline: 0;
                                    box-shadow: none;
                                }

                                .logo {
                                    text-align: center;

                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                }

                                .logo img {
                                    max-width: 100px;
                                }

                                .logo22 {
                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                }

                                .logo22 img {
                                    height: 100px;
                                    width: auto;
                                    max-width: 100%;
                                    object-fit: contain;
                                }

                                th {
                                    background: #f1f0f7;
                                }

                                .Footer_heading p {
                                    color: #3c3180;
                                    font-size: 16px;
                                    font-weight: 600;
                                    text-align: center;
                                }
                            </style>

                        </head>
                        <body>
                            ${printContents}
                        </body>
                    </html>
                `);

                // Close the document to ensure the content is loaded
                printWindow.document.close();

                // Print the content
                printWindow.print();

                // Close the window after printing (optional)
                printWindow.onafterprint = function () {
                    printWindow.close();
                };
            });

            $('#print-invoice').trigger('click');
        });
    </script>
</body>

</html>
