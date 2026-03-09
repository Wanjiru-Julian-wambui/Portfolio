<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <style>
        body { font-family: Georgia, serif; background: #f8fafc; margin: 0; padding: 0; }
        .wrapper { max-width: 560px; margin: 2rem auto; background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 24px rgba(0,0,0,0.08); }
        .header { background: linear-gradient(135deg, #0ea5e9, #6366f1); padding: 2rem; text-align: center; }
        .header h1 { color: #fff; margin: 0; font-size: 1.4rem; letter-spacing: -0.02em; }
        .body { padding: 2rem; }
        .label { font-size: 0.7rem; font-weight: 700; letter-spacing: 0.12em; text-transform: uppercase; color: #0ea5e9; margin-bottom: 0.25rem; }
        .value { font-size: 0.95rem; color: #0f172a; margin-bottom: 1.25rem; line-height: 1.6; }
        .msg-box { background: #f1f5f9; border-left: 3px solid #0ea5e9; border-radius: 0 8px 8px 0; padding: 1rem 1.25rem; }
        .footer { text-align: center; padding: 1.25rem; font-size: 0.75rem; color: #94a3b8; border-top: 1px solid #f1f5f9; }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="header">
            <h1>📬 New Message — ARSH26 Portfolio</h1>
        </div>
        <div class="body">
            <p class="label">From</p>
            <p class="value">{{ $name }}</p>

            <p class="label">Email</p>
            <p class="value"><a href="mailto:{{ $email }}" style="color:#0ea5e9">{{ $email }}</a></p>

            <p class="label">Message</p>
            <div class="msg-box">
                <p class="value" style="margin:0">{{ $body }}</p>
            </div>
        </div>
        <div class="footer">
            Sent via your portfolio at arsh26.dev &nbsp;·&nbsp; Reply directly to {{ $email }}
        </div>
    </div>
</body>
</html>