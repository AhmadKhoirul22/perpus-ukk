<?php
error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
$pdf = new FPDF('L', 'mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,7,'Laporan Denda',0,1,'C');
$pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(20,6,'No',1,0,'C');
$pdf->Cell(35,6,'Kode Peminjaman',1,0,'C');
$pdf->Cell(35,6,'Nama',1,0,'C');
$pdf->Cell(40,6,'Peminjaman',1,0,'C');
$pdf->Cell(45,6,'Pengembalian',1,0,'C');
$pdf->Cell(45,6,'Denda',1,1,'C');
// $pdf->Cell(45,6,'Bayar',1,1,'C');
$pdf->SetFont('Arial','',10);

// $this->db->from('pembelian a');
// $this->db->join('supplier b','a.id_supplier=b.id_supplier','left');
// $this->db->where('a.status','SELESAI');
// $penjualan = $this->db->get()->result();
$this->db->from('denda_peminjaman a');
$this->db->join('peminjaman b','b.kode_peminjaman = a.kode_peminjaman','left');
$this->db->join('user c','c.id_user = b.id_user','left');
$this->db->where('a.denda >',0);
$this->db->where('b.tanggal_peminjaman <=',$tanggal_2);
// tanggal kurang dari tanggal 2
$this->db->where('b.tanggal_peminjaman >=',$tanggal_1);
// tanggal lebih dari tanggal 1

$peminjaman = $this->db->get()->result_array();
$no=1;
$totalNominal=0;
foreach ($peminjaman as $data){
	// $no++;
	$pdf->Cell(20,6,$no++,1,0, 'C');
	$pdf->Cell(35,6,$data['kode_peminjaman'],1,0);
	$pdf->Cell(35,6,$data['nama'],1,0);
	$pdf->Cell(40,6,tanggal_indo($data['tanggal_peminjaman']),1,0);
	$pdf->Cell(45,6,tanggal_indo($data['tanggal_pengembalian']),1,0,'C');
	$pdf->Cell(45,6,'Rp '.number_format($data['denda']),1,1,'R');
	// $pdf->Cell(45,6,'Rp '.number_format($data->bayar),1,1,'R');
	$totalNominal += $data['denda'];
}
$pdf->SetFont('Arial','B',10);
$pdf->Cell(175,6,'Total Denda',1,0,'L');
$pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
$pdf->Output();
?>
