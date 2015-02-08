<?php

	foreach ($confirmations as $confirmation) {
		$url = base_url() .'index.php/main/request_confirmation/' . $confirmation->knowledge_request_id;
		echo '
            <li>
                <a href="' . $url . ' ">
                    <i class="fa fa-warning danger"></i>Your request for <strong><i><ins>' . $confirmation->knowledge_title . '</i></strong></ins> is confirmed!
                </a>
            </li>

		';
	}
?>
