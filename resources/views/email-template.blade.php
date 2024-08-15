<!DOCTYPE html>
<html lang="en">

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    @if ($type == 'new')
        <title>Email Verification Code</title>
    @else
        <title>Reset Password Code</title>
    @endif

    <style media="all" type="text/css">
        @media all {
            body {
                font-family: system-ui, Helvetica, Arial, sans-serif;
                line-height: 1.5;
                font-weight: 400;
                font-synthesis: none;
                text-rendering: optimizeLegibility;
                -webkit-font-smoothing: antialiased;
                -moz-osx-font-smoothing: grayscale;
                -ms-text-size-adjust: 100%;
                -webkit-text-size-adjust: 100%;
                background-color: #cbe4de;
                color: #2e4f4f;
                margin: 0;
                padding: 0;
            }

            .main-header {
                display: flex;
                gap: 2rem;
                justify-content: center;
                align-items: center;
                border-bottom: 1rem ridge #0e8388;
                margin-bottom: 2rem;
            }

            .logo-image {
                width: 60px;
                height: 60px;
                border-radius: 10px;
            }

            h1 {
                font-size: 3rem;
                font-weight: 400;
                margin-top: 0.5rem;
                margin-bottom: 1rem;
            }

            .code-text {
                font-size: 2rem;
                margin-bottom: 0;
            }

            .url-text {
                font-size: 1.5rem;
                margin-bottom: 0;
            }

            .body-text {
                padding: 1rem;
            }

            .footer-div {
                display: flex;
                align-items: center;
                justify-content: center;
                gap: 10px;
                color: #cbe4de;
                border-top: 1rem ridge #0e8388;
                margin-bottom: 1rem;
            }

            .footer-text h4 {
                margin: 0;
                color: #2e4f4f;
                font-size: 1rem;
            }

            .footer-icon-div {
                align-self: center;
            }

            .footer-icon {
                width: 25px;
            }
        }
    </style>
</head>

<body
    style="
            font-family: system-ui, Helvetica, Arial, sans-serif;
            line-height: 1.5;
            font-weight: 400;
            font-synthesis: none;
            text-rendering: optimizeLegibility;
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            -ms-text-size-adjust: 100%;
            -webkit-text-size-adjust: 100%;
            background-color: #cbe4de;
            color: #2e4f4f;
            margin: 0;
            padding: 0;
        ">
    <div class="main-header"
        style="
                display: flex;
                gap: 2rem;
                justify-content: center;
                align-items: center;
                border-bottom: 1rem ridge #0e8388;
                margin-bottom: 2rem;
            ">
        <img src="https://www.mariannedillard.com/wp-content/uploads/2024/04/MD-logo-sm.jpg" alt="Marianne Logo"
            title="Marianne Logo" width="60px" height="60px" style="border-radius: 10px" class="logo-image" />

        <h1
            style="
                    font-size: 3rem;
                    font-weight: 400;
                    margin-top: 0.5rem;
                    margin-bottom: 1rem;
                ">
            Laravel Login App
        </h1>
    </div>

    <div style="text-align: center; padding: 1rem">
        <h3>Here is your one-time verification code:</h3>
        <p class="code-text" style="font-size: 2rem; margin-bottom: 0">
            <strong>{{ $code }}</strong>
        </p>

        <div class="body-text" style="padding: 1rem">
            @if ($type == 'new')
                <p>
                    This code is only valid for 10 minutes. Enter this code on our website to
                    confirm your email and proceed with the login or sign up process.
                </p>
            @else
                <p>
                    This code is only valid for 10 minutes. Enter this code on our website to reset
                    your password.
                </p>
            @endif

            <p>
                <em>
                    If you did not request this code, consider updating your password to
                    secure your account.
                </em>
            </p>
        </div>
    </div>

    <div class="footer-div"
        style="
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: #cbe4de;
            border-top: 1rem ridge #0e8388;
            padding: 1rem;
        ">
        <div class="div-text">
            <h4 style="font-size: 1rem; margin: 0; color: #2e4f4f">
                <em>Engineered with Love</em>
            </h4>
        </div>

        <div class="footer-icon-div" style="align-self: center">
            <a href="https://www.mariannedillard.com">
                <img class="footer-icon" width="25px" alt="Red Heart Icon" title="Red Heart Icon"
                    src="https://www.mariannedillard.com/wp-content/uploads/2024/04/heart-icon.png" />
            </a>
        </div>

        <div class="footer-icon-div" style="align-self: center">
            <a href="https://www.github.com/dillardm89">
                <img class="footer-icon" width="25px" alt="Github Icon" title="Github Icon"
                    src="https://www.mariannedillard.com/wp-content/uploads/2024/04/github-icon.png" />
            </a>
        </div>
    </div>
</body>

</html>
