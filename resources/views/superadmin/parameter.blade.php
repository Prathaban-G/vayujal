

@include('components.head')
<style>
.form-section {
            margin-bottom: 30px;
        }

        .form-section h2 {
            margin-bottom: 10px;
        }

        .form-section table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        .form-section table,
        .form-section th,
        .form-section td {
            border: 1px solid black;
        }

        .form-section th,
        .form-section td {
            padding: 8px;
            text-align: left;
        }

        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgb(0, 0, 0);
            background-color: rgba(0, 0, 0, 0.4);
        }

        .modal-content {
            background-color: #fefefe;
            margin: 15% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 700px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.3);
            animation: modalopen 0.5s;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }

        @keyframes modalopen {
            from {
                opacity: 0
            }

            to {
                opacity: 1
            }
        }
    </style>
@include('components.header')
@include('components.offcanvas')
@include('components.aside')


<div class="main">
    <div class="container-fluid mb-3">
        <div class="row pt-2 ">
            <nav aria-label="breadcrumb ">
                <ol class="breadcrumb mt-5 ">
                    <li class="breadcrumb-item"><a href="{{ url('/') }}"><i class="fa fa-home "></i></a></li>
                    <li class="breadcrumb-item">{{ $projectName }}</li>
                    <li class="breadcrumb-item active" aria-current="page">Parameter Settings</li>
                    <div class="container-fluid d-flex justify-content-end" style="position:absolute;top:90px;right:40px;">
                        <button class="btn btn-success float-end ms-2 py-1 px-3" id="publish" onclick="openModal()">
                            <i class="fa fa-download pe-2" aria-hidden="true"></i>
                            Copy Parameter
                        </button>
                        <!-- <button class="btn btn-danger float-end ms-2 py-1 px-3" id="publish">
                            <i class="fa fa-upload pe-2" aria-hidden="true"></i>
                            Publish
                        </button> -->
                        <button class="btn btn-primary ms-2 px-3 text-white" id="back-button" style="color: inherit; text-decoration: inherit; height: 2rem;">
                            <i class="fa fa-reply pe-2" aria-hidden="true"></i>Back
                        </button>
                    </div>
                </ol>
            </nav>
        </div>
    </div>
    <div class="container-fluid border-top border-primary px-5 py-4" style="background-color: white;width:900px;">
        <form method="POST" action="{{ route('parameter.store') }}">
            @csrf
            <input type="hidden" name="hw_id" value="{{ $projectName }}">
            <!-- current time -->
            <!-- Temperature -->
            <div class="form-section">
                <h2>Temperature Controller Settings</h2>
                <table>
                    <tr>
                        <th>Parameters</th>
                        <th>Set/Range</th>
                    </tr>
                    <tr>
                        <td>Temp Limit</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_limit_from" value="{{ $threshold->temp_limit_from ?? '' }}" placeholder="From">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_limit_till" value="{{ $threshold->temp_limit_till ?? '' }}" placeholder="Till">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Set Point -->
                    <tr>
                        <td>Set Point</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_set_point_ls" value="{{ $threshold->temp_set_point_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_set_point_hs" value="{{ $threshold->temp_set_point_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <!-- Cut Off Point -->
                        <td>Cut off  Point</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_cutoff_point_ls" value="{{ $threshold->temp_cutoff_point_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_cutoff_point_hs" value="{{ $threshold->temp_cutoff_point_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                     <!-- Differentials Cut Off Point -->
                    <tr>
                       
                        <td>Differntials Cut off </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_differ_cutoff_ls" value="{{ $threshold->temp_differ_cutoff_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="temp_differ_cutoff_hs" value="{{ $threshold->temp_differ_cutoff_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                 
                    
                </table>
            </div>
            <!-- Humidity  -->
            <div class="form-section">
                <h2>Humidity Controller Settings</h2>
                <table>
                    <tr>
                        <th>Parameters</th>
                        <th>Set/Range</th>
                    </tr>
                    <tr>
                        <td>hum Limit</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_limit_from" value="{{ $threshold->hum_limit_from ?? '' }}" placeholder="From">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_limit_till" value="{{ $threshold->hum_limit_till ?? '' }}" placeholder="Till">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                    <!-- Set Point -->
                    <tr>
                        <td>Set Point</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_set_point_ls" value="{{ $threshold->hum_set_point_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_set_point_hs" value="{{ $threshold->hum_set_point_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <!-- Cut Off Point -->
                        <td>Cut off  Point</td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_cutoff_point_ls" value="{{ $threshold->hum_cutoff_point_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_cutoff_point_hs" value="{{ $threshold->hum_cutoff_point_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                     <!-- Differentials Cut Off Point -->
                    <tr>
                       
                        <td>Differntials Cut off </td>
                        <td>
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_differ_cutoff_ls" value="{{ $threshold->hum_differ_cutoff_ls?? '' }}" placeholder="Low Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="hum_differ_cutoff_hs" value="{{ $threshold->hum_differ_cutoff_hs ?? '' }}" placeholder="High Side">
                                        <div class="input-group-append">
                                            <span class="input-group-text">°C</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>

                 
                    
                </table>
            </div>
            <!-- Ultra Sonic -->
            <div class="form-section">
                    <h2>Ultrasonic Sensor Settings</h2>
                    <table>
                        <tr>
                            <th>Parameters</th>
                            <th>Set/Range</th>
                        </tr>
                        <tr>
                            <td>Tank height</td>
                            <td><div class="input-group"><input type="text" class="form-control" name="ultra_tank_height" value="{{ $threshold->ultra_tank_height ?? '' }}"
                                                placeholder="Height">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
</td>
                        </tr>
                        <tr>
                            <td>sensing Range</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6"><div class="input-group"><input type="text" class="form-control" name="ultra_sensing_range_min" value="{{ $threshold->ultra_sensing_range_min ?? '' }}"
                                                placeholder="Minimum">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div></div>
                                    <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="ultra_sensing_range_max" value="{{ $threshold->ultra_sensing_range_max ?? '' }}"
                                                placeholder="Maximum">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div></div>
                                </div>
                            </td>

                        </tr>

                        <tr>
                            <td> water level</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-4"> <div class="input-group"><input type="text" class="form-control" name="water_level_low" value="{{ $threshold->water_level_low ?? '' }}"
                                                placeholder="Low">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"> <div class="input-group"><input type="text" class="form-control" name="water_level_mid" value="{{ $threshold->water_level_mid ?? '' }}"
                                                placeholder="Medium">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4"> <div class="input-group"><input type="text" class="form-control" name="water_level_high" value="{{ $threshold->water_level_high ?? '' }}"
                                                placeholder="High">
                                            <div class="input-group-append">
                                                <span class="input-group-text">cm</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    </table>
                </div>
                <div class="form-section">
                    <h2> Air Flow Settings </h2>
                    <table>
                        <tr>
                            <th>Parameters</th>
                            <th>Set/Range</th>
                        </tr>
                        <tr>
                            <td>Air flow set point</td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="air_flow_low" value="{{ $threshold->air_flow_low ?? '' }}"
                                                placeholder="Low limit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m3/h</span>
                                            </div>
                                        </div></div>
                                    <div class="col-lg-6">  <div class="input-group"><input type="text" class="form-control" name="air_flow_high" value="{{ $threshold->air_flow_high ?? '' }}"
                                                placeholder="High limit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">m3/h</span>
                                            </div>
                                        </div></div>
                            </td>
                </div>

                <div class="form-section">
        <h2>TDS Settings </h2>
        <table>
            <tr>
                <th>Parameters</th>
                <th>Set/Range</th>
            </tr>
            <tr>
                <td>TDS set point</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6">  <div class="input-group"><input type="text" class="form-control" name="tds_set_point_low" value="{{ $threshold->tds_set_point_low ?? '' }}"
                                                placeholder="Low limit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ppm</span>
                                            </div>
                                        </div></div>
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="tds_set_point_high" value="{{ $threshold->tds_set_point_high ?? '' }}"
                                                placeholder="High limit">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ppm</span>
                                            </div>
                                        </div></div>


                    </div>
                </td>

            </tr>
            <tr>
                <td>TDS range</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="tds_range_low" value="{{ $threshold->tds_range_low ?? '' }}"
                                                placeholder="Low">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ppm</span>
                                            </div>
                                        </div></div>
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="tds_range_high" value="{{ $threshold->tds_range_high ?? '' }}"
                                                placeholder="Low">
                                            <div class="input-group-append">
                                                <span class="input-group-text">ppm</span>
                                            </div>
                                        </div></div>


                    </div>
                </td>

            </tr>



        </table>
    </div>
    <div class="form-section">
        <h2>Power Energy Meter Settings </h2>
        <table>
            <tr>
                <th>Parameters</th>
                <th>Set/Range</th>
            </tr>
            <tr>
                <td>Under Voltage</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control"  name="power_under_voltage_low" value="{{ $threshold->power_under_voltage_low ?? '' }}"
                                                placeholder="Low">
                                            <div class="input-group-append">
                                                <span class="input-group-text">V</span>
                                            </div>
                                        </div></div>
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="power_under_voltage_high" value="{{ $threshold->power_under_voltage_high ?? '' }}"
                                                placeholder="High">
                                            <div class="input-group-append">
                                                <span class="input-group-text">V</span>
                                            </div>
                                        </div></div>


                    </div>
                </td>

            </tr>
            <tr>
                <td>Over Voltage</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="power_over_voltage_low" value="{{ $threshold->power_over_voltage_low ?? '' }}"
                                                placeholder="Low"> 
                                            <div class="input-group-append">
                                                <span class="input-group-text">V</span>
                                            </div>
                                        </div></div>
                        <div class="col-lg-6"><div class="input-group"><input type="text" class="form-control" name="power_over_voltage_high" value="{{ $threshold->power_over_voltage_high ?? '' }}"
                                                placeholder="High">
                                            <div class="input-group-append">
                                                <span class="input-group-text">V</span>
                                            </div>
                                        </div></div>


                    </div>
                </td>

            </tr>
            <tr>
                <td>Current</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="power_over_current" value="{{ $threshold->power_over_current ?? '' }}"
                                                placeholder="Over">
                                            <div class="input-group-append">
                                                <span class="input-group-text">A</span>
                                            </div>
                                        </div></div>
                        <!-- <div class="col-lg-6">   <input type="text" class="form-control" placeholder="over"></div> -->


                    </div>
                </td>

            </tr>
            <tr>
                <td>CT</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="power_ct_pri" value="{{ $threshold->power_ct_pri ?? '' }}"
                                                placeholder="primary">
                                            <div class="input-group-append">
                                                <span class="input-group-text">A</span>
                                            </div>
                                        </div></div>
                        <div class="col-lg-6"> <div class="input-group"><input type="text" class="form-control" name="power_ct_sec" value="{{ $threshold->power_ct_sec ?? '' }}"
                                                placeholder="Secondary">
                                            <div class="input-group-append">
                                                <span class="input-group-text">A</span>
                                            </div>
                                        </div></div>


                    </div>
                </td>

            </tr>


        </table>
    </div>
    <div class="form-section">
        <h2>Timer Settings </h2>
        <table>
            <tr>
                <th>Parameters</th>
                <th>Set/Range</th>
            </tr>
            <tr>
                <td>Ozonizer</td>
                <td>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-center">Off Time</div>
                            <input type="text" class="form-control" placeholder="Off Time" name="tim_ozonizer_on" value="{{ $threshold->tim_ozonizer_on ?? '' }}">
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">On Time</div> <input type="text" class="form-control" name="tim_ozonizer_off" value="{{ $threshold->tim_ozonizer_off ?? '' }}"
                                placeholder="On Time">
                        </div>


                    </div>
                </td>

            </tr>
            <tr>
                <td>Compressor </td>
                <td>
                    <div class="row">
                        <!-- <div class="col-lg-6">  On Delay Time</div> -->
                        <div class="col-lg-6">
                            <div class="text-center">On Delay Time</div> <input type="text" class="form-control" name="tim_compressor_on_delay" value="{{ $threshold->tim_compressor_on_delay ?? '' }}"
                                placeholder="High ">
                        </div>


                    </div>
                </td>

            </tr>
            <tr>
                <td>Machine Rest Hour </td>
                <td>
                    <div class="row">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="text-center">On Time</div>
                            <input type="text" class="form-control" placeholder="On Time" name="tim_machine_rest_on" value="{{ $threshold->tim_machine_rest_on ?? '' }}">
                        </div>
                        <div class="col-lg-6">
                            <div class="text-center">Off Time</div> <input type="text" class="form-control" name="tim_machine_rest_off" value="{{ $threshold->tim_machine_rest_off ?? '' }}"
                                placeholder="Off Time">
                        </div>


                    </div>
                    </div>
                </td>

            </tr>
            <tr>
                <td> Maintenance Schedule</td>
                <td>
                    <div class="row">
                        <!-- <div class="col-lg-6">  On Delay Time</div> -->
                        <div class="col-lg-12"> <input type="text" class="form-control" placeholder="High " name="tim_maintenance" value="{{ $threshold->tim_maintenance ?? '' }}"></div>


                    </div>
                </td>

            </tr>



        </table>
    </div>
    <div class="form-section">
    <h2>Bypass</h2>
    <table>
        <tr>
            <th>Parameters</th>
            <th>Mode</th>
        </tr>
        <tr>
            <td>Temperature/Hum</td>
            <td>
                <div class="row">
                    <div class="col-12 center-toggle">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitchTempHum" name="bypass_temphum" value="1" {{ isset($threshold->bypass_temphum) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitchTempHum"></label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>Air Flow</td>
            <td>
                <div class="row">
                    <div class="col-12 center-toggle">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitchAirFlow" name="bypass_airflow" value="1" {{ isset($threshold->bypass_airflow) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitchAirFlow"></label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td>TDS</td>
            <td>
                <div class="row">
                    <div class="col-12 center-toggle">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitchTDS" name="bypass_tds" value="1" {{ isset($threshold->bypass_tds) ? 'checked' : '' }}>
                            <label class="custom-control-label" for="customSwitchTDS"></label>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
    </table>
</div>



            <button type="submit" class="btn btn-primary mt-3">Save</button>
        </form>
    </div>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <form method="POST" action="{{ route('parameter.copy') }}">
    @csrf
    <input type="hidden" name="hw_id" value="{{ $projectName }}">
    <div class="row mt-5">
        <div class="col-4">
            <label class="h5" for="source_hw_id">Select Hardware:</label>
        </div>
        <div class="col-8">
        <select class="form-select" name="source_hw_id" required>
    <option value="">Select Hardware</option>
    @foreach($products as $product)
        <option value="{{ $product->productname }}">{{ $product->productname }}</option>
    @endforeach
</select>
        </div>
    </div>
    <div class="row mt-5">
        <button type="submit" class="btn btn-primary">Copy Parameters</button>
    </div>
</form>


        </div>
    </div>
</div>
<script>
function openModal() {
    document.getElementById('myModal').style.display = 'block';
}

function closeModal() {
    document.getElementById('myModal').style.display = 'none';
}

// Close the modal if the user clicks outside of the modal content
window.onclick = function(event) {
    if (event.target == document.getElementById('myModal')) {
        closeModal();
    }
}
</script>
<script>
        document.getElementById('back-button').addEventListener('click', function() {
            window.history.back();
        });
    </script>