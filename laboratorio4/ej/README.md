Proyecto: Sistema de Citas Médicas (Laboratorio 4)

Contenido:
- db_citas_medicas.sql -> script para crear la base de datos y tablas
- conexion.php -> conexión mysqli reutilizable
- api/medicos.php -> CRUD (JSON) para médicos
- api/pacientes.php -> CRUD (JSON) para pacientes
- api/citas.php -> CRUD (JSON) para citas
- web/medicos.html -> UI para gestionar médicos
- web/pacientes.html -> UI para gestionar pacientes
- web/citas.html -> UI para gestionar citas

Instalación rápida (XAMPP):
1. Importa `db_citas_medicas.sql` en phpMyAdmin o ejecuta en MySQL.
2. Coloca esta carpeta en htdocs (ya está) y abre las páginas en el navegador:
   - http://localhost/DesarrolloWebAAS/Laboratorios/laboratorio4/ej/web/medicos.html
   - http://localhost/DesarrolloWebAAS/Laboratorios/laboratorio4/ej/web/pacientes.html
   - http://localhost/DesarrolloWebAAS/Laboratorios/laboratorio4/ej/web/citas.html

Notas:
- Las APIs devuelven/esperan JSON; las páginas usan fetch() para llamadas asíncronas.
- Está pensado como base didáctica. Ajusta credenciales en `conexion.php` si es necesario.
