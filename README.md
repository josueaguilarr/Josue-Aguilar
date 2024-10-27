## Como ejecutar el proyecto

- Es necesario contar con XAMPP o Laragon.
- Clonar o descargar en ZIP y poner la carpeta base ya sea en htdocs (XAMPP) o en www (Laragon).
- Crear la base de datos con el script que esta dentro de la carpeta llamado 'burben_db'.
- En caso de tener credenciales distintas ajustarlas en Config/Database.php.
- **NOTA**: Las validaciones fueron hechas en front y en backend. En caso de modificar el DOM quitando el required, pattern, etc. El backend lo detectará y mostrará los campos faltantes.
- **NO SE REQUIERE DE INSTALACIÓN DE NADA NI EJECUCIÓN DE COMANDOS.**

## Herramientas

[ ✅ ] Utilizar Framework de PHP o PHP puro

[ ✅ ] Utializar Framework Vue.js o JavaScript puro

[ ✅ ] Utilizar Bootstrap para diseño

[ ✅ ] Base de datos MariaDB

## 1. Realiza un formulario

[ ✅ ] Realiza una validación en el front (con JS) y backend (con PHP) para los datos.

[ ✅ ] Valide que el RFC cumpla con persona moral o física (muestra un mensaje de error si el RFC no cumple con las especificaciones).

[ ✅ ] Si las validaciones son correctas, usa PHP y guarda en base de datos el registro.

[ ✅ ] Guarda todos los datos en una base de datos local SQL con la contraseña cifrada.

[ ✅ ] El diseño y usabilidad del registro también se evaluará.

[ ✅ ] Realiza el registro de al menos 2 usuarios desde este formulario (el correo puede ser inventado).

## 2. Inicio de sesión

[ ✅ ] Valida en el front que el email sea un email válido y oculta la contraseña.

[ ✅ ] El diseño y usabilidad del inicio de sesión será evaluado.

## 3. Realiza una vista

[ ✅ ] Si no se tiene un inicio de sesión válido, que regrese a la página del punto anterior.

[ ✅ ] Muestra el nombre y correo electrónico del usuario que inicio sesión.

[ ✅ ] Muestra en pantalla una tabla con la información de todos los usuarios
registrados en el sistema.

[ ✅ ] Implementa una tabla que te permita hacer filtrado de información, ordenamiento por columna y exportación en formato PDF o CSV.

[ ✅ ] Realiza un modal para poder actualizar información de los usuarios, con sus respectivas validaciones.

[ ✅ ] Actualiza información mediante Ajax, axioso fetch y manda un mensaje de confirmación en la vista.
