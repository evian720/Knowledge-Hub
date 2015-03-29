<?php

	foreach ($confirmations as $confirmation) {
		$url = base_url() .'index.php/main/request_confirmation/' . $confirmation->knowledge_request_id;
		echo '
            <li>
                <a href="' . $url . ' ">
                    <i class="fa fa-warning danger"></i>You have received a new piece of knowledge <strong><i><ins>' . $confirmation->knowledge_title . '</i></strong></ins>!
                </a>
            </li>

		';
	}
?>
