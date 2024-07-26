@include('components.head')
@include('components.header')
@include('components.offcanvas')
@include('components.aside')
  <!-- Include the MQTT library -->
  <script src="https://unpkg.com/mqtt/dist/mqtt.min.js"></script>


<style>
        .deviceStatus {
            font-size: 26px;
        }
        .deviceStatus.text-success {
            color: green;
        }
        .deviceStatus.text-danger {
            color: red;
        }
    </style>
  <div>{{ Auth::user()->username }}</div>
    <div class="main">

        <div class="container-fluid ">
            <div class="row  ps-3 ">
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="home.html"><i class="fa fa-home "></i> Home </a></i></li>

</ul>
            </div>
            <div class="row  ">
                <div class="col-lg-12 col-md-12 main-chart">
                    <div class="row">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            
                                <div class="card   border-3 shadow-sm " id="expandCard">
                                    <div class="card-header text-primary h4"> Products Summary</div>
                                    <div class="card-body w3-animate-zoom " >
    
    
                                      
                                        <div class="card-title">Single Phase Units  - <span class="card-text h5 text-success">30</span></div>
                                        <div >
                                          

                                        </div>
                                        <div class="card-title ">Three Phase Units -  <span class="card-text h5 text-success">
                                            35

                                        </span></div>
                                       
                                        <div class="card-title ">Live Units</div>
                                        <div class="card-text h5 text-muted">
                                            Single Phase Unit - <span class="text-success">15</span>
                                        </div>
                                        <div class="card-text h5 text-muted">
                                            Three Phase Unit - <span class="text-success">15</span>
                                        </div>

                                
                                    </div>
                                </div>
                                <!-- Overall Production  -->
                                <div class="card  border-3 shadow-sm  mt-3 " id="expandCard">
                                    <div class="card-header text-primary h4"> Production</div>
                                    <div class="card-body py-2 w3-animate-zoom " >
    
    
                                        <div class="card-title">Single Phase Units</div>
                                        <div class="card-text h5 text-success">
                                            120 <span class="text-dark">LPD</span>
    
                                        </div>
                                        <div class="card-title ">Three Phase Units</div>
                                        <div class="card-text h5 text-success">
                                            120 <span class="text-dark">LPD</span>
    
                                        </div>
    
    
    
                             
                                </div>
                            </div>
                        </div>
                       
                       
                        <div class="col-lg-8 col-md-12 col-sm-12">
                            <div class="card border-3 shadow-sm ">

                                <div class="card-body chart1 w3-animate-zoom ">


                                    <div id="chart1"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                   

                            </div>
                  
                       
          


            </div>

            <div class="row mt-1 mb-2  ">
                <div class="col-lg-6 col-md-12  table-menu mb-5">
                    <div class="container-fluid card pt-3 mt-5 col-12 border  border-3 shadow-sm pt-2 pb-5 "
                        style="background-color: rgb(255, 255, 255);" id="tableContent">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="h4 text-primary">Single Phase</div>
                            </div>
                            <div class=" col-lg-8 container-fluid d-flex justify-content-end">

                                <div class="form d-flex  ">
                                    
                                    <input type="text" name="search" id="search" class="form-control me-1" size="50"
                                        placeholder="Search Here" onkeyup="myFunction()">

                                </div>
                            </div>
                        </div>


                        <table class="table table-info table-bordered mt-3 table-hover table-responsive w3-animate-zoom" id="usersTable">
    <thead>
        <tr class="h6">
            <th class="py-3">No</th>
            <th class="py-3">Product Name</th>
            <th class="py-3">Contact Person</th>
            <th class="py-3">Status</th>
            <th class="py-3">Action</th>
        </tr>
    </thead>
    <tbody class="table-light" id="usersTableBody">
        @foreach($singlePhaseProducts as $key => $product)
        <tr data-product-id="{{ $product->productname }}">
            <td>{{ $key + 1 }}</td>
            <td>{{ $product->productname }}</td>
            <td>{{ $product->contactperson }}</td>
           
            <td class="text-center"><i class="fa fa-circle text-danger deviceStatus" aria-hidden="true"></i></td>
         
            <td>
                <div class="row">
                    <div class="col-lg-5">
                    <a href="{{ route('dashboard', ['hw_id' => $product->productname]) }}" class="btn btn-primary px-2 py-1 ms-1 me-1">view</a>
                    </div>
                    <div class="col-lg-7">
                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success px-4 py-1 ms-1 me-1">Edit</a>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

                    </div>


                </div>
                <div class="col-lg-6 col-md-12 table-menu mb-5">
                    <div class="container-fluid mt-5 pt-3 col-12 card border border-3  shadow-sm pt-2 pb-5 "
                        style="background-color:rgb(255, 255, 255)" id="tableContent">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="h4 text-primary ">Three Phase</div>
                            </div>
                            <div class=" col-lg-8 container-fluid d-flex justify-content-end">

                                <div class="form d-flex  ">
                                  
                                    <input type="text" name="search" id="search1" class="form-control me-1" size="50"
                                        placeholder="Search Here" onkeyup="myFunction1()">

                                </div>
                            </div>
                        </div>


                        <table class="table table-info table-bordered mt-3 table-hover table-responsive w3-animate-zoom" id="usersTable">
                    <thead>
                        <tr class="h6">
                            <th class="py-3">No</th>
                            <th class="py-3">Product Name</th>
                            <th class="py-3">Contact Person</th>
                            <th class="py-3">Status</th>
                            <th class="py-3">Action</th>
                        </tr>
                    </thead>
                    <tbody class="table-light" id="usersTableBody">
                        @foreach($threePhaseProducts as $key => $product)
                        <tr data-product-id="{{ $product->productname }}">
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $product->productname }}</td>
                            <td>{{ $product->contactperson }}</td>
                            <td class="text-center"><i class="fa fa-circle text-danger deviceStatus" aria-hidden="true"></i></td>
                            <td>
                                <div class="row">
                                    <div class="col-lg-5">
                                    <a href="{{ route('threedashboard', ['hw_id' => $product->productname]) }}" class="btn btn-primary px-2 py-1 ms-1 me-1">view</a>
                                    </div>
                                    <div class="col-lg-7">
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success px-4 py-1 ms-1 me-1">Edit</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                    </div>


                </div>


            </div>
           
            <div class="row mt-1 mb-5">
                <div class="col-lg-12"><div class="card border-0 shadow-sm">
                    <div class="card-body pb-3"> 
                        <h5 class="card-title">Alarm Histroy </h5>
                    </div>
                   <div class="card-body">
                   <table class="table table-info table-bordered mt-2  table-hover table-responsive " data-aos="fade-up"
                            id="logTable" >
                            <thead >
                                <tr class="h6">
                                    <th class="py-3" width="5%">No</th>
                                    <th class="py-3" width="20%">Products</th>
                                    <th class="py-3" width="20%">Time</th>
                                    <th class="py-3" width="40%">Alarms</th>

                                    <th class="py-3" width="15%">Action</th>
                                </tr>
                            </thead>
                            <tbody  class="table-light">
                                <tr><td>1</td>
                            <td>HW-21</td>
                        <td>09-07-2024 11.00.30</td>
                    <td>Under Voltage Detected</td>
                <td><div class="btn btn-outline-primary">View</div></td></tr>
                <tr><td>2</td>
                            <td>HW-22</td>
                        <td>09-07-2024 1.00.30</td>
                    <td>Low Velocity Detected</td>
                <td><div class="btn btn-outline-primary">View</div></td></tr>
                            </tbody>
                            </table>
                   </div>
                </div></div>
                
            </div>
        </div>
        <footer>
            <h5 class="text-center" >&copy;All Rights Reserved Olive IOT</h5>
        </footer>
    </div>
    <button onclick="scrollToTop()" id="scrollToTop" style="float: right;margin-right:8px;cursor:pointer;"
        class="btn btn-secondary" title="Go to top"><i class="fa fa-arrow-up" aria-hidden="true"></i></button>
        @include('components.footer')
</body>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var options = {
          series: [{
          name: 'Three Phase',
          data: [44, 55, 57, 56, 61, 58, 63, 60, 66]
        }, {
          name: 'Single Phase',
          data: [76, 85, 101, 98, 87, 105, 91, 114, 94]
        }],
          chart: {
          type: 'bar',
          height: 350
        },

        plotOptions: {
          bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
          },
        },
        title: {
    text: "Water Dispenser Level",
    align: 'center',
    margin: 10,
    offsetX: 0,
    offsetY: 0,
    floating: false,
    style: {
      fontSize:  '14px',
      fontWeight:  'bold',
      fontFamily:  undefined,
      color:  '#263238'
    },
},
        dataLabels: {
          enabled: false
        },
        stroke: {
          show: true,
          width: 2,
          colors: ['transparent']
        },
        xaxis: {
          categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
        },
        yaxis: {
          title: {
            text: '$ (thousands)'
          }
        },
        fill: {
          opacity: 1
        },
        tooltip: {
          y: {
            formatter: function (val) {
              return "$ " + val + " thousands"
            }
          }
        }
        };

        var chart = new ApexCharts(document.querySelector("#chart1"), options);
        chart.render();
      
      
    


</script>

<script src="<https://unpkg.com/mqtt/dist/mqtt.min.js>"></script>
<script>
  // An mqtt variable will be initialized globally
  console.log(mqtt)
</script>
<script>
    function myFunction() {
        const input = document.getElementById('search');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('usersTable');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].innerText.toUpperCase();
                if (cellText.includes(filter)) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }
    document.getElementById('refresh').addEventListener('click', () => {
        window.location.reload();
    });

</script>
<script>
        document.addEventListener("DOMContentLoaded", function() {
            const deviceStatusTimers = {};
            const STATUS_UPDATE_TIMEOUT = 60000; // 1 minute in milliseconds

            function updateProductStatus(data) {
            console.log("Received data: ", data);
            const productRow = document.querySelector(`[data-product-id="${data.hw_id}"]`);
            if (productRow) {
                console.log("Product row found: ", productRow);
                const statusElement = productRow.querySelector('.deviceStatus');

                if (data.connection === 1) {
                    statusElement.classList.remove('text-danger');
                    statusElement.classList.add('text-success');
                    // statusElement.textContent = 'Online';
                } else {
                    statusElement.classList.remove('text-success');
                    statusElement.classList.add('text-danger');
                    // statusElement.textContent = 'Offline';
                }

                // Clear any existing timeout for this device
                if (deviceStatusTimers[data.hw_id]) {
                    clearTimeout(deviceStatusTimers[data.hw_id]);
                }

                // Set a new timeout for this device
                deviceStatusTimers[data.hw_id] = setTimeout(() => {
                    // Update the status to offline if no data is received in the timeout period
                    const row = document.querySelector(`[data-product-id="${data.hw_id}"]`);
                    if (row) {
                        const statusEl = row.querySelector('.deviceStatus');
                        statusEl.classList.remove('text-success');
                        statusEl.classList.add('text-danger');
                        statusEl.textContent = 'Offline';
                    }
                }, STATUS_UPDATE_TIMEOUT);
            } else {
                console.log("Product row not found for hw_id: ", data.hw_id);
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
            // host : mqtt-dashboard.com
            client.on('connect', function() {
                console.log("Connected to MQTT broker");
                client.subscribe('onlinestatus');
            });

            client.on('message', function(topic, message) {
                onMessageArrived(topic, message);
            });
        });
    </script>
<script>
    function myFunction1() {
        const input = document.getElementById('search1');
        const filter = input.value.toUpperCase();
        const table = document.getElementById('usersTable1');
        const rows = table.getElementsByTagName('tr');

        for (let i = 1; i < rows.length; i++) { // Start from index 1 to skip the header row
            const cells = rows[i].getElementsByTagName('td');
            let found = false;
            for (let j = 0; j < cells.length; j++) {
                const cellText = cells[j].innerText.toUpperCase();
                if (cellText.includes(filter)) {
                    found = true;
                    break;
                }
            }
            rows[i].style.display = found ? '' : 'none';
        }
    }
    document.getElementById('refresh1').addEventListener('click', () => {
        window.location.reload();
    });

</script>
<script src="scrollTop.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
  AOS.init();
</script>

</html>