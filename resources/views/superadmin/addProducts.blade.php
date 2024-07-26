@include('components.head')



@include('components.header')
@include('components.offcanvas')
@include('components.aside')

<div class="main">

<div class="container-fluid">
        <div class="row pt-3 ">
            <div class="col-lg-8"> <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ url('products') }}">Product Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('addProducts') }}">Add Products</a></li>
                </ol>
                
            </nav></div><div class="col-lg-4"><div class="d-flex justify-content-end">
                    <button class="btn btn-primary float-end ms-2 py-1 px-3">
                        <a href="{{ url('products') }}" style="color: inherit; text-decoration: inherit;">
                            <i class="fa fa-reply pe-2" aria-hidden="true"></i> back
                        </a>
                    </button>
                </div></div>
           
            
        </div>
    </div>

<div class="container-fluid px-5"><div class="container   border-top border-primary border-2 px-2  py-4" style="background-color: white;">

<form method="POST" action="{{ isset($product) ? route('products.update', $product->id) : route('products.store') }}">
    @csrf
    @if(isset($product))
        @method('PUT')
    @endif
    
    <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">

    <div class="row px-3 py-1">
        <div class="col-lg-6 col-sm-12">
            <!-- Product Name -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Product Name <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter Product Name" id="proname" name="productname" value="{{ $product->productname ?? '' }}" required>
                </div>
            </div>
            
            <!-- Contact Person -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Contact Person <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter User Name" id="ccname" name="contactperson" value="{{ $product->contactperson ?? '' }}" required>
                </div>
            </div>

            <!-- Product Type -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Products Type <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <select id="type" name="producttype" class="form-control" required>
                        <option value="">Select Type</option>
                        <option value="Single Phase" {{ isset($product) && $product->producttype == 'Single Phase' ? 'selected' : '' }}>Single Phase </option>
                        <option value="Three Phase" {{ isset($product) && $product->producttype == 'Three Phase' ? 'selected' : '' }}>Three Phase </option>
                    </select>
                </div>
            </div>
            <!-- Serial Number -->
            <div class="row">
                    <div class="col-lg-4 col-sm-12">
                        <h6 class="text-start text-dark px-2">Serial Number <span style="color: red;">*</span></h6>
                    </div>

                    <div class="col-lg-8 col-sm-12">
                        <input type="text" class="form-control" id="serialnumber" placeholder="Enter Serialnumber"
                            name="serialnumber" value="{{ $product->serialnumber ?? '' }}" required>
                    </div>

                </div>
            <!-- Mobile No -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2 ">Mobile No </h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="number" class="form-control" id="cmobile" placeholder="Enter Mobile Number" name="mobileno" value="{{ $product->mobileno ?? '' }}">
                </div>
            </div>

            <!-- Email -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Email </h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" id="cemail" placeholder="Enter Email" name="email" value="{{ $product->email ?? '' }}" >
                </div>
            </div>
        </div>
        
        <!-- Second Column -->
        <div class="col-lg-6 col-sm-12">
            <!-- Address -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Address </h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter Address" id="proname" name="address" value="{{ $product->address ?? '' }}">
                </div>
            </div>

            <!-- City -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">City</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter City" id="ccity" name="city" value="{{ $product->city ?? '' }}" required>
                </div>
            </div>

            <!-- Zip code -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Zip code</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="number" class="form-control" id="czipcode" placeholder="Enter Zip Code" name="zipcode" value="{{ $product->zipcode ?? '' }}">
                </div>
            </div>

            <!-- State -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">State </h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <select id="cstate1" name="state" class="form-control">
                    <option value="">Select state</option>
                        <option value="AN" {{ old('state', isset($product) ? $product->state : '') == 'AN' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                        <option value="AP" {{ old('state', isset($product) ? $product->state : '') == 'AP' ? 'selected' : '' }}>Andhra Pradesh</option>
                        <option value="AR" {{ old('state', isset($product) ? $product->state : '') == 'AR' ? 'selected' : '' }}>Arunachal Pradesh</option>
                        <option value="AS" {{ old('state', isset($product) ? $product->state : '') == 'AS' ? 'selected' : '' }}>Assam</option>
                        <option value="BR" {{ old('state', isset($product) ? $product->state : '') == 'BR' ? 'selected' : '' }}>Bihar</option>
                        <option value="CH" {{ old('state', isset($product) ? $product->state : '') == 'CH' ? 'selected' : '' }}>Chandigarh</option>
                        <option value="CT" {{ old('state', isset($product) ? $product->state : '') == 'CT' ? 'selected' : '' }}>Chhattisgarh</option>
                        <option value="DN" {{ old('state', isset($product) ? $product->state : '') == 'DN' ? 'selected' : '' }}>Dadra and Nagar Haveli</option>
                        <option value="DD" {{ old('state', isset($product) ? $product->state : '') == 'DD' ? 'selected' : '' }}>Daman and Diu</option>
                        <option value="DL" {{ old('state', isset($product) ? $product->state : '') == 'DL' ? 'selected' : '' }}>Delhi</option>
                        <option value="GA" {{ old('state', isset($product) ? $product->state : '') == 'GA' ? 'selected' : '' }}>Goa</option>
                        <option value="GJ" {{ old('state', isset($product) ? $product->state : '') == 'GJ' ? 'selected' : '' }}>Gujarat</option>
                        <option value="HR" {{ old('state', isset($product) ? $product->state : '') == 'HR' ? 'selected' : '' }}>Haryana</option>
                        <option value="HP" {{ old('state', isset($product) ? $product->state : '') == 'HP' ? 'selected' : '' }}>Himachal Pradesh</option>
                        <option value="JK" {{ old('state', isset($product) ? $product->state : '') == 'JK' ? 'selected' : '' }}>Jammu and Kashmir</option>
                        <option value="JH" {{ old('state', isset($product) ? $product->state : '') == 'JH' ? 'selected' : '' }}>Jharkhand</option>
                        <option value="KA" {{ old('state', isset($product) ? $product->state : '') == 'KA' ? 'selected' : '' }}>Karnataka</option>
                        <option value="KL" {{ old('state', isset($product) ? $product->state : '') == 'KL' ? 'selected' : '' }}>Kerala</option>
                        <option value="LA" {{ old('state', isset($product) ? $product->state : '') == 'LA' ? 'selected' : '' }}>Ladakh</option>
                        <option value="LD" {{ old('state', isset($product) ? $product->state : '') == 'LD' ? 'selected' : '' }}>Lakshadweep</option>
                        <option value="MP" {{ old('state', isset($product) ? $product->state : '') == 'MP' ? 'selected' : '' }}>Madhya Pradesh</option>
                        <option value="MH" {{ old('state', isset($product) ? $product->state : '') == 'MH' ? 'selected' : '' }}>Maharashtra</option>
                        <option value="MN" {{ old('state', isset($product) ? $product->state : '') == 'MN' ? 'selected' : '' }}>Manipur</option>
                        <option value="ML" {{ old('state', isset($product) ? $product->state : '') == 'ML' ? 'selected' : '' }}>Meghalaya</option>
                        <option value="MZ" {{ old('state', isset($product) ? $product->state : '') == 'MZ' ? 'selected' : '' }}>Mizoram</option>
                        <option value="NL" {{ old('state', isset($product) ? $product->state : '') == 'NL' ? 'selected' : '' }}>Nagaland</option>
                        <option value="OR" {{ old('state', isset($product) ? $product->state : '') == 'OR' ? 'selected' : '' }}>Odisha</option>
                        <option value="PY" {{ old('state', isset($product) ? $product->state : '') == 'PY' ? 'selected' : '' }}>Puducherry</option>
                        <option value="PB" {{ old('state', isset($product) ? $product->state : '') == 'PB' ? 'selected' : '' }}>Punjab</option>
                        <option value="RJ" {{ old('state', isset($product) ? $product->state : '') == 'RJ' ? 'selected' : '' }}>Rajasthan</option>
                        <option value="SK" {{ old('state', isset($product) ? $product->state : '') == 'SK' ? 'selected' : '' }}>Sikkim</option>
                        <option value="TN" {{ old('state', isset($product) ? $product->state : '') == 'TN' ? 'selected' : '' }}>Tamil Nadu</option>
                        <option value="TG" {{ old('state', isset($product) ? $product->state : '') == 'TG' ? 'selected' : '' }}>Telangana</option>
                        <option value="TR" {{ old('state', isset($product) ? $product->state : '') == 'TR' ? 'selected' : '' }}>Tripura</option>
                        <option value="UP" {{ old('state', isset($product) ? $product->state : '') == 'UP' ? 'selected' : '' }}>Uttar Pradesh</option>
                        <option value="UT" {{ old('state', isset($product) ? $product->state : '') == 'UT' ? 'selected' : '' }}>Uttarakhand</option>
                        <option value="WB" {{ old('state', isset($product) ? $product->state : '') == 'WB' ? 'selected' : '' }}>West Bengal</option>
                    </select>
                </div>
            </div>

            <!-- Add Info -->
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Add Info</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <textarea class="form-control" rows="5" id="ccomment" name="info">{{ $product->info ?? '' }}</textarea>
                </div>
            </div>
        </div>

        <!-- Buttons -->
        <div class="row mt-3">
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary text-white px-3 py-1" id="save"><i class="fa fa-check me-2" aria-hidden="true"></i> Save</button>
                <button type="reset" class="btn btn-secondary text-white ms-5 px-3 py-1" id="clearInput"><i class="fa fa-times me-2" aria-hidden="true"></i>Clear</button>
            </div>
        </div>
    </div>
</form>




</div></div>
    
</div>
@include('components.footer')