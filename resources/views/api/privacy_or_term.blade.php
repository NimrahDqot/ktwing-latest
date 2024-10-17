<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KT Wing - Privacy Policy & Terms</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
        }

        .header {
            background-color: #F45503;
            color: white;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 30px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        .tab-container {
            display: flex;
            margin-bottom: 20px;
        }

        .tab {
            padding: 10px 20px;
            cursor: pointer;
            background-color: #f1f1f1;
            border: none;
            flex: 1;
            text-align: center;
        }

        .tab.active {
            background-color: #F45503;
            color: white;
        }

        .content {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #F45503;
            margin-top: 30px;
        }

        .section {
            margin-bottom: 20px;
        }

        #terms-content {
            display: none;
        }
    </style>
</head>

<body>
    <div class="header">
        <h1>KT Wing Legal Information</h1>
    </div>

    <div class="tab-container">
        <button class="tab active" onclick="showContent('privacy')">{{ $privacyItem->name }}</button>
        <button class="tab" onclick="showContent('terms')">{{ $termItem->name }}</button>
    </div>

    <div class="content" id="privacy-content">
        <h2>{{ $privacyItem->name }}</h2>

        {!! $privacyItem->detail !!}
    </div>

    <div class="content" id="terms-content">
        <h2>{{ $termItem->name }}</h2>

        {!! $termItem->detail !!}

    </div>

    <script>
        function showContent(contentType) {
            const privacyContent = document.getElementById('privacy-content');
            const termsContent = document.getElementById('terms-content');
            const tabs = document.getElementsByClassName('tab');

            if (contentType === 'privacy') {
                privacyContent.style.display = 'block';
                termsContent.style.display = 'none';
                tabs[0].classList.add('active');
                tabs[1].classList.remove('active');
            } else {
                privacyContent.style.display = 'none';
                termsContent.style.display = 'block';
                tabs[0].classList.remove('active');
                tabs[1].classList.add('active');
            }
        }
    </script>
</body>

</html>
