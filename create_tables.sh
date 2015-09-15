#!/bin/bash

source config/environment.sh

echo "Luodaan tietokantataulut..."

ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs/$PROJECT_FOLDER/sql
cat drop_tables.sql create_tables.sql | psql -1 -f -
exit"

echo "Valmis!"



CREATE TABLE Aanestys(
    id SERIAL PRIMARY KEY,
    nimi varchar(12) NOT NULL,
    aanestysalkaa Date,
    aanestysaoppuu Date,
    kuvaus varchar (400),
    onkoid boolean DEFAULT FALSE,
#    luojaid SERIAL,

);
