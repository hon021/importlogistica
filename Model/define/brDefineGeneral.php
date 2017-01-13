<?php

date_default_timezone_set('UTC');
define ("SEPARADOR_ARCHIVOS",",");
define ("SEPACAMPOS","|");
define ("SEPAREGISTROS",";");
define ("SEPALINEA","\n");
define ("SEPALINEAS","@");
define ("SEPARADOR_ARCHIVOS_EXCEL", ";");
define ("ENTER_ARCHIVOS_EXCEL", "\n");
define( "DIRECTORIOS_SMARTY", dirname( __FILE__ ) );
 
function fncCalendario($sbCampo, $dtDefaultValue="", $sbFuncion ="")
{ 
	if ($dtDefaultValue=="")
 		$sbCadena ="<input Type='text' $sbFuncion id='".$sbCampo."' name='".$sbCampo."'>";
	else
		$sbCadena ="<input Type='text' $sbFuncion id='".$sbCampo."' name='".$sbCampo."' value='".$dtDefaultValue."'>";
 		
 	$sbCadena.="<INPUT onclick=\"popFrame.fPopCalendar('".$sbCampo."','".$sbCampo."',event);\" type=button value='...' name='fecha___".$sbCampo."'>";	
 	return $sbCadena;
}

function fncCalendarioNew($sbCampo, $dtDefaultValue="", $sbAtributoCampo = "")
{ 
	if ($dtDefaultValue=="")
 		$sbCadena ="<input Type='text' $sbAtributoCampo id='".$sbCampo."' name='".$sbCampo."'>";
	else
		$sbCadena ="<input Type='text' $sbAtributoCampo id='".$sbCampo."' name='".$sbCampo."' value='".$dtDefaultValue."'>";
 		
 	$sbCadena.="<INPUT onclick=\"popFrame.fPopCalendar('".$sbCampo."','".$sbCampo."',event);\" type=button value='...' name='fecha___".$sbCampo."'>";	
 	return $sbCadena;
}

function getAyer() {
	$sbFecha = date('Y-m-d',time()-86400);	
	return $sbFecha;
}

function getFechaActual() {
	$sbFecha = date('Y-m-d');	
	return $sbFecha;
}

function getHoraActual() {
	$sbHora = date("H:i:s");	
	return $sbHora;
}

function getDiaSemana() {
	$nuDiaSemana = date('w')+1;	
	return $nuDiaSemana;
}

function formatCallBackMoney($sbLabel) {
	return '$'.number_format($sbLabel);
} 

function isValidWindow() {	
	echo "<script>if(window.name==''){" .
		"	alert('NO es una operacion valida');" .
		"	window.location.href='".RUTA_ERROR."';" .
		"}</script>";
}

function fecha_diff_function( $data1, $data2 )
{
	$segundos = strtotime($data2)-strtotime($data1);
    $dias = intval($segundos/86400);
    return $dias;
}

function fncHora($sbNombreHora,$sbNombreMinuto)
{
	$html ='
	<table>
        <tr>
          <td>
          	<select name="'.$sbNombreHora.'" id="'.$sbNombreHora.'">
	            <option value="00">00</option>
	            <option value="01">01</option>
	            <option value="02">02</option>
	            <option value="03">03</option>
	            <option value="04">04</option>
	            <option value="05">05</option>
	            <option value="06">06</option>
	            <option value="07">07</option>
	            <option value="08">08</option>
	            <option value="09">09</option>
	            <option value="10">10</option>
	            <option value="11">11</option>
	            <option value="12">12</option>
	            <option value="13">13</option>
	            <option value="14">14</option>
	            <option value="15">15</option>
	            <option value="16">16</option>
	            <option value="17">17</option>
	            <option value="18">18</option>
	            <option value="19">19</option>
	            <option value="20">20</option>
	            <option value="21">21</option>
	            <option value="22">22</option>
	            <option value="23">23</option>
	            <option value="24">24</option>
          	</select>
          :</td>
          <td>
          	<select name="'.$sbNombreMinuto.'" id="'.$sbNombreMinuto.'">
          		<option value="00">00</option>
	            <option value="01">01</option>
	            <option value="02">02</option>
	            <option value="03">03</option>
	            <option value="04">04</option>
	            <option value="05">05</option>
	            <option value="06">06</option>
	            <option value="07">07</option>
	            <option value="08">08</option>
	            <option value="09">09</option>
	            <option value="10">10</option>
	            <option value="11">11</option>
	            <option value="12">12</option>
	            <option value="13">13</option>
	            <option value="14">14</option>
	            <option value="15">15</option>
	            <option value="16">16</option>
	            <option value="17">17</option>
	            <option value="18">18</option>
	            <option value="19">19</option>
	            <option value="20">20</option>
	            <option value="21">21</option>
	            <option value="22">22</option>
	            <option value="23">23</option>
	            <option value="24">24</option>
	            <option value="25">25</option>
	            <option value="26">26</option>
	            <option value="27">27</option>
	            <option value="28">28</option>
	            <option value="29">29</option>
	            <option value="30">30</option>
	            <option value="31">31</option>
	            <option value="32">32</option>
	            <option value="33">33</option>
	            <option value="34">34</option>
	            <option value="35">35</option>
	            <option value="36">36</option>
	            <option value="37">37</option>
	            <option value="38">38</option>
	            <option value="39">39</option>
	            <option value="40">40</option>
	            <option value="41">41</option>
	            <option value="42">42</option>
	            <option value="43">43</option>
	            <option value="44">44</option>
	            <option value="45">45</option>
	            <option value="46">46</option>
	            <option value="47">47</option>
	            <option value="48">48</option>
	            <option value="49">49</option>
	            <option value="50">50</option>
	            <option value="51">51</option>
	            <option value="52">52</option>
	            <option value="53">53</option>
	            <option value="54">54</option>
	            <option value="55">55</option>
	            <option value="56">56</option>
	            <option value="57">57</option>
	            <option value="58">58</option>
	            <option value="59">59</option>
	            <option value="60">60</option>
            </select>
          </td>
          <td>
          	(HH:MM)
          </td>
    	</tr>
  	</table>';
  	
  	return $html;
}
?>