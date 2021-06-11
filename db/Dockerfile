FROM mariadb
LABEL author="parcial"
ENV MYSQL_ROOT_PASSWORD "parcial"

ENV MYSQL_DATABASE "parcial"

ENV MYSQL_USER "servidores"

ENV MYSQL_PASSWORD "parcial"

COPY ./db/parcial.sql /docker-entrypoint-initdb.d/

EXPOSE 3306
