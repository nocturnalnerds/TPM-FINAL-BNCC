<!DOCTYPE html>
<html>

<head>
    <title>User Dashboard</title>
</head>

<body>
    <h1>User Dashboard</h1>
    <h2>Team Information</h2>
    <ul>
        <li>User Data ID: {{ $userData['user_data_id'] }}</li>
        <li>User ID: {{ $userData['userId'] }}</li>
        <li>WhatsApp Number: {{ $userData['whatsapp_number'] }}</li>
        <li>Line ID: {{ $userData['line_id'] }}</li>
        <li>GitHub/GitLab ID: {{ $userData['github_gitlab_id'] }}</li>
        <li>Birthplace: {{ $userData['birthplace'] }}</li>
        <li>Birthdate: {{ $userData['birthdate'] }}</li>
        <li>CV Path: <a href="{{ asset($userData['cv_path']) }}" target="_blank">View CV</a></li>
        <li>Flazz or ID Card Path: <a href="{{ asset($userData['flazz_or_id_card_path']) }}" target="_blank">View
                Flazz/ID Card</a></li>
    </ul>
</body>

</html>