<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestor de Archivos</title>
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
        .file-icon {
            font-size: 3rem;
            color: #6c757d;
        }
        .file-card:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease-in-out;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Gestor de Archivos</a>
            <div class="d-flex">
                <span class="navbar-text me-3">Bienvenido, <strong><?php echo htmlspecialchars($user['name']); ?></strong></span>
                <a href="postsController.php" class="btn btn-outline-light btn-sm me-2">Ver Posts</a>
                <a href="logoutController.php" class="btn btn-danger btn-sm">Cerrar sesión</a>
            </div>
        </div>
    </nav>

    <div class="container my-5">
        <?php if (!empty($message)): ?>
            <div class="alert alert-success"><?php echo $message; ?></div>
        <?php endif; ?>

        <?php if (!empty($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>

        <div class="card mb-4">
            <div class="card-body">
                <h5 class="card-title">Subir un nuevo archivo</h5>
                <form action="../controllers/fileManagerController.php" method="POST" enctype="multipart/form-data" class="row g-3">
                    <div class="col-md-8">
                        <input type="file" class="form-control" name="file" required>
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary w-100">Subir archivo</button>
                    </div>
                </form>
            </div>
        </div>

        <h4 class="mb-3">Mis archivos</h4>
        <div class="row">
            <?php if (empty($allFiles)): ?>
                <div class="col-12">
                    <div class="alert alert-info">No hay archivos disponibles.</div>
                </div>
            <?php else: ?>
                <?php foreach ($allFiles as $file): ?>
                    <div class="col-md-4 col-lg-3 mb-4">
                        <div class="card file-card">
                            <div class="card-body text-center">
                                <div class="file-icon">
                                    <?php
                                    $icon = 'fa-file';
                                    switch ($file['type']) {
                                        case 'images':
                                            $icon = 'fa-file-image';
                                            break;
                                        case 'documents':
                                            $icon = 'fa-file-pdf';
                                            break;
                                        case 'audio':
                                            $icon = 'fa-file-audio';
                                            break;
                                        case 'video':
                                            $icon = 'fa-file-video';
                                            break;
                                    }
                                    ?>
                                    <i class="fas <?php echo $icon; ?>"></i>
                                </div>
                                <h6 class="card-title text-truncate mt-3" title="<?php echo htmlspecialchars($file['name']); ?>">
                                    <?php echo htmlspecialchars($file['name']); ?>
                                </h6>
                                <p class="text-muted small">
                                    <?php echo round($file['size'] / 1024, 2); ?> KB<br>
                                    <?php echo $file['modified']; ?>
                                </p>
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