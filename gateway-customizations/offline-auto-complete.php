<?php
/**
 * Give Auto Approve Offline Donations
 *
 * If you would like to have donations skip the "pending" stage and auto-approve
 *
 * @param array $payment_args
 * @param array $payment_data
 *
 * @return array @$payment_args
 */
function give_auto_approve_offline_donations( $payment_args, $payment_data ) {

	// Ensure gateway is set and check for offline gateway
	if ( ! isset( $payment_data['gateway'] ) || $payment_data['gateway'] !== 'offline' ) {
		// Passthrough
		return $payment_args;
	}

	// Only pending donations
	if ( isset( $payment_args['post_status'] ) && $payment_args['post_status'] === 'pending' ) {
		// Set post_status to complete / publish
		$payment_args['post_status'] = 'publish';
	}

	return $payment_args;

}

add_filter( 'give_insert_payment_args', 'give_auto_approve_offline_donations', 999, 2 );
