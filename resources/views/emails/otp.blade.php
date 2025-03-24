<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Email Template</title>
    <style>
        /* Basic CSS reset */
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            line-height: 1.6;
            background-color: #f4f4f4;
        }
        /* Wrapper for the email content */
        .email-wrapper {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        /* Header styling */
        .header {
            text-align: center;
            padding-bottom: 20px;
        }

        /* Content area */
        .content {
            padding: 20px 0;
        }

        /* Footer styling */
        .footer {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 20px;
        }

        /* Button style */
        .btn {
            display: inline-block;
            padding: 10px 20px;
            text-decoration: none;
            background-color: #e82845;
            color: #fff;
            border-radius: 4px;
        }
    </style>
</head>

<body>
<div class="email-wrapper">
    <div class="header">
        <h3>Welcome, {{$name}}!,</h3>
    </div>
    <div class="content">
        <p>Thank you for subscribing to our microfinance system.
            Kindly receive OTP(one time password) below</p>

        <p>
            {{$otp}}
        </p>

        <p>
            <a href="{{$link}}" class="btn">Click Here! </a>
        </p>

        <p>Best regards,<br> The isale investment Team</p>
    </div>
    <div class="footer">
        <p>Follow our Page, <a href="https://isalegroup.co.tz/">isalegroup.co.tz</a>.</p>
        <p style="align-content: center; justify-items: center;" >If you have any questions or need assistance, <br>
            feel free to contact us.

        <div class="elementor-button-wrapper">
            <a class="elementor-button elementor-button-link elementor-size-md elementor-animation-shrink" href="#">
						<span class="elementor-button-content-wrapper">
						<span class="elementor-button-icon elementor-align-icon-right">
				<i aria-hidden="true" class="fas fa-external-link-alt"></i>			</span>
						<span class="elementor-button-text">Email: info@isalegroup.co.tz</span>
		</span>
            </a>
        </div>
        <div class="cXedhc">Telephone: +255 620 300 000</div>
        </p>


    </div>
</div>
</body>
</html>
