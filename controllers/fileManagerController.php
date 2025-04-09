<?php
require_once '../includes/session.php';
require_once '../includes/data.php';

// Verificar si el usuario está autenticado
if (!isset($_SESSION['user'])) {
    header('Location: loginController.php');
    exit;
}

$user = $_SESSION['user'];
$message = '';
$error = '';

// Carpeta para subir archivos
$uploadBaseDir = '../uploads/';

// Crear las carpetas si no existen
$directories = [
    'images' => $uploadBaseDir . 'images/',
    'documents' => $uploadBaseDir . 'documents/',
    'audio' => $uploadBaseDir . 'audio/',
    'video' => $uploadBaseDir . 'video/',
    'others' => $uploadBaseDir . 'others/'
];

foreach ($directories as $dir) {
    if (!file_exists($dir)) {
        mkdir($dir, 0777, true);
    }
}

// Función para determinar el directorio según la extensión
function getDirectoryByExtension($extension) {
    $extension = strtolower($extension);
    
    $imageExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg', 'bmp'];
    $documentExtensions = ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'ppt', 'pptx', 'txt', 'csv'];
    $audioExtensions = ['mp3', 'wav', 'ogg', 'flac', 'aac'];
    $videoExtensions = ['mp4', 'avi', 'mov', 'wmv', 'flv', 'mkv'];
    
    if (in_array($extension, $imageExtensions)) {
        return 'images';
    } elseif (in_array($extension, $documentExtensions)) {
        return 'documents';
    } elseif (in_array($extension, $audioExtensions)) {
        return 'audio';
    } elseif (in_array($extension, $videoExtensions)) {
        return 'video';
    } else {
        return 'others';
    }
}

// Función para generar un nombre único si existe un archivo con el mismo nombre
function getUniqueFilename($directory, $filename) {
    $originalName = pathinfo($filename, PATHINFO_FILENAME);
    $extension = pathinfo($filename, PATHINFO_EXTENSION);
    
    $counter = 1;
    $newFilename = $filename;
    
    while (file_exists($directory . $newFilename)) {
        $newFilename = $originalName . '_' . $counter . '.' . $extension;
        $counter++;
    }
    
    return $newFilename;
}

// Procesar subida de archivo
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['file'])) {
    if ($_FILES['file']['error'] === UPLOAD_ERR_OK) {
        $tempFile = $_FILES['file']['tmp_name'];
        $filename = $_FILES['file']['name'];
        $extension = pathinfo($filename, PATHINFO_EXTENSION);
        
        // Obtener el directorio según la extensión
        $dirType = getDirectoryByExtension($extension);
        $targetDir = $directories[$dirType];
        
        // Generar nombre único si ya existe
        $uniqueFilename = getUniqueFilename($targetDir, $filename);
        
        // Mover el archivo
        if (move_uploaded_file($tempFile, $targetDir . $uniqueFilename)) {
            $message = "Archivo subido correctamente a la carpeta '$dirType'.";
            if ($uniqueFilename !== $filename) {
                $message .= " Se ha renombrado a '$uniqueFilename' porque ya existía un archivo con el mismo nombre.";
            }
        } else {
            $error = 'Error al subir el archivo.';
        }
    } else {
        $error = 'Error: ' . $_FILES['file']['error'];
    }
}

// Obtener la lista de archivos en todas las carpetas
$allFiles = [];
foreach ($directories as $type => $dir) {
    if (file_exists($dir)) {
        $files = scandir($dir);
        foreach ($files as $file) {
            if ($file != '.' && $file != '..') {
                $allFiles[] = [
                    'name' => $file,
                    'type' => $type,
                    'path' => $dir . $file,
                    'size' => filesize($dir . $file),
                    'modified' => date("d/m/Y H:i:s", filemtime($dir . $file))
                ];
            }
        }
    }
}

// Ordenar archivos por fecha de modificación (más reciente primero)
usort($allFiles, function($a, $b) {
    return filemtime($b['path']) - filemtime($a['path']);
});

// Cargar la vista
include '../views/fileManager.php';
?>