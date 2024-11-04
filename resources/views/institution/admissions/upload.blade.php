<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Admissions</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1a1a1a;
            color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
        }

        h1 {
            color: #ff6666;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="file"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 2px solid #ff6666;
            border-radius: 4px;
            background-color: #444;
            color: #f2f2f2;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="file"]:focus,
        textarea:focus {
            border-color: #ff9999;
            outline: none;
        }

        button {
            width: 100%;
            padding: 10px;
            background-color: #ff6666;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #ff9999;
        }

        .note {
            margin-top: 15px;
            font-size: 14px;
            color: #fff;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Upload Admissions</h1>
        <form action="{{ route('admissions.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="institution_id">Institution ID:</label>
                <input type="text" id="institution_id" name="institution_id" value="{{ $institution->id }}" readonly>
            </div>
            <div class="form-group">
                <label for="title">Admission Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div class="form-group">
                <label for="details">Admission Details:</label>
                <textarea id="details" name="details" rows="5" required></textarea>
            </div>
            <div class="form-group">
                <label for="document">Upload Document (PDF):</label>
                <input type="file" id="document" name="document" accept=".pdf" required>
            </div>
            <button type="submit">Publish Admission</button>
        </form>
        <div class="note">Note: Ensure that all fields are filled out correctly before submitting.</div>
    </div>
</body>
</html>
