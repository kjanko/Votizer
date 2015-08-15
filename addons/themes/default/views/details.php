<script type="text/javascript">
    {'
    google.load("visualization", "1", {packages:["corechart"]}); google.setOnLoadCallback(drawChart);
    function drawChart() { '}
    var data = google.visualization.arrayToDataTable([
        ["Votes", "Divided"],
        ["Unique votes",     {$graphData['in_votes']}],
        ["Unique visitors",      {$graphData['out_votes']}],
        ["Total visitors",  {$graphData['total_visitors']}]
    ]);
    {'
    var options = {
        pieSliceText: "none",
        tooltip : {  trigger: "none"   },
        pieHole: 0.4,
        legend: {positon:"right", alignment: "center"}
    };
    var chart = new google.visualization.PieChart(document.getElementById("donutchart"));
    chart.draw(data, options);}
    '}
</script>
<script>{"!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?'http':'https';if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+'://platform.twitter.com/widgets.js';fjs.parentNode.insertBefore(js,fjs);}}(document, 'script', 'twitter-wjs');"}</script>
<div id="fb-root"></div>
<script>
	(function(d, s, id) 
	{
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4";
		fjs.parentNode.insertBefore(js, fjs);
	}
	(document, 'script', 'facebook-jssdk'));
</script>
<div class="panel panel-default">
    <div class="panel-heading">{$site.title}</div>
    <div class="panel-body">
        <div class="panel panel-default col-md-4" style="padding:0">
            <div class="panel-heading">Info</div>
            <div style="padding: 5px 15px; font-size: 1.3em">

                <div class="row" style="padding:5px 0px; border-bottom: 1px solid #dadada">
                    <div class="col-md-2 text-center">Rank:</div>
                    <div class="col-md-9 col-md-offset-1 text-center">{$site.rank}</div>
                </div>

                <div class="row" style="padding:5px 0px; border-bottom: 1px solid #dadada">

                    <div class="col-md-2 text-center">Social:</div>
                    <div class="col-md-9 col-md-offset-1 text-center" style="max-height: 20px">

                        <span class='st_twitter_hcount' displayText='Tweet'></span>
                        <span class='st_facebook_hcount' displayText='Facebook'></span>

                    </div>
                </div>

                <div class="row" style="padding:5px 0px; border-bottom: 1px solid #dadada">
                    <div class="col-md-2 text-center">Website:</div>
                    <div class="col-md-9 col-md-offset-1 text-center">
                        <a href="<?php echo base_url(); ?>out/vote/{$site.id}">{$site.url}</a>
                    </div>
                </div>

                <div class="row" style="padding:5px 0px; border-bottom: 1px solid #dadada">
                    <div class="col-md-2 text-center">Added by:</div>
                    <div class="col-md-9 col-md-offset-1 text-center">{$site.username}</div>
                </div>

                <div class="row" style="padding:5px 0px;">
                    <div class="col-md-2 text-center">Vote:</div>
                    <div class="col-md-4 col-md-offset-2 text-center">
                        <button onclick="location.href='<?php echo base_url(); ?>in/vote/{$site.id}';" class="btn btn-primary custom btn-block">Vote</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default col-md-7 col-md-offset-1" style="padding:0">
            <div class="panel-heading">Description</div>
            <div style= "padding:10px; font-size: 1.3em">
                {$site.details_description}
            </div>
        </div>
        <div class="panel panel-default col-md-7 col-md-offset-1" style="padding:0">
            <div class="panel-heading">Statistics</div>
            <div class="col-md-4 text-center">
                <h4>{$site.in_votes}</h4>
                <h4>Unique visits</h4>
            </div>
            <div class="col-md-4 text-center">
                <h4>{$site.out_votes}</h4>
                <h4>Unique visits</h4>
            </div>
            <div class="col-md-4 text-center">
                <h4>{$site.total_visitors}</h4>
                <h4>Total visits</h4>
            </div>
            <div style= "padding:10px;margin-top:50px; font-size: 1.3em">
                <div id="donutchart" style="max-width: 900px; max-height: 500px;"></div>
            </div>
        </div>
        <div class="panel panel-default col-md-12" >
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES * * */
                var disqus_shortname = 'fasdfs';

                /* * * DON'T EDIT BELOW THIS LINE * * */
                (function() {
                    var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
                    dsq.src = '//' + disqus_shortname + '.disqus.com/embed.js';
                    (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
                })();
            </script>
            <noscript>Please enable JavaScript to view the <a href="https://disqus.com/?ref_noscript" rel="nofollow">comments powered by Disqus.</a></noscript>
        </div>

    </div>

        <script type="text/javascript">var switchTo5x=true;</script>
        <script type="text/javascript" src="http://w.sharethis.com/button/buttons.js"></script>
        <script type="text/javascript">
            stLight.options({
                publisher: "fa10bb63-77c5-42ba-8f10-86c2546ab604", doNotHash: false, doNotCopy: false, hashAddressBar: false
            });</script>

    <!--



        <div style="padding:5px 0px 10px 0px;border-bottom: 1px solid #dadada">
            <button onclick="location.href='<?php echo base_url(); ?>in/vote/{$site.id}';" class="btn btn-primary custom btn-block">Vote</button>
        </div>


        <div class="tab-content">

            <div id="home" class="tab-pane fade">
            </div>

            <div id="menu2" class="tab-pane fade">


            </div>

        </div>

    </div>
    -->
</div>
