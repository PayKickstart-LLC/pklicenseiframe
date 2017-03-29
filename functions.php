<?php
	/**
	 * Created by PhpStorm.
	 * User: rugge
	 * Date: 15/03/2017
	 * Time: 15:14
	 */

	require( 'PKLicense.php' );
	$pk_results = [];
	$PKLicense = new PKLicense( $auth_token );

	$thisURL = $_SERVER[ 'PHP_SELF' ];

	if( isset( $_GET[ 'action' ] ) AND $_GET[ 'action' ] == 'deactivate' ) {
		if( !isset( $_POST[ 'license_key' ] ) ) {
			die( 'no license key supplied' );
		}

		$license_key = $_POST[ 'license_key' ];

		if( $PKLicense->isValidPKLicense( $license_key ) ) {

			$results = $PKLicense->clearPKLicense( $license_key );
			die( 'pk license deactivated' );
		}
	}

	if( !empty( $email ) ) {

		$pk_licenses =  $PKLicense->getPKLicenses($campaign_id, $email);

		//print_r($pk_licenses);
		//die();

		if( isset( $pk_licenses->success ) && $pk_licenses->success ) {
			if( isset( $pk_licenses->data ) && count( $pk_licenses->data ) > 0 ) {
				$pk_results = $pk_licenses->data;
			}
		}
	}

