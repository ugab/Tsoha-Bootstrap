#!/bin/bash

source config/environment.sh

echo "Luodaan tietokantataulut..."

ssh $USERNAME@users.cs.helsinki.fi "
cd htdocs/$PROJECT_FOLDER/sql
cat drop_tables.sql create_tables.sql | psql -1 -f -
exit"

echo "Valmis!"



CREATE TABLE Aanestys(
  nimi varchar(12) PRIMARY KEY,
  player_id INTEGER REFERENCES Player(id), -- Viiteavain Player-tauluun
  name varchar(50) NOT NULL,
  played boolean DEFAULT FALSE,
  description varchar(400),
  published DATE,
  publisher varchar(50),
  added DATE
);
