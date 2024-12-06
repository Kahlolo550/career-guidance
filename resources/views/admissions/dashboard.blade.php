<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Admissions Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css"
        integrity="sha384-k6RqeWeci5ZR/Lv4MR0sA0FfDOMF8zX2p5vnXJ6Fw5f5zZ1IQybdhG1Fz/bxZoR" crossorigin="anonymous">
   
</head>

<body>
@include('admin.layouts.header')
    <div class="container">
        <h1> Admissions </h1>

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
                        <td>{{ $admission->institution->name }}</td> <!-- Assuming relationship is set up -->
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