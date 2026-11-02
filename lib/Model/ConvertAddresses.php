<?php

declare(strict_types=1);

/**
 * SPDX-FileCopyrightText: 2016-2024 Nextcloud GmbH and Nextcloud contributors
 * SPDX-FileCopyrightText: ownCloud, Inc.
 * SPDX-License-Identifier: AGPL-3.0-only
 */

namespace OCA\Mail\Model;

use Horde_Imap_Client_Data_Envelope;
use Horde_Mail_Rfc822_Address;
use Horde_Mail_Rfc822_List;

trait ConvertAddresses {
	private function hordeToAssoc(Horde_Mail_Rfc822_Address $address): array {
		return [
			'label' => $address->label,
			'email' => $address->bare_address,
		];
	}

	/**
	 * @param Horde_Imap_Client_Data_Envelope|Horde_Mail_Rfc822_List $envelope
	 * @return array
	 */
	protected function convertAddressList($envelope): array {
		$list = [];
		foreach ($envelope as $t) {
			if ($t instanceof Horde_Mail_Rfc822_Address) {
				$list[] = $this->hordeToAssoc($t);
			}
		}
		return $list;
	}
}
