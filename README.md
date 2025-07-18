# Turismo Santiago del Estero

Esta versión utiliza PHP y MySQL para cargar la información de los destinos, los recorridos y el planificador.

## Base de datos

Se incluye el script `schema.sql` con una base de datos de ejemplo. Para crearla ejecute:

```bash
mysql -u usuario -p < schema.sql
```

Actualice las credenciales de acceso en `Front-Turismo-SDE-master/db.php`.

## Dependencias

Para exportar el PDF se usa [Dompdf](https://github.com/dompdf/dompdf). Instálelo mediante Composer:

```bash
composer require dompdf/dompdf
```

## Uso

Abra `destinos.php`, `recorridos.php` o `planificador.php` desde su servidor web. El planificador permite seleccionar destinos, mostrarlos en el mapa y generar un PDF con el tiempo y costo total.
