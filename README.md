Este repositorio arrancó como una copia de DemocraciaEnRed/causascomunes-presion-backend [8c94980](https://github.com/DemocraciaEnRed/causascomunes-presion-backend/tree/8c9498000cb3e4e1e55e62e34584e8a4fb1a2e67)

# Somos Muchas

para iniciar rápidamente:
`docker-compose up`

o si doker está apagado:
`systemctl start docker.service && docker-compose up`

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

Carpetas que hay que persistir/volumizar:

- `webroot/img` (ahi es donde se suben las imagenes)


## Bugs detectados
- En la carga de imágenes a veces tira error con los jpg/jpeg. La solución es convertilas a png y subirla. En linux esto se realiza fácilmente con la utilidad `convert` que viene al instalar `imagemagick` (en Debians `sudo apt install imagemagick`)
