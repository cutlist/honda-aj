
		<aside class="right-side">
			<section class="content">
			   <div class="row">
		            <div class="col-xs-12">
		                <div class="box box-primary">
		                    <div class="box-body table-responsive" style="overflow-y:auto;overflow-x:hidden;height:520px;">
			                    <div class="col-xs-12" style="margin:10px;cursor: pointer;">
			                	<h4>LAST LOGIN</h4>
			                        <table class="table table-hover" width="100%">
			                            <thead style="color:#666;font-size:13px">
			                                <tr>
			                                    <th style="padding:7px">LOGIN</th>
			                                    <th width="" style="padding:7px">USER</th>
			                                    <th width="" style="padding:7px">IP</th>
			                                    <th style="padding:7px">HOSTNAME</th>
			                                </tr>
			                            </thead>
			                            <tbody>
			                            <?
										$no=1;
										$q1 = mysql_query("SELECT * FROM log ORDER BY id DESC limit 0,200");
			                            while($d1 = mysql_fetch_array($q1))
			                            	{
			                            ?>
			                                <tr style="cursor:pointer">
			                                    <td><?echo $d1[login]?></td>
			                                    <td><?echo $d1[user]?></td>
			                                    <td><?echo $d1[ip]?></td>
			                                    <td><?echo $d1[hostname]?></td>
			                                </tr>
			                                
			                            <?
											$no++;
			                            	}
			                            ?>
			                            </tbody>
			                        </table>
	                           	</div>
                           	</div>
	       	 			</div>
	       	 		</div>
	       	 	</div>
			</section>
		</aside>