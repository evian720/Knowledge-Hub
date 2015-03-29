<?php
	foreach ($notifications as $request) {
		if($request->group_id == 0){
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
	}

	$unique_array = array();
	foreach ($notifications as $row) {
		if($row->group_id != 0){
			if(!array_key_exists($row->group_id, $unique_array)){
				$unique_array[$row->group_id] = array($row->knowledge_request_id, $row->group_id, $row->knowledge_title, $row->request_time);
			}
		}
	}


	foreach ($unique_array as $key => $value) {
			echo '
				<div class="col-sm-10">
				<h5>
						<strong>Teacher</strong> wants to recommend your knowledge <strong><u>' . $value[2] . '</u></strong> to others.

					<div class="row">
						<div class="messageaction pull-right">
							<a class="btn btn-success btn-xs" style="color: white;" onclick="accept_request(' . $value[0] . ')">Accept</a> 
							<a class="btn btn-danger btn-xs" style="color: white;" onclick="reject_request(' . $value[0] . ')">Decline</a>
						</div>
					</div>
					<small>
						<i class="fa fa-clock-o"></i> ' . $value[3] . '
					</small>
				</h5>
				</div>

			';
	}





			// $unique = array_unique();
			// echo '

			// 	<div class="col-sm-10">
			// 	<h5>
			// 			<strong>Teacher</strong> wants to recommend your knowledge <strong><u>' . $request->knowledge_title . '</u></strong> to others.

			// 		<div class="row">
			// 			<div class="messageaction pull-right">
			// 				<a class="btn btn-success btn-xs" style="color: white;" onclick="accept_request(' . $request->knowledge_request_id . ')">Accept</a> 
			// 				<a class="btn btn-danger btn-xs" style="color: white;" onclick="reject_request(' . $request->knowledge_request_id . ')">Decline</a>
			// 			</div>
			// 		</div>
			// 		<small>
			// 			<i class="fa fa-clock-o"></i> ' . $request->request_time . '
			// 		</small>
			// 	</h5>
			// 	</div>

			// ';
?>