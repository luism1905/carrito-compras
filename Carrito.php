<?php

	class Carrito{

		function __construct(){
			if(!isset($_SESSION)){
			    session_start();
			}
						
			if (!isset($_SESSION['productos_store'])){
				$_SESSION['productos_store'] =  array();
			}
		}

		function getProductos(){
			if(!isset($_SESSION)){
			    session_start();
			}
			return 	$_SESSION['productos_store'];
		}

		function agregarProducto($producto){
			
			if(!isset($_SESSION)){
			    session_start();
			}
			$producto->setId($this->generarId());
			array_push($_SESSION['productos_store'],  $producto);
		}
		
		function generarId(){
			if(!isset($_SESSION)){
			    session_start();
			}
			$id = 0;
			
			foreach ($_SESSION['productos_store']  as $prosductoStore){
				if($prosductoStore->getId() != null){
					if($prosductoStore->getId() > $id){
						$id = $prosductoStore->getId();
					}
				}
			}
			
			$id +=1;
			return $id;
		}

		function eliminarProducto($id){
			
			foreach ($_SESSION['productos_store']  as $key => $productoTmp){
				if($id ==  $productoTmp->getId()){
					unset($_SESSION['productos_store'][$key]);
				}
			}
		}

		function calcularMontoTotal(){
			$acumPrecio = 0;
			$productos = $_SESSION['productos_store'];
			
			foreach ($productos as $value) {
				$acumPrecio += $value->getPrecio();
			}
			return $acumPrecio;
		}

		function calcularDescueto(){

			$montoDescuento = 0;
			$montoDescuento = $this->calcularMontoTotal() * ($this->getDescuento()/100);
			return $montoDescuento;
		}

		function calcularImpuesto(){
			$montoImpuesto = 0;
			$montoImpuesto = $this->calcularMontoTotal() * ($this->getIpuesto() / 100);
			return $montoImpuesto;
		}

		function totalCancelar(){
			return $this->calcularMontoTotal() - $this->calcularDescueto()
					+ $this->calcularImpuesto();
		}
		
		
		function quitarTodos(){
			
			if(!isset($_SESSION)){
			    session_start();
			}
			
			if (isset($_SESSION['productos_store'])){
				unset($_SESSION['productos_store']);
			}
		}
		
		public function setImpuesto($porcentaje){
			if(!isset($_SESSION)){
			    session_start();
			}
			$_SESSION['impuesto'] = $porcentaje;
		}

		public function getIpuesto(){
			if(!isset($_SESSION)){
			    session_start();
			}
			
			if (!isset($_SESSION['impuesto'])){
				$_SESSION['impuesto'] = 0;
			}
			return $_SESSION['impuesto'];
		}
		
		
		public function getDescuento(){
			if(!isset($_SESSION)){
			    session_start();
			}
			
			if (!isset($_SESSION['descuento'])){
				$_SESSION['descuento'] = 0;
			}
			return $_SESSION['descuento'];
		}
		
		
		public function setDescuento($porcentaje){
			if(!isset($_SESSION)){
			    session_start();
			}
			$_SESSION['descuento'] = $porcentaje;
		}

	}

?>