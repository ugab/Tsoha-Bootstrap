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
    
//    $routes->get('/aanestys', function(){
//      HelloWorldController::aanestys();
//    });
    
//    $routes->get('/uusi', function(){
//      AanestysController::uusi();
//    });  
