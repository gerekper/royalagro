<?php
namespace DynamicContentForElementor;

class LicenseSystem {

	public $license_key;

	public function __construct() {
		$this->init();
	}

	public function init() {
		$this->activation_advisor();

		// gestisco lo scaricamento dello zip aggiornato inviando i dati della licenza
		add_filter( 'upgrader_pre_download', array( $this, 'filter_upgrader_pre_download' ), 10, 3 );
		
		update_option( 'dce_license_activated',1 );
	}

	public function activation_advisor() {
		$license_activated = get_option( 'dce_license_activated' );
		$tab_license = ( isset( $_GET['tab'] ) && $_GET['tab'] == 'license' ) ? true : false;
		if ( ! $license_activated && ! $tab_license ) {
			add_action( 'admin_notices', '\DynamicContentForElementor\Notice::dce_admin_notice__license' );
			add_filter( 'plugin_action_links_' . DCE_PLUGIN_BASE, '\DynamicContentForElementor\License::dce_plugin_action_links_license' );
		}
	}

	// define the upgrader_pre_download callback
	public function filter_upgrader_pre_download( $false, $package, $instance ) {
		// ottengo lo slug del plugin corrente
		$plugin = false;
		if ( property_exists( $instance, 'skin' ) ) {
			if ( $instance->skin ) {
				if ( property_exists( $instance->skin, 'plugin' ) ) {
					// aggiornamento da pagina
					if ( $instance->skin->plugin ) {
						$pezzi = explode( '/', $instance->skin->plugin );
						$plugin = reset( $pezzi );
					}
				}
				if ( ! $plugin && isset( $instance->skin->plugin_info['TextDomain'] ) ) {
					// aggiornamento ajax
					$plugin = $instance->skin->plugin_info['TextDomain'];
				}
			}
		}
		// agisco solo per il mio plugin
		if ( $plugin == 'dynamic-content-for-elementor' || isset( $_POST['dce_version'] ) ) {
			return $this->upgrader_pre_download( $package, $instance );
		}
		return $false;
	}

	public function upgrader_pre_download( $package, $instance = null ) {
		// ora verifico la licenza per l'aggiornamento
		$license = 'dce-aaaa-bbbb-cccc-dddd-eeee-ff';
				
		// aggiungo quindi le info aggiuntive della licenza alla richiesta per abilitarmi al download
		$package .= ( strpos( $package, '?' ) === false ) ? '?' : '&';
		$package .= 'license_key=' . DCE_LICENSE . '&license_instance=' . DCE_INSTANCE;
		if ( get_option( 'dce_beta', false ) ) {
			$package .= '&beta=true';
		}
		self::plugin_backup();
		$download_file = download_url( $package );
		if ( is_wp_error( $download_file ) ) {
			return new \WP_Error( 'download_failed', __( 'Error downloading the update package', 'dynamic-content-for-elementor' ), $download_file->get_error_message() );
		}
		return $download_file;
	}

	public static function plugin_backup() {
		// do a zip of current version
		$dce_backup = ! get_option( 'dce_backup_disable' );
		if ( $dce_backup ) {
			// create zip in /wp-content/backup
			if ( ! is_dir( DCE_BACKUP_PATH ) ) {
				mkdir( DCE_BACKUP_PATH, 0755, true );
			}
			// Add to the directory an empty index.php
			if ( ! is_file( DCE_BACKUP_PATH . '/index.php' ) ) {
				$phpempty = "<?php\n//Silence is golden.\n";
				file_put_contents( DCE_BACKUP_PATH . '/index.php', $phpempty );
			}
			$outZipPath = DCE_BACKUP_PATH . '/dynamic-content-for-elementor_' . DCE_VERSION . '.zip';
			if ( is_file( $outZipPath ) ) {
				unlink( $outZipPath );
			}

			$options = array(
				'source_directory' => DCE_PATH,
				'zip_filename' => $outZipPath,
				'zip_foldername' => 'dynamic-content-for-elementor',
			);

			if ( extension_loaded( 'zip' ) ) {
				Helper::zip_folder( $options );
			}
		}
	}

	public static function call_api( $action, $license_key, $iNotice = false, $debug = false ) {
		global $wp_version;
		$args = array(
			'woo_sl_action' => $action,
			'licence_key' => $license_key,
			'product_unique_id' => 'WP-DCE-1',
			'domain' => DCE_INSTANCE,
			'api_version' => '1.1',
			'wp-version' => $wp_version,
			'version' => DCE_VERSION,
		);

		$request_uri = DCE_LICENSE_URL . '/api.php?' . http_build_query( $args );
		$data = wp_remote_get( $request_uri );
		$data_body = json_decode( $data['body'] );
		if ( is_array( $data_body ) ) {
			$data_body = reset( $data_body );
			$data_body->status_code == 's200';
		}
				
		if ( ( $action == 'status-check' && ( $data_body->status_code == 's200' || $data_body->status_code == 's205' ) ) ||
				( $action == 'activate' && ( $data_body->status_code == 's100' || $data_body->status_code == 's101' ) ) ||
				( $action == 'deactivate' && $data_body->status_code == 's201' ) ||
				( $action == 'plugin_update' && $data_body->status_code == 's401' ) ) {
			//the license is active and the software is active
			$message = 'License Activated!';
			$expiration_date = '2030.06.01';
			Notice::dce_admin_notice__success( $message );
		}
				
			//doing further actions like saving the license and allow the plugin to run
		
		return true;
	
	}

	public static function is_active( $data ) {
		
		return true;
	}

	public static function get_expiration_date( $data ) {
		
		return '2030.06.01';
	}

	public static function is_expired( $data ) {
		
		return false;
	}

	public static function do_rollback() {

		// rollback or reinstall
		if ( isset( $_POST['dce_version'] ) && sanitize_text_field( $_POST['dce_version'] ) ) {
			if ( $_POST['dce_version'] == DCE_VERSION ) {
				// same version...so no change :)
				$rollback = true;
			} else {
				$backup = DCE_BACKUP_PATH . '/dynamic-content-for-elementor_' . sanitize_file_name( $_POST['dce_version'] ) . '.zip';
				if ( is_file( $backup ) ) {
					// from local backup
					$roll_url = DCE_BACKUP_URL . '/dynamic-content-for-elementor_' . sanitize_file_name( $_POST['dce_version'] ) . '.zip';

				} else {
					// from server
					$roll_url = DCE_LICENSE_URL . '/last.php?v=' . sanitize_text_field( $_POST['dce_version'] );
				}

				ob_start();
				$wp_upgrader_skin = new \DynamicContentForElementor\Upgrader_Skin();
				$wp_upgrader = new \WP_Upgrader( $wp_upgrader_skin );
				$wp_upgrader->init();
				$rollback = $wp_upgrader->run(array(
					'package' => $roll_url,
					'destination' => DCE_PATH,
					'clear_destination' => true,
				));
				$roll_status = ob_get_clean();
			}
			if ( $rollback ) {
				exit( wp_safe_redirect( 'admin.php?page=dce_info' ) );
			} else {
				die( $roll_status );
			}
		}
	}

	public static function check_for_updates( $file ) {
		// Verify updates
		$info = self::check_for_updates_url();
		$myUpdateChecker = \Puc_v4_Factory::buildUpdateChecker(
			$info,
			$file,
			'dynamic-content-for-elementor'
		);
	}
	public static function check_for_updates_url() {
		// Verify updates
		$info = DCE_LICENSE_URL . '/info.php?s=' . DCE_INSTANCE . '&v=' . DCE_VERSION;
		if ( DCE_LICENSE ) {
			$info .= '&k=' . DCE_LICENSE;
		}
		if ( get_option( 'dce_beta', false ) ) {
			$info .= '&beta=true';
		}
		return $info;
	}

	public static function dce_plugin_action_links_license( $links ) {
		$links['license'] = '<a style="color:brown;" title="Activate license" href="' . admin_url() . 'admin.php?page=dce-license"><b>' . __( 'License', 'dynamic-content-for-elementor' ) . '</b></a>';
		return $links;
	}

	public static function dce_active_domain_check() {
		$dce_activated = 1;
		$dce_domain = base64_decode( get_option( 'dce_license_domain' ) );
		return true;
	}

	public static function dce_expired_license_notice() {
		$dce_expiration_date = get_option( 'dce_license_expiration' );
		
		return true;
	}

}
