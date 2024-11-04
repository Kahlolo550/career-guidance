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
            background-color: #e0f7fa;
            color: #0d47a1;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        h1 {
            color: #0d47a1;
            margin-bottom: 15px;
            text-align: center;
        }

        ul {
            list-style: none;
            padding: 0;
        }

        ul li {
            padding: 15px;
            border-bottom: 1px solid #b3e5fc;
            transition: background-color 0.3s;
        }

        ul li:hover {
            background-color: #b3e5fc;
        }

        .admission-title {
            font-size: 18px;
            color: #0d47a1;
            font-weight: bold;
        }

        .admission-details {
            color: #455a64;
            margin-top: 5px;
        }

        .download-btn {
            background-color: #0d47a1;
            color: #ffffff;
            padding: 10px 15px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s;
            display: inline-block;
            margin-top: 10px;
        }

        .download-btn:hover {
            background-color: #1976d2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Published Admissions</h1>
        <ul>@foreach ($institutions as $institution)
        
      
            @foreach($admissions as $admission)
                <li>
                    <div class="admission-title">{{$institution->name}} admission, {{ $admission->title }}</div>
                  
                    <a href="{{ Storage::url($admission->document) }}" class="download-btn" target="_blank">
                        <i class="fas fa-download"></i> Download PDF
                    </a>
                    <a href="{{ Storage::url($admission->document) }}" class="view-link" target="_blank">View
                    Document</a>
                </li>
            @endforeach 
            @endforeach
        </ul>
    </div>
</body>
</html>
