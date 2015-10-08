CREATE TABLE Aanestys(
    id SERIAL PRIMARY KEY,
    nimi varchar(50) NOT NULL,
    aanestysalkaa Date,
    aanestysloppuu Date,
    kuvaus varchar (400),
    onkoid boolean DEFAULT FALSE,
    luojaid INTEGER

);

CREATE TABLE Kayttaja(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  salasana varchar(50) NOT NULL
);

CREATE TABLE Ehdokas(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  nimi varchar(50) NOT NULL, -- Muista erottaa sarakkeiden määrittelyt pilkulla!  player_id INTEGER REFERENCES Player(id),
  kuvaus varchar(50),
  aania INTEGER,
  aanestysid INTEGER REFERENCES Aanestys(id)
);

CREATE TABLE Aanet(
  id SERIAL PRIMARY KEY, -- SERIAL tyyppinen pääavain pitää huolen, että tauluun lisätyllä rivillä on aina uniikki pääavain. Kätevää!
  aanestajaid INTEGER REFERENCES Kayttaja(id), -- Muista erottaa sarakkeiden määrittelyt pilkulla!
  aanestysid INTEGER REFERENCES Aanestys(id)
);