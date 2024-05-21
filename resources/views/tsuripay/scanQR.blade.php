<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Scanner</title>
    <!-- Include the html5-qrcode library -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js"
        integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>

<body>
    <div id="qr-reader" style="width: 500px"></div>
    <div id="qr-reader-results"></div>

    <script>
        function onScanSuccess(decodedText, decodedResult) {
            let html5QrCode = new Html5Qrcode("qr-reader");
            // Handle the result here
            console.log(`Scan result: ${decodedText}`);
            document.getElementById('qr-reader-results').innerText = `Scan result222: ${decodedText}`;
            setTimeout(() => {
                html5QrCode.stop().then(ignore => {
                    console.log("QR Code scanning stopped");
                }).catch(err => {
                    console.error("Error when stopping QR Code scanning", err);
                });
            }, 1000); // Thử với một khoảng thời gian 1 giây

            const myArray = decodedText.split(",");

            // Redirect to the URL encoded in the QR code
            window.location.href = '/tsuripay?invoiceId=' + myArray[2];
        }

        function onScanFailure(error) {
            // Handle scan failure, usually better to ignore and keep scanning
            console.warn(`QR code scan error: ${error}`);
        }

        // Ensure the Html5Qrcode class is available before using it
        document.addEventListener('DOMContentLoaded', (event) => {
            let html5QrCode = new Html5Qrcode("qr-reader");

            html5QrCode.start({
                    facingMode: "environment"
                }, // default camera
                {
                    fps: 10, // Optional, frame per seconds for qr code scanning
                    qrbox: {
                        width: 250,
                        height: 250
                    } // Optional, if you want bounded box UI
                },
                onScanSuccess,
                onScanFailure
            ).catch((err) => {
                // Start failed, handle it
                console.error(`Unable to start scanning, error: ${err}`);
            });
        });
    </script>
</body>

</html>
