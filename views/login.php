<style>
    html,
    body {
        height: 100%;
    }

    body {
        display: -ms-flexbox;
        display: flex;
        -ms-flex-align: center;
        align-items: center;
        padding-top: 40px;
        padding-bottom: 40px;
    }

    .button {
        background-color: #d6a92b;
        /* Green */
        border: none;
        color: white;
        padding: 16px 32px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 16px;
        margin: 4px 2px;
        transition-duration: 0.4s;
        cursor: pointer;
    }

    .button1 {
        background-color: white;
        color: black;
        border: 2px solid #d6a92b;
    }

    .button1:hover {
        background-color: #d6a92b;
        color: white;
    }
</style>

<div class="splash-container">
    <div class="card ">
        <div class="card-header text-center"><a href="index.html"><img class="logo-img"
                    src="assets/images/3803863_3.png" alt="logo" height="200px"></a></div>
        <div class="card-body">
            <form action="/login" method="POST" name="login_sform">
                <div class="form-group">
                    <input class="form-control form-control-lg" id="username" name="username" alt="username" type="text"
                        placeholder="Username" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <input class="form-control form-control-lg" id="password" name="password" type="password"
                        alt="password" placeholder="Password" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="custom-control custom-checkbox">
                        <input class="custom-control-input" type="checkbox" id="remember" onclick="myFunction()"><span
                            class="custom-control-label">Show Password</span>
                    </label>
                </div>
                <div class="form-group">
                    <button class="btn btn-lg btn-block button1" value="Sign in" id="btn-student"
                        name="btn-student">Sign in</button>
                </div>
                <div class="form-group" id="alert-msg">
            </form>
        </div>
    </div>
</div>