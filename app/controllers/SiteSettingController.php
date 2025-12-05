<?php
require_once __DIR__ . '/../models/SiteSetting.php';
class SiteSettingController {
    public static function get() {
        return SiteSetting::get();
    }
    public static function update($data) {
        return SiteSetting::update($data);
    }
}
