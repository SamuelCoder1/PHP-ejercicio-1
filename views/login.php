<?php
require_once '../includes/session.php';

if (isset($_SESSION['user'])) {
    header('Location: ../controllers/postsController.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #e9ecef;
        }
        .login-container {
            max-width: 500px;
            padding: 3rem;
            border-radius: 15px;
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
            background-color: #ffffff;
        }
        .login-title {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1.5rem;
            text-align: center;
        }
        .btn-primary {
            background-color: #007bff;
            border: none;
            font-size: 1.1rem;
            padding: 0.75rem;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .form-label {
            font-weight: bold;
            font-size: 1rem;
        }
    </style>
</head>
<body class="d-flex justify-content-center align-items-center vh-100">
    <div class="login-container">
        <h2 class="login-title">Iniciar Sesión</h2>
        <form action="../controllers/loginController.php" method="POST">
            <?php if (!empty($error)): ?>
                <div class="alert alert-danger"><?php echo htmlspecialchars($error); ?></div>
            <?php endif; ?>
            <div class="mb-4">
                <label for="email" class="form-label">Correo Electrónico</label>
                <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="Ingresa tu correo" required>
            </div>
            <div class="mb-4">
                <label for="password" class="form-label">Contraseña</label>
                <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Ingresa tu contraseña" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Ingresar</button>
        </form>
    </div>
</body>
</html>