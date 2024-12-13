# Hyplancer Payout Calculator

Hyplancer Payout Calculator is a WordPress plugin designed to calculate estimated payouts for Hyplancers based on their $Blak Coin share. This plugin includes an admin settings page, public form display, and a monthly email reminder to update total income and Blak Coin values.

## Features

- Calculates estimated payouts for Hyplancers based on their $Blak Coin share.
- Provides an admin settings page to input total income and total Blak Coin.
- Sends a monthly email reminder to update total values.
- AJAX support for calculating payouts.

## Installation

1. **Upload the plugin files** to the `/wp-content/plugins/hyplancer-payout-calculator` directory, or install the plugin through the WordPress plugins screen directly.
2. **Activate the plugin** through the 'Plugins' screen in WordPress.
3. **Navigate to the settings page** to configure the total income and total Blak Coin values.

## Usage

1. **Admin Settings Page**: Go to `Settings > Hyplancer Payout` to update the total income and total Blak Coin values.
2. **Monthly Email Reminder**: The plugin sends a reminder email on the 28th of each month to update the total values.
3. **Payout Calculation**: Hyplancers can use the public form to input their Blak Coin share and calculate their estimated payout.

## Hooks and Actions

- **Activation Hook**: `register_activation_hook( __FILE__, 'hyplancer_activation' );`
- **Monthly Email Schedule**: `add_action( 'wp', 'hyplancer_schedule_email' );`
- **Send Monthly Email**: `add_action( 'hyplancer_monthly_email_event', 'hyplancer_send_monthly_email' );`
- **AJAX Actions**: 
  - `add_action( 'wp_ajax_hyplancer_calculate_payout', 'hyplancer_calculate_payout' );`
  - `add_action( 'wp_ajax_nopriv_hyplancer_calculate_payout', 'hyplancer_calculate_payout' );`

## Contributing

1. Fork the repository.
2. Create a new branch: `git checkout -b feature-branch-name`.
3. Make your changes.
4. Commit your changes: `git commit -am 'Add new feature'`.
5. Push to the branch: `git push origin feature-branch-name`.
6. Submit a pull request.

## License

This plugin is licensed under the MIT License. See the [LICENSE](LICENSE) file for more details.

## Author

**James-Hart Kingsley**

- [LinkedIn](https://www.linkedin.com/in/kingsley-james-hart-93679b184/?originalSubdomain=ng)

## Changelog

### 1.0
- Initial release.

