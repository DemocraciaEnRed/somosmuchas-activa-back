# Causas Comunes

## Backend

Definir las siguientes como variables de entorno:

```
- SECURITY_SALT=ashjg23697sds97139871298ashk
- MYSQL_URL=mysql
- MYSQL_PORT=3306
- MYSQL_USERNAME=root
- MYSQL_PASSWORD=root
- MYSQL_DATABASE=causascomunes
```

Carpetas que habira que persistir:

- `webroot/img` (ahi es donde se suben las imagenes)


## Bugs detectados
- En la carga de imágenes a veces tira error con los jpg/jpeg. La solución es convertilas a png y subirla. En linux esto se realiza fácilmente con la utilidad `convert` que viene al instalar `imagemagick` (en Debians `sudo apt install imagemagick`)
