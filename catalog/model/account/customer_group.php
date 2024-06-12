<?php
namespace Opencart\Catalog\Model\Account;
/**
 * Class Customer Group
 *
 * @package Opencart\Catalog\Model\Account
 */
class CustomerGroup extends \Opencart\System\Engine\Model {
	/**
	 * Get Customer Group
	 *
	 * @param int $customer_group_id
	 *
	 * @return array<string, mixed>
	 */
	public function getCustomerGroup(int $customer_group_id): array {
		$query = $this->db->query("SELECT DISTINCT * FROM `" . DB_PREFIX . "customer_group` `cg` LEFT JOIN `" . DB_PREFIX . "customer_group_description` `cgd` ON (`cg`.`customer_group_id` = `cgd`.`customer_group_id`) WHERE `cg`.`customer_group_id` = '" . (int)$customer_group_id . "' AND `cgd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	/**
	 * Get Customer Groups
	 *
	 * @return array<int, array<string, mixed>>
	 */
	public function getCustomerGroups(): array {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "customer_group` `cg` LEFT JOIN `" . DB_PREFIX . "customer_group_description` `cgd` ON (`cg`.`customer_group_id` = `cgd`.`customer_group_id`) WHERE `cgd`.`language_id` = '" . (int)$this->config->get('config_language_id') . "' ORDER BY `cg`.`sort_order` ASC, `cgd`.`name` ASC");

		return $query->rows;
	}
}
