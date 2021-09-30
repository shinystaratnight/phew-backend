<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Cairo" rel="stylesheet">
</head>

<body dir="rtl"
    style="text-align: center;font-family: 'Cairo', sans-serif;background-color: #F5F5F5;padding: 20px;font-size: 14px; line-height: 1.43;">
    <div
        style="max-width: 600px; margin: 0px auto; background-color: #FFF; box-shadow: 0px 20px 50px rgba(0,0,0,0.05);">
        <table style="width: 100%; background-color:#00e573">
            <tbody>
                <tr style="text-align:center">
                    <img alt=""
                        style="background-image: url('{{ asset('assets/global') }}/images/logos/logo-icon.png');width: 100px; padding: 20px">
                </tr>
            </tbody>
        </table>
        <div style="padding: 30px 70px; border-top: 1px solid rgba(0,0,0,0.05);">
            <h1 style="margin-top: 0px;">
                أهلا بك
            </h1>
            <h4>رسالة تفعيل الحساب</h4>
            <div style="color: #636363; font-size: 14px;">
                <p>
                    اهلا بك {{ $notifiable->username }} فى {{ settings('project_name_ar') }}
                </p>
                <p>
                    استخدم الكود المرسل بالأسفل لتفعيل الحساب الخاص بك
                </p>
            </div>
            <div style="position: relative;margin: 20px 0;">
                <h3 style="border: 1px; color: #0091D7"><a>{{ $notifiable->code }}</a></h3>
            </div>
        </div>
        <div style="background-color: #00E573; padding: 40px; text-align: center;">
            <div style="color: #FFF; font-size: 10px;">جميع حقوق الملكية محفوظة {{ settings('project_name_ar') }}
            </div>
        </div>
    </div>
</body>

</html>