<html>

<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript"
    src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{config('services.midtrans.client_key')}}"></script>
</head>

<body>
  <input type="hidden" name="snap_token" id="snaptoken" value="{{ $snapToken }}">
  <button id="pay-button">Pay!</button>

  <script type="text/javascript">
    var snapToken = document.getElementById('snaptoken').value;
    // For example trigger on button clicked, or any time you need
    var payButton = document.getElementById('pay-button');
    payButton.addEventListener('click', function () {
      // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token
      window.snap.pay(snapToken);
      // customer will be redirected after completing payment pop-up
    });
  </script>
</body>

</html>
