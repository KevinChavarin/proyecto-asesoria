<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Menú Principal</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            margin-top: 100px;
        }
        button {
            padding: 15px 30px;
            font-size: 18px;
            margin: 10px;
            cursor: pointer;
            border: none;
            border-radius: 8px;
            background-color: #4CAF50;
            color: white;
            transition: background-color 0.3s ease;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

    <h1>Asesorias CUCEA</h1>
    <h1>Bienvenido</h1>
    <form action="Registro.php" method="get" style="display: inline;">
        <button type="submit">Ir a Registro</button>
    </form>

    <form action="mostrarhorario.php" method="get" style="display: inline;">
        <button type="submit">Mostrar Horario</button>
    </form>

</body>
</html>