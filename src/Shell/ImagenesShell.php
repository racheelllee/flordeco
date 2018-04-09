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

class ImagenesShell extends Shell
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
        

        $this->xml_cva();

    } // MAIN


  public function xml_cva()
    {
       #  file_put_contents("/var/www/html/admin/app/webroot/files/cva.xml", fopen("http://www.grupocva.com/catalogo_clientes_xml/lista_precios.xml?cliente=43785&dt=1&dc=1&depto=1&promos=1&porcentaje=0&sucursales=1&TipoCompra=1&tc=1", 'r'));

        $cvas = '/var/www/html/admin/app/webroot/files/cva.xml';
  
        $cvas = Xml::toArray(Xml::build($cvas));

        $existente = 0;
        $nuevo = 0;
        $cambio_publicacion = 0;

       
        // 637 debug(count($cvas['items']['item'])); die();
        foreach( $cvas['articulos']['item'] as $cva ){ // Inicia FOREACH()
        if($cva['imagen']){
            $producto = $this->Productos->newEntity();                        
            $producto['codigo_fabricante'] = $cva['codigo_fabricante'];
          
            $busqueda_producto = $this->Productos->find('all', ['contain'=>'Imagenes','conditions'=>['Productos.codigo_fabricante'=>$producto['codigo_fabricante']]])->first();
            
            if(!empty($busqueda_producto)){ // Producto Existente
              
                   foreach($busqueda_producto->imagenes as $imagen){
                        $filename= "/var/www/html/app/webroot/img/productos/original/".$imagen->nombre;

                        if(filesize($filename) < 1){
                            echo $filename;
                   
                            $this->recibe_imagen($cva['imagen'], "/var/www/html/app/webroot/img/productos/original/$imagen->nombre", $imagen->id, $imagen->nombre); 
                        
                            echo "Producto con imagen en 0 : ".$busqueda_producto->codigo_fabricante."\n";
                        }
                }        

            }else{ // Producto Nuevo


            


            
              

            }

    }

            
        } // Finaliza FOREACH()

    } /// Finaliza Function xml_cva









    public function recibe_imagen($url_origen, $archivo_destino, $imagen_id, $nombre) { 
        
        $nueva_imagen = $this->Imagenes->newEntity();   
        $nueva_imagen['id'] = $imagen_id;
        $nueva_imagen['nombre'] = $nombre;

        $mi_curl = curl_init ($url_origen); 
        $fs_archivo = fopen ($archivo_destino, "w"); 
        curl_setopt ($mi_curl, CURLOPT_FILE, $fs_archivo); 
        curl_setopt ($mi_curl, CURLOPT_HEADER, 0); 
        curl_exec ($mi_curl); 
        curl_close ($mi_curl); 
        fclose ($fs_archivo); 

        $this->Imagenes->save($nueva_imagen);
        echo "original: ".$url_origen."\n";
        echo "destino: ".$archivo_destino."\n";

        echo "Imagen Nueva: ".$imagen_id."\n";
    } 

  




}
