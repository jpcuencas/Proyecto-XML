<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" >
<head>
    <title>Untitled Page</title>
</head>
<body>

    <?php
        $file = fopen("Documento.txt", "r") or exit("Unable to open file!");
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
        
        $Ciudades = $data[1];
        $CoordenadasInicio = substr($data[2], 0, -21);
        $CoordenadasFin = substr($data[$i], 0, -21);
        
        fclose($file);
        
        $buffer='<?xml version="1.0" encoding="utf-8"?>';
		$buffer='<?xml-stylesheet href="proyectoXML.xsl" type="text/xsl" ?>';
		$buffer='<!DOCTYPE html SYSTEM "proyectoXML.dtd">';
		$buffer='<ruta><nombre>'.$Ciudades.'</nombre>'; 
        $buffer.='<descripcion>'.'Ruta entre '.$Ciudades.'</descripcion>';
        $buffer.='<color>0000ffaa</color>';
        $buffer.='<anchura>4</anchura>';
        $buffer.='<coordenadas>'.'<latlon>'.$CoordenadasInicio.'</latlon>'.'<latlon>'.$CoordenadasFin.'</latlon>'.'</coordenadas>';    
        $buffer.="</ruta>"; 
        
        $file=fopen("rutas.xml","w+"); 
        
        fwrite ($file,$buffer);
        fclose($file); 
    ?>

</body>
</html>
