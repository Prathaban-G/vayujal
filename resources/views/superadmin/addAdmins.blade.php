@include('components.head')



@include('components.header')
@include('components.offcanvas')
@include('components.aside')

<div class="main">
    <div class="container-fluid">
        <div class="row pt-2">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mt-3">
                    <li class="breadcrumb-item"><a href="{{ url('home') }}"><i class="fa fa-home"></i></a></li>
                    <li class="breadcrumb-item"><a href="{{ url('admins') }}">Admin Management</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><a href="{{ url('addAdmins') }}">Add Admin</a>
                    </li>
                </ol>
                <div class="container-fluid d-flex justify-content-end">
                    <button class="btn btn-primary float-end ms-2 py-1 px-3">
                        <a href="{{ url('admins') }}" style="color: inherit; text-decoration: inherit;">
                            <i class="fa fa-reply pe-2" aria-hidden="true"></i> back
                        </a>
                    </button>
                </div>
            </nav>
        </div>
    </div>

    <div class="container-fluid px-5">
        <div class="container shadow-sm border-top border-primary border-2 px-2 py-4"
            style="background-color: rgba(255, 255, 255, 0.637);">
            <form method="POST" action="{{ isset($user) ? route('superadmin.users.update', $user->id) : route('superadmin.users.store') }}">
    @csrf
    @if(isset($user))
        @method('PUT')
    @endif

    <div class="row px-3 py-1">
        <div class="col-lg-6 col-sm-12">
            <div class="row" style="display: none;">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark p-2">Type of User</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <select id="selectType" name="type" class="form-control">
                       
                        <option  value="admin" selected>Admin</option>
              
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">User Name  <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter User Name" id="ccname" name="username" value="{{ old('username', isset($user) ? $user->username : '') }}"  required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Email Id  <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="email" id="cemail" class="form-control" placeholder="Enter email" name="email" value="{{ old('email', isset($user) ? $user->email : '') }}" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Password  <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="password" class="form-control" id="cpname" placeholder="Enter Password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Mobile No  <span style="color: red;">*</span></h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="number" class="form-control" id="cmobile" placeholder="Enter Mobile Number" name="mobileno" value="{{ old('mobileno', isset($user) ? $user->mobileno : '') }}" required>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-sm-12">
     
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">City</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="text" class="form-control" placeholder="Enter City" id="ccity" name="city" value="{{ old('city', isset($user) ? $user->city : '') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Zip code</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <input type="number" class="form-control" id="czipcode" placeholder="Enter Zip Code" name="zipcode" value="{{ old('zipcode', isset($user) ? $user->zipcode : '') }}">
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">State</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <select id="cstate1" name="state" class="form-control">
                        <option value="">Select state</option>
                        <option value="AN" {{ old('state', isset($user) ? $user->state : '') == 'AN' ? 'selected' : '' }}>Andaman and Nicobar Islands</option>
                        <option value="AP" {{ old('state', isset($user) ? $user->state : '') == 'AP' ? 'selected' : '' }}>Andhra Pradesh</option>
                        <option value="AR" {{ old('state', isset($user) ? $user->state : '') == 'AR' ? 'selected' : '' }}>Arunachal Pradesh</option>
                        <option value="AS" {{ old('state', isset($user) ? $user->state : '') == 'AS' ? 'selected' : '' }}>Assam</option>
                        <option value="BR" {{ old('state', isset($user) ? $user->state : '') == 'BR' ? 'selected' : '' }}>Bihar</option>
                        <option value="CH" {{ old('state', isset($user) ? $user->state : '') == 'CH' ? 'selected' : '' }}>Chandigarh</option>
                        <option value="CT" {{ old('state', isset($user) ? $user->state : '') == 'CT' ? 'selected' : '' }}>Chhattisgarh</option>
                        <option value="DN" {{ old('state', isset($user) ? $user->state : '') == 'DN' ? 'selected' : '' }}>Dadra and Nagar Haveli</option>
                        <option value="DD" {{ old('state', isset($user) ? $user->state : '') == 'DD' ? 'selected' : '' }}>Daman and Diu</option>
                        <option value="DL" {{ old('state', isset($user) ? $user->state : '') == 'DL' ? 'selected' : '' }}>Delhi</option>
                        <option value="GA" {{ old('state', isset($user) ? $user->state : '') == 'GA' ? 'selected' : '' }}>Goa</option>
                        <option value="GJ" {{ old('state', isset($user) ? $user->state : '') == 'GJ' ? 'selected' : '' }}>Gujarat</option>
                        <option value="HR" {{ old('state', isset($user) ? $user->state : '') == 'HR' ? 'selected' : '' }}>Haryana</option>
                        <option value="HP" {{ old('state', isset($user) ? $user->state : '') == 'HP' ? 'selected' : '' }}>Himachal Pradesh</option>
                        <option value="JK" {{ old('state', isset($user) ? $user->state : '') == 'JK' ? 'selected' : '' }}>Jammu and Kashmir</option>
                        <option value="JH" {{ old('state', isset($user) ? $user->state : '') == 'JH' ? 'selected' : '' }}>Jharkhand</option>
                        <option value="KA" {{ old('state', isset($user) ? $user->state : '') == 'KA' ? 'selected' : '' }}>Karnataka</option>
                        <option value="KL" {{ old('state', isset($user) ? $user->state : '') == 'KL' ? 'selected' : '' }}>Kerala</option>
                        <option value="LA" {{ old('state', isset($user) ? $user->state : '') == 'LA' ? 'selected' : '' }}>Ladakh</option>
                        <option value="LD" {{ old('state', isset($user) ? $user->state : '') == 'LD' ? 'selected' : '' }}>Lakshadweep</option>
                        <option value="MP" {{ old('state', isset($user) ? $user->state : '') == 'MP' ? 'selected' : '' }}>Madhya Pradesh</option>
                        <option value="MH" {{ old('state', isset($user) ? $user->state : '') == 'MH' ? 'selected' : '' }}>Maharashtra</option>
                        <option value="MN" {{ old('state', isset($user) ? $user->state : '') == 'MN' ? 'selected' : '' }}>Manipur</option>
                        <option value="ML" {{ old('state', isset($user) ? $user->state : '') == 'ML' ? 'selected' : '' }}>Meghalaya</option>
                        <option value="MZ" {{ old('state', isset($user) ? $user->state : '') == 'MZ' ? 'selected' : '' }}>Mizoram</option>
                        <option value="NL" {{ old('state', isset($user) ? $user->state : '') == 'NL' ? 'selected' : '' }}>Nagaland</option>
                        <option value="OR" {{ old('state', isset($user) ? $user->state : '') == 'OR' ? 'selected' : '' }}>Odisha</option>
                        <option value="PY" {{ old('state', isset($user) ? $user->state : '') == 'PY' ? 'selected' : '' }}>Puducherry</option>
                        <option value="PB" {{ old('state', isset($user) ? $user->state : '') == 'PB' ? 'selected' : '' }}>Punjab</option>
                        <option value="RJ" {{ old('state', isset($user) ? $user->state : '') == 'RJ' ? 'selected' : '' }}>Rajasthan</option>
                        <option value="SK" {{ old('state', isset($user) ? $user->state : '') == 'SK' ? 'selected' : '' }}>Sikkim</option>
                        <option value="TN" {{ old('state', isset($user) ? $user->state : '') == 'TN' ? 'selected' : '' }}>Tamil Nadu</option>
                        <option value="TG" {{ old('state', isset($user) ? $user->state : '') == 'TG' ? 'selected' : '' }}>Telangana</option>
                        <option value="TR" {{ old('state', isset($user) ? $user->state : '') == 'TR' ? 'selected' : '' }}>Tripura</option>
                        <option value="UP" {{ old('state', isset($user) ? $user->state : '') == 'UP' ? 'selected' : '' }}>Uttar Pradesh</option>
                        <option value="UT" {{ old('state', isset($user) ? $user->state : '') == 'UT' ? 'selected' : '' }}>Uttarakhand</option>
                        <option value="WB" {{ old('state', isset($user) ? $user->state : '') == 'WB' ? 'selected' : '' }}>West Bengal</option>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-12">
                    <h6 class="text-start text-dark px-2">Address</h6>
                </div>
                <div class="col-lg-8 col-sm-12">
                    <textarea class="form-control" rows="5" id="ccomment" name="address">{{ old('address', isset($user) ? $user->address : '') }}</textarea>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-3">
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary text-white px-3 py-1" id="save">
                <i class="fa fa-check me-2" aria-hidden="true"></i> {{ isset($user) ? 'Update' : 'Save' }}
            </button>
            <button type="reset" class="btn btn-secondary text-white ms-5 px-3 py-1" >
                <i class="fa fa-times me-2" aria-hidden="true"></i> Clear
            </button>
        </div>
    </div>
</form>
        </div>
    </div>
</div>

@include('components.footer')

