@include('components.head')

@include('components.header')
@include('components.offcanvas')
@include('components.aside')

@if(isset($message) && isset($charts))
    <div class="popup">
        <p>{{ $message }}</p>
        
    </div>
@endif
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>
<script>
        $(document).ready(function() {
            function fetchLatestData(hw_id) {
                $.ajax({
                    url: "{{ route('dashboard.latestData', ['hw_id' => '__HW_ID__']) }}".replace('__HW_ID__', hw_id),
                    method: 'GET',
                    success: function(data) {
                        if (data.error) {
                            $('.popup').html(`
                                <p>${data.error}</p>
                            `);
                            $('.popup').show();
                            setTimeout(function() {
                                $('.popup').hide();
                            }, 3000);
                        } else {
                            $('#datetime').text(data.datetime);
                            $('#temperature').text(data.temperature + ' °C');
                            $('#humidity').text(data.humidity + ' %');
                            $('#voltage').text(data.voltager + ' V');
                            $('#water-level').text(data.waterlevel + ' %');
                            $('#pressure').text(data.pressure == 1 ? 'HIGH' : 'LOW');
                            $('#fan').text(data.fan == 1 ? 'ON' : 'OFF');
                            $('#airflow').text(data.airflow + ' m3/h');
                            $('#compressor').text(data.compressor == 1 ? 'ON' : 'OFF');
                            $('#tds').text(data.tds + ' PPM');
                            $('#dispensor').text(data.dispensor == 1 ? 'ON' : 'HIGH');
                            
                            // Update background colors
                            $('.voltagebg').toggleClass('bg-success', data.voltagebg == 1).toggleClass('bg-danger', data.voltagebg != 1);
                            $('.waterlevelbg').toggleClass('bg-success', data.waterlevelbg == 1).toggleClass('bg-danger', data.waterlevelbg != 1);
                            $('.pressurebg').toggleClass('bg-success', data.pressurebg == 1).toggleClass('bg-danger', data.pressurebg != 1);
                            $('.temperaturebg').toggleClass('bg-success', data.temperaturebg == 1).toggleClass('bg-danger', data.temperaturebg != 1);
                            $('.humiditybg').toggleClass('bg-success', data.humiditybg == 1).toggleClass('bg-danger', data.humiditybg != 1);
                            $('.fanbg').toggleClass('bg-success', data.fanbg == 1).toggleClass('bg-danger', data.fanbg != 1);
                            $('.airflowbg').toggleClass('bg-success', data.airflowbg == 1).toggleClass('bg-danger', data.airflowbg != 1);
                            $('.compressorbg').toggleClass('bg-success', data.compressorbg == 1).toggleClass('bg-danger', data.compressorbg != 1);
                            $('.tdsbg').toggleClass('bg-success', data.tdsbg == 1).toggleClass('bg-danger', data.tdsbg != 1);
                            $('.dispensorbg').toggleClass('bg-success', data.dispensorbg == 1).toggleClass('bg-danger', data.dispensorbg != 1);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error fetching latest data:', error);
                        $('.popup').html(`
                            <p>Failed to fetch data for the following chart(s)</p>
                            <ul>
                                <li>Temperature</li>
                                <li>Weights</li>
                            </ul>
                        `);
                        $('.popup').show();
                        setTimeout(function() {
                            $('.popup').hide();
                        }, 3000);
                    }
                });
            }

            var hw_id = @json($latestData ? $latestData->hw_id : null);
            fetchLatestData(hw_id);

            setInterval(function() {
                fetchLatestData(hw_id);
            }, 5000);
        });
    </script>
<style>
    #scrollToTop {
        display: none;
        position: fixed;
        background-color: slategray;
        bottom: 20px;
        right: 20px;
        z-index: 99;
        cursor: pointer;
        padding: 10px;


    }

    .nav-bar {
        font-size: 25px;
        color: white;
        display: none;
    }

    /* Tank  */
    .tankgauge {
        width: 400px;
        height: 400px;
        position: relative;
    }

    .tank-rect {
        fill: #fff;
        stroke: #2980B9;
        stroke-width: 2px;
    }

    .tank-top {
        fill: #fff;
        stroke: #2980B9;
        stroke-width: 2px;
    }

    .tank-fill {
        fill: #2389da;
    }

    .tank-text {
        fill: #fff;
        font-size: 35px;
        font-weight: bold;
    }

    .tank-label {
        fill: #000;
        font-size: 16px;
    }

    @media screen and (max-width: 800px) {
        .nav-bar {
            display: block;
        }

        .aside {
            display: none;
        }

        .main {
            padding-left: 0px;
        }
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
        margin: 10% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 1200px;
        height: 600px;
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

    .green-bg {
        background-color: green;
    }

    .red-bg {
        background-color: red;
    }
</style>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<div class="main">
    <div class="container-fluid ">
    @if ($latestData)

      <!-- <button onclick="scrollToTop()" id="scrollToTop"  class="btn btn-secondary" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>     -->
      <div class="container-fluid">
        <div class="row pt-2">
          <nav aria-label="breadcrumb ">
            <ol class="breadcrumb   mt-3">
              <li class="breadcrumb-item"><a href="home.php"><i class="fa fa-home "></i></a></li>

              <li class="breadcrumb-item  ">DashBoard
              </li>
              <li class="breadcrumb-item active " aria-current="page"><a href="dashboard.php" id="dashBoardPage">
              {{ $projectName }} 
                </a>
              </li><i class="ms-5 fa fa-circle text-danger pd-2" id="deviceStatus" style="font-size: 30px;" aria-hidden="true"></i>
              <!-- <li class="breadcrumb-item active pt-2 active" aria-current="page"><a href="#"></a></li> -->
              <!-- <div class="alert alert-secondary  " style="position: absolute; top: 80px;right: 0;">
                         <div id="time"></div>
                       </div> -->
              <div class="container-fluid d-flex justify-content-end">
              <div class="card border-0 shadow-sm me-2" style="width:20rem;
              height: 2rem;background-color: #f8f6f6;display: flex; 
              justify-content: center; 
              align-items: center;"><span class="w3-animate-zoom">Last Updated : <i id="datetime">{{$latestData->datetime}}</i></span></div>
                <div class="card border-0 shadow-sm " style="width:10rem;
              height: 2rem;background-color: #f8f6f6;display: flex; 
              justify-content: center; 
              align-items: center;"><span id="onlinestatus">Offline</span>  </div>
                      <button class="btn btn-primary ms-2 px-3 text-white"  id="back-button" style="color: inherit; text-decoration: inherit; height: 2rem;">
    <i class="fa fa-reply pe-2" aria-hidden="true"></i>Back
  </button>
              </div>

            </ol>
          </nav>
        </div>
      </div>
      <div class="container-fluid meter-dash pb-5 block">
        <div class="row  ">
          <div class="h4 col-4  mt-3">Live Monitoring</div>
          <div class="col-lg-8 d-flex justify-content-end">
            <!-- <div class="alert alert-success mt-1 me-4 btn btn-success"  id="getAllData"  onclick="openModal()"><i class="fa fa-download "  ></i>Download </div> -->
            <!-- <div class="alert alert-secondary mt-1 me-4 btn btn-secondary text-center" id="threshold"><i class="fa fa-cog " style="font-size: 20px;" aria-hidden="true"></i> </div> -->




          </div>
          <div class="row mt-2 ">
            <div class="col-lg-12 col-md-12 ">
              <div class="row">
                <div class="col-lg-8 condition">
                  <div class="card border-0 shadow-sm" style="
              background-color: #e2e2e2;">
                    <!-- Datas  -->
                    <div class="row p-2">
                      <div class="col-lg-3">
                        <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                          <div class="card-header h6 text-center">
                          <div class="row">
                                                            <div class="col-2" style="cursor:pointer;" id="viewpower"
                                                                onclick="openModal()"><i class="fa-solid fa-expand"></i>
                                                            </div>
                                                            <div class="col-8">
                                                                VOLTAGE
                                                            </div>
                                                            <div class="col-2 {{ $latestData->voltagebg == 1 ? 'bg-success' : 'bg-danger'}}" id="voltagebg"></div>
                                                        </div>
                        
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="voltage">{{$latestData->voltager}} V</div>
                          </div>


                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                          <div class="card-header h6 text-center">
                            <div class="row">
                              <div class="col-10">
                              WATER LEVEL
                              </div>
                              <div class="col-2 waterlevelbg {{ $latestData-> waterlevelbg == 1 ? 'bg-success' : 'bg-danger'}}"></div><!--waterlevelbg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="waterlevel">{{$latestData->waterlevel}} %</div>
                          </div>


                        </div>
                      </div>
                      <div class="col-lg-3">
                        <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                          <div class="card-header h6 text-center">
                            <div class="row">
                              <div class="col-10">
                                PRESSURE
                              </div>
                              <div class="col-2 pressurebg {{ $latestData-> pressurebg == 1 ? 'bg-success' : 'bg-danger'}}"></div><!--pressurebg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="pressure">{{ $latestData-> pressure == 1 ? 'HIGH' : 'LOW'}}</div>
                          </div>


                        </div>
                      </div>
                      <div class="col-lg-3">
  <div class="card border-0 shadow-sm" style="height: 9rem;">
    <div class="card-header px-1  text-center">
      <div class="row">
        <div class="col-10" style="font-size:15px;">TEMPERATURE</div><!--temperaturebg--->
        <div class="col-2 temperaturebg {{ $latestData-> temperaturebg == 1 ? 'bg-success' : 'bg-danger'}}" style="position:relative;left:-10px;"></div>
      </div>
    </div>
    <div class="card-body text-center bg-light" style="display: flex;justify-content: center;align-items: center;">
      <div class="card-title h2 w3-animate-zoom" id="temperature">{{$latestData->temperature}} °C</div>
    </div>
  </div>


  </div>

                    </div>
                    <div class="row p-2">
                    <div class="col-lg-3">
                        <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                          <div class="card-header h6 text-center">
                            <div class="row">
                              <div class="col-10">
                                Humidity
                              </div>
                              <div class="col-2 humiditybg  {{ $latestData-> humiditybg == 1 ? 'bg-success' : 'bg-danger'}}"></div><!--humiditybg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="humidity">{{$latestData->humidity}} %</div>
                          </div>


                        </div>
                      </div>
<div class="col-lg-3">
  <div class="card border-0 shadow-sm" style="height: 9rem;">
    <div class="card-header px-1 h6 text-center">
      <div class="row">
        <div class="col-10">FAN</div>
        <div class="col-2 fanbg {{ $latestData-> fanbg == 1 ? 'bg-success' : 'bg-danger'}}" style="position:relative;left:-13px;"></div><!--fanbg--->
      </div>
    </div>
    <div class="card-body text-center bg-light" style="display: flex;justify-content: center;align-items: center;">
      <div class="card-title h2 w3-animate-zoom" id="fan">{{ $latestData-> fanbg == 1 ? 'ON' : 'OFF'}}</div>
    </div>
  </div>
</div>
<div class="col-lg-3">
  <div class="card border-0 shadow-sm" style="height: 9rem;">
    <div class="card-header px-1 h6 text-center">
      <div class="row">
        <div class="col-10">Air FLow</div>
        <div class="col-2 airflowbg {{ $latestData-> airflowbg == 1 ? 'bg-success' : 'bg-danger'}}" style="position:relative;left:-13px;"></div><!--airflowbg--->
      </div>
    </div>
    <div class="card-body text-center bg-light" style="display: flex;justify-content: center;align-items: center;">
      <div class="card-title h2 w3-animate-zoom" id="airflow">{{$latestData->airflow}} m3/h</div>
    </div> 
  </div>
</div> <div class="col-lg-3">
                        <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                          <div class="card-header h6 px-1">
                            <div class="row">
                              <div class="col-10 text-center">
                                COMPRESSOR
                              </div>
                              <div class="col-2 compressorbg {{ $latestData-> compressorbg == 1 ? 'bg-success' : 'bg-danger'}}" style="margin-left: -20px;"></div><!--compressorbg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="compressor">{{ $latestData-> compressor == 1 ? 'ON' : 'OFF'}}</div>
                          </div>


                        </div>
                      </div>
                      

                    </div>

                  </div>
                </div>
                <div class="col-lg-4 condition"> 
                  <div class="card border-0 shadow-sm p-2" style="background-color: #e2e2e2 ;height: 20rem;">
                  <div class="card border-0 shadow-sm bg-light"  style="height: 19rem;
               display: flex; 

              justify-content: center; 
              align-items: center;" >
      <div id="tankgauge" class="w3-animate-zoom" style="position:relative;left:5px;top:42px;"></div>

                  </div>
                </div>

                </div>


              </div>
            </div>
          </div>
          <div class="row my-2">
            <div class="col-lg-12">
              <div class="card border-0 shadow-sm " style="height: 16rem; position: relative;background-color: #e2e2e2 ;">
                <div class="row">

                  <div class="col-lg-3 py-2 px-3"><div class="card border-0 shadow-sm " style="height: 15rem;">
                    <div class="col-12 p-1 ">
                    <div class="card border-1 shadow-sm mb-1" style="height: 6rem;">
                    <div class="card-header h6 text-center">
                            <div class="row ">
                              <div class="col-10">
                                TDS 
                              </div>
                              <div class="col-2 tdsbg {{ $latestData-> tdsbg == 1 ? 'bg-success' : 'bg-danger'}}"></div><!--tdsbg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="tds" >{{$latestData->tds}} PPM</div>
                          </div>
                    </div>
                    <div class="card border-1 shadow-sm " style="height: 7rem;"><div class="card-header h6 text-center">
                            <div class="row">
                              <div class="col-10">
                              Dispensor
                              </div>
                              <div class="col-2 dispensorbg {{ $latestData-> dispensorbg == 1 ? 'bg-success' : 'bg-danger'}}"></div><!--dispensorbg--->
                            </div>
                          </div>
                          <div class="card-body text-center bg-light"
                            style="display: flex;justify-content: center;align-items: center;">
                            <div class="card-title h2 w3-animate-zoom" id="dispensor">{{ $latestData-> dispensor == 1 ? 'ON' : 'HIGH'}}</div><!--if it is 1 it show on --->
                          </div></div>
                    </div>





                  </div></div>
                  <div class="col-lg-9 py-2 px-3"><div class="card border-0 shadow-sm " style="height: 15rem;">

                  <div style="position: absolute; top: 10px; right: 10px;">
          <button class="btn btn-sm btn-outline-secondary mx-1">Day</button>
          <button class="btn btn-sm btn-outline-secondary mx-1">Month</button>
          <button class="btn btn-sm btn-outline-secondary mx-1">Year</button>
        </div>
        <h4 class="title px-3 py-1">Working Hours</h4>
        <div style="width: 100%;height:100%;" >

          <canvas id="workingHoursChart"></canvas>
        </div>
                  </div></div>
                  </div>
                
              </div>
            </div>
          </div>
          <div class="row py-2">
            <div class="col-lg-12">
              <div class="card border-0 shadow-sm bg-light"  data-aos="fade-up" style="height: 23rem; position: relative;">
                <!-- Buttons -->
                <div style="position: absolute; top: 10px; right: 10px;">
                  <button class="btn btn-sm btn-outline-primary mx-1">Day</button>
                  <button class="btn btn-sm btn-outline-primary mx-1">Month</button>
                  <button class="btn btn-sm btn-outline-primary mx-1">Year</button>
                </div>

                <h4 class="title px-3 py-1">Water Production </h4>
                <div style="width: 100%;">
                  <canvas id="waterProductionChart" width="100%" height="300px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-2">
            <div class="col-lg-12">
              <div class="card border-0 shadow-sm bg-light" data-aos="fade-up" style="height: 23rem;  position: relative;">
                <!-- Buttons -->
                <div style="position: absolute; top: 10px; right: 10px;">
                  <button class="btn btn-sm btn-outline-info mx-1">Day</button>
                  <button class="btn btn-sm btn-outline-info mx-1">Month</button>
                  <button class="btn btn-sm btn-outline-info mx-1">Year</button>
                </div>

                <h4 class="title px-3 py-1">Current Consumption</h4>
                <div style="width: 100%;" >
                  <canvas id="currentConsumptionChart" width="100%" height="300px"></canvas>
                </div>
              </div>
            </div>
          </div>
          <div class="row p-2">
            <div class="col-lg-12">

              <div class="card border-0 shadow-sm bg-light pb-5" data-aos="fade-up" style="height: auto;  position: relative;">
                <div style="position: absolute; top: 10px; right: 250px;">
                <div class="card border-0 shadow-sm bg-secondary text-white mb-2 px-3 " style=" height: 2rem;width:20rem;">
                  <div class="row"><div class="col-5">Maintenance :</div><div class="col-7 text-white"><strong class="h4 text-info">30</strong> Days remaining</div></div>
    
    </div>
                </div>
                <!-- Buttons -->
                <div style="position: absolute; top: 10px; right: 10px;">
                  <button class="btn btn-sm btn-outline-info mx-1">Day</button>
                  <button class="btn btn-sm btn-outline-info mx-1">Month</button>
                  <button class="btn btn-sm btn-outline-info mx-1">Year</button>
                </div>

                <h4 class="title px-3 py-1" >Recent Logs</h4>
                <div style="width: 100%;">
                  
                </div>
              </div>
            </div>
          </div>
          </div>
          </div>
          </div>
          </div>
          <script>
                        function openModal() {
                            document.getElementById("myModal").style.display = "block";
                        }

                        function closeModal() {
                            document.getElementById("myModal").style.display = "none";
                        }

                        // Close the modal when clicking outside of the modal content
                        window.onclick = function (event) {
                            if (event.target == document.getElementById("myModal")) {
                                closeModal();
                            }
                        }

                    </script>

                    <div id="myModal" class="modal">
                        <div class="modal-content">
                            <span class="close" onclick="closeModal()">&times;</span>
                            <div class="col-lg-12 condition">
                                <div class="card border-0 shadow-sm p-5" style="
              height:35rem;background-color: #e2e2e2;">
                                    <!-- Datas  -->
                                     <!-- First Row -->
                                    <div class="row p-2">
                                       
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">

                                                        <div class="col-12">
                                                            VOLTAGE R
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="voltager">230 V</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                           VOLTAGE Y 
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="voltagey">340 V</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            VOLTAGE B
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="voltageb">260 V</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="height: 9rem;">
                                                <div class="card-header px-1  text-center">
                                                    <div class="row">
                                                        <div class="col-12" style="font-size:15px;">AVG VOLTAGE</div>
                                                        </div>
                                                        
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="avgvoltage">250 V</div>
                                                </div>
                                            </div>


                                        </div>
                                      

                                      

                                    </div>
                                    <!-- Second Row  -->
                                    <div class="row p-2">
                                       
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">

                                                        <div class="col-12">
                                                            CURRENT R
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="currentr">30 A</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                        CURRENT Y
                                                        </div>
                                                      
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="currenty">20 A</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            CURRENT B
                                                        </div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="currentb">10 A</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="card border-0 shadow-sm" style="height: 9rem;">
                                                <div class="card-header px-1  text-center">
                                                    <div class="row">
                                                        <div class="col-12" style="font-size:15px;">AVG CURRENT</div>
                                                      
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="avgcurrent">20 A</div>
                                                </div>
                                            </div>


                                        </div>
                                        

                                    </div>
                                    <!-- Third Row  -->
                                    <div class="row p-2">
                                       
                                        <div class="col-lg-6">
                                            <div class="card border-0 shadow-sm" style="
              height: 9rem;">
                                                <div class="card-header h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">
                                                            FREQUENCY
                                                        </div>
                                                   
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom " id="frequency">50 Hz</div>
                                                </div>


                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="card border-0 shadow-sm" style="height: 9rem;">
                                                <div class="card-header px-1 h6 text-center">
                                                    <div class="row">
                                                        <div class="col-12">KWH</div>
                                                        
                                                    </div>
                                                </div>
                                                <div class="card-body text-center bg-light"
                                                    style="display: flex;justify-content: center;align-items: center;">
                                                    <div class="card-title h2 w3-animate-zoom" id="kwh">200 Watts</div>
                                                </div>
                                            </div>
                                        </div>
                                        


                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

          <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://cdn.jsdelivr.net/npm/luxon"></script>
<script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-luxon"></script>

<!-- Working chart -->
<script>
  // Sample data (replace with your actual data fetched from API)
  const hours = ["1.00", "2.00", "3.00", "4.00", "5.00","6.00","7.00","9.00","10.0"];
  const minutes = [50, 30, 20, 10, 4,15,60,40,25]; // Sample liters produced per day

  // Ensure the DOM is fully loaded before running the script
  document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('workingHoursChart').getContext('2d');
    const workingHoursChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: hours,
        datasets: [{
          label: 'Working Minute',
          data: minutes,
          backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue color for bars
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          x: {
            title: {
              display: true,
              text: 'Hours'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Minutes'
            }
          }
        }
      }
    });
  });
</script>
<!-- Water Production  -->
<script>
  // Sample data (replace with your actual data fetched from API)
  const days = ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5"];
  const litersProduced = [500, 700, 600, 800, 750]; // Sample liters produced per day

  // Ensure the DOM is fully loaded before running the script
  document.addEventListener('DOMContentLoaded', (event) => {
    const ctx1 = document.getElementById('waterProductionChart').getContext('2d');
    const waterProductionChart = new Chart(ctx1, {
      type: 'bar',
      data: {
        labels: days,
        datasets: [{
          label: 'Water Production',
          data: litersProduced,
          backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue color for bars
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          x: {
            title: {
              display: true,
              text: 'Days'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'Liters'
            }
          }
        }
      }
    });
  });
</script>
<!-- Current Consumption -->
<script>
  // Sample data (replace with your actual data fetched from API)
  const days1 = ["Day 1", "Day 2", "Day 3", "Day 4", "Day 5"];
  const Produced = [500, 700, 600, 800, 750]; // Sample liters produced per day

  // Ensure the DOM is fully loaded before running the script
  document.addEventListener('DOMContentLoaded', (event) => {
    const ctx = document.getElementById('currentConsumptionChart').getContext('2d');
    const waterProductionChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: days1,
        datasets: [{
          label: 'Current Consumption',
          data: Produced,
          backgroundColor: 'rgba(54, 162, 235, 0.6)', // Blue color for bars
          borderColor: 'rgba(54, 162, 235, 1)',
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false,
        scales: {
          x: {
            title: {
              display: true,
              text: 'Days'
            }
          },
          y: {
            beginAtZero: true,
            title: {
              display: true,
              text: 'KWH'
            }
          }
        }
      }
    });
  });
</script>

<!-- Water Tank -->
<script src="https://d3js.org/d3.v6.min.js"></script>
<script>
        function createTankGauge(elementId, value) {
            const width = 350;
            const height = 400;
            const tankPadding = 40;
            const tankWidth = 200;
            const tankHeight = 250;
            const fillHeight = (value / 100) * tankHeight;

            const svg = d3.select("#" + elementId)
                .append("svg")
                .attr("width", width)
                .attr("height", height);

            // Draw the tank
            svg.append("ellipse")
                .attr("cx", width / 2)
                .attr("cy", tankPadding)
                .attr("rx", tankWidth / 2)
                .attr("ry", 20)
                .attr("class", "tank-top");

            svg.append("rect")
                .attr("x", width / 2 - tankWidth / 2)
                .attr("y", tankPadding)
                .attr("width", tankWidth)
                .attr("height", tankHeight)
                .attr("class", "tank-rect");

            // Fill the tank
            svg.append("rect")
                .attr("x", width / 2 - tankWidth / 2)
                .attr("y", tankPadding + tankHeight - fillHeight)
                .attr("width", tankWidth)
                .attr("height", fillHeight)
                .attr("class", "tank-fill");

            // Add the text inside the tank
            svg.append("text")
                .attr("x", width / 2)
                .attr("y", tankPadding + tankHeight - fillHeight / 2)
                .attr("class", "tank-text")
                .attr("text-anchor", "middle")
                .attr("dy", ".35em")
                .text(value + "%");

            // Add the labels
            const labels = [
            { text: "Full", value: 0 },
            { text: "90%", value: 50 },
            { text: "70 %", value: 100 },
            { text: "50 %", value: 150 },
            { text: "20 %", value: 200 },
            { text: "Empty", value: 250 }
        ];
            labels.forEach(label => {
                svg.append("text")
                    .attr("x", width / 2 + tankWidth / 2 + 20)
                    .attr("y", tankPadding + label.value)
                    .attr("class", "tank-label")
                    .text(label.text);

                svg.append("line")
                    .attr("x1", width / 2 + tankWidth / 2)
                    .attr("x2", width / 2 + tankWidth / 2 + 10)
                    .attr("y1", tankPadding + label.value)
                    .attr("y2", tankPadding + label.value)
                    .attr("stroke", "#ffffff");
            });
        }

        createTankGauge("tankgauge", {{$latestData->waterlevel}});
    </script>

@else
            <div class="popup">
                <p>No data found for the specified hardware ID.</p>
            </div>
        @endif
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>
<script>
  document.getElementById('back-button').addEventListener('click', function () {
    window.history.back();
  });
</script>
<script>
document.addEventListener("DOMContentLoaded", function() {
    const deviceStatusTimers = {};
    const STATUS_UPDATE_TIMEOUT = 60000; // 1 minute in milliseconds
    const deviceId = "{{ $projectName }}"; // Blade variable inserted here

    function updateProductStatus(data) {
        console.log("Received data: ", data);
        if (data.hw_id === deviceId) {
            const statusElement = document.getElementById('deviceStatus');
            const status = document.getElementById('onlinestatus');
            if (data.connection === 1) {
                statusElement.classList.remove('text-danger');
                statusElement.classList.add('text-success');
                status.textContent="Online";
            } else {
                statusElement.classList.remove('text-success');
                statusElement.classList.add('text-danger');
                status.textContent="Offline";
            }

            // Clear any existing timeout for this device
            if (deviceStatusTimers[data.hw_id]) {
                clearTimeout(deviceStatusTimers[data.hw_id]);
            }

            // Set a new timeout for this device
            deviceStatusTimers[data.hw_id] = setTimeout(() => {
                statusElement.classList.remove('text-success');
                statusElement.classList.add('text-danger');
            }, STATUS_UPDATE_TIMEOUT);
        }
    }

    function onMessageArrived(topic, message) {
        try {
            const data = JSON.parse(message.toString());
            console.log(data);
            updateProductStatus(data);
        } catch (e) {
            console.error("Failed to parse message payload:", e);
        }
    }

    // MQTT setup
    const client = mqtt.connect('ws://broker.hivemq.com:8000/mqtt');
    client.on('connect', function() {
        console.log("Connected to MQTT broker");
        client.subscribe('onlinestatus');
    });

    client.on('message', function(topic, message) {
        onMessageArrived(topic, message);
    });
});

</script>