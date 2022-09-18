
<option value="">-Pilih Desa-</option>
<?php
    $daerah=DB::table("desa")->where("district_id",$id)->get();
    foreach ($daerah as $dr){
        if($desa=="0"){
            $des_sel="";
        }else{
            if($desa==$dr->id){
                $des_sel="selected";
            }else{
                $des_sel="";
            }
        }
        ?>
        <option <?php echo $des_sel ?> value="<?php echo $dr->id ?>"><?php echo $dr->name ?></option>
        <?php
    }
?>