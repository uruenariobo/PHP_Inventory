# PHP_Inventory

# Instrucciones de Instalación - PHP Inventory

A continuación, se detallan los pasos necesarios para instalar y configurar el sistema PHP Inventory en su servidor local o remoto.

## Requisitos previos

Antes de comenzar con la instalación, asegúrese de que su servidor cumpla con los siguientes requisitos:

- Servidor web (por ejemplo, XAMPP, WAMP, LAMP) instalado y funcionando.
- PHP (versión 7 o superior) instalado y configurado correctamente.
- MySQL (o cualquier otro gestor de base de datos compatible con PHP) instalado y configurado.
- Git instalado en su sistema si desea clonar el repositorio desde GitHub.

## Pasos de instalación

1. Descargue o clone el proyecto desde GitHub:
   - Descarga: Haga clic en el botón "Code" en la página del repositorio y seleccione "Download ZIP". Extraiga el contenido del archivo ZIP en su directorio de trabajo.
   - Clonación: Abra la terminal o el símbolo del sistema y ejecute el siguiente comando:
     ```
     git clone https://github.com/uruenariobo/PHP_Inventory.git
     ```

2. Copie o mueva la carpeta 'inventario' a su servidor local o remoto. Asegúrese de que la carpeta esté ubicada dentro de la raíz del servidor web (por ejemplo, htdocs en XAMPP).

3. Cree una base de datos en MySQL con el nombre de su preferencia. Luego, selecciónela e importe la base de datos del sistema utilizando phpMyAdmin u otro gestor gráfico de MySQL que esté utilizando. El archivo de la base de datos se encuentra en la carpeta DB y está nombrado como 'inventario.sql'.

4. Abra el archivo `main.php` con su editor de código favorito y configure los datos del servidor para establecer la conexión a la base de datos. Busque la función `conexion` en el archivo y modifique los parámetros de conexión con los detalles de su base de datos.

5. Usuario por defecto de la plataforma:
   - Usuario: Administrador
   - Clave: Administrador

¡Listo! Ahora puede acceder a su plataforma PHP Inventory desde su servidor local o remoto. Asegúrese de navegar al directorio donde ha copiado o movido la carpeta 'inventario' y abra su navegador web. Luego, ingrese la dirección de su servidor seguida de '/inventario' en la barra de direcciones (por ejemplo, http://localhost/inventario/).

Si todo se ha configurado correctamente, debería ver la interfaz de inicio de sesión del sistema. Utilice las credenciales de usuario predeterminadas proporcionadas anteriormente para iniciar sesión como administrador.

¡Disfrute usando PHP Inventory para gestionar su inventario!

Si tiene alguna pregunta o problema durante la instalación o configuración, no dude en contactarnos para obtener asistencia adicional. ¡Gracias por elegir PHP Inventory!
