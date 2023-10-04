<?php

namespace ZBrettonYe\Geetest\Tests;

use PHPUnit\Framework\TestCase;
use ZBrettonYe\Geetest\Geetest;

class GeetestTest extends TestCase
{
    /**
     * @var string
     */
    protected $user_id = 'testGeetest';

    /**
     * Test something true.
     */
    public function testProcess()
    {
        $data = [
            'user_id'     => $this->user_id,
            'client_type' => 'web',
            'ip_address'  => '127.0.0.1',
        ];
        Geetest::shouldReceive('preProcess')->once()->with($data)->andReturn();
    }

    /**
     * Test response str.
     */
    public function testResponseStr()
    {
        Geetest::shouldReceive('getResponseStr')->once()->with()->andReturn();
    }

    /**
     * Test render.
     */
    public function testRender()
    {
        Geetest::shouldReceive('render')->once()->with('float')->andReturn();
        Geetest::shouldReceive('render')->once()->with('popup')->andReturn();
        Geetest::shouldReceive('render')->once()->with('bind')->andReturn();
    }

}

