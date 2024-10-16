<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Stop Timings</title>
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 90%;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            margin-bottom: 20px;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        tr:hover {
            background-color: #ddd;
        }
        .btn-container {
            display: flex;
            justify-content: flex-end;
        }
        .btn {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-left: 10px;
            text-decoration: none;
        }
        .btn.edit {
            background-color: #007BFF;
        }
        .btn.delete {
            background-color: #FF4C4C;
        }
        @media (max-width: 768px) {
            table, th, td {
                font-size: 14px;
            }
            .btn-container {
                display: block;
            }
            .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h1>Stop Timings - Admin Panel</h1>

        <table>
            <thead>
                <tr>
                    <th>Stop ID</th>
                    <th>Routes</th>
                    <th>Arrival Time</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Example Data (You will dynamically populate this using PHP) -->
                <tr>
                    <td>1</td>
                    <td>Route A</td>
                    <td>08:00:00</td>
                    <td class="btn-container">
                        <a href="edit.php?stop_id=1" class="btn edit">Edit</a>
                        <a href="delete.php?stop_id=1" class="btn delete" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>Route B</td>
                    <td>09:15:00</td>
                    <td class="btn-container">
                        <a href="edit.php?stop_id=2" class="btn edit">Edit</a>
                        <a href="delete.php?stop_id=2" class="btn delete" onclick="return confirm('Are you sure you want to delete this entry?')">Delete</a>
                    </td>
                </tr>
                <!-- More rows will go here dynamically -->
            </tbody>
        </table>
    </div>

</body>
</html>
