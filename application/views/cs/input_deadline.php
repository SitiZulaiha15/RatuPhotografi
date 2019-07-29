<?php $this->load->view('./header'); ?>
<style type="text/css">
    .bs-example{
        margin: 20px;
    }
    .panel-title .glyphicon{
        font-size: 14px;
    }
</style>

<div class="inner-block">
    <div class="blank">
        <div class="bs-example">
            <div class="panel-group" id="accordion">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseOne"><span class="glyphicon glyphicon-plus"></span> What is HTML?</a>
                        </h4>
                    </div>
                    <div id="collapseOne" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>HTML stands for HyperText Markup Language. HTML is the standard markup language for describing the structure of web pages. <a href="https://www.tutorialrepublic.com/html-tutorial/" target="_blank">Learn more.</a></p>
                        </div>
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo"><span class="glyphicon glyphicon-plus"></span> What is Bootstrap?</a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>Bootstrap is a sleek, intuitive, and powerful front-end framework for faster and easier web development. It is a collection of CSS and HTML conventions. <a href="https://www.tutorialrepublic.com/twitter-bootstrap-tutorial/" target="_blank">Learn more.</a></p>
                        </div>

                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree"><span class="glyphicon glyphicon-plus"></span> What is CSS?</a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <p>CSS stands for Cascading Style Sheet. CSS allows you to specify various style properties for a given HTML element such as colors, backgrounds, fonts etc. <a href="https://www.tutorialrepublic.com/css-tutorial/" target="_blank">Learn more.</a></p>
                        </div>
                    </div>
                </div>
            </div>
            <p><strong>Note:</strong> Click on the linked heading text to expand or collapse accordion panels.</p>
        </div>
        <div class="clearfix"> </div> 
    </div>

</div>
<?php $this->load->view('./sidebar'); ?>
<script>
    $(document).ready(function () {
        // Add minus icon for collapse element which is open by default
//        $('html,body').animate({scrollTop: $(this).offset().top}, 200);
        $(".collapse.in").each(function () {
            $(this).siblings(".panel-heading").find(".glyphicon").addClass("glyphicon-minus").removeClass("glyphicon-plus");

        });

        // Toggle plus minus icon on show hide of collapse element
        $(".collapse").on('show.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-plus").addClass("glyphicon-minus");

        }).on('hide.bs.collapse', function () {
            $(this).parent().find(".glyphicon").removeClass("glyphicon-minus").addClass("glyphicon-plus");

//            Layout.scrollTo($(e.target), -100);
//            $('html,body').animate({scrollTop: $(this).offset().top}, 1000);
//            var scrollTop = $(".accordion").scrollTop();
//            var top = $(ui.newHeader).offset().top;
//            $('html,body').animate({scrollTop:$(this).scrollTop()+$(this).offset().top - 35}, "fast")
        });
        $('#accordion').on('shown.bs.collapse', function () {
//https://www.bootply.com/101026#
            var panel = $(this).find('.in');

            $('html, body').animate({
                scrollTop: panel.offset().top - 140
            }, 1000);

        });
    });
</script>