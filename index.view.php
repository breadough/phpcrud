<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="//netdna.bootstrapcdn.com/font-awesome/3.2.1/css/font-awesome.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="script.js"></script>
    <link rel="stylesheet" href="style.css">
    <title>Ulapa!</title>
</head>

<body>
    <div class="container-fluid">

        <!-- Header -->
        <div class="jumbotron jumbotron-fluid pb-2">
            <div class="container">
                <h1 class="display-4">Hungry?</h1>
                <p class="lead">Don't know what to eat for dinner? Worry no more!</p>
                <p class="lead">Let us decide your ulam. Click the button to randomize.</p>
                <button type="button" class="btn btn-success" onclick=function_randomize()>Decide my Ulalam!</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddUlam" onclick="function_add_ulam_reset_properties()">Add a choice of Ulam! Yum!</button>
                <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modalListUlam">List of Ulam</button>
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalListShop">Order now!</button>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalAddShop">Add Shop</button>
            </div>
        </div>

        <!-- Content Main -->
                <div id="carousel" class="carousel slide" data-ride="carousel">
                    <div class="carousel-inner">
                        <?php $i = 0; ?>
                        <?php foreach($data_ulam as $ulam) : ?>
                            <?php if($i === 0): ?>
                                <div class="carousel-item active">
                            <?php else: ?>    
                                <div class="carousel-item">    
                            <?php endif; ?>        
                                <img class="d-block w-100 imgcustom" src="/img/<?=$ulam->imagepath?>">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5><?=$ulam->name?></h5>
                                    <p><?=$ulam->description?></p>
                                </div>
                                </div>
                            <?php $i++; ?>    
                        <?php endforeach ;?>
                    </div>
                </div>

        <!-- Modal Add Ulam -->
        <div class="modal fade" id="modalAddUlam" tabindex="-1" role="dialog" aria-labelledby="modalAddUlamLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form id="update_action_when_update" action="/add.php" method="post" enctype="multipart/form-data">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalAddUlamLabel">Ulala</h5>
                        </div>
                        <div class="modal-body">
                            <div class="input-group mb-3" hidden>
                                <input type="text" class="form-control" id="ulam_id" name="ulam_id">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ulam Name</span>
                                </div>
                                <input type="text" class="form-control" id="ulam_name" name="ulam_name">
                            </div>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">Ulam Description</span>
                                </div>
                                <input type="text" class="form-control" id="ulam_description" name="ulam_description">
                            </div>
                            <div id="hide_image_when_update" class="input-group mb-3">
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" id="ulam_picture" name="ulam_picture">
                                    <label class="custom-file-label" for="ulam_picture">Upload an Ulam Image</label>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button id="update_button_when_update" type="submit" class="btn btn-primary">Save Ulam Entry</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Render List of Ulam using modal -->
        <div class="modal fade" id="modalListUlam" tabindex="-1" role="dialog" aria-labelledby="modalListUlamLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalListUlamLabel">List of Ulam</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Settings</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach($data_ulam as $ulam) : ?>
                                <tr>
                                    <td><?=$ulam->name?></td>
                                    <td><?=$ulam->description?></td>
                                    <td><?=$ulam->imagepath?></td>
                                    <td>
                                        <i id="<?= "$ulam->id" ?>" class="icon-edit" onclick="function_update(this.id)"></i>
                                        <i id="<?= "$ulam->id" ?>" class="icon-trash" onclick="function_delete(this.id)"></i>
                                    </td>
                                </tr>
                            <?php endforeach ;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <!-- Render List of Shops using modal -->
        <div class="modal fade" id="modalListShop">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalListShopLabel">Available Restaurants</h5>
                    </div>
                    <div class="modal-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">Shop Name</th>
                                    <th scope="col">Location</th>
                                    <th scope="col">Link</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($data_shop as $shop) : ?>
                                    <tr>
                                        <td><?=$shop->name?></td>
                                        <td><?=$shop->location?></td>
                                        <td><a href="<?=$shop->website?>"><?=$shop->website?></a></td>
                                    </tr>
                                <?php endforeach ;?>
                            </tbody>
                        </table>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="modal fade" id="modalAddShop">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <form action="/addshop.php" method="post">
                    <div class="modal-header">
                        <h5 class="modal-title" id="modalAddShopLabel">Available Restaurants</h5>
                    </div>
                    <div class="modal-body">
                            <div class="form-group mb-2">
                                <span class="input-group-text">Restaurant's Name</span>
                                <input type="text" class="form-control" id="shop_name" name="shop_name">
                            </div>
                            <div class="form-group mb-2">
                                <span class="input-group-text">Location</span>
                                <input type="text" class="form-control" id="shop_location" name="shop_location">
                            </div>
                            <div class="form-group mb-2">
                                <span class="input-group-text">Website</span>
                                <input type="text" class="form-control" id="shop_website" name="shop_website">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Add Shop</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Congratulations modal -->
        <div class="modal fade" id="modalDisplayRandom" tabindex="-1" role="dialog" aria-labelledby="modalDisplayRandomLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="modalDisplayRandomLabel">Congratulations! You are eating</h2>
                    </div>
                    <div class="modal-body">
                        <h3 id="random_result_name">Adobob</h3>
                        <img id="random_result_image" class="d-block w-100" src="/img/adobo.jpg">
                        <h5 id="random_result_description">Ulapaaa!</h5>


                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>



    <!-- test -->
    <script>
    var indexArray = <?php echo json_encode($indexArray); ?>;
    </script>

    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>

</html>