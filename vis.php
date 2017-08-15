<?php include 'config.php' ?>
<!DOCTYPE HTML>
<html lang="en">
    <head>     
        <?php
        $query = "zika";
        
        if (isset($_GET['id'])) {
            $query = $_GET['id'];
        }             

        if (isset($_GET['query'])) {
            $query = $_GET['query'];
        }

        $credit = "";

        $service_name = "";
        
        $service = "plos";

        if (!isset($_GET['service'])) {
            echo '<script type="text/javascript" src="./js/data-config_plos.js"></script>';
            $credit = '<a href="http://github.com/ropensci/rplos" target="_blank">rplos</a>. Content and metadata retrieved from <a href="https://www.plos.org/publications/journals/" target="_blank">Public Library of Science Journals</a>';

            $service_name = "PLOS";
        } else {
            $service = $_GET['service'];
            if ($service === "plos") {
                $credit = '<a href="http://github.com/ropensci/rplos" target="_blank">rplos</a>. Content and metadata retrieved from <a href="https://www.plos.org/publications/journals/" target="_blank">Public Library of Science Journals</a>';
                echo '<script type="text/javascript" src="./js/data-config_plos.js"></script>';
                $service_name = "PLOS";
            } else if ($service === "pubmed") {
                $credit = '<a href="https://github.com/ropensci/rentrez " target="_blank ">rentrez</a>. All content retrieved from <a href="http://www.ncbi.nlm.nih.gov/pubmed " target="_blank ">PubMed</a>';
                echo '<script type="text/javascript" src="./js/data-config_pubmed.js"></script>';
                $service_name = "PubMed";
            } else if ($service === "doaj") {
                $credit = '<a href="https://github.com/ropenscilabs/jaod " target="_blank ">jaod</a>. All content retrieved from <a href="http://doaj.org " target="_blank ">DOAJ</a>.';
                echo '<script type="text/javascript" src="./js/data-config_doaj.js"></script>';
                $service_name = "DOAJ";
            } else if ($service === "base") {
                $credit = '<a href="https://github.com/ropenscilabs/rbace" target="_blank ">rbace</a>. All content retrieved from <a href="http://base-search.net" target="_blank ">BASE</a>.';
                echo '<script type="text/javascript" src="./js/data-config_base.js"></script>';
                $service_name = "BASE";
            }
        }

        $title = "Overview of $service_name articles for $query - Open Knowledge Maps";

        include($COMPONENTS_PATH . 'head_bootstrap.php');
        include($COMPONENTS_PATH . 'head_standard.php');
        ?>

        <script>
            var intro = {
            title: "What's this?",
                    body: '<div class="description-headstart" style="max-width: 1000px"><div style="margin: 0 0 30px;"><p class="icon"><img src="./img/top100.png">            </p>             <p class="icon-description">An Open Knowledge Maps visualization presents you with a topical overview for a search term.                It is based on the <a href="faqs.php" target="_blank" class="underline">most relevant</a> papers in the chosen library.                            </p>        </div>        <div style="margin: 0 0 30px;">            <p class="icon"><img src="./img/textsimilarity.png">            </p>            <p class="icon-description">We use text similarity to create the knowledge maps.                The algorithm groups those papers together that have many words in common.            </p>        </div>        <div style="display: block;">            <p class="icon"><img src="./img/headstart-search.png"></p>            <p class="icon-description">The visualization is intended to give you a head start on your             literature search. You can also use Open Knowledge Maps to stay up-to-date - just limit your search to the most recent papers in the search options.            </p>        </div>'
            }
        </script>
    </head>

    <body class="vis">
        <?php include ($COMPONENTS_PATH . "header_search.php"); ?>

        <div style="padding-top:70px;">

            <?php
            require_once $LIB_PATH . 'MobileDetect/Mobile_Detect.php';
            $detect = new Mobile_Detect;
            if ($detect->isMobile()):
                ?>

            <script>
                //Enable overflow on mobile so you can pinch and zoom
                $(document).ready(function () {
                    $(".overflow-vis").css("overflow-y", "visible");
                })
            </script>

                <div class="alert alert-warning" id="mobile-warning">

                    <a href="#" class="close" data-dismiss="alert">&times;</a>

                    Open Knowledge Maps isn't optimized for mobile usage yet. We are working on a better mobile experience; in the meantime, you may encounter some rough edges.

                </div>

            <?php endif ?>

            <div class="overflow-vis">
               <!-- AddToAny BEGIN -->
<div class="a2a_kit a2a_kit_size_32 a2a_default_style">

    <div class="sharebutton"><a class="a2a_button_twitter"></a></div>
    <div class="sharebutton"><a class="a2a_button_facebook"></a></div>
    <div class="sharebutton"><a class="a2a_dd" href="https://www.addtoany.com/share"></a></div>
</div>
<script async src="https://static.addtoany.com/menu/page.js"></script>
<!-- AddToAny END -->
                <div id="visualization" style="background-color:white;"></div>
                
            </div>
            
            <script src="js/search_options.js"></script>  
            <script>
                var div_height = ($(document).height() < 750) ? (750) : ($(document).height());
                $("#visualization").css("height", div_height + "px")

                        data_config.server_url = "<?php echo $HEADSTART_URL ?>server/";
                data_config.intro = intro;
                //data_config.title = '<?php echo 'Overview of <span id="search-term-unique">' . $query . '</span> based on <span id="num_articles"></span> ' . $service_name . ' articles'; ?>';
                data_config.files = [{
                    title: <?php echo json_encode($query) ?>,
                    file: <?php echo json_encode($_GET['id']) ?>
                }]
                
                data_config.options = options_<?php echo $service ?>.dropdowns;
            </script>
            <script type="text/javascript" src="<?php echo $HEADSTART_URL ?>dist/headstart.js"></script>
            <script type="text/javascript">
                headstart.start();
            </script>

            <div class="builtwith">Built with <a href="http://github.com/pkraker/Headstart" target="_blank">Headstart</a> and <?php echo $credit ?>
            </div>
            <div id="faulty-map"><a href="faqs.php#faq-faulty-map" target="_blank">Not what you expected?</a>
            </div>
        </div>
        <link rel="stylesheet" href="<?php echo $HEADSTART_URL ?>dist/headstart.css">
        <link rel="stylesheet" href="./css/main.css">


        <?php
        include($COMPONENTS_PATH . 'moreinfo.php');
        //include($COMPONENTS_PATH . 'newsletter.php');
        include($COMPONENTS_PATH . 'footer.php');
        ?>