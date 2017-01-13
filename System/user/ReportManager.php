<?php

require('fpdf/fpdf.php');

class ReportManager extends FPDF
{	
	var $dtFecha;
	var $tiHora;
	var $sbTituloReporte;
	var $sbTituloReporteDos;
	var $nuAnchoCelda;
	var $nuAltoCelda;
	
	function Header() 	{    		
	  $this->SetTextColor(50,50,150);
	  $this->SetFont('Arial','B',15);
	 // $this->Cell(0,8, TITULO_EMPRESA_REPORTES, 0, 1,'C');
	  $this->AliasNbPages();
	
	   
		// Vertical
		if ($this->CurOrientation == 'P') {
			//$this->Image(IMAGEN_REPORTE_THINKER,10,10,30);
			$this->Image(IMAGEN_REPORTE_EMPRESA_REPORTES,170,2,30);
		// Horizontal
		}
		else {
			//$this->Image(IMAGEN_REPORTE_THINKER,10,10,30);
			$this->Image(IMAGEN_REPORTE_EMPRESA_REPORTES,260,2,30);
		}
	 	
		    $this->SetDrawColor(0,80,180);
    		$this->SetFillColor(230,230,0);
		if ($this->sbTituloReporte!="") {
			$this->SetFont('Arial','B',12);		
			$this->SetTextColor(50,50,150);
			$this->SetFillColor(200,220,255);
			if ($this->sbTituloReporteDos!="")
				$this->Cell(0, 6, $this->sbTituloReporte, 0, 1, 'C');
			else
				$this->Cell(0, 12, $this->sbTituloReporte, 0, 1, 'C');
			$this->SetTextColor(0,0,0);
		}

		if ($this->sbTituloReporteDos!="") {
			$this->SetFont('Arial','B',12);		
			$this->SetTextColor(50,50,150);
			$this->Cell(0, 6, $this->sbTituloReporteDos, 0, 1, 'C');
			$this->SetTextColor(0,0,0);
		}
		

		$this->Cell(0,2,'',0,1);
	}
				
		
	function setTitulo ($sbReporte) {
		$this->sbTituloReporte=$sbReporte;
	}
	
	function setTituloSecundario ($sbReporte) {
		$this->sbTituloReporteDos=$sbReporte;
	}
	
	function setFecha ($dtNewFecha) {
		$this->dtFecha = $dtNewFecha;
	}

	function setearCampos ($objMensaje) {
		$this->tiHora=$objMensaje->dtFecha;
		$this->dtFecha=$objMensaje->tiHora;
	}
	
	function setHora ($tiNewHora) {
		$this->tiHora = $tiNewHora;
	}
	
	function drawValorNumeric($w,$h,$txt,$border,$ln,$align, $fill=0) {		
		if (0>$txt) 
			$this->SetTextColor(255,0,0);
		$this->Cell($w,$h,number_format($txt),$border,$ln,$align, $fill);
		$this->SetTextColor(0,0,0);
	}
	
	function drawValorMoney($w,$h,$txt,$border,$ln,$align, $fill=0) {		
		if (0>$txt) 
			$this->SetTextColor(255,0,0);
		$this->Cell($w,$h,formatCallBackMoney($txt),$border,$ln,$align,$fill);
		$this->SetTextColor(0,0,0);
	}
	
	function drawCadenaCondicional($w,$h,$txt,$border,$ln,$align, $value, $opcion1, $opcion2, $fill=0) {
		if ($txt==$value)
 			$this->Cell($w,$h, $opcion1, $border, $ln, $align, $fill);
		else
			$this->Cell($w,$h, $opcion2, $border, $ln, $align, $fill);				
	}
	
	function drawValorPorcentaje ($w,$h,$txt,$border,$ln,$align, $fill=0){
		if (0>$txt) 
			$this->SetTextColor(255,0,0);
		$this->Cell($w,$h,'%'.number_format($txt,2),$border,$ln,$align, $fill);
		$this->SetTextColor(0,0,0);
	}
	
	function drawCenterString ($w, $h, $txt, $border, $ln, $align, $fill=0) {
		$w=($this->w-$this->rMargin-$this->x-$w);
		$this->Cell($w, $h, $txt, $border, $ln, $align, $fill);
	}
	
	function calcularValorCentro ($Tamano) {
		return (($this->w-($this->lMargin+$this->rMargin))-$Tamano)/2;
	}
	
	function centrarTexto ($nuTamano) {
		$this->Cell($this->calcularValorCentro($nuTamano));
	}
	
	//Pie de página
	function Footer() {
	    //Posición: a 1,5 cm del final
	    $this->SetY(-10);
	    //Arial italic 8
	    $this->SetFont('Arial','I',7);
	    //Número de página
	    $this->Cell(0,5,'Pagina '.$this->PageNo().'/{nb}',0,0,'L');
	    $this->Cell(0,5,'Fecha generación '.$this->dtFecha."/".$this->tiHora,0,0,'R');
	 }

 	//Optimizacion de Memoria 
	function putpages() {
	    $nb=$this->page;
	    if(!empty($this->AliasNbPages)) {
	      //Replace number of pages
	      for($n=1;$n<=$nb;$n++)
	        $this->pages[$n]=($this->compress) ? gzcompress(str_replace($this->AliasNbPages,$nb,gzuncompress($this->pages[$n]))) : str_replace($this->AliasNbPages,$nb,$this->pages[$n]) ;
	    }
	    if($this->DefOrientation=='P') {
	      $wPt=$this->fwPt;
	      $hPt=$this->fhPt;
	    } else {
	      $wPt=$this->fhPt;
	      $hPt=$this->fwPt;
	    }
	    $filter=($this->compress) ? '/Filter /FlateDecode ' : '';
	    for($n=1;$n<=$nb;$n++) {
	      //Page
	      $this->_newobj();
	      $this->_out('<</Type /Page');
	      $this->_out('/Parent 1 0 R');
	      if(isset($this->OrientationChanges[$n]))
	        $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$hPt,$wPt));
	      $this->_out('/Resources 2 0 R');
	      if(isset($this->PageLinks[$n])) {
	      //Links
		  $annots='/Annots [';
	      foreach($this->PageLinks[$n] as $pl) {
	        $rect=sprintf('%.2f %.2f %.2f %.2f',$pl[0],$pl[1],$pl[0]+$pl[2],$pl[1]-$pl[3]);
	        $annots.='<</Type /Annot /Subtype /Link /Rect ['.$rect.'] /Border [0 0 0] ';
	        if(is_string($pl[4]))
	          $annots.='/A <</S /URI /URI '.$this->_textstring($pl[4]).'>>>>';
	        else {
	          $l=$this->links[$pl[4]];
	          $h=isset($this->OrientationChanges[$l[0]]) ? $wPt : $hPt;
	          $annots.=sprintf('/Dest [%d 0 R /XYZ 0 %.2f null]>>',1+2*$l[0],$h-$l[1]*$this->k);
	        }
	      }
	      $this->_out($annots.']');
	    }
	    $this->_out('/Contents '.($this->n+1).' 0 R>>');
	    $this->_out('endobj');
	    //Page content
	    $this->_newobj();
	    $this->_out('<<'.$filter.'/Length '.strlen($this->pages[$n]).'>>');
	    $this->_putstream($this->pages[$n]);
	    $this->_out('endobj');
	  }
	  //Pages root
	  $this->offsets[1]=strlen($this->buffer);
	  $this->_out('1 0 obj');
	  $this->_out('<</Type /Pages');
	  $kids='/Kids [';
	  for($i=0;$i<$nb;$i++)
	  	$kids.=(3+2*$i).' 0 R ';
	  $this->_out($kids.']');
	  $this->_out('/Count '.$nb);
	  $this->_out(sprintf('/MediaBox [0 0 %.2f %.2f]',$wPt,$hPt));
	  $this->_out('>>');
	  $this->_out('endobj');
	}

	function endpage() {
	  //End of page contents
	  $this->pages[$this->page] = ($this->compress) ? gzcompress($this->pages[$this->page]) : $this->pages[$this->page];
	  $this->state=1;
	} 
 
}

?>