<div marginwidth="0" marginheight="0" bgcolor="#f5f7fa"
     style="font-family:Tahoma;color:#6e6e6e;font-size:16px;background-color:#f5f7fa">
    <center>
        <table align="center" border="0" cellpadding="0" cellspacing="0" width="800"
               style="background-image:url({{ asset('mehdi/staff/images/email-bg.png') }});
                background-repeat:repeat-x;max-width:800px;border:1px solid #e3e3e3;border-radius:3px">
            <tbody>
            <tr>
                <td align="center" valign="top"
                    style="background-image:url({{ asset('mehdi/staff/images/email-bg.png') }});
                        background-repeat:repeat-x;border-radius:3px;background-color:#ffffff"
                    background="{{ asset('mehdi/staff/images/email-bg.png') }}" bgcolor="white">
                    <table border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tbody>
                        <tr>
                            <td align="center" valign="middle">
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tbody>
                                    <tr>
                                        <td valign="bottom" align="center" height="170">
                                            <img src="{{ asset('mehdi/staff/images/email-lock.png') }}"
                                                 style="max-width:140px;width:140px;height:140px"
                                                 width="140" height="140" class="CToWUd">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="center" align="center"
                                            style="font-family:Tahoma;font-size:28px;line-height:47px;font-weight:bold"
                                            height="85">
                                            بازیابی کلمه عبور
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td align="center" valign="top">
                                <table border="0" cellpadding="0" cellspacing="30" width="100%">
                                    <tbody>
                                    <tr>
                                        <td valign="top" style="font-size:14px;line-height:150%" colspan="3"
                                            align="center">
                                            <p dir="rtl" style="font-family:Tahoma">
                                                کاربر گرامی:
                                            </p>
                                            <p dir="rtl" style="font-family:Tahoma">
                                                <b><a href="mailto:{{ $email }}" target="_blank">{{ $email }}</a></b>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="font-size:14px;line-height:40px" colspan="3"
                                            align="center">
                                            <p dir="rtl" style="font-family:Tahoma">
                                                لینک زیر به درخواست شما برای بازیابی کلمه عبورتان در
                                                سایت {{ $fa_store_name }} برای شما
                                                ارسال شده است.
                                            </p>
                                            <p dir="rtl" style="font-family:Tahoma"><br>
                                                لطفا جهت تغییر رمز عبور خود بر روی لینک زیر کلیک نمائید :
                                            </p>
                                            <p dir="rtl" style="font-family:Tahoma">
                                                <a href="{{ route('staff.resetPassword', $token) }}" target="_blank"
                                                   data-saferedirecturl="{{ route('staff.resetPassword', $token) }}">
                                                    {{ route('staff.resetPassword') }}
                                                </a>
                                            </p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" colspan="3" align="center">
                                            <a href="{{ route('staff.resetPassword', $token) }}"
                                               style="text-decoration:none" target="_blank"
                                               data-saferedirecturl="{{ route('staff.resetPassword', $token) }}">
                                                <table border="0" cellpadding="0" cellspacing="0" bgcolor="#4cb050"
                                                       width="289" height="48">
                                                    <tbody>
                                                        <tr>
                                                            <td align="center" valign="middle">
                                                                <font color="#ffffff" style="font-family:Tahoma">
                                                                    تغییر رمز عبور
                                                                </font>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td valign="top" style="font-size:14px;line-height:150%" colspan="3"
                                            align="center">
                                            <p dir="rtl" style="font-family:Tahoma"> نام کاربری شما : </p>
                                            <p dir="rtl" style="font-family:Tahoma">
                                                <b><a href="mailto:{{ $email }}" target="_blank">{{ $email }}</a></b>
                                            </p>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td height="30"></td>
                        </tr>
                        </tbody>
                    </table>
                </td>
            </tr>
            </tbody>
        </table>
    </center>
</div>
