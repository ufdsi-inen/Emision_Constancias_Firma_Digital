<?php
    date_default_timezone_set('America/Lima');
    session_start();
    include '../../../../Entidades/variables_globales.php';
    include('../../../../conexion/connect.php');
    require('../../../plugins/fpdf/fpdf.php');

    $cod_curso             = $_REQUEST['cod_curso'];
    $cod_unidad            = $_REQUEST['cod_unidad'];
    $cod_tipo_unidad       = $_REQUEST['cod_tipo_unidad'];
    $cod_participante      = $_REQUEST['cod_participante'];
    $cod_tipo_participante = $_REQUEST['cod_tipo_participante'];
    $opc = $_REQUEST['opc'];

    $mes = [
        '1' => 'enero',
        '2' => 'febrero',
        '3' => 'marzo',
        '4' => 'abril',
        '5' => 'mayo',
        '6' => 'junio',
        '7' => 'julio',
        '8' => 'agosto',
        '9' => 'setiembre',
        '01' => 'enero',
        '02' => 'febrero',
        '03' => 'marzo',
        '04' => 'abril',
        '05' => 'mayo',
        '06' => 'junio',
        '07' => 'julio',
        '08' => 'agosto',
        '09' => 'setiembre',
        '10' => 'octubre',
        '11' => 'noviembre',
        '12' => 'diciembre'
    ];
    
    class PDF extends FPDF
    {
        protected $wLine; // Maximum width of the line
        protected $hLine; // Height of the line
        protected $Text; // Text to display
        protected $border;
        protected $align; // Justification of the text
        protected $fill;
        protected $Padding;
        protected $lPadding;
        protected $tPadding;
        protected $bPadding;
        protected $rPadding;
        protected $TagStyle; // Style for each tag
        protected $Indent;
        protected $Space; // Minimum space between words
        protected $PileStyle; 
        protected $Line2Print; // Line to display
        protected $NextLineBegin; // Buffer between lines 
        protected $TagName;
        protected $Delta; // Maximum width minus width
        protected $StringLength; 
        protected $LineLength;
        protected $wTextLine; // Width minus paddings
        protected $nbSpace; // Number of spaces in the line
        protected $Xini; // Initial position
        protected $href; // Current URL
        protected $TagHref; // URL for a cell

        public function WriteTag($w, $h, $txt, $border=0, $align="J", $fill=false, $padding=0) {
            $this->wLine=$w;
            $this->hLine=$h;
            $this->Text=trim($txt);
            $this->Text=preg_replace("/\n|\r|\t/","",$this->Text);
            $this->border=$border;
            $this->align=$align;
            $this->fill=$fill;
            $this->Padding=$padding;

            $this->Xini=$this->GetX();
            $this->href="";
            $this->PileStyle=array();        
            $this->TagHref=array();
            $this->LastLine=false;
            $this->NextLineBegin=array();

            $this->SetSpace();
            $this->Padding();
            $this->LineLength();
            $this->BorderTop();

            while($this->Text!="")
            {
                $this->MakeLine();
                $this->PrintLine();
            }

            $this->BorderBottom();
        }

        public function SetStyle($tag, $family, $style, $size, $color, $indent=-1) {
             $tag=trim($tag);
             $this->TagStyle[$tag]['family']=trim($family);
             $this->TagStyle[$tag]['style']=trim($style);
             $this->TagStyle[$tag]['size']=trim($size);
             $this->TagStyle[$tag]['color']=trim($color);
             $this->TagStyle[$tag]['indent']=$indent;
        }

        private function SetSpace() { // Minimal space between words 
            $tag=$this->Parser($this->Text);
            $this->FindStyle($tag[2],0);
            $this->DoStyle(0);
            $this->Space=$this->GetStringWidth(" ");
        }

        private function Padding() {
            if(preg_match("/^.+,/",$this->Padding)) {
                $tab=explode(",",$this->Padding);
                $this->lPadding=$tab[0];
                $this->tPadding=$tab[1];
                if(isset($tab[2]))
                    $this->bPadding=$tab[2];
                else
                    $this->bPadding=$this->tPadding;
                if(isset($tab[3]))
                    $this->rPadding=$tab[3];
                else
                    $this->rPadding=$this->lPadding;
            }
            else
            {
                $this->lPadding=$this->Padding;
                $this->tPadding=$this->Padding;
                $this->bPadding=$this->Padding;
                $this->rPadding=$this->Padding;
            }
            if($this->tPadding<$this->LineWidth)
                $this->tPadding=$this->LineWidth;
        }

        private function LineLength() {
            if($this->wLine==0)
                $this->wLine=$this->w - $this->Xini - $this->rMargin;

            $this->wTextLine = $this->wLine - $this->lPadding - $this->rPadding;
        }

        private function BorderTop() {
            $border=0;
            if($this->border==1)
                $border="TLR";
            $this->Cell($this->wLine,$this->tPadding,"",$border,0,'C',$this->fill);
            $y=$this->GetY()+$this->tPadding;
            $this->SetXY($this->Xini,$y);
        }

        private function BorderBottom() {
            $border=0;
            if($this->border==1)
                $border="BLR";
            $this->Cell($this->wLine,$this->bPadding,"",$border,0,'C',$this->fill);
        }

        private function DoStyle($tag) { // Applies a style 
            $tag=trim($tag);
            $this->SetFont($this->TagStyle[$tag]['family'],
                $this->TagStyle[$tag]['style'],
                $this->TagStyle[$tag]['size']);

            $tab=explode(",",$this->TagStyle[$tag]['color']);
            if(count($tab)==1)
                $this->SetTextColor($tab[0]);
            else
                $this->SetTextColor($tab[0],$tab[1],$tab[2]);
        }

        private function FindStyle($tag, $ind) { // Inheritance from parent elements
            $tag=trim($tag);

            // Family
            if($this->TagStyle[$tag]['family']!="")
                $family=$this->TagStyle[$tag]['family'];
            else
            {
                foreach($this->PileStyle as $val)
                {
                    $val=trim($val);
                    if($this->TagStyle[$val]['family']!="") {
                        $family=$this->TagStyle[$val]['family'];
                        break;
                    }
                }
            }

            // Style
            $style="";
            $style1=strtoupper($this->TagStyle[$tag]['style']);
            if($style1!="N")
            {
                $bold=false;
                $italic=false;
                $underline=false;
                foreach($this->PileStyle as $val)
                {
                    $val=trim($val);
                    $style1=strtoupper($this->TagStyle[$val]['style']);
                    if($style1=="N")
                        break;
                    else
                    {
                        if(strpos($style1,"B")!==false)
                            $bold=true;
                        if(strpos($style1,"I")!==false)
                            $italic=true;
                        if(strpos($style1,"U")!==false)
                            $underline=true;
                    } 
                }
                if($bold)
                    $style.="B";
                if($italic)
                    $style.="I";
                if($underline)
                    $style.="U";
            }

            // Size
            if($this->TagStyle[$tag]['size']!=0)
                $size=$this->TagStyle[$tag]['size'];
            else
            {
                foreach($this->PileStyle as $val)
                {
                    $val=trim($val);
                    if($this->TagStyle[$val]['size']!=0) {
                        $size=$this->TagStyle[$val]['size'];
                        break;
                    }
                }
            }

            // Color
            if($this->TagStyle[$tag]['color']!="")
                $color=$this->TagStyle[$tag]['color'];
            else
            {
                foreach($this->PileStyle as $val)
                {
                    $val=trim($val);
                    if($this->TagStyle[$val]['color']!="") {
                        $color=$this->TagStyle[$val]['color'];
                        break;
                    }
                }
            }
             
            // Result
            $this->TagStyle[$ind]['family']=$family;
            $this->TagStyle[$ind]['style']=$style;
            $this->TagStyle[$ind]['size']=$size;
            $this->TagStyle[$ind]['color']=$color;
            $this->TagStyle[$ind]['indent']=$this->TagStyle[$tag]['indent'];
        }

        private function Parser($text) {
            $tab=array();
            // Closing tag
            if(preg_match("|^(</([^>]+)>)|",$text,$regs)) {
                $tab[1]="c";
                $tab[2]=trim($regs[2]);
            }
            // Opening tag
            else if(preg_match("|^(<([^>]+)>)|",$text,$regs)) {
                $regs[2]=preg_replace("/^a/","a ",$regs[2]);
                $tab[1]="o";
                $tab[2]=trim($regs[2]);

                // Presence of attributes
                if(preg_match("/(.+) (.+)='(.+)'/",$regs[2])) {
                    $tab1=preg_split("/ +/",$regs[2]);
                    $tab[2]=trim($tab1[0]);
                    foreach($tab1 as $i=>$couple)
                    {
                        if($i>0) {
                            $tab2=explode("=",$couple);
                            $tab2[0]=trim($tab2[0]);
                            $tab2[1]=trim($tab2[1]);
                            $end=strlen($tab2[1])-2;
                            $tab[$tab2[0]]=substr($tab2[1],1,$end);
                        }
                    }
                }
            }
             // Space
             else if(preg_match("/^( )/",$text,$regs)) {
                $tab[1]="s";
                $tab[2]=' ';
            }
            // Text
            else if(preg_match("/^([^< ]+)/",$text,$regs)) {
                $tab[1]="t";
                $tab[2]=trim($regs[1]);
            }

            $begin=strlen($regs[1]);
             $end=strlen($text);
             $text=substr($text, $begin, $end);
            $tab[0]=$text;

            return $tab;
        }

        private function MakeLine() {
            $this->Text.=" ";
            $this->LineLength=array();
            $this->TagHref=array();
            $Length=0;
            $this->nbSpace=0;

            $i=$this->BeginLine();
            $this->TagName=array();

            if($i==0) {
                $Length=$this->StringLength[0];
                $this->TagName[0]=1;
                $this->TagHref[0]=$this->href;
            }

            while($Length<$this->wTextLine)
            {
                $tab=$this->Parser($this->Text);
                $this->Text=$tab[0];
                if($this->Text=="") {
                    $this->LastLine=true;
                    break;
                }

                if($tab[1]=="o") {
                    array_unshift($this->PileStyle,$tab[2]);
                    $this->FindStyle($this->PileStyle[0],$i+1);

                    $this->DoStyle($i+1);
                    $this->TagName[$i+1]=1;
                    if($this->TagStyle[$tab[2]]['indent']!=-1) {
                        $Length+=$this->TagStyle[$tab[2]]['indent'];
                        $this->Indent=$this->TagStyle[$tab[2]]['indent'];
                    }
                    if($tab[2]=="a")
                        $this->href=$tab['href'];
                }

                if($tab[1]=="c") {
                    array_shift($this->PileStyle);
                    if(isset($this->PileStyle[0]))
                    {
                        $this->FindStyle($this->PileStyle[0],$i+1);
                        $this->DoStyle($i+1);
                    }
                    $this->TagName[$i+1]=1;
                    if($this->TagStyle[$tab[2]]['indent']!=-1) {
                        $this->LastLine=true;
                        $this->Text=trim($this->Text);
                        break;
                    }
                    if($tab[2]=="a")
                        $this->href="";
                }

                if($tab[1]=="s") {
                    $i++;
                    $Length+=$this->Space;
                    $this->Line2Print[$i]="";
                    if($this->href!="")
                        $this->TagHref[$i]=$this->href;
                }

                if($tab[1]=="t") {
                    $i++;
                    $this->StringLength[$i]=$this->GetStringWidth($tab[2]);
                    $Length+=$this->StringLength[$i];
                    $this->LineLength[$i]=$Length;
                    $this->Line2Print[$i]=$tab[2];
                    if($this->href!="")
                        $this->TagHref[$i]=$this->href;
                 }

            }

            trim($this->Text);
            if($Length>$this->wTextLine || $this->LastLine==true)
                $this->EndLine();
        }

        private function BeginLine() {
            $this->Line2Print=array();
            $this->StringLength=array();

            if(isset($this->PileStyle[0]))
            {
                $this->FindStyle($this->PileStyle[0],0);
                $this->DoStyle(0);
            }

            if(count($this->NextLineBegin)>0) {
                $this->Line2Print[0]=$this->NextLineBegin['text'];
                $this->StringLength[0]=$this->NextLineBegin['length'];
                $this->NextLineBegin=array();
                $i=0;
            }
            else {
                preg_match("/^(( *(<([^>]+)>)* *)*)(.*)/",$this->Text,$regs);
                $regs[1]=str_replace(" ", "", $regs[1]);
                $this->Text=$regs[1].$regs[5];
                $i=-1;
            }

            return $i;
        }

        private function EndLine() {
            if(end($this->Line2Print)!="" && $this->LastLine==false) {
                $this->NextLineBegin['text']=array_pop($this->Line2Print);
                $this->NextLineBegin['length']=end($this->StringLength);
                array_pop($this->LineLength);
            }

            while(end($this->Line2Print)==="")
                array_pop($this->Line2Print);

            $this->Delta=$this->wTextLine-end($this->LineLength);

            $this->nbSpace=0;
            for($i=0; $i<count($this->Line2Print); $i++) {
                if($this->Line2Print[$i]=="")
                    $this->nbSpace++;
            }
        }

        private function PrintLine() {
            $border=0;
            if($this->border==1)
                $border="LR";
            $this->Cell($this->wLine,$this->hLine,"",$border,0,'C',$this->fill);
            $y=$this->GetY();
            $this->SetXY($this->Xini+$this->lPadding,$y);

            if($this->Indent!=-1) {
                if($this->Indent!=0)
                    $this->Cell($this->Indent,$this->hLine);
                $this->Indent=-1;
            }

            $space=$this->LineAlign();
            $this->DoStyle(0);
            for($i=0; $i<count($this->Line2Print); $i++)
            {
                if(isset($this->TagName[$i]))
                    $this->DoStyle($i);
                if(isset($this->TagHref[$i]))
                    $href=$this->TagHref[$i];
                else
                    $href='';
                if($this->Line2Print[$i]=="")
                    $this->Cell($space,$this->hLine,"         ",0,0,'C',false,$href);
                else
                    $this->Cell($this->StringLength[$i],$this->hLine,$this->Line2Print[$i],0,0,'C',false,$href);
            }

            $this->LineBreak();
            if($this->LastLine && $this->Text!="")
                $this->EndParagraph();
            $this->LastLine=false;
        }

        private function LineAlign() {
            $space=$this->Space;
            if($this->align=="J") {
                if($this->nbSpace!=0)
                    $space=$this->Space + ($this->Delta/$this->nbSpace);
                if($this->LastLine)
                    $space=$this->Space;
            }

            if($this->align=="R")
                $this->Cell($this->Delta,$this->hLine);

            if($this->align=="C")
                $this->Cell($this->Delta/2,$this->hLine);

            return $space;
        }

        private function LineBreak() {
            $x=$this->Xini;
            $y=$this->GetY()+$this->hLine;
            $this->SetXY($x,$y);
        }

        private function EndParagraph() {
            $border=0;
            if($this->border==1)
                $border="LR";
            $this->Cell($this->wLine,$this->hLine/2,"",$border,0,'C',$this->fill);
            $x=$this->Xini;
            $y=$this->GetY()+$this->hLine/2;
            $this->SetXY($x,$y);
        }

        public function getNombreDpto($cod_unidad, $cod_tipo_unidad) {
            $conn = $GLOBALS['conn'];
            $query="SELECT V.DES_UNIDAD_ORGANICA
                    FROM V_EDU_LISTA_UNIDAD_ORGANICA V
                    WHERE V.COD_UNIDAD_ORGANICA = '$cod_unidad'
                    AND V.COD_TIPO_UNIDAD = '$cod_tipo_unidad'";
            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();
            while($data=oci_fetch_array($result,OCI_BOTH)) { 
                array_push($dato, $data);
            }

            oci_close($conn);
            return $dato[0]['DES_UNIDAD_ORGANICA'];
        }

        public function getDatosCurso($cod_curso, $cod_unidad, $cod_tipo_unidad) {
            $conn = $GLOBALS['conn'];
            $query="SELECT V.DES_NOMBRE_CURSO,
                           V.NUM_TOTAL_HORAS,
                           LOWER(V.DES_TIPO_HORAS) DES_TIPO_HORAS,
                           V.FEC_REALIZACION,
                           V.DES_MODALIDAD,
                           V.COD_TIPO_CURSO,
                           V.DES_SERVICIO,
                           V.IND_VISUALIZACION_HORAS,
                           V.FEC_REALIZACION,
                           V.FEC_INICIO,
                           V.FEC_FIN,
                           V.FEC_EMISION,
                           LOWER(V.DES_ENLACE_FECHA) DES_ENLACE_FECHA
                    FROM V_EDU_LISTA_CURSOS V
                    WHERE V.COD_CURSO = '$cod_curso'
                    AND V.COD_UNIDAD = '$cod_unidad'
                    AND V.COD_TIPO_UNIDAD = '$cod_tipo_unidad'";
            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();
            $resp = array();

            while($data=oci_fetch_array($result,OCI_RETURN_NULLS)) { 
                array_push($dato, $data);
            }

            $resp = ['DES_NOMBRE_CURSO' => $dato[0]['DES_NOMBRE_CURSO'],
                     'NUM_TOTAL_HORAS'  => $dato[0]['NUM_TOTAL_HORAS'],
                     'DES_TIPO_HORAS'   => $dato[0]['DES_TIPO_HORAS'],
                     'FEC_REALIZACION'  => $dato[0]['FEC_REALIZACION'],
                     'DES_MODALIDAD'    => $dato[0]['DES_MODALIDAD'],
                     'COD_TIPO_CURSO'   => $dato[0]['COD_TIPO_CURSO'],
                     'DES_SERVICIO'     => $dato[0]['DES_SERVICIO'],
                     'IND_VISUALIZACION_HORAS' => $dato[0]['IND_VISUALIZACION_HORAS'],
                     'FEC_REALIZACION'     => $dato[0]['FEC_REALIZACION'],
                     'FEC_INICIO'       => $dato[0]['FEC_INICIO'],
                     'FEC_FIN'          => $dato[0]['FEC_FIN'],
                     'FEC_EMISION'      => $dato[0]['FEC_EMISION'],
                     'DES_ENLACE_FECHA' => $dato[0]['DES_ENLACE_FECHA']];

            oci_close($conn);
            return $resp;
        }

        public function getNombreParticipante($cod_participante) {
            $conn = $GLOBALS['conn'];
            //$cod_participante = $GLOBALS['cod_participante'];

            $query="SELECT V.DES_NOMBRE_COMPLETO
                    FROM V_EDU_LISTA_PARTICIPANTE V
                    WHERE V.COD_PARTICIPANTE = '$cod_participante'
                    GROUP BY V.DES_NOMBRE_COMPLETO";
            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();

            while($data=oci_fetch_array($result,OCI_BOTH)) { 
                array_push($dato, $data);
            }

            oci_close($conn);
            return $dato[0]['DES_NOMBRE_COMPLETO'];
        }

        public function getAnioSecuencia($cod_curso, $cod_unidad, $cod_tipo_unidad, $cod_participante) {
            $conn = $GLOBALS['conn'];

            $query="SELECT V.COD_ANIO_SECUENCIA
                    FROM V_EDU_LISTA_PARTICIPANTE V
                    WHERE V.COD_PARTICIPANTE = '$cod_participante'
                    AND V.COD_UNIDAD = '$cod_unidad'
                    AND V.COD_TIPO_UNIDAD = '$cod_tipo_unidad'
                    AND V.COD_CURSO = '$cod_curso'";
            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();

            while($data=oci_fetch_array($result,OCI_BOTH)) { 
                array_push($dato, $data);
            }

            oci_close($conn);
            return $dato[0]['COD_ANIO_SECUENCIA'];
        }

        public function getNumSecuencia($cod_curso, $cod_unidad, $cod_tipo_unidad, $cod_participante, $cod_tipo_participante) {
            $conn = $GLOBALS['conn'];
            $query="SELECT PKG_EDU_SGC.SF_NUM_SECUENCIA_CONSTANCIA('$cod_curso', '$cod_unidad', '$cod_tipo_unidad', '$cod_participante', '$cod_tipo_participante') AS NUM_SECUENCIA
                    FROM DUAL";

            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();

            while($data=oci_fetch_array($result,OCI_BOTH)) { 
                array_push($dato, $data);
            }

            oci_close($conn);
            return $dato[0]['NUM_SECUENCIA'];
        }

        public function getDesTotalHoras($total_horas) {
            $conn = $GLOBALS['conn'];
            $query="SELECT PKG_EDU_SGC.sf_des_total_horas('$total_horas') AS TOTAL_HORAS
                    FROM DUAL";
            
            $result=oci_parse($conn,$query);
            oci_execute($result,OCI_DEFAULT);
    
            $dato = array();

            while($data=oci_fetch_array($result,OCI_BOTH)) { 
                array_push($dato, $data);
            }

            oci_close($conn);
            return $dato[0]['TOTAL_HORAS'];
        }

        public function Header() {
            $y_cab = 6;
            $this->Image('images/Logo-inen.png', 155, 8, 38); // Image(file, x, y, w, h)
            $this->SetFont('Arial','B', 14);
            $this->SetY(30);
        }

        public function MostrarUnidad() {
            $y_cab = 6;
            $this->SetFont('Arial','', 12);
            $this->Ln();
            $this->Cell(0,$y_cab,utf8_decode('DIRECCIÓN DE CONTROL DEL CÁNCER'),0,1,'C');
            $this->Cell(0,$y_cab,utf8_decode('DEPARTAMENTO DE EDUCACIÓN'),0,1,'C');
        }

        public function TextoCertificado($dpto, $nom_participante, $nom_curso, $cod_tipo_participante, $tipo_curso, $total_horas, $tipo_horas, $fecha_curso) {
            $y_cab = 6;
            $this->SetFont('Arial','', 12);
            $this->Ln(20);
            $this->MultiCell(0,$y_cab,utf8_decode('El Director Ejecutivo del Departamento de Educación de la Dirección de Control del Cáncer del Instituto Nacional de Enfermedades Neoplásicas,'),0,'J');
            $this->Ln(3);
            $this->MultiCell(0,$y_cab,utf8_decode('Hace constar que:'),0,'J');
            $this->Ln(3);
            $this->SetFont('Arial','B', 16);
            $y_cab = 12;
            $this->SetTextColor(8, 83, 148);
            $this->MultiCell(0, $y_cab, utf8_decode($nom_participante), 0, 'C');
            $this->SetTextColor(0, 0, 0);
            $this->SetFont('Arial','', 12);
            $y_cab = 6;

            $nom_dpto = explode(' ', $dpto);
            if (strpos($nom_dpto[0], 'Escuela') !== false) {
                $dpto = 'la '.$dpto;
            } else {
                $dpto = 'el '.$dpto;
            }

            if($tipo_horas == NULL)
                $tipo_horas = '';
            else
                $tipo_horas = ' '.$tipo_horas;

            $this->SetStyle("p","Arial","",12,"0,0,0");
            $this->SetStyle("b","Arial","B",12,"0,0,0");

            if($cod_tipo_participante == '1') { //PARTICIPANTE
                if($total_horas == " ") {
                    $this->WriteTag(0, $y_cab, utf8_decode('<p>Participó en el '.$tipo_curso.' <b>"'.$nom_curso.'"</b>, organizado por '.$dpto.', evento académico realizado '.$fecha_curso.'.</p>'), 0, "J");
                }
                else {
                    $this->WriteTag(0, $y_cab, utf8_decode('<p>Participó en el '.$tipo_curso.' <b>"'.$nom_curso.'"</b>, organizado por '.$dpto.', evento académico realizado '.$fecha_curso.' con un total de '.$this->getDesTotalHoras($total_horas).' ('.$total_horas.') horas'.$tipo_horas.'.</p>'), 0, "J");
                }
            } else {
                if($cod_tipo_participante == '2') //PONENTE
                    $des_tipo_participante = 'ponente';
                else if($cod_tipo_participante == '3') //PONENTE
                    $des_tipo_participante = 'organizador(a)';
                else if($cod_tipo_participante == '4')
                    $des_tipo_participante = 'moderador(a)';
                else 
                    $des_tipo_participante = '';

                if($total_horas == " ") {
                    $this->WriteTag(0, $y_cab, utf8_decode('<p>Participó como '.$des_tipo_participante.' en el '.$tipo_curso.' <b>"'.$nom_curso.'"</b>, organizado por '.$dpto.', evento académico realizado '.$fecha_curso.'.</p>'), 0, "J");
                }
                else {
                    $this->WriteTag(0, $y_cab, utf8_decode('<p>Participó como '.$des_tipo_participante.' en el '.$tipo_curso.' <b>"'.$nom_curso.'"</b>, organizado por '.$dpto.', evento académico realizado '.$fecha_curso.' con un total de '.$this->getDesTotalHoras($total_horas).' ('.$total_horas.') horas'. $tipo_horas.'.</p>'), 0, "J");
                }
            }
            
            $this->Ln(10);
            $this->MultiCell(0, $y_cab, utf8_decode('Se expide la presente constancia para los fines que correspondan.'), 0, 'J');
        }
        
        public function Footer() {
            $this->SetY(-25);
            $this->SetDrawColor(51, 51, 153);
            $this->SetLineWidth(0.3);
            $this->Line(10, $this->GetY(), 200, $this->GetY());
            $this->SetTextColor(51, 51, 153);
            $this->SetFont('Arial','B', 8);
            $y_cab = 5;
            $this->Ln(3);
            $this->Cell(0,$y_cab,utf8_decode('INSTITUTO NACIONAL DE ENFERMEDADES NEOPLÁSICAS'),0,1,'C');
            $this->Cell(0,$y_cab,utf8_decode('Av. Angamos Este 2520 - Surquillo,   Lima - 34        Telf.: 201-6500        Web: www.inen.sld.pe         E-mail: mesadepartesvirtual@inen.sld.pe'),0,1,'C');
            $this->SetTextColor(0, 0, 0);
        }
    }

    $pdf = new PDF();
    $dpto = $pdf->getNombreDpto($cod_unidad, $cod_tipo_unidad);
    $nom_participante = $pdf->getNombreParticipante($cod_participante);
    $num_secuencia = $pdf->getNumSecuencia($cod_curso, $cod_unidad, $cod_tipo_unidad, $cod_participante, $cod_tipo_participante);
    $datos_curso = array();
    $datos_curso = $pdf->getDatosCurso($cod_curso, $cod_unidad, $cod_tipo_unidad);
    $cod_anio_secuencia = $pdf->getAnioSecuencia($cod_curso, $cod_unidad, $cod_tipo_unidad, $cod_participante);
    
    $nom_curso = $datos_curso['DES_NOMBRE_CURSO'];
    $des_servicio = $datos_curso['DES_SERVICIO'];
    if($des_servicio != ' ')
        $dpto = '<b>'.$des_servicio.'</b> del <b>'.$dpto.'</b>';
    else
        $dpto = '<b>'.$dpto.'</b>';

    $total_horas = $datos_curso['NUM_TOTAL_HORAS'];
    $tipo_horas = $datos_curso['DES_TIPO_HORAS'];
    $modalidad = $datos_curso['DES_MODALIDAD'];
    if($datos_curso['COD_TIPO_CURSO'] == '1')
        $des_tipo_curso = 'Curso';
    else if($datos_curso['COD_TIPO_CURSO'] == '2')
        $des_tipo_curso = 'Taller';

    if($datos_curso['FEC_EMISION'] != ' ') {
        $fec_emision = $datos_curso['FEC_EMISION'];
        //var_dump($datos_curso);
        $fec_emision = explode('/', $fec_emision);
        $dia_fec_emision = $fec_emision[0];
        $mes_fec_emision = $fec_emision[1];
        $year_fec_emision = $fec_emision[2];
    }

    if($datos_curso['FEC_INICIO'] == ' '){
        $fec_realizacion = $datos_curso['FEC_REALIZACION'];
        $fec_realizacion = explode('/', $fec_realizacion);
        $dia_fec_realizacion = $fec_realizacion[0];
        $mes_fec_realizacion = $fec_realizacion[1];
        $year_fec_realizacion = $fec_realizacion[2];

        $fecha_curso = 'el '.$dia_fec_realizacion.' de '.$mes[$mes_fec_realizacion].' del '.$year_fec_realizacion;
    }
    else {
        $fec_inicio = $datos_curso['FEC_INICIO'];
        $fec_fin = $datos_curso['FEC_FIN'];
        $des_enlace_fecha = $datos_curso['DES_ENLACE_FECHA'];
        $fec_inicio = explode('/', $fec_inicio);
        $dia_fec_inicio = $fec_inicio[0];
        $mes_fec_inicio = $fec_inicio[1];
        $year_fec_inicio = $fec_inicio[2];

        $fec_fin = explode('/', $fec_fin);
        $dia_fec_fin = $fec_fin[0];
        $mes_fec_fin = $fec_fin[1];
        $year_fec_fin = $fec_fin[2];

        $date_inicio = new DateTime($fec_inicio[2].'-'.$fec_inicio[1].'-'.$fec_inicio[0]);
        $date_fin    = new DateTime($fec_fin[2].'-'.$fec_fin[1].'-'.$fec_fin[0]);

        $diff = $date_fin->diff($date_inicio);

        if($diff->days == 1)
           $fecha_curso = 'el '.$dia_fec_inicio.' de '.$mes[$mes_fec_inicio].' y '.$dia_fec_fin.' de '.$mes[$mes_fec_fin].' del '.$year_fec_fin; 
        else if($diff->days == 0)
           $fecha_curso = 'el '.$dia_fec_inicio.' de '.$mes[$mes_fec_inicio].' del '.$year_fec_inicio;
        else 
           $fecha_curso = 'del '.$dia_fec_inicio.' de '.$mes[$mes_fec_inicio].' '.$des_enlace_fecha.' '.$dia_fec_fin.' de '.$mes[$mes_fec_fin].' del '.$year_fec_fin;
    }

    $pdf->SetTitle("INSTITUTO NACIONAL DE ENFERMEDADES NEOPLÁSICAS", true);
    $pdf->AliasNbPages();
    $pdf->AddPage();
    $pdf->SetMargins(22, 10 , 22);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->Ln();
    $y = 6;
    $pdf->Ln(10);
    $pdf->SetLineWidth(2);
    $pdf->SetFont('Arial','BU', 14);
    $pdf->Cell(0, $y,utf8_decode('CONSTANCIA Nº '.str_pad($num_secuencia, 5, "0", STR_PAD_LEFT).'-'.$cod_anio_secuencia.'-DE-DICON/INEN'), 0, 1, 'C');
    $pdf->TextoCertificado($dpto, $nom_participante, $nom_curso, $cod_tipo_participante, $des_tipo_curso, $total_horas, $tipo_horas, $fecha_curso);
    $pdf->Ln(15);
    $date = date('d/m/Y');
    $date = explode('/', $date);
    $dia_actual = $date[0];
    $mes_actual = $date[1];
    $year_actual = $date[2];

    if($datos_curso['FEC_EMISION'] == ' ')
       $pdf->Cell(0, $y, utf8_decode('Lima, '.$dia_actual.' de '.$mes[$mes_actual].' de '.$year_actual), 0, 1, 'R');
    else
        $pdf->Cell(0, $y, utf8_decode('Lima, '.$dia_fec_emision.' de '.$mes[$mes_fec_emision].' de '.$year_fec_emision), 0, 1, 'R');

    $pdf->SetLineWidth(0.4);
    $pdf->Line(72, 198, 138, 198);

    $pdf->SetY(200); //270
    $pdf->SetFont('Arial','', 12);
    $pdf->Cell(0, 6, utf8_decode('Director Ejecutivo'), 0, 1, 'C');
    $pdf->Cell(0, 3, utf8_decode('Departamento de Educación'), 0, 1, 'C');

    $pdf->SetY(250);

    $pdf->Cell(0, $y, utf8_decode('MODALIDAD: '.$modalidad), 0, 1, 'L');
    
    $nombrearchivo = $cod_curso.$cod_participante.$cod_tipo_participante;
    if($opc == '1')
        $pdf -> Output();
    else if($opc == '2'){
        $pdf->Output('F', '../documents/sinFirma/'.$nombrearchivo.'.pdf');
        echo $nombrearchivo;
    }
    
?>