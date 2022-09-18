<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Yajra\Datatables\Datatables;
use Intervention\Image\ImageManagerStatic as Images;
use SimpleSoftwareIO\QrCode\Facades\QrCode; 


class c_offline extends Controller {

    public function __construct() {
        $this->middleware('auth:admin');
    }

    public function index() {
        return view("offline.offline");
    }

    public function form1($id, $st) {
        return view("offline.offline_tambah1", compact("id", "st"));
    }

    public function form2($id, $st) {
        return view("offline.offline_tambah2", compact("id", "st"));
    }

    public function form3($id, $st) {
        return view("offline.offline_tambah3", compact("id", "st"));
    }

    public function form4($id, $st) {
        return view("offline.offline_tambah4", compact("id", "st"));
    }
    
    public function upload($id) {
        return view("offline.upload", compact("id"));
    }
    
    public function detail($id) {
        return view("offline.detail", compact("id"));
    }

    public function simpan1(Request $req) {
        $data = array();
        $data["niup"] = "";
        $data["nik"] = "";
        $data["nama"] = "";
        $data["tempat_lahir"] = "";
        $data["tanggal_lahir"] = "2000-01-01"; // Tanggal Tidak Falid
        $data["jenis_kelamin"] = "0";
        $data["dlm_klrg"] = '0'; // Default Nol Bukan Kosong
        $data["ank_ke"] = "";
        $data["sdr"] = "";
        $data["alamat_lengkap"] = "";
        $data["desa"] = "";
        $data["kec"] = "";
        $data["kab"] = "";
        $data["prov"] = "";
        $data["pos"] = "";
        $data["pndkn"] = "";
        $data["nik_a"] = "";
        $data["nm_a"] = "";
        $data["tgl_lahir_a"] = "2000-01-01"; // Tanggal Tidak Falid
        $data["pndkn_a"] = "0";
        $data["pkrjn_a"] = "0";
        $data["nik_i"] = "";
        $data["nm_i"] = "";
        $data["tgl_lahir_i"] = "2000-01-01"; // Tanggal Tidak Falid
        $data["pndkn_i"] = "0";
        $data["pkrjn_i"] = "0";
        $data["nik_w"] = "";
        $data["nm_w"] = "";
        $data["pndkn_w"] = "0";
        $data["pkrjn_w"] = "0";
        $data["pndptn_w"] = "0"; // default NOl bukan Kosong
        $data["almt_w"] = "";
        $data["desa_w"] = "";
        $data["kec_w"] = "";
        $data["kab_w"] = "";
        $data["prov_w"] = "";
        $data["pos_w"] = "";
        $data["hp_w"] = "";
        $data["telp_w"] = "";
        $data["foto_warna_santri"] = "";
        $data["foto_wali_santri_warna"] = "";
        $data["foto_scan_kk"] = "";
        $data["foto_scan_akta"] = "";
        $data["foto_scan_skck"] = "";
        $data["foto_scan_ket_sehat"] = "";
        $data["status"] = "0";
        $data["tgl_daftar"] = "2000-01-01"; // Tanggal Tidak Falid
        $data["qr_code_niup"] = ""; // Tanggal Tidak Falid
        $id = DB::table("tb_person")->insertGetId($data);

        return $id;
    }

    public function simpan2(Request $req) {
        $data = array();
        $data["nik"] = $req->nik;
        $data["nama"] = $req->nama;
        $data["tempat_lahir"] = $req->tempat_lahir;
        $data["tanggal_lahir"] = $req->thn_lahir . "-"  . $req->bln_lahir. "-". $req->tgl_lahir ;
        $data["jenis_kelamin"] = $req->jk;
        $data["dlm_klrg"] = $req->status_anak;
        $data["ank_ke"] = $req->ank_ke;
        $data["sdr"] = $req->sdr;
        $data["alamat_lengkap"] = $req->alamat;
        $data["desa"] = $req->desa;
        $data["kec"] = $req->kecamatan;
        $data["kab"] = $req->kabupaten;
        $data["prov"] = $req->provinsi;
        $data["pos"] = $req->kodepos;
        $update = DB::table("tb_person")
                ->where("id_person", $req->id)
                ->update($data);
        if ($update == 0 || $update == 1) {
            return $req->id;
        } else {
            return "N";
        }
    }

    public function simpan3(Request $req) {
        $data = array();
        $data["nik_a"] = $req->nik_a;
        $data["nm_a"] = $req->nm_a;
        $data["pndkn_a"] = $req->pdkn_a;
        $data["pkrjn_a"] = $req->pkrjn_a;
        $data["tgl_lahir_a"] = $req->tahun_lahir_a . "-"  . $req->bulan_lahir_a. "-". $req->tanggal_lahir_a;
        $data["nik_i"] = $req->nik_i;
        $data["nm_i"] = $req->nm_i;
        $data["pndkn_i"] = $req->pdkn_i;
        $data["pkrjn_i"] = $req->pkrjn_i;
        $data["tgl_lahir_i"] = $req->tahun_lahir_i . "-"  . $req->bulan_lahir_i. "-". $req->tanggal_lahir_i;
        $update = DB::table("tb_person")
                ->where("id_person", $req->id)
                ->update($data);
        if ($update == 0 || $update == 1) {
            $cek = DB::table("tb_detail_mahrom")->where("id_person", $req->id)->count();
            if ($cek > 0) {
                $edit_ayah = DB::table("tb_mahrom")
                        ->join('tb_detail_mahrom', 'tb_mahrom.id_mahrom', '=', 'tb_detail_mahrom.id_mahrom')
                        ->where("id_person", $req->id)
                        ->where("hubungan", "Ayah")
                        ->update([
                            "nik_m" => $req->nik_a,
                            "nama_mahrom" => $req->nm_a,
                            "tanggal_lahir" => $req->tahun_lahir_a . "-"  . $req->bulan_lahir_a. "-". $req->tanggal_lahir_a,
                            "alamat_mahrom" => $req->alamat_lengkap,
                            "hubungan" => "Ayah",
                            "foto_diri" => "-",
                            "foto_kk_atau_ktp" => "-"
                        ]);
                $edit_ibu = DB::table("tb_mahrom")
                        ->join('tb_detail_mahrom', 'tb_mahrom.id_mahrom', '=', 'tb_detail_mahrom.id_mahrom')
                        ->where("id_person", $req->id)
                        ->where("hubungan", "Ibu")
                        ->update([
                            "nik_m" => $req->nik_i,
                            "nama_mahrom" => $req->nm_i,
                            "tanggal_lahir" =>  $req->tahun_lahir_i . "-"  . $req->bulan_lahir_i. "-". $req->tanggal_lahir_i,
                            "alamat_mahrom" => $req->alamat_lengkap,
                            "hubungan" => "Ibu",
                            "foto_diri" => "-",
                            "foto_kk_atau_ktp" => "-"
                        ]);
            } else {
                $da = array();
                $da["nik_m"] = $req->nik_a;
                $da["nama_mahrom"] = $req->nm_a;
                $da["tanggal_lahir"] =$req->tahun_lahir_a . "-"  . $req->bulan_lahir_a. "-". $req->tanggal_lahir_a;
                $da["hubungan"] = "Ayah";
                $da["alamat_mahrom"] = $req->alamat_lengkap;
                $da["foto_diri"] = "-";
                $da["foto_kk_atau_ktp"] = "-";
                $insert_a = DB::table("tb_mahrom")->insertGetId($da);

                $da_A = array();
                $da_A["id_person"] = $req->id;
                $da_A["id_mahrom"] = $insert_a;
                $insert_A = DB::table('tb_detail_mahrom')->insert($da_A);

                $di = array();
                $di["nik_m"] = $req->nik_i;
                $di["nama_mahrom"] = $req->nm_i;
                $di["tanggal_lahir"] = $req->tahun_lahir_i . "-"  . $req->bulan_lahir_i. "-". $req->tanggal_lahir_i;
                $di["hubungan"] = "Ibu";
                $di["alamat_mahrom"] = $req->alamat_lengkap;
                $di["foto_diri"] = "-";
                $di["foto_kk_atau_ktp"] = "-";
                $insert_i = DB::table("tb_mahrom")->insertGetId($di);

                $di_I = array();
                $di_I["id_person"] = $req->id;
                $di_I["id_mahrom"] = $insert_i;
                $insert_I = DB::table('tb_detail_mahrom')->insert($di_I);
            }
            return $req->id;
        } else {
            return "N";
        }
    }

    public function simpan4(Request $req) {
        date_default_timezone_set('Asia/Jakarta');
        $data = array();
        $data["nik_w"] = $req->nik_w;
        $data["nm_w"] = $req->nm_w;
        $data["pndkn_w"] = $req->pdkn_w;
        $data["hp_w"] = $req->nohp;
        $data["telp_w"] = $req->notelp;
        $data["pos_w"] = $req->kodepos;
        $data["pndptn_w"] = $req->pndptn_w;
        $data["pkrjn_w"] = $req->pkrjn_w;
        $data["almt_w"] = $req->alamat;
        $data["desa_w"] = $req->desa;
        $data["kec_w"] = $req->kecamatan;
        $data["kab_w"] = $req->kabupaten;
        $data["prov_w"] = $req->provinsi;
        $data["status"] = "aktif";
        $data["pndkn"] = $req->pndkn;
        // $data["jenis_daftar"] = "offline";
        
        $update = DB::table("tb_person")
                ->where("id_person", $req->id)
                ->update($data);
        if ($update == 0 || $update == 1) {
            return $req->id;
        } else {
            return "N";
        }
    }

    public function batal(Request $req) {
        $hapus = DB::table("tb_person")
                ->where("id_person", $req->id)
                ->delete();
        $cek_mahrom = DB::table('tb_detail_mahrom')->where('id_person', $req->id)->count();
        if ($cek_mahrom > 0) {
            $mahrom = DB::table("tb_detail_mahrom")->where("id_person", $req->id)->get();

            foreach ($mahrom as $mr) {
                $mrh = array();
                $mrh= $mr->id_mahrom;
                DB::table("tb_mahrom")->where("id_mahrom", $mrh)->delete();

                $mh = array();
                $mh= $mr->id_detail_mahrom;
                DB::table("tb_detail_mahrom")->where("id_detail_mahrom", $mh)->delete();
            }
        }
        
        if ($hapus == 1 ) {
            return "1";
        } else {
            return "2";
        }
    }

    public function ambil_kab(Request $req) {
        $id_provinsi = $req->id;
        $kab = $req->kab;
        return view("offline.ambil_kab", compact("id_provinsi", "kab"));
    }

    public function ambil_kec(Request $req) {
        $id = $req->id;
        $kec = $req->kec;
        return view("offline.ambil_kec", compact("id", "kec"));
    }

    public function ambil_desa(Request $req) {
        $id = $req->id;
        $desa = $req->desa;
        return view("offline.ambil_desa", compact("id", "desa"));
    }

    public function mahrom_data(Request $req) {

        function IndonesiaTgl($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = "$tgl-$bln-$thn";
            return $awal;
        }

        $users = DB::table('tb_mahrom')
                ->join('tb_detail_mahrom', 'tb_mahrom.id_mahrom', '=', 'tb_detail_mahrom.id_mahrom')
                ->where("id_person", $req->id);
                // ->orderByDesc('id_detail_mahrom');
        $datatables = Datatables::of($users);
        return $datatables->addIndexColumn()
                        ->addColumn('edit', function ($user) {
                            if ($user->hubungan == "Ayah" || $user->hubungan == "Ibu") {
                                $bt = '<div class="dropdown">
                                        <button class="btn btn-primary btn-xs dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Konfigurasi
                                        </button>
                                        <div class="dropdown-menu col-2" aria-labelledby="dropdownMenu2">
                                        <button id="' . $user->id_mahrom . '" class="bt_foto dropdown-item btn-xs" type="button">Foto</button>
                                        </div>
                                    </div>';
                            } else {
                                $bt = '<div class="dropdown">
                                        <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            Konfigurasi
                                        </button>
                                        <div class="dropdown-menu col-2" aria-labelledby="dropdownMenu2">
                                        <button id="' . $user->id_mahrom . '" class="bt_hapus dropdown-item btn-xs" type="button">Hapus</button>
                                        <button id="' . $user->id_mahrom . '" class="bt_foto dropdown-item btn-xs" type="button">Foto</button>
                                        </div>
                                    </div>';
                              
                            }
                            return $bt . "";
                        })
                        ->addColumn('upload_diri', function ($u){
                           $b = "<button class='btn btn-warning btn-xs dropdown-toggle' type='button' id='dropdownMenu2' data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                           Konfigurasi
                         </button>";
                         return $b;
                        })
                        ->rawColumns(['edit', 'gambar'])
                        ->make(true);
    }

    public function mahrom_simpan(Request $req) {
        $cek_kakek_ibu = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "kakek(dari ibu)")
                ->count();

        $cek_kakek_ayah = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "kakek(dari ayah)")
                ->count();

        $cek_nenek_ibu = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "nenek(dari ibu)")
                ->count();

        $cek_nenek_ayah = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "nenek(dari ayah)")
                ->count();

        // $ibu_susuan = DB::table("tb_detail_mahrom")
        //         ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
        //         ->where("id_person", $req->id)
        //         ->where("hubungan", "ibu(susuan)")
        //         ->count();

        $ayah_tiri = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "ayah tiri")
                ->count();

        $ibu_tiri = DB::table("tb_detail_mahrom")
                ->join('tb_mahrom', 'tb_detail_mahrom.id_mahrom', '=', 'tb_mahrom.id_mahrom')
                ->where("id_person", $req->id)
                ->where("hubungan", "ibu tiri")
                ->count();

        if ($cek_kakek_ibu > 0 && $req->hubungan == "kakek (Dari Ibu)") {
            return "3";
        }

        if ($cek_kakek_ayah > 0 && $req->hubungan == "Kakek (Dari Ayah)") {
            return "4";
        }

        if ($cek_nenek_ayah > 0 && $req->hubungan == "Nenek (Dari Ayah)") {
            return "5";
        }

        if ($cek_nenek_ibu > 0 && $req->hubungan == "Nenek (Dari Ibu)") {
            return "6";
        }

        if ($ibu_tiri > 0 && $req->hubungan == "Ibu Tiri") {
            return "7";
        }
        if ($ayah_tiri > 0 && $req->hubungan == "Ayah Tiri") {
            return "8";
        }

        $data = array();
        $data["nik_m"] = $req->nik;
        $data["nama_mahrom"] = $req->nama;
        $data["tanggal_lahir"] = $req->thn_lahir . "-"  . $req->bln_lahir. "-". $req->tgl_lahir;
        $data["alamat_mahrom"] = $req->alamat;
        $data["hubungan"] = $req->hubungan;
        $data["foto_diri"] ="-";
        $data["foto_kk_atau_ktp"] ="-";
        $idmhrm = DB::table("tb_mahrom")->insertGetId($data);
        
        $data_detail = array();
        $data_detail["id_person"] = $req->id;
        $data_detail["id_mahrom"] = $idmhrm;
        $simpan = DB::table("tb_detail_mahrom")->insert($data_detail);

        if ($simpan == 1) {
            return "1";
        } else {
            return "2";
        }
    }

    public function mahrom_hapus(Request $req) {

        $simpan_m = DB::table("tb_mahrom")
                ->where("id_mahrom", $req->id)
                ->delete();
        
        $simpan_m_de = DB::table('tb_detail_mahrom')
                ->where('id_mahrom', $req->id)
                ->delete();

        if ($simpan_m_de == 1) {
            return "1";
        } else {
            return "2";
        }
    }

    public function offline_selesai(Request $req) {
        date_default_timezone_set('Asia/Jakarta');
        function tgllahir($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = $tgl . $bln . $thn;
            return $awal;
        }

        function autonumber($barang, $primary, $prefix) {
            $to = date("Y");
            $q = DB::table($barang)->select(DB::raw('MAX(RIGHT(' . $primary . ',4)) as kd_max'))
                        ->where(DB::raw('substr(tgl_daftar, 1, 4)') , '=', $to);;
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

        $data = DB::table("tb_person")->where("id_person", $req->id)->first();
        if ($data->jenis_kelamin == "Laki-Laki") {
            $urut1 = "01";
        } else {
            $urut1 = "02";
        }

        $urut2 = date("y");
        $urut3 = tgllahir($data->tanggal_lahir);

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

        if ($data->niup == "") {
            $simpan = DB::table("tb_person")->where("id_person", $req->id)->update([
                "niup" => $niup,
                "tgl_daftar"=>date('Y-m-d H:i:s'),
                "qr_code_niup" => $nmQr .'.png'
            ]);
            if ($simpan == 0 || $simpan == 1) {
                return "1";
            } else {
                return "2";
            }
        } else {
            $dataQrLama = "gambar/".$data->qr_code_niup;
            if (file_exists($dataQrLama)) {
                unlink($dataQrLama);
                $simpan = DB::table("tb_person")->where("id_person", $req->id)->update([
                    "niup" => $niup,
                    "qr_code_niup" => $nmQr .'.png'
                ]);
                return "1";
            } else {
               return "2";
            }
            
        }
    }

    public function person_data(Request $req) {

        function IndonesiaTgl($tanggal) {
            $tgl = substr($tanggal, 8, 2);
            $bln = substr($tanggal, 5, 2);
            $thn = substr($tanggal, 0, 4);
            $awal = "$tgl-$bln-$thn";
            return $awal;
        }

        $users = DB::table('tb_person')
                ->where("status","aktif")
                ->orderBy("id_person", "desc");
        $datatables = Datatables::of($users);
        return $datatables->addIndexColumn()
                        ->addColumn('edit', function ($user) {
                            $bt = '<div class="dropdown">
                                <button class="btn btn-warning btn-xs dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                  Konfigurasi
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                                  <button id="' . $user->id_person . '" class="bt_edit dropdown-item btn-xs" type="button">Edit</button>
                                  <button id="' . $user->id_person . '" class="bt_detail dropdown-item btn-xs" type="button">Detail</button>
                                  <button id="' . $user->id_person . '" class="bt_upload dropdown-item btn-xs" type="button">Upload Berkas</button>
                                   <button id="' . $user->id_person . '" class="bt_print dropdown-item btn-xs" type="button">Print Surat dan Formulir</button>
                                </div>
                              </div>';
                            return $bt . "";
                        })
                        ->addColumn('ttl', function ($user) {
                            $bt = $user->tempat_lahir . "," . $user->tanggal_lahir;
                            return $bt . "";
                        })
                        ->addColumn('identitas', function ($user) {
                            $bt = "<table id='tb_identitas' style='border:0px;'>"
                                    . "<tr>"
                                    . "<td>NIUP</td><td>&nbsp;:&nbsp;</td><td>" . $user->niup . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td>NIK</td><td>&nbsp;:&nbsp;</td><td>" . $user->nik . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td>NAMA</td><td>&nbsp;:&nbsp;</td><td>" . $user->nama . "</td>"
                                    . "</tr>"
                                    . "<tr>"
                                    . "<td>QR CODE</td><td>&nbsp;:&nbsp;</td><td>"  .'<img src="http://localhost/adminpsb/gambar/'.$user->qr_code_niup.'" alt="" width="80" >'. "</td>"
                                    . "</tr>"
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
    
    
    public function upload_simpan(Request $req){
       $data=array();
       function acakangkahuruf($panjang) {
            $karakter = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
            $string = "";
            for ($i = 0; $i <= $panjang; $i++) {
                $pos = rand(0, strlen($karakter) - 1);
                $string .= $karakter[$pos];
            }
            return $string;
       }
       
    //    $ekstensi =  array('png','jpg','jpeg','gif');
       $filename1 = rand(00000, 99999) . acakangkahuruf(1) . "jpg";
       
       if($req->file("ft_santri")!=""){
           $ft_santri=Images::make($req->file("ft_santri"));
           $ft_santri->resize(500, null, function ($constraint) {
                 $constraint->aspectRatio();
           });
           if(file_exists($req->ft_santri_lama)){
               unlink($req->ft_santri_lama); 
           }
           $ft_santri->save("gambar/dokumen/scan_santri_".$filename1, 100);
           $data["foto_warna_santri"]="gambar/dokumen/scan_santri_".$filename1;
       }else{
           $data["foto_warna_santri"]=$req->ft_santri_lama;
       }
       
       if($req->file("ft_wali")!=""){
           $ft_wali=Images::make($req->file("ft_wali"));
           $ft_wali->resize(500, null, function ($constraint) {
            $constraint->aspectRatio();
           });
           if(file_exists($req->ft_wali_lama)){
                unlink($req->ft_wali_lama); 
           }
           $ft_wali->save("gambar/dokumen/scan_wali_santri_".$filename1, 100);
           $data["foto_wali_santri_warna"]="gambar/dokumen/scan_wali_santri_".$filename1;
       }else{
           $data["foto_wali_santri_warna"]=$req->ft_wali_lama;
       }
       
       
       if($req->file("ft_kk")!=""){
           $ft_kk=Images::make($req->file("ft_kk"));
           $ft_kk->resize(500, null, function ($constraint) {
             $constraint->aspectRatio();
           });
           if(file_exists($req->ft_kk_lama)){
                unlink($req->ft_kk_lama); 
           }
           $ft_kk->save("gambar/dokumen/scan_kk_".$filename1, 100);
           $data["foto_scan_kk"]="gambar/dokumen/scan_kk_".$filename1;
       }else{
           $data["foto_scan_kk"]=$req->ft_kk_lama;
       }
       
       if($req->file("ft_akta")!=""){
           $ft_akta=Images::make($req->file("ft_akta"));
           $ft_akta->resize(500, null, function ($constraint) {
             $constraint->aspectRatio();
           });
           if(file_exists($req->ft_akta_lama)){
              unlink($req->ft_akta_lama); 
           }
           $ft_akta->save("gambar/dokumen/scan_akta_". $filename1, 100);
           $data["foto_scan_akta"]="gambar/dokumen/scan_akta_".$filename1;
       }else{
           $data["foto_scan_akta"]=$req->ft_akta_lama;
       }
       
       
       
       if($req->file("ft_sehat")!=""){
           $ft_sehat=Images::make($req->file("ft_sehat"));
           $ft_sehat->resize(500, null, function ($constraint) {
             $constraint->aspectRatio();
           });
           if(file_exists($req->ft_sehat_lama)){
                unlink($req->ft_sehat_lama); 
           }
           $ft_sehat->save("gambar/dokumen/scan_surat_sehat_". $filename1, 100);
           $data["foto_scan_ket_sehat"]="gambar/dokumen/scan_surat_sehat_".$filename1;
       }else{
           $data["foto_scan_ket_sehat"]=$req->ft_sehat_lama;
       }
       
       
       if($req->file("ft_skck")!=""){
           $ft_skck=Images::make($req->file("ft_skck"));
           $ft_skck->resize(500, null, function ($constraint) {
                $constraint->aspectRatio();
           });
           if(file_exists($req->ft_skck_lama)){
                unlink($req->ft_skck_lama); 
             }
           $ft_skck->save("gambar/dokumen/scan_skck_". $filename1, 100);
           $data["foto_scan_skck"]="gambar/dokumen/scan_skck_".$filename1;
       }
    //    else{
    //        $data["foto_scan_skck"]=$req->ft_skck_lama;
    //    }
       
       //$data["pndkn"]=$req->pendidikan;
       $simpan=DB::table("tb_person")->where("id_person",$req->id)->update($data);
       if($simpan==0 || $simpan==1){
           return "1";
       }else{
           return "2";
       }
    }
    
    public function print_daftar($id, $o) {
        return view("offline.print", compact("id", "o"));
    }
    
    public function print_surat_santri($id) {
        return view("offline.pernyataan_santri", compact("id"));
    }
    
    public function print_surat_ortu($id) {
        return view("offline.pernyataan_ortu", compact("id"));
    }
    
    public function formulir($id) {
        return view("offline.formulir", compact("id"));
    }

}
