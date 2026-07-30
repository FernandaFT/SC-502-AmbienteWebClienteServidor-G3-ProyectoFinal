# SGH — Sistema de Gestión de Horas

![PHP](https://img.shields.io/badge/PHP-Backend-777BB4?logo=php\&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL%20%2F%20MariaDB-Database-4479A1?logo=mysql\&logoColor=white)
![JavaScript](https://img.shields.io/badge/JavaScript-Frontend-F7DF1E?logo=javascript\&logoColor=black)
![Bootstrap](https://img.shields.io/badge/Bootstrap-UI-7952B3?logo=bootstrap\&logoColor=white)
![Estado](https://img.shields.io/badge/Estado-Proyecto%20Académico-success)

## Descripción

**SGH (Sistema de Gestión de Horas)** es una aplicación web desarrollada como proyecto final del curso **SC-502 Ambiente Web Cliente Servidor**.

El sistema permite administrar el registro de horas laborales de los colaboradores, gestionar clientes, tramitar solicitudes de permisos y vacaciones, consultar reportes y controlar diferentes operaciones administrativas mediante perfiles de **administrador** y **empleado**.

La aplicación utiliza una arquitectura basada en el patrón **Modelo–Vista–Controlador (MVC)**, PHP para la lógica del servidor, MySQL o MariaDB para la persistencia de datos y tecnologías web como HTML, CSS, JavaScript, jQuery y Bootstrap para la interfaz.

---

## Objetivo del proyecto

Centralizar y facilitar la gestión de horas laborales y acciones de personal dentro de una organización.

El sistema permite:

* Registrar y consultar las horas trabajadas.
* Clasificar las horas como ordinarias, extra o dobles.
* Administrar empleados y clientes.
* Solicitar permisos y vacaciones.
* Aprobar o rechazar solicitudes.
* Generar reportes por fechas y clientes.
* Enviar notificaciones internas.
* Enviar correos relacionados con las acciones de personal.
* Mostrar indicadores según el rol del usuario.

---

## Funcionalidades principales

### Autenticación y seguridad

* Inicio de sesión.
* Cierre de sesión.
* Control de acceso mediante sesiones de PHP.
* Diferenciación de opciones según el rol del usuario.
* Recuperación de acceso.
* Cambio de contraseña.
* Administración del perfil del usuario.

### Gestión de usuarios

* Creación de empleados y administradores.
* Consulta de usuarios registrados.
* Actualización de información.
* Activación e inactivación de usuarios.
* Validación de identificaciones repetidas.
* Validación de correos electrónicos repetidos.
* Asignación de roles.

### Gestión de clientes

* Registro de nuevos clientes.
* Consulta de clientes.
* Edición de información.
* Activación de clientes.
* Inactivación de clientes.
* Visualización paginada de registros.

### Registro de horas

* Registro de horas por empleado.
* Asociación de horas con un cliente.
* Asociación de una categoría de hora.
* Registro de una descripción.
* Registro de la fecha correspondiente.
* Edición de registros existentes.
* Consulta del historial personal.
* Visualización paginada de registros.

Las horas pueden clasificarse como:

* Ordinarias.
* Extra.
* Dobles.

### Reportería

* Consulta de horas por rango de fechas.
* Filtro por cliente.
* Validación de fechas.
* Visualización paginada de resultados.
* Generación de reportes.
* Exportación de información en formato CSV compatible con Excel.
* Limpieza de filtros aplicados.

### Permisos

* Solicitud de permisos.
* Selección de categoría.
* Registro de fecha inicial y fecha final.
* Descripción del motivo.
* Validación del rango de fechas.
* Consulta del historial de solicitudes.
* Consulta del detalle de cada solicitud.

### Vacaciones

* Consulta de días disponibles.
* Solicitud de vacaciones.
* Selección de fecha inicial y fecha final.
* Cálculo de días solicitados.
* Validación de disponibilidad.
* Consulta del estado de la solicitud.

### Gestión de acciones de personal

Los administradores pueden:

* Consultar solicitudes pendientes.
* Revisar permisos.
* Revisar vacaciones.
* Aprobar solicitudes.
* Rechazar solicitudes.
* Consultar el usuario solicitante.
* Enviar una notificación con el resultado.
* Enviar un correo electrónico al empleado.

### Notificaciones

* Notificaciones internas para empleados.
* Notificaciones internas para administradores.
* Avisos de nuevas solicitudes.
* Avisos de solicitudes aprobadas.
* Avisos de solicitudes rechazadas.
* Historial de notificaciones.
* Marcado de notificaciones como leídas.
* Indicador visual de notificaciones pendientes.

### Panel de control

El contenido del dashboard cambia según el rol del usuario.

#### Dashboard del empleado

Muestra información como:

* Total de horas registradas.
* Solicitudes pendientes.
* Días de vacaciones disponibles.
* Último cliente registrado.
* Última categoría de hora.
* Cantidad de horas del último registro.
* Fecha del último registro.

#### Dashboard del administrador

Muestra información como:

* Total de usuarios.
* Total de clientes activos.
* Solicitudes pendientes de revisión.
* Solicitudes aprobadas.
* Solicitudes rechazadas.
* Indicadores generales del sistema.

---

## Roles del sistema

| Rol               | Funciones principales                                                                                                                    |
| ----------------- | ---------------------------------------------------------------------------------------------------------------------------------------- |
| **Administrador** | Gestionar usuarios y clientes, revisar acciones de personal, aprobar o rechazar solicitudes, consultar reportes y administrar su perfil. |
| **Empleado**      | Registrar horas, solicitar permisos o vacaciones, consultar sus solicitudes, revisar notificaciones y administrar su perfil.             |

---

## Tecnologías utilizadas

### Backend

* PHP.
* MySQLi.
* Sesiones de PHP.
* Procedimientos almacenados.
* PHPMailer.
* SMTP de Microsoft 365.

### Frontend

* HTML5.
* CSS3.
* SCSS.
* JavaScript.
* jQuery.
* jQuery Validation.
* Bootstrap.
* Bootstrap Datepicker.
* Chart.js.
* Material Design Icons.
* Font Awesome.

### Base de datos

* MySQL.
* MariaDB.
* Procedimientos almacenados.
* Scripts SQL.

### Herramientas de desarrollo

* Visual Studio Code.
* XAMPP.
* phpMyAdmin.
* Git.
* GitHub.

---

## Arquitectura del proyecto

El proyecto utiliza una organización basada en el patrón MVC.

```text
SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal/
│
├── BD_Actualizada/
│   └── Scripts SQL con estructura y datos actualizados
│
├── BD_Vacia/
│   └── Scripts para crear la base de datos sin datos
│
├── Controller/
│   ├── PHPMailer/
│   ├── ControllerCliente.php
│   ├── ControllerConsultaAcciones.php
│   ├── ControllerDashboard.php
│   ├── ControllerHoras.php
│   ├── ControllerLogin.php
│   ├── ControllerNotificaciones.php
│   ├── ControllerPermiso.php
│   ├── ControllerRecuperarC.php
│   ├── ControllerRegistro.php
│   ├── ControllerSeguridad.php
│   ├── ControllerVacaciones.php
│   └── UtilitarioController.php
│
├── Model/
│   ├── ModelCliente.php
│   ├── ModelConsultasAcciones.php
│   ├── ModelDashboard.php
│   ├── ModelHoras.php
│   ├── ModelLogin.php
│   ├── ModelNotificacion.php
│   ├── ModelPermiso.php
│   ├── ModelRecuperarC.php
│   ├── ModelRegistro.php
│   ├── ModelVacaciones.php
│   └── UtilitarioModel.php
│
├── View/
│   ├── assets/
│   ├── emails/
│   ├── vHome/
│   ├── vSeguridad/
│   └── layoutGeneral.php
│
├── index.php
└── README.md
```

### Controller

Contiene la lógica de procesamiento de las solicitudes recibidas desde las vistas.

Entre sus responsabilidades se encuentran:

* Procesar formularios.
* Validar información.
* Controlar sesiones.
* Gestionar redirecciones.
* Enviar correos.
* Solicitar información a los modelos.
* Mostrar mensajes de éxito o error.

### Model

Contiene las funciones relacionadas con el acceso a la base de datos.

Entre sus responsabilidades se encuentran:

* Abrir y cerrar conexiones.
* Ejecutar procedimientos almacenados.
* Consultar registros.
* Insertar información.
* Actualizar datos.
* Cambiar estados.
* Obtener información para dashboards y reportes.

### View

Contiene las interfaces que utiliza el usuario.

Incluye:

* Formularios.
* Tablas.
* Paneles administrativos.
* Dashboard.
* Menús según el rol.
* Plantillas de correo.
* Archivos CSS.
* Archivos JavaScript.
* Recursos gráficos.

---

## Requisitos

Para ejecutar el proyecto localmente se necesita:

* Apache.
* PHP con la extensión `mysqli`.
* MySQL o MariaDB.
* Navegador web moderno.
* XAMPP, WAMP, MAMP o un entorno equivalente.
* Git para clonar el repositorio.
* Una cuenta SMTP si se utilizará el envío de correos.

---

## Instalación y configuración

### 1. Clonar el repositorio

Ejecute el siguiente comando:

```bash
git clone https://github.com/FernandaFT/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal.git
```

También puede descargar el proyecto como archivo ZIP desde GitHub.

---

### 2. Colocar el proyecto en el servidor local

En XAMPP para Windows, coloque la carpeta en:

```text
C:\xampp\htdocs\
```

La ruta debería quedar similar a:

```text
C:\xampp\htdocs\SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL
```

En Apache para Linux, puede utilizar:

```text
/var/www/html/
```

> El proyecto contiene rutas absolutas que utilizan el nombre:
>
> `SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL`
>
> Se recomienda conservar ese nombre exacto para evitar errores en las rutas.

---

### 3. Iniciar los servicios

Desde el panel de XAMPP, inicie:

* Apache.
* MySQL.

---

### 4. Crear la base de datos

Los scripts SQL se encuentran en las carpetas:

```text
BD_Actualizada/
BD_Vacia/
```

Para trabajar con la versión actualizada:

1. Abra phpMyAdmin.
2. Seleccione la opción **Importar**.
3. Importe primero el script que crea la base de datos `sgh`.
4. Importe los scripts correspondientes a las tablas.
5. Ejecute los procedimientos almacenados.
6. Ejecute los archivos de actualización o parches cuando corresponda.

La base de datos utilizada por la aplicación se llama:

```text
sgh
```

---

### 5. Configurar la conexión a la base de datos

Abra el archivo:

```text
Model/UtilitarioModel.php
```

La conexión incluida en el proyecto utiliza una configuración similar a la siguiente:

```php
function OpenDBPractica()
{
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

    return mysqli_connect(
        "127.0.0.1:3306",
        "root",
        "",
        "sgh"
    );
}
```

Modifique los siguientes valores según su entorno:

* Servidor.
* Puerto.
* Usuario.
* Contraseña.
* Nombre de la base de datos.

---

### 6. Configurar el envío de correos

Abra el archivo:

```text
Controller/UtilitarioController.php
```

Complete las credenciales SMTP:

```php
$correoSalida = "correo@dominio.com";
$contrasennaSalida = "contraseña-o-clave-de-aplicación";
```

La configuración del proyecto utiliza:

```text
Servidor: smtp.office365.com
Puerto: 587
Seguridad: TLS
```

> No se recomienda guardar credenciales reales directamente en el repositorio. Para un entorno productivo se deben utilizar variables de entorno.

---

### 7. Ejecutar el proyecto

Abra en el navegador:

```text
http://localhost/SC-502-AMBIENTEWEBCLIENTESERVIDOR-G3-PROYECTOFINAL/
```

El archivo `index.php` redirige automáticamente a la pantalla de inicio de sesión.

---

## Flujo general de uso

1. El usuario ingresa su correo y contraseña.
2. El sistema valida las credenciales.
3. Se crea una sesión con la información del usuario.
4. El sistema identifica si el usuario es administrador o empleado.
5. Se muestra el menú correspondiente al rol.
6. El empleado puede registrar horas o enviar solicitudes.
7. Los administradores reciben notificaciones sobre nuevas solicitudes.
8. El administrador puede aprobar o rechazar la solicitud.
9. El empleado recibe una notificación con el resultado.
10. Si SMTP está configurado, también recibe un correo electrónico.
11. El administrador puede consultar y exportar reportes.

---

## Base de datos

Entre las principales entidades del sistema se encuentran:

* Usuario.
* Cliente.
* Categoría de hora.
* Registro de horas.
* Categoría de permiso.
* Solicitud de permiso.
* Vacaciones.
* Solicitud de vacaciones.
* Notificación.

La lógica de datos utiliza procedimientos almacenados para operaciones como:

* Inicio de sesión.
* Registro de usuarios.
* Actualización de usuarios.
* Consulta de usuarios.
* Registro de clientes.
* Actualización de clientes.
* Registro de horas.
* Consulta de horas.
* Gestión de permisos.
* Gestión de vacaciones.
* Aprobación de solicitudes.
* Rechazo de solicitudes.
* Consulta del dashboard.
* Generación de reportes.
* Administración de notificaciones.

---

## Validaciones implementadas

El sistema incluye validaciones como:

* Campos obligatorios.
* Correos electrónicos válidos.
* Identificaciones no repetidas.
* Correos no repetidos.
* Rangos de fechas correctos.
* Cantidades de horas válidas.
* Selección obligatoria de clientes.
* Selección obligatoria de categorías.
* Validación de sesiones activas.
* Validación del rol del usuario.
* Validación de días de vacaciones disponibles.
* Mensajes de éxito, advertencia y error.

---

## Consideraciones de seguridad

Este repositorio corresponde a un proyecto académico.

Antes de utilizarlo en un ambiente productivo se recomienda:

* Eliminar datos personales de los scripts SQL.
* Eliminar usuarios y contraseñas de prueba.
* Almacenar contraseñas con `password_hash()`.
* Validar contraseñas con `password_verify()`.
* Utilizar consultas preparadas.
* Evitar la concatenación directa de datos dentro de consultas SQL.
* Mover las credenciales a variables de entorno.
* Proteger los formularios contra ataques CSRF.
* Validar y sanitizar todos los datos recibidos.
* Configurar correctamente las cookies de sesión.
* Restringir el acceso directo a archivos internos.
* Utilizar HTTPS.
* Implementar una política de contraseñas.
* Incorporar una bitácora de auditoría.

---

## Posibles mejoras

* Implementar un archivo central de configuración.
* Utilizar variables de entorno.
* Incorporar Composer.
* Administrar PHPMailer mediante Composer.
* Agregar pruebas unitarias.
* Agregar pruebas de integración.
* Implementar migraciones de base de datos.
* Generar reportes en PDF.
* Generar reportes en formato XLSX.
* Agregar filtros avanzados.
* Incorporar gráficos adicionales.
* Registrar una bitácora de auditoría.
* Mejorar la gestión de permisos por módulo.
* Crear una API REST.
* Incorporar autenticación con tokens.
* Agregar recuperación de contraseña mediante enlaces temporales.
* Implementar GitHub Actions.
* Preparar el sistema para despliegue en producción.

---

## Proyecto académico

Proyecto final desarrollado para el curso:

```text
SC-502 Ambiente Web Cliente Servidor
Grupo 3
```

Repositorio:

```text
https://github.com/FernandaFT/SC-502-AmbienteWebClienteServidor-G3-ProyectoFinal
```

---

## Licencia

Este proyecto fue desarrollado con fines académicos.

Actualmente, el repositorio no especifica una licencia de software. Para reutilizar, modificar o distribuir el código se recomienda agregar un archivo `LICENSE` con las condiciones correspondientes.
