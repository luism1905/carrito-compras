<?php

	require_once("ControladorCarrito.php");
	//$producto = new Producto();
	//$producto->setNombre("Luis");
	//$producto->setPrecio(1000);
	//echo $producto->getNombre();
	//$carritoCompras = array();
	//array_push($carritoCompras, $producto);
	//array_push($carritoCompras, $producto);
	
	$controladorCarrito = new ControladorCarrito;

	if(isset($_POST["submit"])){
		$controladorCarrito->guardarCarrito($_POST["producto_nombre"], $_POST["producto_precio"]);
		header("Location: ./");
		die();
	}else if(isset($_POST["submit_borrar"])){
		//elimino
		$controladorCarrito->borrarCarrito($_POST["id"]);
		header("Location: ./");
		die();
	}else if(isset($_POST["submit_total"])){
		$controladorCarrito->persistirDeducibles($_POST["impuesto"], $_POST["descuento"]);
	}
	
	
	
?>

<!DOCTYPE html>
<html>
	<head>
		<title></title> 
		  <link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	     <link rel="stylesheet" type="text/css" href="css/estilo.css"> 
		<link rel="stylesheet" type="text/css" href="css/materialize.css"/>
		<script type="text/javascript" src="js/materialize.js" ></script>
	     <meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
	     
	   
	</head>
	<body>
	 <div class="row">
	 	<img src="img/logo.png">
	 	
	 	
	    <form class="col s12" method="POST" action="./">
	      <div class="row">
	        <div class="input-field col s6">
	          <input name="producto_nombre"  required id="Nombre del Producto" placeholder="Nombre del Producto" type="text" class="validate">
	          <label for="Nombre del Producto"></label>
	        </div>
	        <div class="input-field col s6">
	          <input type="number" name="producto_precio" required error-m placeholder="precio" id="precio" type="text" class="validate">
	          <label for="precio"></label>
	        </div>
	      </div>
	      <div class="row">
	        <div class="input-field col s12">
				<button type="submit" id="idSubmit" class="btn waves-effect waves-light" type="submit" name="submit">Agregar
  				</button>
	        </div>
	    </form>
	    
	    
	    
	    	<div class="col s12">
	            <table>
        			<thead>
			          <tr>
			          	   <th>Id</th>
			              <th>Nombre</th>
			              <th>Precio</th>
			              <th>-</th>
			          </tr>
        			</thead>
        			<tbody>
        				
        				
        				<?php
        					echo($controladorCarrito->printTable());
        					echo($controladorCarrito->printTotal());
        				?>
  
        			</tbody>
      			</table>
	        </div>
	        
	        
	       <from action="./" method"POST" > 
	        <div class="input-field col s6">
	          <input type="number" name="descuento"  id="desc" placeholder="Descuento" type="text" class="validate">
	         
	        </div>
	      <div class="input-field col s6">
	          <input type="number" name="impuesto" id="imp" placeholder="Impuesto" type="text" class="validate">
	         
	        </div>
	  </div>
	  
	  	<div class="row">
	        <div class="input-field col s12">
				<button type="submit" id="idSubmit" class="btn waves-effect waves-light" type="submit" name="submit_total">Calcular total
  				</button>
	    </div>
	        
	  </from>
	  
	  <div class="row"></div>
	   <?php echo($controladorCarrito->printDecuento()); ?>
	  <div class="row"></div>
	  <?php echo($controladorCarrito->printImpuesto()); ?>
	   <div class="row"></div>
       <?php echo($controladorCarrito->printTotalCancelar()); ?> 
        
        
	</body>
</html>