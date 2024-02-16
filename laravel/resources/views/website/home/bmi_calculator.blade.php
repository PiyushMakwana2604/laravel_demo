@if (session('data'))
    @php
        $data = session('data');
    @endphp
@endif
<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Gym Template">
    <meta name="keywords" content="Gym, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Gym | BMI Calculator</title>
    @include('website.inc/stylesheet')
    <style>
        input.parsley-success,
        select.parsley-success,
        textarea.parsley-success {
            color: #468847;
            background-color: #DFF0D8;
            border: 1px solid #D6E9C6;
        }

        input.parsley-error,
        select.parsley-error,
        textarea.parsley-error {
            color: #B94A48;
            background-color: #F2DEDE;
            border: 1px solid #EED3D7;
        }

        .parsley-errors-list {
            margin: 2px 0 3px;
            padding: 0;
            list-style-type: none;
            font-size: 0.9em;
            line-height: 0.9em;
            opacity: 0;
            color: #B94A48;

            transition: all .3s ease-in;
            -o-transition: all .3s ease-in;
            -moz-transition: all .3s ease-in;
            -webkit-transition: all .3s ease-in;
        }

        .parsley-errors-list.filled {
            opacity: 1;
        }
        .select-gender{
            font-size: 14px;
            color: #c4c4c4;
            width: 100%;
            height: 50px;
            border: 1px solid #363636;
            padding-left: 20px;
            padding-right: 5px;
            background: inherit;
            margin-bottom: 20px;
        }
    </style>
</head>

<body>

    <!-- Header Section Begin -->
        @include('website.inc/header')
    <!-- Header End -->

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('gym_assets/img/breadcrumb-bg.jpg')}}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb-text">
                        <h2>BMI calculator</h2>
                        <div class="bt-option">
                            <a href="{{route('website.home-page')}}">Home</a>
                            <a href="#">Pages</a>
                            <span>BMI calculator</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- BMI Calculator Section Begin -->
    <section class="bmi-calculator-section spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="section-title chart-title">
                        <span>check your body</span>
                        <h2>BMI CALCULATOR CHART</h2>
                    </div>
                    <div class="chart-table">
                        <table>
                            <thead>
                                <tr>
                                    <th>Bmi</th>
                                    <th>WEIGHT STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="point">Below 18.5</td>
                                    <td>Underweight</td>
                                </tr>
                                <tr>
                                    <td class="point">18.5 - 24.9</td>
                                    <td>Healthy</td>
                                </tr>
                                <tr>
                                    <td class="point">25.0 - 29.9</td>
                                    <td>Overweight</td>
                                </tr>
                                <tr>
                                    <td class="point">30.0 - and Above</td>
                                    <td>Obese</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title chart-calculate-title">
                        <span>check your body</span>
                        <h2>CALCULATE YOUR BMI</h2>
                    </div>
                    <div class="chart-calculate-form">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Quis ipsum suspendisse ultrices gravida. Risus commodo
                            viverra maecenas accumsan lacus vel facilisis.</p>
                        <form method="post" data-parsley-validate=""  action="{{ route('website.bmiCalculator.post') }}">
                            @csrf
                            @if (session('success'))
                                <div class="alert alert-success" role="alert">
                                    Your Bmi : {{ session('success')->bmi }}
                                    <span class="close-btn" style="float: right;cursor: pointer;">&times;</span>
                                </div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger" role="alert">
                                    {{ session('error') }}
                                    <span class="close-btn" style="float: right;cursor: pointer;">&times;</span>
                                </div>
                            @endif
                            <div class="row">
                                    <div class="col-sm-6">
                                        <input type="number" name="height" value="{{old('height',isset($data['height']) ? $data['height'] : '')}}" placeholder="Height / cm" required>
                                        @error('height')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" name="weight" value="{{old('weight',isset($data['weight']) ? $data['weight'] : '')}}" placeholder="Weight / kg" required>
                                        @error('weight')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                        <input type="number" name="age" value="{{old('age',isset($data['age']) ? $data['age'] : '')}}" placeholder="Age" required>
                                        @error('age')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-sm-6">
                                       <select class="form-control select-gender" name="gender" aria-label="gender" placeholder="select gender" style="background: #151515;" required>
                                            <option disabled selected>select gender</option>
                                            <option value="male" @if(old('gender',isset($data['gender']) ? $data['gender'] : '') === 'male') selected @endif>Male</option>
                                            <option value="female" @if(old('gender',isset($data['gender']) ? $data['gender'] : '') === 'female') selected @endif>Female</option>
                                            <option value="other" @if(old('gender',isset($data['gender']) ? $data['gender'] : '') === 'other') selected @endif>Other</option>
                                        </select>
                                        @error('gender')
                                            <span class="error">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="col-lg-12">
                                        <button type="submit">Calculate</button>
                                    </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- BMI Calculator Section End -->

    <!-- Footer Section Begin -->
        @include('website.inc/footer')
    <!-- Footer Section End -->

    <!-- Js Plugins -->
    @include('website.inc/script')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.min.js" integrity="sha512-eyHL1atYNycXNXZMDndxrDhNAegH2BDWt1TmkXJPoGf1WLlNYt08CSjkqF5lnCRmdm3IrkHid8s2jOUY4NIZVQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>


</body>

</html>