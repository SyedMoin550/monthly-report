@extends('layouts.app')

@push('styles')
{{-- <link href="{{ asset('back/assets/js/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" /> --}}
{{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css" /> --}}

@endpush

@section('content')


<div class=" mx-4 my-5">

    <div class="container-fluid pt-4 mb-5">
        <div class="border-bottom">
            <h3 class="all-adjustment text-center pb-2 mb-0">Monthly Report</h3>
        </div>
        @if (session('success'))
            <div class="mt-2 alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> {{ session('success') }}.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            @if (is_array(session('error')))
                {{-- If the error is an array, loop through it --}}
                @foreach (session('error') as $error)
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $error }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                            aria-label="Close"></button>
                    </div>
                @endforeach
            @else
                {{-- If the error is a string, display it normally --}}
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error!</strong> {{ session('error') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        @endif

        @if (count($errors) > 0)
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Whoops!</strong> There were some problems with your input.<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 card-shadow rounded-3 p-2 mt-4">
            <div class="card-header border-0 bg-white">

                <div class="row my-3">
                    <div class="col-md-3 col-12 mt-2">
                        <form action="#" method="GET" class="d-flex ">
                            <div class="input-search position-relative">
                                <input type="text" placeholder="Search Record" class="form-control rounded-3 subheading" id="custom-filter" name="search"
                                    value="" />
                                <span class="fa fa-search search-icon text-secondary"></span>
                            </div>
                        </form>
                    </div>

                    <div class="col-md-9 col-12 text-end">
                        <a href="" class="btn import-customer-btn rounded-3 mt-2" data-bs-toggle="modal"
                            data-bs-target="#importfilemodal">
                            Import File
                        </a>
                        {{-- <a href="#" class="btn pdf rounded-3 mt-2" id="download-pdf">Pdf <i
                                class="bi bi-file-earmark"></i>
                        </a> --}}
                        <a href="{{route('reports.create')}}" class="btn create-btn rounded-3 mt-2">Add Record <i class="bi bi-plus-lg"></i>
                        </a>

                    </div>
                </div>
            </div>
            <div class="table-responsive">
                <div class="alert alert-danger p-2 text-end" id="deletedAlert" style="display: none">
                    <div style="display: flex;justify-content:space-between">
                        <span><span id="deleteRowCount">0</span> rows selected</span>
                        <button class="btn btn-sm btn-danger" id="deleteRowTrigger">Delete</button>
                    </div>
                </div>
                <table class="table " id="example">
                    <thead class="fw-bold">
                        <tr>
                            <th class="text-secondary">SR#</th>
                            <th class="text-secondary">Receiving Date</th>
                            <th class="text-secondary">Truck</th>
                            <th class="text-secondary">Driver</th>
                            <th class="text-secondary">Manifest</th>
                            <th class="text-secondary">Unit</th>
                            <th class="text-secondary">Quantity</th>
                            <th class="text-secondary">Minimum Weight</th>
                            <th class="text-secondary">Maximum Weight</th>
                            <th class="text-secondary">Average Weight</th>
                            <th class="text-secondary">Time In</th>
                            <th class="text-secondary">Time Out</th>
                            <th class="text-secondary">Waste Type</th>
                            <th class="text-secondary">Location</th>
                            <th class="text-secondary">Client</th>
                            <th class="text-secondary">Dumping</th>
                            <th class="text-secondary">Unit Price</th>
                            <th class="text-secondary">Other Charges</th>
                            <th class="text-secondary">Payment Status</th>
                            <th class="text-secondary">Baverage Of Printer</th>
                            <th class="text-secondary">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reportData as $data)
                            <tr>
                                <td class="align-middle">{{ $data->sr_number ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->receiving_date ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->truck ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->driver ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->manifest ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->unit ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->quantity ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->minimum_weight ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->maximum_weight ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->average_weight ?? 'N/A' }}</td>
                                <td class="align-middle">
                                    @if(isset($data->time_in))
                                        {{\Carbon\Carbon::parse($data->time_in)->format('h:i A') ?? 'N/A'}}
                                    @else

                                    @endif
                                </td>
                                {{-- <td class="align-middle">{{ $data->time_out ?? 'N/A' }}</td> --}}
                                <td class="align-middle">
                                    @if(isset($data->time_out))
                                        {{\Carbon\Carbon::parse($data->time_out)->format('h:i A') ?? 'N/A'}}
                                    @else

                                    @endif
                                </td>

                                <td class="align-middle">{{ $data->waste_type ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->location ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->client ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->dumping ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->unit_price ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->other_charges ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->payment_status ?? 'N/A' }}</td>
                                <td class="align-middle">{{ $data->baverage_of_printer ?? 'N/A' }}</td>
                                <td class="align-middle">
                                    <div class="">
                                        <a class="btn btn-secondary bg-transparent border-0 text-dark" role="button"
                                        id="dropdownMenuLink" data-bs-toggle="dropdown" aria-haspopup="true"
                                        aria-expanded="false">
                                        <i class="fa-solid fa-ellipsis-v"></i>
                                    </a>
                                    <div class="dropdown-menu " aria-labelledby="dropdownMenuLink">

                                        <a class="dropdown-item"
                                            href="{{ route('reports.download', $data->id) }}" target="_blank">
                                            <img src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-1" alt="" />
                                            Print
                                        </a>
                                        <a class="dropdown-item"
                                            href="{{ route('reports.edit', $data->id) }}">
                                            <img src="{{ asset('assets/dasheets/img/menu.svg') }}" class="img-fluid me-1" alt="" />
                                            Edit Record
                                        </a>
                                        <form class=""
                                            action="{{ route('reports.destroy', $data->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="dropdown-item confirm-text" onclick="return confirm('Are you sure to delete this record?')">
                                                <img src="{{ asset('assets/dasheets/img/menu.svg') }}"
                                                    class="img-fluid me-1" alt="">
                                                Delete Record
                                            </button>
                                        </form>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer bg-white border-0 rounded-3">
                <div class="d-flex justify-content-between p-0">
                    <div class="row align-items-center">
                        <div class="col-auto">
                            <label for="rowsPerPage" class="col-form-label">Rows per page:</label>
                        </div>
                        <div class="col-auto">
                            <select id="rowsPerPage" class="form-select border-0">
                                <option value="3" selected>3</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                            </select>
                        </div>
                    </div>
                    <div class="row align-items-center text-end">
                        <div class="col-auto">
                            <p class="subheading col-form-label " id="dataTableInfo">

                            </p>
                        </div>
                        <div class="col-auto">
                            <div class="new-pagination">
                                <a class="rounded-start paginate_button" style="cursor: pointer"> ❮ </a>
                                <a class="rounded-end paginate_button page-item next" style="cursor: pointer"> ❯
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>


<div class="modal fade" id="importfilemodal" tabindex="-1" aria-labelledby="importfilemodalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="{{ route('import-report') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title modal_header_import d-flex align-items-center" id="importfilemodalLabel">
                        <span class="me-1">
                            <i class="far fa-file-alt"></i>
                        </span>
                        Import a file
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="file_upload_modal">

                        <div class="input-group mb-3">
                            <label class="input-group-text" for="inputGroupFile01">

                                <div class="icons">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                </div>
                                <div class="click">
                                    <span class="button">Click to upload</span>
                                    <span>or drag and drop</span>
                                </div>
                                <span class="max_span ">.xlsx(max 100Mb)</span>

                            </label>
                            <input type="file" name="file" class="form-control" id="inputGroupFile01">
                        </div>

                        <div class="upload_field d-none">
                            <div><i class="fas fa-file-download"></i></div>
                            <div>
                                <p>Upload failed, please try again</p>
                                <span>Vendor_List.xlsx</span>
                                <p>Try again</p>
                            </div>

                        </div>
                        <ul class="">
                            <li class="error">
                                <span><i class="fas fa-info-circle"></i></span>
                                <span> File format should be like sample file. <br> * fields are mandatory
                                    <a href="{{ asset('sample-files/report.xlsx') }}" class="text-primary" download>Download sample file</a>
                                </span>
                            </li>
                        </ul>
                        <ul class="d-none">
                            <li class="error">
                                <span><i class="fas fa-times"></i></span>
                                <span>File Must be less then 100 MB </span>
                            </li>
                            <li class="">
                                <span><i class="fas fa-check"></i></span>
                                <span> File format should be: xlsx</span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="modal-footer justify-content-lg-between ">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary theme_btn_blue"><i
                            class="fas fa-paper-plane me-1"></i>Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection


@push('scripts')


    <script>

        $(document).ready(function() {

            var table = $('#example').DataTable({
                dom: 'Bfrtip',
                order: false,
                buttons: [
                    {
                        extend: 'pdfHtml5',
                        footer: true,
                        exportOptions: {
                            columns: [0, 1, 2, 3, 4, 5, 6, 7, 8,9,10,11,12,13,14,15,16,17,18]
                        }
                    },
                    // {
                    //     extend: 'csv',
                    //     footer: false,
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    //     }

                    // },
                    // {
                    //     extend: 'excel',
                    //     footer: false,
                    //     exportOptions: {
                    //         columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    //     }
                    // }
                ]
            });


            $('#custom-filter').keyup(function() {
                table.search(this.value).draw();
            });
            $('#download-pdf').on('click', function() {
                table.button('.buttons-pdf').trigger();
                // alert('Pdf Downloaded');
                // download pdf
                // var doc = new jsPDF();
                // doc.autoTable({
                //     html: '#example',
                //     theme: 'grid',
                //     styles: {
                //         overflow: 'linebreak',
                //         fontSize: 8,
                //         cellPadding: 2,
                //         overflowColumns: 'linebreak',
                //         halign: 'left',
                //         valign: 'middle',
                //     },
                //     columnStyles: {
                //         0: {
                //             cellWidth: 10
                //         },
                //         1: {
                //             cellWidth: 20
                //         },
                //         2: {
                //             cellWidth: 20
                //         },
                //         3: {
                //             cellWidth: 20
                //         },
                //         4: {
                //             cellWidth: 20
                //         },
                //         5: {
                //             cellWidth: 20
                //         },
                //         6: {
                //             cellWidth: 20
                //         },
                //         7: {
                //             cellWidth: 20
                //         },
                //         8: {
                //             cellWidth: 20
                //         },
                //         9: {
                //             cellWidth: 20
                //         },
                //         10: {
                //             cellWidth: 20
                //         },
                //         11: {
                //             cellWidth: 20
                //         },
                //         12: {
                //             cellWidth: 20
                //         },
                //         13: {
                //             cellWidth: 20
                //         },
                //         14: {
                //             cellWidth: 20
                //         },
                //         15: {
                //             cellWidth: 20
                //         },
                //         16: {
                //             cellWidth: 20
                //         },
                //         17: {
                //             cellWidth: 20
                //         },
                //         18: {
                //             cellWidth: 20
                //         },
                //     },
                //     margin: {
                //         top: 20,
                //         right: 10,
                //         bottom: 10,
                //         left: 10
                //     },
                //     addPageContent: function(data) {
                //         doc.text("Monthly Report", 14, 15);
                //     }
                // });
                // console.log(table.button());
            });
            $('#download-excel').on('click', function() {
                table.button('.buttons-excel').trigger();
            });

            // // Custom pagination events
            $('.new-pagination .paginate_button').on('click', function() {
                if ($(this).hasClass('rounded-start')) {
                    table.page('previous').draw('page');
                } else if ($(this).hasClass('rounded-end')) {
                    table.page('next').draw('page');
                }
            });

            // Handle rows per page change
            $('#rowsPerPage').on('change', function() {
                var rowsPerPage = $(this).val();
                table.page.len(rowsPerPage).draw();
            });

            // Update rows per page select on table draw
            table.on('draw', function() {

                var pageInfo = table.page.info();
                var currentPage = pageInfo.page + 1;
                var totalPages = pageInfo.pages;
                var totalRecords = pageInfo.recordsTotal;

                // Calculate start and end records for the current page
                var startRecord = pageInfo.start + 1;
                var endRecord = startRecord + pageInfo.length - 1;
                if (endRecord > totalRecords) {
                    endRecord = totalRecords;
                }

                $('#rowsPerPage').val(table.page.len());
                $('#dataTableInfo').text('Showing ' + startRecord + '-' + endRecord + ' of ' +
                    totalRecords + ' entries');
            });

            table.draw();

        });

        $(document).ready(function() {
            $(".delete-product-form").submit(function() {
                var decision = confirm("Are you sure, You want to Delete this Product?");
                if (decision) {
                    return true;
                }
                return false;
            });
        });
    </script>
@endpush

