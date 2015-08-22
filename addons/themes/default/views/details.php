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

<div class="panel panel-default">

    <div class="panel-heading">{$site.title}</div>
	
    <div class="panel-body">
			
			<div class="panel panel-default col-md-4" style="padding:0">
			
				<div class="panel-heading"><i class="fa fa-star"></i> Info</div>
				
				<table class="table table-striped table-bordered table-responsive">
				
					<tbody>
					
						<tr>
								<td  width="30%">Rank</td>
								<td>
									<strong>{$site.rank}</strong>							
								</td>
						</tr>
						
						<tr>
								<td>Social</td>
								<td>
									<div class="a2a_kit a2a_default_style">
										<a class="a2a_button_facebook"></a>
										<a class="a2a_button_twitter"></a>
										<a class="a2a_button_google_plus"></a>
									</div>
									<script type="text/javascript" src="//static.addtoany.com/menu/page.js"></script>
								</td>
							</tr>
							
							<tr>
								<td>Website</td>
								<td><a href="<?php echo base_url(); ?>out/vote/{$site.id}" class="btn btn-info btn-xs" role="button"><i class="fa fa-external-link-square"></i> Join now!</a></td>
							</tr>
							
							<tr>
								<td>Vote</td>
								<td><a href="<?php echo base_url(); ?>in/vote/{$site.id}" class="btn btn-danger btn-xs" role="button"><i class="fa fa-thumbs-o-up"></i> Vote for us!</a></td>
							</tr>
							
							<tr>
								<td>Join date</td>
								<td>{$site.date}</td>
							</tr>
						
					</tbody>
					
				</table>
				
				<div class="panel-heading"><i class="fa fa-line-chart"></i> Statistics</div>
				
				<div class="col-md-4 text-center details-statistics" style="padding: 0">
					<span class="statistics-votes">{$site.in_votes}</span>
					<h4>Unique Votes</h4>
				</div>
				<div class="col-md-4 text-center details-statistics">
					<span class="statistics-votes">{$site.out_votes}</span>
					<h4>Unique Visits</h4>
				</div>
				<div class="col-md-4 text-center details-statistics">
					<span class="statistics-votes">{$site.total_visitors}</span>
					<h4>Total Visits</h4>
				</div>
				
				<div class="col-md-12" style= "padding:10px; font-size: 1.3em">
					<div id="donutchart" style="max-width: 900px; max-height: 500px;"></div>
				</div>
			</div>
		
			<div class="panel panel-default col-md-8" style="margin-left: 10px; width: 65%; padding:0">
				<div class="panel-heading"><i class="fa fa-bookmark"></i> About us</div>
				<div style= "padding:10px; font-size: 1.3em">
					{$site.details_description}
				</div>
				
				<img style="margin: 0 auto; padding-bottom: 10px;" class="img-responsive" src="{$site.banner_url}" alt="banner" />

			</div>

        <div class="panel panel-default col-md-12" >
            <div id="disqus_thread"></div>
            <script type="text/javascript">
                /* * * CONFIGURATION VARIABLES * * */
                var disqus_shortname = '{$disqusShortname}';

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

</div>
