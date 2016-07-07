<?php

/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2015   Francisco Javier Trujillo Jimenez
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as
 * published by the Free Software Foundation, either version 3 of the
 * License, or (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 * 
 * You should have received a copy of the GNU Affero General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
require_model('idioma_fac_det.php');
require_model('traduccion_fac_det.php');
/**
 * Description of opciones_servicios
 *
 * @author javier
 */
class idioma_factura_detallada extends fs_controller
{
   public $idioma;
   public $traduccion;
   public $abreviatura;
   
   public function __construct()
   {
      parent::__construct(__CLASS__, 'Idioma fact', 'admin', TRUE, TRUE);
   }
   
   protected function private_core()
   {
      $this->idioma = new idioma_fac_det();
      if( isset($_GET['delete_idioma']) )
      {
         $idioma = $this->idioma->get($_GET['delete_idioma']);
         if($idioma)
         {
            if( $idioma->delete() )
            {
               $this->new_message('Estado eliminado correctamente.');
            }
            else
               $this->new_error_msg('Error al eliminar el idioma.');
         }
         else
            $this->new_error_msg('Estado no encontrado.');
      }
      else if( isset($_POST['idioma']) )
      {
         $nuevo_idioma=FALSE; //ESTA VARIABLE ES UN FLAG PARA CONTROLAR SI AÑADIMOS UN NUEVO IDIOMA O EDITAMOS
         $idioma = $this->idioma->get($_POST['abreviatura']);
         if(!$idioma)
         {
            $idioma = new idioma_fac_det();
            $nuevo_idioma=TRUE;
         }
         $idioma->abreviatura = $_POST['abreviatura'];
         $idioma->idioma = $_POST['idioma'];
         $idioma->activo = $_POST['activo'];
         
         if( $idioma->save() )
         {
            if($nuevo_idioma)
            {
                $this->new_message('Idioma agregado correctamente.');
                $this->template='traduccion_factura_detallada';
            }
            else 
            {
                $this->new_message('Idioma iditado correctamente.');
            }
            
            
         }
         else
            $this->new_error_msg('Error al guardar el idioma.');
         
      }
      elseif($_GET['abreviatura']) //aqui entra para editar las traducciones
      {
          $this->idioma = $this->idioma->get($_GET['abreviatura']);
          $this->traduccion = new traduccion_fac_det();
          $this->traduccion = $this->traduccion->get($_GET['abreviatura']);
          if($this->idioma)
          {
            if(!$this->traduccion)
            {
                //si no existen los campos vuelvo a llamar al constructor para formatear los valores
                //y asi me ahorro que me saque errores
                $this->traduccion = new traduccion_fac_det();
            }  
            if($_POST['factura'])
            {
                $this->traduccion->abreviatura=$_GET['abreviatura'];
                $this->traduccion->factura=$_POST['factura'];
                $this->traduccion->pagina=$_POST['pagina'];
                $this->traduccion->fecha=$_POST['fecha'];
                $this->traduccion->ncliente=$_POST['ncliente'];
                $this->traduccion->formadepago=$_POST['formadepago'];
                $this->traduccion->albaranabre=$_POST['albaranabre'];
                $this->traduccion->descripcion=$_POST['descripcion'];
                $this->traduccion->cantidadabre=$_POST['cantidadabre'];
                $this->traduccion->precio=$_POST['precio'];
                $this->traduccion->impuesto=$_POST['impuesto'];
                $this->traduccion->importe=$_POST['importe'];
                $this->traduccion->neto=$_POST['neto'];
                $this->traduccion->recequiv=$_POST['recequiv'];
                $this->traduccion->irpf=$_POST['irpf'];
                $this->traduccion->total=$_POST['total'];
                $this->traduccion->telefono=$_POST['telefono'];
                $this->traduccion->fax=$_POST['fax'];
                $this->traduccion->descuentoabre=$_POST['descuentoabre'];
                if($this->traduccion->save())
                {
                    $this->new_message('Traduccion guardada correctamente');
                }
            }
            $this->template='traduccion_factura_detallada';
          }
      }
      
      
   }
   
}
