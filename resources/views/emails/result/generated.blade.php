@component('mail::message')
# Your Testing Result

Click to download your PDF Testing Result below.

@component('mail::button', ['url' => $result->resultpdf_path])
Download PDF
@endcomponent

Thanks,<br>
TPSN System
@endcomponent
