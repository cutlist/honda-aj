<?php 
error_reporting(0);
session_start();

require_once("fpdf17/fpdf.php");

include "../../include/connect.php";
 
#ambil data dari DB dan masukkan ke array
$data  = array();

$sql   = mysql_query("SELECT * FROM tbl_anggota WHERE id='$_REQUEST[id]'");
	
while($row = mysql_fetch_array($sql)) 
	{
	array_push($data, $row);
	}
	
class FPDF_AutoWrapTable extends FPDF {
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
		
		$dI = mysql_fetch_array(mysql_query("SELECT * FROM identitas"));
		//header
		$this->Image('../../img/logo.gif',64,20,46);
		$this->SetFont("", "B", 15);
		$this->Ln(4);
		$this->Cell(410,8,"$dI[nama]",0,0,'C');
		$this->Ln(14);
		$this->SetFont('Times','',10);
		$this->Cell(410,8,"$dI[alamat]",0,0,'C');
		$this->Ln(14);
		
		$dA   = mysql_fetch_array(mysql_query("SELECT * FROM tbl_pendaftaran_vw WHERE id='$_REQUEST[id]'"));
		$this->Cell(1, 10, "", 0, 1,'L');
		$this->Cell(0, 1, " ", "B");
		$this->SetFont("", "B", 13);
		$this->Ln(10);
		$this->SetX($left); $this->Cell(0, 10, "KARTU ANTRIAN", 0, 1,'C');
		$this->Ln(17);
			
			
			$h = 18;
			$left = 40;
			$top = 80;	
			#tableheader
			$this->SetFont("", "B", 10);
			$this->SetFillColor(255,255,255);	
			$left = $this->GetX();
			$this->Cell(410,8,"NOMOR ANTRIAN",0,0,'C');
			$this->Ln(30);
			$this->SetFont("", "B", 42);
			$this->Cell(410,8,"$dA[no_antri]",0,0,'C');
			$this->Ln(30);
			$this->SetFont("", "", 10);
			$this->Cell(130,8,"WAKTU PENDAFTARAN",0,0,'L');
			$this->Cell(10,8,":",0,0,'L');
			$this->Cell(290,8,"$dA[input]",0,0,'L');
			$this->Ln(15);
			$this->Cell(130,8,"NAMA PASIEN",0,0,'L');
			$this->Cell(10,8,":",0,0,'L');
			$this->Cell(290,8,"$dA[nama]",0,0,'L');
			$this->Ln(15);
			$this->Cell(130,8,"NAMA DOKTER",0,0,'L');
			$this->Cell(10,8,":",0,0,'L');
			$this->Cell(290,8,"$dA[nama_dokter]",0,0,'L');
		}

		public function printPDF () {
					
			if ($this->options['paper_size'] == "A4") {
				$a = 4 * 72; //1 inch = 72 pt
				$b = 6.5 * 72;
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
			$nl=-2;
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
		'orientation'=>'L' //orientation: P=portrait, L=landscape
		);
	
$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
