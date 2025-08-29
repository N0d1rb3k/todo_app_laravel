<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Task - Todo App</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif;
            margin: 2rem;
            background-color: #f8f9fa;
            color: #212529;
        }
        .form-container {
            max-width: 500px;
            margin: 2rem auto;
            padding: 2rem;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .form-group {
            margin-bottom: 1.5rem;
        }
        label {
            display: block;
            margin-bottom: 0.5rem;
            font-weight: 600;
        }
        input[type="text"], textarea {
            width: 100%;
            padding: 0.75rem;
            border: 1px solid #ced4da;
            border-radius: 4px;
            box-sizing: border-box; /* Ensures padding doesn't affect width */
        }
        .error-message {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }
        button[type="submit"] {
            padding: 0.75rem 1.5rem;
            border: none;
            border-radius: 4px;
            background-color: #0d6efd;
            color: white;
            font-size: 1rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        button[type="submit"]:hover {
            background-color: #0b5ed7;
        }
        .task-list {
            margin-top: 3rem;
        }
        .task-list h2 {
            border-bottom: 2px solid #eee;
            padding-bottom: 0.5rem;
            margin-bottom: 1.5rem;
        }
        .task-item {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 6px;
            padding: 1rem 1.5rem;
            margin-bottom: 1rem;
            transition: box-shadow 0.2s ease-in-out;
        }
        .task-item:hover {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.075);
        }
        .task-content {
            margin-right: 1rem;
        }
        .task-content h3 {
            margin-top: 0;
            margin-bottom: 0.25rem;
            font-size: 1.25rem;
        }
        .task-content p {
            margin: 0;
            color: #6c757d;
        }
        .delete-btn {
            padding: 0.5rem 1rem;
            border: none;
            border-radius: 4px;
            background-color: #dc3545;
            color: white;
            font-size: 0.9rem;
            cursor: pointer;
            transition: background-color 0.2s ease;
        }
        .delete-btn:hover {
            background-color: #c82333;
        }
        .empty-message {
            color: #6c757d;
            text-align: center;
            padding: 2rem;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h1>Create a New Task</h1>
        <form action="{{ route('main.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" placeholder="e.g., Finish project report" value="{{ old('title') }}">
                @error('title')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="task">Task Description</label>
                <textarea id="task" name="task" rows="5" placeholder="e.g., Draft the introduction and conclusion sections.">{{ old('task') }}</textarea>
                @error('task')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Add Task</button>
        </form>

        <div class="task-list">
            <h2>Tasks</h2>
            @forelse($datas as $task)
                <div class="task-item" id="task{{ $task->id }}">
                    <div class="task-content">
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->task }}</p>
                    </div>
                    <button class="delete-btn" onclick="delete_it({{ $task->id }})">Delete</button>
                </div>
            @empty
                <p class="empty-message">No tasks yet. Add one above!</p>
            @endforelse
        </div>
    </div>
</body>
</html>

<script>
    function delete_it(id){
        fetch(`home/${id}/delete`,{
                method: 'DELETE',
                content: 'application/json',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
                })
            .then(response => response.json())
            .then(data =>{
                if(data.success){
                    document.getElementById('task'+id).remove()
                }
            })
            .catch(error => console.log(error));
    }
</script>
