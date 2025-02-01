<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>

<style>
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    width: 85%;
    margin: 0 auto;
    padding-top: 20px;
}

.header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #fff;
    padding: 15px 20px;
    border-radius: 10px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}

.header h1 {
    font-size: 24px;
    color: #333;
}

.search-sort {
    display: flex;
    align-items: center;
    background-color: gray;
    padding: 7px;
    border-radius: 10px;
}

.search-sort input {
    padding: 8px;
    border-radius: 4px;
    border: 1px solid #ddd;
    margin-right: 10px;
    width: 200px;
}

.sortButton {
    padding: 8px 12px;
    background-color: #007BFF;
    color: white;
    border: none;
    border-radius: 4px;
    cursor: pointer;
}

.sortButton:hover {
    background-color: #0056b3;
}

.icon {
    width: 20px;
    height: 20px;
    margin-left: 10px;
    margin-right: 15px;
    cursor: pointer;
}

.team-list {
    margin-top: 20px;
}

.team {
    display: flex;
    justify-content: space-between;
    align-items: center;
    background-color: #e6f7ff;
    margin-bottom: 10px;
    padding: 15px;
    border-radius: 8px;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
}

.team:nth-child(odd) {
    background-color: #cce7ff;
}

.team span {
    font-size: 18px;
    font-weight: 600;
}

.actions {
    display: flex;
    gap: 8px;
}

.actions button {
    padding: 8px 12px;
    background-color: #fff;
    color: #007BFF;
    border: 1px solid #007BFF;
    border-radius: 4px;
    cursor: pointer;
}

.actions button:hover {
    background-color: #007BFF;
    color: white;
}

.logout {
    margin-left: 0;
}

.logout-container {
    display: flex;
    justify-content: flex-end;
    width: 100%;
}

.logout-button {

    margin-top: 10px;
    padding: 10px 20px;
    background-color: #dc3545;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

.logout-button:hover {
    background-color: #c82333;
}
</style>

<body>
    <div class="container">
        <div class="header">
            <h1>Admin Panel</h1>
            <div class="search-sort">
                <img class="icon" src="{{ asset('asset/cil_magnifying-glass.png') }}" alt="Search Icon">
                <input type="text" id="searchInput" placeholder="Search">
                <button class="sortButton">Sort</button>

                <script>
                document.querySelector('.sortButton').addEventListener('click', function() {
                    let name = document.getElementById('searchInput').value.trim();
                    if (name) {
                        window.location.href = "{{ route('searchByName', ['name' => 'PLACEHOLDER']) }}".replace(
                            'PLACEHOLDER', encodeURIComponent(name));
                    } else {
                        alert("Insert Name First");
                    }
                });
                </script>



                <a href="{{ route('sortByName', ['stat' => 'desc']) }}">
                    <img class="icon" src="{{ asset('asset/bx_sort-z-a.png') }}" alt="Sort Icon">
                </a>
                <a href="{{ route('sortByName', ['stat' => 'asc']) }}">
                    <img class="icon" src="{{ asset('asset/bx_sort-z-a.png') }}" alt="Sort Icon">
                </a>
            </div>
        </div>
        <div class="logout-container">
            <form action="{{ route('adminLogout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        </div>

    </div>

    <div class="team-list">
        @if ($teams->isNotEmpty())
        @foreach ($teams as $team)
        <div class="team">
            <span>{{ $team->team_name }}</span> <!-- Fixed variable name -->
            <div class="actions">
                <a href="{{ route('editTeam', ['teamId' => $team->teamId]) }}">
                    <button type="button">View</button>
                </a>
                <a href="{{ route('editTeam', ['teamId' => $team->teamId]) }}">
                    <button type="button">Edit</button>
                </a>
                <form action="{{ route('deleteTeam', $team->teamId) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        onclick="return confirm('Are you sure you want to delete this team?')">Delete</button>
                </form>
            </div>
        </div>
        @endforeach
        @else
        <p>No teams available.</p>
        @endif
    </div>


    </div>
</body>

</html>