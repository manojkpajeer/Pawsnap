<section class="w3l-main-slider banner-slider position-relative" id="home">
    <div class="owl-one owl-carousel owl-theme">
        <?php
            $resSlider = mysqli_query($conn, "SELECT * FROM slider_master WHERE Status = 1 ORDER BY SL_ID DESC");
            if(mysqli_num_rows($resSlider)>0){

                while($rowSlider = mysqli_fetch_assoc($resSlider)){
                    ?>
                    <div class="item">
                        <div class="slider-info banner-view" style="background: url(./admin/<?php echo $rowSlider['Image'];?>) no-repeat center; background-size: cover;">
                            <div class="container">
                                <div class="banner-info header-hero-19">
                                    <h5><?php echo $rowSlider['Text']?></h5>
                                    <h3 class="title-hero-19"><?php echo $rowSlider['Title']?></h3>
                                    <p><?php echo $rowSlider['SubText']?></p>
                                    <?php
                                        if(!empty($rowSlider['Link'])){
                                            ?>
                                                <a href="<?php echo $rowSlider['Link']?>" class="btn btn-style btn-primary mt-sm-5 mt-4">Start Shopping <i class="fas fa-arrow-right ms-lg-3 ms-2"></i></a>
                                            <?php
                                        }
                                        ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
            } else {
                ?>
                <div class="item">
                    <div class="slider-info banner-view banner-top1">
                        <div class="container">
                            <div class="banner-info header-hero-19">
                                <h5></h5>
                                <h3 class="title-hero-19"></h3>
                                <p></p>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }
        ?>
    </div>
</section>