<?php

namespace App\Http\Controllers;

use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Intervention\Image\ImageManagerStatic as Images;

class c_terima extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        return view("terima.terima");
    }

    public function terima_qrcode()
    {
        return view("terima.terima_qrcode");
    }

    public function detail($id, $o) {
        return view("terima.terima_detail", compact("id", "o"));
    }
    
    

    public function cek_regris(Request $req) {
        $cek_1 = DB::table("tb_psb")->where("no_regristrasi", $req->no)->count();
        if ($cek_1 > 0) {
            $data = DB::table("tb_psb")->where("no_regristrasi", $req->no)->first();
            $cek_2 = DB::table("tb_person")
                    ->where("nik", $data->nik)
                    ->count();
            if ($cek_2 > 0) {
                return "M";
            } else {
                return $req->no;
            }
        } else {
            return "N";
        }
    }

    public function terima_simpan(Request $req) {
        date_default_timezone_set('Asia/Jakarta');

        function IndonesiaTgl($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = "$thn-$bln-$tgl";
            return $awal;
        }

        function tgllahir($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = $tgl . $bln . $thn;
            return $awal;
        }

        function autonumber($barang, $primary, $prefix) {
            $t = date("Y");
            // $t = "2024";
            $q = DB::table($barang)->select(DB::raw('MAX(RIGHT(' . $primary . ',4)) as kd_max'))
                                    ->where(DB::raw('SUBSTRING(tgl_daftar, 1, 4)') , '=', $t);
            $prx = $prefix;
            if ($q->count() > 0) {
                foreach ($q->get() as $k) {
                    $tmp = ((int) $k->kd_max) + 1;
                    $kd = $prx . sprintf("%04s", $tmp);
                }
            } else {
                $kd = $prx . "0001";
            }

            return $kd;
        }

        $psb = DB::table("tb_psb")->where("no_regristrasi", $req->no)->first();
        if ($psb->jenis_kelamin == "Laki-Laki") {
            $urut1 = "01";
        } else {
            $urut1 = "02";
        }
        $urut2 = date("y");
        $urut3 = tgllahir(IndonesiaTgl($psb->tanggal_lahir));

        $niup = autonumber("tb_person", "niup", $urut1 . $urut2 . $urut3);

        function acakangkaqrCode($panjang) {
            $karakter = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $string = "";
            for ($i = 0; $i <= $panjang; $i++) {
                $pos = rand(0, strlen($karakter) - 1);
                $string .= $karakter[$pos];
            }
            return $string;
        }

        function qrCode($data, $nmQr)
        {
            $image =  QrCode::format('png')
                            ->merge(public_path('logo.png'), 0.3, true)
                            ->size(400)->errorCorrection('H')
                            ->margin(2)
                            ->generate($data, public_path('../gambar/'. $nmQr . '.png'));
            return  base64_encode($image);
        }
        $nmQr = acakangkaqrCode(20);
        $qrCode = qrCode($niup, $nmQr);


        $data = array();
        $data["niup"] = $niup;
        $data["nik"] = $psb->nik;
        $data["nama"] = $psb->nama;
        $data["tempat_lahir"] = $psb->tempat_lahir;
        $data["tanggal_lahir"] = IndonesiaTgl($psb->tanggal_lahir);
        $data["jenis_kelamin"] = $psb->jenis_kelamin;
        $data["dlm_klrg"] = $psb->dlm_klrg;
        $data["ank_ke"] = $psb->ank_ke;
        $data["sdr"] = $psb->sdr;
        $data["alamat_lengkap"] = $psb->alamat_lengkap;
        $data["desa"] = $psb->desa;
        $data["kec"] = $psb->kec;
        $data["kab"] = $psb->kab;
        $data["prov"] = $psb->prov;
        $data["pos"] = $psb->pos;
        $data["pndkn"] = $psb->pndkn;
        $data["nik_a"] = $psb->nik_a;
        $data["nm_a"] = $psb->nm_a;
        $data["tgl_lahir_a"] = $psb->tgl_lahir_a;
        $data["pndkn_a"] = $psb->pndkn_a;
        $data["pkrjn_a"] = $psb->pkrjn_a;
        $data["nik_i"] = $psb->nik_i;
        $data["nm_i"] = $psb->nm_i;
        $data["tgl_lahir_i"] = $psb->tgl_lahir_i;
        $data["pndkn_i"] = $psb->pndkn_i;
        $data["pkrjn_i"] = $psb->pkrjn_i;
        $data["nik_w"] = $psb->nik_w;
        $data["nm_w"] = $psb->nm_w;
        $data["pndkn_w"] = $psb->pndkn_w;
        $data["pkrjn_w"] = $psb->pkrjn_w;
        $data["pndptn_w"] = $psb->pndptn_w;
        $data["almt_w"] = $psb->almt_w;
        $data["desa_w"] = $psb->des_w;
        $data["kec_w"] = $psb->kec_w;
        $data["kab_w"] = $psb->kab_w;
        $data["prov_w"] = $psb->prov_w;
        $data["pos_w"] = $psb->pos_w;
        $data["hp_w"] = $psb->hp_w;
        $data["telp_w"] = $psb->telp_w;
        $data["foto_warna_santri"] = $psb->foto_warna_santri;
        $data["foto_wali_santri_warna"] = $psb->foto_wali_santri_warna;
        $data["foto_scan_kk"] = $psb->foto_scan_kk;
        $data["foto_scan_akta"] = $psb->foto_scan_akta;
        $data["foto_scan_skck"] = $psb->foto_scan_skck;
        $data["foto_scan_ket_sehat"] = $psb->foto_scan_ket_sehat;
        $data["status"] = "aktif";
        // $data["jenis_daftar"] = "online";
        $data["tgl_daftar"] = $psb->tgl_daftar;
        $data["qr_code_niup"] = $nmQr.'.png';
        
        $id = DB::table("tb_person")->insertGetId($data);
        if ($id) {
            return $id;
        } else {
            return "N";
        }
        // $cek_mahrom = DB::table("tb_psb_mahrom")->where("token", $psb->token)->count();
        // if ($cek_mahrom > 0) {
        //     $mahrom = DB::table("tb_psb_mahrom")->where("token", $psb->token)->get();

        //     foreach ($mahrom as $mr) {
        //         $mrh = array();
        //         // $mrh["id_person"] = $id;
        //         $mrh["nik_m"] = "098976543";
        //         $mrh["tanggal_lahir"] = "1999-11-19";
        //         $mrh["hubungan"] = $mr->status;
        //         $mrh["nama_mahrom"] = $mr->nama;
        //         $mrh["alamat_mahrom"] = "sjdf";
        //         $mrh["foto_diri"] = "djf";
        //         $mrh["foto_kk_atau_ktp"] = "dfsdf";
        //         DB::table("tb_mahrom")->insert($mrh);
        //     }

        //     $cek_sukses = DB::table("tb_mahrom1")->where("id_person", $id)->count();
        //     if ($cek_sukses > 0) {
        //         return $id;
        //     } else {
        //         return "N";
        //     }
        // } else {
        //     return $id;
        // }
    }

}
