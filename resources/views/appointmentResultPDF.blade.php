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

        .row::after {
            content: "";
            clear: both;
            display: table;
        }

        [class*="col-"] {
            float: left;
            padding: 15px;
            /*border: 1px solid red;*/
        }

        .header-title {
            margin-left: -10px;
            margin-top: -0.5em; 
        }

        #header-logo-container{
            /* background-color: yellow; */
            padding: 5px;
            position: absolute;
        }

        #tpsn-logo {
            height: 80px;
            margin-left: auto;
            margin-right: auto;
            display: block;
        }

        .title-group {
            /* background-color: red; */
            margin-left: -4em;
        }

        .main-title {
            font-size: 1.8rem;
            font-weight: bold;
            text-align: left;
        }

        #main-title-a {
            color: #7aadee;
            margin-top: -8px;
            position: absolute;
        }

        #main-title-b {
            color: #ed9c20;
            margin-top: -8px;
            margin-left: 90px;
            display: inline-block;
        }

        .sub-title {
            text-align: left;
            line-height: 0.8rem;
            font-size: 0.8rem;
            margin-top: -4px;
        }

        p.sub-title.second-title {
            font-weight: bold;
            margin-top: -15px;
            margin-bottom: 15px;
        }


        #clients-copy {
            margin-top: -2em;
            text-align: center;
            /* background-color: blue; */
        }


        .covid-title {
            padding-top: 30px;
            padding-bottom: 30px;
        }

        .info-title {
            font-weight: bold;
            font-size: 1rem;
        }

        .patient-info {
            line-height: 0.8rem;
            margin-top: 1em;
            font-size: 0.7rem
        }
        p.patient-info-body {
            font-size: 0.7rem
        }


        /* COVID 19 Test Result Summary */

        .table-start {
            margin-top: 1em;
        }

        .result-summary-title {
            background-color: #0597c8;
            color: #fff;
            text-align: center;
            font-size: 1.8rem;
            font-weight: bold;
            padding-top: 5px;
            padding-bottom: 5px;
        }

        .result-negative {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 800;
            color: rgb(247, 243, 243);
            font-size: 1.8rem;
            background-image: linear-gradient(to right, #55cfda, #37bdd6, #19aad0, #0597c8, #1684be);
        }

        .result-positive {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 800;
            color: rgb(247, 243, 243);
            font-size: 1.8rem;
            background-image: linear-gradient(to right, #f65858, #e04643, #ca332e, #b31f1a, #9d0303);
        }

        .result-unupdated {
            text-align: center;
            padding-top: 10px;
            padding-bottom: 10px;
            font-weight: 800;
            color: rgb(247, 243, 243);
            font-size: 1.8rem;
            background-image: linear-gradient(to right, #daaa62, #e2a74d, #e19a31, #d78d1e, #d5840c);
        }

        .description{
            background-color: #dde9f9;
            line-height: 0.7rem;
        }
        .after-result {
            background-color: #7aadee;
            line-height: 0.7rem;
        }

        .unupdated-result {
            text-align: center;
            font-weight: 700;
            background-color: #ed9c20;
            color: white;
            font-size: 1.8rem;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .positive-result {
            text-align: center;
            font-weight: 700;
            background-color: #ca332e;
            color: white;
            font-size: 1.8rem;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .negative-result {
            text-align: center;
            font-weight: 700;
            background-color: #09a137;
            color: white;
            font-size: 1.8rem;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .check-result {
            font-size: 2.5rem;
            text-transform: uppercase;
            font-weight: 600;
        }

        .before-result {
            font-size: 1.5em;
            font-weight: bold;
            text-transform: uppercase;
            margin-top: 5px;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .sub-result {
            font-size: 0.7em;
            margin-top: -1.2em;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }


        .result-table {
            background-color: #dde9f9;
            padding-bottom: 5px;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .main-table {
            padding: 0px;
        }

        .consideras {
            text-align: right;
            font-style: italic;
        }

        .disclaimer {
            text-align: center;
            font-size: 1.2rem;
            font-weight: 700;
            background-color: #bebebe;
        }

        .disclaimer-body {
            background-color: #d9d9d9;
            line-height: 1.5rem;
        }

        .footer-items {
            margin-top: 35px;
            width: 100%;
        }

        #scan_qrcode {
            display: inline-block;
            height: 135px;
        }

        .iatf-doh-row {
            /* background-color: green; */
            width: 100%;
            display: block;
        }

        #doh_logo {
            /* background-color: blue; */
            margin-left: 1em;
            height: 70px;
            display: inline-block;
            float: left;
        }

        #iatf_logo {
            /* background-color: red; */
            height: 70px;
            margin-left: 9em;
            display: inline-block;
            float: left;
        }

        #tpsn_barcode_box {
            margin-top: 8em;
        }

        #tpsn_barcode {
            height: 35px;
        }

        #tpsn_barcode_text {
            margin-top: 0em;
            text-align: center;
        }


        /* Footer 3rd Column */
        .performed-box {
            /* background-color: blue; */
            margin-top: -1em;
            display: block;
            width: 100%;
            height: 120px;
            text-align: center;
        } 

        #performed-by-title {
            display: inline-block;
            font-size: 5;
            font-weight: bold;
        }

        #signature_performed_value {
            height: 60px;
            position: absolute;
            margin-top: 3em;
            margin-left: 1.5em;
            /* background-color: yellow; */
        }

        .performed_name_value {
            display: block;
            /* background-color: red; */
            margin-top: 7em;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .performed-medicalname{
            margin-top: -1em;
            display: block;
            text-transform: uppercase;
            font-size: 6;
            font-weight: bold;
        }

        .performed_licensed_number {
            display: block;
            font-size: 6;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .performed_labels {
            /* background-color: blue; */
            display: block;
            margin-top: -2em;
        }


        /* Footer Fourth Column */
        .validated-box {
            /* background-color: green; */
            margin-top: -1em;
            display: block;
            width: 100%;
            height: 120px;
            text-align: center;
        } 

        #validated-by-title {
            display: inline-block;
            font-size: 5;
            font-weight: bold;
        }

        #signature_validated_value {
            height: 60px;
            position: absolute;
            margin-top: 3em;
            margin-left: 1.5em;
            /* background-color: yellow; */
        }

        .validated_name_value {
            display: block;
            /* background-color: red; */
            margin-top: 7em;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .validated-medicalname{
            margin-top: -1em;
            display: block;
            text-transform: uppercase;
            font-size: 6;
            font-weight: bold;
        }

        .validated_licensed_number {
            display: block;
            font-size: 6;
            font-family: "nunito-sans-regular", Calibri,Candara,Segoe,Segoe UI,Optima,Arial,sans-serif;
        }

        .validated_labels {
            /* background-color: blue; */
            display: block;
            margin-top: -2em;
        }

        /* end Fourth Footer Column */

    

    
        

        

        .medical-officer {
            text-align: center;
        }

        .footer-address {
            text-align: center;
        }

        p.address {
            font-size: 0.8rem;
            line-height: 0.3rem;
        }

        .footer-name {
            font-size: 1rem;
            font-weight: 600;
        }


        ol {
            padding-left:10px;
            padding-right:10px;
        }


        .col-1 {
            width: 8.33%;
        }

        .col-2 {
            width: 16.66%;
        }

        .col-3 {
            width: 25%;
        }

        .col-4 {
            width: 33.33%;
        }

        .col-5 {
            width: 41.66%;
        }

        .col-6 {
            width: 50%;
        }

        .col-7 {
            width: 58.33%;
        }

        .col-8 {
            width: 66.66%;
        }

        .col-9 {
            width: 75%;
        }

        .col-10 {
            width: 83.33%;
        }

        .col-11 {
            width: 91.66%;
        }

        .col-12 {
            width: 100%;
        }


        /* footer boxes */
        .col-13 {
            width: 20%;
        }
        .col-14 {
            width: 26%;
        }
        .col-15 {
            width: 20%;
        }
        .col-16 {
            width: 20%;
        }
        /* footer boxes */



    </style>
    
</head>

<body style="max-width: 680px; margin-left: -10px">
    <div id="content">

        <div class="row header-title">
            <div class="col-2 header-container">
                <div id="header-logo-container">
                    <img src="data:image/png;base64, {{ $tpsn_logo; }}" alt="" id="tpsn-logo">
                    <!-- <img src="{{ $tpsn_logo; }}" style="width: 20px" width="100%" height="auto"/> -->
                </div>
            </div>
            <div class="col-7 title-group header-container">
                <p class="main-title"><span id="main-title-a">THINK POSITIVE,</span> <span id="main-title-b">STAY NEGATIVE</span></p>
                <p class="sub-title second-title">A COVID 19 ANTIGEN & RT PCR SWAB TESTING</p>
                <p class="sub-title">Red Flower Company Compound Elizabeth Ave. cor. Sta. Ana Drive,</p>
                <p class="sub-title">Sun Valley Subdivision, Bicutan, Paranaque City, 1700</p>
                <p class="sub-title">inquiry@tpsn.ph - @TPSN.ph</p>
            </div>
            <div class="col-3 header-container">
                <p class="main-title covid-title" style="margin-left: -25px; color:#aba5a5">CONFIDENTIAL</p>
            </div>
        </div>

        <div id="clients-copy">CLIENT'S COPY</div>

        <div class="row">
            <div class="col-4 patient-info">
                <p class="info-title">PATIENTS INFORMATION</p>
                <p class="patient-info-body">NAME:<b style="font-size: 0.8rem"> {{ $fullname }}</b></p>
                <p class="patient-info-body">BIRTHDAY:<b style="font-size: 0.8rem"> {{ $birthday }}</b></p>
                <p class="patient-info-body">AGE:<b style="font-size: 0.8rem"> {{ $age }}</b></p>
                <p class="patient-info-body">SEX:<b style="font-size: 0.8rem"> {{ $gender }}</b></p>
                <p class="patient-info-body">ADDRESS:<b style="font-size: 0.8rem"> {{ $address }}</b></p>
                <!-- <p class="patient-info-body">COMPANY:<b style="font-size: 0.8rem"> {{ $company }} </b></p> -->
            </div>
            <div class="col-4 patient-info">
                <p class="info-title">SPECIMEN INFORMATION</p>
                <p class="patient-info-body">SPECIMEN:<b style="font-size: 0.8rem"> {{ $specimen_name }}</b></p>
                <p class="patient-info-body">DATE:<b style="font-size: 0.8rem"> {{ $specimen_date }}</b></p>
                <p class="patient-info-body">TIME COLLECTED:<b style="font-size: 0.8rem"> {{ $specimen_collected }}</b></p>
                <p class="patient-info-body">TIME RELEASED:<b style="font-size: 0.8rem"> {{ $specimen_released }}</b></p>
                <p class="patient-info-body">SERVICE TYPE:<b style="font-size: 0.8rem"> {{ $service_type }}</b></p>
                <p class="patient-info-body">CLIENT NO.:<b style="font-size: 0.8rem"> {{ $client_no }}</b></p>
            </div>
            <div class="col-4 patient-info" style="margin-left:-40px">
                <p class="info-title">FACILITY INFORMATION</p>
                <p class="patient-info-body">TESTING CENTER:<b style="font-size: 0.8rem"> {{ $testing_center }}</b></p>
                <p class="patient-info-body">ADDRESS:<b style="font-size: 0.8rem"> {{ $testing_center_address }}</b></p>
                <p class="patient-info-body">AVAILMENT TYPE:<b style="font-size: 0.8rem"> {{ $availment_type }}</b></p>
            </div>
        </div>
        <div class="row table-start">
            <div class="col-12 result-summary-title">COVID-19 Test Result Summary</div>
        </div>
        <div class="row">
            <div class="col-12 description">
                <b>Description:</b> {{ $description }}
                <p><b>Testing Kit Brand: </b> {{ $testing_kit }}</p>
                <p><b>Recommendation: </b> {{ $conclusion }} </p>
            </div>
        </div>
        <div class="row">
            <div class="col-12 {{ $class_result }}-result">
                <p class="before-result">COVID-19 {{ $result }}</span>
                </p>
                <p class="sub-result">{{ $subresult }}</p>
            </div>
        </div>
        <div class="row ">
            <div class="result-table col-12"><b>Reason For Testing:</b> {{ $reason_for_testing }}</div>
        </div>
        <!-- <div class="row">
            <div class="after-result col-12">
                <div >
                    <b>LIMITATIONS:</b>
                    <p>A rapid antigen negative result does not assure that one is free from COVID-19 especially if one is exposed to the virus.</p>
                    <p>A rapid antigen test that is positive means that there is a 99% chance that you are RT-PCR test positive.</p>
                    <p>A rapid antigen test that is negative means there is a 68% chance that you are RT-PCR test negative.</p>
                </div>
            </div>
        </div> -->
        
        <div class="row">
            <div class="col-12 disclaimer">
                -Disclaimer-
            </div>
        </div>
        <div class="row">
            <div class="col-12 disclaimer-body">
                    <ol>
                        <li>The kit is only designated for detection of 2019 novel Coronavirus (SARS-Cov-2) based on ORF1ab and N genes. It cannot be used for diagnosis of SARS-CoV-2, MERS-CoV or other coronaviruses.</li>
                        <li>Samples with lowest viral concentration (below 1000 copies/mL, the limit of detection (LOD) ofthis kit) may result as negative. Other factors including improper sample collection, improper storage condition and/or technical error
                            could also lead to false positive or false negative result.</li>
                        <li>Diagnostic result using this kit should be used as a reference. Other clinical findings should be considered altogether with this result to make a complete diagnostic conclusion.</li>
                    </ol>
            </div>
        </div>

        <div class="row footer-items" >
            <div class="col-13">
                <img id="scan_qrcode" src="data:image/png;base64, {{ $scan_qr_code; }}" alt="">
            </div>
            <div class="col-14 iatf-doh-row">
                <div class="column">
                    <img id="doh_logo" src="data:image/png;base64, {{ $doh_logo; }}" alt="">
                </div>
                <div class="column">
                    <img id="iatf_logo" src="data:image/png;base64, {{ $iatf_logo; }}" alt=""/>
                </div>
                <div class="" id="tpsn_barcode_box">
                    <img id="tpsn_barcode" src="data:image/png;base64,{{DNS1D::getBarcodePNG('12', 'C39+')}}" alt="barcode"/>
                    <p id="tpsn_barcode_text">https://tpsn.ph</p>
                </div>
            </div>
            <div class="col-15 performed-box">
                <div id="performed-by-title">
                    <!-- TEST PERFORMED BY: -->
                </div>
                <div class="signature_performed_value_box">
                    <img id="signature_performed_value" src="data:image/png;base64, {{ $performed_by_signature }}" alt="">
                </div>
                <div class="performed_name_value"> 
                    <p class="performed-medicalname">{{ $performed_by_name }}</p>
                    @if($performed_by_licensed != "")
                        <p class="performed_licensed_number">LICENSED No. {{ $performed_by_licensed}}</p>
                    @else
                    @endif
                </div>
                <div class="performed_labels">
                    <p id="performed_line">________________________</p>
                    <p id=="performed_label">Performed by</p>
                </div>
            </div>
            <div class="col-16 validated-box">
                <div id="validated-by-title">
                    <!-- TEST VALIDATED BY: -->
                </div>
                <div class="signature_validated_value_box">
                    <img id="signature_validated_value" src="data:image/png;base64, {{ $validated_by_signature }}" alt="">
                </div>
                <div class="validated_name_value"> 
                    <p class="validated-medicalname">{{ $validated_by_name }}</p>
                    @if($validated_by_licensed != "")
                        <p class="validated_licensed_number">LICENSED No. {{ $validated_by_licensed}}</p>
                    @else
                    @endif
                </div>
                <div class="validated_labels">
                    <p id="validated_line">________________________</p>
                    <p id=="validated_label">Validated by</p>
                </div>
            </div>
        </div>

       
</body>

</html>

<?php
   $out = ob_get_contents();
   ob_end_flush();
?>