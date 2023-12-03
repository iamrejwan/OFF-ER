
<!DOCTYPE html>
<html>
<head>
    <title>Telecom Operator Details</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        header {
            background-color: #333;
            color: #fff;
            padding: 20px 0;
            text-align: center;
            width: 100%;
        }
        .container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            max-width: 100%;
            box-sizing: border-box;
        }
        .operator {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 200px;
            text-align: center;
            transition: transform 0.3s ease;
            cursor: pointer;
        }
        .operator:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }
        .operator img {
            width: 80px;
            height: 80px;
            object-fit: contain;
            margin-bottom: 15px;
        }
        .operator-name {
            font-size: 18px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        .operator-code {
            font-size: 14px;
            color: #666;
        }
        .details-container {
            display: none;
            width: 100%;
            justify-content: center;
            align-items: flex-start;
        }
        .details {
            max-width: 800px;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .details h2 {
            margin-bottom: 15px;
        }
        .details ul {
            list-style: none;
            padding: 0;
        }
        .details li {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <header>
        <h1>Telecom Operator Details</h1>
    </header>
    <div class="container" id="telecomOperators">
        <div class="operator" data-operator="GP">
            <img src="/assets/img/gp.png" alt="GP">
            <div class="operator-name">GP</div>
            <div class="operator-code">PCode: GP</div>
        </div>
        <div class="operator" data-operator="RB">
            <img src="/assets/img/rb.png" alt="Robi">
            <div class="operator-name">Robi</div>
            <div class="operator-code">PCode: RB</div>
        </div>
        <div class="operator" data-operator="BL">
            <img src="/assets/img/bl.png" alt="Banglalink">
            <div class="operator-name">Banglalink</div>
            <div class="operator-code">PCode: BL</div>
        </div>
        <div class="operator" data-operator="AT">
            <img src="/assets/img/at.png" alt="Airtel">
            <div class="operator-name">Airtel</div>
            <div class="operator-code">PCode: AT</div>
        </div>
    </div>

    <div class="details-container" id="telecomDetails">
        <div class="details"></div>
    </div>

    <script>
        async function fetchAndDisplayDetails(url, operatorName) {
    try {
        // Use the proxy.php file as a proxy to avoid CORS issues
        const response = await fetch(`proxy.php?url=${encodeURIComponent(url)}`);
        const data = await response.json();

        const detailsContainer = document.getElementById('telecomDetails');
        const details = detailsContainer.querySelector('.details');

        details.innerHTML = `<h2>${operatorName}</h2>`;

        if (data && data.bmtelbd && data.bmtelbd.length > 0) {
            const detailsList = document.createElement('ul');
            data.bmtelbd.forEach(detail => {
                const listItem = document.createElement('li');
                listItem.innerHTML = `
                    <strong>Title:</strong> ${detail.title}<br>
                    <strong>Price:</strong> ${detail.price}<br>
                    <strong>Expires:</strong> ${detail.exp}<br>
                    <strong>Operator:</strong> ${detail.opname}<br><br>
                `;
                detailsList.appendChild(listItem);
            });
            details.appendChild(detailsList);
        } else {
            details.innerHTML += `<p>No data available for ${operatorName}</p>`;
        }

        detailsContainer.style.display = 'flex';
    } catch (error) {
        console.error('Error fetching data:', error);
    }
}

const operatorElements = document.getElementsByClassName('operator');
Array.from(operatorElements).forEach(operator => {
    operator.addEventListener('click', () => {
        const operatorCode = operator.getAttribute('data-operator');
        let apiUrl = '';
        switch (operatorCode) {
            case 'GP':
                apiUrl = '/apiapp/getdrive?ot=GP';
                break;
            case 'RB':
                apiUrl = '/apiapp/getdrive?ot=RB';
                break;
            case 'BL':
                apiUrl = '/apiapp/getdrive?ot=BL';
                break;
            case 'AT':
                apiUrl = '/apiapp/getdrive?ot=AT';
                break;
            default:
                break;
        }
        fetchAndDisplayDetails(apiUrl, operatorCode);
    });
});

    </script>
</body>
</html>
