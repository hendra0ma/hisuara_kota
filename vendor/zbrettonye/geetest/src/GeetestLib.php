<?php

namespace ZBrettonYe\Geetest;

use App\Components\CaptchaVerify;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Http;

class GeetestLib
{
    public const GT_SDK_VERSION = 'php_3.0.0';
    public static $connectTimeout = 5;
    public static $socketTimeout = 5;
    protected $url = '';
    protected $captcha_id;
    protected $private_key;
    private $response;


    public function __construct()
    {
        if (Config::get('geetest.server-get-config')) {
            $geetest = CaptchaVerify::geetestCaptchaGetConfig();
            $this->captcha_id = $geetest["geetest_id"];
            $this->private_key = $geetest["geetest_key"];
        } else {
            $this->captcha_id = Config::get('geetest.id');
            $this->private_key = Config::get('geetest.key');
        }
    }


    public function getGeetestUrl()
    {
        return $this->url;
    }

    /**
     * @param $url
     * @return GeetestLib
     */
    public function setGeetestUrl($url)
    {
        $this->url = $url;

        return $this;
    }

    /**
     * Check Geetest server is running or not.
     *
     * @param $param
     * @param  int  $new_captcha
     * @return int
     */
    public function preProcess($param, $new_captcha = 1)
    {
        $data = [
            'gt'          => $this->captcha_id,
            'new_captcha' => $new_captcha,
        ];
        $data = array_merge($data, $param);
        $challenge = $this->sendRequest("https://api.geetest.com/register.php", $data);

        if (strlen($challenge) !== 32) {
            $this->failbackProcess();

            return 0;
        }
        $this->successProcess($challenge);

        return 1;
    }

    /**
     * GET
     *
     * @param $url
     * @param $data
     * @return mixed|string
     */
    private function sendRequest($url, $data)
    {
        $request = Http::timeout(self::$connectTimeout + self::$socketTimeout)->get($url, $data);
        $message = $request->body();

        return $message ?: 0;
    }

    /**
     *
     */
    private function failbackProcess()
    {
        $rnd1 = md5(random_int(0, 100));
        $rnd2 = md5(random_int(0, 100));
        $challenge = $rnd1.substr($rnd2, 0, 2);
        $result = [
            'success'     => 0,
            'gt'          => $this->captcha_id,
            'challenge'   => $challenge,
            'new_captcha' => 1,
        ];
        $this->response = $result;
    }

    /**
     * @param $challenge
     */
    private function successProcess($challenge)
    {
        $challenge = md5($challenge.$this->private_key);
        $result = [
            'success'     => 1,
            'gt'          => $this->captcha_id,
            'challenge'   => $challenge,
            'new_captcha' => 1,
        ];
        $this->response = $result;
    }

    /**
     * @return mixed
     */
    public function getResponseStr()
    {
        return json_encode($this->response);
    }

    /**
     *
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
    }

    /**
     * Get success validate result.
     *
     * @param        $challenge
     * @param        $validate
     * @param        $seccode
     * @param $param
     * @param  int  $json_format
     * @return int
     */
    public function successValidate($challenge, $validate, $seccode, $param, $json_format = 1)
    {
        if (!$this->checkValidate($challenge, $validate)) {
            return 0;
        }
        $query = [
            "seccode"     => $seccode,
            "timestamp"   => time(),
            "challenge"   => $challenge,
            "captchaid"   => $this->captcha_id,
            "json_format" => $json_format,
            "sdk"         => self::GT_SDK_VERSION,
        ];
        $query = array_merge($query, $param);
        $obj = $this->postRequest("https://api.geetest.com/validate.php", $query);
        if ($obj && $obj['seccode'] === md5($seccode)) {
            return 1;
        }

        return 0;
    }

    /**
     * @param $challenge
     * @param $validate
     * @return bool
     */
    private function checkValidate($challenge, $validate)
    {
        if (strlen($validate) !== 32) {
            return false;
        }
        if (md5($this->private_key.'geetest'.$challenge) !== $validate) {
            return false;
        }

        return true;
    }

    /**
     * @param         $url
     * @param  array  $postdata
     * @return mixed|string
     */
    private function postRequest($url, $postdata = [])
    {
        $request = Http::asForm()->timeout(self::$connectTimeout + self::$socketTimeout)->post($url, $postdata);

        return $request->json();
    }

    /**
     * Get fail result.
     *
     * @param $challenge
     * @param $validate
     * @return int
     */
    public function failValidate($challenge, $validate)
    {
        if (md5($challenge) === $validate) {
            return 1;
        }

        return 0;
    }

    /**
     * @param  string  $product
     * @param  string  $captchaId
     * @return
     */
    public function render($product = 'float', $captchaId = 'geetest-captcha')
    {
        return view('geetest::geetest', [
            'captchaid' => $captchaId,
            'product'   => $product,
            'url'       => $this->url,
        ]);
    }

    /**
     * @param $err
     */
    private function triggerError($err)
    {
        trigger_error($err);
    }

}

