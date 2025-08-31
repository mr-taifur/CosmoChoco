<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(to right, #4facfe, #00f2fe);
        }

        .sidebar {
            height: 100vh;
            background: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            color: #adb5bd;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 6px;
            transition: 0.3s;
        }

        .sidebar a:hover {
            background: #495057;
            color: #fff;
        }

        .sidebar a.active {
            background: #0d6efd;
            color: #fff;
        }

        .dashboard-card {
            border-radius: 12px;
            padding: 25px;
            color: #fff;
        }

        .users {
            background: #6f42c1;
        }

        .products {
            background: #20c997;
        }

        .messages {
            background: #fd7e14;
        }

        .revenue {
            background: #198754;
        }

        .logout-btn {
            position: absolute;
            bottom: 20px;
            left: 20px;
            right: 20px;
        }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <div class="col-md-3 col-lg-2 sidebar d-flex flex-column">
                <h3 class="text-white text-center mb-4">Admin Panel</h3>
                <a href="#" class="active"><i class="bi bi-speedometer2"></i> Dashboard</a>
                <a href="#"><i class="bi bi-people-fill"></i> Manage Users</a>
                <a href="#"><i class="bi bi-box-seam"></i> Manage Products</a>
                <a href="#"><i class="bi bi-chat-dots-fill"></i> Messages</a>
                <a href="#"><i class="bi bi-graph-up-arrow"></i> Revenue</a>

                <form action="{{ route('logout') }}" method="POST" class="logout-btn">
                    @csrf
                    <button type="submit" class="btn btn-danger w-100"><i class="bi bi-box-arrow-right"></i>
                        Logout</button>
                </form>
            </div>

            <!-- Main Content -->
            <div class="col-md-9 col-lg-10 p-4">
                <div class="d-flex justify-content-center align-items-center" style="height: 100px;">
                    <h1 class="mb-4 text-white text-center">Welcome, Admin</h1>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card users">
                            <h4><i class="bi bi-people-fill"></i> Users</h4>
                            <h2>1,245</h2>
                            <p>Active Users</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card products">
                            <h4><i class="bi bi-box-seam"></i> Products</h4>
                            <h2>560</h2>
                            <p>Total Products</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card messages">
                            <h4><i class="bi bi-chat-dots-fill"></i> Messages</h4>
                            <h2>87</h2>
                            <p>New Messages</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="dashboard-card revenue">
                            <h4><i class="bi bi-graph-up-arrow"></i> Revenue</h4>
                            <h2>$12,450</h2>
                            <p>This Month</p>
                        </div>
                    </div>
                </div>

                <!-- Extra section -->
                <div class="mt-5 card shadow-lg">
                    <div class="card-body">
                        <h4 class="card-title">Recent Activities</h4>
                        <ul class="list-group list-group-flush">
                            <li class="list-group-item">👤 New user registered</li>
                            <li class="list-group-item">📦 Product added to inventory</li>
                            <li class="list-group-item">💬 New message received</li>
                            <li class="list-group-item">💰 Revenue updated</li>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>
