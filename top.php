<body bgcolor="#F5F5F5">
<style type="text/css">
  body {
    font-family: Georgia, "Times New Roman",
          Times, serif;
  h1 {
    font-family: Helvetica, Geneva, Arial,
          SunSans-Regular, sans-serif }
 input {
    font-family: Helvetica, Geneva, Arial,
          SunSans-Regular, sans-serif }
  </style>
<form action="top.php" method="post"><center><a href="/" target="_top"><img src="moodle/theme/image.php/boost/core/1556292089/moodlelogo" height="23" width="88"></a>

<?
// CREAR EL USUARIO Y COMPROBAR SI EXISTE CON DIRECTORIOS PHP
if( isset($_POST['create']) )
{
	// si el usuario se habia registrado
	if (file_exists($_POST['telephone'])) {
	echo "&nbsp;Usuario ya existe <a href='javascript:history.back()'>Volver</a><br><br>";
	exit;
	}
	// Si el usuario no se ha registrado
	if (!file_exists($_POST['telephone'])) {
	// telephone is the user ej) 60203234
    mkdir($_POST['telephone'], 0700);
	chmod($_POST['telephone'], 0777);
	
	// email ej) telephone/email/ejemplo@ejemplo.com
    mkdir($_POST['telephone']."/"."email", 0700);
	mkdir($_POST['telephone']."/"."email/".$_POST['email'], 0700); 
	
	// nombre ej) telephone/user/nombredeusuario
    mkdir($_POST['telephone']."/"."name", 0700);
	mkdir($_POST['telephone']."/"."name/".$_POST['name'], 0700); 
	echo "&nbsp;Usuario solicitado correctamente <a href='javascript:history.back()'>Volver</a><br><br>";
	}
	
}
// ENTRAR COMO USUARIO

if( isset($_POST['login']) )
{
	// Si el usuario no se ha registrado
	if (!file_exists($_POST['telephone'])) {
	echo "&nbsp;Usuario no existe <a href='javascript:history.back()'>Volver</a><br><br>";
	exit;
	}
	// si el usuario se habia registrado y entra con su ip
	if (file_exists($_POST['telephone'])) {
	// 
		function obtener_estructura_directorios($ruta){
			// Se comprueba que realmente sea la ruta de un directorio
			if (is_dir($ruta)){
				// Abre un gestor de directorios para la ruta indicada
				$gestor = opendir($ruta);

				// Recorre todos los elementos del directorio
				while (($archivo = readdir($gestor)) !== false)  {
						
					$ruta_completa = $ruta . "/" . $archivo;

					// Se muestran todos los archivos y carpetas excepto "." y ".."
					if ($archivo != "." && $archivo != "..") {
						// Si es un directorio se recorre recursivamente
						if (is_dir($ruta_completa)) {
							echo "&nbsp;" . $archivo . "&nbsp;";
							obtener_estructura_directorios($ruta_completa);
						} else {
							echo "&nbsp;" . $archivo . "&nbsp;";
						}
					}
				}
				
				// Cierra el gestor de directorios
				closedir($gestor);
			} else {
				echo "No es una ruta de directorio valida<br/>";
			}
		}
		obtener_estructura_directorios($_POST['telephone']);
	// fin
	echo "<a href='javascript:history.back()'>Volver</a> <b>(pendiente de alta moodle)</b></a><br><br>";
	exit;
	}
}
?>

  Nombre: <input type="text" name="name">&nbsp;
  Telefono: <input type="text" name="telephone">&nbsp;
  Email: <input type="text" name="email">&nbsp;
  <input type="submit" value="Crear" name="create">
  <input type="submit" value="Entrar" name="login">
</form>
</center>
</body>
