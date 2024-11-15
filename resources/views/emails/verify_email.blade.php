<x-mail::message>
# Account Verification 
<p>
    Welcome to PiccoloPay!
</p>
<p>
    Unlock a world of seamless transactions and top-notch services with Piccolo Pay. We pride ourselves on being your go-to destination for airtime, data, TV subscriptions and electricity bill purchases.
</p>
<p>
    Please find below Your Confirmation Code: <br>
    <h1 style="color:#df7f1b; font-size: 200%; text-align: center;">{{ Session::get('verification_code') }}</h1>
</p>
<p>
    Please don't forget to change your password after logging
</p>
<p>
    If you have any questions or concerns, feel free to reach out to our <a style="color: blue;" href="https://wa.me/+2347037645413">support team</a>. We're here to assist you.
</p>
<p>
    <a href="https://piccolopay.com.ng">
        <img style="width: 50%;" src="https://piccolopay.com.ng/images/logo.png" alt="PiccoloPay Logo">
    </a>
</p>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
