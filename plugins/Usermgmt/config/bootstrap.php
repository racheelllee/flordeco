<?php
/* Cakephp 3.x User Management Premium Version (a product of Ektanjali Softwares Pvt Ltd)
Website- http://ektanjali.com
Plugin Demo- http://cakephp3-user-management.ektanjali.com/
Author- Chetan Varshney (The Director of Ektanjali Softwares Pvt Ltd)
Plugin Copyright No- 11498/2012-CO/L

UMPremium is a copyrighted work of authorship. Chetan Varshney retains ownership of the product and any copies of it, regardless of the form in which the copies may exist. This license is not a sale of the original product or any copies.

By installing and using UMPremium on your server, you agree to the following terms and conditions. Such agreement is either on your own behalf or on behalf of any corporate entity which employs you or which you represent ('Corporate Licensee'). In this Agreement, 'you' includes both the reader and any Corporate Licensee and Chetan Varshney.

The Product is licensed only to you. You may not rent, lease, sublicense, sell, assign, pledge, transfer or otherwise dispose of the Product in any form, on a temporary or permanent basis, without the prior written consent of Chetan Varshney.

The Product source code may be altered (at your risk)

All Product copyright notices within the scripts must remain unchanged (and visible).

If any of the terms of this Agreement are violated, Chetan Varshney reserves the right to action against you.

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Product.

THE PRODUCT IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE PRODUCT OR THE USE OR OTHER DEALINGS IN THE PRODUCT. */
?>
<?php
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\ORM\TableRegistry;
use Cake\Routing\Router;

function UsermgmtInIt() {
	defineUsermgmtCache();
	$allSettings = getAllSettings();

	/* Site Settings Start */
	if(!defined("SITE_URL")) {
		if(!defined('CRON_DISPATCHER')) {
			define("SITE_URL", Router::url('/', true));
		}
	}
	date_default_timezone_set((isset($allSettings['defaultTimeZone'])) ? $allSettings['defaultTimeZone']['value'] : 'America/New_York');
	if(!defined("USERMGMT_PATH")) {
		define("USERMGMT_PATH", dirname(__DIR__));
	}
	if(!defined("SITE_NAME")) {
		define("SITE_NAME", ((isset($allSettings['siteName'])) ? $allSettings['siteName']['value'] : 'User Management Plugin'));
	}
	if(!defined("SITE_NAME_SHORT")) {
		define("SITE_NAME_SHORT", ((isset($allSettings['siteNameShort'])) ? $allSettings['siteNameShort']['value'] : 'UMP'));
	}
	if(!defined("LOGIN_REDIRECT_URL")) {
		define("LOGIN_REDIRECT_URL", ((isset($allSettings['loginRedirectUrl'])) ? $allSettings['loginRedirectUrl']['value'] : '/dashboard'));
	}
	if(!defined("LOGOUT_REDIRECT_URL")) {
		define("LOGOUT_REDIRECT_URL", ((isset($allSettings['logoutRedirectUrl'])) ? $allSettings['logoutRedirectUrl']['value'] : '/'));
	}
	if(!defined("LOGIN_COOKIE_NAME")) {
		define("LOGIN_COOKIE_NAME", ((isset($allSettings['loginCookieName'])) ? $allSettings['loginCookieName']['value'] : "UMPremiumCookie"));
	}
	if(!defined("USE_HTTPS")) {
		define("USE_HTTPS", ((isset($allSettings['useHttps'])) ? $allSettings['useHttps']['value'] : 0));
	}
	if(!defined("HTTPS_URLS")) {
		define("HTTPS_URLS", ((isset($allSettings['httpsUrls'])) ? $allSettings['httpsUrls']['value'] : ''));
	}
	if(!defined("QRDN")) {
		define("QRDN", ((isset($allSettings['QRDN'])) ? $allSettings['QRDN']['value'] : "12345678"));
	}
	/* Site Settings End */


	/* Group Settings Start */
	if(!defined("DEFAULT_GROUP_ID")) {
		define("DEFAULT_GROUP_ID", ((isset($allSettings['defaultGroupId'])) ? $allSettings['defaultGroupId']['value'] : 2));
	}
	if(!defined("ADMIN_GROUP_ID")) {
		define("ADMIN_GROUP_ID", ((isset($allSettings['adminGroupId'])) ? $allSettings['adminGroupId']['value'] : 1));
	}
	if(!defined("GUEST_GROUP_ID")) {
		define("GUEST_GROUP_ID", ((isset($allSettings['guestGroupId'])) ? $allSettings['guestGroupId']['value'] : 3));
	}
	/* Group Settings End */
	
	
	/* User Settings Start */
	if(!defined("SITE_REGISTRATION")) {
		define("SITE_REGISTRATION", ((isset($allSettings['siteRegistration'])) ? $allSettings['siteRegistration']['value'] : 1));
	}
	if(!defined("EMAIL_VERIFICATION")) {
		define("EMAIL_VERIFICATION", ((isset($allSettings['emailVerification'])) ? $allSettings['emailVerification']['value'] : 1));
	}
	if(!defined("ALLOW_DELETE_ACCOUNT")) {
		define("ALLOW_DELETE_ACCOUNT", ((isset($allSettings['allowDeleteAccount'])) ? $allSettings['allowDeleteAccount']['value'] : 0));
	}
	if(!defined("ALLOW_CHANGE_USERNAME")) {
		define("ALLOW_CHANGE_USERNAME", ((isset($allSettings['allowChangeUsername'])) ? $allSettings['allowChangeUsername']['value'] : 0));
	}
	if(!defined("BANNED_USERNAMES")) {
		define("BANNED_USERNAMES", ((isset($allSettings['bannedUsernames'])) ? $allSettings['bannedUsernames']['value'] : ''));
	}
	if(!defined("PERMISSIONS")) {
		define("PERMISSIONS", ((isset($allSettings['permissions'])) ? $allSettings['permissions']['value'] : 1));
	}
	if(!defined("ADMIN_PERMISSIONS")) {
		define("ADMIN_PERMISSIONS", ((isset($allSettings['adminPermissions'])) ? $allSettings['adminPermissions']['value'] : 0));
	}
	if(!defined("ALLOW_USER_MULTIPLE_LOGIN")) {
		define("ALLOW_USER_MULTIPLE_LOGIN", ((isset($allSettings['allowUserMultipleLogin'])) ? $allSettings['allowUserMultipleLogin']['value'] : 1));
	}
	if(!defined("ALLOW_ADMIN_MULTIPLE_LOGIN")) {
		define("ALLOW_ADMIN_MULTIPLE_LOGIN", ((isset($allSettings['allowAdminMultipleLogin'])) ? $allSettings['allowAdminMultipleLogin']['value'] : 1));
	}
	if(!defined("LOGIN_IDLE_TIME")) {
		define("LOGIN_IDLE_TIME", ((isset($allSettings['loginIdleTime'])) ? $allSettings['loginIdleTime']['value'] : 10));
	}
	if(!defined("VIEW_ONLINE_USER_TIME")) {
		define("VIEW_ONLINE_USER_TIME", ((isset($allSettings['viewOnlineUserTime'])) ? $allSettings['viewOnlineUserTime']['value'] : 30));
	}
	if(!defined("IMG_DIR")) {
		define("IMG_DIR", ((isset($allSettings['imgDir'])) ? $allSettings['imgDir']['value'] : "umphotos"));
	}
	if(!defined("DEFAULT_IMAGE_PATH")) {
		define("DEFAULT_IMAGE_PATH", USERMGMT_PATH.DS."webroot".DS."img".DS."default.png");/* setting path for default image */
	}
	if(!defined("DEFAULT_IMAGE_URL")) {
		define("DEFAULT_IMAGE_URL", SITE_URL."usermgmt/img/default.png");
	}
	if(!defined("USE_REMEMBER_ME")) {
		define("USE_REMEMBER_ME", ((isset($allSettings['useRememberMe'])) ? $allSettings['useRememberMe']['value'] : 1));
	}
	/* User Settings End */


	/* Email Settings Start */
	if(!defined("EMAIL_FROM_ADDRESS")) {
		define("EMAIL_FROM_ADDRESS", ((isset($allSettings['emailFromAddress'])) ? $allSettings['emailFromAddress']['value'] : 'test@test.com'));
	}
	if(!defined("EMAIL_FROM_NAME")) {
		define("EMAIL_FROM_NAME", ((isset($allSettings['emailFromName'])) ? $allSettings['emailFromName']['value'] : 'User Management Plugin'));
	}
	if(!defined("ADMIN_EMAIL_ADDRESS")) {
		define("ADMIN_EMAIL_ADDRESS", ((isset($allSettings['adminEmailAddress'])) ? $allSettings['adminEmailAddress']['value'] : ''));
	}
	if(!defined("SEND_REGISTRATION_MAIL")) {
		define("SEND_REGISTRATION_MAIL", ((isset($allSettings['sendRegistrationMail'])) ? $allSettings['sendRegistrationMail']['value'] : 0));
	}
	if(!defined("SEND_PASSWORD_CHANGE_MAIL")) {
		define("SEND_PASSWORD_CHANGE_MAIL", ((isset($allSettings['sendPasswordChangeMail'])) ? $allSettings['sendPasswordChangeMail']['value'] : 0));
	}
	if(!defined("PORCENTAJE_PUNTOS_PEDIDO")) {
		define("PORCENTAJE_PUNTOS_PEDIDO", ((isset($allSettings['porcentajePuntosPedido'])) ? $allSettings['porcentajePuntosPedido']['value'] : 0));
	}
	/* Email Settings End */
	
	
	/* Recaptcha Settings Start */
	if(!defined("PRIVATE_KEY_FROM_RECAPTCHA")) {
		define("PRIVATE_KEY_FROM_RECAPTCHA", ((isset($allSettings['privateKeyFromRecaptcha'])) ? $allSettings['privateKeyFromRecaptcha']['value'] : ''));
	}
	if(!defined("PUBLIC_KEY_FROM_RECAPTCHA")) {
		define("PUBLIC_KEY_FROM_RECAPTCHA", ((isset($allSettings['publicKeyFromRecaptcha'])) ? $allSettings['publicKeyFromRecaptcha']['value'] : ''));
	}
	if(!defined("USE_RECAPTCHA_ON_LOGIN")) {
		define("USE_RECAPTCHA_ON_LOGIN", ((isset($allSettings['useRecaptchaOnLogin'])) ? $allSettings['useRecaptchaOnLogin']['value'] : 0));
	}
	if(!defined("USE_RECAPTCHA_ON_BAD_LOGIN")) {
		define("USE_RECAPTCHA_ON_BAD_LOGIN", ((isset($allSettings['useRecaptchaOnBadLogin'])) ? $allSettings['useRecaptchaOnBadLogin']['value'] : 0));
	}
	if(!defined("USE_RECAPTCHA_ON_REGISTRATION")) {
		define("USE_RECAPTCHA_ON_REGISTRATION", ((isset($allSettings['useRecaptchaOnRegistration'])) ? $allSettings['useRecaptchaOnRegistration']['value'] : 0));
	}
	if(!defined("USE_RECAPTCHA_ON_FORGOT_PASSWORD")) {
		define("USE_RECAPTCHA_ON_FORGOT_PASSWORD", ((isset($allSettings['useRecaptchaOnForgotPassword'])) ? $allSettings['useRecaptchaOnForgotPassword']['value'] : 0));
	}
	if(!defined("USE_RECAPTCHA_ON_EMAIL_VERIFICATION")) {
		define("USE_RECAPTCHA_ON_EMAIL_VERIFICATION", ((isset($allSettings['useRecaptchaOnEmailVerification'])) ? $allSettings['useRecaptchaOnEmailVerification']['value'] : 0));
	}
	if(!defined("BAD_LOGIN_ALLOW_COUNT")) {
		define("BAD_LOGIN_ALLOW_COUNT", ((isset($allSettings['badLoginAllowCount'])) ? $allSettings['badLoginAllowCount']['value'] : 5));
	}
	/* Recaptcha Settings End */

	
	/* Facebook Settings Start */
	if(!defined("USE_FB_LOGIN")) {
		define("USE_FB_LOGIN", ((isset($allSettings['useFacebookLogin'])) ? $allSettings['useFacebookLogin']['value'] : 0));
	}
	if(!defined("FB_APP_ID")) {
		define("FB_APP_ID", ((isset($allSettings['facebookAppId'])) ? $allSettings['facebookAppId']['value'] : ''));
	}
	if(!defined("FB_SECRET")) {
		define("FB_SECRET", ((isset($allSettings['facebookSecret'])) ? $allSettings['facebookSecret']['value'] : ''));
	}
	if(!defined("FB_SCOPE")) {
		define("FB_SCOPE", ((isset($allSettings['facebookScope'])) ? $allSettings['facebookScope']['value'] : ''));
	}
	/* Facebook Settings End */

	
	/* Twitter Settings Start */
	if(!defined("USE_TWT_LOGIN")) {
		define("USE_TWT_LOGIN", ((isset($allSettings['useTwitterLogin'])) ? $allSettings['useTwitterLogin']['value'] : 0));
	}
	if(!defined("TWT_APP_ID")) {
		define("TWT_APP_ID", ((isset($allSettings['twitterConsumerKey'])) ? $allSettings['twitterConsumerKey']['value'] : ''));
	}
	if(!defined("TWT_SECRET")) {
		define("TWT_SECRET", ((isset($allSettings['twitterConsumerSecret'])) ? $allSettings['twitterConsumerSecret']['value'] : ''));
	}
	/* Twitter Settings End */

	
	/* Google Settings Start */
	if(!defined("USE_GMAIL_LOGIN")) {
		define("USE_GMAIL_LOGIN", ((isset($allSettings['useGmailLogin'])) ? $allSettings['useGmailLogin']['value'] : 0));
	}
	if(!defined("GMAIL_API_KEY")) {
		define("GMAIL_API_KEY", ((isset($allSettings['gmailApiKey'])) ? $allSettings['gmailApiKey']['value'] : ''));
	}
	if(!defined("GMAIL_CLIENT_ID")) {
		define("GMAIL_CLIENT_ID", ((isset($allSettings['gmailClientId'])) ? $allSettings['gmailClientId']['value'] : ''));
	}
	if(!defined("GMAIL_CLIENT_SECRET")) {
		define("GMAIL_CLIENT_SECRET", ((isset($allSettings['gmailClientSecret'])) ? $allSettings['gmailClientSecret']['value'] : ''));
	}
	/* Google Settings End */

	
	/* Yahoo Settings Start */
	if(!defined("USE_YAHOO_LOGIN")) {
		define("USE_YAHOO_LOGIN", ((isset($allSettings['useYahooLogin'])) ? $allSettings['useYahooLogin']['value'] : 0));
	}
	/* Yahoo Settings End */

	
	/* Linkedin Settings Start */
	if(!defined("USE_LDN_LOGIN")) {
		define("USE_LDN_LOGIN", ((isset($allSettings['useLinkedinLogin'])) ? $allSettings['useLinkedinLogin']['value'] : 0));
	}
	if(!defined("LDN_API_KEY")) {
		define("LDN_API_KEY", ((isset($allSettings['linkedinApiKey'])) ? $allSettings['linkedinApiKey']['value'] : ''));
	}
	if(!defined("LDN_SECRET_KEY")) {
		define("LDN_SECRET_KEY", ((isset($allSettings['linkedinSecretKey'])) ? $allSettings['linkedinSecretKey']['value'] : ''));
	}
	/* Linkedin Settings End */

	
	/* Foursquare Settings Start */
	if(!defined("USE_FS_LOGIN")) {
		define("USE_FS_LOGIN", ((isset($allSettings['useFoursquareLogin'])) ? $allSettings['useFoursquareLogin']['value'] : 0));
	}
	if(!defined("FS_CLIENT_ID")) {
		define("FS_CLIENT_ID", ((isset($allSettings['foursquareClientId'])) ? $allSettings['foursquareClientId']['value'] : ''));
	}
	if(!defined("FS_CLIENT_SECRET")) {
		define("FS_CLIENT_SECRET", ((isset($allSettings['foursquareClientSecret'])) ? $allSettings['foursquareClientSecret']['value'] : ''));
	}
	/* Foursquare Settings End */
}
function defineUsermgmtCache() {
	$configured = Cache::configured();
	if(!in_array('UserMgmtPermissions', $configured)) {
		Cache::config('UserMgmtPermissions', [
			'className'=>'File',
			'duration'=>'+3 months',
			'path'=>CACHE,
			'prefix'=>'UserMgmt_'
		]);
	}
	if(!in_array('UserMgmtSettings', $configured)) {
		Cache::config('UserMgmtSettings', [
			'className'=>'File',
			'duration'=>'+1 day',
			'path'=>CACHE,
			'prefix'=>'UserMgmt_'
		]);
	}
}
function getAllSettings() {
	$cacheKey = 'all_settings';
	$allSettings = false;
	if(Configure::read('debug') == 0) {
		$allSettings = Cache::read($cacheKey, 'UserMgmtSettings');
	}
	if($allSettings === false) {
		$allSettings = TableRegistry::get('Usermgmt.UserSettings')->getAllUserSettings();
		Cache::write($cacheKey, $allSettings, 'UserMgmtSettings');
	}
	return $allSettings;
}
