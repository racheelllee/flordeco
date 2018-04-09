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

class XMLProveedorShell extends Shell
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
          

        $this->xml_ingrams();
        $this->xml_cva();

    } // MAIN


  public function xml_cva()
    {

   //    file_put_contents("/var/www/html/admin/app/webroot/files/cva.xml", fopen("http://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=43785&dt=1&dc=1&depto=1&promos=1&porcentaje=0&sucursales=1&TipoCompra=1&tc=1", 'r'));


        $cvas = '/var/www/html/admin/app/webroot/files/cva.xml';
       // $cvas = '/Applications/MAMP/htdocs/admin_tienda/app/webroot/files/prueba_proveedorCVA.xml';
        $cvas = Xml::toArray(Xml::build($cvas));

        $existente = 0;
        $nuevo = 0;
        $cambio_publicacion = 0;

        // DESPUBLICO TODOS LOS PRODUCTOS
       # $this->Productos->updateAll(['estatus_id' => 0], ['proveedor_id' => 2]); 

        // 637 debug(count($cvas['items']['item'])); die();
        foreach( $cvas['articulos']['item'] as $cva ){ // Inicia FOREACH()

            $producto = $this->Productos->newEntity();                        

            $producto['nombre'] = $this->sentence_case($cva['descripcion']);
            $producto['sku'] = $cva['clave'];
            $producto['codigo_fabricante'] = $cva['codigo_fabricante'];
            $producto['descripcion_corta'] = $this->sentence_case($cva['ficha_comercial']);
            $producto['descripcion_larga'] = $this->sentence_case($cva['ficha_tecnica']);

            ////// $producto['marca_id']=$cva['marca'];

            ////// $categoria=$cva['categoria'];
        
          //  $producto['ficha_tecnica'] = $cva['ficha_tecnica'];

            //////$imagen=$cva['imagen_full'];
        
            //$producto['ancho'] = '';
            //$producto['alto'] = '';
            //$producto['peso'] = '';
            //$producto['largo'] = '';

            //$producto['peso_volumetrico'] = '';
            //$producto['modelo'] = '';
            //$producto['frase_push'] = '';
            $producto['url'] =  $this->slugify($producto['nombre']);
            //$producto['meta_titulo'] = '';
            //$producto['meta_descripcion'] = '';
            //$producto['meta_keywords'] = '';
            
            if($cva['moneda'] == 'Pesos'){
                $producto['costo'] = $cva['precio'];
            }else{
                $producto['costo'] = $cva['precio'] * $cva['tipocambio'];
            }
            

            //$producto['margen'] = '';
            //$producto['precio'] = '';
            //$producto['envio_gratis'] = '';
            $producto['garantia'] = $this->sentence_case($cva['garantia']);
            //$producto['tiempo_de_entrega'] = '';
            
            $producto['existencia'] = $cva['disponible'];


            $busqueda_producto = $this->Productos->find('all', ['conditions'=>['Productos.codigo_fabricante'=>$producto['codigo_fabricante']]])->first();
            
            if(!empty($busqueda_producto)){ // Producto Existente
                
                $existente++;

                // Si existe solo se actualizan datos

                // CALCULO NUEVO PRECIO 
                if($busqueda_producto['margen'] > 0){

                    $peso = $busqueda_producto['peso'];
                    $cubicaje = ($busqueda_producto['largo'] / 100) * ($busqueda_producto['ancho'] / 100) * ($busqueda_producto['alto'] / 100);
                    $nuevo_precio = $this->recalculaPrecio($producto['costo'], $busqueda_producto['envio_gratis'], $busqueda_producto['margen'], $peso, $cubicaje,$producto['envio']);

                }else{

                    $nuevo_precio = 0;

                }
                
                    $activo = false;
                    if($busqueda_producto['proveedor_id'] == 2){ // ACTUAL PROVEEDOR CVA

                        if ($producto['existencia'] <= 0) { // NUEVA EXISTENCIA 0

                            $cambio_publicacion++;

                            $busqueda_producto['estatus_id'] = 0;
                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = 0;
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto CVA actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;

                        }else{  // NUEVA EXISTENCIA > 0

                            if($nuevo_precio > 0){
                                $busqueda_producto['estatus_id'] = 1;
                            }

                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = $producto['existencia'];
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto CVA actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;
                        }

                    }else{ // PROVEEDOR ACTUAL NO ES CVA

                        if ($producto['existencia'] > 0 && $producto['costo'] > 0 && $producto['costo'] < $busqueda_producto['costo']) { // NUEVA EXISTENCIA > 1

                            if($nuevo_precio > 0){
                                $busqueda_producto['estatus_id'] = 1;
                            }

                            $busqueda_producto['proveedor_id'] = 2;
                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = $producto['existencia'];
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto CVA actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;
                        }

                    }

                    
                    $this->precios_proveedor($busqueda_producto['id'], 2, $producto['costo'], $busqueda_producto['margen'], $nuevo_precio, $producto['existencia'], $activo);


                /*
                if($busqueda_producto['estatus_id'] == 0){ // PRODUCTO NO PUBLICADO

                    if($busqueda_producto['margen'] > 0){ // TIENE MARGEN PARA CALCULAR PRECIO

                        if ($producto['existencia'] > 0) { // NUEVA EXISTENCIA > 0

                            $cambio_publicacion++;
                            $busqueda_producto['proveedor_id'] = 2;
                            $busqueda_producto['estatus_id'] = 1;
                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = $producto['existencia'];
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            
                            $this->precios_proveedor($busqueda_producto['id'], $busqueda_producto['proveedor_id'], $busqueda_producto['costo'], $busqueda_producto['margen'], $busqueda_producto['precio'], $busqueda_producto['existencia']);

                        }

                    }else{ // SI NO TIENE MARGEN NO CALCULA PRECIO

                        if($busqueda_producto['proveedor_id'] != 2){
                            if ($producto['existencia'] > 0 && $producto['costo'] < $busqueda_producto['costo']) { // NUEVA EXISTENCIA > 0

                                $busqueda_producto['proveedor_id'] = 2;
                                $busqueda_producto['costo'] = $producto['costo'];
                                $busqueda_producto['precio'] = 0;
                                $busqueda_producto['existencia'] = $producto['existencia'];
                                $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                                
                                $this->precios_proveedor($busqueda_producto['id'], $busqueda_producto['proveedor_id'], $busqueda_producto['costo'], $busqueda_producto['margen'], $busqueda_producto['precio'], $busqueda_producto['existencia']);

                            }
                        }else{

                                $busqueda_producto['costo'] = $producto['costo'];
                                $busqueda_producto['precio'] = 0;
                                $busqueda_producto['existencia'] = $producto['existencia'];
                                $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                        }

                    }

                } */

            }else{ // Producto Nuevo

                $nuevo++;

                $producto['estatus_id'] = 0;
                $producto['proveedor_id'] = 2;
                $producto['marca_id'] = $this->busca_marca($cva['marca']);
                $producto['modified'] = date("Y-m-d H:m:s");
                $nuevo_registro_producto = $this->Productos->save($producto);
                $this->categoria_producto(547, $nuevo_registro_producto->id);
                $this->precios_proveedor($nuevo_registro_producto->id, 2, $producto['costo'], 0, 0, $producto['existencia'], true);
                if($cva['imagen']){
                  $this->recibe_imagen($cva['imagen'], "/var/www/html/app/webroot/img/productos/original/".md5($nuevo_registro_producto->id).".jpg", $nuevo_registro_producto->id, md5($nuevo_registro_producto->id).".jpg"); 
                }
                echo "Producto CVA nuevo: ".$producto['codigo_fabricante']."\n";
            }
            
        } // Finaliza FOREACH()

    } /// Finaliza Function xml_cva






    public function xml_ingrams()
    {

      //   file_put_contents("/var/www/html/admin/app/webroot/files/ingram.xml", fopen("http://tiendasvirtuales.im/rednovo/inventario.php?usuario=storefront0468&password=nOv12vk1M", 'r'));

        $ingrams = '/var/www/html/admin/app/webroot/files/ingram.xml';
        //$ingrams = '/Applications/MAMP/htdocs/admin_tienda/app/webroot/files/prueba_proveedor.xml';
        $ingrams = Xml::toArray(Xml::build($ingrams));

        $existente = 0;
        $nuevo = 0;
        $cambio_publicacion = 0;

        // DESPUBLICO TODOS LOS PRODUCTOS
       # $this->Productos->updateAll(['estatus_id' => 0], ['proveedor_id' => 19]); 

        // 637 debug(count($ingrams['items']['item'])); die();
        foreach( $ingrams['items']['item'] as $ingram ){ // Inicia FOREACH()

            $producto = $this->Productos->newEntity();

            $sku = $ingram['sku'];
            $sku = utf8_decode('0'.$sku); 
            //Esto es para eliminar los '0' si es que la clave viene con uno al inicio y diferenciar si es letra y diferente de '0'
            $patron = "/[[:alpha:]]/";
            $no_soy_letra = preg_match($patron,$sku[0]);
            if($no_soy_letra == 0){
                            if($sku[0] == 0){
                                //echo " CLAVE ORIGINAL ". $sku ."  ";                 
                                $sku = substr($sku, 1);
                                //echo "RECORTADO ".$sku. "  ";
                            }
                            else{
                                //echo "SOY DIFERENTE DE CERO, PERO SOY NUMERO NO LETRA";
                            }
            } else{
                                //echo " NO SOY CERO INICIAL Y SOY LETRA  ".$sku[0].'  ';
            }
            if(is_numeric($sku)){
                $sku = $this->exp_to_dec($sku);
                            //echo '  NUMERICO '.$sku;
            } else {
                            //echo '   NO NUMERICO '.$sku;
            }                           

            $producto['nombre'] = $this->sentence_case($ingram['descripcion_corta']);
            $producto['sku'] = $sku;
            $producto['codigo_fabricante'] = $ingram['codigo_fabricante'];
           // $producto['descripcion_corta'] = $ingram['descripcion_corta'];
            $producto['descripcion_larga'] = $this->sentence_case($ingram['descripcion_larga']);

            ////// $producto['marca_id']=$ingram['marca'];

            ////// $categoria=$ingram['categoria'];
        
            $producto['ficha_tecnica'] = $this->sentence_case($ingram['ficha_tecnica']);

            //////$imagen=$ingram['imagen_full'];
        
            $producto['ancho'] = $ingram['width'];
            $producto['alto'] = $ingram['height'];
            $producto['peso'] = $ingram['weight'];
            $producto['largo'] = $ingram['length'];

            if(!$producto['ancho']){$producto['ancho']=0;}
            if(!$producto['alto']){$producto['alto']=0;}
            if(!$producto['peso']){$producto['peso']=0;}
            if(!$producto['largo']){$producto['largo']=0;}


            //$producto['peso_volumetrico'] = '';
            //$producto['modelo'] = '';
            //$producto['frase_push'] = '';
             $producto['url'] =  $this->slugify($producto['nombre']);
            //$producto['meta_titulo'] = '';
            //$producto['meta_descripcion'] = '';
            //$producto['meta_keywords'] = '';
            
            $producto['costo'] = $ingram['precio'];

            //$producto['margen'] = '';
            //$producto['precio'] = '';
            //$producto['envio_gratis'] = '';
            //$producto['garantia'] = '';
            //$producto['tiempo_de_entrega'] = '';
            
            $centro_distribucion = $ingram['stock_tijuana'] + $ingram['stock_queretaro'] + $ingram['stock_leon'] + $ingram['stock_merida'] + $ingram['stock_puebla'];
            $producto['existencia'] = $ingram['stock_mexico'] + $ingram['stock_monterrey'] + $ingram['stock_guadalajara'] + $centro_distribucion;


            $busqueda_producto = $this->Productos->find('all', ['conditions'=>['Productos.codigo_fabricante'=>$producto['codigo_fabricante']]])->first();
            
            if(!empty($busqueda_producto)){ // Producto Existente
                
                $existente++;

                // Si existe solo se actualizan datos

                // CALCULO NUEVO PRECIO 
                if($busqueda_producto['margen'] > 0){

                    $peso = $busqueda_producto['peso'];
                    $cubicaje = ($busqueda_producto['largo'] / 100) * ($busqueda_producto['ancho'] / 100) * ($busqueda_producto['alto'] / 100);
                    $nuevo_precio = $this->recalculaPrecio($producto['costo'], $busqueda_producto['envio_gratis'], $busqueda_producto['margen'], $peso, $cubicaje,$producto['envio']);

                }else{

                    $nuevo_precio = 0;

                }
                
                    $activo = false;
                    if($busqueda_producto['proveedor_id'] == 19){ // ACTUAL PROVEEDOR INGRAM

                        if ($producto['existencia'] <= 0) { // NUEVA EXISTENCIA 0

                            $cambio_publicacion++;

                            $busqueda_producto['estatus_id'] = 0;
                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = 0;
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto INGRAM actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;

                        }else{  // NUEVA EXISTENCIA > 0

                            if($nuevo_precio > 0){
                                $busqueda_producto['estatus_id'] = 1;
                            }

                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = $producto['existencia'];
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto INGRAM actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;
                        }

                    }else{ // PROVEEDOR ACTUAL NO ES INGRAM

                        if ($producto['existencia'] > 0 && $producto['costo'] > 0 && $producto['costo'] < $busqueda_producto['costo']) { // NUEVA EXISTENCIA > 1

                            if($nuevo_precio > 0){
                                $busqueda_producto['estatus_id'] = 1;
                            }

                            $busqueda_producto['proveedor_id'] = 19;
                            $busqueda_producto['costo'] = $producto['costo'];
                            $busqueda_producto['precio'] = $nuevo_precio;
                            $busqueda_producto['existencia'] = $producto['existencia'];
                            $busqueda_producto['modified'] = date("Y-m-d H:m:s");

                            $this->Productos->save($busqueda_producto);
                            echo "Producto INGRAM actualizado: ".$busqueda_producto['codigo_fabricante']."\n";

                            $activo = true;
                        }

                    }

                    
                    $this->precios_proveedor($busqueda_producto['id'], 19, $producto['costo'], $busqueda_producto['margen'], $nuevo_precio, $producto['existencia'], $activo);


            }else{ // Producto Nuevo

                $nuevo++;
                $producto['estatus_id'] = 0;
               $producto['proveedor_id'] = 19;
               $producto['marca_id'] = $this->busca_marca($ingram['marca']);
               $producto['modified'] = date("Y-m-d H:m:s");
               $nuevo_registro_producto = $this->Productos->save($producto);
               $this->categoria_producto(546, $nuevo_registro_producto->id);
               $this->precios_proveedor($nuevo_registro_producto->id, 2, $producto['costo'], 0, 0, $producto['existencia'], true);
               if($ingram['imagen_full']){
                   $this->recibe_imagen($ingram['imagen_full'], "/var/www/html/app/webroot/img/productos/original/".md5($nuevo_registro_producto->id).".jpg", $nuevo_registro_producto->id, md5($nuevo_registro_producto->id).".jpg"); 
               }
                echo "Producto INGRAM nuevo: ".$producto['codigo_fabricante']."\n";


               
            }
            
        } // Finaliza FOREACH()

    } /// Finaliza Function xml_ingrams

    public function categoria_producto($categoria_id, $producto_id){
        $nuevo = $this->CategoriasProductos->newEntity();
        $nuevo['categoria_id'] = $categoria_id;
        $nuevo['producto_id'] = $producto_id;
        $this->CategoriasProductos->save($nuevo);
    }

    public function busca_marca($marca){

        $busqueda = $this->Marcas->find('all', ['conditions' => ['Marcas.nombre'=>$marca]])->first();

        if(!empty($busqueda)){

            return $busqueda->id;

        }else{

            $nuevo_registro_marca = $this->Marcas->newEntity();
            $nuevo_registro_marca['nombre'] = $marca;
        

            $nueva_marca = $this->Marcas->save($nuevo_registro_marca);

            echo "Nueva Marca: ".$marca."\n";

            return $nueva_marca->id;

        }

    }

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



    public function recalculaPrecio($vendor, $envio, $margen, $peso, $cubicaje,$envio_fijo){


        if($envio == true){
            if($envio_fijo>0){

                $costo_envio =$envio_fijo;
            }else{

                $distancia_media = 1300; //Kilómetros
        
                $tarifa_peso = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                    $peso.' BETWEEN peso_inicio AND peso_fin')))->first();
                                    
                                
                $tarifa_cubicaje = $this->Enviotarifas->find('all', array(
                    'conditions'=>array($distancia_media.' BETWEEN distancia_inicio AND distancia_fin', 
                    'cubicaje >=' => $cubicaje),
                    'order' => 'cubicaje ASC'))->first();
                            

                    if($tarifa_peso['tarifa'] == 7){
                       $tarifa_peso['precio'] =  $peso * $tarifa_peso['precio_kilo']; 
                    }
        
                    if($tarifa_cubicaje['tarifa'] == 7){
                       $tarifa_cubicaje['precio'] =  $cubicaje * $tarifa_cubicaje['precio']; 
                    }
        

                if(is_null($tarifa_peso)){
                    $tarifa_peso->precio=0;
                }
                if(is_null($tarifa_cubicaje)){
                    $tarifa_cubicaje->precio=0;
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


        $margen = ($vendor * ($margen/100));
        $suma = $margen + $vendor;
        $iva = $suma *0.16;
        $suma= $suma + $iva + $costo_envio;
        $costo_pago = ($suma/96)*4;
       // $total_costo= $suma + $costo+ $costo_pago -$margen;
        $nuevo_precio = $suma + $costo_pago;


        //$costo_tarjeta = (($vendor + $costo_envio) + (($vendor + $costo_envio) * ($margen / 100))) * .04;
        //$nuevo_precio = (($vendor + $costo_envio + $costo_tarjeta) + (($vendor + $costo_envio + $costo_tarjeta) * ($margen / 100)));

        return $nuevo_precio;

    }




    public function recibe_imagen($url_origen, $archivo_destino, $producto_id, $nombre) { 
        
        $nueva_imagen = $this->Imagenes->newEntity();   
        $nueva_imagen['producto_id'] = $producto_id;
        $nueva_imagen['nombre'] = $nombre;

        $mi_curl = curl_init ($url_origen); 
        $fs_archivo = fopen ($archivo_destino, "w"); 
        curl_setopt ($mi_curl, CURLOPT_FILE, $fs_archivo); 
        curl_setopt ($mi_curl, CURLOPT_HEADER, 0); 
        curl_exec ($mi_curl); 
        curl_close ($mi_curl); 
        fclose ($fs_archivo); 

        $this->Imagenes->save($nueva_imagen);

        echo "Imagen Nueva: ".$producto_id."\n";
    } 

  
 public function slugify($text){ 
 // replace non letter or digits by -
 $text = preg_replace('~[^\\pL\d]+~u', '-', $text);

 // trim
 $text = trim($text, '-');

 // transliterate
 $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

 // lowercase
 $text = strtolower($text);

 // remove unwanted characters
 $text = preg_replace('~[^-\w]+~', '', $text);

 if (empty($text))
 {
   return 'n-a';
 }

 return $text;
}

function sentence_case($string) { 
    $sentences = preg_split('/([.?!]+)/', $string, -1, PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE); 
    $new_string = ''; 
    foreach ($sentences as $key => $sentence) { 
        $new_string .= ($key & 1) == 0? 
            ucfirst(strtolower(trim($sentence))) : 
            $sentence.' '; 
    } 
    return trim($new_string); 
} 




}
