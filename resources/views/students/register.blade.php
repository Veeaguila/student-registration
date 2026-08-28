<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Registration</title>

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
            --error-bg: #f7ece9;
            --error-text: #9c3b30;
            --error-border: #e3c3b9;
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

        /* ---------- Left rail ---------- */

        .rail {
            position: sticky;
            top: 0;
            height: 100vh;
            background: linear-gradient(170deg, var(--paper-dark) 0%, #ddd1b6 100%);
            border-right: 3px solid var(--brass);
            padding: 44px 30px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
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
            max-width: 28ch;
        }

        .tally {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 26px;
            font-family: 'IBM Plex Mono', monospace;
        }

        .tally .boxes {
            display: flex;
            gap: 5px;
        }

        .tally .box {
            width: 13px;
            height: 13px;
            border: 1.5px solid var(--brass);
            background: transparent;
            transition: background 0.2s ease, border-color 0.2s ease;
        }

        .tally .box.filled {
            background: var(--forest);
            border-color: var(--forest);
        }

        .tally .tally-text {
            font-size: 11.5px;
            color: var(--ink-soft);
        }

        /* Folder tab stack */

        .tab-stack {
            list-style: none;
            margin: 30px 0 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .tab-item {
            background: rgba(255, 253, 247, 0.4);
            border: 1px solid var(--border);
            border-left: 4px solid transparent;
            border-radius: 0 8px 8px 0;
            padding: 12px 16px 12px 14px;
            display: flex;
            gap: 12px;
            align-items: flex-start;
            transform: translateX(0);
            transition: transform 0.25s ease, background 0.25s ease, border-color 0.25s ease, box-shadow 0.25s ease;
            cursor: default;
        }

        .tab-item .step-num {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12px;
            font-weight: 600;
            color: var(--ink-faint);
            width: 16px;
            flex-shrink: 0;
            transition: color 0.25s ease;
        }

        .tab-item .step-label {
            font-family: 'Spectral', serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--ink-faint);
            transition: color 0.25s ease;
        }

        .tab-item .step-desc {
            display: block;
            font-size: 11.5px;
            color: var(--ink-faint);
            margin-top: 2px;
            font-family: 'Inter', sans-serif;
        }

        .tab-item.active {
            background: var(--card);
            border-color: var(--border);
            border-left-color: var(--forest);
            transform: translateX(10px);
            box-shadow: -3px 3px 0 rgba(35, 40, 31, 0.05);
        }

        .tab-item.active .step-num,
        .tab-item.active .step-label {
            color: var(--ink);
        }

        .tab-item.completed {
            cursor: pointer;
        }

        .tab-item.completed .step-num::before {
            content: "✓ ";
            color: var(--forest);
        }

        .tab-item.completed .step-label {
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

        /* ---------- Right form panel ---------- */

        .form-panel {
            padding: 56px 60px 80px;
            max-width: 680px;
        }

        .header-eyebrow {
            font-family: 'IBM Plex Mono', monospace;
            font-size: 11px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: var(--forest);
            margin-bottom: 8px;
        }

        .form-header h1 {
            font-family: 'Spectral', serif;
            font-size: 28px;
            font-weight: 600;
            color: var(--ink);
            margin: 0 0 8px;
        }

        .form-header p {
            font-size: 13.5px;
            color: var(--ink-soft);
            margin: 0 0 30px;
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

        .error-summary {
            background: var(--error-bg);
            color: var(--error-text);
            border: 1px solid var(--error-border);
            padding: 15px 18px;
            margin-bottom: 24px;
            border-radius: 4px;
            font-size: 13.5px;
        }

        .error-summary strong {
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 600;
        }

        .error-summary ul {
            margin: 8px 0 0;
            padding-left: 20px;
        }

        .error-summary li {
            margin-bottom: 3px;
        }

        .card {
            background: var(--card);
            border: 1px solid var(--border);
            box-shadow: 0 8px 20px rgba(35, 40, 31, 0.05);
            animation: rise 0.3s ease;
        }

        .card.step-hidden {
            display: none;
        }

        @keyframes rise {
            from { opacity: 0; transform: translateY(8px); }
            to { opacity: 1; transform: translateY(0); }
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
            clip-path: polygon(0 0, 100% 0, 92% 100%, 0% 100%);
            margin: 0 0 22px -32px;
            padding: 7px 18px 7px 32px;
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

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 22px 24px;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-family: 'IBM Plex Mono', monospace;
            font-weight: 600;
            font-size: 11px;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            color: var(--ink-faint);
        }

        label .required {
            color: var(--accent-red);
            margin-left: 2px;
        }

        input,
        select,
        textarea {
            width: 100%;
            box-sizing: border-box;
            padding: 7px 2px 9px;
            border: none;
            border-bottom: 1.5px solid var(--border);
            border-radius: 0;
            background: transparent;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 14px;
            color: var(--ink);
            transition: border-color 0.15s ease;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-bottom-color: var(--forest);
        }

        input.touched:invalid,
        select.touched:invalid,
        textarea.touched:invalid {
            border-bottom-color: var(--accent-red);
        }

        input::placeholder,
        textarea::placeholder {
            color: var(--ink-faint);
        }

        select {
            appearance: none;
            background-image: linear-gradient(45deg, transparent 50%, var(--ink-faint) 50%), linear-gradient(135deg, var(--ink-faint) 50%, transparent 50%);
            background-position: calc(100% - 10px) center, calc(100% - 4px) center;
            background-size: 6px 6px, 6px 6px;
            background-repeat: no-repeat;
            padding-right: 22px;
        }

        textarea {
            min-height: 84px;
            resize: vertical;
        }

        small {
            display: block;
            margin-top: 7px;
            color: var(--ink-faint);
            font-size: 11.5px;
            font-family: 'IBM Plex Mono', monospace;
        }

        .error {
            color: var(--error-text);
            font-size: 12.5px;
            margin-top: 6px;
            font-weight: 500;
            font-family: 'IBM Plex Mono', monospace;
        }

        /* Photo mount upload */

        .dropzone {
            display: flex;
            align-items: center;
            gap: 20px;
            cursor: pointer;
        }

        .dropzone input[type="file"] {
            display: none;
        }

        .photo-mount {
            width: 84px;
            height: 84px;
            position: relative;
            background: var(--paper);
            border: 1.5px dashed var(--brass);
            padding: 5px;
            flex-shrink: 0;
            transition: border-color 0.15s ease, background 0.15s ease;
        }

        .dropzone.dragover .photo-mount {
            border-color: var(--forest);
            background: var(--success-bg);
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
            font-size: 9px;
            color: var(--ink-faint);
            text-transform: uppercase;
            text-align: center;
        }

        .dropzone-text {
            font-size: 13px;
            color: var(--ink-soft);
        }

        .dropzone-text strong {
            font-family: 'Spectral', serif;
            color: var(--ink);
            font-weight: 600;
        }

        .dropzone-text span {
            display: block;
            color: var(--ink-faint);
            font-size: 11.5px;
            font-family: 'IBM Plex Mono', monospace;
            margin-top: 3px;
        }

        /* Step navigation */

        .step-nav {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 30px;
            padding-top: 22px;
            border-top: 1px dashed var(--border);
        }

        .step-nav-spacer {
            flex: 1;
        }

        .submit-note {
            font-size: 11.5px;
            color: var(--ink-faint);
            max-width: 26ch;
            font-family: 'IBM Plex Mono', monospace;
        }

        .btn {
            padding: 12px 24px;
            font-family: 'IBM Plex Mono', monospace;
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            cursor: pointer;
            border: none;
            transition: background 0.15s ease, color 0.15s ease;
        }

        .btn-primary {
            background: var(--forest);
            color: var(--card);
            clip-path: polygon(4% 0, 100% 0, 96% 100%, 0% 100%);
        }

        .btn-primary:hover {
            background: var(--forest-dark);
        }

        .btn-primary::after {
            content: " →";
        }

        .btn-submit::after {
            content: none;
        }

        .btn-secondary {
            background: transparent;
            color: var(--ink-soft);
            border-bottom: 1.5px solid var(--border);
            padding-left: 4px;
            padding-right: 4px;
        }

        .btn-secondary:hover {
            color: var(--ink);
            border-bottom-color: var(--ink-soft);
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
            .tab-stack,
            .rail-footer {
                display: none;
            }

            .tally {
                margin-top: 16px;
            }

            .form-panel {
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

            .form-grid {
                grid-template-columns: 1fr;
            }

            .full-width {
                grid-column: auto;
            }

            .step-nav {
                flex-wrap: wrap;
                gap: 12px;
            }

            .submit-note {
                max-width: none;
                order: 3;
                flex-basis: 100%;
            }
        }
    </style>
</head>

<body>

<div class="portal">

    <aside class="rail">

        <div class="brand-eyebrow">Office of the Registrar</div>
        <div class="brand-name">Admissions Portal</div>

        <h1 class="rail-heading">Open a<br>New File</h1>
        <p class="rail-sub">Complete each tab to create the student's official record.</p>

        <div class="tally">
            <div class="boxes" id="tally-boxes">
                <span class="box"></span>
                <span class="box"></span>
                <span class="box"></span>
            </div>
            <span class="tally-text" id="tally-text">Entry 1 of 3</span>
        </div>

        <ul class="tab-stack" id="step-list">
            <li class="tab-item active" data-step="0">
                <span class="step-num">01</span>
                <div>
                    <div class="step-label">Personal</div>
                    <span class="step-desc">Name, contact, ID</span>
                </div>
            </li>
            <li class="tab-item" data-step="1">
                <span class="step-num">02</span>
                <div>
                    <div class="step-label">Academic</div>
                    <span class="step-desc">Program, year, address</span>
                </div>
            </li>
            <li class="tab-item" data-step="2">
                <span class="step-num">03</span>
                <div>
                    <div class="step-label">Photo &amp; File</div>
                    <span class="step-desc">Upload and confirm</span>
                </div>
            </li>
        </ul>

        <div class="rail-footer">
            Fields marked <span style="color: var(--accent-red);">&bull;</span> are required.<br>Used only for enrollment records.
        </div>

    </aside>

    <main class="form-panel">

        <div class="form-header">
            <div class="header-eyebrow">New Entry</div>
            <h1>Student Registration</h1>
            <p>Fill in the details below to add a new student to the system.</p>
        </div>

        @if (session('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="error-summary">
                <strong>Please correct the following errors:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('students.store') }}" method="POST" enctype="multipart/form-data" id="registration-form" novalidate>

            @csrf

            <section class="card" id="section-personal" data-step="0">
                <div class="torn-edge"></div>
                <div class="card-inner">
                    <div class="card-tab">
                        <span class="num">01</span>
                        <h2>Personal Information</h2>
                    </div>

                    <div class="form-grid">

                        <div>
                            <label for="student_id">Student ID<span class="required">&bull;</span></label>
                            <input type="text" id="student_id" name="student_id" value="{{ old('student_id') }}" required>
                            @error('student_id') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="email">Email<span class="required">&bull;</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                            @error('email') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="first_name">First Name<span class="required">&bull;</span></label>
                            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
                            @error('first_name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="middle_name">Middle Name</label>
                            <input type="text" id="middle_name" name="middle_name" value="{{ old('middle_name') }}">
                            @error('middle_name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="last_name">Last Name<span class="required">&bull;</span></label>
                            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
                            @error('last_name') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="mobile_number">Mobile Number<span class="required">&bull;</span></label>
                            <input type="text" id="mobile_number" name="mobile_number" value="{{ old('mobile_number') }}" required>
                            @error('mobile_number') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="date_of_birth">Date of Birth<span class="required">&bull;</span></label>
                            <input type="date" id="date_of_birth" name="date_of_birth" value="{{ old('date_of_birth') }}" required>
                            @error('date_of_birth') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="gender">Gender<span class="required">&bull;</span></label>
                            <select id="gender" name="gender" required>
                                <option value="">Select Gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                <option value="Other" {{ old('gender') == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            @error('gender') <div class="error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="step-nav">
                        <div class="step-nav-spacer"></div>
                        <button type="button" class="btn btn-primary" data-action="next">Continue</button>
                    </div>
                </div>
            </section>

            <section class="card step-hidden" id="section-academic" data-step="1">
                <div class="torn-edge"></div>
                <div class="card-inner">
                    <div class="card-tab">
                        <span class="num">02</span>
                        <h2>Academic Information</h2>
                    </div>

                    <div class="form-grid">

                        <div>
                            <label for="program">Program<span class="required">&bull;</span></label>
                            <input type="text" id="program" name="program" value="{{ old('program') }}" placeholder="e.g. BS Information Technology" required>
                            @error('program') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div>
                            <label for="year_level">Year Level<span class="required">&bull;</span></label>
                            <select id="year_level" name="year_level" required>
                                <option value="">Select Year Level</option>
                                <option value="1st Year" {{ old('year_level') == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                <option value="2nd Year" {{ old('year_level') == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                <option value="3rd Year" {{ old('year_level') == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                <option value="4th Year" {{ old('year_level') == '4th Year' ? 'selected' : '' }}>4th Year</option>
                            </select>
                            @error('year_level') <div class="error">{{ $message }}</div> @enderror
                        </div>

                        <div class="full-width">
                            <label for="address">Address<span class="required">&bull;</span></label>
                            <textarea id="address" name="address" required>{{ old('address') }}</textarea>
                            @error('address') <div class="error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="step-nav">
                        <button type="button" class="btn btn-secondary" data-action="back">Back</button>
                        <div class="step-nav-spacer"></div>
                        <button type="button" class="btn btn-primary" data-action="next">Continue</button>
                    </div>
                </div>
            </section>

            <section class="card step-hidden" id="section-photo" data-step="2">
                <div class="torn-edge"></div>
                <div class="card-inner">
                    <div class="card-tab">
                        <span class="num">03</span>
                        <h2>Photo &amp; Submission</h2>
                    </div>

                    <div class="form-grid">

                        <div class="full-width">
                            <label for="profile_picture">Profile Picture</label>

                            <label class="dropzone" id="dropzone" for="profile_picture">
                                <span class="photo-mount">
                                    <span class="no-picture" id="avatar-preview">No Photo</span>
                                </span>
                                <span class="dropzone-text">
                                    <strong>Click to upload</strong> or drag a photo here
                                    <span>JPG, JPEG, PNG or GIF &middot; Max 2 MB</span>
                                </span>
                                <input type="file" id="profile_picture" name="profile_picture" accept=".jpg,.jpeg,.png,.gif">
                            </label>

                            @error('profile_picture') <div class="error">{{ $message }}</div> @enderror
                        </div>

                    </div>

                    <div class="step-nav">
                        <button type="button" class="btn btn-secondary" data-action="back">Back</button>
                        <div class="step-nav-spacer"></div>
                        <p class="submit-note">By submitting, you confirm the details above are accurate.</p>
                        <button type="submit" class="btn btn-primary btn-submit">Register Student</button>
                    </div>
                </div>
            </section>

        </form>

    </main>

</div>

<script>
    (function () {
        var sections = Array.prototype.slice.call(document.querySelectorAll('.card[data-step]'))
            .sort(function (a, b) { return a.dataset.step - b.dataset.step; });
        var railSteps = Array.prototype.slice.call(document.querySelectorAll('.tab-item[data-step]'));
        var boxes = Array.prototype.slice.call(document.querySelectorAll('.tally .box'));
        var tallyText = document.getElementById('tally-text');
        var totalSteps = sections.length;
        var current = 0;
        var maxReached = 0;

        function validateSection(section) {
            var fields = section.querySelectorAll('input, select, textarea');
            var valid = true;
            var firstInvalid = null;

            fields.forEach(function (field) {
                field.classList.add('touched');
                if (!field.checkValidity()) {
                    valid = false;
                    if (!firstInvalid) firstInvalid = field;
                }
            });

            if (firstInvalid) {
                firstInvalid.reportValidity();
                firstInvalid.focus();
            }

            return valid;
        }

        function render() {
            sections.forEach(function (section) {
                var step = Number(section.dataset.step);
                section.classList.toggle('step-hidden', step !== current);
            });

            railSteps.forEach(function (li) {
                var step = Number(li.dataset.step);
                li.classList.toggle('active', step === current);
                li.classList.toggle('completed', step < current || (step <= maxReached && step !== current));
            });

            boxes.forEach(function (box, i) {
                box.classList.toggle('filled', i <= current);
            });

            tallyText.textContent = 'Entry ' + (current + 1) + ' of ' + totalSteps;

            sections[current].scrollIntoView({ block: 'start', behavior: 'smooth' });
        }

        function goTo(index) {
            current = Math.max(0, Math.min(totalSteps - 1, index));
            maxReached = Math.max(maxReached, current);
            render();
        }

        document.querySelectorAll('[data-action="next"]').forEach(function (btn) {
            btn.addEventListener('click', function () {
                if (validateSection(sections[current])) goTo(current + 1);
            });
        });

        document.querySelectorAll('[data-action="back"]').forEach(function (btn) {
            btn.addEventListener('click', function () { goTo(current - 1); });
        });

        railSteps.forEach(function (li) {
            li.addEventListener('click', function () {
                var step = Number(li.dataset.step);
                if (step <= maxReached) goTo(step);
            });
        });

        document.getElementById('registration-form').addEventListener('submit', function (e) {
            if (!validateSection(sections[current])) e.preventDefault();
        });

        render();
    })();

    (function () {
        var dropzone = document.getElementById('dropzone');
        var input = document.getElementById('profile_picture');
        var preview = document.getElementById('avatar-preview');

        if (!dropzone || !input || !preview) return;

        function showPreview(file) {
            if (!file) return;
            var reader = new FileReader();
            reader.onload = function (e) {
                preview.outerHTML = '<img id="avatar-preview" src="' + e.target.result + '" alt="Selected photo">';
            };
            reader.readAsDataURL(file);
        }

        input.addEventListener('change', function () {
            if (input.files && input.files[0]) showPreview(input.files[0]);
        });

        ['dragenter', 'dragover'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                dropzone.classList.add('dragover');
            });
        });

        ['dragleave', 'drop'].forEach(function (evt) {
            dropzone.addEventListener(evt, function (e) {
                e.preventDefault();
                dropzone.classList.remove('dragover');
            });
        });

        dropzone.addEventListener('drop', function (e) {
            var file = e.dataTransfer.files && e.dataTransfer.files[0];
            if (file) {
                input.files = e.dataTransfer.files;
                showPreview(file);
            }
        });
    })();
</script>

</body>
</html>