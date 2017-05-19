<?php 
error_reporting(0);
session_start();

require_once("fpdf17/fpdf.php");

include "../../include/connect.php";
 
#ambil data dari DB dan masukkan ke array
$data  = array();

$sql   = mysql_query("SELECT * FROM tbl_pendaftaran_vw WHERE tanggal BETWEEN '$_REQUEST[awal]' AND '$_REQUEST[akhir]' ORDER BY input");
	
while($row = mysql_fetch_array($sql)) 
	{
	array_push($data, $row);
	}
	
class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'A4',
  		'orientation'=>'L'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
		
		$jdl = "$_REQUEST[awal] s/d $_REQUEST[akhir]";
		
		$dI = mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
		$dA = mysql_fetch_array(mysql_query("SELECT * FROM tbl_anggota WHERE id='$_REQUEST[id]' ORDER BY id DESC"));
		$umur = date("Y")-substr($dA[tgl_lahir],0,4);
		
		//header
		$this->Image('../../img/logo.gif',28,20,46);
		$this->SetFont("", "B", 15);
		$this->Ln(4);
		$this->Cell(55);
		$this->Cell(40,8,"$dI[nama]",0,0,'L');
		$this->Ln(14);
		$this->SetFont('Times','',10);
		$this->Cell(55);
		$this->Cell(40,8,"$dI[alamat]",0,0,'L');
		$this->Ln(14);
		
		$this->Cell(1, 10, "", 0, 1,'L');
		$this->Cell(0, 1, " ", "B");
		$this->SetFont("", "B", 12);
		$this->Ln(10);
		$this->SetX($left); $this->Cell(0, 10, "REKAM MEDIS", 0, 1,'C');
		$this->Ln(10);
			
		$this->SetFont("", "B", 10);		
		$this->Ln(10);
		$this->Cell(40,8,"DETAIL ANGGOTA",0,0,'L');	
		$this->Ln(20);
		
		$this->SetFont("", "", 10);
		$this->Cell(140,8,"NO. RM",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[kode_anggota]",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Nama Anggota",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[nama]",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Tanggal Lahir",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,date("d-m-Y", strtotime($dA['tgl_lahir'])),0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Umur",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,$umur." Tahun",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Alamat",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[alamat]",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Nama Istri/Suami",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[nama_si]",0,0,'L');
		$this->Ln(12);
		$this->Cell(140,8,"Nama Anak Pertama",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[nama_anak1]",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Nama Anak Kedua",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[nama_anak2]",0,0,'L');	
		$this->Ln(12);
		$this->Cell(140,8,"Nama Anak Ketiga",0,0,'L');	
		$this->Cell(10,8,":",0,0,'L');		
		$this->Cell(250,8,"$dA[nama_anak3]",0,0,'L');
		$this->Ln(30);	
		$this->Cell(0, 1, " ", "B");
		$this->Ln(10);	
			
		$this->SetFont("", "B", 10);		
		$this->Ln(10);
		$this->Cell(40,8,"DETAIL PASIEN",0,0,'L');	
		$this->Ln(20);
		
        $qB = mysql_query("SELECT * FROM tbl_diagnosa_vw WHERE kode_anggota='$dA[kode_anggota]'");
        while($dB = mysql_fetch_array($qB))
	        {
			$this->SetFont("", "", 10);
			$this->Cell(140,8,"Tanggal Berobat",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');		
			$this->Cell(250,8,"$dB[tanggal]",0,0,'L');	
			$this->Ln(12);
			$this->Cell(140,8,"Nama pasien",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');		
			$this->Cell(250,8,"$dB[pasien]",0,0,'L');	
			$this->Ln(12);
			$this->Cell(140,8,"Keluhan",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');		
			$this->Cell(250,8,"$dB[keluhan]",0,0,'L');	
			$this->Ln(12);
			$this->Cell(140,8,"Nama Dokter",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');		
			$this->Cell(250,8,"$dB[nama]",0,0,'L');	
			$this->Ln(12);
			$this->Cell(140,8,"Diagnosa Dokter",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');		
			$this->Cell(250,8,"$dB[diagnosa]",0,0,'L');	
			$this->Ln(12);
			$this->Cell(140,8,"Obat",0,0,'L');	
			$this->Cell(10,8,":",0,0,'L');	

			if(!empty($dB['obat1']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat1]'"));	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat2']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat2]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat3']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat3]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat4']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat4]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat5']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat5]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat6']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat6]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat7']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat7]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat8']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat8]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat9']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat9]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			if(!empty($dB['obat10']))
				{
            	$dC = mysql_fetch_array(mysql_query("SELECT * FROM tbl_obat WHERE id='$dB[obat10]'"));
				$this->Cell(140,8,"",0,0,'L');	
				$this->Cell(10,8,"",0,0,'L');	
				$this->Cell(250,8,"$dC[nama]",0,0,'L');	
				$this->Ln(12);
	       		}
			$this->Ln(20);
	       	}
		
		
		}

		public function printPDF () {
					
			if ($this->options['paper_size'] == "A4") {
				$a = 8.3 * 72; //1 inch = 72 pt
				$b = 13.0 * 72;
				$this->FPDF($this->options['orientation'], "pt", array($a,$b));
			} else {
				$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
			}
			
			$this->SetAutoPageBreak(false);
			$this->AliasNbPages();
			$this->SetFont("helvetica", "B", 10);
			//$this->AddPage();
		
			$this->rptDetailData();
					
			$this->Output($this->options['filename'],$this->options['destinationfile']);
		}
		
		private $widths;
		private $aligns;

		function SetWidths($w)
		{
			//Set the array of column widths
			$this->widths=$w;
		}

		function SetAligns($a)
		{
			//Set the array of column alignments
			$this->aligns=$a;
		}

		function Row($data)
		{
			//Calculate the height of the row
			$nb=0;
			for($i=0;$i<count($data);$i++)
				$nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
			$h=10*$nb;
			//Issue a page break first if needed
			$this->CheckPageBreak($h);
			//Draw the cells of the row
			for($i=0;$i<count($data);$i++)
			{
				$w=$this->widths[$i];
				$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
				//Save the current position
				$x=$this->GetX();
				$y=$this->GetY();
				//Draw the border
				$this->Rect($x,$y,$w,$h);
				//Print the text
				$this->MultiCell($w,10,$data[$i],0,$a);
				//Put the position to the right of the cell
				$this->SetXY($x+$w,$y);
			}
			//Go to the next line
			$this->Ln($h);
		}

		function CheckPageBreak($h)
		{
			//If the height h would cause an overflow, add a new page immediately
			if($this->GetY()+$h>$this->PageBreakTrigger)
				$this->AddPage($this->CurOrientation);
		}

		function NbLines($w,$txt)
		{
			//Computes the number of lines a MultiCell of width w will take
			$cw=&$this->CurrentFont['cw'];
			if($w==0)
				$w=$this->w-$this->rMargin-$this->x;
			$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
			$s=str_replace("\r",'',$txt);
			$nb=strlen($s);
			if($nb>0 and $s[$nb-1]=="\n")
				$nb--;
			$sep=-1;
			$i=0;
			$j=0;
			$l=0;
			$nl=1;
			while($i<$nb)
			{
				$c=$s[$i];
				if($c=="\n")
				{
					$i++;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
					continue;
				}
				if($c==' ')
					$sep=$i;
				$l+=$cw[$c];
				if($l>$wmax)
				{
					if($sep==-1)
					{
						if($i==$j)
							$i++;
					}
					else
						$i=$sep+1;
					$sep=-1;
					$j=$i;
					$l=0;
					$nl++;
				}
				else
					$i++;
				}
			return $nl;
			}
		} //end of class

		//pilihan
		$options = array(
		'filename' => '', //nama file penyimpanan, kosongkan jika output ke browser
		'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
		'paper_size'=>'A4',	//paper size: A4, A3, A4, A5, Letter, Legal
		'orientation'=>'P' //orientation: P=portrait, L=landscape
		);
	
$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
