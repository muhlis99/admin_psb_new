<?php
if ($id_provinsi=="0") {
    ?>
    <option value="">-Pilih Kabupaten-</option>
    <?php
} else {
    ?>
    <option value="">-Pilih Kabupaten-</option>
    <?php
    $kabupaten = DB::table("kabupaten")->where("province_id", $id_provinsi)->get();
    foreach ($kabupaten as $kb) {
        if ($kab == "0") {
            $kab_sel = "";
        } else {
            if ($kab == $kb->id) {
                $kab_sel = "selected";
            } else {
                $kab_sel = "";
            }
        }
        ?>
        <option <?php echo $kab_sel ?> value="<?php echo $kb->id ?>"><?php echo $kb->name ?></option>
        <?php
    }
}
?>

