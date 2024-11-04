<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Admission</title>
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
        .form-group {
            margin-bottom: 15px;
        }
        .form-control {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 2px solid #ff6666;
            border-radius: 4px;
            background-color: #555;
            color: #fff;
        }
        .form-control:focus {
            border-color: #ff9999;
            box-shadow: 0 0 5px rgba(255, 153, 153, 0.5);
            outline: none;
        }
        .btn-primary {
            background-color: #ff6666;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            transition: background-color 0.3s;
        }
        .btn-primary:hover {
            background-color: #ff9999;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Add Admission</h1>

        <form action="/admissions" method="POST" class="admission-form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" name="start_date" id="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" name="end_date" id="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Publish Admission</button>
        </form>
    </div>
</body>
</html>
