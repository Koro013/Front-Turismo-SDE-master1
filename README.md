# Turismo Santiago del Estero

Este proyecto contiene una pequeña aplicaci\u00f3n de ejemplo que usa PHP y MySQL para mostrar informaci\u00f3n tur\u00edstica.

## Base de datos

Se incluye el archivo `turismo.sql` con la estructura y algunos datos de ejemplo. Para crear la base de datos ejecute en su servidor MySQL:

```bash
mysql -u usuario -p < turismo.sql
```

Luego actualice las credenciales en `Front-Turismo-SDE-master/db.php`.

## Dependencias

Para generar el PDF se usa [Dompdf](https://github.com/dompdf/dompdf). Inst\u00e1lelo mediante Composer:

```bash
composer require dompdf/dompdf
```

## Uso

Abra `index.html` en su navegador y seleccione la tarjeta **Planificador**. Los datos se cargar\u00e1n desde la base de datos y podr\u00e1 exportarlos a PDF.

