<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Admissions Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF8zX2p5vnXJ6Fw5f5zZ1IQybdhG1Fz/bxZoR" crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
            color: #343a40;
        }

        .container {
            max-width: 900px;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #28a745;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #28a745;
            color: #ffffff;
        }

        .view-link {
            color: #007bff;
            text-decoration: none;
        }

        .view-link:hover {
            text-decoration: underline;
        }

        .btn-delete {
            background-color: #dc3545;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-delete:hover {
            background-color: #c82333;
        }

        .btn-publish {
            background-color: #28a745;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn-publish:hover {
            background-color: #218838;
        }

        .success-message {
            background-color: #d4edda;
            color: #155724;
            padding: 10px;
            border: 1px solid #c3e6cb;
            border-radius: 5px;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1> {{$institution->name}} Admissions </h1>

        @if(session('success'))
            <div class="success-message">{{ session('success') }}</div>
        @endif

        <h2>Uploaded Admissions</h2>
        <table>
            <thead>
                <tr>
                    <th>Admission Title</th>
                    <th>Institution Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($admissions as $admission)
                    <tr>
                        <td>{{ $admission->title }}</td>
                        <td>{{ $admission->institution->name }}</td> 
                        <td>
                            <a href="{{ Storage::url($admission->document) }}" class="view-link" target="_blank">View
                                Document</a>
                            <form action="{{ route('admissions.publish', $admission->id) }}" method="POST"
                                style="display:inline;">
                                @csrf
                                @method('PATCH')
                                <button type="submit" class="btn-publish"
                                    title="{{ $admission->published ? 'Unpublish Admission' : 'Publish Admission' }}">
                                    {{ $admission->published ? 'Unpublish' : 'Publish' }}
                                </button>
                            </form>
                            <form action="{{ route('institutions.admissions.destroy', [$institution->id, $admission->id]) }}" method="POST" style="display:inline;">
    @csrf
    @method('DELETE')
    <button type="submit" class="btn-delete" title="Delete Admission"><i class="fas fa-trash"></i> Delete</button>
</form>



                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>

</html>