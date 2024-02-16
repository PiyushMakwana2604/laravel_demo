@extends('admin.layouts.app')

@push('style')
@endpush


@section('content')
    <div class="content-page">
        <!-- Start content -->
        <div class="content">
            <div class="container">

                <!-- Page-Title -->
                <div class="row">
                    <div class="col-sm-12">
                        <h4 class="page-title">Edit Form</h4>
                        <ol class="breadcrumb">
                            <li>
                                <a href="#">Ubold</a>
                            </li>
                            <li>
                                <a href="#">Forms</a>
                            </li>
                            <li class="active">
                                General elements
                            </li>
                        </ol>
                    </div>
                </div>


                <!-- Forms -->
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card-box">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-8">

                                    <form role="form" method="post" enctype="multipart/form-data" action="route('admin.edit-form.post')">
                                        @csrf()
                                        <input type="hidden" name="id" value="{{ isset($user->id) ? $user->id : '' }}">
                                        <div class="form-group">
                                            <label for="first_name">First Name</label>
                                            <input type="text" class="form-control" name="first_name" value="{{ old('first_name',isset($user->first_name) ? $user->first_name : '') }}" id="first_name"
                                                placeholder="Enter First Name">
                                            @error('first_name')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="last_name">Last Name</label>
                                            <input type="text" class="form-control" name="last_name" value="{{ old('last_name',isset($user->last_name) ? $user->last_name : '') }}" id="last_name"
                                                placeholder="Enter Last Name">
                                            @error('last_name')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="profile_image">Profile Image</label>
                                            <input type="file" class="form-control" name="profile_image" id="profile_image"
                                                placeholder="Enter Profile Image">
                                            @error('profile_image')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="mobile">Mobile Number</label>
                                            <div style="display: flex">
                                                <div style="width:20%;margin-right: 1%;">
                                                    <input type="text" class="form-control" name="country_code" value="{{ old('country_code',isset($user->country_code) ? $user->country_code : '' )}}" id="country_code"
                                                        placeholder="+91">
                                                </div>
                                                <div style="width: -webkit-fill-available">
                                                    <input type="number" class="form-control" name="phone" value="{{ old('phone',isset($user->phone) ? $user->phone : '') }}" id="mobile"
                                                        placeholder="Enter Mobile Number">
                                                </div>
                                            </div>
                                            @error('country_code')
                                                <span class="error">{{$message}}</span>
                                            @enderror 
                                            @error('phone')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <label for="email">Email ID</label>
                                            <input type="email" class="form-control" name="email" value="{{old('email',isset($user->email) ? $user->email : '' )}}" id="email"
                                                placeholder="Enter Email Id">
                                            @error('email')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <div class="form-group">
                                            <select class="form-control" name="gender" aria-label="Default select example">
                                                <option disabled selected>Select Gender</option>
                                                <option value="male" @if(old('gender', isset($user->gender) ? $user->gender : '') === 'male') selected @endif>Male</option>
                                                <option value="female" @if(old('gender', isset($user->gender) ? $user->gender : '') === 'female') selected @endif>Female</option>
                                                <option value="other" @if(old('gender', isset($user->gender) ? $user->gender : '') === 'other') selected @endif>Other</option>
                                            </select>
                                            @error('gender')
                                                <span class="error">{{$message}}</span>
                                            @enderror
                                        </div>
                                        <button type="submit"
                                            class="btn btn-purple waves-effect waves-light">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div> <!-- container -->

        </div> <!-- content -->

        <footer class="footer">
            2015 © Ubold.
        </footer>

    </div>
@endsection

@push('script')
@endpush