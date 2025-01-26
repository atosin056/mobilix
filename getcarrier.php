<?php
require_once __DIR__ . '/vendor/autoload.php';

use libphonenumber\PhoneNumberUtil;
use libphonenumber\NumberParseException;
use libphonenumber\PhoneNumberToCarrierMapper;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $phoneNumber = $_POST['phoneNumber'] ?? '';
    $countryCode = $_POST['countryCode'] ?? 'NG'; // Default to 'NG'

    $phoneUtil = PhoneNumberUtil::getInstance();
    $carrierMapper = PhoneNumberToCarrierMapper::getInstance();

    try {
        $numberProto = $phoneUtil->parse($phoneNumber, $countryCode);
        $carrier = $carrierMapper->getNameForNumber($numberProto, 'en');
        echo json_encode(['success' => true, 'carrier' => $carrier]);
    } catch (NumberParseException $e) {
        echo json_encode(['success' => false, 'message' => 'Invalid phone number']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request method']);
}
