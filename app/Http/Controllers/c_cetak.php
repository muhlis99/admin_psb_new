<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Images;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Symfony\Component\HttpFoundation\StreamedResponse;
use PhpOffice\PhpSpreadsheet\Writer\Xls;

class c_cetak extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function siswa() {
        return view("cetak.siswa");
    }

    public function mahrom() {
        return view("cetak.mahrom");
    }
    
    public function mahrom_all() {
        return view("cetak.mahrom_all");
    }
    
    public function santri() {
        return view("cetak.santri");
    }
    
    public function cek(Request $req) {
        $cek=DB::table("tb_person")
                ->where("status","aktif")
                ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$req->tahun)
                ->count();
        if($cek>0){
            return "2";
        }else{
            return "1";
        }
    }
    
   

    public function siswa_print($status,$tahun) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A4', 'NO');
        $sheet->setCellValue('B4', 'NIUP');
        $sheet->setCellValue('C4', 'NIK');
        $sheet->setCellValue('D4', 'NAMA');
        $sheet->setCellValue('E4', 'TEMPAT LAHIR');
        $sheet->setCellValue('F4', 'TANGGAL LAHIR');
        $sheet->setCellValue('G4', 'JENIS KELAMIN');
        $sheet->setCellValue('H4', 'STATUS DALAM KELUARGA');
        $sheet->setCellValue('I4', 'ANAK KE');
        $sheet->setCellValue('J4', 'JUMLAH SAUDARA');
        $sheet->setCellValue('K4', 'ALAMAT LENGKAP');
        $sheet->setCellValue('L4', 'DESA');
        $sheet->setCellValue('M4', 'KECAMATAN');
        $sheet->setCellValue('N4', 'KABUPATEN');
        $sheet->setCellValue('O4', 'PROVINSI');
        $sheet->setCellValue('P4', 'KODE POS');
        $sheet->setCellValue('Q4', 'NAMA AYAH');
        $sheet->setCellValue('R4', 'PENDIDIKAN AYAH');
        $sheet->setCellValue('S4', 'PEKERJAAN AYAH');
        $sheet->setCellValue('T4', 'NAMA IBU');
        $sheet->setCellValue('U4', 'PENDIDIKAN IBU');
        $sheet->setCellValue('V4', 'PEKERJAAN IBU');
        $sheet->setCellValue('W4', 'NAMA WALI');
        $sheet->setCellValue('X4', 'PENDIDIKAN WALI');
        $sheet->setCellValue('Y4', 'PEKERJAAN WALI');
        $sheet->setCellValue('Z4', 'PENDAPATAN WALI');
        $sheet->setCellValue('AA4', 'ALAMAT WALI');
        $sheet->setCellValue('AB4', 'NO WA/ NO TELP WALI');
        
        $sheet->mergeCells("A2:AB2");
        $sheet->setCellValue('A2', 'DATA SISWA '.strtoupper($status)." TAHUN ANGKATAN : ".$tahun);
        
        $styleArray_header = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            )
        );
        $styleArray_all = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );
        $sheet->getStyle('A4:AB4')->applyFromArray($styleArray_header);
        $data = DB::table("tb_person")
                ->where(DB::raw('substr(tgl_daftar,1,4)'),"=",$tahun)
                ->where("pndkn", $status)->get();
        $no = 0;
        $row = 4;
        foreach ($data as $dt) {
            $desa_al = DB::table("desa")->where("id", $dt->desa)->first();
            $kec_al = DB::table("kecamatan")->where("id", $dt->kec)->first();
            $kab_al = DB::table("kabupaten")->where("id", $dt->kab)->first();
            $prov_al = DB::table("provinsi")->where("id", $dt->prov)->first();
            $no++;
            $row++;
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValueExplicit('B'.$row, $dt->niup, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C'.$row, $dt->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $dt->nama);
            $sheet->setCellValue('E' . $row, strtoupper($dt->tempat_lahir));
            $sheet->setCellValue('F' . $row, $dt->tanggal_lahir);
            $sheet->setCellValue('G' . $row, $dt->jenis_kelamin);
            $sheet->setCellValue('H' . $row, $dt->dlm_klrg);
            $sheet->setCellValue('I' . $row, $dt->ank_ke);
            $sheet->setCellValue('J' . $row, $dt->sdr);
            $sheet->setCellValue('K' . $row, $dt->alamat_lengkap);
            $sheet->setCellValue('L' . $row, $desa_al->name);
            $sheet->setCellValue('M' . $row, $kec_al->name);
            $sheet->setCellValue('N' . $row, $kab_al->name);
            $sheet->setCellValue('O' . $row, $prov_al->name);
            $sheet->setCellValue('P' . $row, $dt->pos);
            $sheet->setCellValue('Q' . $row, $dt->nm_a);
            $sheet->setCellValue('R' . $row, $dt->pndkn_a);
            $sheet->setCellValue('S' . $row, $dt->pkrjn_a);
            $sheet->setCellValue('T' . $row, $dt->nm_i);
            $sheet->setCellValue('U' . $row, $dt->pndkn_i);
            $sheet->setCellValue('V' . $row, $dt->pkrjn_i);
            $sheet->setCellValue('W' . $row, $dt->nm_w);
            $sheet->setCellValue('X' . $row, $dt->pndkn_w);
            $sheet->setCellValue('Y' . $row, $dt->pkrjn_w);
            $sheet->setCellValue('Z' . $row, $dt->pndptn_w);
            $sheet->setCellValue('AA' . $row, $dt->almt_w);
            $sheet->setCellValue('AB' . $row, $dt->hp_w . " - " . $dt->telp_w);
            $sheet->getStyle('A'.$row.':AB'.$row)->applyFromArray($styleArray_all);
        }
        $filename = "cetak_siswa_" . $status . "(".$tahun.").xls";
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        
        $writer = new Xls($spreadsheet);
        $response = new StreamedResponse(
                function () use ($writer) {
            $writer->save('php://output');
        }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
    
    public function mahrom_all_print($hal,$batas,$file) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $tahun = date('Y');
        $data = DB::table("tb_person")
                ->where("status","aktif")
                ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$tahun)
                ->skip($hal)->take($batas)
                ->orderBy("id_person","desc")
                ->get();
        $row=2;
        $styleArray_header = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => '6C7A89FF')
            )
        );
        
        $styleArray_header2 = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'E8E8E8FF')
            )
        );
        
        $styleArray_person = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );
        
        $styleArray_awal = [
                    'borders' => [
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
        $styleArray_akhir = [
                    'borders' => [
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
        
        
        foreach ($data as $dt){
            $sheet->setCellValue('B'.$row, 'NIUP');
            $sheet->setCellValue('C'.$row, 'NIK');
            $sheet->setCellValue('D'.$row, 'NAMA SANTRI');
            $sheet->setCellValue('E'.$row, 'TTL');
            $sheet->setCellValue('F'.$row, 'ALAMAT');
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_header);
            $mahrom=DB::table("tb_detail_mahrom")
                    ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                    ->where("id_person",$dt->id_person)
                    ->get();
            $jum_mahrom=DB::table("tb_detail_mahrom")
                    ->where("id_person",$dt->id_person)->count();
            
            $row++;
            $sheet->setCellValueExplicit('B'.$row, $dt->niup, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C'.$row, $dt->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D'.$row, $dt->nama);
            $sheet->setCellValue('E'.$row, strtoupper($dt->tempat_lahir).",".$dt->tanggal_lahir);
            $sheet->setCellValue('F'.$row, $dt->alamat_lengkap);
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_person);
            $row++;
            $sheet->mergeCells("B".$row.":F".$row);
            $sheet->setCellValue('B'.$row,"DATA MAHROM");
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_header2);
            $row++;
            $no=0;
            foreach ($mahrom as $mh){
               $sheet->mergeCells("B".$row.":F".$row);
               $no++;
               if($no==$jum_mahrom){
                   $sheet->getStyle('B'.$row.":F".$row)->applyFromArray($styleArray_akhir);
                   $sheet->setCellValue('B'.$row,$no.".".$mh->nama_mahrom."-[ ".$mh->hubungan." ]"); 
                   $row=$row+3;
               }else{
                   $sheet->getStyle('B'.$row.":F".$row)->applyFromArray($styleArray_awal);
                   $sheet->setCellValue('B'.$row,$no.".".$mh->nama_mahrom."-[ ".$mh->hubungan." ]"); 
                   $row++;
               }
            }
            
        }
        date_default_timezone_set('Asia/Jakarta');
        $filename = $file."_update(".date("d-m-Y H:i:s").").xls";
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        
        
        $writer = new Xls($spreadsheet);
        $response = new StreamedResponse(
                function () use ($writer) {
            $writer->save('php://output');
        }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
    
    public function mahrom_print($id) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        
        
        $row=2;
        $styleArray_header = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => '6C7A89FF')
            )
        );
        
        $styleArray_header2 = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            ),
            'fill' => array(
                'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                'startColor' => array('argb' => 'E8E8E8FF')
            )
        );
        
        $styleArray_person = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );
        
        $styleArray_awal = [
                    'borders' => [
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
        $styleArray_akhir = [
                    'borders' => [
                        'right' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'bottom' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                        'left' => [
                            'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                        ],
                    ],
                ];
                $tahun = date('Y');
            $dt= DB::table("tb_person")
                ->where("id_person",$id)
                ->where("status","aktif")
                ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$tahun)
                ->first();
        
            $sheet->setCellValue('B'.$row, 'NIUP');
            $sheet->setCellValue('C'.$row, 'NIK');
            $sheet->setCellValue('D'.$row, 'NAMA SANTRI');
            $sheet->setCellValue('E'.$row, 'TTL');
            $sheet->setCellValue('F'.$row, 'ALAMAT');
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_header);
            $mahrom=DB::table("tb_detail_mahrom")
                    ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                    ->where("id_person",$dt->id_person)
                    ->get();
            $jum_mahrom=DB::table("tb_detail_mahrom")
                    ->where("id_person",$dt->id_person)->count();
            
            $row++;
            $sheet->setCellValueExplicit('B'.$row, $dt->niup, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C'.$row, $dt->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D'.$row, $dt->nama);
            $sheet->setCellValue('E'.$row, strtoupper($dt->tempat_lahir).",".$dt->tanggal_lahir);
            $sheet->setCellValue('F'.$row, $dt->alamat_lengkap);
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_person);
            $row++;
            $sheet->mergeCells("B".$row.":F".$row);
            $sheet->setCellValue('B'.$row,"DATA MAHROM");
            $sheet->getStyle('B'.$row.':F'.$row)->applyFromArray($styleArray_header2);
            $row++;
            $no=0;
            foreach ($mahrom as $mh){
               $sheet->mergeCells("B".$row.":F".$row);
               $no++;
               if($no==$jum_mahrom){
                   $sheet->getStyle('B'.$row.":F".$row)->applyFromArray($styleArray_akhir);
                   $sheet->setCellValue('B'.$row,$no.".".$mh->nama_mahrom."-[ ".$mh->hubungan." ]"); 
                   $row=$row+3;
               }else{
                   $sheet->getStyle('B'.$row.":F".$row)->applyFromArray($styleArray_awal);
                   $sheet->setCellValue('B'.$row,$no.".".$mh->nama_mahrom."-[ ".$mh->hubungan." ]"); 
                   $row++;
               }
            }
            
        $filename = "cetak_mahrom_".$dt->niup."(".$dt->nama.").xls";
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        
        $writer = new Xls($spreadsheet);
        $response = new StreamedResponse(
                function () use ($writer) {
            $writer->save('php://output');
        }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
    
    public function santri_print($status,$tahun) {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A4', 'NO');
        $sheet->setCellValue('B4', 'NIUP');
        $sheet->setCellValue('C4', 'NIK');
        $sheet->setCellValue('D4', 'NAMA');
        $sheet->setCellValue('E4', 'TEMPAT LAHIR');
        $sheet->setCellValue('F4', 'TANGGAL LAHIR');
        $sheet->setCellValue('G4', 'JENIS KELAMIN');
        $sheet->setCellValue('H4', 'STATUS DALAM KELUARGA');
        $sheet->setCellValue('I4', 'ANAK KE');
        $sheet->setCellValue('J4', 'JUMLAH SAUDARA');
        $sheet->setCellValue('K4', 'ALAMAT LENGKAP');
        $sheet->setCellValue('L4', 'DESA');
        $sheet->setCellValue('M4', 'KECAMATAN');
        $sheet->setCellValue('N4', 'KABUPATEN');
        $sheet->setCellValue('O4', 'PROVINSI');
        $sheet->setCellValue('P4', 'KODE POS');
        $sheet->setCellValue('Q4', 'NIK AYAH');
        $sheet->setCellValue('R4', 'NAMA AYAH');
        $sheet->setCellValue('S4', 'TANGGAL LAHIR AYAH');
        $sheet->setCellValue('T4', 'PENDIDIKAN AYAH');
        $sheet->setCellValue('U4', 'PEKERJAAN AYAH');
        $sheet->setCellValue('V4', 'NIK IBU');
        $sheet->setCellValue('W4', 'NAMA IBU');
        $sheet->setCellValue('X4', 'TANGGAL LAHIR IBU');
        $sheet->setCellValue('Y4', 'PENDIDIKAN IBU');
        $sheet->setCellValue('Z4', 'PEKERJAAN IBU');
        $sheet->setCellValue('AA4', 'NIK WALI');
        $sheet->setCellValue('AB4', 'NAMA WALI');
        $sheet->setCellValue('AC4', 'PENDIDIKAN WALI');
        $sheet->setCellValue('AD4', 'PEKERJAAN WALI');
        $sheet->setCellValue('AE4', 'PENDAPATAN WALI');
        $sheet->setCellValue('AF4', 'ALAMAT WALI');
        $sheet->setCellValue('AG4', 'NO WA/ NO TELP WALI');
        $sheet->setCellValue('AH4', 'TANGGAL DAFTAR');
        
        $sheet->mergeCells("A2:AH2");
        $sheet->setCellValue('A2', 'DATA SANTRI '.strtoupper($status)." TAHUN ANGKATAN : ".$tahun);
        
        $styleArray_header = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            ),
            'font' => array(
                'bold' => true
            )
        );
        $styleArray_all = array(
            'borders' => array(
                'outline' => array(
                    'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                    'color' => array('argb' => '00000000'),
                ),
            )
        );
        $sheet->getStyle('A4:AH4')->applyFromArray($styleArray_header);
        $data = DB::table("tb_person")
                ->where("status","aktif")
                ->where(DB::raw('substr(tgl_daftar,1,4)'),"=",$tahun)
                ->where("jenis_kelamin", $status)->get();
        $no = 0;
        $row = 4;
        foreach ($data as $dt) {
            $desa_al = DB::table("desa")->where("id", $dt->desa)->first();
            $kec_al = DB::table("kecamatan")->where("id", $dt->kec)->first();
            $kab_al = DB::table("kabupaten")->where("id", $dt->kab)->first();
            $prov_al = DB::table("provinsi")->where("id", $dt->prov)->first();
            $no++;
            $row++;
            $sheet->setCellValue('A' . $row, $no);
            $sheet->setCellValueExplicit('B'.$row, $dt->niup, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValueExplicit('C'.$row, $dt->nik, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('D' . $row, $dt->nama);
            $sheet->setCellValue('E' . $row, strtoupper($dt->tempat_lahir));
            $sheet->setCellValue('F' . $row, $dt->tanggal_lahir);
            $sheet->setCellValue('G' . $row, $dt->jenis_kelamin);
            $sheet->setCellValue('H' . $row, $dt->dlm_klrg);
            $sheet->setCellValue('I' . $row, $dt->ank_ke);
            $sheet->setCellValue('J' . $row, $dt->sdr);
            $sheet->setCellValue('K' . $row, $dt->alamat_lengkap);
            $sheet->setCellValue('L' . $row, $desa_al->name);
            $sheet->setCellValue('M' . $row, $kec_al->name);
            $sheet->setCellValue('N' . $row, $kab_al->name);
            $sheet->setCellValue('O' . $row, $prov_al->name);
            $sheet->setCellValue('P' . $row, $dt->pos);
            $sheet->setCellValueExplicit('Q' . $row, $dt->nik_a, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('R' . $row, $dt->nm_a);
            $sheet->setCellValue('S' . $row, $dt->tgl_lahir_a);
            $sheet->setCellValue('T' . $row, $dt->pndkn_a);
            $sheet->setCellValue('U' . $row, $dt->pkrjn_a);
            $sheet->setCellValueExplicit('V' . $row, $dt->nik_i, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('W' . $row, $dt->nm_i);
            $sheet->setCellValue('X' . $row, $dt->tgl_lahir_i);
            $sheet->setCellValue('Y' . $row, $dt->pndkn_i);
            $sheet->setCellValue('Z' . $row, $dt->pkrjn_i);
            $sheet->setCellValueExplicit('AA' . $row, $dt->nik_w, \PhpOffice\PhpSpreadsheet\Cell\DataType::TYPE_STRING);
            $sheet->setCellValue('AB' . $row, $dt->nm_w);
            $sheet->setCellValue('AC' . $row, $dt->pndkn_w);
            $sheet->setCellValue('AD' . $row, $dt->pkrjn_w);
            $sheet->setCellValue('AE' . $row, $dt->pndptn_w);
            $sheet->setCellValue('AF' . $row, $dt->almt_w);
            $sheet->setCellValue('AG' . $row, $dt->hp_w . " - " . $dt->telp_w);
            $sheet->setCellValue('AH' . $row, $dt->tgl_daftar);
            $sheet->getStyle('A'.$row.':AH'.$row)->applyFromArray($styleArray_all);
        }
        $filename = "cetak_santri_" .$status."(".$tahun.").xls";
        foreach ($sheet->getColumnIterator() as $column) {
            $sheet->getColumnDimension($column->getColumnIndex())->setAutoSize(true);
        }
        
        $writer = new Xls($spreadsheet);
        $response = new StreamedResponse(
                function () use ($writer) {
            $writer->save('php://output');
        }
        );
        $response->headers->set('Content-Type', 'application/vnd.ms-excel');
        $response->headers->set('Content-Disposition', 'attachment;filename="' . $filename . '"');
        $response->headers->set('Cache-Control', 'max-age=0');
        return $response;
    }
    
    public function person_data(Request $req) {

        function IndonesiaTgl($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = "$tgl-$bln-$thn";
            return $awal;
        }
        $tahun = date('Y');
        $users = DB::table('tb_person')
                ->where("status","aktif")
                ->where(DB::raw('SUBSTRING(tgl_daftar,1,4)'),"=",$tahun)
                ->orderBy("id_person", "desc");
        $datatables = Datatables::of($users);
        return $datatables->addIndexColumn()
                        ->addColumn('edit', function ($user) {
                            $bt = '<a href="'.url("cetak_print_mahrom").'/'.$user->id_person.'">'
                                    . '<button class="btn btn-info btn-sm">'
                                    . '<i class="fas fa-print"></i>'
                                    . '<br>Cetak Mahrom</button>'
                                    . '</a>';
                            return $bt . "";
                        })
                        ->addColumn('ttl', function ($user) {
                            $bt = $user->tempat_lahir . "," . $user->tanggal_lahir;
                            return $bt . "";
                        })
                        ->addColumn('identitas', function ($user) {
                            $bt = "<table id='tb_identitas' style='border:0px;'>"
                                    . "<tr>"
                                    . "<td><b>NIUP</b></td><td>&nbsp;:&nbsp;</td><td>" . $user->niup . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>NIK</b></td><td>&nbsp;:&nbsp;</td><td>" . $user->nik . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>NAMA</b></td><td>&nbsp;:&nbsp;</td><td>" . $user->nama . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . ""
                                    . "</table>";
                            return $bt . "";
                        })
                        ->addColumn('berkas', function ($user) {
                            if ($user->foto_warna_santri == "") {
                                $fts = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $fts = "Ada";
                            }

                            if ($user->foto_wali_santri_warna == "") {
                                $ftw = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $ftw = "Ada";
                            }

                            if ($user->foto_scan_akta == "") {
                                $akta = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $akta = "Ada";
                            }

                            if ($user->foto_scan_skck == "") {
                                $skck = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $skck = "Ada";
                            }

                            if ($user->foto_scan_kk == "") {
                                $kk = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $kk = "Ada";
                            }

                            if ($user->foto_scan_ket_sehat == "") {
                                $sehat = "<span class='text-danger'>Tidak Ada</span>";
                            } else {
                                $sehat = "Ada";
                            }

                            $bt = "<table id='tb_identitas' style='border:0px;'>"
                                    . "<tr>"
                                    . "<td><b>Foto Santri</b></td><td>&nbsp;:&nbsp;</td><td>" . $fts . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>Foto Wali Santri</b></td><td>&nbsp;:&nbsp;</td><td>" . $ftw . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>Kartu Keluarga</b></td><td>&nbsp;:&nbsp;</td><td>" . $kk . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>Akta</b></td><td>&nbsp;:&nbsp;</td><td>" . $akta . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>SKCK</b></td><td>&nbsp;:&nbsp;</td><td>" . $skck . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td><b>Surat Sehat</b></td><td>&nbsp;:&nbsp;</td><td>" . $sehat . "</td>"
                                    . "</tr>"
                                    . ""
                                    . "</table>";
                            return $bt . "";
                        })
                        ->rawColumns(['edit', 'ttl', 'alamat', 'identitas', "berkas"])
                        ->make(true);
    }

}
