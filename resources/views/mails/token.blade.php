<body>
    <h1>Withdraw Validation</h1>

    <p>
        You have requested a withdrawal of funds. To complete this operation, please enter the verification code below:
    </p>
    <br>
    <div>Verification token: <b>{{ $token->token }}</b></div>
    <br>
    <br>
    <p>
        amount : {{ $amount }} USDT
    </p>
    <div>
        if you did not request this withdrawal or if you have any concerns, please contact us immediately.
    </div>
    <br>
    <br>
    Thank's,<br>
    {{ config('app.name') }}
<body>
