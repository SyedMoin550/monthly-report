<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice PDF Generator</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap"
        rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"
        integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
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
        }

        th {
            color: #3c3180;
            font-size: 14px;
            height: 25px;
            font-weight: 600;
        }

        td {
            text-align: left;
            color: #3c3180;
            text-align: center;
            height: 25px;
            font-size: 14px;
        }

        .logo {
            text-align: center;

            height: 50px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .logo img {
            height: 50px;
            max-width: 100px;
        }

        .logo22 {
            text-align: center;
            display: flex;
            justify-content: center;
            height: 50px;
            align-items: center;
        }

        .logo22 img {
            height: 50px;
            width: auto;
            max-width: 100%;
            object-fit: contain;
        }
    </style>



</head>

<body>
    <a href="#" class="" id="print-invoice" style="visibility: hidden">print</a>

    <div class="invoice-container" id="invoice-container">
        <div style="overflow-x: auto">
            <table>
                <tbody>
                    <tr>
                        <td colspan="1">
                            <div class="logo"></div>
                        </td>
                        <td colspan="4">
                            <div class="logo22"></div>
                        </td>
                    </tr>
                    <tr>
                        <th style="width: 202px"></th>
                        <th style="width: 321px"></th>
                        <th style="width: 218px"></th>
                        <th style="width: 218px"></th>
                        <th style="width: 218px"></th>
                    </tr>

                    <tr>
                        <td>{{ $report->sr_number ?? '' }}</td>
                        <td>{{ $report->client ?? '' }}</td>
                        <td>{{ \Carbon\Carbon::parse($report->created_at)->format('l d F Y') ?? ''}}</td>
                        <td>{{ $report->manifest ?? ''}}</td>
                        <td>{{ $report->minimum_weight ?? ''}}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td></td>
                        <td></td>
                        <td>{{ \Carbon\Carbon::parse($report->time_in)->format('h:i A') ?? ''}}</td>
                        <td>{{ \Carbon\Carbon::parse($report->time_out)->format('h:i A') ?? ''}}</td>
                        <td>{{ $report->maximum_weight ?? ''}}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>dsd</td>
                        <td>{{ $report->unit ?? ''}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="2"></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td></td>
                        <td></td>
                        <td>{{ $report->average_weight ?? ''}}</td>
                    </tr>
                    <tr>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                    <tr>
                        <td>dsd</td>
                        <td>{{ $report->driver ?? ''}}</td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr>
                        <th colspan="5">Remarks/Comments</th>
                    </tr>
                    <tr>
                        <td colspan="5"></td>
                    </tr>
                    <tr>
                        <th>Operator Code</th>
                        <th colspan="2">Weighbridge Operator</th>
                        <th colspan="2">Operator Signature</th>
                    </tr>
                    <tr>
                        <td></td>
                        <td colspan="2"></td>
                        <td colspan="2"></td>
                    </tr>
                    <!-- Add more rows as needed -->
                </tbody>
            </table>
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
                                }

                                th {
                                    color: #3c3180;
                                    font-size: 14px;
                                    height: 25px;
                                    font-weight: 600;
                                }

                                td {
                                    text-align: left;
                                    color: #3c3180;
                                    text-align: center;
                                    height: 25px;
                                    font-size: 14px;
                                }

                                .logo {
                                    text-align: center;

                                    height: 50px;
                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                }

                                .logo img {
                                    height: 50px;
                                    max-width: 100px;
                                }

                                .logo22 {
                                    text-align: center;
                                    display: flex;
                                    justify-content: center;
                                    height: 50px;
                                    align-items: center;
                                }

                                .logo22 img {
                                    height: 50px;
                                    width: auto;
                                    max-width: 100%;
                                    object-fit: contain;
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
                printWindow.onafterprint = function() {
                    printWindow.close();
                };
            });

            $('#print-invoice').trigger('click');
        });
    </script>
</body>

</html>
