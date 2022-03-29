<?php
    session_start();

    if(empty($_SESSION['is_shopping_admin_login'])){
        echo "<script>location.href='index.php';</script>";
    }

    require_once './assets/pages/admin-link.php';
    require_once './assets/pages/admin-header.php';
    require_once '../../assets/config/connect.php';

    if (isset($_POST['update'])) {

        $remarks = addslashes($_POST['remarks']); 

        if (mysqli_query($conn, "UPDATE boarding_master SET BoardingRemarks = '$remarks', BoardingStatus = '$_POST[status]',  
                DateApproved = NOW() WHERE BM_Id = '$_POST[a_id]'")) {

            echo "<script>alert('Yay, Request updated successfully..');</script>";     
        } else {

            echo "<script>alert('Oops, Unable to update request..');</script>";
        }
    }

?>
    
        <div id="layoutSidenav">
            <?php

                require_once './assets/pages/admin-sidebar.php';
            ?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid p-4">
                        <h3 class="mb-3">Manage Boarding Request</h1>
                        <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Owner Name</th>
                                            <th>Phone</th>
                                            <th>Location</th>
                                            <th>Date</th>
                                            <th>Recommended</th>
                                            <th>Pet Name</th>
                                            <th>Image</th>
                                            <th>Pet age</th>
                                            <th>Habbit</th>
                                            <th>Vaccination</th>
                                            <th>Illness</th>
                                            <th>Status</th>
                                            <th>Remarks</th>
                                            <th>Posted On</th>
                                            <th>Approved On</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $resd6 = mysqli_query($conn, "SELECT * FROM boarding_master ORDER BY BM_Id DESC");
                                        if (mysqli_num_rows($resd6) > 0) {

                                            $count = 1;
                                            while($rowd6 = mysqli_fetch_assoc($resd6)) {
                                                
                                                echo "<tr>"; 
                                                echo "<th>".$count."</th>"; 
                                                echo "<td>".$rowd6['OwnerName']."</td>"; 
                                                echo "<td>".$rowd6['PhoneNumber']."</td>"; 
                                                echo "<td>".$rowd6['Location']."</td>"; 
                                                echo "<td>".$rowd6['BoardingDate']."</td>"; 
                                                echo "<td>".$rowd6['Recomened']."</td>"; 
                                                echo "<td>".$rowd6['PetName']."</td>"; 
                                                echo "<td><img src='";
                                                if(empty($rowd6['PetImage'])){
                                                    echo "assets/images/other/img.png";
                                                }else{
                                                    echo $rowd6['PetImage'];
                                                }
                                                echo "' class='rounded-circle mr-2' width='40' height='40''></td>"; 
                                                echo "<td>".$rowd6['PetAge']."</td>"; 
                                                echo "<td>".$rowd6['PetHabbit']."</td>"; 
                                                echo "<td>".$rowd6['VaccinationDetails']."</td>"; 
                                                echo "<td>".$rowd6['IllnessDetails']."</td>"; 
                                                echo "<td>".$rowd6['BoardingStatus']."</td>"; 
                                                echo "<td>".$rowd6['BoardingRemarks']."</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['DateCreated']), 'd M, Y') . "</td>"; 
                                                echo "<td>".date_format(date_create($rowd6['DateApproved']), 'd M, Y') . "</td>"; 
                                                echo "<td>";
                                                ?>
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#modal<?php echo $rowd6['BM_Id'];?>"><i class='fa fa-thumbs-up'></i></a>
                                                <?php
                                                echo "</td>";
                                                echo "</tr>"; 

                                                $count++;

                                                ?>
                                                    <div class="modal fade" id="modal<?php echo $rowd6['BM_Id'];?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                                            <div class="modal-content">
                                                                <form method="POST" enctype="multipart/form-data">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalLongTitle">Edit Request</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body g-3 row">
                                                                        <input type="hidden" name="a_id" value="<?php echo $rowd6['BM_Id'];?>">

                                                                        <div class="col-sm-12 col-lg-12 col-md-6 mt-3">
                                                                            <label class="form-label">Status</label>
                                                                            <select class="form-control" id="validationCustom04" name="status" title="Please choose status">
                                                                                <option value="Requested" <?php if($rowd6['BoardingStatus']){echo 'selected';}?>>Requested</option>
                                                                                <option value="Approved" <?php if(!$rowd6['BoardingStatus']){echo 'selected';}?>>Approved</option>
                                                                                <option value="Closed" <?php if(!$rowd6['BoardingStatus']){echo 'selected';}?>>Closed</option>
                                                                                <option value="Rejected" <?php if(!$rowd6['BoardingStatus']){echo 'selected';}?>>Rejected</option>
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-sm-12 col-lg-12 col-md-12 mt-3">
                                                                            <label class="form-label">Remarks</label>
                                                                            <textarea class="form-control" name="remarks"><?php echo $rowd6['BoardingRemarks'];?></textarea>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                                                                    </div>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                        </table>
                    </div>
                </main>
            </div>
        </div>
    
<?php

    require_once './assets/pages/admin-footer.php';
?>
