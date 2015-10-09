<?php

class EhdokasController extends BaseController{
  
  public static function uusiehdokas($id){
      
    $ehdokkaat = Ehdokas::all($id);  
    $aanestys = Aanestys::find($id);
    View::make('ehdokas/uusiehdokas.html', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
  }
//  array('message' => 'Peli on lisätty kirjastoosi!'))
  
  public static function store($id){
    // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
    $params = $_POST;

      $attributes = (array(
//        'id' => $params['id'],
        'nimi' => $params['nimi'],
        'kuvaus' => $params['kuvaus'],
        'aanestysid' => $params['aanestysid']
      ));

      

    $ehdokas = new Ehdokas($attributes);
    $errors = $ehdokas->errors();

      
    $aanestys = Aanestys::find($id);    
    
    
    if(count($errors) == 0){
      // Peli on validi, hyvä homma!
      $ehdokas->save();
      $ehdokkaat = Ehdokas::all($aanestys->id);
      Redirect::to('/uusi/' . $id . '/uusiehdokas', array('ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys));
    }else{
      // Pelissä oli jotain vikaa :(
      $ehdokkaat = Ehdokas::all($id);  
      View::make('ehdokas/uusiehdokas.html', array('errors' => $errors, 'ehdokkaat' => $ehdokkaat, 'aanestys' => $aanestys, 'attributes' => $attributes));
    }

  }
  
  
  public static function destroy($id){
    
    $ehdokas = new Ehdokas(array('id' => $id));

    $ehdokas->destroy($id);

    Redirect::to('/aanestys/:id/muokkaa', array('message' => 'Ehdokas on poistettu onnistuneesti!'));
  }      
  
}