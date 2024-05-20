<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <script src="https://unpkg.com/html5-qrcode/minified/html5-qrcode.min.js"></script>
</head>
<body>
    <div id="qr-reader" style="width: 500px"></div>
    <div id="qr-reader-results"></div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // Handle the result here
            console.log(`Scan result: ${decodedText}`);
            document.getElementById('qr-reader-results').innerText = `Scan result: ${decodedText}`;
            
            // Stop the camera and close the QR reader
            html5QrCode.stop().then((ignore) => {
                const myArray = decodedText.split(",");
            
                // Redirect to the URL encoded in the QR code
                window.location.href = '/tsuripay?invoiceId=' + myArray[2];
            }).catch((err) => {
                // Stop failed, handle it.
                console.error(`Unable to stop scanning, error: ${err}`);
            });
        }

        function onScanFailure(error) {
            // Handle scan failure, usually better to ignore and keep scanning
            console.warn(`QR code scan error: ${error}`);
        }

        let html5QrCode = new Html5Qrcode("qr-reader");

        html5QrCode.start(
            { facingMode: "environment" }, // default camera
            {
                fps: 10,    // Optional, frame per seconds for qr code scanning
                qrbox: { width: 250, height: 250 }  // Optional, if you want bounded box UI
            },
            onScanSuccess,
            onScanFailure
        ).catch((err) => {
            // Start failed, handle it
            console.error(`Unable to start scanning, error: ${err}`);
        });
    </script>
</body>
</html>
