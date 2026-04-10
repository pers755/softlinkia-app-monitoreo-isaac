# Softlinkia - Sistema de Monitoreo de Dispositivos

Sistema integral para la supervisión técnica y gestión de incidencias en tiempo real de infraestructura de red y dispositivos .

##  Acceso al Sistema
El sistema se encuentra desplegado y funcional en la siguiente URL:
**[http://srv1568602.hstgr.cloud](http://srv1568602.hstgr.cloud)**

---

##  Credenciales de Acceso
Para facilitar la evaluación, se han precargado los siguientes perfiles de prueba:

| Rol | Correo Electrónico | Contraseña |
| :--- | :--- | :--- |
| **Administrador** | `admin@softlinkia.com` | `password123` |
| **Operador** | `operador@softlinkia.com` | `password123` |
| **Cliente Demo** | `demo@test.com` | `password123` |

---

##  Stack Tecnológico
* **Backend:** Laravel 11 (PHP 8.2+)
* **Frontend:** Tailwind CSS & Blade Components
* **Base de Datos:** MySQL
* **Herramientas:** Vite, Composer, NPM

---

##  Supuestos

Al desarrollar la prueba, se asumieron las siguientes premisas:
1.  **Unicidad de Roles:** Un usuario solo puede tener un rol asignado a la vez para simplificar la lógica de permisos en esta versión.
2.  **Persistencia de Fallas:** Se asume que una "Falla" simulada requiere una intervención manual posterior, por lo que el estado se mantiene en la base de datos hasta que un Admin/Operador lo resuelva.
3.  **Ambiente de Producción:** Se asumió que el evaluador requiere una URL funcional, por lo que se realizó el despliegue en un servidor KVM real.

## Instalación Local
Si desea ejecutar el proyecto localmente, siga estos pasos:

1.  **Clonar:** `git clone <url-del-repositorio>`
2.  **Dependencias PHP:** `composer install`
3.  **Dependencias JS:** `npm install`
4.  **Compilar Assets:** `npm run build` (Necesario para visualizar los estilos correctamente)
5.  **Entorno:** Configurar archivo `.env` con sus credenciales de base de datos.
6.  **Migrar y Seed:** `php artisan migrate --seed` (Crea las tablas y los usuarios de prueba)
7.  **Servidor:** `php artisan serve`
---

## 📋 Documentación de la API
El sistema expone los siguientes endpoints para integración externa:

### Dispositivos
* `POST /api/v1/device-event`: Crea una incidencia que se muestra en dashboard en tiempo real.

Url: http://srv1568602.hstgr.cloud/api/v1/device-event

### Configuración de Headers
Para todas las peticiones POST, asegúrese de incluir los siguientes encabezados:
- `Content-Type: application/json`
- `Accept: application/json`

### Ejemplo de Body para POST /api/v1/device-event
**Tipo de datos:** JSON (Raw)
**Cuerpo:**
{
    "device_id": 1,
    "type": "desconexion"
}
---

##  Características Implementadas

### **Gestión y Seguridad**
* **Gestión de Roles (RBAC):** Restricción de acceso mediante un Middleware personalizado que valida permisos para Administradores, Operadores y Clientes.
* **Inicio de Sesión:** Módulo de autenticación seguro para el control de acceso a la infraestructura.
* **Gestión Integral (CRUD):** Administración completa Dispositivos.

### **Monitoreo y Operatividad**
* **Dashboard en Tiempo Real:** Panel de control visual con indicadores de salud de sistema.
* **Simulación de Fallas:** Botón operativo para forzar estados de error, permitiendo validar la respuesta del sistema de alertas y bitácoras.
* **Expediente de Dispositivo:** Vista de detalle que centraliza la información del cliente, el estado del sistema y el historial de incidencias.

### **Auditoría y Trazabilidad**
* **Bitácora de Auditoría (Audit Log):** Registro automático de acciones críticas: inicios de sesión, cambios de estado en equipos y creación de registros.
* **Listado de Incidencias:** Reporte histórico de anomalías detectadas para el análisis de mantenimiento preventivo.