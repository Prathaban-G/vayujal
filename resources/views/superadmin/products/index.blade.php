@include('components.head')



@include('components.header')
@include('components.offcanvas')
@include('components.aside')
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


  </style>
<div class="main">
    <div class="container-fluid">
        <div class="container-fluid">
            <div class="row">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mt-5">
                        <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
                        <li class="breadcrumb-item active" aria-current="page"><a href="{{ route('superadmin.products.index') }}">Products</a></li>
                        <div class="container-fluid d-flex justify-content-end">
                            <div class="form d-flex me-4 pe-5">
                                <input type="text" name="search" id="search" class="form-control me-1" placeholder="Search Here">
                                <button class="btn btn-warning" type="button" id="searchTable">Search</button>
                            </div>
                            <button class="btn btn-secondary float-end py-1 px-3" id="addPage"><i class="fa fa-plus"></i><a href="{{ route('products.create') }}" style="color: inherit; text-decoration: inherit;">Add</a></button>
                            <button class="btn btn-primary float-end ms-2 py-1 px-3"><a href="{{ url('home') }}" style="color: inherit; text-decoration: inherit;"><i class="fa fa-reply pe-2" aria-hidden="true"></i> back</a></button>
                        </div>
                    </ol>
                </nav>
            </div>
        </div>

        <div class="container-fluid px-5">
            <div class="container-fluid shadow-sm border-top border-primary border-2 p-3" style="background-color: #fff;">
                <div class="row table-customer px-2 py-2">
                    <div class=" col-12">
                        <div class="h4 mb-3">Products Details</div>
                        <table class="table table-success table-bordered table-hover table-responsive w3-center w3-animate-zoom" id="usersTable">
                            <thead>
                                <tr>
                                    <th class="py-3">No</th>
                                    <th class="py-3">Product Name</th>
                                    <th class="py-3">City</th>
                                    <th class="py-3">Type</th>
                                    <th class="py-3">Action</th>
                                </tr>
                            </thead>
                            <tbody class="table-light" id="usersTableBody">
                                @forelse ($products as $product)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $product->productname }}</td>
                                    <td>{{ $product->city }}</td>
                                    <td>
                                        @if ($product->producttype == 'Single Phase')
                                            Single Phase
                                        @else
                                            Three Phase
                                        @endif
                                    </td>
                                    <td>
                                    <a href="{{ route('products.edit', $product->id) }}" class="btn btn-success px-4 py-1 ms-1 me-1">Edit</a>
                                    <a href="{{ route('parameter.show', $product->productname) }}" class="btn btn-primary px-2 py-1 ms-1 me-1">Parameter</a>

                                        <form action="{{ route('products.destroy', $product->id) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger px-2 py-1 ms-1 me-1">Delete</button>
                </form>
                                        @if ($product->type == 'Single Phase')
                                        <a href="{{ route('dashboard', ['hw_id' => $product->productname]) }}" class="btn btn-primary px-2 py-1 ms-1 me-1">view</a>
                                        @else
                                        <a href="{{ route('dashboard', ['hw_id' => $product->productname]) }}" class="btn btn-primary px-2 py-1 ms-1 me-1">view</a>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No data available</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>

<script>
  document.getElementById('back-button').addEventListener('click', function () {
    window.history.back();
  });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-danger').forEach(button => {
            button.addEventListener('click', function(event) {
                if (!confirm('Are you sure you want to delete this product?')) {
                    event.preventDefault();
                }
            });
        });
    });
</script>
@include('components.footer')
