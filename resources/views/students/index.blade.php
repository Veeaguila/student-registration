<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>

<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Spectral:wght@500;600;700&family=IBM+Plex+Mono:wght@400;500;600&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>
    :root {
        --paper: #f2ede0;
        --paper-dark: #e6ddc8;
        --card: #fffdf7;
        --ink: #23281f;
        --ink-soft: #5c6350;
        --ink-faint: #9a9c86;
        --forest: #33513a;
        --forest-dark: #223a29;
        --brass: #ab8a5a;
        --border: #d9cfb4;
        --accent-red: #9c3b30;
        --success-bg: #eef2e4;
        --success-text: #33513a;
        --success-border: #c8d3b0;
    }

    * {
        box-sizing: border-box;
    }

    html, body {
        margin: 0;
        padding: 0;
    }

    body {
        font-family: 'Inter', Arial, sans-serif;
        background: var(--paper);
        color: var(--ink-soft);
        -webkit-font-smoothing: antialiased;
    }

    body::before {
        content: "";
        position: fixed;
        inset: 0;
        pointer-events: none;
        z-index: 0;
        background-image: linear-gradient(rgba(35, 40, 31, 0.045) 1px, transparent 1px);
        background-size: 100% 34px;
    }

    .portal {
        display: grid;
        grid-template-columns: 300px 1fr;
        min-height: 100vh;
        position: relative;
        z-index: 1;
    }

    .rail {
        position: sticky;
        top: 0;
        height: 100vh;
        background: linear-gradient(170deg, var(--paper-dark) 0%, #ddd1b6 100%);
        border-right: 3px solid var(--brass);
        padding: 44px 30px;
        display: flex;
        flex-direction: column;
    }

    .brand-eyebrow {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 10.5px;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--forest);
        font-weight: 600;
    }

    .brand-name {
        font-family: 'Spectral', serif;
        font-size: 19px;
        font-weight: 600;
        color: var(--ink);
        margin-top: 4px;
    }

    .rail-heading {
        font-family: 'Spectral', serif;
        font-size: 25px;
        font-weight: 600;
        line-height: 1.25;
        color: var(--ink);
        margin: 34px 0 8px;
    }

    .rail-sub {
        font-size: 12.5px;
        line-height: 1.6;
        color: var(--ink-soft);
    }

    .rail-footer {
        margin-top: auto;
        padding-top: 24px;
        border-top: 1px dashed var(--brass);
        font-family: 'IBM Plex Mono', monospace;
        font-size: 10.5px;
        color: var(--ink-faint);
        line-height: 1.7;
    }

    .content {
        padding: 56px 60px 80px;
        max-width: 1200px;
        width: 100%;
    }

    .header-eyebrow {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 11px;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        color: var(--forest);
        margin-bottom: 8px;
    }

    h1 {
        font-family: 'Spectral', serif;
        font-size: 32px;
        font-weight: 600;
        color: var(--ink);
        margin: 0 0 8px;
    }

    .intro {
        font-size: 13.5px;
        margin-bottom: 30px;
    }

    .toolbar {
        display: flex;
        justify-content: space-between;
        align-items: center;
        gap: 20px;
        margin-bottom: 22px;
    }

    .count {
        font-family: 'IBM Plex Mono', monospace;
        font-size: 12px;
        color: var(--ink-faint);
    }

    .btn {
        display: inline-block;
        padding: 12px 22px;
        text-decoration: none;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 12px;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 0.05em;
    }

    .btn-primary {
        background: var(--forest);
        color: var(--card);
        clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%);
    }

    .btn-primary:hover {
        background: var(--forest-dark);
    }

    .card {
        background: var(--card);
        border: 1px solid var(--border);
        box-shadow: 0 8px 20px rgba(35, 40, 31, 0.05);
    }

    .torn-edge {
        height: 9px;
        background-color: var(--card);
        background-image:
            linear-gradient(135deg, var(--paper) 25%, transparent 25.5%),
            linear-gradient(-135deg, var(--paper) 25%, transparent 25.5%);
        background-size: 14px 14px;
        background-position: -7px 0;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 15px 18px;
        border-bottom: 1px solid var(--border);
        font-family: 'IBM Plex Mono', monospace;
        font-size: 10.5px;
        letter-spacing: 0.05em;
        text-transform: uppercase;
        color: var(--ink-faint);
    }

    td {
        padding: 17px 18px;
        border-bottom: 1px solid var(--border);
        font-size: 13px;
        color: var(--ink-soft);
    }

    tbody tr:hover {
        background: #faf7ed;
    }

    .student-id {
        font-family: 'IBM Plex Mono', monospace;
        color: var(--forest);
        font-weight: 600;
    }

    .student-name {
        color: var(--ink);
        font-family: 'Spectral', serif;
        font-size: 16px;
        font-weight: 600;
    }

    .view-link {
        color: var(--forest);
        text-decoration: none;
        font-family: 'IBM Plex Mono', monospace;
        font-size: 11px;
        font-weight: 600;
        text-transform: uppercase;
    }

    .view-link:hover {
        color: var(--forest-dark);
        text-decoration: underline;
    }

    .empty {
        text-align: center;
        padding: 60px 20px;
        color: var(--ink-faint);
    }

    .empty strong {
        display: block;
        font-family: 'Spectral', serif;
        font-size: 20px;
        color: var(--ink);
        margin-bottom: 8px;
    }

    .success {
        background: var(--success-bg);
        color: var(--success-text);
        border: 1px solid var(--success-border);
        padding: 12px 16px;
        border-radius: 4px;
        margin-bottom: 24px;
        font-size: 13.5px;
        font-family: 'IBM Plex Mono', monospace;
    }

    @media (max-width: 960px) {
        .portal {
            grid-template-columns: 1fr;
        }

        .rail {
            position: relative;
            height: auto;
            padding: 26px 24px;
            border-right: none;
            border-bottom: 3px solid var(--brass);
        }

        .rail-heading,
        .rail-sub,
        .rail-footer {
            display: none;
        }

        .content {
            padding: 30px 20px 56px;
            max-width: 100%;
        }
    }

    @media (max-width: 640px) {
        .toolbar {
            align-items: flex-start;
            flex-direction: column;
        }

        h1 {
            font-size: 27px;
        }
    }
</style>

</head>

<body>

<div class="portal">

<aside class="rail">
    <div class="brand-eyebrow">Office of the Registrar</div>
    <div class="brand-name">Admissions Portal</div>

    <h1 class="rail-heading">Student<br>Records</h1>

    <p class="rail-sub">
        Review registered students and open their official profiles.
    </p>

    <div class="rail-footer">
        Student records are maintained<br>
        for enrollment purposes.
    </div>
</aside>

<main class="content">

    <div class="header-eyebrow">Registrar Records</div>

    <h1>Student Records</h1>

    <p class="intro">
        View all students currently registered in the system.
    </p>

    @if (session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="toolbar">
        <div class="count">
            {{ $students->count() }} {{ $students->count() === 1 ? 'student' : 'students' }} registered
        </div>

        <a href="{{ route('students.create') }}" class="btn btn-primary">
            Register New Student
        </a>
    </div>

    <div class="card">

        <div class="torn-edge"></div>

        @if ($students->count())

            <div class="table-wrap">

                <table>

                    <thead>
                        <tr>
                            <th>Student ID</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Program</th>
                            <th>Year Level</th>
                            <th>Action</th>
                        </tr>
                    </thead>

                    <tbody>

                        @foreach ($students as $student)

                            <tr>

                                <td>
                                    <span class="student-id">
                                        {{ $student->student_id }}
                                    </span>
                                </td>

                                <td>
                                    <span class="student-name">
                                        {{ $student->first_name }}
                                        {{ $student->middle_name ? $student->middle_name . ' ' : '' }}
                                        {{ $student->last_name }}
                                    </span>
                                </td>

                                <td>
                                    {{ $student->email }}
                                </td>

                                <td>
                                    {{ $student->program }}
                                </td>

                                <td>
                                    {{ $student->year_level }}
                                </td>

                                <td>
                                    <a
                                        href="{{ route('students.show', $student) }}"
                                        class="view-link"
                                    >
                                        View Profile →
                                    </a>
                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>

        @else

            <div class="empty">

                <strong>No students registered yet.</strong>

                <span>
                    Register your first student to see the record here.
                </span>

            </div>

        @endif

    </div>

</main>

</div>

</body>
</html>
