<?php

  $routes->get('/', function() {
    HelloWorldController::index();
  });

  $routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
  });
  
    $routes->get('/lista', function() {
    HelloWorldController::lista();
    });
    
    $routes->get('/lista/:id', function($id){
        AanestysController::nayta($id);
    });
    
    $routes->get('/muokkaa', function() {
      HelloWorldController::muokkaa();
    });

    
    $routes->post('/aanestys', function(){
      HelloWorldController::aanestys();
    });
    
    $routes->get('/uusi', function(){
      HelloWorldController::uusi();
    });  
