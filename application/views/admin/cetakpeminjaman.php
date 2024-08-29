<?php
// $this->db->from('pembelian a');
// $this->db->join('supplier b','a.id_supplier=b.id_supplier','left');
// $this->db->where('a.status','SELESAI');
// $penjualan = $this->db->get()->result();
$this->db->from('detail a');
$this->db->join('peminjaman b','b.kode_peminjaman = a.kode_peminjaman','left');
$this->db->join('user c','c.id_user = b.id_user','left');
$this->db->join('buku d','d.id_buku = a.id_buku','left');
$this->db->where('b.tanggal_peminjaman <=',$tanggal_2);
// tanggal kurang dari tanggal 2
$this->db->where('b.tanggal_peminjaman >=',$tanggal_1);
// tanggal lebih dari tanggal 1
if($status == 1){
	$this->db->where('b.status','DIPINJAM');
} else if($status == 2){
	$this->db->where('b.status','DIKEMBALIKAN');
} else if($status == 3){

}

$peminjaman = $this->db->get()->result_array();
$no=1;
$totalNominal=0;

error_reporting(0); // AGAR ERROR MASALAH VERSI PHP TIDAK MUNCUL
$pdf = new FPDF('L', 'mm','Letter');
$pdf->AddPage();
$pdf->SetFont('Arial','B',16);
$pdf->Cell(0,7,'Laporan Peminjaman Buku',0,1,'C');
$pdf->Cell(0,7,tanggal_indo($tanggal_1).' sampai '.tanggal_indo($tanggal_2),0,1,'C');
$pdf->Cell(10,7,'',0,1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(10,6,'No',1,0,'C');
$pdf->Cell(35,6,'Nama',1,0,'C');
$pdf->Cell(35,6,'Judul',1,0,'C');
$pdf->Cell(35,6,'Kode Peminjaman',1,0,'C');
$pdf->Cell(35,6,'Peminjaman',1,0,'C');
$pdf->Cell(35,6,'Pengembalian',1,0,'C');
$pdf->Cell(35,6,'Kembali',1,0,'C');
$pdf->Cell(35,6,'Status',1,1,'C');
// $pdf->Cell(45,6,'Bayar',1,1,'C');
$pdf->SetFont('Arial','',10);


foreach ($peminjaman as $data){
	// $no++;
	$pdf->Cell(10,6,$no++,1,0, 'C');
	$pdf->Cell(35,6,$data['nama'],1,0);

	$this->db->from('detail')->where('kode_peminjaman',$data['kode_peminjaman']);
	$this->db->join('buku','buku.id_buku = detail.id_buku','left');
	$hai = $this->db->get()->result_array();

	$firstRow = true; // Menandakan baris pertama dari detail
	foreach ($hai as $det) {
	if (!$firstRow) {
	$pdf->Cell(10, 6, '', 1, 0); // Kosongkan kolom-kolom sebelumnya
	$pdf->Cell(35, 6, '', 1, 0); // Kosongkan kolom-kolom sebelumnya
	} else {
	$firstRow = false;
	}

	$pdf->Cell(35,6,$det['judul'],1,0);
	$pdf->Cell(35,6,$data['kode_peminjaman'],1,0);
	$pdf->Cell(35,6,tanggal_indo($data['tanggal_peminjaman']),1,0);
	$pdf->Cell(35,6,tanggal_indo($data['tanggal_pengembalian']),1,0);
	$pdf->Cell(35,6,tanggal_indo($data['tanggal_kembali']),1,0);
	$pdf->Cell(35,6,$data['status'],1,1,'C');
	// $pdf->Cell(45,6,'Rp '.number_format($data->bayar),1,1,'R');
	// $totalNominal += $data['denda'];
}
}
// $pdf->SetFont('Arial','B',10);
// $pdf->Cell(175,6,'Total Denda',1,0,'L');
// $pdf->Cell(45,6,'Rp '.number_format($totalNominal, 2),1,1,'R');
$pdf->Output();
?>
