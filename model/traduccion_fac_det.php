<?php

/*
 * This file is part of FacturaSctipts
 * Copyright (C) 2015  Javier Trujillo Jimenez        javier.trujillo.jimenez@gmail.com
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

/**
 * Description of traduccion_fac_det
 *
 * @author carlos
 */
class traduccion_fac_det extends fs_model
{
   public $abreviatura;
   public $factura;
   public $pagina;
   public $fecha;
   public $ncliente;
   public $formadepago;
   public $albaranabre;
   public $descripcion;
   public $cantidadabre;
   public $precio;
   public $impuesto;
   public $importe;
   public $neto;
   public $recequiv;
   public $irpf;
   public $total;
   public $telefono;
   public $fax;
   public $descuentoabre;
   
   
   
   public function __construct($e = FALSE)
   {
      parent::__construct('traducciones_fac_det', 'plugins/importador_proveedores/');
      if($e)
      {
           $this->abreviatura = $e['abreviatura'];
           $this->factura = $e['factura'];
           $this->pagina = $e['pagina'];
           $this->fecha = $e['fecha'];
           $this->ncliente = $e['ncliente'];
           $this->formadepago = $e['formadepago'];
           $this->albaranabre = $e['albaranabre'];
           $this->descripcion = $e['descripcion'];
           $this->cantidadabre = $e['cantidadabre'];
           $this->precio = $e['precio'];
           $this->impuesto = $e['impuesto'];
           $this->importe = $e['importe'];
           $this->neto = $e['neto'];
           $this->recequiv = $e['recequiv'];
           $this->irpf = $e['irpf'];
           $this->total = $e['total'];
           $this->telefono = $e['telefono'];
           $this->fax = $e['fax'];
           $this->descuentoabre = $e['descuentoabre'];
      }
      else
      {
           $this->abreviatura=NULL;
           $this->factura=NULL;
           $this->pagina=NULL;
           $this->fecha=NULL;
           $this->ncliente=NULL;
           $this->formadepago=NULL;
           $this->albaranabre=NULL;//Abreviatura de albaran
           $this->descripcion=NULL;
           $this->cantidadabre=NULL;//Abreviatura de cantidad
           $this->precio=NULL;
           $this->impuesto=NULL;
           $this->importe=NULL;
           $this->neto=NULL;
           $this->recequiv=NULL;
           $this->irpf=NULL;
           $this->total=NULL;
           $this->telefono=NULL;
           $this->fax=NULL;
           $this->descuentoabre=NULL;
      }
   }
   
   protected function install()
   {
       
      /*return "INSERT INTO traducciones_fac_det  (abreviatura,idioma,activo) VALUES ".
              "('es_ES','Español',TRUE)".
              ",('ca_ES','Catalán',FALSE);";*/
   }
   
   public function get($abreviatura)
   {
      $data = $this->db->select("SELECT * FROM traducciones_fac_det WHERE abreviatura = ".$this->var2str($abreviatura).";");
      if($data)
      {
         return new traduccion_fac_det($data[0]);
      }
      else
         return FALSE;
   }
   
   
   public function exists()
   {
      if( is_null($this->abreviatura) )
      {
         return FALSE;
      }
      else
         return $this->db->select("SELECT * FROM traducciones_fac_det WHERE abreviatura = ".$this->var2str($this->abreviatura).";");
   }
   
   public function save()
   {
      $this->abreviatura = $this->no_html($this->abreviatura);
      if( $this->exists() )
      {
         $sql = "UPDATE traducciones_fac_det SET factura = ".$this->var2str($this->factura).
                 ", pagina = ".$this->var2str($this->pagina).
                 ", fecha = ".$this->var2str($this->fecha).
                 ", ncliente = ".$this->var2str($this->ncliente).
                 ", formadepago = ".$this->var2str($this->formadepago).
                 ", albaranabre = ".$this->var2str($this->albaranabre).
                 ", cantidadabre = ".$this->var2str($this->cantidadabre).
                 ", precio = ".$this->var2str($this->precio).
                 ", impuesto = ".$this->var2str($this->impuesto).
                 ", importe = ".$this->var2str($this->importe).
                 ", neto = ".$this->var2str($this->neto).
                 ", recequiv = ".$this->var2str($this->recequiv).
                 ", irpf = ".$this->var2str($this->irpf).
                 ", total = ".$this->var2str($this->total).
                 ", telefono = ".$this->var2str($this->telefono).
                 ", fax = ".$this->var2str($this->fax).
                 ", descuentoabre = ".$this->var2str($this->descuentoabre).
                 "  WHERE abreviatura = ".$this->var2str($this->abreviatura).";";
      }
      else
      {
         $sql = "INSERT INTO traducciones_fac_det (abreviatura,factura,pagina,fecha,ncliente,formadepago,albaranabre,descripcion"
                 .",precio,impuesto,importe,neto,recequiv,irpf,total,telefono,fax,descuentoabre) VALUES ("
                 .$this->var2str($this->abreviatura).","
                 .$this->var2str($this->factura).","
                 .$this->var2str($this->pagina).","
                 .$this->var2str($this->fecha).","
                 .$this->var2str($this->ncliente).","
                 .$this->var2str($this->formadepago).","
                 .$this->var2str($this->albaranabre).","
                 .$this->var2str($this->descripcion).","
                 .$this->var2str($this->precio).","
                 .$this->var2str($this->impuesto).","
                 .$this->var2str($this->importe).","
                 .$this->var2str($this->neto).","
                 .$this->var2str($this->recequiv).","
                 .$this->var2str($this->irpf).","
                 .$this->var2str($this->total).","
                 .$this->var2str($this->telefono).","
                 .$this->var2str($this->fax).","
                 .$this->var2str($this->descuentoabre).");";
      }
      
      return $this->db->exec($sql);
   }
   
   public function delete()
   {
      return $this->db->exec("DELETE FROM traducciones_fac_det WHERE abreviatura = ".$this->var2str($this->abreviatura).";");
   }
   
   public function all()
   {
      $elist = array();
      
      $data = $this->db->select("SELECT * FROM traducciones_fac_det ORDER BY abreviatura ASC;");
      if($data)
      {
         foreach($data as $d)
            $elist[] = new traduccion_fac_det($d);
      }
      
      return $elist;
   }
}

