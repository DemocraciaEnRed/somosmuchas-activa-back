FROM mysql:5.6.36

COPY ./.assets/causascomunes.sql /docker-entrypoint-initdb.d/
