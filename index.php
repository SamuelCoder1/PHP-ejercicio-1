<?php
session_start();

$users = [
    [
        'id' => 1,
        'name' => 'Ana Martínez',
        'email' => 'ana@example.com',
        'password' => password_hash('password123', PASSWORD_DEFAULT),
    ],
    [
        'id' => 2,
        'name' => 'Carlos Gómez',
        'email' => 'carlos@example.com',
        'password' => password_hash('qwerty456', PASSWORD_DEFAULT),
    ],
    [
        'id' => 3,
        'name' => 'Laura Rodríguez',
        'email' => 'laura@example.com',
        'password' => password_hash('abc12345', PASSWORD_DEFAULT),
    ],
    [
        'id' => 4,
        'name' => 'David Torres',
        'email' => 'david@example.com',
        'password' => password_hash('pass7890', PASSWORD_DEFAULT),
    ],
    [
        'id' => 5,
        'name' => 'María López',
        'email' => 'maria@example.com',
        'password' => password_hash('mypass321', PASSWORD_DEFAULT),
    ]
];

$posts = [
    [
        'id' => 1,
        'title' => 'Bienvenidos al blog',
        'description' => 'Este es el primer post de prueba.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 10:00:00',
        'status' => 'published'
    ],
    [
        'id' => 2,
        'title' => 'Tips para programar en PHP',
        'description' => 'Consejos útiles para escribir mejor código en PHP.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 2,
        'created_at' => '2025-03-28 11:30:00',
        'status' => 'published'
    ],
    [
        'id' => 3,
        'title' => 'Mi experiencia con Laravel',
        'description' => 'Compartiendo lo aprendido trabajando con Laravel.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 3,
        'created_at' => '2025-03-28 13:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 4,
        'title' => 'Aprender JavaScript desde cero',
        'description' => 'Recursos y estrategias para aprender JS.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 14:20:00',
        'status' => 'published'
    ],
    [
        'id' => 5,
        'title' => 'Desarrollo web moderno',
        'description' => '¿Qué herramientas deberías conocer hoy en día?',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 4,
        'created_at' => '2025-03-28 15:00:00',
        'status' => 'published'
    ],
    [
        'id' => 6,
        'title' => 'Cómo hacer un blog con PHP',
        'description' => 'Guía paso a paso para crear tu propio blog.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 2,
        'created_at' => '2025-03-28 16:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 7,
        'title' => 'Seguridad en aplicaciones web',
        'description' => 'Evita ataques comunes como XSS y SQL Injection.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 5,
        'created_at' => '2025-03-28 17:30:00',
        'status' => 'published'
    ],
    [
        'id' => 8,
        'title' => 'Ventajas de usar frameworks',
        'description' => 'Por qué deberías usar Laravel, Symfony, etc.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 3,
        'created_at' => '2025-03-28 18:00:00',
        'status' => 'published'
    ],
    [
        'id' => 9,
        'title' => 'Diseño responsive',
        'description' => 'Cómo hacer que tu web se vea bien en todos los dispositivos.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 1,
        'created_at' => '2025-03-28 19:00:00',
        'status' => 'draft'
    ],
    [
        'id' => 10,
        'title' => 'Usando APIs con PHP',
        'description' => 'Aprende a consumir y crear APIs RESTful.',
        'image' => 'https://via.placeholder.com/600x400',
        'author_id' => 4,
        'created_at' => '2025-03-28 20:00:00',
        'status' => 'published'
    ]
];


//Verifico si el usuario ya tiene una sesion y si la tiene lo redirijo a welcome.php
if (isset($_SESSION['user'])) {
    header('Location: welcome.php');
    exit;
}


//Verifico si el formulario fue enviado por el metodo post
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Se inicializa la variable en null
    $user = null;

    //Se recorre el array de usuarios, y si el email ingresado en el formulario coincide con alguno
    //del array, se guardan los datos en la variable user
    foreach ($users as $u) {
        if ($u['email'] == $email) {
            $user = $u;
            break;
        }
    }

    //Verificamos que el usuario no sea null y verificamos su contraseña, si las credenciales coinciden
    //con los datos del array, inicia sesion y se envia al usuario a welcome.php
    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user'] = $user;
        header('Location: welcome.php');
        exit;
    } else {
        //Si las credenciales son incorrectas, se muestra un mensaje de error
        $error_message = "Credenciales incorrectas. Intente nuevamente.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>

<div class="login-container">
    <h2>Iniciar sesión</h2>
    <?php if (isset($error_message)) { echo "<p class='error'>$error_message</p>"; } ?>
    <form method="POST" action="index.php">
        <div class="input-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="input-group">
            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
        </div>
        <button type="submit">Iniciar sesión</button>
    </form>
</div>

</body>
</html>
 