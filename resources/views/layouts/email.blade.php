<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>注册确认链接</title>
</head>
<body>
<h1>感谢您在 InfoSystem 网站进行注册！</h1>

<p>
    请点击下面的链接完成注册：
    <a href="{{ route('confirm_email', $token) }}">
        ➡️点我验证⬅️
    </a>
</p>

<p>
    如果这不是您本人的操作，请忽略此邮件。
</p>
</body>
</html>