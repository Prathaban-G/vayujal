@include('components.head')
@include('components.header')
@include('components.offcanvas')
@include('components.aside')
<style>
    .download-csv-form {
        position: absolute;
        top: -40px;
        right: 10px;
        /* Adjust top and right values as needed */
    }
    .table-scroll-container {
            max-height: 50rem; /* Maximum height for the container */
            overflow-x: auto; /* Enables horizontal scrolling */
            overflow-y: auto; /* Enables vertical scrolling */
            margin-top: 20px; /* Space from top if needed */
            display: block; /* Ensure container is a block element for scrolling */
        }

        .table-scroll-container table {
            width: 100%; /* Full width for the table */
            min-width: 800px; /* Minimum width for scrolling effect */
            border-collapse: collapse; /* Optional: Ensures borders are collapsed */
        }

        /* Optional: Ensure table headers are sticky */
        .table-scroll-container thead th {
            position: sticky;
            top: 0;
            background-color: #f8f9fa; /* Match the table header background */
            z-index: 1; /* Make sure headers stay on top */
        }
</style>
<div class="main">
    <div class="container-fluid">
        <div class="row pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                <li class="breadcrumb-item"><a href="{{ url('data') }}"><i class="fa-solid fa-cloud me-3"></i> History</a></li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <form action="{{ url('data/retrieveData') }}" method="POST">
            @csrf
            <div class="row py-3 px-2 border-0 shadow-sm bg-light w3-animate-zoom">
                <div class="col-4">
                    <div class="row">
                        <div class="col-5">
                            <label for="startDate" class="h5 mt-1" style="font-family: 'Ariel';">Start Date</label>
                        </div>
                        <div class="col-7">
                            <input type="datetime-local" class="form-control" id="startdate" name="startdate" required>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-5">
                            <label for="enddate" class="h5 mt-1" style="font-family: 'Ariel';">End Date</label>
                        </div>
                        <div class="col-7">
                            <input type="datetime-local" class="form-control" id="enddate" name="enddate" required>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-5">
                            <label for="products" class="h5 mt-1" style="font-family: 'Ariel';">Select Products</label>
                        </div>
                        <div class="col-7">
                            <select name="products[]" id="products" class="form-control" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->productname }}">{{ $product->productname }}</option>
                                @endforeach
                            </select>

                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="parameter" class="h5 mt-1" style="font-family: 'Ariel';">Select
                                Parameter</label>
                        </div>
                        <div class="col-6">
                            <select name="parameter" id="parameter" class="form-control">
                                <option value="all">All Parameters</option>
                                <option value="temperature">Temperature</option>
                                <option value="humidity">Humidity</option>
                                <option value="waterlevel">Water Level</option>
                                <option value="waterflow">Water Flow</option>
                                <option value="airflow">Air Flow</option>
                                <option value="pressure_lowswitch">Pressure Low Switch</option>
                                <option value="pressurehighswitch">Pressure High Switch</option>
                                <option value="pressureoutswitch">Pressure Out Switch</option>
                                <option value="tds">TDS</option>
                                <option value="voltager">Voltage R</option>
                                <option value="voltagey">Voltage Y</option>
                                <option value="voltageb">Voltage B</option>
                                <option value="currentr">Current R</option>
                                <option value="currenty">Current Y</option>
                                <option value="currentb">Current B</option>
                                <option value="avgvoltage">Average Voltage</option>
                                <option value="avgcurrent">Average Current</option>
                                <option value="frequency">Frequency</option>
                                <option value="kwh">Power (kWh)</option>
                                <option value="fan">Fan</option>
                                <option value="compressor">Compressor</option>
                                <option value="dispensor">Dispensor</option>
                                <option value="ozonizer">Ozonizer</option>
                                <option value="buzzer">Buzzer</option>
                                <option value="external">External</option>
                                <option value="power_status">Power Status</option>
                                <option value="battery_per">Battery Percentage</option>
                                <option value="humiditybg">Humidity Background</option>
                                <option value="temperaturebg">Temperature Background</option>
                                <option value="waterlevelbg">Water Level Background</option>
                                <option value="airflowbg">Air Flow Background</option>
                                <option value="pressurebg">Pressure Background</option>
                                <option value="tdsbg">TDS Background</option>
                                <option value="fanbg">Fan Background</option>
                                <option value="compressorbg">Compressor Background</option>
                                <option value="dispensorbg">Dispensor Background</option>
                                <!-- Add all other parameters as options -->
                            </select>
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-6">
                            <button class="btn btn-outline-secondary px-4 py-1 w-100" type="reset">Clear</button>
                        </div>
                        <div class="col-6">
                            <button class="btn btn-outline-secondary px-4 py-1 w-100" type="submit">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <div class="row mt-1 mb-2 w3-animate-zoom">
            <div class="col-lg-12 col-md-12 table-menu mb-5">
                <div class="container-fluid card pt-3 mt-5 col-12 border border-3 shadow-sm pt-2 pb-5"
                    style="background-color: rgb(255, 255, 255);" id="tableContent">
                    <div class="container">
                        @if(isset($data) && count($data) > 0)
                            <div class="download-csv-form">
                                <form action="{{ url('/data/downloadCsv') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="startdate" value="{{ request('startdate') }}">
                                    <input type="hidden" name="enddate" value="{{ request('enddate') }}">
                                    <input type="hidden" name="products"
                                        value="{{ implode(',', request('products', [])) }}">
                                    <input type="hidden" name="parameter" value="{{ request('parameter') }}">
                                    <button class="btn btn-primary" type="submit">Download CSV</button>
                                </form>
                            </div>
                        @endif
                    </div>

                    <div class="table-scroll-container">
                    <table class="table table-info table-bordered mt-3 table-hover table-responsive" id="usersTable">
                        <thead >
                            <tr style="font-size:16px;">
                                <th class="py-3" >No</th>
                                <th class="py-3">Product</th>
                                <th class="py-3">Datetime</th>
                                @if(isset($parameter) && $parameter != 'all')
                                    <th class="py-3">{{ ucfirst($parameter) }}</th>
                                @else
                                    <th class="py-3">Temperature</th>
                                    <th class="py-3">Humidity</th>
                                    <th class="py-3">Water Level</th>
                                    <th class="py-3">Water Flow</th>
                                    <th class="py-3">Air Flow</th>
                                    <th class="py-3">Pressure Low Switch</th>
                                    <th class="py-3">Pressure High Switch</th>
                                    <th class="py-3">Pressure Out Switch</th>
                                    <th class="py-3">TDS</th>
                                    <th class="py-3">Voltage R</th>
                                    <th class="py-3">Voltage Y</th>
                                    <th class="py-3">Voltage B</th>
                                    <th class="py-3">Current R</th>
                                    <th class="py-3">Current Y</th>
                                    <th class="py-3">Current B</th>
                                    <th class="py-3">Average Voltage</th>
                                    <th class="py-3">Average Current</th>
                                    <th class="py-3">Frequency</th>
                                    <th class="py-3">Power (kWh)</th>
                                    <th class="py-3">Fan</th>
                                    <th class="py-3">Compressor</th>
                                    <th class="py-3">Dispensor</th>
                                    <th class="py-3">Ozonizer</th>
                                    <th class="py-3">Buzzer</th>
                                    <th class="py-3">External</th>
                                    <th class="py-3">Power Status</th>
                                    <th class="py-3">Battery Percentage</th>
                                    <th class="py-3">Humidity Background</th>
                                    <th class="py-3">Temperature Background</th>
                                    <th class="py-3">Water Level Background</th>
                                    <th class="py-3">Air Flow Background</th>
                                    <th class="py-3">Pressure Background</th>
                                    <th class="py-3">TDS Background</th>
                                    <th class="py-3">Fan Background</th>
                                    <th class="py-3">Compressor Background</th>
                                    <th class="py-3">Dispensor Background</th>
                                    <!-- Add other headers for all parameters -->
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                                @foreach($data as $index => $datum)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datum->hw_id }}</td>
                                        <td>{{ $datum->datetime }}</td>
                                        @if(isset($parameter) && $parameter != 'all')
                                            <td>{{ $datum->{$parameter} }}</td>
                                        @else
                                            <td>{{ $datum->temperature }}</td>
                                            <td>{{ $datum->humidity }}</td>


                                            <td>{{ $datum->waterlevel }}</td>
                                            <td>{{ $datum->waterflow }}</td>
                                            <td>{{ $datum->airflow }}</td>
                                            <td>{{ $datum->pressure_lowswitch }}</td>
                                            <td>{{ $datum->pressurehighswitch }}</td>
                                            <td>{{ $datum->pressureoutswitch }}</td>
                                            <td>{{ $datum->tds }}</td>
                                            <td>{{ $datum->voltager }}</td>
                                            <td>{{ $datum->voltagey }}</td>
                                            <td>{{ $datum->voltageb }}</td>
                                            <td>{{ $datum->currentr }}</td>
                                            <td>{{ $datum->currenty }}</td>
                                            <td>{{ $datum->currentb }}</td>
                                            <td>{{ $datum->avgvoltage }}</td>
                                            <td>{{ $datum->avgcurrent }}</td>
                                            <td>{{ $datum->frequency }}</td>
                                            <td>{{ $datum->kwh }}</td>
                                            <td>{{ $datum->fan }}</td>
                                            <td>{{ $datum->compressor }}</td>
                                            <td>{{ $datum->dispensor }}</td>
                                            <td>{{ $datum->ozonizer }}</td>
                                            <td>{{ $datum->buzzer }}</td>
                                            <td>{{ $datum->external }}</td>
                                            <td>{{ $datum->power_status }}</td>
                                            <td>{{ $datum->battery_per }}</td>
                                            <td>{{ $datum->humiditybg }}</td>
                                            <td>{{ $datum->temperaturebg }}</td>
                                            <td>{{ $datum->waterlevelbg }}</td>
                                            <td>{{ $datum->airflowbg }}</td>
                                            <td>{{ $datum->pressurebg }}</td>
                                            <td>{{ $datum->tdsbg }}</td>
                                            <td>{{ $datum->fanbg }}</td>
                                            <td>{{ $datum->compressorbg }}</td>
                                            <td>{{ $datum->dispensorbg }}</td>
                                            <!-- Add other data for all parameters -->
                                        @endif
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
</div>
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
