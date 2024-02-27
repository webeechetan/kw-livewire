<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Invite | Kaykewalk</title>

    <style>
        .mxauto {
            margin: 0 auto;
        }
        .textCenter {
            text-align: center;
        }
        .spacing20 {
            padding: 20px;
        }
        img {
            max-width: 100%;
        }
        table {
            max-width: 100% !important;
        }
        body {
            background: #f7f7f7;
            font-family: trebuchet ms,sans-serif;
        }
        .emailer-wrap {
            margin: 0 auto;
            background: #fff;
        }
        .emailer-text-wrap {
            margin: 0 auto;
            padding: 50px 50px 70px;
        }
        .emailer-text-wrap h2 {
            font-size: 26px;
        }
        .emailer-text-wrap p {
            font-size: 18px;
            line-height: 26px;
        }
        .btn-primary {
            background: #F9398F;
            color: #fff;
            min-width: 200px;
            border-radius: 4px;
            padding: 15px 0;
            display: inline-block;
            text-decoration: none;
            font-weight: 600;
            font-size: 18px;
            text-align: center;
            text-transform: uppercase;
        }
    </style>
</head>
<body>
    <table class="main-emailer" width="100%" cellspacing="0" cellpadding="">
        <tbody>
            <tr>
                <td>
                    <table class="emailer-wrap" width="600" cellspacing="0" cellpadding="">
                        <tr>
                            <td>
                                <table width="100%" style="border-bottom: 1px solid #ddd;" cellspacing="0" cellpadding="">
                                    <tr>
                                        <td class="textCenter spacing20">
                                            <img src="https://kw.webeetest.tech/assets/images/logo.png" alt="">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="">
                                    <tr>
                                        <td>
                                            <img src="https://kw.webeetest.tech/assets/images/invite_banner.jpg" alt="">
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <table width="100%" cellspacing="0" cellpadding="">
                                    <tr>
                                        <td>
                                            <table class="emailer-text-wrap mxauto" width="100%" cellcellspacing="0" cellpadding="">
                                                <tr>
                                                    <td>
                                                        <h2 style="margin-top: 0; margin-bottom: 30px;">Hi <?php echo e($user->name); ?>!</h2>
                                                        <p>
                                                            Your account has been created successfully.
                                                        <br>
                                                        <br>
                                                        Your login credentials are as follows:
                                                        <br>
                                                        <br>
                                                        Email: <strong><?php echo e($user->email); ?></strong>
                                                        <br>
                                                        <br>
                                                        Password: <strong><?php echo e($password); ?></strong>
                                                        <br>
                                                        <br>
                                                        Please login to your account and change your password.
                                                        <br>
                                                        <br>
                                                        </p>
                                                        <a href="<?php echo e(route('login')); ?>" class="btn-primary" style="margin-top: 30px;">Sign In Now</a>
                                                    </td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>
</html><?php /**PATH C:\xampp\htdocs\kw-livewire\.vapor\build\app\resources\views\mails\new-user-mail.blade.php ENDPATH**/ ?>