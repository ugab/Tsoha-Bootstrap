<?php

    $routes->get('/', function() {
      AanestysController::lista();
    });

    $routes->get('/omalista', function() {
      AanestysController::omalista();
    });  

    $routes->get('/hiekkalaatikko', function() {
      HelloWorldController::sandbox();
    });
  
//    $routes->get('/lista', function() {
//    AanestysController::lista();
//    });

    $routes->post('/aanestys', function(){
      AanestysController::store();
    });
    
    // Pelin lisäyslomakkeen näyttäminen
    $routes->get('/uusi', function(){
      AanestysController::uusi();
    });    

    $routes->get('/uusi/:id/uusiehdokas', function($id){
      EhdokasController::uusiehdokas($id);
    });        
    
    $routes->post('/uusi/:id/uusiehdokas/tallenna', function($id){
      EhdokasController::store($id);
    });    
    
    $routes->get('/aanestys/:id/muokkaa', function($id){
      // Pelin muokkauslomakkeen esittäminen
      AanestysController::edit($id);
    });
    
    $routes->post('/aanestys/:id/muokkaa', function($id){
      // Pelin muokkaaminen
      AanestysController::update($id);
    });

    $routes->post('/aanestys/:id/poista', function($id){
      // Pelin poisto
      AanestysController::destroy($id);
    });

    $routes->post('/uloskirjautuminen', function(){
      // Kirjautumislomakkeen esittäminen
      KayttajaController::uloskirjautuminen();
    });    
    
    $routes->get('/kirjaudu', function(){
      // Kirjautumislomakkeen esittäminen
      KayttajaController::kirjaudu();
    });
    
    $routes->post('/kirjaudu', function(){
      // Kirjautumisen käsittely
      KayttajaController::kasittele_kirjautuminen();
    });    

    $routes->get('/rekisteroidy', function(){
      KayttajaController::rekisteroidy();
    });    

    $routes->post('/rekisteroidy', function(){
      // Kirjautumisen käsittely
      KayttajaController::store();
    });

    $routes->get('/omalista/:id', function($id){
        AanestysController::naytaomaaanestys($id);
    });
    
    $routes->get('/:id', function($id){
        AanestysController::nayta($id);
    });
    
    $routes->post('/aanesta', function(){
      // Aanen antaminen
      AaniController::aani();
    });