<?php if ($this->UserAuth->getGroupId() == 5) { ?>

  <li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-shopping-cart"></i>Pedidos <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/pedidos/index">Listado de Pedidos</a></li>
  </ul>
</li>

<?php } ?>



<?php if ($this->UserAuth->isAdmin()) { ?>
<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-users"></i>Usuarios <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/usermgmt/Users">Listado de Usuarios</a></li>
      <li class=''><a href="/usermgmt/Users/addUser">Agregar Usuario</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-child"></i>Clientes <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/usermgmt/Users/clients">Listado de Clientes</a></li>


  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-shopping-cart"></i>Ciudades <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/ciudades">Listado de Ciudades</a></li>
    <li class=''><a href="/ciudades/ciudadesCalendario">Calendario</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-shopping-cart"></i>Pedidos <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/pedidos/index">Listado de Pedidos</a></li>
    <li class=''><a href="/recordatorios/index">Listado de Recordatorios</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-folder"></i>Productos <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/productos/index">Listado de Productos</a></li>
    <li class=''><a href="/categorias">Listado de Categorias</a></li>
    <li class=''><a href="/ciudades/ciudadesProductos">Ciudades Productos</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-photo"></i>Banners <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/banners/index">Listado de Banners</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-ticket"></i>Cupones <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/cupones/index">Listado de Cupones</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-money"></i>Formas de Pago <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/formasdepagos/index">Listado de Formas de Pago</a></li>
  </ul>
</li>

<li><a href="#" class="dropdown-toggle" data-toggle="dropdown">
<i class="fa fa-copy"></i>Páginas <span class="fa arrow"></span></a>
  <ul class='nav nav-second-level'>
    <li class=''><a href="/usermgmt/StaticPages">Listado de Páginas</a></li>
      <li class=''><a href="/usermgmt/StaticPages/add">Agregar Página</a></li>
  </ul>
</li>
<?php } ?>
