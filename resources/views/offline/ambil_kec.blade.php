<?php
if($id=="0"){
    ?>
<option value="">-Pilih Kecamatan-</option>
    <?php
}else{
    ?>
<option value="">-Pilih Kecamatan-</option>
<?php
    $daerah=DB::table("kecamatan")->where("regency_id",$id)->get();
    foreach ($daerah as $dr){
        if($kec=="0"){
            $kec_sel="";
        }else{
            if($kec==$dr->id){
               $kec_sel="selected"; 
            }else{
                $kec_sel="";
            }
        }
        ?>
        <option <?php echo $kec_sel ?> value="<?php echo $dr->id ?>"><?php echo $dr->name ?></option>
        <?php
    }
}
?>