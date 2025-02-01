<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
</head>

<style>
body {
    font-family: Arial, sans-serif;
    background-color: #d1e9ff;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: white;
    width: 600px;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    font-size: 24px;
    margin-bottom: 20px;
    color: black;
}

form {
    display: flex;
    flex-wrap: wrap;
}

.form-group {
    display: flex;
    align-items: center;
    margin-bottom: 15px;
    width: 100%;
}

form label {
    font-size: 14px;
    color: #333;
    width: 150px;
}

form input,
form select {
    width: calc(100% - 160px);
    padding: 10px;
    margin-left: 10px;
    border-radius: 5px;
    border: 1px solid #ccc;
    background-color: #f2f2f2;
}

form input[type="file"] {
    padding: 5px;
}

form .btn {
    width: 100%;
    padding: 10px;
    background-color: #3689f8;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

form .btn:hover {
    background-color: #3178d3;
}

.currentFile {
    margin-top: -10px;
    margin-left: 165px;
    margin-bottom: 10px;
}
</style>


<body>
    <div class="container">
        <div class="form-container">
            <h2>Edit Profile</h2>
            <form method="POST" action="{{ route('updateTeam', ['teamId' => $team->teamId]) }}"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Use PUT method to update the data -->

                <div class="form-group">
                    <label for="nama">Nama</label>
                    <input type="text" id="nama" name="name" value="{{ old('name', $userInfo->name) }}"
                        placeholder="Enter your name">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $userInfo->email) }}"
                        placeholder="Enter your email">
                </div>

                <div class="form-group">
                    <label for="whatsapp">Whatsapp Number</label>
                    <input type="tel" id="whatsapp" name="whatsapp_number"
                        value="{{ old('whatsapp_number', $userData->whatsapp_number) }}"
                        placeholder="Enter your whatsapp number">
                </div>

                <div class="form-group">
                    <label for="lineid">Line ID</label>
                    <input type="text" id="lineid" name="line_id" value="{{ old('line_id', $userData->line_id) }}"
                        placeholder="Enter your Line ID">
                </div>

                <div class="form-group">
                    <label for="github">Github/Gitlab ID</label>
                    <input type="text" id="github" name="github_gitlab_id"
                        value="{{ old('github_gitlab_id', $userData->github_gitlab_id) }}"
                        placeholder="Enter your Github/Gitlab ID">
                </div>

                <div class="form-group">
                    <label for="birthplace">Birth Place</label>
                    <select id="birthplace" name="birthplace">
                        <option value="Aceh" {{ old('birthplace', $userData->birthplace) == 'Aceh' ? 'selected' : '' }}>
                            Aceh</option>
                        <option value="Bali" {{ old('birthplace', $userData->birthplace) == 'Bali' ? 'selected' : '' }}>
                            Bali</option>
                        <option value="Banten"
                            {{ old('birthplace', $userData->birthplace) == 'Banten' ? 'selected' : '' }}>Banten</option>
                        <option value="Bengkulu"
                            {{ old('birthplace', $userData->birthplace) == 'Bengkulu' ? 'selected' : '' }}>Bengkulu
                        </option>
                        <option value="DIY" {{ old('birthplace', $userData->birthplace) == 'DIY' ? 'selected' : '' }}>
                            Daerah Istimewa Yogyakarta</option>
                        <option value="DKI" {{ old('birthplace', $userData->birthplace) == 'DKI' ? 'selected' : '' }}>
                            DKI Jakarta</option>
                        <!-- Add other options here, following the same pattern -->
                    </select>
                </div>

                <div class="form-group">
                    <label for="birthdate">Birth Date</label>
                    <input type="date" id="birthdate" name="birthdate"
                        value="{{ old('birthdate', $userData->birthdate) }}">
                </div>

                <div class="form-group">
                    <label for="cv">Upload CV</label>
                    <input type="file" id="cv" name="cv" placeholder="Upload your CV">
                </div>
                @if($userData->cv_path)
                <a class="currentFile" href="{{ asset($userData->cv_path) }}" target="_blank">Current CV</a>
                @endif
                <div class="form-group">
                    <label for="flazz">Upload Flazz or ID Card</label>
                    <input type="file" id="flazz_or_id" name="flazz_or_id" placeholder="Upload your Flazz card">
                </div>
                @if($userData->flazz_or_id_card_path)
                <a class="currentFile" href=" {{ asset($userData->flazz_or_id_card_path) }}" target="_blank">Current
                    Flazz
                    Card</a>
                @endif

                <button type="submit" class="btn">Save Changes</button>
            </form>
        </div>
    </div>

</body>

</html>