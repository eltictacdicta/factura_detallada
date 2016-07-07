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
 * Description of idioma_fac_det
 *
 * @author carlos
 */
class idioma_fac_det extends fs_model
{
   public $abreviatura;
   public $idioma;
   public $activo;
   
   public function __construct($e = FALSE)
   {
      parent::__construct('idiomas_fac_det', 'plugins/importador_proveedores/');
      if($e)
      {
         $this->abreviatura = $e['abreviatura'];
         $this->idioma = $e['idioma'];
         $this->activo = $e['activo'];
      }
      else
      {
         $this->abreviatura = NULL;
         $this->idioma = NULL;
         $this->activo = TRUE;
      }
   }
   
   protected function install()
   {
       
      return "INSERT INTO idiomas_fac_det  (abreviatura,idioma,activo) VALUES ".
              "('es_ES','Español',TRUE)".
              ",('ca_ES','Catalán',FALSE);";
   }
   
   public function get($abreviatura)
   {
      $data = $this->db->select("SELECT * FROM idiomas_fac_det WHERE abreviatura = ".$this->var2str($abreviatura).";");
      if($data)
      {
         return new idioma_fac_det($data[0]);
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
         return $this->db->select("SELECT * FROM idiomas_fact_de WHERE abreviatura = ".$this->var2str($this->abreviatura).";");
   }
   
   public function save()
   {
      $this->idioma = $this->no_html($this->idioma);
      $this->abreviatura = $this->no_html($this->abreviatura);
      if( $this->exists() )
      {
         $sql = "UPDATE idiomas_fact_det SET idioma = ".$this->var2str($this->idioma)." activo = ".$this->var2str($this->activo).
                 "  WHERE abreviatura = ".$this->var2str($this->abreviatura).";";
      }
      else
      {
         $sql = "INSERT INTO idiomas_fac_det (abreviatura,activo,idioma) VALUES ("
                 .$this->var2str($this->abreviatura).","
                 .$this->activo.","
                 .$this->var2str($this->idioma).");";
      }
      
      return $this->db->exec($sql);
   }
   
   public function delete()
   {
      return $this->db->exec("DELETE FROM idiomas_fac_det WHERE abreviatura = ".$this->var2str($this->abreviatura).";");
   }
   
   public function all()
   {
      $elist = array();
      
      $data = $this->db->select("SELECT * FROM idiomas_fac_det ORDER BY abreviatura ASC;");
      if($data)
      {
         foreach($data as $d)
            $elist[] = new idioma_fac_det($d);
      }
      
      return $elist;
   }
}

