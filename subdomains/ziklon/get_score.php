<?php

class MyDOMDocument extends DOMDocument {

    public function toArray(DOMNode $oDomNode = null) {
        // return empty array if dom is blank

        if (is_null($oDomNode) && !$this->hasChildNodes()) {
            return array();
        }
        $oDomNode = (is_null($oDomNode)) ? $this->documentElement : $oDomNode;
        if (!$oDomNode->hasChildNodes()) {
            $mResult = $oDomNode->nodeValue;
        } else {
            $mResult = array();
            foreach ($oDomNode->childNodes as $oChildNode) {
                // how many of these child nodes do we have?
                // this will give us a clue as to what the result structure should be
                $oChildNodeList = $oDomNode->getElementsByTagName($oChildNode->nodeName);
                $iChildCount = 0;
                // there are x number of childs in this node that have the same tag name
                // however, we are only interested in the # of siblings with the same tag name
                foreach ($oChildNodeList as $oNode) {
                    if ($oNode->parentNode->isSameNode($oChildNode->parentNode)) {
                        $iChildCount++;
                    }
                }
                $mValue = $this->toArray($oChildNode);
                $sKey = ($oChildNode->nodeName{0} == '#') ? 0 : $oChildNode->nodeName;
                $mValue = is_array($mValue) ? $mValue[$oChildNode->nodeName] : $mValue;
                // how many of thse child nodes do we have?
                if ($iChildCount > 1) {  // more than 1 child - make numeric array
                    $mResult[$sKey][] = $mValue;
                } else {
                    $mResult[$sKey] = $mValue;
                }
            }
            // if the child is <foo>bar</foo>, the result will be array(bar)
            // make the result just 'bar'
            if (count($mResult) == 1 && isset($mResult[0]) && !is_array($mResult[0])) {
                $mResult = $mResult[0];
            }
        }
        // get our attributes if we have any
        $arAttributes = array();
        if ($oDomNode->hasAttributes()) {
            foreach ($oDomNode->attributes as $sAttrName => $oAttrNode) {
                // retain namespace prefixes
                $arAttributes["@{$oAttrNode->nodeName}"] = $oAttrNode->nodeValue;
            }
        }
        // check for namespace attribute - Namespaces will not show up in the attributes list
        if ($oDomNode instanceof DOMElement && $oDomNode->getAttribute('xmlns')) {
            $arAttributes["@xmlns"] = $oDomNode->getAttribute('xmlns');
        }
        if (count($arAttributes)) {
            if (!is_array($mResult)) {
                $mResult = (trim($mResult)) ? array($mResult) : array();
            }
            $mResult = array_merge($mResult, $arAttributes);
        }
        $arResult = array($oDomNode->nodeName => $mResult);
        return $arResult;
    }

}

$ch = curl_init();
$param = $_POST['curso'].'|'.$_POST['semestre'].'|'.$_POST['codigo'];
//echo $param."<br>";
//echo base64_encode($param)."<br>";
//echo base64_decode('QUQ4MDFCRU98MjAxMi0xfDExNDM2MA==');exit;
$cookie = "32ruvaotm9dlii2r922d16dne0";
curl_setopt($ch, CURLOPT_URL, "http://ccomputo.unsaac.edu.pe/alumno/cntnt.php?dat=".base64_encode($param));
curl_setopt($ch, CURLOPT_COOKIE, "PHPSESSID=$cookie; path=/;");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$contenido = curl_exec($ch);
echo $contenido;
curl_close($ch);
exit;
/*
  $ch = curl_init("http://localhost/vernotas/cntnt.php.htm");
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  $contenido = curl_exec($ch);
  curl_close($ch);
 */
$obj = new MyDOMDocument();
$obj->loadHTML($contenido);
$html = $obj->toArray();

//parece que es por version la existencia de tbody
//$tabla = $html["html"]["body"]["table"][0]["tbody"]["tr"]["td"]["table"]["tbody"];

if (isset($html["html"]["body"]["table"][0]["tr"]["td"]["table"]))
    $tabla = $html["html"]["body"]["table"][0]["tr"]["td"]["table"];
else exit("datos incorrectos");


//estas son las filas de la tabla que necesitamos
//var_dump($tabla["tr"]);exit;


$filas = $tabla["tr"];
// for ($i = 0; $i < 4; $i++) {
// 	//para el titulo
// 	var_dump($filas[$i]["td"][0][0]);
// 	//para la description
// 	var_dump($filas[$i]["td"][1][0]);
// }
//la fila de la tabla con el contenido que nos interesa
//var_dump($filas[4]["td"]["table"]["tbody"]["tr"]["td"]["table"]["tbody"]["tr"][0]);
//la posicion 0 le corresponde a PARCIALES
//var_dump($filas[4]["td"]["table"]["tbody"]["tr"]["td"]["table"]["tbody"]["tr"][0]["td"][1]);
// por version tbody  php 5.3 con tbody 
//$tabla_notas = $filas[4]["td"]["table"]["tbody"]["tr"]["td"]["table"]["tbody"]["tr"][0]["td"][1]["table"]["tbody"];
$tabla_notas = $filas[4]["td"]["table"]["tr"]["td"]["table"]["tr"][0]["td"][1]["table"];

//var_dump($tabla_notas["tr"]);exit;

$arreglo_encabezado = $tabla_notas["tr"][1]["td"];
$arreglo_contenido = $tabla_notas["tr"][3]["td"];

$len = count($arreglo_encabezado);
echo '<table class="score">';
for ($i = 0; $i < $len; $i++) {
    echo '<tr>';
    echo "<td>" . $arreglo_encabezado[$i][0] . "</td>";
    $var = (isset($arreglo_contenido[$i][0])) ? $arreglo_contenido[$i][0] : "";
    echo "<td>" . $var . "</td>";
    echo '</tr>';
}
echo '<table>';
?>
