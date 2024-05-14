<?php ob_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>::TPSN RESULT::</title>
    <!-- Favicon-->
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">
    <link href='https://fonts.googleapis.com/css?family=Nunito Sans' rel='stylesheet'>

    <style type="text/css">
        * {
            box-sizing: border-box;
            font-size: 11px;
        }

        @font-face {
            font-family: "nunito-sans-regular";
            src: local("Source Sans Pro"), url("fonts/nunito-sans.regular.ttf") format("truetype");
            font-weight: normal;
            font-style: normal;
        }

        body {
            margin: 0 auto;
            margin-top: -3em;
            margin-bottom: -1em;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        #content{
        }

        .first-row {
            margin-left: -10px;
            margin-top: 1.5em; 
            justify-content: center;
            /* background-color: yellow; */
        }
        .upper-title{
            font-weight: bold;
        }
        #tpsn-logo {
            height: 105px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .col-1{
            width: 50%;
            display:inline;
            float: left;
            /* background-color:blue; */
        }
        .col-2{
            width: 50%;
            float: right;
            display:inline;
            margin-left: 1em;
            /* background-color: red; */
        }

        .second-row {
            margin-left: -11px;
            margin-top: 12em; 
            justify-content: center;
            /* background-color: yellow; */
        }
        .col-3{
            width: 50%;
            display:inline;
            float: left;
            /* background-color:blue; */
        }
        #patient-address {
            width: 80%;
        }
        .col-4{
            width: 50%;
            float: right;
            display:inline;
            margin-left: 1em;
            /* background-color: red; */
        }

        .third-row{
            margin-left: -12px;
            margin-top: 17em; 
            justify-content: center;
        }
        .divider{
            border: 1px solid black;
            border-radius: 1px;
        }

        .fourth-row{
            margin-left: -12px;
            margin-top: 1em; 
            justify-content: center;
        }
        .col-5{
            width: 60%;
            display:inline;
            float: left;
            margin: 5px;
            /* background-color: red; */
        }
        .col-6{
            width: 40%;
            float: right;
            display:inline;
            margin-left: 1em;
            padding-top: 20;
            /* background-color: blue; */
        }
        .result-label{
            margin-top: 5px;
            font-size: 3rem;
            font-weight: bold;
            color: maroon;
        }
        .result-negative{
            margin-top: 5px;
            font-size: 3rem;
            font-weight: bold;
            color: green;
        }
        .result-positive{
            margin-top: 5px;
            font-size: 3rem;
            font-weight: bold;
            color: maroon;
        }
        .result-unupdated{
            margin-top: 5px;
            font-size: 3rem;
            font-weight: bold;
            color: gray;
        }
        
        #tpsn_barcode{
            margin-left: 1em;
            margin-top: 1em;
            height: 45px;
        }
        #tpsn_barcode_text{
            width: 60%;
            text-align: center;
        }
        #scan_qrcode{
            height: 240px;
        }
        .result-description{
            margin-top: -1.5em;
            font-size: 1.6rem;
            width: 70%;
        }


        .fifth-row{
            margin-left: -12px;
            margin-top: 28em; 
            justify-content: center;
        }
        
        .sixth-row{

        }

        .seventh-row{
            margin-top: 1em;
        }
        .seventh-row > p{
            margin: 5px;
        }


        .eight-row{
            margin-top: 3em;
            justify-content: center;
            text-align: center;
            /* background-color: green; */
        }
        .col-7{
            width: 50%;
            display:inline-block;
            float:left;
            /* background-color: red; */
        }
        .col-8{
            width: 50%;
            display:inline-block;
            float:left;
            /* background-color: yellow; */
        }
        #signature_performed_value{
            height: 60px;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            text-align: center;
            /* background-color: green; */
        }
        .performed_name_value{
            margin-top: -2em;
        }
        .performed-medicalname{
            display: block;
            text-transform: uppercase;
            font-size: 6;
            font-weight: bold;
        }
        .performed_licensed_number {
            font-size: 6;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }
        .performed_labels {
            margin-top: -2em;
        }

        .nineth-row{
            display: inline-block;
            float: left;
            margin-top: 15em;
            margin-left: -66em;
            /* background-color: green; */
        }

        #doh_logo {
            /* background-color: blue; */
            margin-left: 1em;
            margin-top: 0.2em;
            height: 40px;
            display: inline-block;
            float: left;
        }

        #iatf_logo {
            /* background-color: red; */
            height: 40px;
            margin-top: 0.2em;
            margin-left: 6em;
            display: inline-block;
            float: left;
        }

        #fda_logo {
            /* background-color: red; */
            height: 30px;
            margin-top: 0.9em;
            margin-left: 10.5em;
            display: inline-block;
            float: left;
        }
    
        #emb_logo {
            /* background-color: red; */
            height: 25px;
            margin-top: 0.9em;
            margin-left: 17.5em;
            display: inline-block;
            float: left;
        }
        
        .col-13{
            display: block;
            margin-top: 1em;
            margin-left: 8em;
            /* background-color: yellow; */
            text-align: center;
        }
        .site-top-label{
            margin-top: -0.5em;
            font-size: 13px;
        }
        .footer-site{
            font-size: 1.5rem;
            margin-top: -18px;
        }

        .col-14 {
            display: block;
            margin-top: -3.7em;
            margin-left: 30em;
            /* background-color: red; */
            text-align: center;
        }
        .site-top-label2{
            margin-top: -0.5em;
            font-size: 13px;
        }
        .footer-site2{
            font-size: 1.5rem;
            margin-top: -18px;
        }

        .col-15{
            display: block;
            margin-top: -4em;
            margin-left: 53em;
            /* background-color: green; */
            text-align: center;
        }
        #fb_logo{
            margin-top: 5px;
            height: 17px;
        }
        #ig_logo{
            margin-top: 5px;
            height: 17px;
        }
        #yt_logo{
            margin-top: 5px;
            height: 17px;
        }
        #tiktok_logo{
            margin-top: 5px;
            height: 17px;
        }

        .col-16{
            display: block;
            margin-top: -2.9em;
            margin-right: -5.5em;
            /* background-color: aqua; */
            float: right;
            text-align: left;
        }
        .domain{
            font-size: 1.3em;
            margin-top: 1em;
        }


    </style>

</head>

<body>

    <div id="content">

        <div class="first-row">
            <div class="col-1">
                <img src="data:image/png;base64, {{ $tpsn_logo; }}" alt="" id="tpsn-logo">
            </div>
            <div class="col-2">
                <p class="upper-title">FACILITY INFORMATION</p>
                <p>TESTING CENTER: <b>{{ $testing_center }}</b></p>
                <p>ADDRESS: <b>{{ $testing_center_address }}</b></p>
                <p>AVAILMENT TYPE: <b>{{ $availment_type }}</b></p>
            </div>
        </div>

        <div class="second-row">
            <div class="col-3">
                <p class="upper-title">PATIENT INFORMATION</p>
                <p>NAME: <b>{{ $fullname }}</b></p>
                <p>BIRTHDAY: <b>{{ $birthday }}</b></p>
                <p>AGE: <b>{{ $age }}</b></p>
                <p>SEX: <b>{{ $gender }}</b></p>
                <p id="patient-address">ADDRESS: <b>{{ $address }}</b></p>
            </div>
            <div class="col-4">
                <p class="upper-title">SPECIMEN INFORMATION</p>
                <p>SPECIMEN: <b>{{ $specimen_name }}</b></p>
                <p>DATE: <b>{{ $specimen_date }}</b></p>
                <p>TIME COLLECTED: <b>{{ $specimen_collected }}</b></p>
                <p>TIME RELEASED: <b>{{ $specimen_released }}</b></p>
                <p>SERVICE TYPE: <b>{{ $service_type }}</b></p>
                <p>BOOKING CODE: <b>{{ $booking_code }}</b></p>
            </div>
        </div>

        <div class="third-row">
            <hr class="divider">
        </div>

        <div class="fourth-row">
            <div class="col-5">
                <div class="upper-title">COVID-19 TEST RESULTS</div>
                <p>DESCRIPTION: <b>{{ $description }}</b></p>
                <p>TESTING KIT BRAND: <b>{{ $testing_kit }}</b></p>
                <p>RECOMMENDATION: <b>{{ $conclusion }}</b></p>
                <p class="result-{{ $class_result }}">COVID-19 {{ $result }}</p>
                <p class="result-description">{{ $subresult }}</p>
                <img id="tpsn_barcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG('12', 'C39+')}}" alt="barcode"/>
                <p id="tpsn_barcode_text">https://tpsn.ph</p>
            </div>
            <div class="col-6">
                <img id="scan_qrcode" src="data:image/png;base64, {{ $scan_qr_code; }}" alt="">
            </div>
        </div>

        <div class="fifth-row">
            <hr class="divider">
        </div>

        <div class="sixth-row">
            <p class="upper-title">METHODOLOGY</p>
            <p>Covid-19 Antigen Test is fluorescence immunoassay for the qualitative detection of specific antigens to SARS-CoV-2 present in humannasopharynx.</p>
        </div>

        <div class="seventh-row">
            <div class="upper-title">LIMITATIONS</div>
            <p>A rapid antigen negative result does not assure that one is free from Covid-19 especially if one is exposed to the virus.</p>
            <p>A rapid antigen test that is positive means that there is a 99% chance that you are RT-PCR test positive.</p>
            <p>A rapid antigen test that is negative means that there is a 68% chance that you are RT-PCR test negative.</p>
        </div>

        <div class="eight-row">
            <div class="col-7">
                <div class="signature_performed_value_box">
                    <img id="signature_performed_value" src="data:image/png;base64, {{ $performed_by_signature }}" alt="">
                </div>
                <div class="performed_name_value"> 
                    <p class="performed-medicalname">{{ $performed_by_name }}</p>
                    @if($performed_by_licensed != "")
                        <p class="performed_licensed_number">
                            <!-- LICENSED No. {{ $performed_by_licensed}} -->
                        </p>
                    @else
                        <p class="performed_licensed_number">&nbsp;</p>
                    @endif
                </div>
                <div class="performed_labels">
                    <p id="performed_line">________________________</p>
                    <p id=="performed_label">Performed by</p>
                </div>
            </div>
            <div class="col-8">
                <div class="signature_performed_value_box">
                    <img id="signature_performed_value" src="data:image/png;base64, {{ $validated_by_signature }}" alt="">
                </div>
                <div class="performed_name_value"> 
                    <p class="performed-medicalname">{{ $validated_by_name }}</p>
                    @if($validated_by_licensed != "")
                        <p class="performed_licensed_number">
                            LICENSED No. {{ $validated_by_licensed}}
                        </p>
                    @else
                        <p class="performed_licensed_number">&nbsp;</p>
                    @endif
                </div>
                <div class="performed_labels">
                    <p id="performed_line">________________________</p>
                    <p id=="performed_label">Validated by</p>
                </div>
            </div>
        </div>

        <div class="nineth-row">
            <div class="col-9">
                <img id="doh_logo" src="data:image/png;base64, {{ $doh_logo; }}" alt="">
            </div>
            <div class="col-10">
                <img id="iatf_logo" src="data:image/png;base64, {{ $iatf_logo; }}" alt=""/>
            </div>

            <div class="col-11">
                <img id="fda_logo" src="data:image/png;base64, {{ $fda_logo; }}" alt=""/>
            </div>

            <div class="col-12">
                <img id="emb_logo" src="data:image/png;base64, {{ $emb_logo; }}" alt=""/>
            </div>
            <div class="col-13">
                <p class="site-top-label">visit us at:</p>
                <p class="footer-site">www.tpsn.ph</p>
            </div>
            <div class="col-14">
                <p class="site-top-label2">contact us at:</p>
                <p class="footer-site2">inquiry@tpsn.ph</p>
            </div>
            <div class="col-15">
                <img id="fb_logo" src="data:image/png;base64, {{ $fb_logo; }}" alt=""/>
                <img id="ig_logo" src="data:image/png;base64, {{ $ig_logo; }}" alt=""/>
                <img id="yt_logo" src="data:image/png;base64, {{ $yt_logo; }}" alt=""/>
                <img id="tiktok_logo" src="data:image/png;base64, {{ $tiktok_logo; }}" alt=""/>
            </div>
            <div class="col-16">
                <p class="domain">TPSN.ph</p>
            </div>
        </div>

    </div>


</body>

</html>

<?php
   $out = ob_get_contents();
   ob_end_flush();
?>