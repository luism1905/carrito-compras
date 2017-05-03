<?php

require_once  __DIR__ . './../Carrito.php' ;
require_once  __DIR__ . './../Producto.php' ;

use PHPUnit\Framework\TestCase;


if ( !isset( $_SESSION ) ) $_SESSION = array(  );

/**
 * @covers Carrito
 */
final class CarritoTest extends TestCase
{
    
    var $carrito = null;
    
    
    public function setUp(){
        $this->carrito = new Carrito();
        
        
    }
    
    
    private function crearProducto(){
        
        $arrayNombreProducto = array(
            "Libro 1",
            "Teclado Hp",
            "Corneta",
            "Televisor",
            "Celular HTC",
            "Caucho",
            "Cargador Celular",
            "Corneta Zaura",
            "Laptop personal",
            "Cuaderno",
            "Lapiz",
            "Mesa",
            "Silla"
            );
            
            return $producto = new Producto( $arrayNombreProducto[rand(0,12)], 1000);
    }
    
    /**
     * se agregan las funcionalidad del crud de carrito a un test ya que entre ellas son comunes
     */ 
    public function testCarritoCrud(){
        
        //comprobamos la cantidad al entrar al test
        $this->assertEquals( count($this->carrito->getProductos()), 0, "La cantidad debe ser igual a cero"  );
        
        $this->carrito->agregarProducto($this->crearProducto());
        
        //verificamos si el metodo agregar producto funciona
        $this->assertEquals( count($this->carrito->getProductos()), 1, "La cantidad debe ser igual a uno"  );
        
        //verificamos si generar id esta aumentando de manera correcta los indices
        $this->assertEquals( $this->carrito->generarId(), 2, "La cantidad debe ser igual a dos ya que poseemos ya un indice"  );

        //agrega mos un nuevo proucto
        $this->carrito->agregarProducto($this->crearProducto());
        
        $this->assertEquals( count($this->carrito->getProductos()), 2, "La cantidad debe ser igual a dos"  );
        
        //aliminamos del carrito el producto con el index 1
        $this->carrito->eliminarProducto(1);

        //esperamos uno ya que eliminamos el producto con el id 1
        $this->assertEquals( count($this->carrito->getProductos()), 1, "La cantidad debe ser igual a uno"  );
        
    }
    
    
    public function testCalcularMontoTotal(){
        //tengo un producto agregado asi q el total debe ser de 1000
        $this->assertEquals( $this->carrito->calcularMontoTotal(), 1000, "La cantidad debe ser igual a 1000"  );
    }
    
    
    
    public function testCalcularDescueto(){
       
        $_SESSION['descuento'] = 10;
         //la varaible de sesion descuento es 10 asi q el % es igual a 10
        $this->assertEquals( $this->carrito->calcularDescueto(), 100, "La cantidad debe ser igual a 10"  );
    }
    
    public function testCalcularImpuesto(){
        $_SESSION['impuesto'] = 10;
         //la varaible de sesion impuesto  es 10 asi q el % es igual a 10
        $this->assertEquals( $this->carrito->calcularImpuesto(), 100, "La cantidad debe ser igual a 10"  );
    }

    public function TestTotalCancelar(){
        //tenemos un producto de 1000 con 100 de descuento y 100 de impuesto la cantidad total es 1000
         $this->assertEquals( $this->carrito->totalCancelar(), 1000, "La cantidad debe ser igual a 1000"  );
    }
    
    
}