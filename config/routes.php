<?php

  $routes->get('/', function() {
    AanestysController::lista();
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
        
    $routes->get('/:id', function($id){
        AanestysController::nayta($id);
    });
    
    $routes->get('/muokkaa', function() {
      HelloWorldController::muokkaa();
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
    
    $routes->get('/kirjaudu', function(){
      // Kirjautumislomakkeen esittäminen
      UserController::login();
    });
    
    $routes->post('/kirjaudu', function(){
      // Kirjautumisen käsittely
      UserController::handle_login();
    });    
