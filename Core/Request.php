<?php

/**
 * MIT License
 * Copyright (c) 2020 Vaibhav Kubre
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */

namespace Core;

class Request
{

    /** @var array All Required Superglobals stored here */
    protected $paramBag = [];
    protected $isUploadedFilesConstructed = false;

    public function __construct($get, $post, $files, $server, $cookie, $request)
    {
        $this->paramBag = [
            'get' => $get,
            'post' => $post,
            'files' => $files,
            'server' => $server,
            'cookie' => $cookie,
            'request' => $request
        ];
    }

    /**
     * Retrive get array or fields
     *
     * @param string|null $field
     * @return mixed
     */
    public function query($field = null)
    {
//        echo $this->paramBag['get'];
        return (is_null($field) ? $this->paramBag['get'] : $this->paramBag['get'][$field]) ?: null;
    }


    /**
     * Retrive post array or fields
     *
     * @param string|null $field
     * @return mixed
     */
    public function input($field = null)
    {
        return is_null($field) ? $this->paramBag['post'] : $this->paramBag['post'][$field] ?? null;
    }

    /**
     * Bu istek içeriği var mı kontrölünü yapar
     *
     * @param string|null $field
     * @return mixed
     */
    public function find($field = null)
    {
        return isset($this->paramBag['request'][$field]);
    }

    /**
     * Bu istek içeriğinde Request olarak getirir
     *
     * @param string|null $field
     * @return mixed
     */
    public function request($field = null)
    {
        return is_null($field) ? $this->paramBag['request'] : $this->paramBag['request'][$field] ?? null;
    }

    /**
     * Retrive server array or fields
     *
     * @param string|null $field
     * @return mixed
     */
    public function server($field = null)
    {
        return is_null($field) ? $this->paramBag['server'] : $this->paramBag['server'][$field] ?? null;
    }


    /**
     * Retrive files array or fields
     *
     * @param string|null $field
     * @return array|UploadedFile
     */
    public function files($field = null)
    {
        if (!$this->isUploadedFilesConstructed) {
            foreach ($this->paramBag['files'] as $key => $file) {
                $this->paramBag['files'][$key] = new UploadedFile($file);
            }
            $this->isUploadedFilesConstructed = true;
        }
        return is_null($field) ? $this->paramBag['files'] : $this->paramBag['files'][$field] ?? null;
    }


    /**
     * Check for file
     *
     * @param string|null $field
     * @return boolean
     */
    public function hasFile($field)
    {
        return isset($this->paramBag['files'][$field]);
    }


    public function all()
    {
        return array_merge($this->input(), $this->files());
    }



    /**
     * Tüm request verilerini düz bir dizi olarak döner
     *
     * @param string $method "get", "post" veya "request"
     * @return array
     */
    function all_request_data(string $method = 'request'): array
    {
        switch (strtolower($method)) {
            case 'get':
                $source = $_GET;
                break;
            case 'post':
                $source = $_POST;
                break;
            default:
                $source = $_REQUEST;
        }

        $result = [];

        foreach ($source as $key => $value) {
            // Eğer array ise direkt ekle
            if (is_array($value)) {
                $result[$key] = $value;
            } else {
                $result[$key] = $value;
            }
        }

        return $result;
    }


    /**
     * Tüm request verilerini query string formatında döner
     *
     * @param string $method "get", "post" veya "request"
     * @return string
     */
    function request_query_string(string $method = 'request'): string
    {
        if ($this->find('page')){
            unset($_GET['page']);
        }

        switch (strtolower($method)) {
            case 'get':
                $source = $_GET;
                break;
            case 'post':
                $source = $_POST;
                break;
            default:
                $source = $_REQUEST;
        }

        // PHP’nin built-in http_build_query fonksiyonu ile arrayleri de düzgün string yapar
        return http_build_query($source);
    }


    /**
     * Is request Get request
     *
     * @return boolean
     */
    public function isGet()
    {
        return $this->server('REQUEST_METHOD') === 'GET';
    }


    /**
     * Is request Post request
     *
     * @return boolean
     */
    public function isPost()
    {
        return $this->server('REQUEST_METHOD') === 'POST';
    }
}
