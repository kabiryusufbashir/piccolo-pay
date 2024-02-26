<x-mail::message>
# Password Reset Successfully
<p>
    We're pleased to inform you that your password reset request has been successfully processed. Your account security is our top priority, and we're committed to ensuring that your information remains safe.
</p>
<p>
    Please make sure to keep your new password secure and avoid sharing it with anyone. Additionally, consider using a unique password for this account to enhance its security further.
</p>
<p>
    Please find below Your New Password is: <br>
    <h1 style="color:#df7f1b; font-size: 200%; text-align: center;">{{ Session::get('password') }}</h1>
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
