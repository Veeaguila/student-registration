<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Profile</title>

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
            position: relative;
        }

        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            z-index: 0;
            background-image:
                linear-gradient(rgba(35, 40, 31, 0.045) 1px, transparent 1px);
            background-size: 100% 34px;
        }

        .portal {
            display: grid;
            grid-template-columns: 300px 1fr;
            min-height: 100vh;
            position: relative;
            z-index: 1;
        }

        /* ---------- Left rail (folder cover) ---------- */

        .rail {
            position: sticky;
            top: 0;
            height: 100vh;
            background: linear-gradient(170deg, var(--paper-dark) 0%, #ddd1b6 100%);
            border-right: 3px solid var(--brass);
            padding: 44px 32px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
        }

        .rail-tabs-deco {
            position: absolute;
            top: 60px;
            right: -14px;
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .rail-tabs-deco span {
            width: 34px;
            height: 16px;
            background: rgba(171, 138, 90, 0.35);
            border-radius: 3px 0 0 3px;
        }

        .rail-tabs-deco span:nth-child(2) {
            width: 26px;
            background: rgba(171, 138, 90, 0.22);
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
            font-size: 27px;
            font-weight: 600;
            line-height: 1.25;
            color: var(--ink);
            margin: 40px 0 10px;
        }

        .rail-sub {
            font-size: 13px;
            line-height: 1.6;
            color: var(--ink-soft);
            max-width: 30ch;
        }

        .rail-photo {
            margin-top: 40px;
            text-align: center;
        }

        .photo-mount {
            width: 128px;
            height: 128px;
            margin: 0 auto;
            position: relative;
            background: var(--card);
            border: 1.5px dashed var(--brass);
            padding: 6px;
        }

        .photo-mount img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .photo-mount .no-picture {
            width: 100%;
            height: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 10.5px;
            color: var(--ink-faint);
            text-transform: uppercase;
            letter-spacing: 0.06em;
        }

        .photo-mount::before,
        .photo-mount::after {
            content: "";
            position: absolute;
            width: 12px;
            height: 12px;
            border-top: 2px solid var(--brass);
            border-left: 2px solid var(--brass);
        }

        .photo-mount::before {
            top: -6px;
            left: -6px;
        }

        .photo-mount::after {
            bottom: -6px;
            right: -6px;
            border-top: none;
            border-left: none;
            border-bottom: 2px solid var(--brass);
            border-right: 2px solid var(--brass);
        }

        .rail-name {
            font-family: 'Spectral', serif;
            font-size: 16.5px;
            font-weight: 600;
            color: var(--ink);
            margin-top: 18px;
        }

        .rail-id {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            color: var(--forest);
            margin-top: 3px;
            letter-spacing: 0.03em;
        }

        .rail-footer {
            margin-top: auto;
            padding-top: 28px;
            border-top: 1px dashed var(--brass);
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            color: var(--ink-faint);
            line-height: 1.7;
        }

        /* ---------- Right sheet ---------- */

        .content-panel {
            padding: 56px 60px 80px;
            max-width: 720px;
        }

        .content-header {
            display: flex;
            align-items: flex-start;
            justify-content: space-between;
            gap: 20px;
            margin-bottom: 28px;
        }

        .header-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--forest);
            margin-bottom: 8px;
        }

        .content-header h1 {
            font-family: 'Spectral', serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
        }

        .stamp {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11.5px;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            color: var(--accent-red);
            border: 2px solid var(--accent-red);
            padding: 6px 12px;
            border-radius: 3px;
            transform: rotate(-4deg);
            flex-shrink: 0;
            white-space: nowrap;
        }

        .success {
            background: var(--success-bg);
            color: var(--success-text);
            border: 1px solid var(--success-border);
            padding: 12px 16px;
            border-radius: 4px;
            margin-bottom: 24px;
            font-size: 13.5px;
            font-weight: 500;
            font-family: 'IBM Plex Mono', monospace;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            margin-bottom: 22px;
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

        .card-inner {
            padding: 26px 32px 30px;
        }

        .card-tab {
            display: inline-flex;
            align-items: baseline;
            gap: 8px;
            background: var(--paper-dark);
            padding: 7px 18px 7px 14px;
            clip-path: polygon(0 0, 100% 0, 92% 100%, 0% 100%);
            margin: 0 0 20px -32px;
            padding-left: 32px;
        }

        .card-tab .num {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11.5px;
            font-weight: 600;
            color: var(--forest);
        }

        .card-tab h2 {
            font-family: 'Spectral', serif;
            font-size: 14.5px;
            font-weight: 600;
            color: var(--ink);
            margin: 0;
        }

        .entries {
            display: flex;
            flex-direction: column;
        }

        .entry {
            display: flex;
            align-items: baseline;
            gap: 10px;
            padding: 10px 0;
            border-bottom: 1px dotted var(--border);
        }

        .entry:last-child {
            border-bottom: none;
        }

        .entry .label {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--ink-faint);
            white-space: nowrap;
            flex-shrink: 0;
            width: 140px;
        }

        .entry .leader {
            flex: 1;
            border-bottom: 1px dotted var(--ink-faint);
            margin-bottom: 4px;
            min-width: 12px;
        }

        .entry .value {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 13.5px;
            color: var(--ink);
            text-align: right;
        }

        .entry.wrap {
            align-items: flex-start;
        }

        .entry.wrap .value {
            text-align: left;
            flex: 1;
            line-height: 1.6;
        }

        .entry.wrap .leader {
            display: none;
        }

        .back-button {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 13px 26px 13px 22px;
            background: var(--forest);
            color: var(--card);
            text-decoration: none;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 600;
            font-size: 13px;
            letter-spacing: 0.04em;
            text-transform: uppercase;
            clip-path: polygon(3% 0, 100% 0, 97% 100%, 0% 100%);
            transition: background 0.15s ease;
        }

        .back-button:hover {
            background: var(--forest-dark);
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

            .rail-tabs-deco,
            .rail-heading,
            .rail-sub,
            .rail-photo,
            .rail-footer {
                display: none;
            }

            .content-panel {
                padding: 30px 20px 56px;
                max-width: 100%;
            }
        }

        @media (max-width: 640px) {
            .card-inner {
                padding: 22px 20px 26px;
            }

            .card-tab {
                margin-left: -20px;
            }

            .entry {
                flex-wrap: wrap;
            }

            .entry .leader {
                display: none;
            }

            .entry .value {
                width: 100%;
                text-align: left;
            }

            .content-header {
                flex-direction: column;
            }
        }
    </style>
</head>

<body>

<div class="portal">

    <aside class="rail">

        <div class="rail-tabs-deco"><span></span><span></span></div>

        <div class="brand-eyebrow">Office of the Registrar</div>
        <div class="brand-name">Admissions Portal</div>

        <h1 class="rail-heading">Student<br>Record</h1>
        <p class="rail-sub">Official file on record. Contact the registrar to request corrections.</p>

        <div class="rail-photo">
            <div class="photo-mount">
                @if ($student->profile_picture)
                    <img
                        src="{{ asset('storage/' . $student->profile_picture) }}"
                        alt="Profile Picture"
                    >
                @else
                    <div class="no-picture">No Photo</div>
                @endif
            </div>
            <div class="rail-name">{{ $student->first_name }} {{ $student->last_name }}</div>
            <div class="rail-id">FILE NO. {{ $student->student_id }}</div>
        </div>

        <div class="rail-footer">
            Generated by the Admissions Portal.<br>Keep student information confidential.
        </div>

    </aside>

    <main class="content-panel">

        <div class="content-header">
            <div>
                <div class="header-eyebrow">Permanent Record</div>
                <h1>Student Profile</h1>
            </div>
            <span class="stamp">Enrolled</span>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        <section class="card">
            <div class="torn-edge"></div>
            <div class="card-inner">
                <div class="card-tab">
                    <span class="num">01</span>
                    <h2>Personal Information</h2>
                </div>

                <div class="entries">

                    <div class="entry">
                        <span class="label">Student ID</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->student_id }}</span>
                    </div>

                    <div class="entry">
                        <span class="label">Full Name</span>
                        <span class="leader"></span>
                        <span class="value">
                            {{ $student->first_name }}
                            {{ $student->middle_name }}
                            {{ $student->last_name }}
                        </span>
                    </div>

                    <div class="entry">
                        <span class="label">Email</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->email }}</span>
                    </div>

                    <div class="entry">
                        <span class="label">Mobile Number</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->mobile_number }}</span>
                    </div>

                    <div class="entry">
                        <span class="label">Date of Birth</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->date_of_birth->format('F d, Y') }}</span>
                    </div>

                    <div class="entry">
                        <span class="label">Gender</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->gender }}</span>
                    </div>

                </div>
            </div>
        </section>

        <section class="card">
            <div class="torn-edge"></div>
            <div class="card-inner">
                <div class="card-tab">
                    <span class="num">02</span>
                    <h2>Academic Information</h2>
                </div>

                <div class="entries">

                    <div class="entry">
                        <span class="label">Program</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->program }}</span>
                    </div>

                    <div class="entry">
                        <span class="label">Year Level</span>
                        <span class="leader"></span>
                        <span class="value">{{ $student->year_level }}</span>
                    </div>

                    <div class="entry wrap">
                        <span class="label">Address</span>
                        <span class="value">{{ $student->address }}</span>
                    </div>

                </div>
            </div>
        </section>

        <a href="{{ route('students.create') }}" class="back-button">
            + Register Another Student
        </a>

    </main>

</div>

</body>
</html>