<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>CodePen - Sign up / Login Form</title>
    <style>
        <?php include 'reglogin.css'; ?>
    </style>
</head>

<body>
    <!-- partial:index.partial.html -->
    <!DOCTYPE html>
    <html>

    <head>
        <title>Slide Navbar</title>
        <link rel="stylesheet" type="text/css" href="slide navbar style.css">
        <link href="https://fonts.googleapis.com/css2?family=Jost:wght@500&display=swap" rel="stylesheet">
    </head>

    <body>

        <div class="main">
            <a href="/">Home</a>
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form id="regform" onsubmit="register()">
                    <label for="chk" aria-hidden="true">Sign up</label>
                    <input id="regusername" type="text" name="txt" placeholder="User name" required="">
                    <input id="regemail" type="email" name="email" placeholder="Email" required="">
                    <input id="regpassword" type="password" name="pswd" placeholder="Password" required="">
                    <button>Sign up</button>
                </form>
            </div>

            <div class="login">
                <form id="loginform" onsubmit="login()">
                    <label for="chk" aria-hidden="true">Login</label>
                    <input id="loginemail" type="email" name="email" placeholder="Email" required="">
                    <input id="loginpassword" type="password" name="pswd" placeholder="Password" required="">
                    <button>Login</button>
                </form>
            </div>
        </div>
        <script>
            document.getElementById("loginform").addEventListener("submit", function(event) {
                event.preventDefault()
            });
            document.getElementById("regform").addEventListener("submit", function(event) {
                event.preventDefault()
            });
            async function login() {
                const bodyreq = {
                    email: document.getElementById("loginemail").value,
                    password: document.getElementById("loginpassword").value
                };
                const response = await fetch("http://localhost:80/api/auth/login/", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bodyreq),
                });
                const res = await response.json();
                if (res.status == "ok") {
                    alert("success")
                    window.location.href = "http://localhost:80/courses";
                } else if (res.error) {
                    alert(res.error)
                }
            }
            async function register() {
                const bodyreq = {
                    username: document.getElementById("regusername").value,
                    email: document.getElementById("regemail").value,
                    password: document.getElementById("regpassword").value,
                    profile_name: "somename"
                };
                const response = await fetch("http://localhost:80/api/auth/register/", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify(bodyreq),
                });
                const res = await response.json();
                if (res.message) {
                    alert(res.message)
                    window.location.href = "http://localhost:80/registerlogin";
                } else if (res.error) {
                    alert(res.error)
                }
            }
        </script>
    </body>

    </html>
    <!-- partial -->

</body>

</html>