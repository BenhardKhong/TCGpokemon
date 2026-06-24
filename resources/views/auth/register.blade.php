<!DOCTYPE html>
<html>
<head>
    <title>Register</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

    <div class="row justify-content-center">

        <div class="col-md-4">

            <div class="card">

                <div class="card-header text-center">
                    <h3>Register</h3>
                </div>

                <div class="card-body">

                    <form action="/register" method="POST">

                        @csrf

                        <div class="mb-3">
                            <label>Username</label>

                            <input type="text"
                                   name="username"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Email</label>

                            <input type="email"
                                   name="email"
                                   class="form-control">
                        </div>

                        <div class="mb-3">
                            <label>Password</label>

                            <input type="password"
                                   name="password"
                                   class="form-control">
                        </div>

                        <button class="btn btn-success w-100">
                            Register
                        </button>

                    </form>

                    <div class="mt-3 text-center">
                        <a href="/login">
                            Sudah punya akun?
                        </a>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>