<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lunch Stall - QR Code Scanner</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5-qrcode/2.3.8/html5-qrcode.min.js" integrity="sha512-r6rDA7W6ZeQhvl8S7yRVQUKVHdexq+GAlNkNNqVC7YyIV+NwqCTJe2hDWCiffTyRNOeGEzRRJ9ifvRm/HCzGYg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            color: #333;
            margin-bottom: 20px;
        }

        .scanner-container {
            position: relative;
            width: 500px;
            height: 374px;
            border: 2px solid #333;
            background-color: white;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
        }

        .scanner-line {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background-color: red;
            animation: scanning 3s infinite;
        }

        @keyframes scanning {
            0% { top: 0; }
            100% { top: 100%; }
        }

        .delegate-info {
            margin-top: 20px;
            background-color: #fff;
            padding: 15px;
            width: 500px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            text-align: center;
        }

        .delegate-info h2 {
            margin: 0;
            color: #333;
        }

        .delegate-info p {
            margin: 5px 0;
            color: #555;
        }

        button {
            margin-top: 15px;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h1>Lunch Stall - QR Code Scanner</h1>

    <div class="scanner-container">
        <div class="scanner-line"></div>
        <div id="reader" style="width: 100%; height: 100%;"></div>
    </div>

    <form id="lunch-scan-form" action="{{ route('stall.lunch.scan') }}" method="POST">
        @csrf
        <input type="hidden" id="delegate_id" name="delegate_id">
    </form>

    <div class="delegate-info" id="delegate-info" style="display: none;">
        <h2>Delegate Information</h2>
        <p id="delegate-name"></p>
        <p id="delegate-email"></p>
        <button type="button" id="rescan-btn">Rescan</button>
    </div>

    <script>
        function onScanSuccess(qrMessage) {
            document.getElementById('delegate_id').value = qrMessage;

            // Submit the form
            document.getElementById('dinner-scan-form').submit();

            // AJAX to fetch delegate info based on scanned ID
            fetch(`/get-delegate-info/${qrMessage}`)
                .then(response => response.json())
                .then(data => {
                    document.getElementById('delegate-info').style.display = 'block';
                    document.getElementById('delegate-name').textContent = 'Name: ' + data.name;
                    document.getElementById('delegate-email').textContent = 'Email: ' + data.email;
                });

            // Stop the QR scanner after success
            html5QrCode.stop();
        }

        function onScanFailure(error) {
            console.warn(`QR error: ${error}`);
        }

        let html5QrCode = new Html5Qrcode("reader");
        html5QrCode.start(
            { facingMode: "environment" }, // Use rear camera
            {
                fps: 20,    // Scans per second
                qrbox: { width: 300, height: 300 } // Scanning box size
            },
            onScanSuccess,
            onScanFailure
        ).catch((err) => {
            console.log(`QR code scanning failed: ${err}`);
        });

        document.getElementById('rescan-btn').addEventListener('click', () => {
            document.getElementById('delegate-info').style.display = 'none';
            html5QrCode.start(
                { facingMode: "environment" },
                {
                    fps: 10,
                    qrbox: { width: 300, height: 300 }
                },
                onScanSuccess,
                onScanFailure
            ).catch((err) => {
                console.log(`QR code scanning failed: ${err}`);
            });
        });
    </script>

    @if(session('success'))
        <p>{{ session('success') }}</p>
    @endif

    @if(session('error'))
        <p>{{ session('error') }}</p>
    @endif
</body>
</html>
