<?php
    require_once("Carrito.php");
    require_once("./Producto.php");
    
	class ControladorCarrito{

        private $_carrito;

		function __construct(){
		    $this->_carrito = new Carrito();
		}
		
		
		
		function printTable(){
		    $htmlTable = "";
		    if(count($this->_carrito->getProductos()) == 0){
		        
		        $htmlTable = "Aun no tienes productos guardados";
		        
		    }else{
		        
		        foreach ($this->_carrito->getProductos() as $prod) {
		            $htmlTable .= "<tr>";
					$htmlTable .= 	"<td>". $prod->getId()  ."</td>";
					$htmlTable .= 	"<td>". $prod->getNombre()  ."</td>";
			        $htmlTable .= 	"<td>". $prod->getPrecio()  ."</td>";
			        $htmlTable .= "<td><form method='POST' action='./'' > 
			        	<input type='hidden'  name='id' value = " . $prod->getId()  .  "/>
			        	<button type='submit'
			        	class='waves-effect waves-light btn' name='submit_borrar' >Eliminar</button> <form></td>";
			        $htmlTable .= "</tr>";
		        }
		        
		    }
		    return $htmlTable;
		}
		
		
		function printTotal(){
			$htmlTotal = "<tr><td>Sub Total</td><td></td><td>";
			$htmlTotal .=  $this->_carrito->calcularMontoTotal();
			$htmlTotal .= "</td><td></td></tr>";
			
			if(count($this->_carrito->getProductos()) == 0){
				return "";
			}else{
				return $htmlTotal;
			}
		}
		
		
		function guardarCarrito( $nombre, $precio){
			$producto = new Producto( $nombre, $precio);
			$this->_carrito->agregarProducto($producto);
		}
		
		
		function borrarCarrito($id){
			$this->_carrito->eliminarProducto($id);
		}
		
		
		public function persistirDeducibles($impuesto, $descuento){

			$this->_carrito->setImpuesto($impuesto);
			$this->_carrito->setDescuento($descuento);
		}
		
		public function printDecuento(){
			$htmlDescuento = '<div id="row" ><div class="col s6">Descuento  ';
			$htmlDescuento .= $this->_carrito->getDescuento();
			$htmlDescuento .= '</div><div class="col s6">';
			$htmlDescuento .=  $this->_carrito->calcularDescueto();
			$htmlDescuento .= '</div></div>';
	  		return $htmlDescuento;
		}
		
		
		public function printImpuesto(){
			$htmlImpuesto = '<div id="row" ><div class="col s6">Impuesto  '; 
			$htmlImpuesto .= $this->_carrito->getIpuesto();
			$htmlImpuesto .='%</div><div class="col s6">';
			$htmlImpuesto .=  $this->_carrito->calcularImpuesto();
			$htmlImpuesto .= '</div></div>';

	  		return $htmlImpuesto;
		}
		
		
		public function printTotalCancelar(){
			$htmlTotalCancelar .= '<div id="row" ><div class="col s6">Total a cancelar  '; 
			$htmlTotalCancelar .= '</div><div class="col s6">';
			$htmlTotalCancelar .= $this->_carrito->totalCancelar();
			$htmlTotalCancelar .= '</div></div>';
			return $htmlTotalCancelar;
		}



	}

?>