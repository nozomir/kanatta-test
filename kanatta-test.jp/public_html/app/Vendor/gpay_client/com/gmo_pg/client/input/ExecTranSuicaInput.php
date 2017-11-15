<?php
require_once ('com/gmo_pg/client/input/BaseInput.php');
/**
 * <b>モバイルSuica決済実行　入力パラメータクラス</b>
 *
 * @package com.gmo_pg.client
 * @subpackage input
 * @see inputPackageInfo.php
 * @author GMO PaymentGateway
 * @version 1.0
 * @created 02-07-2008 00:00:00
 */
class ExecTranSuicaInput extends BaseInput {

	/**
	 * @var string 取引ID。GMO-PGが払い出した、取引を特定するID
	 */
	private $accessId;

	/**
	 * @var string 取引パスワード。取引IDと対になるパスワード
	 */
	private $accessPass;

	/**
	 * @var string オーダーID。加盟店様が発番した、取引を表すID
	 */
	private $orderId;

	/**
	 * @var string 商品・サービス名
	 */
	private $itemName;

	/**
	 * @var string メールアドレス
	 */
	private $mailAddress;

	/**
	 * @var string 加盟店メールアドレス(正)
	 */
	private $shopMailAddress;

	/**
	 * @var string 決済開始メール付加情報
	 */
	private $suicaAddInfo1;

	/**
	 * @var string 決済完了メール付加情報
	 */
	private $suicaAddInfo2;

	/**
	 * @var string 決済内容確認画面付加情報
	 */
	private $suicaAddInfo3;

	/**
	 * @var string 決済完了画面付加情報
	 */
	private $suicaAddInfo4;

	/**
	 * @var integer 支払期限日数
	 */
	private $paymentTermDay;

	/**
	 * @var integer 支払期限秒
	 */
	private $paymentTermSec;

	/**
	 * @var string 加盟店自由項目1
	 */
	private $clientField1;

	/**
	 * @var string 加盟店自由項目
	 */
	private $clientField2;

	/**
	 * @var string 加盟店自由項目3
	 */
	private $clientField3;

	/**
	 * @var string 加盟店自由項目返却フラグ
	 */
	private $clientFieldFlag;

	/**
	 * コンストラクタ
	 *
	 * @param array $params 入力パラメータ
	 */
	public function __construct($params = null) {
		parent::__construct($params);
	}

	/**
	 * デフォルト値を設定する
	 */
	public function setDefaultValues() {
	    // 加盟店自由項目返却フラグ(固定値)
        $this->clientFieldFlag = "1";
	}

	/**
	 * 入力パラメータ群の値を設定する
	 *
	 * @param IgnoreCaseMap $params 入力パラメータ
	 */
	public function setInputValues($params) {
		// 入力パラメータがnullの場合は設定処理を行わない
	    if (is_null($params)) {
	        return;
	    }


	    // 各項目の設定
        $this->setAccessId($this->getStringValue($params, 'AccessID', $this->getAccessId()));
	    $this->setAccessPass($this->getStringValue($params, 'AccessPass', $this->getAccessPass()));
	    $this->setOrderId($this->getStringValue($params, 'OrderID', $this->getOrderId()));

	    $this->setItemName($this->getStringValue($params, 'ItemName', $this->getItemName()));
	    $this->setMailAddress($this->getStringValue($params, 'MailAddress', $this->getMailAddress()));
	    // スペルミス対応
	    if(isset($params['ShopMailAddress']))
	    	$this->setShopMailAddress($this->getStringValue($params, 'ShopMailAddress', $this->getShopMailAddress()));
	    else
	    	$this->setShopMailAddress($this->getStringValue($params, 'ShopMailAdress', $this->getShopMailAddress()));
	    $this->setSuicaAddInfo1($this->getStringValue($params, 'SuicaAddInfo1', $this->getSuicaAddInfo1()));
	    $this->setSuicaAddInfo2($this->getStringValue($params, 'SuicaAddInfo2', $this->getSuicaAddInfo2()));
	    $this->setSuicaAddInfo3($this->getStringValue($params, 'SuicaAddInfo3', $this->getSuicaAddInfo3()));
	    $this->setSuicaAddInfo4($this->getStringValue($params, 'SuicaAddInfo4', $this->getSuicaAddInfo4()));
	    $this->setPaymentTermDay($this->getIntegerValue($params, 'PaymentTermDay', $this->getPaymentTermDay()));
	    $this->setPaymentTermSec($this->getIntegerValue($params, 'PaymentTermSec', $this->getPaymentTermSec()));

	    $this->setClientField1($this->getStringValue($params, 'ClientField1', $this->getClientField1()));
	    $this->setClientField2($this->getStringValue($params, 'ClientField2', $this->getClientField2()));
	    $this->setClientField3($this->getStringValue($params, 'ClientField3', $this->getClientField3()));
	}

	/**
	 * 取引ID取得
	 * @return string 取引ID
	 */
	public function getAccessId() {
		return $this->accessId;
	}

	/**
	 * 取引パスワード取得
	 * @return string 取引パスワード
	 */
	public function getAccessPass() {
		return $this->accessPass;
	}

	/**
	 * オーダーID取得
	 * @return string オーダーID
	 */
	public function getOrderId() {
		return $this->orderId;
	}

	/**
	 * 商品・サービス名を取得します。
	 *
	 * @return	$String	商品・サービス名
	 */
	public function getItemName() {
		return $this->itemName;
	}

	/**
	 * メールアドレスを取得します。
	 *
	 * @return	$String	メールアドレス
	 */
	public function getMailAddress() {
		return $this->mailAddress;
	}

	/**
	 * 加盟店メールアドレスを取得します。
	 *
   * @deprecated 下位互換のためのメソッドです。getShopMailAddress()をご利用下さい。
	 * @return	$String	加盟店メールアドレス
	 */
	public function getShopMailAdress() {
		return $this->shopMailAddress;
	}


	/**
	 * 加盟店メールアドレスを取得します。
	 *
	 * @return	$String	加盟店メールアドレス(正)
	 */
	public function getShopMailAddress() {
		return $this->shopMailAddress;
	}

	/**
	 * 決済開始メール付加情報を取得します。
	 *
	 * @return	$String	決済開始メール付加情報
	 */
	public function getSuicaAddInfo1() {
		return $this->suicaAddInfo1;
	}

	/**
	 * 決済完了メール付加情報を取得します。
	 *
	 * @return	$String	決済完了メール付加情報
	 */
	public function getSuicaAddInfo2() {
		return $this->suicaAddInfo2;
	}

	/**
	 * 決済内容確認画面付加情報を取得します。
	 *
	 * @return	$String	決済内容確認画面付加情報
	 */
	public function getSuicaAddInfo3() {
		return $this->suicaAddInfo3;
	}


	/**
	 * 決済完了画面付加情報を取得します。
	 *
	 * @return	$String	決済完了画面付加情報
	 */
	public function getSuicaAddInfo4() {
		return $this->suicaAddInfo4;
	}


	/**
	 * 支払期限日数を取得します。
	 *
	 * @return	$Integer	支払期限日数
	 */
	public function getPaymentTermDay() {
		return $this->paymentTermDay;
	}


	/**
	 * 支払期限秒を取得します。
	 *
	 * @return	$Integer	支払期限秒
	 */
	public function getPaymentTermSec() {
		return $this->paymentTermSec;
	}



	/**
	 * 加盟店自由項目1取得
	 * @return string 加盟店自由項目1
	 */
	public function getClientField1() {
		return $this->clientField1;
	}

	/**
	 * 加盟店自由項目2取得
	 * @return string 加盟店自由項目2
	 */
	public function getClientField2() {
		return $this->clientField2;
	}

	/**
	 * 加盟店自由項目3取得
	 * @return string 加盟店自由項目3
	 */
	public function getClientField3() {
		return $this->clientField3;
	}

	/**
	 * 取引ID設定
	 *
	 * @param string $accessId 取引ID
	 */
	public function setAccessId($accessId) {
		$this->accessId = $accessId;
	}

	/**
	 * 取引パスワードを設定
	 *
	 * @param string $accessPass 取引パスワード
	 */
	public function setAccessPass($accessPass) {
		$this->accessPass = $accessPass;
	}

	/**
	 * オーダーID設定
	 *
	 * @param string $orderId オーダーID
	 */
	public function setOrderId($orderId) {
		$this->orderId = $orderId;
	}


	/**
	 * 商品・サービス名を格納します。
	 *
	 * @param	$String	商品・サービス名
	 */
	public function setItemName($String) {
		$this->itemName = $String;
	}



	/**
	 * メールアドレスを格納します。
	 *
	 * @param	$String	メールアドレス
	 */
	public function setMailAddress($String) {
		$this->mailAddress = $String;
	}

	/**
	 * 加盟店メールアドレスを格納します。
	 *
   * @deprecated 下位互換のためのメソッドです。setShopMailAddress()をご利用下さい。
	 * @param	$String	加盟店メールアドレス
	 */
	public function setShopMailAdress($String) {
		$this->shopMailAddress = $String;
	}


	/**
	 * 加盟店メールアドレスを格納します。
	 *
	 * @param	$String	加盟店メールアドレス(正)
	 */
	public function setShopMailAddress($String) {
		$this->shopMailAddress = $String;
	}


	/**
	 * 決済開始メール付加情報を格納します。
	 *
	 * @param	$String	決済開始メール付加情報
	 */
	public function setSuicaAddInfo1($String) {
		$this->suicaAddInfo1 = $String;
	}



	/**
	 * 決済完了メール付加情報を格納します。
	 *
	 * @param	$String	決済完了メール付加情報
	 */
	public function setSuicaAddInfo2($String) {
		$this->suicaAddInfo2 = $String;
	}


	/**
	 * 決済内容確認画面付加情報を格納します。
	 *
	 * @param	$String	決済内容確認画面付加情報
	 */
	public function setSuicaAddInfo3($String) {
		$this->suicaAddInfo3 = $String;
	}


	/**
	 * 決済完了画面付加情報を格納します。
	 *
	 * @param	$String	決済完了画面付加情報
	 */
	public function setSuicaAddInfo4($String) {
		$this->suicaAddInfo4 = $String;
	}



	/**
	 * 支払期限日数を格納します。
	 *
	 * @param	$Integer	支払期限日数
	 */
	public function setPaymentTermDay($Integer) {
		$this->paymentTermDay = $Integer;
	}


	/**
	 * 支払期限秒を格納します。
	 *
	 * @param	$Integer	支払期限秒
	 */
	public function setPaymentTermSec($Integer) {
		$this->paymentTermSec = $Integer;
	}







	/**
	 * 加盟店自由項目1設定
	 *
	 * @param string $clientField1 加盟店自由項目1
	 */
	public function setClientField1($clientField1) {
		$this->clientField1 = $clientField1;
	}

	/**
	 * 加盟店自由項目2設定
	 *
	 * @param string $clientField2 加盟店自由項目2
	 */
	public function setClientField2($clientField2) {
		$this->clientField2 = $clientField2;
	}

	/**
	 * 加盟店自由項目3設定
	 *
	 * @param string $clientField3 加盟店自由項目3
	 */
	public function setClientField3($clientField3) {
		$this->clientField3 = $clientField3;
	}


	/**
	 * 文字列表現
	 * URLのパラメータ文字列の形式の文字列を生成する
	 * @return string 接続文字列表現
	 */
	public function toString() {
		$str ='';
	    $str .= 'AccessID=' . $this->encodeStr($this->getAccessId());
	    $str .= '&';
	    $str .= 'AccessPass=' . $this->encodeStr($this->getAccessPass());
	    $str .= '&';
	    $str .= 'OrderID=' . $this->encodeStr($this->getOrderId());
	    $str .= '&';
	    $str .= 'ItemName=' . $this->encodeStr($this->getItemName());
	    $str .= '&';
	    $str .= 'MailAddress=' . $this->encodeStr($this->getMailAddress());
	    $str .= '&';
	    $str .= 'ShopMailAddress=' . $this->encodeStr($this->getShopMailAddress());
	    $str .= '&';
	    $str .= 'SuicaAddInfo1=' . $this->encodeStr($this->getSuicaAddInfo1());
	    $str .= '&';
	    $str .= 'SuicaAddInfo2=' . $this->encodeStr($this->getSuicaAddInfo2());
	    $str .= '&';
	    $str .= 'SuicaAddInfo3=' . $this->encodeStr($this->getSuicaAddInfo3());
	    $str .= '&';
	    $str .= 'SuicaAddInfo4=' . $this->encodeStr($this->getSuicaAddInfo4());
	    $str .= '&';
	    $str .= 'PaymentTermDay=' . $this->encodeStr($this->getPaymentTermDay());
	    $str .= '&';
	    $str .= 'PaymentTermSec=' . $this->encodeStr($this->getPaymentTermSec());
	    $str .= '&';
	    $str .= 'ClientField1=' . $this->encodeStr($this->getClientField1());
	    $str .= '&';
	    $str .= 'ClientField2=' . $this->encodeStr($this->getClientField2());
	    $str .= '&';
	    $str .= 'ClientField3=' . $this->encodeStr($this->getClientField3());
	    $str .= '&';
	    $str .= 'ClientFieldFlag=' . $this->clientFieldFlag;

	    return $str;
	}
}
?>