<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Blog - Publicaciones</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .navbar {
            background-color: #343a40;
        }
        .navbar-brand, .navbar-nav .nav-link {
            color: #ffffff !important;
        }
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .card img {
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
            height: 200px;
            object-fit: cover;
        }
        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }
        .card-text {
            font-size: 0.9rem;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Blog</a>
            <div class="d-flex">
                <span class="navbar-text me-3">Bienvenido, <strong><?php echo htmlspecialchars($user['name']); ?></strong></span>
                <a href="../controllers/fileManagerController.php" class="btn btn-outline-light btn-sm me-2">Gestor de Archivos</a>
                <a href="../controllers/logoutController.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="fw-bold">Publicaciones</h2>
        </div>

        <div class="row">
            <?php if (empty($publishedPosts)): ?>
                <div class="col-12">
                    <div class="alert alert-info text-center">No hay publicaciones disponibles.</div>
                </div>
            <?php else: ?>
                <?php foreach ($publishedPosts as $post): ?>
                    <div class="col-md-4">
                        <div class="card mb-4">
                            <img src="<?php echo htmlspecialchars($post['image']); ?>" class="card-img-top" alt="Imagen">
                            <div class="card-body">
                                <h5 class="card-title text-truncate" title="<?php echo htmlspecialchars($post['title']); ?>">
                                    <?php echo htmlspecialchars($post['title']); ?>
                                </h5>
                                <p class="card-text text-truncate" title="<?php echo htmlspecialchars($post['description']); ?>">
                                    <?php echo htmlspecialchars($post['description']); ?>
                                </p>
                                <p class="text-muted small">Publicado el <?php echo htmlspecialchars($post['created_at']); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>