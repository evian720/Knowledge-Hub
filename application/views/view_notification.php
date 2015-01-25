<?php
	foreach ($notifications as $request) {
		echo '

				<div class="col-sm-10">
				<h5>
						<strong>' . $request->first_name . ' ' . $request->last_name . '</strong> wants to get the knowledge <strong><u>' . $request->knowledge_title . '</u></strong> from you.

					<div class="row">
						<div class="messageaction pull-right">
							<a class="btn btn-success btn-xs" style="color: white;" onclick="accept_request(' . $request->knowledge_request_id . ')">Accept</a> 
							<a class="btn btn-danger btn-xs" style="color: white;" onclick="reject_request(' . $request->knowledge_request_id . ')">Decline</a>
						</div>
					</div>
					<small>
						<i class="fa fa-clock-o"></i> ' . $request->request_time . '
					</small>
				</h5>
				</div>

		';
	}
?>