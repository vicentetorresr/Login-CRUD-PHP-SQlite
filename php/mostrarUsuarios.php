<?php
// Conexión a la base de datos SQLite
$db = new SQLite3('../db/user.db');

// Consulta SQL para obtener los datos de la tabla
$query = "SELECT * FROM users";

// Ejecutar la consulta y obtener los resultados
$result = $db->query($query);

// Verificar si se obtuvieron resultados
if ($result) {
    // Variable para controlar la primera fila
    $esPrimeraFila = true;
    
    // Recorrer los resultados y generar las filas de la tabla
    while ($row = $result->fetchArray(SQLITE3_ASSOC)) {
        echo "<tr>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['idUser'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['username'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['password'] . "</span></td>";
        echo "<td><span class='editable' contenteditable='false'>" . $row['role'] . "</span></td>";
        echo "<td>";
        
        // Verificar si es la primera fila (administrador)
        if ($esPrimeraFila) {
            // No mostrar botones de edición y eliminación
            echo "Owner";
        } else {
            // Mostrar botones de edición y eliminación
            echo "<span class='editar' data-id='" . $row['idUser'] . "' onclick='makeEditable(this)'><i class='fas fa-edit'></i></span>";
            echo "<span class='guardar' data-id='" . $row['idUser'] . "' onclick='saveChanges(this)'><i class='fas fa-save'></i></span>";
            echo "<span class='eliminar' data-id='" . $row['idUser'] . "' onclick='eliminarUsuario(this)'><i class='fas fa-trash'></i></span>";
        }
        
        echo "</td>";
        echo "</tr>";
        
        // Actualizar el valor de $esPrimeraFila después de la primera fila
        $esPrimeraFila = false;
    }

    // Liberar el resultado de la consulta
    $result->finalize();
} else {
    // Error al ejecutar la consulta
    echo "Error al obtener los datos de la tabla: " . $db->lastErrorMsg();
}

// Cerrar la conexión a la base de datos
$db->close();
?>

</table>
<button id="btnAgregarUsuario" onclick="addUser()"><i class="fas fa-plus"></i> </button>
</body>
</html>
