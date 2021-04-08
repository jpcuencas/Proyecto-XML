<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Conversor GPS a XML</title>
</head>
<body>
	<?php
		// Realizamos la lectura del ficheroGPS.txt
	    $file = fopen("ficheroGPS.txt", "r") or exit("Unable to open file!");
        $data[]=array();
        $i=0;
        $Ciudades = "";
        $CoordenadasInicio = "";
        $CoordenadasFin = "";
        
        while(!feof($file))
        {
            array_push($data, fgets($file));  
            $i++;        
        }
        
		// Variable para las Ciudades
        $Ciudades = $data[1];
		// Variable para las Coordenadas Iniciales
        $CoordenadasInicio = substr($data[2], 0, -23);
		// Variable para las Coordenadas Finales
        $CoordenadasFin = substr($data[$i], 0, -21);
        
        fclose($file);
        
		// Programación del PHP DOM
		// Creamos una instancia de la clase DOMImplementation
		$imp = new DOMImplementation;

		// Creamos una instancia de DOMDocumentType
		$dtd = $imp->createDocumentType('html', '', 'proyectoXML.dtd');

		// Creamos un nuevo documento DomDocument y lo guardamos dentro de $doc
		$doc = $imp->createDocument("", "", $dtd);

		// Propiedades del documento
		$doc->encoding = 'UTF-8';
		$doc->standalone = false;

		//Fichero xslt y lo añadimos al documento
		$xslt = $doc->createProcessingInstruction('xml-stylesheet', 'type="text/xsl" href="proyectoXML.xsl"');
		$doc->appendChild($xslt);

		// Creamos un objeto del árbol
		$root = $doc->createElement("ruta");
		// Para el atributo usamos setAttributeNode
		$attr = $root->setAttributeNode(new DOMAttr('xmlns:xsi', 'http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="proyectoXML.xsd'));
		// Guardamos el objeto en $doc
		$doc->appendChild($root);

		// Creamos un nuevo elemento del árbol
		$nombre = $doc->createElement("nombre");
		// Lo guardamos y añadimos dentro del nivel de $root
		$root->appendChild($nombre);

		// Codificamos el texto a añadir dentro de nombre
		$Texto=$doc->createTextNode($Ciudades);
		// Añadimos el texto dentro de nombre
		$nombre->appendChild($Texto);

		// Creamos un nuevo elemento del árbol
		$descripcion = $doc->createElement("descripcion");
		// Lo guardamos y añadimos dentro del nivel de $root
		$root->appendChild($descripcion);

		// Codificamos el texto a añadir dentro de descripcion
		$Texto=$doc->createTextNode("Ruta entre ".$Ciudades);
		// Añadimos el texto dentro de descripcion
		$descripcion->appendChild($Texto);

		// Creamos un nuevo elemento del árbol
		$color = $doc->createElement("color");
		// Lo guardamos y añadimos dentro del nivel de $root
		$root->appendChild($color);

		// Codificamos el texto a añadir dentro de color
		$Texto=$doc->createTextNode("0000ffaa");
		// Añadimos el texto dentro de color
		$color->appendChild($Texto);

		// Creamos un nuevo elemento del árbol
		$anchura = $doc->createElement("anchura");
		// Lo guardamos y añadimos dentro del nivel de $root
		$root->appendChild($anchura);

		// Codificamos el texto a añadir dentro de anchura
		$Texto=$doc->createTextNode("4");
		// Añadimos el texto dentro de anchura
		$anchura->appendChild($Texto);

		// Creamos un nuevo elemento del árbol
		$coordenadas = $doc->createElement("coordenadas");
		// Lo guardamos y añadimos dentro del nivel de $root
		$root->appendChild($coordenadas);

		// Creamos un nuevo elemento llamado latlon
		$latlon = $doc->createElement("latlon");
		// Lo añadimos dentro del nodo $coordenadas
		$coordenadas->appendChild($latlon);

		// Codificamos el texto a añadir dentro de latlon
		$Texto=$doc->createTextNode($CoordenadasInicio);
		// Añadimos el texto dentro de latlon
		$latlon->appendChild($Texto);

		// Creamos un nuevo elemento llamado latlon
		$latlon = $doc->createElement("latlon");
		// Lo añadimos dentro del nodo $coordenadas
		$coordenadas->appendChild($latlon);

		// Codificamos el texto a añadir dentro de latlon
		$Texto=$doc->createTextNode($CoordenadasFin);
		// Añadimos el texto dentro de latlon
		$latlon->appendChild($Texto);

		// Guardamos en la carpeta el fichero
		$doc->save("ruta.xml");
	?>
	
<h2>Conversión realizada con éxito</h2>
<p>Fichero generado: ruta.xml</p>
</body>
</html>
