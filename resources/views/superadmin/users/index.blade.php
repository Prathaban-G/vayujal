@include('components.head')



@include('components.header')
@include('components.offcanvas')
@include('components.aside')



<div class="main">
    <div class="container-fluid">
        <div class="row pt-2">
        <nav aria-label="breadcrumb ">

<ol class="breadcrumb mt-5  ">
    <li class="breadcrumb-item"><a href="home.php" ><i class="fa fa-home "></i></a></i></li>
    <li class="breadcrumb-item active " aria-current="page"><a href="{{ route('superadmin.users.index') }}" >User Management</a></li>
    
    <!-- <li class="breadcrumb-item active" aria-current="page">Data</li> -->
    <div class="container-fluid d-flex justify-content-end">
    <div class="form d-flex me-1 w-25 ">
                                  
                                  <input type="text" name="search" id="search" class="form-control me-1" size="50"
                                      placeholder="Search Here" onkeyup="searchFunction()">

                              </div>
        <button class="btn btn-secondary float-end py-1 px-3" id="addPage"><i class="fa fa-plus"></i><a  style="color: inherit;
            text-decoration: inherit;" href="{{ route('users.create') }}">Add</a></button>
       

       <button class="btn btn-primary float-end ms-2 py-1 px-3"><a href="{{ url('home') }}" style="  color: inherit;
        text-decoration: inherit;"><i class="fa fa-reply pe-2"
        aria-hidden="true"></i> back</a></button>
        

    </div>

</ol>
</nav>

        </div>
    </div>

    <div class="container-fluid px-5">
<div class="container-fluid shadow-sm border-top border-primary border-2 p-3" style="background-color: #fff;">
    <div class="row table-customer px-2 py-2">
        <div class="col-12">
            <div class="h4 mb-3">Users Details</div>
            <table class="table table-success table-bordered table-hover table-responsive w3-center w3-animate-zoom" id="usersTable">
                <thead>
                    <tr>
                        <th class="py-3">No</th>
                        <th class="py-3">User Name</th>
                        <th class="py-3">Email</th>
                        <th class="py-3">Products</th>
                        <th class="py-3">Action</th>
                    </tr>
                </thead>
                <tbody class="table-light" id="usersTableBody">
    @foreach ($users->where('type', 'user') as $user)
    <tr>
        <td>{{ $loop->iteration }}</td>
        <td>{{ $user->username }}</td>
        <td>{{ $user->email }}</td>
        <td>{{ $user->projectname}}</td>
        <td>
        <a href="{{ route('superadmin.users.edit', $user->id) }}" class="btn btn-success px-4 py-1 ms-1 me-1">Edit</a>
        <form action="{{ route('superadmin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" class="btn btn-danger px-2 py-1 ms-1 me-1">Delete</button>
        </form></td>
    </tr>
    @endforeach
    @if ($users->where('type', 'user')->count() === 0)
    <tr>
        <td colspan="5">No data available</td>
    </tr>
    @endif
</tbody>

            </table>
        </div>
    </div>
</div>
</div>
    </div>
    <script>
    function searchFunction() {
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
   
</script>
    @include('components.footer')
