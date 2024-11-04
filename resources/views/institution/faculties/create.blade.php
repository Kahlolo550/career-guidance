
<div class="container">
    <h1>Add a New Faculty</h1>

    <form action="{{ route('institution.faculties.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Faculty Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Create Faculty</button>
    </form>
</div>

