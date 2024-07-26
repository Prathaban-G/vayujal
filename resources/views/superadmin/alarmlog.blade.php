@include('components.head')



@include('components.header')
@include('components.offcanvas')
@include('components.aside')

<div class="main">
    <div class="container-fluid">
        <div class="row pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                    
                </ol>
                
            </nav>
        </div>
    </div>
    <div class="container-fluid">
        <form action="{{ url('/retrieveData') }}" method="POST">
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
                    <!-- <div class="row">
                        <div class="col-5">
                            <label for="type" class="h5 mt-1" style="font-family: 'Ariel';">Select Type</label>
                        </div>
                        <div class="col-7">
                            <select name="producttype" id="producttype" class="form-control">
                                <option value="Three Phase">Three Phase</option>
                                <option value="Single Phase">Single Phase</option>
                            </select>
                        </div>
                    </div> -->
                    <div class="row ">
                        <div class="col-5">
                            <label for="products" class="h5 mt-1" style="font-family: 'Ariel';">Select Products</label>
                        </div>
                        <div class="col-7">
                            <select name="products[]" id="products" class="form-control" multiple>
                                @foreach($products as $product)
                                    <option value="{{ $product->id }}">{{ $product->productname }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-4">
                    <div class="row">
                        <div class="col-6">
                            <label for="parameter" class="h5 mt-1" style="font-family: 'Ariel';">Select Parameter</label>
                        </div>
                        <div class="col-6">
                            <select name="parameter" id="parameter" class="form-control">
                                <option value="temperature">Temperature</option>
                                <option value="humidity">Humidity</option>
                                <option value="voltager">Voltage</option>
                                <option value="currentr">Current</option>
                                <option value="kwh">Power</option>
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
                <div class="container-fluid card pt-3 mt-5 col-12 border border-3 shadow-sm pt-2 pb-5" style="background-color: rgb(255, 255, 255);" id="tableContent">
                    <table class="table table-info table-bordered mt-3 table-hover table-responsive" id="usersTable">
                        <thead>
                            <tr class="h6">
                                <th class="py-3">No</th>
                                <th class="py-3">Product</th>
                                <th class="py-3">Datetime</th>
                                <th class="py-3">Parameter</th>
                            </tr>
                        </thead>
                        <tbody>
                            @isset($data)
                                @foreach($data as $index => $datum)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $datum->hw_id }}</td>
                                        <td>{{ $datum->datetime }}</td>
                                        <td>{{ $datum->{$parameter} }}</td>
                                    </tr>
                                @endforeach
                            @endisset
                        </tbody>
                    </table>
                    @if(isset($data) && count($data) > 0)
                        <a href="{{ url('/downloadCsv') }}" class="btn btn-primary">Download CSV</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('components.footer')
