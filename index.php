<!DOCTYPE html>

<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <!-- CSS only -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">    </head>
    <div class="row justify-content-around">
        <div class="col-12 p-4 m-4">
            <center>
                <a href="index.php?filename=drug_1.json" class="btn btn-warning">Drug 1</a>
                <a href="index.php?filename=drug_2.json" class="btn btn-warning">Drug 2</a>
            </center>
        </div>
        <div class="col-6" >
            <body>
                <?php
                if (!isset($_GET['filename'])) {
                    $json_filename = "drug_1.json";
                } else {
                    $json_filename = $_GET['filename'];
                }
                //$json_filename=$_GET['filename'];
                $json = file_get_contents($json_filename);
                $json_data = json_decode($json, true);
                ?>
                <form action="/action_page.php">

                    <?php
                    for ($i = 0; $i < count($json_data['fields']); $i++) {
                        //print_r($json_data['fields'][$i]["label"]);
                        if ($json_data['fields'][$i]["type"] != "dropdown") {
                            ?>

                            <div class="form-group">
                                <label for="email"><?php echo $json_data['fields'][$i]["label"]; ?></label>
                                <?php
                                if ($json_data['fields'][$i]["isReadonly"] == true) {
                                    ?>
                                    <input type="<?php echo $json_data['fields'][$i]["type"]; ?>" readonly class="form-control" id="<?php echo $json_data['fields'][$i]["key"]; ?>" >
                                    <?php
                                } else {
                                    ?>
                                    <input type="<?php echo $json_data['fields'][$i]["type"]; ?>" class="form-control" id="<?php echo $json_data['fields'][$i]["key"]; ?>" >
                                    <?php
                                }
                                ?>
                            </div>


                            <?php
                        } else {
                            ?>
                            <div class="form-group">
                                <label for="email"><?php echo $json_data['fields'][$i]["label"]; ?></label>
                                <select class="form-select" >
                                    <?php
                                    foreach ($json_data['fields'][$i]["items"] as $value) {
                                        ?>
                                        <option value="<?php echo $value["value"] ?>"><?php echo $value["text"] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            <?php
                        }
                    }
                    ?>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
        </div>
    </div>
</body>
</html>
