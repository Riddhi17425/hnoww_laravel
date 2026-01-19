<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>HNoWW EMAIL</title>
<style>
    /* Reset */
    body, table, td, a {
        -webkit-text-size-adjust: 100%;
        -ms-text-size-adjust: 100%;
    }
    body {
        margin: 0;
        padding: 0;
        font-family: 'Helvetica', Arial, sans-serif;
        background-color: #F8F7F3;
    }
    table {
        border-collapse: collapse !important;
    }

    /* Container */
    .email-wrapper {
        width: 100%;
        padding: 20px 0;
        background-color: #F8F7F3;
    }
    .email-content {
        max-width: 600px;
        margin: 0 auto;
        background-color: #ffffff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    /* Header */
    .email-header {
        background-color: #b58a46;
        color: #ffffff;
        text-align: center;
        padding: 30px 20px;
    }
    .email-header h1 {
        margin: 0;
        font-size: 28px;
    }

    /* Body */
    .email-body {
        padding: 30px 25px;
        color: #555555;
        font-size: 16px;
        line-height: 1.6;
    }
    .email-body p {
        margin-bottom: 20px;
    }
    .email-body .btn {
        display: inline-block;
        background-color: #b58a46;
        color: #ffffff !important;
        text-decoration: none;
        padding: 12px 25px;
        border-radius: 8px;
        font-weight: bold;
        transition: background-color 0.3s ease;
    }
    .email-body .btn:hover {
        background-color: #b58a46;
    }

    /* Footer */
    .email-footer {
        text-align: center;
        font-size: 12px;
        color: #999999;
        padding: 20px;
    }

    /* Responsive */
    @media screen and (max-width: 620px) {
        .email-header h1 {
            font-size: 24px;
        }
        .email-body {
            font-size: 14px;
            padding: 20px;
        }
        .email-body .btn {
            padding: 10px 20px;
        }
    }
</style>
</head>
<body>
<table class="email-wrapper" width="100%">
    <tr>
        <td>
            <table class="email-content" width="100%">
                <!-- Header -->
                <tr>
                    <td class="email-header">
                        <h1>Welcome to HNoWW!</h1>
                    </td>
                </tr>

                @yield('content')

                <!-- Footer -->
                <tr>
                    <td class="email-footer">
                        &copy; {{ date('Y') }} Armstrong. All rights reserved.
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
</body>
</html>
