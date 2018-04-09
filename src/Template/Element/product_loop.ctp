<?php if (isset($productos) && !empty($productos)): ?>
	
	<?php

		$dataP1 = [];
        $dataP2 = [];

        $producto = [];
        
        foreach ($productos as $key => $value) { $producto[] = $value; }

        $numberProducto = sizeof( $productos );

        $count = 1;

        for ($i=1; $i <= $numberProducto; $i++) { 
            
            foreach ($bannerRow as $x => $row) {
                
                if($row['posicion'][0] == $count ){
                    $dataP1 = $row;
                    $count++;
                }
            }

            if( isset($dataP1) && !empty($dataP1)){
                array_push($dataP2, $dataP1);
                array_push($dataP2, $producto[$i-1]);
            }else{
                array_push($dataP2, $producto[$i-1]);
            }
            $dataP1 = [];
            $count++;
        }

	?>

    <?php foreach ($dataP2 as $key => $row): ?>
        <?= $this->element('Productos/producto', compact('row')) ?>
    <?php endforeach ?>
<?php endif ?>