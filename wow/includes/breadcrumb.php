<?php

class CHfw_breadCrumbEngine
{





    /**
     *page embed script / css
     *
     * @return mixed
     */
    public function BreadCrumbArchiveStaff()
    {
        ?>
        <div class="breadcrumb-container h125">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">

                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo __("All List", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName"><?php _e('DOCTORS', 'chfw-lang') ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     *page embed script / css
     *
     * @return mixed
     */


    public function BreadCrumbSingleResourceFamily()
    {
        ?>
        <div class="breadcrumb-container" style="height: 180px">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li>
                                <a itemprop="item" href="/departmans">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Departments", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>

                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo get_the_title() ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>

                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo">
                        <?php if ($image_location[0] != ""):
                            $doctor_main_info_container = "doctor-main-info-container";
                            ?>
                            <div id="doctorPhoto" class="col-sm-5">
                                <figure class="doc-img doctorImg-event">
                                    <?php mptt_event_template_content_thumbnail() ?>
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-sm-7 <?php echo $doctor_main_info_container ?>">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName">
                                    <br><?php echo get_the_title() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     *page embed script / css
     *
     * @return mixed
     */
    public function BreadCrumbSingleProveider($image_location, $doctor_main_info_container)
    {
        ?>
        <div class="breadcrumb-container" style="height: 150px;">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                            <span style="color: #005bd3"
                                  itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li>
                                <a itemprop="item" href="/departmans">
                            <span style="color: #005bd3"
                                  itemprop="name"><?php echo __("Departments", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo get_the_title() ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo">
                        <?php if ($image_location[0] != ""):
                            $doctor_main_info_container = "doctor-main-info-container";
                            ?>
                            <div id="doctorPhoto" class="col-sm-5">
                                <figure class="doc-img doctorImg-event">
                                    <?php mptt_event_template_content_thumbnail() ?>
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-sm-7 <?php echo $doctor_main_info_container ?>">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName">
                                    <br><?php echo get_the_title() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    /**
     *page embed script / css
     *
     * @return mixed
     */
    public function BreadCrumbSingleMpevent($image_location, $doctor_main_info_container)
    {
        ?>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li>
                                <a itemprop="item" href="/departmans/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Departments", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo get_the_title() ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo">
                        <?php if ($image_location[0] != ""):
                            $doctor_main_info_container = "doctor-main-info-container"; ?>
                            <div id="doctorPhoto" class="col-sm-5 col-md-69 col-xs-12 col-ms-12">
                                <figure class="doc-img doctorImg-event">
                                    <?php mptt_event_template_content_thumbnail() ?>
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-sm-7 col-md-69 col-xs-12 col-ms-12 <?php echo $doctor_main_info_container ?>">
                            <div class="breadcrumb-Sum">
                                <div class="col-sm-6">
                                    <h1 class="breadcrumb-InfoName"><?php echo get_the_title() ?></h1>
                                </div>
                                <div class="col-sm-6 hidden-xs hidden-sm">
                                    <a href="#content"
                                       class="btn btn-secondary booking"><?php echo __("Make An Appointment", 'chfw-lang') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    public function BreadCrumbSingleTReatment($image_location, $doctor_main_info_container)
    {?>
        <div class="breadcrumb-container">
            <div class="container">
                <nav class="breadCrumb">
                    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li>
                            <a itemprop="item" href="/">
                            <span style="color: #005bd3"
                                  itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li>
                            <a itemprop="item" href="/departmans">
                            <span style="color: #005bd3"
                                  itemprop="name"><?php echo __("Departments", 'chfw-lang') ?></span>
                            </a>
                            <meta itemprop="position" content="2">
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo get_the_title() ?></span>
                            </a>
                            <meta itemprop="position" content="3">
                        </li>
                    </ol>
                </nav>
                <div class="breadcrumb-topInfo row">
                    <?php if ($image_location[0] != ""):
                        $doctor_main_info_container = "doctor-main-info-container";
                        ?>
                        <div id="doctorPhoto" class="col-sm-5">
                            <figure class="doc-img doctorImg-event">
                                <?php mptt_event_template_content_thumbnail() ?>
                            </figure>
                        </div>
                    <?php endif ?>
                    <div id="doctorInfo" class="col-sm-7 <?php echo $doctor_main_info_container ?>">
                        <div class="breadcrumb-Sum">
                            <h1 class="breadcrumb-InfoName">
                                <br><?php echo get_the_title() ?></h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }
}

