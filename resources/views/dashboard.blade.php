<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <style>
       
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f9f9fb;
            color: #333;
            line-height: 1.4;
            font-size: 14px; 
            position: relative;
            overflow: hidden;
        }

        body::before {
            content: "";
            background-image: url('{{ asset('/images/student/student.jpg') }}'); 
            background-size: cover;
            background-position: center;
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: -1;
            filter: blur(8px); 
        }

        
        header {
            background-color: rgba(31, 41, 55, 0.8); 
            padding: 1rem;
            text-align: center;
            color: #ffffff;
            font-size: 1.8rem;
            font-weight: bold;
        }

        .container {
            max-width: 1100px;
            margin: 2rem auto;
            padding: 1.5rem; 
            background-color: #ffffff;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            position: relative; 
            z-index: 1; 
        }

        h2 {
            font-size: 1.6rem; 
            margin-bottom: 1rem; 
            text-align: center;
            color: #1f2937;
        }

       
        .message {
            font-size: 1rem; 
            margin: 1rem 0; 
            text-align: center;
            color: #4b5563;
        }

        .institutions {
            margin-top: 1rem; 
        }

        .institution {
            padding: 1rem;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 1rem;
            background-color: #f4f6f9;
            display: flex;
            flex-direction: column;
            transition: box-shadow 0.2s ease;
        }

        .institution:hover {
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }

        .institution h3 {
            font-size: 1.3rem; 
            color: #111827;
            margin-bottom: 0.5rem;
        }

        .institution p {
            font-size: 0.9rem; 
            color: #6b7280;
            margin-bottom: 1rem;
        }

        .institution .buttons-container {
            margin-top: auto;
            display: flex;
            justify-content: flex-end;
            gap: 8px; 
        }

        .apply-button, .published-admissions-button {
            background-color: #2563eb;
            color: #ffffff;
            border: none;
            padding: 0.4rem 1rem; 
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-weight: 500;
            transition: background-color 0.3s ease, transform 0.2s ease;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .apply-button:hover, .published-admissions-button:hover {
            background-color: #1e3a8a;
            transform: scale(1.05);
        }

        .admissions, .courses {
            margin-top: 1rem; 
            padding: 1rem; 
            border: 1px solid #d1d5db;
            border-radius: 10px;
            background-color: #ffffff;
        }

        .admission, .course {
            margin-bottom: 1rem; 
            padding: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            background-color: #f8fafc;
            transition: transform 0.2s ease;
        }

        .admission:hover, .course:hover {
            transform: translateY(-2px);
        }

        .admission h3, .course h4 {
            font-size: 1.2rem; 
            color: #1f2937;
            margin-bottom: 0.5rem;
        }

        .admission p, .course p {
            font-size: 0.9rem; 
            color: #4b5563;
        }

        .course ul {
            padding-left: 1.5rem;
            list-style-type: disc;
            color: #4b5563;
        }

        .logout-button {
          
            margin: 1rem; 
            font-weight: bold;
            color: #2563eb;
            text-decoration: none;
        }

        .logout-button:hover {
            text-decoration: underline;
        }
        .buttons{
            display: flex;
            flex-direction: row;
            margin-left: 80%;
        }
    </style>
</head>
<body>

<header>
    Career Guidance
</header>
<div class="buttons">
<a href="{{route('student.logout')}}" class="logout-button">Log out</a>
<a href="{{route('profile.edit')}}" class="logout-button">Edit Profile</a>
</div>
<div class="container">
    
    <div class="message">
        You're logged in!
    </div>

    <div class="institutions">
        <h2>Registered High Learning Institutions</h2>

        @foreach($institutions as $institution)
            <div class="institution">
                <div>
                    <h3>{{ $institution->name }}</h3>
                    <p>{{ $institution->description }}</p>
                </div>
                
                <div class="buttons-container">
                    <a href="{{ route('admissions.published', $institution->id) }}" class="published-admissions-button">Published Admissions</a>
                    <a href="{{route('applications.index', $institution->id)}}" class="apply-button">View Courses and their Qualification Grades</a>
                </div>
            </div>

            <div id="courses-{{ $institution->id }}" class="courses" style="display: none;">
                <h3>Available Courses</h3>
        
            </div>
        @endforeach

    </div>
</div>

<script>
function toggleCourses(institutionId) {
    const coursesDiv = document.getElementById(`courses-${institutionId}`);
    if (coursesDiv.style.display === "none") {
    
        fetch(`/qualifications/${institutionId}`)
            .then(response => response.json())
            .then(data => {
               
                coursesDiv.innerHTML = '<h3>Available Qualifications</h3>';
                data.qualifications.forEach(qualification => {
                    coursesDiv.innerHTML += `<div class="course"><h4>${qualification.subject_name}</h4><p>Required Grades: ${qualification.needed_grades}</p></div>`;
                });
                coursesDiv.style.display = "block";
            });
    } else {
        coursesDiv.style.display = "none";
    }
}
</script>

</body>
</html>
