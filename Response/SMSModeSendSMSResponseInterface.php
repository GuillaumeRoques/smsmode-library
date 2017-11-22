<?php

/**
 * This file is part of the smsmode-library package.
 *
 * (c) 2017 NdC/WBW
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace WBW\Library\SMSMode\Response;

/**
 * sMsmode send SMS response interface.
 *
 * cf. 2 Envoi de SMS
 * 	<https://www.smsmode.com/pdf/fiche-api-http.pdf>
 *
 * @author NdC/WBW <https://github.com/webeweb/>
 * @package WBW\Library\SMSMode\Response
 */
interface SMSModeSendSMSResponseInterface {

	/**
	 * Code "Accepted".
	 */
	const CODE_ACCEPTED = 0;

	/**
	 * Code "Authentication error".
	 */
	const CODE_AUTHENTICATION_ERROR = 32;

	/**
	 * Code "Internal error".
	 */
	const CODE_INTERNAL_ERROR = 31;

	/**
	 * Code "Insuficient credit".
	 */
	const CODE_INSUFICIENT_CREDIT = 33;

	/**
	 * Code "Missing required parameter".
	 */
	const CODE_MISSING_REQUIRED_PARAMETER = 35;

	/**
	 * Code "Temporaly unavailable".
	 */
	const CODE_TEMPORALY_UNAVAILABLE = 50;

	/**
	 * Description "Accepted".
	 */
	const DESC_ACCEPTED = "Accepté - le message a été accepté par le système et est en cours de traitement";

	/**
	 * Description "Authentication error".
	 */
	const DESC_AUTHENTICATION_ERROR = "Erreur d'authentification";

	/**
	 * Description "Insuficient credit".
	 */
	const DESC_INSUFICIENT_CREDIT = "Crédits insuffisants";

	/**
	 * Description "Internal error".
	 */
	const DESC_INTERNAL_ERROR = "Erreur interne";

	/**
	 * Description "Missing required parameter".
	 */
	const DESC_MISSING_REQUIRED_PARAMETER = "Paramètre obligatoire manquant";

	/**
	 * Description "Temporaly unavailable".
	 */
	const DESC_TEMPORALY_UNAVAILABLE = "Temporairement inaccessible";

}
