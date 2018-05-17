<div class="banner-agents is-available js-agent-queue" style="display:none">

    <div class="row">

        <span class="cta"><strong>HURRY!</strong> Call Right Now to Speak with an Agent!</span>
        <div class="agents-available-box">
            <span class="count"><? echo $agentQueueData["available"]; ?></span>
            <span class="description">Agents<br>Available</span>
        </div> <!--/.agents-available-box-->

        <div class="express-service">
            <p><span>Call our Express Service Line Now!</span></p>
            <span class="h-phone"><?=$sitePhone?></span>
        </div> <!--/.express-service-->

    </div> <!-- END .row -->

</div> <!--/.banner-agents .is-available-->

<div class="banner-agents is-unavailable js-agent-queue" style="display:block">

    <div class="row">

        <div class="express-service">
            <span>Call our Express Service Line Now!</span>
            <span class="h-phone"><?=$sitePhone?></span>
        </div> <!--/.express-service-->

    </div> <!-- END .row -->

</div> <!--/.banner-agents .is-unavailable-->
