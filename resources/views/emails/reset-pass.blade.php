<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>E-mail confirmation</title>
    <style>
        body {
            position: relative;
            overflow: hidden;
            /* width: 100vw;
            height: 100vh; */
        }

        a {
            text-decoration: none;
        }

        /* .contenair {
            background: red;
        } */

        @media screen and (min-width: 992px) {
            .contenair {
                display: absolute;
                width: 50%;
                height: 50%;
                transform: translate(50%, 50%);
            }
        }

        .contenair-main {
            /* display: block; */
            /* width: 50%; */
            border: 1px solid #cccccc;
            padding: 2rem;

        }

        .btn {
            padding: 0.5rem 2rem;
            background-color: #28a745;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            font-weight: bold;
        }

        .btn:hover {
            background-color: #197e31;
        }

        .cont-btn {
            display: flex;
            justify-content: center;
        }
    </style>
</head>

<body>
    <div class="contenair">
        <h3 class="header">Réinitialisez votre mot de passe {{ config('app.name') }} </h3>
        <div class="contenair-main">
            <h2 style="text-align: center">Réinitialisation du mot de passe {{ config('app.name') }}
            </h2>
            <p>Nous avons entendu dire que vous aviez perdu votre mot de passe {{ config('app.name') }}. Désolé pour
                ça!
            </p>
            <p>Mais ne vous inquiétez pas ! Vous pouvez utiliser le bouton suivant pour réinitialiser votre mot de
                passe
                :</p>
            <div class="cont-btn">
                <a type="button" class="btn" style="color: #fff"
                    href="{{ config('app.url') }}/api/v1/send-mail/{{ $content['usrToken'] }}">Réinitialisez
                    votre mot de passe</a>
            </div>
            <p>Si vous n'utilisez pas ce lien dans les 3 heures, il expirera. Pour obtenir un nouveau lien de
                réinitialisation de mot de passe, visitez : <a
                    href="https://github.com/password_reset">https://github.com/password_reset</a> </p>
            <p>Merci,</p>
            <p> l'équip CAMTRACK</p>
        </div>
    </div>

</body>

</html>
