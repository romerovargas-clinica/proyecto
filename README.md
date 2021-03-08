# Proyecto Clínica Dental DWEC/DIW

El objetivo de este proyecto es desarrollar e implementar un sitio web que cumpla con las expectativas de calidad y desempeño esperadas por nuestro cliente, teniendo en cuenta los siguientes aspectos: 
Diseño personalizado de página web con gestión de contenidos en línea.

Diseño creativo y eficiente (Responsive Design) que permita que el sitio web funcione y se vea correctamente en los dispositivos móviles y navegadores de Internet basadas en Bootstrap
Un sitio web que los contenidos sean fáciles de leer por los diferentes buscadores de Internet.

### FASES DE DESARROLLO

El desarrollo del proyecto está enfocado en 3 tareas fundamentales para el desarrollo del sitio web. 

- Definición del CONCEPTO GRÁFICO e IMAGEN VISUAL 

  - Definición y selección de la Plantilla web.
  - Organización de la arquitectura de la información.
  - Preparación de la plantilla web.
  - Creación de la base de datos para las citas y el carrito de compras.
  - Creación de un logotipo imagen de marca corporativa.

- Desarrollo del CONTENIDO y ADMINISTRACIÓN del sitio web

  - Desarrollo de las distintas páginas web.
  - Integración del motor de edición en línea a los elementos.
  - Desarrollo Formularios de Captura de Información.
  - Publicación del contenido inicial del sitio web.

- Tareas de DESPLIEGUE y MANTENIMIENTO. 

  - Configuración del hosting y publicación del sitio web en la Internet.
  - Posicionamiento del sitio web y manejo de SEO (Search Engine Optimization).

### INSTALACIÓN

Esta aplicación web precisa de una base de datos MySql cuya estructura se encuentra en [/dump/clinica.sql](https://github.com/romerovargas-clinica/proyecto/tree/main/dump)

Además, requiere del archivo de configuración que contiene los datos de conexión a la base de datos. 

El contenido del archivo de configuración se encuentra fuera del control de versiones por lo que hay que crearlo a mano. Su nombre y contenido es el siguente:

**/config/config.php**

```
<?php
define('DB_SERVER', 'HOST');
define('DB_NAME', 'NAME');
define('DB_USER', 'USER');
define('DB_PASS', 'PASS');
define('st_mailsend', 'EMAIL');
?>
```

La base de datos ya tiene incluido a un usuario con el rol adecuado utilizando el par de valores admin/admin para acceder a la parte de administración

### Autores

Aplicación realizada como Proyecto de las Asignaturas de DWEC y DIW por los alumnos

- [Cintia Cabrera Gamaza](https://github.com/beltenebror)
- [David Bermúdez Moreno](https://github.com/davidbermudez)