<?php


namespace Ardzz\Wavel\Sender;

use Ardzz\Wavel\Cores\Exception\WavelError;
use Ardzz\Wavel\Cores\Exception\WavelHostIsEmpty;
use Ardzz\Wavel\Cores\Format;
use Ardzz\Wavel\Cores\Handler\Output;
use Ardzz\Wavel\Cores\Http\RequestTrait;

/**
 * Class Media
 * @package Ardzz\Wavel\Sender
 */
class Media
{
    use RequestTrait;

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param String $file
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function document(String $message, String|Int $receiverNumber, String $file, bool $isGroup = false): Output
    {
        return $this->process("sendFile", [
            "to" => Format::number($receiverNumber, $isGroup),
            "file" => Format::document($file),
            "filename" => $file,
            "caption" => $message
        ]);
    }

    /**
     * @param String $message
     * @param String|Int $receiverNumber
     * @param String $file
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function image(String $message, String|Int $receiverNumber, String $file, bool $isGroup = false): Output
    {
        return $this->process("sendImage", [
            "to" => Format::number($receiverNumber, $isGroup),
            "file" => Format::image($file),
            "filename" => $file,
            "caption" => $message
        ]);
    }

    /**
     * @param String|Int $receiverNumber
     * @param String $file
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function imageAsSticker(String $file, String|Int $receiverNumber, bool $isGroup = false): Output
    {
        return $this->process("sendImageAsSticker", [
            "to" => Format::number($receiverNumber, $isGroup),
            "image" => Format::image($file)
        ]);
    }

    /**
     * @param String|Int $receiverNumber
     * @param String $file
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function rawWebpAsSticker(String $file, String|Int $receiverNumber, bool $isGroup = false): Output
    {
        return $this->process("sendRawWebpAsSticker", [
            "to" => Format::number($receiverNumber, $isGroup),
            "webpBase64" => Format::document($file)
        ]);
    }

    /**
     * @param String|Int $receiverNumber
     * @param String $url
     * @param String $message
     * @param bool $isGroup
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function fileFromURL(String $url, String|Int $receiverNumber, String $message, bool $isGroup = false): Output
    {

        $file = explode('/', $url);

        return $this->process('sendFileFromUrl', [
            'to' => Format::number($receiverNumber, $isGroup),
            "url" => $url,
            "filename" => end($file),
            "caption" => $message
        ]);
    }

    /**
     * @param string $messageId
     * @return Output
     * @throws WavelError
     * @throws WavelHostIsEmpty
     */
    function decryptMedia(string $messageId): Output
    {
        return $this->process('decryptMedia', [
            'message' => $messageId
        ]);
    }
}
