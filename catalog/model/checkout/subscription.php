<?php
namespace Opencart\Catalog\Model\Checkout;
/**
 * Class Subscription
 *
 * @package Opencart\Catalog\Model\Checkout
 */
class Subscription extends \Opencart\System\Engine\Model {
	/**
	 * Add Subscription
	 *
	 * @param array<string, mixed> $data
	 *
	 * @return int
	 */
	public function addSubscription(array $data): int {
		if ($data['trial_status'] && $data['trial_duration']) {
			$trial_remaining = $data['trial_duration'] - 1;
			$remaining = $data['duration'];
		} elseif ($data['duration']) {
			$trial_remaining = $data['trial_duration'];
			$remaining = $data['duration'] - 1;
		} else {
			$trial_remaining = $data['trial_duration'];
			$remaining = $data['duration'];
		}

		if ($data['trial_status'] && $data['trial_duration']) {
			$date_next = date('Y-m-d', strtotime('+' . $data['trial_cycle'] . ' ' . $data['trial_frequency']));
		} else {
			$date_next = date('Y-m-d', strtotime('+' . $data['cycle'] . ' ' . $data['frequency']));
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "subscription` SET
			`order_product_id` = '" . (int)$data['order_product_id'] . "',
			`order_id` = '" . (int)$data['order_id'] . "',
			`store_id` = '" . (int)$data['store_id'] . "',
			`customer_id` = '" . (int)$data['customer_id'] . "',
			`payment_address_id` = '" . (int)$data['payment_address_id'] . "',
			`payment_method` = '" . $this->db->escape($data['payment_method'] ? json_encode($data['payment_method']) : '') . "',
			`shipping_address_id` = '" . (int)$data['shipping_address_id'] . "',
			`shipping_method` = '" . $this->db->escape($data['shipping_method'] ? json_encode($data['shipping_method']) : '') . "',
			`product_id` = '" . (int)$data['product_id'] . "',
			`option` = '" . $this->db->escape($data['option'] ? json_encode($data['option']) : '') . "',
			`quantity` = '" . (int)$data['quantity'] . "',
			`subscription_plan_id` = '" . (int)$data['subscription_plan_id'] . "',
			`trial_price` = '" . (float)$data['trial_price'] . "',
			`trial_frequency` = '" . $this->db->escape($data['trial_frequency']) . "',
			`trial_cycle` = '" . (int)$data['trial_cycle'] . "',
			`trial_duration` = '" . (int)$data['trial_duration'] . "',
			`trial_remaining` = '" . (int)$trial_remaining . "',
			`trial_status` = '" . (int)$data['trial_status'] . "',
			`price` = '" . (float)$data['price'] . "',
			`frequency` = '" . $this->db->escape($data['frequency']) . "',
			`cycle` = '" . (int)$data['cycle'] . "',
			`duration` = '" . (int)$data['duration'] . "',
			`remaining` = '" . (int)$trial_remaining . "',
			`date_next` = '" . $this->db->escape($date_next) . "',
			`comment` = '" . $this->db->escape($data['comment']) . "',
			`affiliate_id` = '" . (int)$data['affiliate_id'] . "',
			`marketing_id` = '" . (int)$data['marketing_id'] . "',
			`tracking` = '" . $this->db->escape($data['tracking']) . "',
			`language_id` = '" . (int)$data['language_id'] . "',
			`currency_id` = '" . (int)$data['currency_id'] . "',
			`ip` = '" . $this->db->escape($data['ip']) . "',
			`forwarded_ip` = '" . $this->db->escape($data['forwarded_ip']) . "',
			`user_agent` = '" . $this->db->escape($data['user_agent']) . "',
			`accept_language` = '" . $this->db->escape($data['accept_language']) . "',
			`date_added` = NOW(),
			`date_modified` = NOW()
		");

		return $this->db->getLastId();
	}

	/**
	 * Edit Subscription
	 *
	 * @param int                  $subscription_id
	 * @param array<string, mixed> $data
	 *
	 * @return void
	 */
	public function editSubscription(int $subscription_id, array $data): void {
		if ($data['trial_status'] && $data['trial_duration']) {
			$trial_remaining = $data['trial_duration'] - 1;
			$remaining = $data['duration'];
		} elseif ($data['duration']) {
			$trial_remaining = $data['trial_duration'];
			$remaining = $data['duration'] - 1;
		} else {
			$trial_remaining = $data['trial_duration'];
			$remaining = $data['duration'];
		}

		if ($data['trial_status'] && $data['trial_duration']) {
			$date_next = date('Y-m-d', strtotime('+' . $data['trial_cycle'] . ' ' . $data['trial_frequency']));
		} else {
			$date_next = date('Y-m-d', strtotime('+' . $data['cycle'] . ' ' . $data['frequency']));
		}

		$this->db->query("UPDATE `" . DB_PREFIX . "subscription` SET
			`order_id` = '" . (int)$data['order_id'] . "',
			`order_product_id` = '" . (int)$data['order_product_id'] . "',
			`store_id` = '" . (int)$data['store_id'] . "',
			`customer_id` = '" . (int)$data['customer_id'] . "',
			`payment_address_id` = '" . (int)$data['payment_address_id'] . "',
			`payment_method` = '" . $this->db->escape($data['payment_method'] ? json_encode($data['payment_method']) : '') . "',
			`shipping_address_id` = '" . (int)$data['shipping_address_id'] . "',
			`shipping_method` = '" . $this->db->escape($data['shipping_method'] ? json_encode($data['shipping_method']) : '') . "',
			`product_id` = '" . (int)$data['product_id'] . "',
			`option` = '" . $this->db->escape($data['option'] ? json_encode($data['option']) : '') . "',
			`quantity` = '" . (int)$data['quantity'] . "',
			`subscription_plan_id` = '" . (int)$data['subscription_plan_id'] . "',
			`trial_price` = '" . (float)$data['trial_price'] . "',
			`trial_frequency` = '" . $this->db->escape($data['trial_frequency']) . "',
			`trial_cycle` = '" . (int)$data['trial_cycle'] . "',
			`trial_duration` = '" . (int)$data['trial_duration'] . "',
			`trial_remaining` = '" . (int)$trial_remaining . "',
			`trial_status` = '" . (int)$data['trial_status'] . "',
			`price` = '" . (float)$data['price'] . "',
			`frequency` = '" . $this->db->escape($data['frequency']) . "',
			`cycle` = '" . (int)$data['cycle'] . "',
			`duration` = '" . (int)$data['duration'] . "',
			`remaining` = '" . (int)$remaining . "',
			`date_next` = '" . $this->db->escape($date_next) . "',
			`comment` = '" . $this->db->escape($data['comment']) . "',
			`affiliate_id` = '" . (int)$data['affiliate_id'] . "',
			`marketing_id` = '" . (int)$data['marketing_id'] . "',
			`tracking` = '" . $this->db->escape($data['tracking']) . "',
			`language_id` = '" . (int)$data['language_id'] . "',
			`currency_id` = '" . (int)$data['currency_id'] . "',
			`ip` = '" . $this->db->escape($data['ip']) . "',
			`forwarded_ip` = '" . $this->db->escape($data['forwarded_ip']) . "',
			`user_agent` = '" . $this->db->escape($data['user_agent']) . "',
			`accept_language` = '" . $this->db->escape($data['accept_language']) . "',
			`date_modified` = NOW()
			WHERE `subscription_id` = '" . (int)$subscription_id . "'
		");
	}

	/**
	 * Delete Subscription By Order ID
	 *
	 * @param int $order_id
	 *
	 * @return void
	 */
	public function deleteSubscriptionByOrderId(int $order_id): void {
		$this->db->query("DELETE FROM `" . DB_PREFIX . "subscription` WHERE `order_id` = '" . (int)$order_id . "'");
	}

	/**
	 * Get Subscription By Order Product ID
	 *
	 * @param int $order_id
	 * @param int $order_product_id
	 *
	 * @return array<string, mixed>
	 */
	public function getSubscriptionByOrderProductId(int $order_id, int $order_product_id): array {
		$subscription_data = [];

		$query = $this->db->query("SELECT * FROM  `" . DB_PREFIX . "subscription` WHERE `order_id` = '" . (int)$order_id . "' AND `order_product_id` = '" . (int)$order_product_id . "'");

		if ($query->num_rows) {
			$subscription_data = $query->row;

			$subscription_data['option'] = ($query->row['option'] ? json_decode($query->row['option'], true) : '');
			$subscription_data['payment_method'] = ($query->row['payment_method'] ? json_decode($query->row['payment_method'], true) : '');
			$subscription_data['shipping_method'] = ($query->row['shipping_method'] ? json_decode($query->row['shipping_method'], true) : '');
		}

		return $subscription_data;
	}

	/**
	 * Add History
	 *
	 * @param int    $subscription_id
	 * @param int    $subscription_status_id
	 * @param string $comment
	 * @param bool   $notify
	 *
	 * @return void
	 */
	public function addHistory(int $subscription_id, int $subscription_status_id, string $comment = '', bool $notify = false): void {
		$this->db->query("INSERT INTO `" . DB_PREFIX . "subscription_history` SET `subscription_id` = '" . (int)$subscription_id . "', `subscription_status_id` = '" . (int)$subscription_status_id . "', `comment` = '" . $this->db->escape($comment) . "', `notify` = '" . (int)$notify . "', `date_added` = NOW()");

		$this->db->query("UPDATE `" . DB_PREFIX . "subscription` SET `subscription_status_id` = '" . (int)$subscription_status_id . "' WHERE `subscription_id` = '" . (int)$subscription_id . "'");
	}

	/**
	 * Edit Subscription Status
	 *
	 * @param int  $subscription_id
	 * @param bool $subscription_status_id
	 *
	 * @return void
	 */
	public function editSubscriptionStatus(int $subscription_id, bool $subscription_status_id): void {
		$this->db->query("UPDATE `" . DB_PREFIX . "subscription` SET `subscription_status_id` = '" . (int)$subscription_status_id . "' WHERE `subscription_id` = '" . (int)$subscription_id . "'");
	}

	/**
	 * Edit Trial Remaining
	 *
	 * @param int $subscription_id
	 * @param int $trial_remaining
	 *
	 * @return void
	 */
	public function editTrialRemaining(int $subscription_id, int $trial_remaining): void {
		$this->db->query("UPDATE `" . DB_PREFIX . "subscription` SET `trial_remaining` = '" . (int)$trial_remaining . "' WHERE `subscription_id` = '" . (int)$subscription_id . "'");
	}

	/**
	 * Edit Date Next
	 *
	 * @param int    $subscription_id
	 * @param string $date_next
	 *
	 * @return void
	 */
	public function editDateNext(int $subscription_id, string $date_next): void {
		$this->db->query("UPDATE `" . DB_PREFIX . "subscription` SET `date_next` = '" . $this->db->escape($date_next) . "' WHERE `subscription_id` = '" . (int)$subscription_id . "'");
	}

	/**
	 * Get Subscriptions
	 *
	 * @param array<string, mixed> $data
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getSubscriptions(array $data): array {
		$sql = "SELECT `s`.`subscription_id`, `s`.*, CONCAT(`o`.`firstname`, ' ', `o`.`lastname`) AS `customer`, (SELECT `ss`.`name` FROM `" . DB_PREFIX . "subscription_status` `ss` WHERE `ss`.`subscription_status_id` = `s`.`subscription_status_id` AND `ss`.`language_id` = '" . (int)$this->config->get('config_language_id') . "') AS `subscription_status` FROM `" . DB_PREFIX . "subscription` `s` LEFT JOIN `" . DB_PREFIX . "order` `o` ON (`s`.`order_id` = `o`.`order_id`)";

		$implode = [];

		if (!empty($data['filter_subscription_id'])) {
			$implode[] = "`s`.`subscription_id` = '" . (int)$data['filter_subscription_id'] . "'";
		}

		if (!empty($data['filter_order_id'])) {
			$implode[] = "`s`.`order_id` = '" . (int)$data['filter_order_id'] . "'";
		}

		if (!empty($data['filter_order_product_id'])) {
			$implode[] = "`s`.`order_product_id` = '" . (int)$data['filter_order_product_id'] . "'";
		}

		if (!empty($data['filter_customer'])) {
			$implode[] = "CONCAT(`o`.`firstname`, ' ', `o`.`lastname`) LIKE '" . $this->db->escape($data['filter_customer'] . '%') . "'";
		}

		if (!empty($data['filter_date_next'])) {
			$implode[] = "DATE(`s`.`date_next`) = DATE('" . $this->db->escape($data['filter_date_next']) . "')";
		}

		if (!empty($data['filter_subscription_status_id'])) {
			$implode[] = "`s`.`subscription_status_id` = '" . (int)$data['filter_subscription_status_id'] . "'";
		}

		if (!empty($data['filter_date_from'])) {
			$implode[] = "DATE(`s`.`date_added`) >= DATE('" . $this->db->escape($data['filter_date_from']) . "')";
		}

		if (!empty($data['filter_date_to'])) {
			$implode[] = "DATE(`s`.`date_added`) <= DATE('" . $this->db->escape($data['filter_date_to']) . "')";
		}

		if ($implode) {
			$sql .= " WHERE " . implode(" AND ", $implode);
		}

		$sort_data = [
			's.subscription_id',
			's.order_id',
			's.reference',
			'customer',
			's.subscription_status',
			's.date_added'
		];

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY `s`.`subscription_id`";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}
}
