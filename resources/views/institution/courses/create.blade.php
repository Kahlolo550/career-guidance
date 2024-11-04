
<div class="container">
    <h1>Add a New Course</h1>

    <form action="{{ route('courses.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="name">Course Name:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>
        
        <div class="form-group">
            <label for="faculty_id">Select Faculty:</label>
            <select name="faculty_id" id="faculty_id" class="form-control" required>
                @foreach($institution->faculties as $faculty)
                    <option value="{{ $faculty->id }}">{{ $faculty->name }}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Create Course</button>
    </form>
</div>

