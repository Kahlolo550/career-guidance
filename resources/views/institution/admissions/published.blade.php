<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Published Admissions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF8zX2p5vnXJ6Fw5f5zZ1IQybdhG1Fz/bxZoR" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #1a1a1a;
            color: #f2f2f2;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #ff6666;
            margin-bottom: 15px;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            padding: 10px;
            border-bottom: 1px solid #444;
        }

        .admission-title {
            font-size: 18px;
            color: #ff6666;
        }

        .admission-details {
            color: #ccc;
        }

        .download-btn {
            background-color: #ff6666;
            color: #fff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }

        .download-btn:hover {
            background-color: #ff9999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Published Admissions</h1>
        <ul>
            @foreach($admissions as $admission)
                <li>
                    <div class="admission-title">{{ $admission->title }}</div>
                    <div class="admission-details">{{ $admission->details }}</div>
                    <a href="{{ Storage::url($admission->document) }}" class="download-btn" target="_blank">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
