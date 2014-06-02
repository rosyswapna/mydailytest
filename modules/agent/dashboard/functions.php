<?php
function bill_status_description($status_id = gINVALID)
{
	switch ($status_id) {
		case BILL_STATUS_ACTIVE:$status_description="Active";break;
		case BILL_STATUS_WAITING_EMAIL_ACTIVATION:$status_description="Waiting Email Activation";break;
		case BILL_STATUS_SUSPENDED:$status_description="Suspended";break;
		case BILL_STATUS_DISABLED:$status_description="Disabled";break;
		default:$status_description = "";break;
	}
	return $status_description;
}

?>