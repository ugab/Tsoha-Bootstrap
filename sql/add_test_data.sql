    -- Kayttaja-taulun testidata
    INSERT INTO Kayttaja (nimi, salasana) VALUES ('Kalle', 'Kalle123'); -- Koska id-sarakkeen tietotyyppi on SERIAL, se asetetaan automaattisesti
    INSERT INTO Kayttaja (nimi, salasana) VALUES ('Henri', 'Henri123');
    -- Aanestys taulun testidata
    INSERT INTO Aanestys (nimi, aanestysalkaa, aanestysloppuu, kuvaus, onkoid, luojaid) VALUES ('onko Skyrim', '2011-11-11', '2012-11-11', 'Arrow to the knee', 'true', '1');