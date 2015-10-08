    -- Kayttaja-taulun testidata
    INSERT INTO Kayttaja (nimi, salasana) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
    INSERT INTO Kayttaja (nimi, salasana) VALUES ('Henri', 'Henri123');

    -- Aanestys taulun testidata
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('onko Skyrim', '2011-11-11', '2012-11-11', 'Arrow to the knee', 'true', '1');
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('what what', '2011-11-11', '2012-11-11', 'butters', 'true', '2');
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('in the butt', '2011-11-11', '2012-11-11', 'south park', 'true', '3');
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('u wanna do it', '2011-11-11', '2012-11-11', 'joku juutube video', 'true', '4');
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('in the butt', '2011-11-11', '2012-11-11', 'Arrow to the knee', 'false', '5');

    -- Ehdokas-taulun testidata
    INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES ('tupu', 'punainen', '1'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
    INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES ('lupu', 'vihree', '1');
    INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES ('hupu', 'sininen', '1');
    INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES ('laaalaaa', 'wut', '1');
    INSERT INTO Ehdokas (nimi, kuvaus, aanestysid) VALUES ('juntti', 'urpo', '1');