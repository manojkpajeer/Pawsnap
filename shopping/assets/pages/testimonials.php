<?php
    $resTestinomial = mysqli_query($conn, "SELECT * FROM testmonial_master WHERE Status = 1 ORDER BY TM_Id DESC");
    if(mysqli_num_rows($resTestinomial)>0){
        ?>
        <section class="w3l-clients w3l-test" id="testimonials">
            <div class="container py-lg-5 py-md-4 pt-5 pb-5">
                <div class="row">
                    <div class="col-lg-4 testimonials-con-left-info py-sm-5 pt-0 py-3">
                        <div class="title-content text-left p-xl-3">
                            <h6 class="title-subw3hny">Reviews</h6>
                            <h3 class="title-w3l two">What Clients Say ?</h3>
                            <p class="test-p mt-3">Lorem ipsum viverra feugiat. Pellen tesque libero ut justo,
                                ultrices in ligula. Semper at tempufddfel.
                            </p>
                        </div>
                    </div>
                    <div class="col-lg-8 testimonials-con-right mt-lg-0 mt-3 p-xl-3 pb-4">
                        <div id="owl-demo2" class="owl-carousel owl-theme testimonials-2 py-sm-5 pt-0 py-3">
                        <?php
                            while($rowTestinomial = mysqli_fetch_assoc($resTestinomial)){
                                ?>
                                <div class="item">
                                    <div class="testimonial-content">
                                        <div class="testimonial">
                                            <p><i class="fas fa-quote-left me-2"></i> <?php echo $rowTestinomial['Message']?></p>
                                        </div>
                                        <div class="bottom-info mt-4">
                                            <a class="comment-img"><img src="./admin/<?php echo $rowTestinomial['Image']?>" class="img-fluid radius-image" alt="placeholder image"></a>
                                            <div class="people-info align-self">
                                                <h3><?php echo $rowTestinomial['UserName']?></h3>
                                                <p class="identity"><?php echo $rowTestinomial['Location']?></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php
                            }
                        ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <?php
    }
    ?>