FROM mysql:5.6.36

COPY ./.assets/*.sql /docker-entrypoint-initdb.d/
