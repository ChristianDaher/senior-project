<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Contact Request</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Outfit:wght@400;700&display=swap');

        body {
            font-family: 'Outfit', sans-serif;
            color: #001030;
            background-color: #f4f5f7;
        }

        .color-primary {
            color: #3b82f6;
        }

        .container {
            max-width: 37.5rem;
            margin: auto;
            padding: 1.25rem;
            background-color: white;
            border: 1px solid #cccccc;
            border-radius: 4px;
        }

        .text-center {
            text-align: center;
        }

        .bold {
            font-weight: bold;
        }

        .m-0 {
            margin: 0;
        }

        .my-4 {
            margin-top: 1rem;
            margin-bottom: 1rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="text-center">Contact Request</h1>

        <p>{{ $name }} is requesting to contact you.</p>

        <div class="my-4">
            <p class="m-0 bold">Email:</p>
            <a class="color-primary" href="mailto:{{ $email }}">{{ $email }}</a>
        </div>

        <div class="my-4">
            <p class="m-0 bold">Subject:</p>
            <p class="m-0">{{ $given_subject }}</p>
        </div>

        <div class="my-4">
            <p class="m-0 bold">Message:</p>
            <p class="m-0">{{ $given_message }}</p>
        </div>
    </div>
</body>

</html>