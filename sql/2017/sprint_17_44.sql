/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 * Author:  Carlos Be Peraza
 * Created: 7/11/2017
 */

CREATE TABLE `pedido_cobro_extras` (
	`id` INT(11) NOT NULL AUTO_INCREMENT,
	`monto` DECIMAL(10,2) NOT NULL DEFAULT '0.00',
	`comentario` VARCHAR(255) NOT NULL DEFAULT '0',
	`no_tarjeta` VARCHAR(255) NOT NULL DEFAULT '0',
	`respuesta_pago` VARCHAR(255) NOT NULL DEFAULT '0',
	`nombre_completo` VARCHAR(255) NOT NULL DEFAULT '0',
	`pedido_id` INT(11) NOT NULL DEFAULT '0',
	`created` DATETIME NULL DEFAULT NULL,
	`usuario_id` INT(11) NULL DEFAULT NULL,
	PRIMARY KEY (`id`)
)
COLLATE='latin1_swedish_ci'
ENGINE=InnoDB
;
