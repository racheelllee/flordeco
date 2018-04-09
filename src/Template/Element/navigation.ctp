<?php
    use Cake\Utility\Inflector;
    $actionUrl      = Inflector::camelize($this->request['controller']).'/'.$this->request['action'];
    $activeClass    = 'active-menu';
    $inactiveClass  = '';
    $usuario        = $this->UserAuth->getUser();
    $class          = '';

    $sections = [
        'Users'         => ['action' => 'index', 'plugin' => 'Usermgmt'],
        'Offices'       => ['action' => 'index', 'plugin' => false],
        'Customers'     => ['action' => 'index', 'plugin' => 'Customers'],
        'Cotizaciones'  => ['action' => 'index', 'plugin' => false],
        'Cargos'        => ['action' => 'index', 'plugin' => false]
    ];

    if($this->UserAuth->isLogged()) {

        foreach ($sections as $section => $config) {
            if ($this->UserAuth->HP($section, $config['action'], $config['plugin'])) {
                $class = $actionUrl == "{$section}/{$config['action']}" ? $activeClass : $inactiveClass;
                $href = $this->Html->link(__($section), [
                    'controller'=>$section, 
                    'action'=>$config['action'], 
                    'plugin'=>$config['plugin']
                ]);
                echo "<li class='nav-item $class'>$href</li>";
            }
        }                    

        if($this->UserAuth->HP('Cotizaciones', 'reporte')){
            echo "<li class='nav-item start'>";
                 echo '<a href="#" class="nav-link nav-toggle" class="nav-link nav-toggle"> <span class="nav-label">'.__('Reportes').'</span> <span class="fa arrow"></span> </a>';

                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('Cotizaciones', 'reporte')) {
                        echo "<li class='nav-item ".(($actionUrl=='Cotizaciones/reporte') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Reporte de Ventas'), ['controller'=>'Cotizaciones', 'action'=>'reporte', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Cotizaciones', 'salesOfficess')) {
                        echo "<li class='nav-item ".(($actionUrl=='Cotizaciones/salesOfficess') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Ventas por Sucursal'), ['controller'=>'Cotizaciones', 'action'=>'sales_officess', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Cotizaciones', 'officesRanking')) {
                        echo "<li class='nav-item ".(($actionUrl=='Cotizaciones/officesRanking') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Ranking de Sucursales'), ['controller'=>'Cotizaciones', 'action'=>'officesRanking', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Interactions', 'reporteMixto')) {
                        echo "<li class='nav-item ".(($actionUrl=='Interactions/reporteMixto') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Reporte por Marca'), ['controller'=>'Interactions', 'action'=>'reporteMixto', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Interactions', 'reportePorVendedor')) {
                        echo "<li class='nav-item ".(($actionUrl=='Interactions/reportePorVendedor') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Interacciones por Vendedor'), ['controller'=>'Interactions', 'action'=>'reportePorVendedor', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Interactions', 'trabajosEnProceso')) {
                        echo "<li class='nav-item ".(($actionUrl=='Interactions/trabajosEnProceso') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Trabajos en Proceso de Ejecución'), ['controller'=>'Interactions', 'action'=>'trabajosEnProceso', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Cargos', 'resultadoCargos')) {
                        echo "<li class='nav-item ".(($actionUrl=='Cargos/resultadoCargos') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Resultado Cargos'), ['controller'=>'Cargos', 'action'=>'resultadoCargos', 'plugin'=>false])."</li>";
                    }
                    if($this->UserAuth->HP('Cotizaciones', 'pendientesFacturacion')) {
                        echo "<li class='nav-item ".(($actionUrl=='Cotizaciones/pendientesFacturacion') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Pendientes de Facturación'), ['controller'=>'Cotizaciones', 'action'=>'pendientesFacturacion', 'plugin'=>false])."</li>";
                    }
                echo "</ul>";
            echo "</li>";
        }

        if(
            $this->UserAuth->HP('Cotizaciones', 'pronosticosCompra') ||
            $this->UserAuth->HP('Cotizaciones', 'pronosticosFacturacion')
        ) {
            echo "<li class='nav-item start'>";
                 echo '<a href="#" class="nav-link nav-toggle" class="nav-link nav-toggle"> <span class="nav-label">'.__('Pronósticos').'</span> <span class="fa arrow"></span> </a>';
                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('Cotizaciones', 'pronosticosCompra')) {
                        echo "<li class='nav-item " . ( ( $actionUrl == 'Cotizaciones/pronosticos-compra') ? $activeClass : $inactiveClass ) . "'>" . 
                            $this->Html->link(
                                __('Pronósticos de Venta'),
                                [
                                    'controller' => 'Cotizaciones',
                                    'action'=>'pronosticosCompra',
                                    'plugin'=>false
                                ]
                            ) . 
                            "</li>";
                    }
                    if($this->UserAuth->HP('Cotizaciones', 'pronosticosFacturacion')) {
                        echo "<li class='nav-item " . ( ( $actionUrl == 'Cotizaciones/pronosticos-facturacion') ? $activeClass : $inactiveClass ) . "'>" . 
                            $this->Html->link(
                                __('Pronósticos de Facturación'),
                                [
                                    'controller' => 'Cotizaciones',
                                    'action' => 'pronosticosFacturacion',
                                    'plugin' => false
                                ]
                            ) . 
                            "</li>";
                    }
                echo "</ul>";
            echo "</li>";
        }

        if($this->UserAuth->HP('UserGroups', 'index', 'Usermgmt')) {

            echo "<li class='nav-item start'>";

                 echo '<a href="#" class="nav-link nav-toggle" class="nav-link nav-toggle"> <span class="nav-label">'.__('Groups').'</span> <span class="fa arrow"></span> </a>';


                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('UserGroups', 'add', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserGroups/add') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Group'), ['controller'=>'UserGroups', 'action'=>'add', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserGroups', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserGroups/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Groups'), ['controller'=>'UserGroups', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                echo "</ul>";
            echo "</li>";

        }


        if(
            $this->UserAuth->HP('UserGroupPermissions', 'permissionGroupMatrix', 'Usermgmt')    ||
            $this->UserAuth->HP('UserGroupPermissions', 'permissionSubGroupMatrix', 'Usermgmt') ||
            $this->UserAuth->HP('UserSettings', 'index', 'Usermgmt')                            ||
            $this->UserAuth->HP('UserSettings', 'cakelog', 'Usermgmt')                          ||
            $this->UserAuth->HP('Users', 'deleteCache', 'Usermgmt')
        ){
            echo "<li class='nav-item start'>";
                                   
                echo '<a href="#" class="nav-link nav-toggle"> <span class="nav-label">'.__('Admin').'</span> <span class="fa arrow"></span> </a>';

                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('UserGroupPermissions', 'permissionGroupMatrix', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserGroupPermissions/permissionGroupMatrix') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Group Permissions'), ['controller'=>'UserGroupPermissions', 'action'=>'permissionGroupMatrix', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserGroupPermissions', 'permissionSubGroupMatrix', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserGroupPermissions/permissionSubGroupMatrix') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Subgroup Permissions'), ['controller'=>'UserGroupPermissions', 'action'=>'permissionSubGroupMatrix', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserSettings', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserSettings/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Settings'), ['controller'=>'UserSettings', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserSettings', 'cakelog', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserSettings/cakelog') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Cake Logs'), ['controller'=>'UserSettings', 'action'=>'cakelog', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('Users', 'deleteCache', 'Usermgmt')) {
                        echo "<li>".$this->Html->link(__('Delete Cache'), ['controller'=>'Users', 'action'=>'deleteCache', 'plugin'=>'Usermgmt'])."</li>";
                    }
                echo "</ul>";
            echo "</li>";
        }

        if($this->UserAuth->HP('UserEmails', 'index', 'Usermgmt')){
            echo "<li class='nav-item start'>";
                


                echo '<a href="#" class="nav-link nav-toggle"> <span class="nav-label">'.__('Email').'</span> <span class="fa arrow"></span> </a>';


                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('UserEmails', 'send', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserEmails/send') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Send Email'), ['controller'=>'UserEmails', 'action'=>'send', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserEmails', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('View Sent Emails'), ['controller'=>'UserEmails', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('ScheduledEmails', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='ScheduledEmails/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Scheduled Mails'), ['controller'=>'ScheduledEmails', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserContacts', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserContacts/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Contact Enquiries'), ['controller'=>'UserContacts', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserEmailTemplates', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserEmailTemplates/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Templates'), ['controller'=>'UserEmailTemplates', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('UserEmailSignatures', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='UserEmailSignatures/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Email Signatures'), ['controller'=>'UserEmailSignatures', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                echo "</ul>";
            echo "</li>";
        }

        if($this->UserAuth->HP('StaticPages', 'index', 'Usermgmt')){
            echo "<li class='nav-item start'>";

                 echo '<a href="#" class="nav-link nav-toggle"> <span class="nav-label">'.__('Pages').'</span> <span class="fa arrow"></span> </a>';


                echo "<ul class='sub-menu'>";
                    if($this->UserAuth->HP('StaticPages', 'add', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='StaticPages/add') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Add Page'), ['controller'=>'StaticPages', 'action'=>'add', 'plugin'=>'Usermgmt'])."</li>";
                    }
                    if($this->UserAuth->HP('StaticPages', 'index', 'Usermgmt')) {
                        echo "<li class='nav-item ".(($actionUrl=='StaticPages/index') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('All Pages'), ['controller'=>'StaticPages', 'action'=>'index', 'plugin'=>'Usermgmt'])."</li>";
                    }
                echo "</ul>";
            echo "</li>";
        }

        if($this->UserAuth->isAdmin()){

            echo "<li class='nav-item start'>";

                echo '<a href="#" class="nav-link nav-toggle"> <span class="nav-label">'.__('Demos').'</span> <span class="fa arrow"></span> </a>';
                echo "<ul class='sub-menu'>";
                if($this->UserAuth->HP('Demos', 'pdf')) {

                    echo "<li class='nav-item ".(($actionUrl=='Demos/pdf') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Demo Pdf'), ['controller'=>'Demos', 'action'=>'pdf' , 'plugin'=>false])."</li>";
                }


                if($this->UserAuth->HP('Demos', 'pdfCell')) {


                    echo "<li class='nav-item ".(($actionUrl=='Demos/pdfCell') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Demo Pdf Cell'), ['controller'=>'Demos', 'action'=>'pdfCell' , 'plugin'=>false])."</li>";


                }

                if($this->UserAuth->HP('Demos', 'graficasImg')) {


                    echo "<li class='nav-item ".(($actionUrl=='Demos/graficasImg') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Demo Graficas IMG'), ['controller'=>'Demos', 'action'=>'graficasImg' , 'plugin'=>false])."</li>";


                }

                if($this->UserAuth->HP('Demos', 'correo')) {


                    echo "<li class='nav-item ".(($actionUrl=='Demos/correo') ? $activeClass : $inactiveClass)."'>".$this->Html->link(__('Demo Correo EWS'), ['controller'=>'Demos', 'action'=>'correo' , 'plugin'=>false])."</li>";


                }
                echo '</ul>';



            echo '</li>';
        }

    }
