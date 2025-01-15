<!DOCTYPE html>
<html>
<head>
    <title>Users List</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h2>Users List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Full Name</th>
                <th>Email</th>
                <th>Contact Number</th>
                <th>postcode</th>
                <th>Gender</th>
                <th>State</th>
                <th>City</th>
                <th>Hobbies</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->firstname }} {{ $user->lastname }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->contact_number }}</td>
                    <td>{{ $user->postcode }}</td>
                    <td>{{ ucfirst($user->gender) }}</td>
                    <td>{{ $user->state->name ?? 'N/A' }}</td>
                    <td>{{ $user->city->name ?? 'N/A' }}</td>
                    <td>
                        @foreach($user->hobbie as $hobbie)
                            {{ ucfirst($hobbie->hobbie) }},
                        @endforeach
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
