<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
body {
    min-height: 100vh;
    margin: 0;
    background:
        linear-gradient(rgba(0,0,0,0.55), rgba(0,0,0,0.55)),
        url("{{ url('images/logo.png') }}") no-repeat center center;
    background-size: contain;
    background-attachment: fixed;
}

   .login-card {
    border: none;
    border-radius: 14px;
    overflow: hidden;
    box-shadow:
        0 12px 25px rgba(0, 0, 0, 0.15),
        0 4px 10px rgba(0, 0, 0, 0.08);
}

.login-header {
    background: linear-gradient(135deg, #0d6efd, #084298);
    color: #ffffff;
    padding: 1.5rem;
    text-align: center;
}

        .login-body {
            background: #ffffff;
            padding: 2rem;
        }

        .btn-primary {
            background-color: #dc3545; /* Red */
            border: none;
        }

        .btn-primary:hover {
            background-color: #bb2d3b;
        }

        .btn-success {
            background-color: #0d6efd;
            border: none;
        }
        .btn-success:hover {
    background-color: #022a66;
    box-shadow: 0 18px 45px rgba(0, 0, 0, 0.25);
}
    </style>
</head>

<body class="d-flex justify-content-center align-items-center vh-100">
@if(session('error'))
    <div class="bg-red-100 text-red-700 p-3 rounded mb-4">
        {{ session('error') }}
    </div>
@endif
@php
    $adminCount = \App\Models\adminmodel::count();
@endphp

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 col-lg-5">

            <div class="card login-card shadow-lg">
                <div class="login-header">
                    <h3 class="mb-0">Admin Login</h3>
                </div>

                <div class="login-body">

                    {{-- Success Message --}}
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    {{-- Validation Errors --}}
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('admin.login') }}">
                        @csrf

                        <!-- School ID -->
                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control @error('username') is-invalid @enderror"
                                   id="username" name="username" value="{{ old('username') }}" required>
                            @error('username')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Master Key -->
                        <div class="mb-4">
                            <label for="masterkey" class="form-label">Password</label>
                            <input type="password" class="form-control @error('masterkey') is-invalid @enderror"
                                   id="masterkey" name="masterkey" required>
                            @error('masterkey')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Sign In</button>
                        </div>
                    </form>

                    @if ($adminCount === 0)
                        <div class="d-grid mt-3">
                            <a href="{{ route('admin.adminregister') }}" class="btn btn-success">
                                Register Admin
                            </a>
                        </div>
                    @endif

                </div>
            </div>

        </div>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
