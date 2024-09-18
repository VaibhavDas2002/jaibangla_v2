<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, minimum-scale=0.1" />
    <title>Jai Bangla | Government of West Bengal</title>
    <link rel="icon" type="image/png" sizes="32x32" href="images/biswofab.png" />
    <link rel="stylesheet" href="{{ asset('css/styles/login.css') }}" type="text/css">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div class="container">
        <div class="inner-container">
            <div class="row mb-3 justify-content-center">
                <div class="col-md-12 text-center">
                    <div class="font_increase">
                        <ul class="bar nav nav-pills">
                            <li>
                                <div id="largerTextLink">A+</div>
                            </li>
                            <li>
                                <div id="smallerTextLink">A-</div>
                            </li>
                            <li>
                                <div id="resetFont">A</div>
                            </li>
                            <li class="last_one"><a href="#">Screen Reader</a></li>
                        </ul>
                    </div>
                    <div class="float-right">
                        <div>
                            <input type="checkbox" class="checkbox" id="checkbox">
                            <label for="checkbox" class="label">
                                <i class="fas fa-moon"></i>
                                <i class='fas fa-sun'></i>
                                <div class='ball'></div>
                            </label>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <div class="col-xs-12 col-sm-3 col-md-2 text-center">
                    <img class="biswo img-fluid" src="images/biswo.png" alt="Alternate Text" />
                </div>
                <div class="col-xs-12 col-sm-9 col-md-10 text-center">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="paschimbanga_sarkar">
                                <h2>পশ্চিমবঙ্গ সরকার</h2>
                                <h3>Government Of West Bengal</h3>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="bg_blue">
                                <h2>জয় বাংলা</h2>
                            </div>
                            <div class="pb_wb">
                                <h4>পশ্চিমবঙ্গ সরকারের সমস্ত সামাজিক পেনশন প্রকল্পের</h4>
                                <h3>One Umbrella Scheme</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3 justify-content-center">
                <div class="col-xs-12 col-sm-5 col-md-6 text-center">
                    <div class="alert alert-danger" role="alert">
                        Site will be down from 8 pm to 9 pm on every Saturday and Tuesday for maintenance
                    </div>
                </div>
            </div>

            <div class="row justify-content-center">
                <div class="col-xs-12 col-sm-7 col-md-4 text-center">
                    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        <table width="100%" class="adminlogintable">
                            <tr>
                                <td>
                                    @if (session('msg'))
                                        <div class="alert alert-danger">
                                            {{ session('msg') }}
                                        </div>
                                    @endif
                                    @if (session('otp'))
                                        <div class="alert alert-success">
                                            {{ session('otp') }}
                                        </div>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <input id="email" type="text" maxlength="100" class="form-control" name="email"
                                        value="{{ old('email') }}" placeholder="Enter Registered email." required
                                        autofocus autocomplete="username">
                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="style6">
                                    <div class="captcha">
                                        <span>{!! captcha_img('math') !!}</span>
                                        <a href="{{ route('login') }}">
                                            <img src="{{ asset('images/refresh1.png') }}" id="refresh"
                                                alt="Refresh Captcha">
                                        </a>
                                    </div>
                                    <span id="lbl_captcha"></span>
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="style2">
                                    <input id="captcha" type="text" class="mob form-control" name="captcha"
                                        value="{{ old('captcha') }}" placeholder="Enter captcha" autocomplete="off"
                                        required autofocus>
                                    @if ($errors->has('captcha'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('captcha') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="style2">
                                    <input id="password" type="password" minlength="8" class="mob form-control"
                                        name="password" value="{{ old('password') }}" placeholder="Enter password"
                                        autocomplete="off" required autofocus>
                                    @if ($errors->has('password'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td align="center" class="style4">
                                    <button type="submit" class="btn btn-success btnlogin">
                                        Login
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
                                    <a class="btn btn-primary btnotp" href="{{ route('password.request') }}">
                                        Generate OTP
                                    </a>
                                </td>
                            </tr>
                        </table>
                    </form>
                </div>
            </div>
            <div class="footer" align="center">
                <span class="footer-text">Site Designed & Developed by</span> <a href="http://www.nic.in/"
                    target="_blank" class="nic">National
                    Informatics Centre</a> <br /> <span id="Label1">Best Viewed in Google
                    Chrome</span>
                <a href="#exampleModal" data-bs-target="#exampleModal" id="ld" data-bs-toggle="modal">Legal
                    Disclaimer|</a>&nbsp;
                <a href="{{ route('copyright-policy') }}" target="_blank" id="copyright">Copyright Policy</a>|
                <a target="_blank" href="{{ route('privacy-policy') }}" id="privacy">Privacy Policy</a>|
                <a target="_blank" href="{{ route('hyperlink-policy') }}" id="hyperlink">Hyperlink Policy</a>|
                <a target="_blank" href="{{ route('terms-policy') }}" id="terms">Terms & Condition</a>
            </div>

            <div class="row list-row">
                <!-- Additional content goes here -->
            </div>
        </div>


    </div>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Legal Disclaimer</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>All efforts have been made to make the information as accurate as possible. Respective
                        Departments, Govt of West Bengal or Department of Finance as Nodal or National Informatics
                        Centre (NIC), will not be responsible for any loss to any person caused by inaccuracy in the
                        information available on this Website. Any discrepancy found may be brought to the notice of
                        respective departments, Govt of West Bengal or Department of Finance as Nodal or National
                        Informatics Centre (NIC). The content / information / data owned & maintained by respective
                        department along with Department of Finance as Nodal Department.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- </form> -->
    <script src="{{ asset('js/scripts/login.js') }}"></script>
</body>

</html>