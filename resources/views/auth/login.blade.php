<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Login</title>
    <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

    * {
        margin: 0;
        padding: 0;
    }

    html {
        font-family: Poppins;
        font-size: 12pt;
        text-align: center;
    }

    body {
        min-height: 100vh;
        background-image: url(bg2.png);
        background-size: contain;
        overflow: hidden;
    }

    .wrapper {
        box-sizing: border-box;
        height: 100vh;
        width: max(40%, 600px);
        padding: 10px;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    h1 {
        font-size: 15pt;
        font-weight: bold;
    }

    form {
        width: min(400px, 100%);
        margin-top: 20px;
        margin-bottom: 50px;
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 10px;
    }

    form>div {
        width: 100%;
        display: flex;
        justify-content: center;
        flex-direction: column;
    }

    form label {
        display: flex;
        justify-content: left;
    }

    form input {
        box-sizing: border-box;
        flex-grow: 1;
        min-width: 0;
        padding: 0.4em 0 0.4em 1em;
        font: inherit;
        font-size: 11px;
        border-radius: 5px;
        border: 2px solid lightgray;
        transition: 150ms ease;
    }

    form input:hover {
        border: 2px solid black;
    }

    form input:focus {
        outline: none;
        border-color: black;
    }

    form button {
        margin-top: 10px;
        border: none;
        border-radius: 10px;
        padding: 0.1em 4em;
        cursor: pointer;
        font: inherit;
        display: flex;
        flex-direction: row;
    }

    #no {
        background-color: red;
    }

    #yes {
        background-color: green;
    }

    form button:focus {
        outline: none;
        background-color: greenyellow;
    }

    #buttWrap {
        display: flex;
        flex-direction: row;
        gap: 10px;
    }

    #accwrap {
        display: flex;
        flex-direction: row;
        gap: 30px;
    }

    #next {
        border: none;
        background-color: blue;
        color: white;
        border-radius: 10px;
        padding: 0.1em 3em;
        cursor: pointer;
        font: inherit;

    }
    </style>
</head>

<body>
    <div class="wrapper">
        <h1>Login Page</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label>Nama Group</label>
                <input required type="text" name="team_name" id="groupInput" placeholder="Team Name">
            </div>
            <div>
                <label>Password</label>
                <input required type="password" name="password" id="passInput" placeholder="Password">
            </div>
            <div id="buttWrap">
                <button type="submit" id="sign">Sign In</button>
                <a href="{{route('registerView')}}">Register</a>
            </div>
        </form>
    </div>

</body>


</html