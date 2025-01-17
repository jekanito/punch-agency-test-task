<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Tasks</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">

</head>
<body>
    <header class="header">
        <div class="container">
            <div class="header-items">
                <div class="header-logo">Punch Agency Tasks</div>
                <form method="post" action="/logout">
                    @csrf
                    <button class="logout-button" type="submit">Logout</button>
                </form>
            </div>
        </div>
    </header>
    <section class="tasks">
        <div class="container">
            <h1>Tasks</h1>
            <p>Completed <span class="all-count-completed-tasks">0</span> из <span class="all-count-tasks">10</span></p>
            <button class="add-task">Add Task</button>

            <div class="table-responsive table-tasks">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name Task</th>
                            <th>Description</th>
                            <th>Status</th>
                            <th>Date completed</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="background-task-modal">
        <div class="task-modal">
            <form id="task-modal-form">
                <label for="name">Name</label>
                <input type="text" name="name" value="" id="name">
                <label for="description">Description</label>
                <textarea name="description" id="description"></textarea>
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="pending">Pending</option>
                    <option value="completed">Completed</option>
                </select>
                <label for="date-completion">Date Completion (YYYY-MM-DD)</label>
                <input type="text" name="date_completion" value="" id="date-completion">
                <input type="hidden" id="create-flag" value="1">
                <input type="hidden" id="id" value="">
            </form>
            <div class="task-modal-form-buttons">
                <button class="close-modal">Cancel</button>
                <button class="apply-modal">Create</button>
            </div>
        </div>
    </div>

    <script src="{{ asset('vendor/jquery/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>
</html>
