@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between">
                <h4>Edit Record</h4>
                <a href="{{route('home')}}" class="btn btn-dark">Back</a>
            </div>
        </div>
        <div class="card-body">
            <form action="{{ route('reports.update', $record->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- For updating the record -->

                <!-- Row 1 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="sr_number" class="form-label">SR Number</label>
                        <input type="text" name="sr_number" id="sr_number" class="form-control" value="{{ old('sr_number', $record->sr_number) }}" placeholder="Enter SR Number">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="receiving_date" class="form-label">Receiving Date</label>
                        <input type="date" name="receiving_date" id="receiving_date" class="form-control" value="{{ old('receiving_date', $record->receiving_date) }}">
                    </div>
                </div>

                <!-- Row 2 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="truck" class="form-label">Truck</label>
                        <input type="text" name="truck" id="truck" class="form-control" value="{{ old('truck', $record->truck) }}" placeholder="Enter Truck Number">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="driver" class="form-label">Driver</label>
                        <input type="text" name="driver" id="driver" class="form-control" value="{{ old('driver', $record->driver) }}" placeholder="Enter Driver Name">
                    </div>
                </div>

                <!-- Row 3 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="manifest" class="form-label">Manifest</label>
                        <input type="text" name="manifest" id="manifest" class="form-control" value="{{ old('manifest', $record->manifest) }}" placeholder="Enter Manifest">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" name="unit" id="unit" class="form-control" value="{{ old('unit', $record->unit) }}" placeholder="Enter Unit">
                    </div>
                </div>

                <!-- Row 4 -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="quantity" class="form-label">Quantity</label>
                        <input type="number" name="quantity" id="quantity" class="form-control" value="{{ old('quantity', $record->quantity) }}" placeholder="Enter Quantity">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="minimum_weight" class="form-label">Minimum Weight</label>
                        <input type="number" name="minimum_weight" id="minimum_weight" step="0.01" class="form-control" value="{{ old('minimum_weight', $record->minimum_weight) }}" placeholder="Enter Minimum Weight">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="maximum_weight" class="form-label">Maximum Weight</label>
                        <input type="number" name="maximum_weight" id="maximum_weight" step="0.01" class="form-control" value="{{ old('maximum_weight', $record->maximum_weight) }}" placeholder="Enter Maximum Weight">
                    </div>
                </div>

                <!-- Row 5 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="time_in" class="form-label">Time In</label>
                        <input type="time" name="time_in" id="time_in" class="form-control" value="{{ old('time_in', $record->time_in) }}">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="time_out" class="form-label">Time Out</label>
                        <input type="time" name="time_out" id="time_out" class="form-control" value="{{ old('time_out', $record->time_out) }}">
                    </div>
                </div>

                <!-- Row 6 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="waste_type" class="form-label">Waste Type</label>
                        <input type="text" name="waste_type" id="waste_type" class="form-control" value="{{ old('waste_type', $record->waste_type) }}" placeholder="Enter Waste Type">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="location" class="form-label">Location</label>
                        <input type="text" name="location" id="location" class="form-control" value="{{ old('location', $record->location) }}" placeholder="Enter Location">
                    </div>
                </div>

                <!-- Row 7 -->
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="client" class="form-label">Client</label>
                        <input type="text" name="client" id="client" class="form-control" value="{{ old('client', $record->client) }}" placeholder="Enter Client Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="dumping" class="form-label">Dumping</label>
                        <input type="text" name="dumping" id="dumping" class="form-control" value="{{ old('dumping', $record->dumping) }}" placeholder="Enter Dumping">
                    </div>
                </div>

                <!-- Other Fields -->
                <div class="row">
                    <div class="col-md-4 mb-3">
                        <label for="unit_price" class="form-label">Unit Price</label>
                        <input type="text" name="unit_price" id="unit_price" class="form-control" value="{{ old('unit_price', $record->unit_price) }}" placeholder="Enter Unit Price">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="other_charges" class="form-label">Other Charges</label>
                        <input type="number" name="other_charges" id="other_charges" step="0.01" class="form-control" value="{{ old('other_charges', $record->other_charges) }}" placeholder="Enter Other Charges">
                    </div>
                    <div class="col-md-4 mb-3">
                        <label for="payment_status" class="form-label">Payment Status</label>
                        <select name="payment_status" id="payment_status" class="form-control">
                            <option value="">Select Payment Status</option>
                            <option value="Paid" {{ old('payment_status', $record->payment_status) == 'Paid' ? 'selected' : '' }}>Paid</option>
                            <option value="Unpaid" {{ old('payment_status', $record->payment_status) == 'Unpaid' ? 'selected' : '' }}>Unpaid</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <!-- car_number -->
                    <div class="col-md-4 mb-3">
                        <label for="car_number" class="form-label">Car Number</label>
                        <input type="text" id="car_number" name="car_number" class="form-control" value="{{ old('car_number', $record->car_number ?? '') }}" placeholder="Enter Car Number">
                    </div>

                    <!-- type_of_materials -->
                    <div class="col-md-4 mb-3">
                        <label for="type_of_materials" class="form-label">Type of Materials</label>
                        <input type="text" id="type_of_materials" name="type_of_materials" value="{{ old('type_of_materials', $record->type_of_materials ?? '') }}" class="form-control" placeholder="Enter Type of Materials">
                    </div>

                    <!-- contract_number -->
                    <div class="col-md-4 mb-3">
                        <label for="contract_number" class="form-label">Contract Number</label>
                        <input type="text" id="contract_number" name="contract_number" value="{{ old('contract_number', $record->contract_number ?? '') }}"  class="form-control" placeholder="Enter Contract Number">
                    </div>

                    <!-- properties_code -->
                    <div class="col-md-4 mb-3">
                        <label for="properties_code" class="form-label">Properties Code</label>
                        <input type="text" id="properties_code" name="properties_code" value="{{ old('properties_code', $record->properties_code ?? '') }}" class="form-control" placeholder="Enter Properties Code">
                    </div>

                    <!-- transporter_ticket_number -->
                    <div class="col-md-4 mb-3">
                        <label for="transporter_ticket_number" class="form-label">Transporter Ticket Number</label>
                        <input type="text" id="transporter_ticket_number" name="transporter_ticket_number" value="{{ old('transporter_ticket_number', $record->transporter_ticket_number ?? '') }}" class="form-control" placeholder="Enter Transporter Ticket Number">
                    </div>

                    <!-- disp_ticket_number -->
                    <div class="col-md-4 mb-3">
                        <label for="disp_ticket_number" class="form-label">Disposal Ticket Number</label>
                        <input type="text" id="disp_ticket_number" name="disp_ticket_number" class="form-control" value="{{ old('disp_ticket_number', $record->disp_ticket_number ?? '') }}" placeholder="Enter Disposal Ticket Number">
                    </div>

                    <!-- disposal_method -->
                    <div class="col-md-4 mb-3">
                        <label for="disposal_method" class="form-label">Disposal Method</label>
                        <input type="text" id="disposal_method" name="disposal_method" class="form-control" value="{{ old('disposal_method', $record->disposal_method ?? '') }}" placeholder="Enter Disposal Method">
                    </div>

                    <!-- treatment_method -->
                    <div class="col-md-4 mb-3">
                        <label for="treatment_method" class="form-label">Treatment Method</label>
                        <input type="text" id="treatment_method" name="treatment_method" class="form-control" value="{{ old('treatment_method', $record->treatment_method ?? '') }}" placeholder="Enter Treatment Method">
                    </div>

                    <!-- disposal_treatment -->
                    <div class="col-md-4 mb-3">
                        <label for="disposal_treatment" class="form-label">Disposal Treatment</label>
                        <input type="text" id="disposal_treatment" name="disposal_treatment" class="form-control" value="{{ old('disposal_treatment', $record->disposal_treatment ?? '') }}" placeholder="Enter Disposal Treatment">
                    </div>

                    <!-- date_load -->
                    <div class="col-md-4 mb-3">
                        <label for="date_load" class="form-label">Date Load</label>
                        <input type="datetime-local" id="date_load" name="date_load" value="{{ old('date_load', $record->date_load ?? '') }}" class="form-control">
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-dark btn-block">Update</button>
                    </div>
                </div>
            </form>

        </div>
    </div>
</div>
@endsection
