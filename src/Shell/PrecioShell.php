<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link      http://cakephp.org CakePHP(tm) Project
 * @since     3.0.0
 * @license   http://www.opensource.org/licenses/mit-license.php MIT License 
 */
namespace App\Shell;

use Cake\Console\Shell;
use Cake\Utility\Xml;

class PrecioShell extends Shell
{
    public function initialize()
    {
        parent::initialize();
        $this->loadModel('Productos');
        $this->loadModel('Precios');
        $this->loadModel('Enviotarifas');
        $this->loadModel('Imagenes'); 
        $this->loadModel('Marcas'); 
        $this->loadModel('CategoriasProductos'); 
    }


    public function main()
    {
        
      


        $existente = 0;
        $nuevo = 0;
        $cambio_publicacion = 0;

 $productos = $this->Productos->find('all',['conditions'=>['Productos.proveedor_id != 19 and Productos.proveedor_id != 2']]);


foreach($productos as $producto){



                
                    $cubicaje = ($producto->largo / 100) * ($producto->ancho / 100) * ($producto->alto / 100);
$costo_envio=0;

     if($producto->envio_gratis == true){
            if($producto->envio>0){

                $costo_envio =$producto->envio;
            }else{

                $distancia_media = 1300; //Kilómetros
        
                $tarifa_peso = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                    $producto->peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                                    
                                
                $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                    'cubicaje >=' => $cubicaje),
                    'order' => 'cubicaje ASC'))->first();
                            
                if(is_null($tarifa_peso)){
                    $tarifa_peso->precio=0;
                }
                if(is_null($tarifa_cubicaje)){
                    $tarifa_cubicaje->precio=0;
                }
        
                if($tarifa_peso->tarifa == 7){
                    $tarifa_peso->precio =  $peso * $tarifa_peso->precio_kilo; 
                }

                if($tarifa_cubicaje->tarifa == 7){
                    $tarifa_cubicaje->precio =  $cubicaje * $tarifa_cubicaje->precio; 
                }



                if($tarifa_peso->precio > $tarifa_cubicaje->precio)
                {
                    $costo_envio = $tarifa_peso->precio;
                }else{
                    $costo_envio = $tarifa_cubicaje->precio;
                }
            }
        }else{

                $costo_envio = 0;

        }

        
      

         $costo_tarjeta = $producto->precio * .04;
    
$total_costo = $producto->precio;
$total_costo = $total_costo  - $costo_tarjeta;
$total_costo  = $total_costo  - $costo_envio;
$total_costo  = $total_costo /1.16;


          //  $producto->total_de_costos = (($producto->costo*1.16) + $costo_envio + $costo_tarjeta);
            $producto->margen = (($total_costo  - $producto->costo)/$producto->costo)*100;



            echo "codigo: ".$producto->codigo_fabricante."\n";
            echo "vendor: ".$producto->costo."\n";
            echo "costo envio: ".$costo_envio."\n";
            echo "costo pago: ".$costo_tarjeta."\n";
            echo "Total de Costos: ".$producto->total_de_costos."\n";
            echo "margen: ".$producto->margen."\n";
            echo "precio: ".$producto->precio."\n\n";

            $this->Productos->save($producto);

              $registro_precio = $this->Precios->find('all', ['conditions' => ['Precios.producto_id'=>$producto->id, 'proveedor_id'=>$producto->proveedor_id]])->first();

              if($registro_precio){
            $registro_precio['margen'] = $producto->margen;
            //     $registro_precio['total_de_costos'] = $producto->total_de_costos;
                $registro_precio['modified'] = date('Y-m-d H:m:s');
            $this->Precios->save($registro_precio);
}


    }


} 







/*
    public function exp_to_dec($float_str)
    // formats a floating point number string in decimal notation, supports signed floats, also supports non-standard formatting e.g. 0.2e+2 for 20
    // e.g. '1.6E+6' to '1600000', '-4.566e-12' to '-0.000000000004566', '+34e+10' to '340000000000'
    // Author: Bob
    {
    // make sure its a standard php float string (i.e. change 0.2e+2 to 20)
    // php will automatically format floats decimally if they are within a certain range
        $float_str = (string)((float)($float_str));

    // if there is an E in the float string
        if(($pos = strpos(strtolower($float_str), 'e')) !== false)
        {
            // get either side of the E, e.g. 1.6E+6 => exp E+6, num 1.6
            $exp = substr($float_str, $pos+1);
            $num = substr($float_str, 0, $pos);
       
            // strip off num sign, if there is one, and leave it off if its + (not required)
            if((($num_sign = $num[0]) === '+') || ($num_sign === '-')) $num = substr($num, 1);
            else $num_sign = '';
            if($num_sign === '+') $num_sign = '';
       
            // strip off exponential sign ('+' or '-' as in 'E+6') if there is one, otherwise throw error, e.g. E+6 => '+'
            if((($exp_sign = $exp[0]) === '+') || ($exp_sign === '-')) $exp = substr($exp, 1);
            else trigger_error("Could not convert exponential notation to decimal notation: invalid float string '$float_str'", E_USER_ERROR);
       
            // get the number of decimal places to the right of the decimal point (or 0 if there is no dec point), e.g., 1.6 => 1
            $right_dec_places = (($dec_pos = strpos($num, '.')) === false) ? 0 : strlen(substr($num, $dec_pos+1));
            // get the number of decimal places to the left of the decimal point (or the length of the entire num if there is no dec point), e.g. 1.6 => 1
            $left_dec_places = ($dec_pos === false) ? strlen($num) : strlen(substr($num, 0, $dec_pos));
       
            // work out number of zeros from exp, exp sign and dec places, e.g. exp 6, exp sign +, dec places 1 => num zeros 5
            if($exp_sign === '+') $num_zeros = $exp - $right_dec_places;
            else $num_zeros = $exp - $left_dec_places;
       
            // build a string with $num_zeros zeros, e.g. '0' 5 times => '00000'
            $zeros = str_pad('', $num_zeros, '0');
       
            // strip decimal from num, e.g. 1.6 => 16
            if($dec_pos !== false) $num = str_replace('.', '', $num);
       
            // if positive exponent, return like 1600000
            if($exp_sign === '+') return $num_sign.$num.$zeros;
            // if negative exponent, return like 0.0000016
            else return $num_sign.'0.'.$zeros.$num;
        }
        // otherwise, assume already in decimal notation and return
        else return $float_str;
    }



    //$this->precios_proveedor($busqueda_producto['id'], 2, $busqueda_producto['costo'], $busqueda_producto['margen'], $busqueda_producto['precio'], $busqueda_producto['existencia'], $activo);

    public function precios_proveedor($producto_id, $proveedor_id, $costo, $margen, $precio, $existencia, $activo){

        if($activo == true){

            $this->Precios->updateAll(['activo' => false], ['producto_id' => $producto_id]); 

        }

        // CHECO SI EXISTE UN REGISTRO DE PRECIOS
        $registro_precio = $this->Precios->find('all', ['conditions' => ['Precios.producto_id'=>$producto_id, 'proveedor_id'=>$proveedor_id]])->first();

        if(!empty($registro_precio)){

            $registro_precio['costo'] = $costo;
            $registro_precio['margen'] = $margen;
            $registro_precio['precio'] = $precio;
            $registro_precio['existencia'] = $existencia;
            $registro_precio['activo'] = $activo;
            $registro_precio['modified'] = date('Y-m-d H:m:s');

            $this->Precios->save($registro_precio);

            echo "Precio Actualizado: ".$producto_id."\n";

        }else{

            $nuevo_registro_precio = $this->Precios->newEntity();
            $nuevo_registro_precio['producto_id'] = $producto_id;
            $nuevo_registro_precio['proveedor_id'] = $proveedor_id;
            $nuevo_registro_precio['usuario_id'] = 3;
            $nuevo_registro_precio['costo'] = $costo;
            $nuevo_registro_precio['margen'] = $margen;
            $nuevo_registro_precio['precio'] = $precio;
            $nuevo_registro_precio['existencia'] = $existencia;
            $nuevo_registro_precio['activo'] = $activo;
            $nuevo_registro_precio['created'] = date('Y-m-d H:m:s');
            $nuevo_registro_precio['modified'] = date('Y-m-d H:m:s');

            $this->Precios->save($nuevo_registro_precio);

            echo "Precio Nuevo: ".$producto_id."\n";

        }
        
    }


*/





}
