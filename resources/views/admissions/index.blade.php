<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admissions</title>
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
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }
        h1 {
            color: #ff6666;
        }
        .alert {
            background-color: #28a745;
            color: white;
            padding: 10px;
            margin-bottom: 15px;
            border-radius: 5px;
        }
        .admissions-list {
            list-style: none;
            padding: 0;
        }
        .admission-item {
            padding: 15px;
            border-bottom: 1px solid #444;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #444;
            margin-bottom: 10px;
            border-radius: 5px;
        }
        .admission-details {
            color: #ff6666;
        }
        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 8px 12px;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-danger:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Admissions</h1>
        <a href="create.html" class="btn btn-primary">Add Admission</a>

        <!-- Success Message -->
        <div class="alert">Admission added successfully!</div>

        <ul class="admissions-list">
            <li class="admission-item">
                <div class="admission-details">
                    <strong>Admission Title</strong> - 2024-01-01 to 2024-06-30
                </div>
                <div class="admission-actions">
                    <form action="/admissions/1" method="POST" style="display:inline;">
                        <input type="hidden" name="_method" value="DELETE">
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </li>
            <!-- Repeat for more admissions -->
        </ul>
    </div>
</body>
</html>
