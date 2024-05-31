<?php

namespace App\Helpers;

use App\Models\Application;
use App\Models\Feature;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\View;
use stdClass;

class  MenuHelper
{
    public $active = false;
    public $menu;
    public $item;
    public $subitens = [];
    private $menus;
    private $args;

    public function __construct($args = null)
    {
        $this->args = $args;
    }

    public function makeIcons()
    {

        return [
            [
                "icon" => "mdi-access-point",
                "title" => "mdi-access-point"
            ],
            [
                "icon" => "mdi-access-point-network",
                "title" => "mdi-access-point-network"
            ],
            [
                "icon" => "mdi-account",
                "title" => "mdi-account"
            ],
            [
                "icon" => "mdi-account-alert",
                "title" => "mdi-account-alert"
            ],
            [
                "icon" => "mdi-account-box",
                "title" => "mdi-account-box"
            ],
            [
                "icon" => "mdi-account-box-outline",
                "title" => "mdi-account-box-outline"
            ],
            [
                "icon" => "mdi-account-card-details",
                "title" => "mdi-account-card-details"
            ],
            [
                "icon" => "mdi-account-check",
                "title" => "mdi-account-check"
            ],
            [
                "icon" => "mdi-account-circle",
                "title" => "mdi-account-circle"
            ],
            [
                "icon" => "mdi-account-convert",
                "title" => "mdi-account-convert"
            ],
            [
                "icon" => "mdi-account-edit",
                "title" => "mdi-account-edit"
            ],
            [
                "icon" => "mdi-account-key",
                "title" => "mdi-account-key"
            ],
            [
                "icon" => "mdi-account-location",
                "title" => "mdi-account-location"
            ],
            [
                "icon" => "mdi-account-minus",
                "title" => "mdi-account-minus"
            ],
            [
                "icon" => "mdi-account-multiple",
                "title" => "mdi-account-multiple"
            ],
            [
                "icon" => "mdi-account-multiple-minus",
                "title" => "mdi-account-multiple-minus"
            ],
            [
                "icon" => "mdi-account-multiple-outline",
                "title" => "mdi-account-multiple-outline"
            ],
            [
                "icon" => "mdi-account-multiple-plus",
                "title" => "mdi-account-multiple-plus"
            ],
            [
                "icon" => "mdi-account-network",
                "title" => "mdi-account-network"
            ],
            [
                "icon" => "mdi-account-off",
                "title" => "mdi-account-off"
            ],
            [
                "icon" => "mdi-account-outline",
                "title" => "mdi-account-outline"
            ],
            [
                "icon" => "mdi-account-plus",
                "title" => "mdi-account-plus"
            ],
            [
                "icon" => "mdi-account-remove",
                "title" => "mdi-account-remove"
            ],
            [
                "icon" => "mdi-account-search",
                "title" => "mdi-account-search"
            ],
            [
                "icon" => "mdi-account-settings",
                "title" => "mdi-account-settings"
            ],
            [
                "icon" => "mdi-account-settings-variant",
                "title" => "mdi-account-settings-variant"
            ],
            [
                "icon" => "mdi-account-star",
                "title" => "mdi-account-star"
            ],
            [
                "icon" => "mdi-account-switch",
                "title" => "mdi-account-switch"
            ],
            [
                "icon" => "mdi-adjust",
                "title" => "mdi-adjust"
            ],
            [
                "icon" => "mdi-air-conditioner",
                "title" => "mdi-air-conditioner"
            ],
            [
                "icon" => "mdi-airballoon",
                "title" => "mdi-airballoon"
            ],
            [
                "icon" => "mdi-airplane",
                "title" => "mdi-airplane"
            ],
            [
                "icon" => "mdi-airplane-landing",
                "title" => "mdi-airplane-landing"
            ],
            [
                "icon" => "mdi-airplane-off",
                "title" => "mdi-airplane-off"
            ],
            [
                "icon" => "mdi-airplane-takeoff",
                "title" => "mdi-airplane-takeoff"
            ],
            [
                "icon" => "mdi-airplay",
                "title" => "mdi-airplay"
            ],
            [
                "icon" => "mdi-alarm",
                "title" => "mdi-alarm"
            ],
            [
                "icon" => "mdi-alarm-bell",
                "title" => "mdi-alarm-bell"
            ],
            [
                "icon" => "mdi-alarm-check",
                "title" => "mdi-alarm-check"
            ],
            [
                "icon" => "mdi-alarm-light",
                "title" => "mdi-alarm-light"
            ],
            [
                "icon" => "mdi-alarm-multiple",
                "title" => "mdi-alarm-multiple"
            ],
            [
                "icon" => "mdi-alarm-off",
                "title" => "mdi-alarm-off"
            ],
            [
                "icon" => "mdi-alarm-plus",
                "title" => "mdi-alarm-plus"
            ],
            [
                "icon" => "mdi-alarm-snooze",
                "title" => "mdi-alarm-snooze"
            ],
            [
                "icon" => "mdi-album",
                "title" => "mdi-album"
            ],
            [
                "icon" => "mdi-alert",
                "title" => "mdi-alert"
            ],
            [
                "icon" => "mdi-alert-box",
                "title" => "mdi-alert-box"
            ],
            [
                "icon" => "mdi-alert-circle",
                "title" => "mdi-alert-circle"
            ],
            [
                "icon" => "mdi-alert-circle-outline",
                "title" => "mdi-alert-circle-outline"
            ],
            [
                "icon" => "mdi-alert-decagram",
                "title" => "mdi-alert-decagram"
            ],
            [
                "icon" => "mdi-alert-octagon",
                "title" => "mdi-alert-octagon"
            ],
            [
                "icon" => "mdi-alert-octagram",
                "title" => "mdi-alert-octagram"
            ],
            [
                "icon" => "mdi-alert-outline",
                "title" => "mdi-alert-outline"
            ],
            [
                "icon" => "mdi-all-inclusive",
                "title" => "mdi-all-inclusive"
            ],
            [
                "icon" => "mdi-alpha",
                "title" => "mdi-alpha"
            ],
            [
                "icon" => "mdi-alphabetical",
                "title" => "mdi-alphabetical"
            ],
            [
                "icon" => "mdi-altimeter",
                "title" => "mdi-altimeter"
            ],
            [
                "icon" => "mdi-amazon",
                "title" => "mdi-amazon"
            ],
            [
                "icon" => "mdi-amazon-clouddrive",
                "title" => "mdi-amazon-clouddrive"
            ],
            [
                "icon" => "mdi-ambulance",
                "title" => "mdi-ambulance"
            ],
            [
                "icon" => "mdi-amplifier",
                "title" => "mdi-amplifier"
            ],
            [
                "icon" => "mdi-anchor",
                "title" => "mdi-anchor"
            ],
            [
                "icon" => "mdi-android",
                "title" => "mdi-android"
            ],
            [
                "icon" => "mdi-android-debug-bridge",
                "title" => "mdi-android-debug-bridge"
            ],
            [
                "icon" => "mdi-android-head",
                "title" => "mdi-android-head"
            ],
            [
                "icon" => "mdi-android-studio",
                "title" => "mdi-android-studio"
            ],
            [
                "icon" => "mdi-angular",
                "title" => "mdi-angular"
            ],
            [
                "icon" => "mdi-angularjs",
                "title" => "mdi-angularjs"
            ],
            [
                "icon" => "mdi-animation",
                "title" => "mdi-animation"
            ],
            [
                "icon" => "mdi-apple",
                "title" => "mdi-apple"
            ],
            [
                "icon" => "mdi-apple-finder",
                "title" => "mdi-apple-finder"
            ],
            [
                "icon" => "mdi-apple-ios",
                "title" => "mdi-apple-ios"
            ],
            [
                "icon" => "mdi-apple-keyboard-caps",
                "title" => "mdi-apple-keyboard-caps"
            ],
            [
                "icon" => "mdi-apple-keyboard-command",
                "title" => "mdi-apple-keyboard-command"
            ],
            [
                "icon" => "mdi-apple-keyboard-control",
                "title" => "mdi-apple-keyboard-control"
            ],
            [
                "icon" => "mdi-apple-keyboard-option",
                "title" => "mdi-apple-keyboard-option"
            ],
            [
                "icon" => "mdi-apple-keyboard-shift",
                "title" => "mdi-apple-keyboard-shift"
            ],
            [
                "icon" => "mdi-apple-mobileme",
                "title" => "mdi-apple-mobileme"
            ],
            [
                "icon" => "mdi-apple-safari",
                "title" => "mdi-apple-safari"
            ],
            [
                "icon" => "mdi-application",
                "title" => "mdi-application"
            ],
            [
                "icon" => "mdi-approval",
                "title" => "mdi-approval"
            ],
            [
                "icon" => "mdi-apps",
                "title" => "mdi-apps"
            ],
            [
                "icon" => "mdi-archive",
                "title" => "mdi-archive"
            ],
            [
                "icon" => "mdi-arrange-bring-forward",
                "title" => "mdi-arrange-bring-forward"
            ],
            [
                "icon" => "mdi-arrange-bring-to-front",
                "title" => "mdi-arrange-bring-to-front"
            ],
            [
                "icon" => "mdi-arrange-send-backward",
                "title" => "mdi-arrange-send-backward"
            ],
            [
                "icon" => "mdi-arrange-send-to-back",
                "title" => "mdi-arrange-send-to-back"
            ],
            [
                "icon" => "mdi-arrow-all",
                "title" => "mdi-arrow-all"
            ],
            [
                "icon" => "mdi-arrow-bottom-left",
                "title" => "mdi-arrow-bottom-left"
            ],
            [
                "icon" => "mdi-arrow-bottom-right",
                "title" => "mdi-arrow-bottom-right"
            ],
            [
                "icon" => "mdi-arrow-collapse",
                "title" => "mdi-arrow-collapse"
            ],
            [
                "icon" => "mdi-arrow-collapse-all",
                "title" => "mdi-arrow-collapse-all"
            ],
            [
                "icon" => "mdi-arrow-collapse-down",
                "title" => "mdi-arrow-collapse-down"
            ],
            [
                "icon" => "mdi-arrow-collapse-left",
                "title" => "mdi-arrow-collapse-left"
            ],
            [
                "icon" => "mdi-arrow-collapse-right",
                "title" => "mdi-arrow-collapse-right"
            ],
            [
                "icon" => "mdi-arrow-collapse-up",
                "title" => "mdi-arrow-collapse-up"
            ],
            [
                "icon" => "mdi-arrow-down",
                "title" => "mdi-arrow-down"
            ],
            [
                "icon" => "mdi-arrow-down-bold",
                "title" => "mdi-arrow-down-bold"
            ],
            [
                "icon" => "mdi-arrow-down-bold-box",
                "title" => "mdi-arrow-down-bold-box"
            ],
            [
                "icon" => "mdi-arrow-down-bold-box-outline",
                "title" => "mdi-arrow-down-bold-box-outline"
            ],
            [
                "icon" => "mdi-arrow-down-bold-circle",
                "title" => "mdi-arrow-down-bold-circle"
            ],
            [
                "icon" => "mdi-arrow-down-bold-circle-outline",
                "title" => "mdi-arrow-down-bold-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-down-bold-hexagon-outline",
                "title" => "mdi-arrow-down-bold-hexagon-outline"
            ],
            [
                "icon" => "mdi-arrow-down-box",
                "title" => "mdi-arrow-down-box"
            ],
            [
                "icon" => "mdi-arrow-down-drop-circle",
                "title" => "mdi-arrow-down-drop-circle"
            ],
            [
                "icon" => "mdi-arrow-down-drop-circle-outline",
                "title" => "mdi-arrow-down-drop-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-down-thick",
                "title" => "mdi-arrow-down-thick"
            ],
            [
                "icon" => "mdi-arrow-expand",
                "title" => "mdi-arrow-expand"
            ],
            [
                "icon" => "mdi-arrow-expand-all",
                "title" => "mdi-arrow-expand-all"
            ],
            [
                "icon" => "mdi-arrow-expand-down",
                "title" => "mdi-arrow-expand-down"
            ],
            [
                "icon" => "mdi-arrow-expand-left",
                "title" => "mdi-arrow-expand-left"
            ],
            [
                "icon" => "mdi-arrow-expand-right",
                "title" => "mdi-arrow-expand-right"
            ],
            [
                "icon" => "mdi-arrow-expand-up",
                "title" => "mdi-arrow-expand-up"
            ],
            [
                "icon" => "mdi-arrow-left",
                "title" => "mdi-arrow-left"
            ],
            [
                "icon" => "mdi-arrow-left-bold",
                "title" => "mdi-arrow-left-bold"
            ],
            [
                "icon" => "mdi-arrow-left-bold-box",
                "title" => "mdi-arrow-left-bold-box"
            ],
            [
                "icon" => "mdi-arrow-left-bold-box-outline",
                "title" => "mdi-arrow-left-bold-box-outline"
            ],
            [
                "icon" => "mdi-arrow-left-bold-circle",
                "title" => "mdi-arrow-left-bold-circle"
            ],
            [
                "icon" => "mdi-arrow-left-bold-circle-outline",
                "title" => "mdi-arrow-left-bold-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-left-bold-hexagon-outline",
                "title" => "mdi-arrow-left-bold-hexagon-outline"
            ],
            [
                "icon" => "mdi-arrow-left-box",
                "title" => "mdi-arrow-left-box"
            ],
            [
                "icon" => "mdi-arrow-left-drop-circle",
                "title" => "mdi-arrow-left-drop-circle"
            ],
            [
                "icon" => "mdi-arrow-left-drop-circle-outline",
                "title" => "mdi-arrow-left-drop-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-left-thick",
                "title" => "mdi-arrow-left-thick"
            ],
            [
                "icon" => "mdi-arrow-right",
                "title" => "mdi-arrow-right"
            ],
            [
                "icon" => "mdi-arrow-right-bold",
                "title" => "mdi-arrow-right-bold"
            ],
            [
                "icon" => "mdi-arrow-right-bold-box",
                "title" => "mdi-arrow-right-bold-box"
            ],
            [
                "icon" => "mdi-arrow-right-bold-box-outline",
                "title" => "mdi-arrow-right-bold-box-outline"
            ],
            [
                "icon" => "mdi-arrow-right-bold-circle",
                "title" => "mdi-arrow-right-bold-circle"
            ],
            [
                "icon" => "mdi-arrow-right-bold-circle-outline",
                "title" => "mdi-arrow-right-bold-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-right-bold-hexagon-outline",
                "title" => "mdi-arrow-right-bold-hexagon-outline"
            ],
            [
                "icon" => "mdi-arrow-right-box",
                "title" => "mdi-arrow-right-box"
            ],
            [
                "icon" => "mdi-arrow-right-drop-circle",
                "title" => "mdi-arrow-right-drop-circle"
            ],
            [
                "icon" => "mdi-arrow-right-drop-circle-outline",
                "title" => "mdi-arrow-right-drop-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-right-thick",
                "title" => "mdi-arrow-right-thick"
            ],
            [
                "icon" => "mdi-arrow-top-left",
                "title" => "mdi-arrow-top-left"
            ],
            [
                "icon" => "mdi-arrow-top-right",
                "title" => "mdi-arrow-top-right"
            ],
            [
                "icon" => "mdi-arrow-up",
                "title" => "mdi-arrow-up"
            ],
            [
                "icon" => "mdi-arrow-up-bold",
                "title" => "mdi-arrow-up-bold"
            ],
            [
                "icon" => "mdi-arrow-up-bold-box",
                "title" => "mdi-arrow-up-bold-box"
            ],
            [
                "icon" => "mdi-arrow-up-bold-box-outline",
                "title" => "mdi-arrow-up-bold-box-outline"
            ],
            [
                "icon" => "mdi-arrow-up-bold-circle",
                "title" => "mdi-arrow-up-bold-circle"
            ],
            [
                "icon" => "mdi-arrow-up-bold-circle-outline",
                "title" => "mdi-arrow-up-bold-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-up-bold-hexagon-outline",
                "title" => "mdi-arrow-up-bold-hexagon-outline"
            ],
            [
                "icon" => "mdi-arrow-up-box",
                "title" => "mdi-arrow-up-box"
            ],
            [
                "icon" => "mdi-arrow-up-drop-circle",
                "title" => "mdi-arrow-up-drop-circle"
            ],
            [
                "icon" => "mdi-arrow-up-drop-circle-outline",
                "title" => "mdi-arrow-up-drop-circle-outline"
            ],
            [
                "icon" => "mdi-arrow-up-thick",
                "title" => "mdi-arrow-up-thick"
            ],
            [
                "icon" => "mdi-assistant",
                "title" => "mdi-assistant"
            ],
            [
                "icon" => "mdi-asterisk",
                "title" => "mdi-asterisk"
            ],
            [
                "icon" => "mdi-at",
                "title" => "mdi-at"
            ],
            [
                "icon" => "mdi-atom",
                "title" => "mdi-atom"
            ],
            [
                "icon" => "mdi-attachment",
                "title" => "mdi-attachment"
            ],
            [
                "icon" => "mdi-audiobook",
                "title" => "mdi-audiobook"
            ],
            [
                "icon" => "mdi-auto-fix",
                "title" => "mdi-auto-fix"
            ],
            [
                "icon" => "mdi-auto-upload",
                "title" => "mdi-auto-upload"
            ],
            [
                "icon" => "mdi-autorenew",
                "title" => "mdi-autorenew"
            ],
            [
                "icon" => "mdi-av-timer",
                "title" => "mdi-av-timer"
            ],
            [
                "icon" => "mdi-baby",
                "title" => "mdi-baby"
            ],
            [
                "icon" => "mdi-baby-buggy",
                "title" => "mdi-baby-buggy"
            ],
            [
                "icon" => "mdi-backburger",
                "title" => "mdi-backburger"
            ],
            [
                "icon" => "mdi-backspace",
                "title" => "mdi-backspace"
            ],
            [
                "icon" => "mdi-backup-restore",
                "title" => "mdi-backup-restore"
            ],
            [
                "icon" => "mdi-bandcamp",
                "title" => "mdi-bandcamp"
            ],
            [
                "icon" => "mdi-bank",
                "title" => "mdi-bank"
            ],
            [
                "icon" => "mdi-barcode",
                "title" => "mdi-barcode"
            ],
            [
                "icon" => "mdi-barcode-scan",
                "title" => "mdi-barcode-scan"
            ],
            [
                "icon" => "mdi-barley",
                "title" => "mdi-barley"
            ],
            [
                "icon" => "mdi-barrel",
                "title" => "mdi-barrel"
            ],
            [
                "icon" => "mdi-basecamp",
                "title" => "mdi-basecamp"
            ],
            [
                "icon" => "mdi-basket",
                "title" => "mdi-basket"
            ],
            [
                "icon" => "mdi-basket-fill",
                "title" => "mdi-basket-fill"
            ],
            [
                "icon" => "mdi-basket-unfill",
                "title" => "mdi-basket-unfill"
            ],
            [
                "icon" => "mdi-battery",
                "title" => "mdi-battery"
            ],
            [
                "icon" => "mdi-battery-10",
                "title" => "mdi-battery-10"
            ],
            [
                "icon" => "mdi-battery-20",
                "title" => "mdi-battery-20"
            ],
            [
                "icon" => "mdi-battery-30",
                "title" => "mdi-battery-30"
            ],
            [
                "icon" => "mdi-battery-40",
                "title" => "mdi-battery-40"
            ],
            [
                "icon" => "mdi-battery-50",
                "title" => "mdi-battery-50"
            ],
            [
                "icon" => "mdi-battery-60",
                "title" => "mdi-battery-60"
            ],
            [
                "icon" => "mdi-battery-70",
                "title" => "mdi-battery-70"
            ],
            [
                "icon" => "mdi-battery-80",
                "title" => "mdi-battery-80"
            ],
            [
                "icon" => "mdi-battery-90",
                "title" => "mdi-battery-90"
            ],
            [
                "icon" => "mdi-battery-alert",
                "title" => "mdi-battery-alert"
            ],
            [
                "icon" => "mdi-battery-charging",
                "title" => "mdi-battery-charging"
            ],
            [
                "icon" => "mdi-battery-charging-100",
                "title" => "mdi-battery-charging-100"
            ],
            [
                "icon" => "mdi-battery-charging-20",
                "title" => "mdi-battery-charging-20"
            ],
            [
                "icon" => "mdi-battery-charging-30",
                "title" => "mdi-battery-charging-30"
            ],
            [
                "icon" => "mdi-battery-charging-40",
                "title" => "mdi-battery-charging-40"
            ],
            [
                "icon" => "mdi-battery-charging-60",
                "title" => "mdi-battery-charging-60"
            ],
            [
                "icon" => "mdi-battery-charging-80",
                "title" => "mdi-battery-charging-80"
            ],
            [
                "icon" => "mdi-battery-charging-90",
                "title" => "mdi-battery-charging-90"
            ],
            [
                "icon" => "mdi-battery-minus",
                "title" => "mdi-battery-minus"
            ],
            [
                "icon" => "mdi-battery-negative",
                "title" => "mdi-battery-negative"
            ],
            [
                "icon" => "mdi-battery-outline",
                "title" => "mdi-battery-outline"
            ],
            [
                "icon" => "mdi-battery-plus",
                "title" => "mdi-battery-plus"
            ],
            [
                "icon" => "mdi-battery-positive",
                "title" => "mdi-battery-positive"
            ],
            [
                "icon" => "mdi-battery-unknown",
                "title" => "mdi-battery-unknown"
            ],
            [
                "icon" => "mdi-beach",
                "title" => "mdi-beach"
            ],
            [
                "icon" => "mdi-beaker",
                "title" => "mdi-beaker"
            ],
            [
                "icon" => "mdi-beats",
                "title" => "mdi-beats"
            ],
            [
                "icon" => "mdi-beer",
                "title" => "mdi-beer"
            ],
            [
                "icon" => "mdi-behance",
                "title" => "mdi-behance"
            ],
            [
                "icon" => "mdi-bell",
                "title" => "mdi-bell"
            ],
            [
                "icon" => "mdi-bell-off",
                "title" => "mdi-bell-off"
            ],
            [
                "icon" => "mdi-bell-outline",
                "title" => "mdi-bell-outline"
            ],
            [
                "icon" => "mdi-bell-plus",
                "title" => "mdi-bell-plus"
            ],
            [
                "icon" => "mdi-bell-ring",
                "title" => "mdi-bell-ring"
            ],
            [
                "icon" => "mdi-bell-ring-outline",
                "title" => "mdi-bell-ring-outline"
            ],
            [
                "icon" => "mdi-bell-sleep",
                "title" => "mdi-bell-sleep"
            ],
            [
                "icon" => "mdi-beta",
                "title" => "mdi-beta"
            ],
            [
                "icon" => "mdi-bible",
                "title" => "mdi-bible"
            ],
            [
                "icon" => "mdi-bike",
                "title" => "mdi-bike"
            ],
            [
                "icon" => "mdi-bing",
                "title" => "mdi-bing"
            ],
            [
                "icon" => "mdi-binoculars",
                "title" => "mdi-binoculars"
            ],
            [
                "icon" => "mdi-bio",
                "title" => "mdi-bio"
            ],
            [
                "icon" => "mdi-biohazard",
                "title" => "mdi-biohazard"
            ],
            [
                "icon" => "mdi-bitbucket",
                "title" => "mdi-bitbucket"
            ],
            [
                "icon" => "mdi-black-mesa",
                "title" => "mdi-black-mesa"
            ],
            [
                "icon" => "mdi-blackberry",
                "title" => "mdi-blackberry"
            ],
            [
                "icon" => "mdi-blender",
                "title" => "mdi-blender"
            ],
            [
                "icon" => "mdi-blinds",
                "title" => "mdi-blinds"
            ],
            [
                "icon" => "mdi-block-helper",
                "title" => "mdi-block-helper"
            ],
            [
                "icon" => "mdi-blogger",
                "title" => "mdi-blogger"
            ],
            [
                "icon" => "mdi-bluetooth",
                "title" => "mdi-bluetooth"
            ],
            [
                "icon" => "mdi-bluetooth-audio",
                "title" => "mdi-bluetooth-audio"
            ],
            [
                "icon" => "mdi-bluetooth-connect",
                "title" => "mdi-bluetooth-connect"
            ],
            [
                "icon" => "mdi-bluetooth-off",
                "title" => "mdi-bluetooth-off"
            ],
            [
                "icon" => "mdi-bluetooth-settings",
                "title" => "mdi-bluetooth-settings"
            ],
            [
                "icon" => "mdi-bluetooth-transfer",
                "title" => "mdi-bluetooth-transfer"
            ],
            [
                "icon" => "mdi-blur",
                "title" => "mdi-blur"
            ],
            [
                "icon" => "mdi-blur-linear",
                "title" => "mdi-blur-linear"
            ],
            [
                "icon" => "mdi-blur-off",
                "title" => "mdi-blur-off"
            ],
            [
                "icon" => "mdi-blur-radial",
                "title" => "mdi-blur-radial"
            ],
            [
                "icon" => "mdi-bomb",
                "title" => "mdi-bomb"
            ],
            [
                "icon" => "mdi-bomb-off",
                "title" => "mdi-bomb-off"
            ],
            [
                "icon" => "mdi-bone",
                "title" => "mdi-bone"
            ],
            [
                "icon" => "mdi-book",
                "title" => "mdi-book"
            ],
            [
                "icon" => "mdi-book-minus",
                "title" => "mdi-book-minus"
            ],
            [
                "icon" => "mdi-book-multiple",
                "title" => "mdi-book-multiple"
            ],
            [
                "icon" => "mdi-book-multiple-variant",
                "title" => "mdi-book-multiple-variant"
            ],
            [
                "icon" => "mdi-book-open",
                "title" => "mdi-book-open"
            ],
            [
                "icon" => "mdi-book-open-page-variant",
                "title" => "mdi-book-open-page-variant"
            ],
            [
                "icon" => "mdi-book-open-variant",
                "title" => "mdi-book-open-variant"
            ],
            [
                "icon" => "mdi-book-plus",
                "title" => "mdi-book-plus"
            ],
            [
                "icon" => "mdi-book-secure",
                "title" => "mdi-book-secure"
            ],
            [
                "icon" => "mdi-book-unsecure",
                "title" => "mdi-book-unsecure"
            ],
            [
                "icon" => "mdi-book-variant",
                "title" => "mdi-book-variant"
            ],
            [
                "icon" => "mdi-bookmark",
                "title" => "mdi-bookmark"
            ],
            [
                "icon" => "mdi-bookmark-check",
                "title" => "mdi-bookmark-check"
            ],
            [
                "icon" => "mdi-bookmark-music",
                "title" => "mdi-bookmark-music"
            ],
            [
                "icon" => "mdi-bookmark-outline",
                "title" => "mdi-bookmark-outline"
            ],
            [
                "icon" => "mdi-bookmark-plus",
                "title" => "mdi-bookmark-plus"
            ],
            [
                "icon" => "mdi-bookmark-plus-outline",
                "title" => "mdi-bookmark-plus-outline"
            ],
            [
                "icon" => "mdi-bookmark-remove",
                "title" => "mdi-bookmark-remove"
            ],
            [
                "icon" => "mdi-boombox",
                "title" => "mdi-boombox"
            ],
            [
                "icon" => "mdi-bootstrap",
                "title" => "mdi-bootstrap"
            ],
            [
                "icon" => "mdi-border-all",
                "title" => "mdi-border-all"
            ],
            [
                "icon" => "mdi-border-bottom",
                "title" => "mdi-border-bottom"
            ],
            [
                "icon" => "mdi-border-color",
                "title" => "mdi-border-color"
            ],
            [
                "icon" => "mdi-border-horizontal",
                "title" => "mdi-border-horizontal"
            ],
            [
                "icon" => "mdi-border-inside",
                "title" => "mdi-border-inside"
            ],
            [
                "icon" => "mdi-border-left",
                "title" => "mdi-border-left"
            ],
            [
                "icon" => "mdi-border-none",
                "title" => "mdi-border-none"
            ],
            [
                "icon" => "mdi-border-outside",
                "title" => "mdi-border-outside"
            ],
            [
                "icon" => "mdi-border-right",
                "title" => "mdi-border-right"
            ],
            [
                "icon" => "mdi-border-style",
                "title" => "mdi-border-style"
            ],
            [
                "icon" => "mdi-border-top",
                "title" => "mdi-border-top"
            ],
            [
                "icon" => "mdi-border-vertical",
                "title" => "mdi-border-vertical"
            ],
            [
                "icon" => "mdi-bow-tie",
                "title" => "mdi-bow-tie"
            ],
            [
                "icon" => "mdi-bowl",
                "title" => "mdi-bowl"
            ],
            [
                "icon" => "mdi-bowling",
                "title" => "mdi-bowling"
            ],
            [
                "icon" => "mdi-box",
                "title" => "mdi-box"
            ],
            [
                "icon" => "mdi-box-cutter",
                "title" => "mdi-box-cutter"
            ],
            [
                "icon" => "mdi-box-shadow",
                "title" => "mdi-box-shadow"
            ],
            [
                "icon" => "mdi-bridge",
                "title" => "mdi-bridge"
            ],
            [
                "icon" => "mdi-briefcase",
                "title" => "mdi-briefcase"
            ],
            [
                "icon" => "mdi-briefcase-check",
                "title" => "mdi-briefcase-check"
            ],
            [
                "icon" => "mdi-briefcase-download",
                "title" => "mdi-briefcase-download"
            ],
            [
                "icon" => "mdi-briefcase-upload",
                "title" => "mdi-briefcase-upload"
            ],
            [
                "icon" => "mdi-brightness-1",
                "title" => "mdi-brightness-1"
            ],
            [
                "icon" => "mdi-brightness-2",
                "title" => "mdi-brightness-2"
            ],
            [
                "icon" => "mdi-brightness-3",
                "title" => "mdi-brightness-3"
            ],
            [
                "icon" => "mdi-brightness-4",
                "title" => "mdi-brightness-4"
            ],
            [
                "icon" => "mdi-brightness-5",
                "title" => "mdi-brightness-5"
            ],
            [
                "icon" => "mdi-brightness-6",
                "title" => "mdi-brightness-6"
            ],
            [
                "icon" => "mdi-brightness-7",
                "title" => "mdi-brightness-7"
            ],
            [
                "icon" => "mdi-brightness-auto",
                "title" => "mdi-brightness-auto"
            ],
            [
                "icon" => "mdi-broom",
                "title" => "mdi-broom"
            ],
            [
                "icon" => "mdi-brush",
                "title" => "mdi-brush"
            ],
            [
                "icon" => "mdi-buffer",
                "title" => "mdi-buffer"
            ],
            [
                "icon" => "mdi-bug",
                "title" => "mdi-bug"
            ],
            [
                "icon" => "mdi-bulletin-board",
                "title" => "mdi-bulletin-board"
            ],
            [
                "icon" => "mdi-bullhorn",
                "title" => "mdi-bullhorn"
            ],
            [
                "icon" => "mdi-bullseye",
                "title" => "mdi-bullseye"
            ],
            [
                "icon" => "mdi-burst-mode",
                "title" => "mdi-burst-mode"
            ],
            [
                "icon" => "mdi-bus",
                "title" => "mdi-bus"
            ],
            [
                "icon" => "mdi-bus-articulated-end",
                "title" => "mdi-bus-articulated-end"
            ],
            [
                "icon" => "mdi-bus-articulated-front",
                "title" => "mdi-bus-articulated-front"
            ],
            [
                "icon" => "mdi-bus-double-decker",
                "title" => "mdi-bus-double-decker"
            ],
            [
                "icon" => "mdi-bus-school",
                "title" => "mdi-bus-school"
            ],
            [
                "icon" => "mdi-bus-side",
                "title" => "mdi-bus-side"
            ],
            [
                "icon" => "mdi-cached",
                "title" => "mdi-cached"
            ],
            [
                "icon" => "mdi-cake",
                "title" => "mdi-cake"
            ],
            [
                "icon" => "mdi-cake-layered",
                "title" => "mdi-cake-layered"
            ],
            [
                "icon" => "mdi-cake-variant",
                "title" => "mdi-cake-variant"
            ],
            [
                "icon" => "mdi-calculator",
                "title" => "mdi-calculator"
            ],
            [
                "icon" => "mdi-calendar",
                "title" => "mdi-calendar"
            ],
            [
                "icon" => "mdi-calendar-blank",
                "title" => "mdi-calendar-blank"
            ],
            [
                "icon" => "mdi-calendar-check",
                "title" => "mdi-calendar-check"
            ],
            [
                "icon" => "mdi-calendar-clock",
                "title" => "mdi-calendar-clock"
            ],
            [
                "icon" => "mdi-calendar-multiple",
                "title" => "mdi-calendar-multiple"
            ],
            [
                "icon" => "mdi-calendar-multiple-check",
                "title" => "mdi-calendar-multiple-check"
            ],
            [
                "icon" => "mdi-calendar-plus",
                "title" => "mdi-calendar-plus"
            ],
            [
                "icon" => "mdi-calendar-question",
                "title" => "mdi-calendar-question"
            ],
            [
                "icon" => "mdi-calendar-range",
                "title" => "mdi-calendar-range"
            ],
            [
                "icon" => "mdi-calendar-remove",
                "title" => "mdi-calendar-remove"
            ],
            [
                "icon" => "mdi-calendar-text",
                "title" => "mdi-calendar-text"
            ],
            [
                "icon" => "mdi-calendar-today",
                "title" => "mdi-calendar-today"
            ],
            [
                "icon" => "mdi-call-made",
                "title" => "mdi-call-made"
            ],
            [
                "icon" => "mdi-call-merge",
                "title" => "mdi-call-merge"
            ],
            [
                "icon" => "mdi-call-missed",
                "title" => "mdi-call-missed"
            ],
            [
                "icon" => "mdi-call-received",
                "title" => "mdi-call-received"
            ],
            [
                "icon" => "mdi-call-split",
                "title" => "mdi-call-split"
            ],
            [
                "icon" => "mdi-camcorder",
                "title" => "mdi-camcorder"
            ],
            [
                "icon" => "mdi-camcorder-box",
                "title" => "mdi-camcorder-box"
            ],
            [
                "icon" => "mdi-camcorder-box-off",
                "title" => "mdi-camcorder-box-off"
            ],
            [
                "icon" => "mdi-camcorder-off",
                "title" => "mdi-camcorder-off"
            ],
            [
                "icon" => "mdi-camera",
                "title" => "mdi-camera"
            ],
            [
                "icon" => "mdi-camera-burst",
                "title" => "mdi-camera-burst"
            ],
            [
                "icon" => "mdi-camera-enhance",
                "title" => "mdi-camera-enhance"
            ],
            [
                "icon" => "mdi-camera-front",
                "title" => "mdi-camera-front"
            ],
            [
                "icon" => "mdi-camera-front-variant",
                "title" => "mdi-camera-front-variant"
            ],
            [
                "icon" => "mdi-camera-gopro",
                "title" => "mdi-camera-gopro"
            ],
            [
                "icon" => "mdi-camera-iris",
                "title" => "mdi-camera-iris"
            ],
            [
                "icon" => "mdi-camera-metering-center",
                "title" => "mdi-camera-metering-center"
            ],
            [
                "icon" => "mdi-camera-metering-matrix",
                "title" => "mdi-camera-metering-matrix"
            ],
            [
                "icon" => "mdi-camera-metering-partial",
                "title" => "mdi-camera-metering-partial"
            ],
            [
                "icon" => "mdi-camera-metering-spot",
                "title" => "mdi-camera-metering-spot"
            ],
            [
                "icon" => "mdi-camera-off",
                "title" => "mdi-camera-off"
            ],
            [
                "icon" => "mdi-camera-party-mode",
                "title" => "mdi-camera-party-mode"
            ],
            [
                "icon" => "mdi-camera-rear",
                "title" => "mdi-camera-rear"
            ],
            [
                "icon" => "mdi-camera-rear-variant",
                "title" => "mdi-camera-rear-variant"
            ],
            [
                "icon" => "mdi-camera-switch",
                "title" => "mdi-camera-switch"
            ],
            [
                "icon" => "mdi-camera-timer",
                "title" => "mdi-camera-timer"
            ],
            [
                "icon" => "mdi-cancel",
                "title" => "mdi-cancel"
            ],
            [
                "icon" => "mdi-candle",
                "title" => "mdi-candle"
            ],
            [
                "icon" => "mdi-candycane",
                "title" => "mdi-candycane"
            ],
            [
                "icon" => "mdi-cannabis",
                "title" => "mdi-cannabis"
            ],
            [
                "icon" => "mdi-car",
                "title" => "mdi-car"
            ],
            [
                "icon" => "mdi-car-battery",
                "title" => "mdi-car-battery"
            ],
            [
                "icon" => "mdi-car-connected",
                "title" => "mdi-car-connected"
            ],
            [
                "icon" => "mdi-car-convertable",
                "title" => "mdi-car-convertable"
            ],
            [
                "icon" => "mdi-car-estate",
                "title" => "mdi-car-estate"
            ],
            [
                "icon" => "mdi-car-hatchback",
                "title" => "mdi-car-hatchback"
            ],
            [
                "icon" => "mdi-car-pickup",
                "title" => "mdi-car-pickup"
            ],
            [
                "icon" => "mdi-car-side",
                "title" => "mdi-car-side"
            ],
            [
                "icon" => "mdi-car-sports",
                "title" => "mdi-car-sports"
            ],
            [
                "icon" => "mdi-car-wash",
                "title" => "mdi-car-wash"
            ],
            [
                "icon" => "mdi-caravan",
                "title" => "mdi-caravan"
            ],
            [
                "icon" => "mdi-cards",
                "title" => "mdi-cards"
            ],
            [
                "icon" => "mdi-cards-outline",
                "title" => "mdi-cards-outline"
            ],
            [
                "icon" => "mdi-cards-playing-outline",
                "title" => "mdi-cards-playing-outline"
            ],
            [
                "icon" => "mdi-cards-variant",
                "title" => "mdi-cards-variant"
            ],
            [
                "icon" => "mdi-carrot",
                "title" => "mdi-carrot"
            ],
            [
                "icon" => "mdi-cart",
                "title" => "mdi-cart"
            ],
            [
                "icon" => "mdi-cart-off",
                "title" => "mdi-cart-off"
            ],
            [
                "icon" => "mdi-cart-outline",
                "title" => "mdi-cart-outline"
            ],
            [
                "icon" => "mdi-cart-plus",
                "title" => "mdi-cart-plus"
            ],
            [
                "icon" => "mdi-case-sensitive-alt",
                "title" => "mdi-case-sensitive-alt"
            ],
            [
                "icon" => "mdi-cash",
                "title" => "mdi-cash"
            ],
            [
                "icon" => "mdi-cash-100",
                "title" => "mdi-cash-100"
            ],
            [
                "icon" => "mdi-cash-multiple",
                "title" => "mdi-cash-multiple"
            ],
            [
                "icon" => "mdi-cash-usd",
                "title" => "mdi-cash-usd"
            ],
            [
                "icon" => "mdi-cast",
                "title" => "mdi-cast"
            ],
            [
                "icon" => "mdi-cast-connected",
                "title" => "mdi-cast-connected"
            ],
            [
                "icon" => "mdi-cast-off",
                "title" => "mdi-cast-off"
            ],
            [
                "icon" => "mdi-castle",
                "title" => "mdi-castle"
            ],
            [
                "icon" => "mdi-cat",
                "title" => "mdi-cat"
            ],
            [
                "icon" => "mdi-cctv",
                "title" => "mdi-cctv"
            ],
            [
                "icon" => "mdi-ceiling-light",
                "title" => "mdi-ceiling-light"
            ],
            [
                "icon" => "mdi-cellphone",
                "title" => "mdi-cellphone"
            ],
            [
                "icon" => "mdi-cellphone-android",
                "title" => "mdi-cellphone-android"
            ],
            [
                "icon" => "mdi-cellphone-basic",
                "title" => "mdi-cellphone-basic"
            ],
            [
                "icon" => "mdi-cellphone-dock",
                "title" => "mdi-cellphone-dock"
            ],
            [
                "icon" => "mdi-cellphone-iphone",
                "title" => "mdi-cellphone-iphone"
            ],
            [
                "icon" => "mdi-cellphone-link",
                "title" => "mdi-cellphone-link"
            ],
            [
                "icon" => "mdi-cellphone-link-off",
                "title" => "mdi-cellphone-link-off"
            ],
            [
                "icon" => "mdi-cellphone-settings",
                "title" => "mdi-cellphone-settings"
            ],
            [
                "icon" => "mdi-certificate",
                "title" => "mdi-certificate"
            ],
            [
                "icon" => "mdi-chair-school",
                "title" => "mdi-chair-school"
            ],
            [
                "icon" => "mdi-chart-arc",
                "title" => "mdi-chart-arc"
            ],
            [
                "icon" => "mdi-chart-areaspline",
                "title" => "mdi-chart-areaspline"
            ],
            [
                "icon" => "mdi-chart-bar",
                "title" => "mdi-chart-bar"
            ],
            [
                "icon" => "mdi-chart-bar-stacked",
                "title" => "mdi-chart-bar-stacked"
            ],
            [
                "icon" => "mdi-chart-bubble",
                "title" => "mdi-chart-bubble"
            ],
            [
                "icon" => "mdi-chart-donut",
                "title" => "mdi-chart-donut"
            ],
            [
                "icon" => "mdi-chart-donut-variant",
                "title" => "mdi-chart-donut-variant"
            ],
            [
                "icon" => "mdi-chart-gantt",
                "title" => "mdi-chart-gantt"
            ],
            [
                "icon" => "mdi-chart-histogram",
                "title" => "mdi-chart-histogram"
            ],
            [
                "icon" => "mdi-chart-line",
                "title" => "mdi-chart-line"
            ],
            [
                "icon" => "mdi-chart-line-stacked",
                "title" => "mdi-chart-line-stacked"
            ],
            [
                "icon" => "mdi-chart-line-variant",
                "title" => "mdi-chart-line-variant"
            ],
            [
                "icon" => "mdi-chart-pie",
                "title" => "mdi-chart-pie"
            ],
            [
                "icon" => "mdi-chart-scatterplot-hexbin",
                "title" => "mdi-chart-scatterplot-hexbin"
            ],
            [
                "icon" => "mdi-chart-timeline",
                "title" => "mdi-chart-timeline"
            ],
            [
                "icon" => "mdi-check",
                "title" => "mdi-check"
            ],
            [
                "icon" => "mdi-check-all",
                "title" => "mdi-check-all"
            ],
            [
                "icon" => "mdi-check-circle",
                "title" => "mdi-check-circle"
            ],
            [
                "icon" => "mdi-check-circle-outline",
                "title" => "mdi-check-circle-outline"
            ],
            [
                "icon" => "mdi-checkbox-blank",
                "title" => "mdi-checkbox-blank"
            ],
            [
                "icon" => "mdi-checkbox-blank-circle",
                "title" => "mdi-checkbox-blank-circle"
            ],
            [
                "icon" => "mdi-checkbox-blank-circle-outline",
                "title" => "mdi-checkbox-blank-circle-outline"
            ],
            [
                "icon" => "mdi-checkbox-blank-outline",
                "title" => "mdi-checkbox-blank-outline"
            ],
            [
                "icon" => "mdi-checkbox-marked",
                "title" => "mdi-checkbox-marked"
            ],
            [
                "icon" => "mdi-checkbox-marked-circle",
                "title" => "mdi-checkbox-marked-circle"
            ],
            [
                "icon" => "mdi-checkbox-marked-circle-outline",
                "title" => "mdi-checkbox-marked-circle-outline"
            ],
            [
                "icon" => "mdi-checkbox-marked-outline",
                "title" => "mdi-checkbox-marked-outline"
            ],
            [
                "icon" => "mdi-checkbox-multiple-blank",
                "title" => "mdi-checkbox-multiple-blank"
            ],
            [
                "icon" => "mdi-checkbox-multiple-blank-circle",
                "title" => "mdi-checkbox-multiple-blank-circle"
            ],
            [
                "icon" => "mdi-checkbox-multiple-blank-circle-outline",
                "title" => "mdi-checkbox-multiple-blank-circle-outline"
            ],
            [
                "icon" => "mdi-checkbox-multiple-blank-outline",
                "title" => "mdi-checkbox-multiple-blank-outline"
            ],
            [
                "icon" => "mdi-checkbox-multiple-marked",
                "title" => "mdi-checkbox-multiple-marked"
            ],
            [
                "icon" => "mdi-checkbox-multiple-marked-circle",
                "title" => "mdi-checkbox-multiple-marked-circle"
            ],
            [
                "icon" => "mdi-checkbox-multiple-marked-circle-outline",
                "title" => "mdi-checkbox-multiple-marked-circle-outline"
            ],
            [
                "icon" => "mdi-checkbox-multiple-marked-outline",
                "title" => "mdi-checkbox-multiple-marked-outline"
            ],
            [
                "icon" => "mdi-checkerboard",
                "title" => "mdi-checkerboard"
            ],
            [
                "icon" => "mdi-chemical-weapon",
                "title" => "mdi-chemical-weapon"
            ],
            [
                "icon" => "mdi-chevron-double-down",
                "title" => "mdi-chevron-double-down"
            ],
            [
                "icon" => "mdi-chevron-double-left",
                "title" => "mdi-chevron-double-left"
            ],
            [
                "icon" => "mdi-chevron-double-right",
                "title" => "mdi-chevron-double-right"
            ],
            [
                "icon" => "mdi-chevron-double-up",
                "title" => "mdi-chevron-double-up"
            ],
            [
                "icon" => "mdi-chevron-down",
                "title" => "mdi-chevron-down"
            ],
            [
                "icon" => "mdi-chevron-left",
                "title" => "mdi-chevron-left"
            ],
            [
                "icon" => "mdi-chevron-right",
                "title" => "mdi-chevron-right"
            ],
            [
                "icon" => "mdi-chevron-up",
                "title" => "mdi-chevron-up"
            ],
            [
                "icon" => "mdi-chili-hot",
                "title" => "mdi-chili-hot"
            ],
            [
                "icon" => "mdi-chili-medium",
                "title" => "mdi-chili-medium"
            ],
            [
                "icon" => "mdi-chili-mild",
                "title" => "mdi-chili-mild"
            ],
            [
                "icon" => "mdi-chip",
                "title" => "mdi-chip"
            ],
            [
                "icon" => "mdi-church",
                "title" => "mdi-church"
            ],
            [
                "icon" => "mdi-circle",
                "title" => "mdi-circle"
            ],
            [
                "icon" => "mdi-circle-outline",
                "title" => "mdi-circle-outline"
            ],
            [
                "icon" => "mdi-cisco-webex",
                "title" => "mdi-cisco-webex"
            ],
            [
                "icon" => "mdi-city",
                "title" => "mdi-city"
            ],
            [
                "icon" => "mdi-clipboard",
                "title" => "mdi-clipboard"
            ],
            [
                "icon" => "mdi-clipboard-account",
                "title" => "mdi-clipboard-account"
            ],
            [
                "icon" => "mdi-clipboard-alert",
                "title" => "mdi-clipboard-alert"
            ],
            [
                "icon" => "mdi-clipboard-arrow-down",
                "title" => "mdi-clipboard-arrow-down"
            ],
            [
                "icon" => "mdi-clipboard-arrow-left",
                "title" => "mdi-clipboard-arrow-left"
            ],
            [
                "icon" => "mdi-clipboard-check",
                "title" => "mdi-clipboard-check"
            ],
            [
                "icon" => "mdi-clipboard-flow",
                "title" => "mdi-clipboard-flow"
            ],
            [
                "icon" => "mdi-clipboard-outline",
                "title" => "mdi-clipboard-outline"
            ],
            [
                "icon" => "mdi-clipboard-plus",
                "title" => "mdi-clipboard-plus"
            ],
            [
                "icon" => "mdi-clipboard-text",
                "title" => "mdi-clipboard-text"
            ],
            [
                "icon" => "mdi-clippy",
                "title" => "mdi-clippy"
            ],
            [
                "icon" => "mdi-clock",
                "title" => "mdi-clock"
            ],
            [
                "icon" => "mdi-clock-alert",
                "title" => "mdi-clock-alert"
            ],
            [
                "icon" => "mdi-clock-end",
                "title" => "mdi-clock-end"
            ],
            [
                "icon" => "mdi-clock-fast",
                "title" => "mdi-clock-fast"
            ],
            [
                "icon" => "mdi-clock-in",
                "title" => "mdi-clock-in"
            ],
            [
                "icon" => "mdi-clock-out",
                "title" => "mdi-clock-out"
            ],
            [
                "icon" => "mdi-clock-start",
                "title" => "mdi-clock-start"
            ],
            [
                "icon" => "mdi-close",
                "title" => "mdi-close"
            ],
            [
                "icon" => "mdi-close-box",
                "title" => "mdi-close-box"
            ],
            [
                "icon" => "mdi-close-box-outline",
                "title" => "mdi-close-box-outline"
            ],
            [
                "icon" => "mdi-close-circle",
                "title" => "mdi-close-circle"
            ],
            [
                "icon" => "mdi-close-circle-outline",
                "title" => "mdi-close-circle-outline"
            ],
            [
                "icon" => "mdi-close-network",
                "title" => "mdi-close-network"
            ],
            [
                "icon" => "mdi-close-octagon",
                "title" => "mdi-close-octagon"
            ],
            [
                "icon" => "mdi-close-octagon-outline",
                "title" => "mdi-close-octagon-outline"
            ],
            [
                "icon" => "mdi-close-outline",
                "title" => "mdi-close-outline"
            ],
            [
                "icon" => "mdi-closed-caption",
                "title" => "mdi-closed-caption"
            ],
            [
                "icon" => "mdi-cloud",
                "title" => "mdi-cloud"
            ],
            [
                "icon" => "mdi-cloud-braces",
                "title" => "mdi-cloud-braces"
            ],
            [
                "icon" => "mdi-cloud-check",
                "title" => "mdi-cloud-check"
            ],
            [
                "icon" => "mdi-cloud-circle",
                "title" => "mdi-cloud-circle"
            ],
            [
                "icon" => "mdi-cloud-download",
                "title" => "mdi-cloud-download"
            ],
            [
                "icon" => "mdi-cloud-off-outline",
                "title" => "mdi-cloud-off-outline"
            ],
            [
                "icon" => "mdi-cloud-outline",
                "title" => "mdi-cloud-outline"
            ],
            [
                "icon" => "mdi-cloud-print",
                "title" => "mdi-cloud-print"
            ],
            [
                "icon" => "mdi-cloud-print-outline",
                "title" => "mdi-cloud-print-outline"
            ],
            [
                "icon" => "mdi-cloud-sync",
                "title" => "mdi-cloud-sync"
            ],
            [
                "icon" => "mdi-cloud-tags",
                "title" => "mdi-cloud-tags"
            ],
            [
                "icon" => "mdi-cloud-upload",
                "title" => "mdi-cloud-upload"
            ],
            [
                "icon" => "mdi-code-array",
                "title" => "mdi-code-array"
            ],
            [
                "icon" => "mdi-code-braces",
                "title" => "mdi-code-braces"
            ],
            [
                "icon" => "mdi-code-brackets",
                "title" => "mdi-code-brackets"
            ],
            [
                "icon" => "mdi-code-equal",
                "title" => "mdi-code-equal"
            ],
            [
                "icon" => "mdi-code-greater-than",
                "title" => "mdi-code-greater-than"
            ],
            [
                "icon" => "mdi-code-greater-than-or-equal",
                "title" => "mdi-code-greater-than-or-equal"
            ],
            [
                "icon" => "mdi-code-less-than",
                "title" => "mdi-code-less-than"
            ],
            [
                "icon" => "mdi-code-less-than-or-equal",
                "title" => "mdi-code-less-than-or-equal"
            ],
            [
                "icon" => "mdi-code-not-equal",
                "title" => "mdi-code-not-equal"
            ],
            [
                "icon" => "mdi-code-not-equal-variant",
                "title" => "mdi-code-not-equal-variant"
            ],
            [
                "icon" => "mdi-code-parentheses",
                "title" => "mdi-code-parentheses"
            ],
            [
                "icon" => "mdi-code-string",
                "title" => "mdi-code-string"
            ],
            [
                "icon" => "mdi-code-tags",
                "title" => "mdi-code-tags"
            ],
            [
                "icon" => "mdi-code-tags-check",
                "title" => "mdi-code-tags-check"
            ],
            [
                "icon" => "mdi-codepen",
                "title" => "mdi-codepen"
            ],
            [
                "icon" => "mdi-coffee",
                "title" => "mdi-coffee"
            ],
            [
                "icon" => "mdi-coffee-outline",
                "title" => "mdi-coffee-outline"
            ],
            [
                "icon" => "mdi-coffee-to-go",
                "title" => "mdi-coffee-to-go"
            ],
            [
                "icon" => "mdi-coin",
                "title" => "mdi-coin"
            ],
            [
                "icon" => "mdi-coins",
                "title" => "mdi-coins"
            ],
            [
                "icon" => "mdi-collage",
                "title" => "mdi-collage"
            ],
            [
                "icon" => "mdi-color-helper",
                "title" => "mdi-color-helper"
            ],
            [
                "icon" => "mdi-comment",
                "title" => "mdi-comment"
            ],
            [
                "icon" => "mdi-comment-account",
                "title" => "mdi-comment-account"
            ],
            [
                "icon" => "mdi-comment-account-outline",
                "title" => "mdi-comment-account-outline"
            ],
            [
                "icon" => "mdi-comment-alert",
                "title" => "mdi-comment-alert"
            ],
            [
                "icon" => "mdi-comment-alert-outline",
                "title" => "mdi-comment-alert-outline"
            ],
            [
                "icon" => "mdi-comment-check",
                "title" => "mdi-comment-check"
            ],
            [
                "icon" => "mdi-comment-check-outline",
                "title" => "mdi-comment-check-outline"
            ],
            [
                "icon" => "mdi-comment-multiple-outline",
                "title" => "mdi-comment-multiple-outline"
            ],
            [
                "icon" => "mdi-comment-outline",
                "title" => "mdi-comment-outline"
            ],
            [
                "icon" => "mdi-comment-plus-outline",
                "title" => "mdi-comment-plus-outline"
            ],
            [
                "icon" => "mdi-comment-processing",
                "title" => "mdi-comment-processing"
            ],
            [
                "icon" => "mdi-comment-processing-outline",
                "title" => "mdi-comment-processing-outline"
            ],
            [
                "icon" => "mdi-comment-question-outline",
                "title" => "mdi-comment-question-outline"
            ],
            [
                "icon" => "mdi-comment-remove-outline",
                "title" => "mdi-comment-remove-outline"
            ],
            [
                "icon" => "mdi-comment-text",
                "title" => "mdi-comment-text"
            ],
            [
                "icon" => "mdi-comment-text-outline",
                "title" => "mdi-comment-text-outline"
            ],
            [
                "icon" => "mdi-compare",
                "title" => "mdi-compare"
            ],
            [
                "icon" => "mdi-compass",
                "title" => "mdi-compass"
            ],
            [
                "icon" => "mdi-compass-outline",
                "title" => "mdi-compass-outline"
            ],
            [
                "icon" => "mdi-console",
                "title" => "mdi-console"
            ],
            [
                "icon" => "mdi-console-line",
                "title" => "mdi-console-line"
            ],
            [
                "icon" => "mdi-contact-mail",
                "title" => "mdi-contact-mail"
            ],
            [
                "icon" => "mdi-contacts",
                "title" => "mdi-contacts"
            ],
            [
                "icon" => "mdi-content-copy",
                "title" => "mdi-content-copy"
            ],
            [
                "icon" => "mdi-content-cut",
                "title" => "mdi-content-cut"
            ],
            [
                "icon" => "mdi-content-duplicate",
                "title" => "mdi-content-duplicate"
            ],
            [
                "icon" => "mdi-content-paste",
                "title" => "mdi-content-paste"
            ],
            [
                "icon" => "mdi-content-save",
                "title" => "mdi-content-save"
            ],
            [
                "icon" => "mdi-content-save-all",
                "title" => "mdi-content-save-all"
            ],
            [
                "icon" => "mdi-content-save-settings",
                "title" => "mdi-content-save-settings"
            ],
            [
                "icon" => "mdi-contrast",
                "title" => "mdi-contrast"
            ],
            [
                "icon" => "mdi-contrast-box",
                "title" => "mdi-contrast-box"
            ],
            [
                "icon" => "mdi-contrast-circle",
                "title" => "mdi-contrast-circle"
            ],
            [
                "icon" => "mdi-cookie",
                "title" => "mdi-cookie"
            ],
            [
                "icon" => "mdi-copyright",
                "title" => "mdi-copyright"
            ],
            [
                "icon" => "mdi-corn",
                "title" => "mdi-corn"
            ],
            [
                "icon" => "mdi-counter",
                "title" => "mdi-counter"
            ],
            [
                "icon" => "mdi-cow",
                "title" => "mdi-cow"
            ],
            [
                "icon" => "mdi-creation",
                "title" => "mdi-creation"
            ],
            [
                "icon" => "mdi-credit-card",
                "title" => "mdi-credit-card"
            ],
            [
                "icon" => "mdi-credit-card-multiple",
                "title" => "mdi-credit-card-multiple"
            ],
            [
                "icon" => "mdi-credit-card-off",
                "title" => "mdi-credit-card-off"
            ],
            [
                "icon" => "mdi-credit-card-plus",
                "title" => "mdi-credit-card-plus"
            ],
            [
                "icon" => "mdi-credit-card-scan",
                "title" => "mdi-credit-card-scan"
            ],
            [
                "icon" => "mdi-crop",
                "title" => "mdi-crop"
            ],
            [
                "icon" => "mdi-crop-free",
                "title" => "mdi-crop-free"
            ],
            [
                "icon" => "mdi-crop-landscape",
                "title" => "mdi-crop-landscape"
            ],
            [
                "icon" => "mdi-crop-portrait",
                "title" => "mdi-crop-portrait"
            ],
            [
                "icon" => "mdi-crop-rotate",
                "title" => "mdi-crop-rotate"
            ],
            [
                "icon" => "mdi-crop-square",
                "title" => "mdi-crop-square"
            ],
            [
                "icon" => "mdi-crosshairs",
                "title" => "mdi-crosshairs"
            ],
            [
                "icon" => "mdi-crosshairs-gps",
                "title" => "mdi-crosshairs-gps"
            ],
            [
                "icon" => "mdi-crown",
                "title" => "mdi-crown"
            ],
            [
                "icon" => "mdi-cube",
                "title" => "mdi-cube"
            ],
            [
                "icon" => "mdi-cube-outline",
                "title" => "mdi-cube-outline"
            ],
            [
                "icon" => "mdi-cube-send",
                "title" => "mdi-cube-send"
            ],
            [
                "icon" => "mdi-cube-unfolded",
                "title" => "mdi-cube-unfolded"
            ],
            [
                "icon" => "mdi-cup",
                "title" => "mdi-cup"
            ],
            [
                "icon" => "mdi-cup-off",
                "title" => "mdi-cup-off"
            ],
            [
                "icon" => "mdi-cup-water",
                "title" => "mdi-cup-water"
            ],
            [
                "icon" => "mdi-currency-btc",
                "title" => "mdi-currency-btc"
            ],
            [
                "icon" => "mdi-currency-chf",
                "title" => "mdi-currency-chf"
            ],
            [
                "icon" => "mdi-currency-cny",
                "title" => "mdi-currency-cny"
            ],
            [
                "icon" => "mdi-currency-eth",
                "title" => "mdi-currency-eth"
            ],
            [
                "icon" => "mdi-currency-eur",
                "title" => "mdi-currency-eur"
            ],
            [
                "icon" => "mdi-currency-gbp",
                "title" => "mdi-currency-gbp"
            ],
            [
                "icon" => "mdi-currency-inr",
                "title" => "mdi-currency-inr"
            ],
            [
                "icon" => "mdi-currency-jpy",
                "title" => "mdi-currency-jpy"
            ],
            [
                "icon" => "mdi-currency-krw",
                "title" => "mdi-currency-krw"
            ],
            [
                "icon" => "mdi-currency-ngn",
                "title" => "mdi-currency-ngn"
            ],
            [
                "icon" => "mdi-currency-rub",
                "title" => "mdi-currency-rub"
            ],
            [
                "icon" => "mdi-currency-sign",
                "title" => "mdi-currency-sign"
            ],
            [
                "icon" => "mdi-currency-try",
                "title" => "mdi-currency-try"
            ],
            [
                "icon" => "mdi-currency-twd",
                "title" => "mdi-currency-twd"
            ],
            [
                "icon" => "mdi-currency-usd",
                "title" => "mdi-currency-usd"
            ],
            [
                "icon" => "mdi-currency-usd-off",
                "title" => "mdi-currency-usd-off"
            ],
            [
                "icon" => "mdi-cursor-default",
                "title" => "mdi-cursor-default"
            ],
            [
                "icon" => "mdi-cursor-default-outline",
                "title" => "mdi-cursor-default-outline"
            ],
            [
                "icon" => "mdi-cursor-move",
                "title" => "mdi-cursor-move"
            ],
            [
                "icon" => "mdi-cursor-pointer",
                "title" => "mdi-cursor-pointer"
            ],
            [
                "icon" => "mdi-cursor-text",
                "title" => "mdi-cursor-text"
            ],
            [
                "icon" => "mdi-database",
                "title" => "mdi-database"
            ],
            [
                "icon" => "mdi-database-minus",
                "title" => "mdi-database-minus"
            ],
            [
                "icon" => "mdi-database-plus",
                "title" => "mdi-database-plus"
            ],
            [
                "icon" => "mdi-debug-step-into",
                "title" => "mdi-debug-step-into"
            ],
            [
                "icon" => "mdi-debug-step-out",
                "title" => "mdi-debug-step-out"
            ],
            [
                "icon" => "mdi-debug-step-over",
                "title" => "mdi-debug-step-over"
            ],
            [
                "icon" => "mdi-decagram",
                "title" => "mdi-decagram"
            ],
            [
                "icon" => "mdi-decagram-outline",
                "title" => "mdi-decagram-outline"
            ],
            [
                "icon" => "mdi-decimal-decrease",
                "title" => "mdi-decimal-decrease"
            ],
            [
                "icon" => "mdi-decimal-increase",
                "title" => "mdi-decimal-increase"
            ],
            [
                "icon" => "mdi-delete",
                "title" => "mdi-delete"
            ],
            [
                "icon" => "mdi-delete-circle",
                "title" => "mdi-delete-circle"
            ],
            [
                "icon" => "mdi-delete-empty",
                "title" => "mdi-delete-empty"
            ],
            [
                "icon" => "mdi-delete-forever",
                "title" => "mdi-delete-forever"
            ],
            [
                "icon" => "mdi-delete-sweep",
                "title" => "mdi-delete-sweep"
            ],
            [
                "icon" => "mdi-delete-variant",
                "title" => "mdi-delete-variant"
            ],
            [
                "icon" => "mdi-delta",
                "title" => "mdi-delta"
            ],
            [
                "icon" => "mdi-deskphone",
                "title" => "mdi-deskphone"
            ],
            [
                "icon" => "mdi-desktop-classic",
                "title" => "mdi-desktop-classic"
            ],
            [
                "icon" => "mdi-desktop-mac",
                "title" => "mdi-desktop-mac"
            ],
            [
                "icon" => "mdi-desktop-tower",
                "title" => "mdi-desktop-tower"
            ],
            [
                "icon" => "mdi-details",
                "title" => "mdi-details"
            ],
            [
                "icon" => "mdi-developer-board",
                "title" => "mdi-developer-board"
            ],
            [
                "icon" => "mdi-deviantart",
                "title" => "mdi-deviantart"
            ],
            [
                "icon" => "mdi-dialpad",
                "title" => "mdi-dialpad"
            ],
            [
                "icon" => "mdi-diamond",
                "title" => "mdi-diamond"
            ],
            [
                "icon" => "mdi-dice-1",
                "title" => "mdi-dice-1"
            ],
            [
                "icon" => "mdi-dice-2",
                "title" => "mdi-dice-2"
            ],
            [
                "icon" => "mdi-dice-3",
                "title" => "mdi-dice-3"
            ],
            [
                "icon" => "mdi-dice-4",
                "title" => "mdi-dice-4"
            ],
            [
                "icon" => "mdi-dice-5",
                "title" => "mdi-dice-5"
            ],
            [
                "icon" => "mdi-dice-6",
                "title" => "mdi-dice-6"
            ],
            [
                "icon" => "mdi-dice-d10",
                "title" => "mdi-dice-d10"
            ],
            [
                "icon" => "mdi-dice-d20",
                "title" => "mdi-dice-d20"
            ],
            [
                "icon" => "mdi-dice-d4",
                "title" => "mdi-dice-d4"
            ],
            [
                "icon" => "mdi-dice-d6",
                "title" => "mdi-dice-d6"
            ],
            [
                "icon" => "mdi-dice-d8",
                "title" => "mdi-dice-d8"
            ],
            [
                "icon" => "mdi-dice-multiple",
                "title" => "mdi-dice-multiple"
            ],
            [
                "icon" => "mdi-dictionary",
                "title" => "mdi-dictionary"
            ],
            [
                "icon" => "mdi-dip-switch",
                "title" => "mdi-dip-switch"
            ],
            [
                "icon" => "mdi-directions",
                "title" => "mdi-directions"
            ],
            [
                "icon" => "mdi-directions-fork",
                "title" => "mdi-directions-fork"
            ],
            [
                "icon" => "mdi-discord",
                "title" => "mdi-discord"
            ],
            [
                "icon" => "mdi-disk",
                "title" => "mdi-disk"
            ],
            [
                "icon" => "mdi-disk-alert",
                "title" => "mdi-disk-alert"
            ],
            [
                "icon" => "mdi-disqus",
                "title" => "mdi-disqus"
            ],
            [
                "icon" => "mdi-disqus-outline",
                "title" => "mdi-disqus-outline"
            ],
            [
                "icon" => "mdi-division",
                "title" => "mdi-division"
            ],
            [
                "icon" => "mdi-division-box",
                "title" => "mdi-division-box"
            ],
            [
                "icon" => "mdi-dna",
                "title" => "mdi-dna"
            ],
            [
                "icon" => "mdi-dns",
                "title" => "mdi-dns"
            ],
            [
                "icon" => "mdi-do-not-disturb",
                "title" => "mdi-do-not-disturb"
            ],
            [
                "icon" => "mdi-do-not-disturb-off",
                "title" => "mdi-do-not-disturb-off"
            ],
            [
                "icon" => "mdi-dolby",
                "title" => "mdi-dolby"
            ],
            [
                "icon" => "mdi-domain",
                "title" => "mdi-domain"
            ],
            [
                "icon" => "mdi-donkey",
                "title" => "mdi-donkey"
            ],
            [
                "icon" => "mdi-dots-horizontal",
                "title" => "mdi-dots-horizontal"
            ],
            [
                "icon" => "mdi-dots-horizontal-circle",
                "title" => "mdi-dots-horizontal-circle"
            ],
            [
                "icon" => "mdi-dots-vertical",
                "title" => "mdi-dots-vertical"
            ],
            [
                "icon" => "mdi-dots-vertical-circle",
                "title" => "mdi-dots-vertical-circle"
            ],
            [
                "icon" => "mdi-douban",
                "title" => "mdi-douban"
            ],
            [
                "icon" => "mdi-download",
                "title" => "mdi-download"
            ],
            [
                "icon" => "mdi-download-network",
                "title" => "mdi-download-network"
            ],
            [
                "icon" => "mdi-drag",
                "title" => "mdi-drag"
            ],
            [
                "icon" => "mdi-drag-horizontal",
                "title" => "mdi-drag-horizontal"
            ],
            [
                "icon" => "mdi-drag-vertical",
                "title" => "mdi-drag-vertical"
            ],
            [
                "icon" => "mdi-drawing",
                "title" => "mdi-drawing"
            ],
            [
                "icon" => "mdi-drawing-box",
                "title" => "mdi-drawing-box"
            ],
            [
                "icon" => "mdi-dribbble",
                "title" => "mdi-dribbble"
            ],
            [
                "icon" => "mdi-dribbble-box",
                "title" => "mdi-dribbble-box"
            ],
            [
                "icon" => "mdi-drone",
                "title" => "mdi-drone"
            ],
            [
                "icon" => "mdi-dropbox",
                "title" => "mdi-dropbox"
            ],
            [
                "icon" => "mdi-drupal",
                "title" => "mdi-drupal"
            ],
            [
                "icon" => "mdi-duck",
                "title" => "mdi-duck"
            ],
            [
                "icon" => "mdi-dumbbell",
                "title" => "mdi-dumbbell"
            ],
            [
                "icon" => "mdi-ear-hearing",
                "title" => "mdi-ear-hearing"
            ],
            [
                "icon" => "mdi-earth",
                "title" => "mdi-earth"
            ],
            [
                "icon" => "mdi-earth-box",
                "title" => "mdi-earth-box"
            ],
            [
                "icon" => "mdi-earth-box-off",
                "title" => "mdi-earth-box-off"
            ],
            [
                "icon" => "mdi-earth-off",
                "title" => "mdi-earth-off"
            ],
            [
                "icon" => "mdi-edge",
                "title" => "mdi-edge"
            ],
            [
                "icon" => "mdi-eject",
                "title" => "mdi-eject"
            ],
            [
                "icon" => "mdi-elephant",
                "title" => "mdi-elephant"
            ],
            [
                "icon" => "mdi-elevation-decline",
                "title" => "mdi-elevation-decline"
            ],
            [
                "icon" => "mdi-elevation-rise",
                "title" => "mdi-elevation-rise"
            ],
            [
                "icon" => "mdi-elevator",
                "title" => "mdi-elevator"
            ],
            [
                "icon" => "mdi-email",
                "title" => "mdi-email"
            ],
            [
                "icon" => "mdi-email-alert",
                "title" => "mdi-email-alert"
            ],
            [
                "icon" => "mdi-email-open",
                "title" => "mdi-email-open"
            ],
            [
                "icon" => "mdi-email-open-outline",
                "title" => "mdi-email-open-outline"
            ],
            [
                "icon" => "mdi-email-outline",
                "title" => "mdi-email-outline"
            ],
            [
                "icon" => "mdi-email-secure",
                "title" => "mdi-email-secure"
            ],
            [
                "icon" => "mdi-email-variant",
                "title" => "mdi-email-variant"
            ],
            [
                "icon" => "mdi-emby",
                "title" => "mdi-emby"
            ],
            [
                "icon" => "mdi-emoticon",
                "title" => "mdi-emoticon"
            ],
            [
                "icon" => "mdi-emoticon-cool",
                "title" => "mdi-emoticon-cool"
            ],
            [
                "icon" => "mdi-emoticon-dead",
                "title" => "mdi-emoticon-dead"
            ],
            [
                "icon" => "mdi-emoticon-devil",
                "title" => "mdi-emoticon-devil"
            ],
            [
                "icon" => "mdi-emoticon-excited",
                "title" => "mdi-emoticon-excited"
            ],
            [
                "icon" => "mdi-emoticon-happy",
                "title" => "mdi-emoticon-happy"
            ],
            [
                "icon" => "mdi-emoticon-neutral",
                "title" => "mdi-emoticon-neutral"
            ],
            [
                "icon" => "mdi-emoticon-poop",
                "title" => "mdi-emoticon-poop"
            ],
            [
                "icon" => "mdi-emoticon-sad",
                "title" => "mdi-emoticon-sad"
            ],
            [
                "icon" => "mdi-emoticon-tongue",
                "title" => "mdi-emoticon-tongue"
            ],
            [
                "icon" => "mdi-engine",
                "title" => "mdi-engine"
            ],
            [
                "icon" => "mdi-engine-outline",
                "title" => "mdi-engine-outline"
            ],
            [
                "icon" => "mdi-equal",
                "title" => "mdi-equal"
            ],
            [
                "icon" => "mdi-equal-box",
                "title" => "mdi-equal-box"
            ],
            [
                "icon" => "mdi-eraser",
                "title" => "mdi-eraser"
            ],
            [
                "icon" => "mdi-eraser-variant",
                "title" => "mdi-eraser-variant"
            ],
            [
                "icon" => "mdi-escalator",
                "title" => "mdi-escalator"
            ],
            [
                "icon" => "mdi-ethernet",
                "title" => "mdi-ethernet"
            ],
            [
                "icon" => "mdi-ethernet-cable",
                "title" => "mdi-ethernet-cable"
            ],
            [
                "icon" => "mdi-ethernet-cable-off",
                "title" => "mdi-ethernet-cable-off"
            ],
            [
                "icon" => "mdi-etsy",
                "title" => "mdi-etsy"
            ],
            [
                "icon" => "mdi-ev-station",
                "title" => "mdi-ev-station"
            ],
            [
                "icon" => "mdi-eventbrite",
                "title" => "mdi-eventbrite"
            ],
            [
                "icon" => "mdi-evernote",
                "title" => "mdi-evernote"
            ],
            [
                "icon" => "mdi-exclamation",
                "title" => "mdi-exclamation"
            ],
            [
                "icon" => "mdi-exit-to-app",
                "title" => "mdi-exit-to-app"
            ],
            [
                "icon" => "mdi-export",
                "title" => "mdi-export"
            ],
            [
                "icon" => "mdi-eye",
                "title" => "mdi-eye"
            ],
            [
                "icon" => "mdi-eye-off",
                "title" => "mdi-eye-off"
            ],
            [
                "icon" => "mdi-eye-off-outline",
                "title" => "mdi-eye-off-outline"
            ],
            [
                "icon" => "mdi-eye-outline",
                "title" => "mdi-eye-outline"
            ],
            [
                "icon" => "mdi-eyedropper",
                "title" => "mdi-eyedropper"
            ],
            [
                "icon" => "mdi-eyedropper-variant",
                "title" => "mdi-eyedropper-variant"
            ],
            [
                "icon" => "mdi-face",
                "title" => "mdi-face"
            ],
            [
                "icon" => "mdi-face-profile",
                "title" => "mdi-face-profile"
            ],
            [
                "icon" => "mdi-facebook",
                "title" => "mdi-facebook"
            ],
            [
                "icon" => "mdi-facebook-box",
                "title" => "mdi-facebook-box"
            ],
            [
                "icon" => "mdi-facebook-messenger",
                "title" => "mdi-facebook-messenger"
            ],
            [
                "icon" => "mdi-factory",
                "title" => "mdi-factory"
            ],
            [
                "icon" => "mdi-fan",
                "title" => "mdi-fan"
            ],
            [
                "icon" => "mdi-fast-forward",
                "title" => "mdi-fast-forward"
            ],
            [
                "icon" => "mdi-fast-forward-outline",
                "title" => "mdi-fast-forward-outline"
            ],
            [
                "icon" => "mdi-fax",
                "title" => "mdi-fax"
            ],
            [
                "icon" => "mdi-feather",
                "title" => "mdi-feather"
            ],
            [
                "icon" => "mdi-ferry",
                "title" => "mdi-ferry"
            ],
            [
                "icon" => "mdi-file",
                "title" => "mdi-file"
            ],
            [
                "icon" => "mdi-file-account",
                "title" => "mdi-file-account"
            ],
            [
                "icon" => "mdi-file-chart",
                "title" => "mdi-file-chart"
            ],
            [
                "icon" => "mdi-file-check",
                "title" => "mdi-file-check"
            ],
            [
                "icon" => "mdi-file-cloud",
                "title" => "mdi-file-cloud"
            ],
            [
                "icon" => "mdi-file-delimited",
                "title" => "mdi-file-delimited"
            ],
            [
                "icon" => "mdi-file-document",
                "title" => "mdi-file-document"
            ],
            [
                "icon" => "mdi-file-document-box",
                "title" => "mdi-file-document-box"
            ],
            [
                "icon" => "mdi-file-excel",
                "title" => "mdi-file-excel"
            ],
            [
                "icon" => "mdi-file-excel-box",
                "title" => "mdi-file-excel-box"
            ],
            [
                "icon" => "mdi-file-export",
                "title" => "mdi-file-export"
            ],
            [
                "icon" => "mdi-file-find",
                "title" => "mdi-file-find"
            ],
            [
                "icon" => "mdi-file-hidden",
                "title" => "mdi-file-hidden"
            ],
            [
                "icon" => "mdi-file-image",
                "title" => "mdi-file-image"
            ],
            [
                "icon" => "mdi-file-import",
                "title" => "mdi-file-import"
            ],
            [
                "icon" => "mdi-file-lock",
                "title" => "mdi-file-lock"
            ],
            [
                "icon" => "mdi-file-multiple",
                "title" => "mdi-file-multiple"
            ],
            [
                "icon" => "mdi-file-music",
                "title" => "mdi-file-music"
            ],
            [
                "icon" => "mdi-file-outline",
                "title" => "mdi-file-outline"
            ],
            [
                "icon" => "mdi-file-pdf",
                "title" => "mdi-file-pdf"
            ],
            [
                "icon" => "mdi-file-pdf-box",
                "title" => "mdi-file-pdf-box"
            ],
            [
                "icon" => "mdi-file-plus",
                "title" => "mdi-file-plus"
            ],
            [
                "icon" => "mdi-file-powerpoint",
                "title" => "mdi-file-powerpoint"
            ],
            [
                "icon" => "mdi-file-powerpoint-box",
                "title" => "mdi-file-powerpoint-box"
            ],
            [
                "icon" => "mdi-file-presentation-box",
                "title" => "mdi-file-presentation-box"
            ],
            [
                "icon" => "mdi-file-restore",
                "title" => "mdi-file-restore"
            ],
            [
                "icon" => "mdi-file-send",
                "title" => "mdi-file-send"
            ],
            [
                "icon" => "mdi-file-tree",
                "title" => "mdi-file-tree"
            ],
            [
                "icon" => "mdi-file-video",
                "title" => "mdi-file-video"
            ],
            [
                "icon" => "mdi-file-word",
                "title" => "mdi-file-word"
            ],
            [
                "icon" => "mdi-file-word-box",
                "title" => "mdi-file-word-box"
            ],
            [
                "icon" => "mdi-file-xml",
                "title" => "mdi-file-xml"
            ],
            [
                "icon" => "mdi-film",
                "title" => "mdi-film"
            ],
            [
                "icon" => "mdi-filmstrip",
                "title" => "mdi-filmstrip"
            ],
            [
                "icon" => "mdi-filmstrip-off",
                "title" => "mdi-filmstrip-off"
            ],
            [
                "icon" => "mdi-filter",
                "title" => "mdi-filter"
            ],
            [
                "icon" => "mdi-filter-outline",
                "title" => "mdi-filter-outline"
            ],
            [
                "icon" => "mdi-filter-remove",
                "title" => "mdi-filter-remove"
            ],
            [
                "icon" => "mdi-filter-remove-outline",
                "title" => "mdi-filter-remove-outline"
            ],
            [
                "icon" => "mdi-filter-variant",
                "title" => "mdi-filter-variant"
            ],
            [
                "icon" => "mdi-find-replace",
                "title" => "mdi-find-replace"
            ],
            [
                "icon" => "mdi-fingerprint",
                "title" => "mdi-fingerprint"
            ],
            [
                "icon" => "mdi-fire",
                "title" => "mdi-fire"
            ],
            [
                "icon" => "mdi-firefox",
                "title" => "mdi-firefox"
            ],
            [
                "icon" => "mdi-fish",
                "title" => "mdi-fish"
            ],
            [
                "icon" => "mdi-flag",
                "title" => "mdi-flag"
            ],
            [
                "icon" => "mdi-flag-checkered",
                "title" => "mdi-flag-checkered"
            ],
            [
                "icon" => "mdi-flag-outline",
                "title" => "mdi-flag-outline"
            ],
            [
                "icon" => "mdi-flag-outline-variant",
                "title" => "mdi-flag-outline-variant"
            ],
            [
                "icon" => "mdi-flag-triangle",
                "title" => "mdi-flag-triangle"
            ],
            [
                "icon" => "mdi-flag-variant",
                "title" => "mdi-flag-variant"
            ],
            [
                "icon" => "mdi-flash",
                "title" => "mdi-flash"
            ],
            [
                "icon" => "mdi-flash-auto",
                "title" => "mdi-flash-auto"
            ],
            [
                "icon" => "mdi-flash-off",
                "title" => "mdi-flash-off"
            ],
            [
                "icon" => "mdi-flash-outline",
                "title" => "mdi-flash-outline"
            ],
            [
                "icon" => "mdi-flash-red-eye",
                "title" => "mdi-flash-red-eye"
            ],
            [
                "icon" => "mdi-flashlight",
                "title" => "mdi-flashlight"
            ],
            [
                "icon" => "mdi-flashlight-off",
                "title" => "mdi-flashlight-off"
            ],
            [
                "icon" => "mdi-flask",
                "title" => "mdi-flask"
            ],
            [
                "icon" => "mdi-flask-empty",
                "title" => "mdi-flask-empty"
            ],
            [
                "icon" => "mdi-flask-empty-outline",
                "title" => "mdi-flask-empty-outline"
            ],
            [
                "icon" => "mdi-flask-outline",
                "title" => "mdi-flask-outline"
            ],
            [
                "icon" => "mdi-flattr",
                "title" => "mdi-flattr"
            ],
            [
                "icon" => "mdi-flip-to-back",
                "title" => "mdi-flip-to-back"
            ],
            [
                "icon" => "mdi-flip-to-front",
                "title" => "mdi-flip-to-front"
            ],
            [
                "icon" => "mdi-floppy",
                "title" => "mdi-floppy"
            ],
            [
                "icon" => "mdi-flower",
                "title" => "mdi-flower"
            ],
            [
                "icon" => "mdi-folder",
                "title" => "mdi-folder"
            ],
            [
                "icon" => "mdi-folder-account",
                "title" => "mdi-folder-account"
            ],
            [
                "icon" => "mdi-folder-download",
                "title" => "mdi-folder-download"
            ],
            [
                "icon" => "mdi-folder-google-drive",
                "title" => "mdi-folder-google-drive"
            ],
            [
                "icon" => "mdi-folder-image",
                "title" => "mdi-folder-image"
            ],
            [
                "icon" => "mdi-folder-lock",
                "title" => "mdi-folder-lock"
            ],
            [
                "icon" => "mdi-folder-lock-open",
                "title" => "mdi-folder-lock-open"
            ],
            [
                "icon" => "mdi-folder-move",
                "title" => "mdi-folder-move"
            ],
            [
                "icon" => "mdi-folder-multiple",
                "title" => "mdi-folder-multiple"
            ],
            [
                "icon" => "mdi-folder-multiple-image",
                "title" => "mdi-folder-multiple-image"
            ],
            [
                "icon" => "mdi-folder-multiple-outline",
                "title" => "mdi-folder-multiple-outline"
            ],
            [
                "icon" => "mdi-folder-open",
                "title" => "mdi-folder-open"
            ],
            [
                "icon" => "mdi-folder-outline",
                "title" => "mdi-folder-outline"
            ],
            [
                "icon" => "mdi-folder-plus",
                "title" => "mdi-folder-plus"
            ],
            [
                "icon" => "mdi-folder-remove",
                "title" => "mdi-folder-remove"
            ],
            [
                "icon" => "mdi-folder-star",
                "title" => "mdi-folder-star"
            ],
            [
                "icon" => "mdi-folder-upload",
                "title" => "mdi-folder-upload"
            ],
            [
                "icon" => "mdi-font-awesome",
                "title" => "mdi-font-awesome"
            ],
            [
                "icon" => "mdi-food",
                "title" => "mdi-food"
            ],
            [
                "icon" => "mdi-food-apple",
                "title" => "mdi-food-apple"
            ],
            [
                "icon" => "mdi-food-croissant",
                "title" => "mdi-food-croissant"
            ],
            [
                "icon" => "mdi-food-fork-drink",
                "title" => "mdi-food-fork-drink"
            ],
            [
                "icon" => "mdi-food-off",
                "title" => "mdi-food-off"
            ],
            [
                "icon" => "mdi-food-variant",
                "title" => "mdi-food-variant"
            ],
            [
                "icon" => "mdi-football",
                "title" => "mdi-football"
            ],
            [
                "icon" => "mdi-football-australian",
                "title" => "mdi-football-australian"
            ],
            [
                "icon" => "mdi-football-helmet",
                "title" => "mdi-football-helmet"
            ],
            [
                "icon" => "mdi-forklift",
                "title" => "mdi-forklift"
            ],
            [
                "icon" => "mdi-format-align-bottom",
                "title" => "mdi-format-align-bottom"
            ],
            [
                "icon" => "mdi-format-align-center",
                "title" => "mdi-format-align-center"
            ],
            [
                "icon" => "mdi-format-align-justify",
                "title" => "mdi-format-align-justify"
            ],
            [
                "icon" => "mdi-format-align-left",
                "title" => "mdi-format-align-left"
            ],
            [
                "icon" => "mdi-format-align-middle",
                "title" => "mdi-format-align-middle"
            ],
            [
                "icon" => "mdi-format-align-right",
                "title" => "mdi-format-align-right"
            ],
            [
                "icon" => "mdi-format-align-top",
                "title" => "mdi-format-align-top"
            ],
            [
                "icon" => "mdi-format-annotation-plus",
                "title" => "mdi-format-annotation-plus"
            ],
            [
                "icon" => "mdi-format-bold",
                "title" => "mdi-format-bold"
            ],
            [
                "icon" => "mdi-format-clear",
                "title" => "mdi-format-clear"
            ],
            [
                "icon" => "mdi-format-color-fill",
                "title" => "mdi-format-color-fill"
            ],
            [
                "icon" => "mdi-format-color-text",
                "title" => "mdi-format-color-text"
            ],
            [
                "icon" => "mdi-format-float-center",
                "title" => "mdi-format-float-center"
            ],
            [
                "icon" => "mdi-format-float-left",
                "title" => "mdi-format-float-left"
            ],
            [
                "icon" => "mdi-format-float-none",
                "title" => "mdi-format-float-none"
            ],
            [
                "icon" => "mdi-format-float-right",
                "title" => "mdi-format-float-right"
            ],
            [
                "icon" => "mdi-format-font",
                "title" => "mdi-format-font"
            ],
            [
                "icon" => "mdi-format-header-1",
                "title" => "mdi-format-header-1"
            ],
            [
                "icon" => "mdi-format-header-2",
                "title" => "mdi-format-header-2"
            ],
            [
                "icon" => "mdi-format-header-3",
                "title" => "mdi-format-header-3"
            ],
            [
                "icon" => "mdi-format-header-4",
                "title" => "mdi-format-header-4"
            ],
            [
                "icon" => "mdi-format-header-5",
                "title" => "mdi-format-header-5"
            ],
            [
                "icon" => "mdi-format-header-6",
                "title" => "mdi-format-header-6"
            ],
            [
                "icon" => "mdi-format-header-decrease",
                "title" => "mdi-format-header-decrease"
            ],
            [
                "icon" => "mdi-format-header-equal",
                "title" => "mdi-format-header-equal"
            ],
            [
                "icon" => "mdi-format-header-increase",
                "title" => "mdi-format-header-increase"
            ],
            [
                "icon" => "mdi-format-header-pound",
                "title" => "mdi-format-header-pound"
            ],
            [
                "icon" => "mdi-format-horizontal-align-center",
                "title" => "mdi-format-horizontal-align-center"
            ],
            [
                "icon" => "mdi-format-horizontal-align-left",
                "title" => "mdi-format-horizontal-align-left"
            ],
            [
                "icon" => "mdi-format-horizontal-align-right",
                "title" => "mdi-format-horizontal-align-right"
            ],
            [
                "icon" => "mdi-format-indent-decrease",
                "title" => "mdi-format-indent-decrease"
            ],
            [
                "icon" => "mdi-format-indent-increase",
                "title" => "mdi-format-indent-increase"
            ],
            [
                "icon" => "mdi-format-italic",
                "title" => "mdi-format-italic"
            ],
            [
                "icon" => "mdi-format-line-spacing",
                "title" => "mdi-format-line-spacing"
            ],
            [
                "icon" => "mdi-format-line-style",
                "title" => "mdi-format-line-style"
            ],
            [
                "icon" => "mdi-format-line-weight",
                "title" => "mdi-format-line-weight"
            ],
            [
                "icon" => "mdi-format-list-bulleted",
                "title" => "mdi-format-list-bulleted"
            ],
            [
                "icon" => "mdi-format-list-bulleted-type",
                "title" => "mdi-format-list-bulleted-type"
            ],
            [
                "icon" => "mdi-format-list-checks",
                "title" => "mdi-format-list-checks"
            ],
            [
                "icon" => "mdi-format-list-numbers",
                "title" => "mdi-format-list-numbers"
            ],
            [
                "icon" => "mdi-format-page-break",
                "title" => "mdi-format-page-break"
            ],
            [
                "icon" => "mdi-format-paint",
                "title" => "mdi-format-paint"
            ],
            [
                "icon" => "mdi-format-paragraph",
                "title" => "mdi-format-paragraph"
            ],
            [
                "icon" => "mdi-format-pilcrow",
                "title" => "mdi-format-pilcrow"
            ],
            [
                "icon" => "mdi-format-quote-close",
                "title" => "mdi-format-quote-close"
            ],
            [
                "icon" => "mdi-format-quote-open",
                "title" => "mdi-format-quote-open"
            ],
            [
                "icon" => "mdi-format-rotate-90",
                "title" => "mdi-format-rotate-90"
            ],
            [
                "icon" => "mdi-format-section",
                "title" => "mdi-format-section"
            ],
            [
                "icon" => "mdi-format-size",
                "title" => "mdi-format-size"
            ],
            [
                "icon" => "mdi-format-strikethrough",
                "title" => "mdi-format-strikethrough"
            ],
            [
                "icon" => "mdi-format-strikethrough-variant",
                "title" => "mdi-format-strikethrough-variant"
            ],
            [
                "icon" => "mdi-format-subscript",
                "title" => "mdi-format-subscript"
            ],
            [
                "icon" => "mdi-format-superscript",
                "title" => "mdi-format-superscript"
            ],
            [
                "icon" => "mdi-format-text",
                "title" => "mdi-format-text"
            ],
            [
                "icon" => "mdi-format-textdirection-l-to-r",
                "title" => "mdi-format-textdirection-l-to-r"
            ],
            [
                "icon" => "mdi-format-textdirection-r-to-l",
                "title" => "mdi-format-textdirection-r-to-l"
            ],
            [
                "icon" => "mdi-format-title",
                "title" => "mdi-format-title"
            ],
            [
                "icon" => "mdi-format-underline",
                "title" => "mdi-format-underline"
            ],
            [
                "icon" => "mdi-format-vertical-align-bottom",
                "title" => "mdi-format-vertical-align-bottom"
            ],
            [
                "icon" => "mdi-format-vertical-align-center",
                "title" => "mdi-format-vertical-align-center"
            ],
            [
                "icon" => "mdi-format-vertical-align-top",
                "title" => "mdi-format-vertical-align-top"
            ],
            [
                "icon" => "mdi-format-wrap-inline",
                "title" => "mdi-format-wrap-inline"
            ],
            [
                "icon" => "mdi-format-wrap-square",
                "title" => "mdi-format-wrap-square"
            ],
            [
                "icon" => "mdi-format-wrap-tight",
                "title" => "mdi-format-wrap-tight"
            ],
            [
                "icon" => "mdi-format-wrap-top-bottom",
                "title" => "mdi-format-wrap-top-bottom"
            ],
            [
                "icon" => "mdi-forum",
                "title" => "mdi-forum"
            ],
            [
                "icon" => "mdi-forward",
                "title" => "mdi-forward"
            ],
            [
                "icon" => "mdi-foursquare",
                "title" => "mdi-foursquare"
            ],
            [
                "icon" => "mdi-fridge",
                "title" => "mdi-fridge"
            ],
            [
                "icon" => "mdi-fridge-filled",
                "title" => "mdi-fridge-filled"
            ],
            [
                "icon" => "mdi-fridge-filled-bottom",
                "title" => "mdi-fridge-filled-bottom"
            ],
            [
                "icon" => "mdi-fridge-filled-top",
                "title" => "mdi-fridge-filled-top"
            ],
            [
                "icon" => "mdi-fuel",
                "title" => "mdi-fuel"
            ],
            [
                "icon" => "mdi-fullscreen",
                "title" => "mdi-fullscreen"
            ],
            [
                "icon" => "mdi-fullscreen-exit",
                "title" => "mdi-fullscreen-exit"
            ],
            [
                "icon" => "mdi-function",
                "title" => "mdi-function"
            ],
            [
                "icon" => "mdi-gamepad",
                "title" => "mdi-gamepad"
            ],
            [
                "icon" => "mdi-gamepad-variant",
                "title" => "mdi-gamepad-variant"
            ],
            [
                "icon" => "mdi-garage",
                "title" => "mdi-garage"
            ],
            [
                "icon" => "mdi-garage-open",
                "title" => "mdi-garage-open"
            ],
            [
                "icon" => "mdi-gas-cylinder",
                "title" => "mdi-gas-cylinder"
            ],
            [
                "icon" => "mdi-gas-station",
                "title" => "mdi-gas-station"
            ],
            [
                "icon" => "mdi-gate",
                "title" => "mdi-gate"
            ],
            [
                "icon" => "mdi-gauge",
                "title" => "mdi-gauge"
            ],
            [
                "icon" => "mdi-gavel",
                "title" => "mdi-gavel"
            ],
            [
                "icon" => "mdi-gender-female",
                "title" => "mdi-gender-female"
            ],
            [
                "icon" => "mdi-gender-male",
                "title" => "mdi-gender-male"
            ],
            [
                "icon" => "mdi-gender-male-female",
                "title" => "mdi-gender-male-female"
            ],
            [
                "icon" => "mdi-gender-transgender",
                "title" => "mdi-gender-transgender"
            ],
            [
                "icon" => "mdi-gesture",
                "title" => "mdi-gesture"
            ],
            [
                "icon" => "mdi-gesture-double-tap",
                "title" => "mdi-gesture-double-tap"
            ],
            [
                "icon" => "mdi-gesture-swipe-down",
                "title" => "mdi-gesture-swipe-down"
            ],
            [
                "icon" => "mdi-gesture-swipe-left",
                "title" => "mdi-gesture-swipe-left"
            ],
            [
                "icon" => "mdi-gesture-swipe-right",
                "title" => "mdi-gesture-swipe-right"
            ],
            [
                "icon" => "mdi-gesture-swipe-up",
                "title" => "mdi-gesture-swipe-up"
            ],
            [
                "icon" => "mdi-gesture-tap",
                "title" => "mdi-gesture-tap"
            ],
            [
                "icon" => "mdi-gesture-two-double-tap",
                "title" => "mdi-gesture-two-double-tap"
            ],
            [
                "icon" => "mdi-gesture-two-tap",
                "title" => "mdi-gesture-two-tap"
            ],
            [
                "icon" => "mdi-ghost",
                "title" => "mdi-ghost"
            ],
            [
                "icon" => "mdi-gift",
                "title" => "mdi-gift"
            ],
            [
                "icon" => "mdi-git",
                "title" => "mdi-git"
            ],
            [
                "icon" => "mdi-github-box",
                "title" => "mdi-github-box"
            ],
            [
                "icon" => "mdi-github-circle",
                "title" => "mdi-github-circle"
            ],
            [
                "icon" => "mdi-github-face",
                "title" => "mdi-github-face"
            ],
            [
                "icon" => "mdi-glass-flute",
                "title" => "mdi-glass-flute"
            ],
            [
                "icon" => "mdi-glass-mug",
                "title" => "mdi-glass-mug"
            ],
            [
                "icon" => "mdi-glass-stange",
                "title" => "mdi-glass-stange"
            ],
            [
                "icon" => "mdi-glass-tulip",
                "title" => "mdi-glass-tulip"
            ],
            [
                "icon" => "mdi-glassdoor",
                "title" => "mdi-glassdoor"
            ],
            [
                "icon" => "mdi-glasses",
                "title" => "mdi-glasses"
            ],
            [
                "icon" => "mdi-gmail",
                "title" => "mdi-gmail"
            ],
            [
                "icon" => "mdi-gnome",
                "title" => "mdi-gnome"
            ],
            [
                "icon" => "mdi-gondola",
                "title" => "mdi-gondola"
            ],
            [
                "icon" => "mdi-google",
                "title" => "mdi-google"
            ],
            [
                "icon" => "mdi-google-analytics",
                "title" => "mdi-google-analytics"
            ],
            [
                "icon" => "mdi-google-assistant",
                "title" => "mdi-google-assistant"
            ],
            [
                "icon" => "mdi-google-cardboard",
                "title" => "mdi-google-cardboard"
            ],
            [
                "icon" => "mdi-google-chrome",
                "title" => "mdi-google-chrome"
            ],
            [
                "icon" => "mdi-google-circles",
                "title" => "mdi-google-circles"
            ],
            [
                "icon" => "mdi-google-circles-communities",
                "title" => "mdi-google-circles-communities"
            ],
            [
                "icon" => "mdi-google-circles-extended",
                "title" => "mdi-google-circles-extended"
            ],
            [
                "icon" => "mdi-google-circles-group",
                "title" => "mdi-google-circles-group"
            ],
            [
                "icon" => "mdi-google-controller",
                "title" => "mdi-google-controller"
            ],
            [
                "icon" => "mdi-google-controller-off",
                "title" => "mdi-google-controller-off"
            ],
            [
                "icon" => "mdi-google-drive",
                "title" => "mdi-google-drive"
            ],
            [
                "icon" => "mdi-google-earth",
                "title" => "mdi-google-earth"
            ],
            [
                "icon" => "mdi-google-glass",
                "title" => "mdi-google-glass"
            ],
            [
                "icon" => "mdi-google-keep",
                "title" => "mdi-google-keep"
            ],
            [
                "icon" => "mdi-google-maps",
                "title" => "mdi-google-maps"
            ],
            [
                "icon" => "mdi-google-nearby",
                "title" => "mdi-google-nearby"
            ],
            [
                "icon" => "mdi-google-pages",
                "title" => "mdi-google-pages"
            ],
            [
                "icon" => "mdi-google-photos",
                "title" => "mdi-google-photos"
            ],
            [
                "icon" => "mdi-google-physical-web",
                "title" => "mdi-google-physical-web"
            ],
            [
                "icon" => "mdi-google-play",
                "title" => "mdi-google-play"
            ],
            [
                "icon" => "mdi-google-plus",
                "title" => "mdi-google-plus"
            ],
            [
                "icon" => "mdi-google-plus-box",
                "title" => "mdi-google-plus-box"
            ],
            [
                "icon" => "mdi-google-translate",
                "title" => "mdi-google-translate"
            ],
            [
                "icon" => "mdi-google-wallet",
                "title" => "mdi-google-wallet"
            ],
            [
                "icon" => "mdi-gradient",
                "title" => "mdi-gradient"
            ],
            [
                "icon" => "mdi-grease-pencil",
                "title" => "mdi-grease-pencil"
            ],
            [
                "icon" => "mdi-grid",
                "title" => "mdi-grid"
            ],
            [
                "icon" => "mdi-grid-large",
                "title" => "mdi-grid-large"
            ],
            [
                "icon" => "mdi-grid-off",
                "title" => "mdi-grid-off"
            ],
            [
                "icon" => "mdi-group",
                "title" => "mdi-group"
            ],
            [
                "icon" => "mdi-guitar-acoustic",
                "title" => "mdi-guitar-acoustic"
            ],
            [
                "icon" => "mdi-guitar-electric",
                "title" => "mdi-guitar-electric"
            ],
            [
                "icon" => "mdi-guitar-pick",
                "title" => "mdi-guitar-pick"
            ],
            [
                "icon" => "mdi-guitar-pick-outline",
                "title" => "mdi-guitar-pick-outline"
            ],
            [
                "icon" => "mdi-hackernews",
                "title" => "mdi-hackernews"
            ],
            [
                "icon" => "mdi-hamburger",
                "title" => "mdi-hamburger"
            ],
            [
                "icon" => "mdi-hand-pointing-right",
                "title" => "mdi-hand-pointing-right"
            ],
            [
                "icon" => "mdi-hanger",
                "title" => "mdi-hanger"
            ],
            [
                "icon" => "mdi-hangouts",
                "title" => "mdi-hangouts"
            ],
            [
                "icon" => "mdi-harddisk",
                "title" => "mdi-harddisk"
            ],
            [
                "icon" => "mdi-headphones",
                "title" => "mdi-headphones"
            ],
            [
                "icon" => "mdi-headphones-box",
                "title" => "mdi-headphones-box"
            ],
            [
                "icon" => "mdi-headphones-off",
                "title" => "mdi-headphones-off"
            ],
            [
                "icon" => "mdi-headphones-settings",
                "title" => "mdi-headphones-settings"
            ],
            [
                "icon" => "mdi-headset",
                "title" => "mdi-headset"
            ],
            [
                "icon" => "mdi-headset-dock",
                "title" => "mdi-headset-dock"
            ],
            [
                "icon" => "mdi-headset-off",
                "title" => "mdi-headset-off"
            ],
            [
                "icon" => "mdi-heart",
                "title" => "mdi-heart"
            ],
            [
                "icon" => "mdi-heart-box",
                "title" => "mdi-heart-box"
            ],
            [
                "icon" => "mdi-heart-box-outline",
                "title" => "mdi-heart-box-outline"
            ],
            [
                "icon" => "mdi-heart-broken",
                "title" => "mdi-heart-broken"
            ],
            [
                "icon" => "mdi-heart-half",
                "title" => "mdi-heart-half"
            ],
            [
                "icon" => "mdi-heart-half-full",
                "title" => "mdi-heart-half-full"
            ],
            [
                "icon" => "mdi-heart-half-outline",
                "title" => "mdi-heart-half-outline"
            ],
            [
                "icon" => "mdi-heart-off",
                "title" => "mdi-heart-off"
            ],
            [
                "icon" => "mdi-heart-outline",
                "title" => "mdi-heart-outline"
            ],
            [
                "icon" => "mdi-heart-pulse",
                "title" => "mdi-heart-pulse"
            ],
            [
                "icon" => "mdi-help",
                "title" => "mdi-help"
            ],
            [
                "icon" => "mdi-help-box",
                "title" => "mdi-help-box"
            ],
            [
                "icon" => "mdi-help-circle",
                "title" => "mdi-help-circle"
            ],
            [
                "icon" => "mdi-help-circle-outline",
                "title" => "mdi-help-circle-outline"
            ],
            [
                "icon" => "mdi-help-network",
                "title" => "mdi-help-network"
            ],
            [
                "icon" => "mdi-hexagon",
                "title" => "mdi-hexagon"
            ],
            [
                "icon" => "mdi-hexagon-multiple",
                "title" => "mdi-hexagon-multiple"
            ],
            [
                "icon" => "mdi-hexagon-outline",
                "title" => "mdi-hexagon-outline"
            ],
            [
                "icon" => "mdi-high-definition",
                "title" => "mdi-high-definition"
            ],
            [
                "icon" => "mdi-highway",
                "title" => "mdi-highway"
            ],
            [
                "icon" => "mdi-history",
                "title" => "mdi-history"
            ],
            [
                "icon" => "mdi-hololens",
                "title" => "mdi-hololens"
            ],
            [
                "icon" => "mdi-home",
                "title" => "mdi-home"
            ],
            [
                "icon" => "mdi-home-assistant",
                "title" => "mdi-home-assistant"
            ],
            [
                "icon" => "mdi-home-automation",
                "title" => "mdi-home-automation"
            ],
            [
                "icon" => "mdi-home-circle",
                "title" => "mdi-home-circle"
            ],
            [
                "icon" => "mdi-home-map-marker",
                "title" => "mdi-home-map-marker"
            ],
            [
                "icon" => "mdi-home-modern",
                "title" => "mdi-home-modern"
            ],
            [
                "icon" => "mdi-home-outline",
                "title" => "mdi-home-outline"
            ],
            [
                "icon" => "mdi-home-variant",
                "title" => "mdi-home-variant"
            ],
            [
                "icon" => "mdi-hook",
                "title" => "mdi-hook"
            ],
            [
                "icon" => "mdi-hook-off",
                "title" => "mdi-hook-off"
            ],
            [
                "icon" => "mdi-hops",
                "title" => "mdi-hops"
            ],
            [
                "icon" => "mdi-hospital",
                "title" => "mdi-hospital"
            ],
            [
                "icon" => "mdi-hospital-building",
                "title" => "mdi-hospital-building"
            ],
            [
                "icon" => "mdi-hospital-marker",
                "title" => "mdi-hospital-marker"
            ],
            [
                "icon" => "mdi-hotel",
                "title" => "mdi-hotel"
            ],
            [
                "icon" => "mdi-houzz",
                "title" => "mdi-houzz"
            ],
            [
                "icon" => "mdi-houzz-box",
                "title" => "mdi-houzz-box"
            ],
            [
                "icon" => "mdi-human",
                "title" => "mdi-human"
            ],
            [
                "icon" => "mdi-human-child",
                "title" => "mdi-human-child"
            ],
            [
                "icon" => "mdi-human-female",
                "title" => "mdi-human-female"
            ],
            [
                "icon" => "mdi-human-greeting",
                "title" => "mdi-human-greeting"
            ],
            [
                "icon" => "mdi-human-handsdown",
                "title" => "mdi-human-handsdown"
            ],
            [
                "icon" => "mdi-human-handsup",
                "title" => "mdi-human-handsup"
            ],
            [
                "icon" => "mdi-human-male",
                "title" => "mdi-human-male"
            ],
            [
                "icon" => "mdi-human-male-female",
                "title" => "mdi-human-male-female"
            ],
            [
                "icon" => "mdi-human-pregnant",
                "title" => "mdi-human-pregnant"
            ],
            [
                "icon" => "mdi-humble-bundle",
                "title" => "mdi-humble-bundle"
            ],
            [
                "icon" => "mdi-image",
                "title" => "mdi-image"
            ],
            [
                "icon" => "mdi-image-album",
                "title" => "mdi-image-album"
            ],
            [
                "icon" => "mdi-image-area",
                "title" => "mdi-image-area"
            ],
            [
                "icon" => "mdi-image-area-close",
                "title" => "mdi-image-area-close"
            ],
            [
                "icon" => "mdi-image-broken",
                "title" => "mdi-image-broken"
            ],
            [
                "icon" => "mdi-image-broken-variant",
                "title" => "mdi-image-broken-variant"
            ],
            [
                "icon" => "mdi-image-filter",
                "title" => "mdi-image-filter"
            ],
            [
                "icon" => "mdi-image-filter-black-white",
                "title" => "mdi-image-filter-black-white"
            ],
            [
                "icon" => "mdi-image-filter-center-focus",
                "title" => "mdi-image-filter-center-focus"
            ],
            [
                "icon" => "mdi-image-filter-center-focus-weak",
                "title" => "mdi-image-filter-center-focus-weak"
            ],
            [
                "icon" => "mdi-image-filter-drama",
                "title" => "mdi-image-filter-drama"
            ],
            [
                "icon" => "mdi-image-filter-frames",
                "title" => "mdi-image-filter-frames"
            ],
            [
                "icon" => "mdi-image-filter-hdr",
                "title" => "mdi-image-filter-hdr"
            ],
            [
                "icon" => "mdi-image-filter-none",
                "title" => "mdi-image-filter-none"
            ],
            [
                "icon" => "mdi-image-filter-tilt-shift",
                "title" => "mdi-image-filter-tilt-shift"
            ],
            [
                "icon" => "mdi-image-filter-vintage",
                "title" => "mdi-image-filter-vintage"
            ],
            [
                "icon" => "mdi-image-multiple",
                "title" => "mdi-image-multiple"
            ],
            [
                "icon" => "mdi-import",
                "title" => "mdi-import"
            ],
            [
                "icon" => "mdi-inbox",
                "title" => "mdi-inbox"
            ],
            [
                "icon" => "mdi-inbox-arrow-down",
                "title" => "mdi-inbox-arrow-down"
            ],
            [
                "icon" => "mdi-inbox-arrow-up",
                "title" => "mdi-inbox-arrow-up"
            ],
            [
                "icon" => "mdi-incognito",
                "title" => "mdi-incognito"
            ],
            [
                "icon" => "mdi-infinity",
                "title" => "mdi-infinity"
            ],
            [
                "icon" => "mdi-information",
                "title" => "mdi-information"
            ],
            [
                "icon" => "mdi-information-outline",
                "title" => "mdi-information-outline"
            ],
            [
                "icon" => "mdi-information-variant",
                "title" => "mdi-information-variant"
            ],
            [
                "icon" => "mdi-instagram",
                "title" => "mdi-instagram"
            ],
            [
                "icon" => "mdi-instapaper",
                "title" => "mdi-instapaper"
            ],
            [
                "icon" => "mdi-internet-explorer",
                "title" => "mdi-internet-explorer"
            ],
            [
                "icon" => "mdi-invert-colors",
                "title" => "mdi-invert-colors"
            ],
            [
                "icon" => "mdi-itunes",
                "title" => "mdi-itunes"
            ],
            [
                "icon" => "mdi-jeepney",
                "title" => "mdi-jeepney"
            ],
            [
                "icon" => "mdi-jira",
                "title" => "mdi-jira"
            ],
            [
                "icon" => "mdi-jsfiddle",
                "title" => "mdi-jsfiddle"
            ],
            [
                "icon" => "mdi-json",
                "title" => "mdi-json"
            ],
            [
                "icon" => "mdi-keg",
                "title" => "mdi-keg"
            ],
            [
                "icon" => "mdi-kettle",
                "title" => "mdi-kettle"
            ],
            [
                "icon" => "mdi-key",
                "title" => "mdi-key"
            ],
            [
                "icon" => "mdi-key-change",
                "title" => "mdi-key-change"
            ],
            [
                "icon" => "mdi-key-minus",
                "title" => "mdi-key-minus"
            ],
            [
                "icon" => "mdi-key-plus",
                "title" => "mdi-key-plus"
            ],
            [
                "icon" => "mdi-key-remove",
                "title" => "mdi-key-remove"
            ],
            [
                "icon" => "mdi-key-variant",
                "title" => "mdi-key-variant"
            ],
            [
                "icon" => "mdi-keyboard",
                "title" => "mdi-keyboard"
            ],
            [
                "icon" => "mdi-keyboard-backspace",
                "title" => "mdi-keyboard-backspace"
            ],
            [
                "icon" => "mdi-keyboard-caps",
                "title" => "mdi-keyboard-caps"
            ],
            [
                "icon" => "mdi-keyboard-close",
                "title" => "mdi-keyboard-close"
            ],
            [
                "icon" => "mdi-keyboard-off",
                "title" => "mdi-keyboard-off"
            ],
            [
                "icon" => "mdi-keyboard-return",
                "title" => "mdi-keyboard-return"
            ],
            [
                "icon" => "mdi-keyboard-tab",
                "title" => "mdi-keyboard-tab"
            ],
            [
                "icon" => "mdi-keyboard-variant",
                "title" => "mdi-keyboard-variant"
            ],
            [
                "icon" => "mdi-kickstarter",
                "title" => "mdi-kickstarter"
            ],
            [
                "icon" => "mdi-kodi",
                "title" => "mdi-kodi"
            ],
            [
                "icon" => "mdi-label",
                "title" => "mdi-label"
            ],
            [
                "icon" => "mdi-label-outline",
                "title" => "mdi-label-outline"
            ],
            [
                "icon" => "mdi-lambda",
                "title" => "mdi-lambda"
            ],
            [
                "icon" => "mdi-lamp",
                "title" => "mdi-lamp"
            ],
            [
                "icon" => "mdi-lan",
                "title" => "mdi-lan"
            ],
            [
                "icon" => "mdi-lan-connect",
                "title" => "mdi-lan-connect"
            ],
            [
                "icon" => "mdi-lan-disconnect",
                "title" => "mdi-lan-disconnect"
            ],
            [
                "icon" => "mdi-lan-pending",
                "title" => "mdi-lan-pending"
            ],
            [
                "icon" => "mdi-language-c",
                "title" => "mdi-language-c"
            ],
            [
                "icon" => "mdi-language-cpp",
                "title" => "mdi-language-cpp"
            ],
            [
                "icon" => "mdi-language-csharp",
                "title" => "mdi-language-csharp"
            ],
            [
                "icon" => "mdi-language-css3",
                "title" => "mdi-language-css3"
            ],
            [
                "icon" => "mdi-language-go",
                "title" => "mdi-language-go"
            ],
            [
                "icon" => "mdi-language-html5",
                "title" => "mdi-language-html5"
            ],
            [
                "icon" => "mdi-language-javascript",
                "title" => "mdi-language-javascript"
            ],
            [
                "icon" => "mdi-language-php",
                "title" => "mdi-language-php"
            ],
            [
                "icon" => "mdi-language-python",
                "title" => "mdi-language-python"
            ],
            [
                "icon" => "mdi-language-python-text",
                "title" => "mdi-language-python-text"
            ],
            [
                "icon" => "mdi-language-r",
                "title" => "mdi-language-r"
            ],
            [
                "icon" => "mdi-language-swift",
                "title" => "mdi-language-swift"
            ],
            [
                "icon" => "mdi-language-typescript",
                "title" => "mdi-language-typescript"
            ],
            [
                "icon" => "mdi-laptop",
                "title" => "mdi-laptop"
            ],
            [
                "icon" => "mdi-laptop-chromebook",
                "title" => "mdi-laptop-chromebook"
            ],
            [
                "icon" => "mdi-laptop-mac",
                "title" => "mdi-laptop-mac"
            ],
            [
                "icon" => "mdi-laptop-off",
                "title" => "mdi-laptop-off"
            ],
            [
                "icon" => "mdi-laptop-windows",
                "title" => "mdi-laptop-windows"
            ],
            [
                "icon" => "mdi-lastfm",
                "title" => "mdi-lastfm"
            ],
            [
                "icon" => "mdi-launch",
                "title" => "mdi-launch"
            ],
            [
                "icon" => "mdi-lava-lamp",
                "title" => "mdi-lava-lamp"
            ],
            [
                "icon" => "mdi-layers",
                "title" => "mdi-layers"
            ],
            [
                "icon" => "mdi-layers-off",
                "title" => "mdi-layers-off"
            ],
            [
                "icon" => "mdi-lead-pencil",
                "title" => "mdi-lead-pencil"
            ],
            [
                "icon" => "mdi-leaf",
                "title" => "mdi-leaf"
            ],
            [
                "icon" => "mdi-led-off",
                "title" => "mdi-led-off"
            ],
            [
                "icon" => "mdi-led-on",
                "title" => "mdi-led-on"
            ],
            [
                "icon" => "mdi-led-outline",
                "title" => "mdi-led-outline"
            ],
            [
                "icon" => "mdi-led-strip",
                "title" => "mdi-led-strip"
            ],
            [
                "icon" => "mdi-led-variant-off",
                "title" => "mdi-led-variant-off"
            ],
            [
                "icon" => "mdi-led-variant-on",
                "title" => "mdi-led-variant-on"
            ],
            [
                "icon" => "mdi-led-variant-outline",
                "title" => "mdi-led-variant-outline"
            ],
            [
                "icon" => "mdi-library",
                "title" => "mdi-library"
            ],
            [
                "icon" => "mdi-library-books",
                "title" => "mdi-library-books"
            ],
            [
                "icon" => "mdi-library-music",
                "title" => "mdi-library-music"
            ],
            [
                "icon" => "mdi-library-plus",
                "title" => "mdi-library-plus"
            ],
            [
                "icon" => "mdi-lightbulb",
                "title" => "mdi-lightbulb"
            ],
            [
                "icon" => "mdi-lightbulb-on",
                "title" => "mdi-lightbulb-on"
            ],
            [
                "icon" => "mdi-lightbulb-on-outline",
                "title" => "mdi-lightbulb-on-outline"
            ],
            [
                "icon" => "mdi-lightbulb-outline",
                "title" => "mdi-lightbulb-outline"
            ],
            [
                "icon" => "mdi-link",
                "title" => "mdi-link"
            ],
            [
                "icon" => "mdi-link-off",
                "title" => "mdi-link-off"
            ],
            [
                "icon" => "mdi-link-variant",
                "title" => "mdi-link-variant"
            ],
            [
                "icon" => "mdi-link-variant-off",
                "title" => "mdi-link-variant-off"
            ],
            [
                "icon" => "mdi-linkedin",
                "title" => "mdi-linkedin"
            ],
            [
                "icon" => "mdi-linkedin-box",
                "title" => "mdi-linkedin-box"
            ],
            [
                "icon" => "mdi-linux",
                "title" => "mdi-linux"
            ],
            [
                "icon" => "mdi-loading",
                "title" => "mdi-loading"
            ],
            [
                "icon" => "mdi-lock",
                "title" => "mdi-lock"
            ],
            [
                "icon" => "mdi-lock-open",
                "title" => "mdi-lock-open"
            ],
            [
                "icon" => "mdi-lock-open-outline",
                "title" => "mdi-lock-open-outline"
            ],
            [
                "icon" => "mdi-lock-outline",
                "title" => "mdi-lock-outline"
            ],
            [
                "icon" => "mdi-lock-pattern",
                "title" => "mdi-lock-pattern"
            ],
            [
                "icon" => "mdi-lock-plus",
                "title" => "mdi-lock-plus"
            ],
            [
                "icon" => "mdi-lock-reset",
                "title" => "mdi-lock-reset"
            ],
            [
                "icon" => "mdi-locker",
                "title" => "mdi-locker"
            ],
            [
                "icon" => "mdi-locker-multiple",
                "title" => "mdi-locker-multiple"
            ],
            [
                "icon" => "mdi-login",
                "title" => "mdi-login"
            ],
            [
                "icon" => "mdi-login-variant",
                "title" => "mdi-login-variant"
            ],
            [
                "icon" => "mdi-logout",
                "title" => "mdi-logout"
            ],
            [
                "icon" => "mdi-logout-variant",
                "title" => "mdi-logout-variant"
            ],
            [
                "icon" => "mdi-looks",
                "title" => "mdi-looks"
            ],
            [
                "icon" => "mdi-loop",
                "title" => "mdi-loop"
            ],
            [
                "icon" => "mdi-loupe",
                "title" => "mdi-loupe"
            ],
            [
                "icon" => "mdi-lumx",
                "title" => "mdi-lumx"
            ],
            [
                "icon" => "mdi-magnet",
                "title" => "mdi-magnet"
            ],
            [
                "icon" => "mdi-magnet-on",
                "title" => "mdi-magnet-on"
            ],
            [
                "icon" => "mdi-magnify",
                "title" => "mdi-magnify"
            ],
            [
                "icon" => "mdi-magnify-minus",
                "title" => "mdi-magnify-minus"
            ],
            [
                "icon" => "mdi-magnify-minus-outline",
                "title" => "mdi-magnify-minus-outline"
            ],
            [
                "icon" => "mdi-magnify-plus",
                "title" => "mdi-magnify-plus"
            ],
            [
                "icon" => "mdi-magnify-plus-outline",
                "title" => "mdi-magnify-plus-outline"
            ],
            [
                "icon" => "mdi-mail-ru",
                "title" => "mdi-mail-ru"
            ],
            [
                "icon" => "mdi-mailbox",
                "title" => "mdi-mailbox"
            ],
            [
                "icon" => "mdi-map",
                "title" => "mdi-map"
            ],
            [
                "icon" => "mdi-map-marker",
                "title" => "mdi-map-marker"
            ],
            [
                "icon" => "mdi-map-marker-circle",
                "title" => "mdi-map-marker-circle"
            ],
            [
                "icon" => "mdi-map-marker-minus",
                "title" => "mdi-map-marker-minus"
            ],
            [
                "icon" => "mdi-map-marker-multiple",
                "title" => "mdi-map-marker-multiple"
            ],
            [
                "icon" => "mdi-map-marker-off",
                "title" => "mdi-map-marker-off"
            ],
            [
                "icon" => "mdi-map-marker-outline",
                "title" => "mdi-map-marker-outline"
            ],
            [
                "icon" => "mdi-map-marker-plus",
                "title" => "mdi-map-marker-plus"
            ],
            [
                "icon" => "mdi-map-marker-radius",
                "title" => "mdi-map-marker-radius"
            ],
            [
                "icon" => "mdi-margin",
                "title" => "mdi-margin"
            ],
            [
                "icon" => "mdi-markdown",
                "title" => "mdi-markdown"
            ],
            [
                "icon" => "mdi-marker",
                "title" => "mdi-marker"
            ],
            [
                "icon" => "mdi-marker-check",
                "title" => "mdi-marker-check"
            ],
            [
                "icon" => "mdi-martini",
                "title" => "mdi-martini"
            ],
            [
                "icon" => "mdi-material-ui",
                "title" => "mdi-material-ui"
            ],
            [
                "icon" => "mdi-math-compass",
                "title" => "mdi-math-compass"
            ],
            [
                "icon" => "mdi-matrix",
                "title" => "mdi-matrix"
            ],
            [
                "icon" => "mdi-maxcdn",
                "title" => "mdi-maxcdn"
            ],
            [
                "icon" => "mdi-medical-bag",
                "title" => "mdi-medical-bag"
            ],
            [
                "icon" => "mdi-medium",
                "title" => "mdi-medium"
            ],
            [
                "icon" => "mdi-memory",
                "title" => "mdi-memory"
            ],
            [
                "icon" => "mdi-menu",
                "title" => "mdi-menu"
            ],
            [
                "icon" => "mdi-menu-down",
                "title" => "mdi-menu-down"
            ],
            [
                "icon" => "mdi-menu-down-outline",
                "title" => "mdi-menu-down-outline"
            ],
            [
                "icon" => "mdi-menu-left",
                "title" => "mdi-menu-left"
            ],
            [
                "icon" => "mdi-menu-right",
                "title" => "mdi-menu-right"
            ],
            [
                "icon" => "mdi-menu-up",
                "title" => "mdi-menu-up"
            ],
            [
                "icon" => "mdi-menu-up-outline",
                "title" => "mdi-menu-up-outline"
            ],
            [
                "icon" => "mdi-message",
                "title" => "mdi-message"
            ],
            [
                "icon" => "mdi-message-alert",
                "title" => "mdi-message-alert"
            ],
            [
                "icon" => "mdi-message-bulleted",
                "title" => "mdi-message-bulleted"
            ],
            [
                "icon" => "mdi-message-bulleted-off",
                "title" => "mdi-message-bulleted-off"
            ],
            [
                "icon" => "mdi-message-draw",
                "title" => "mdi-message-draw"
            ],
            [
                "icon" => "mdi-message-image",
                "title" => "mdi-message-image"
            ],
            [
                "icon" => "mdi-message-outline",
                "title" => "mdi-message-outline"
            ],
            [
                "icon" => "mdi-message-plus",
                "title" => "mdi-message-plus"
            ],
            [
                "icon" => "mdi-message-processing",
                "title" => "mdi-message-processing"
            ],
            [
                "icon" => "mdi-message-reply",
                "title" => "mdi-message-reply"
            ],
            [
                "icon" => "mdi-message-reply-text",
                "title" => "mdi-message-reply-text"
            ],
            [
                "icon" => "mdi-message-settings",
                "title" => "mdi-message-settings"
            ],
            [
                "icon" => "mdi-message-settings-variant",
                "title" => "mdi-message-settings-variant"
            ],
            [
                "icon" => "mdi-message-text",
                "title" => "mdi-message-text"
            ],
            [
                "icon" => "mdi-message-text-outline",
                "title" => "mdi-message-text-outline"
            ],
            [
                "icon" => "mdi-message-video",
                "title" => "mdi-message-video"
            ],
            [
                "icon" => "mdi-meteor",
                "title" => "mdi-meteor"
            ],
            [
                "icon" => "mdi-metronome",
                "title" => "mdi-metronome"
            ],
            [
                "icon" => "mdi-metronome-tick",
                "title" => "mdi-metronome-tick"
            ],
            [
                "icon" => "mdi-micro-sd",
                "title" => "mdi-micro-sd"
            ],
            [
                "icon" => "mdi-microphone",
                "title" => "mdi-microphone"
            ],
            [
                "icon" => "mdi-microphone-off",
                "title" => "mdi-microphone-off"
            ],
            [
                "icon" => "mdi-microphone-outline",
                "title" => "mdi-microphone-outline"
            ],
            [
                "icon" => "mdi-microphone-settings",
                "title" => "mdi-microphone-settings"
            ],
            [
                "icon" => "mdi-microphone-variant",
                "title" => "mdi-microphone-variant"
            ],
            [
                "icon" => "mdi-microphone-variant-off",
                "title" => "mdi-microphone-variant-off"
            ],
            [
                "icon" => "mdi-microscope",
                "title" => "mdi-microscope"
            ],
            [
                "icon" => "mdi-microsoft",
                "title" => "mdi-microsoft"
            ],
            [
                "icon" => "mdi-minecraft",
                "title" => "mdi-minecraft"
            ],
            [
                "icon" => "mdi-minus",
                "title" => "mdi-minus"
            ],
            [
                "icon" => "mdi-minus-box",
                "title" => "mdi-minus-box"
            ],
            [
                "icon" => "mdi-minus-box-outline",
                "title" => "mdi-minus-box-outline"
            ],
            [
                "icon" => "mdi-minus-circle",
                "title" => "mdi-minus-circle"
            ],
            [
                "icon" => "mdi-minus-circle-outline",
                "title" => "mdi-minus-circle-outline"
            ],
            [
                "icon" => "mdi-minus-network",
                "title" => "mdi-minus-network"
            ],
            [
                "icon" => "mdi-mixcloud",
                "title" => "mdi-mixcloud"
            ],
            [
                "icon" => "mdi-mixer",
                "title" => "mdi-mixer"
            ],
            [
                "icon" => "mdi-monitor",
                "title" => "mdi-monitor"
            ],
            [
                "icon" => "mdi-monitor-multiple",
                "title" => "mdi-monitor-multiple"
            ],
            [
                "icon" => "mdi-more",
                "title" => "mdi-more"
            ],
            [
                "icon" => "mdi-motorbike",
                "title" => "mdi-motorbike"
            ],
            [
                "icon" => "mdi-mouse",
                "title" => "mdi-mouse"
            ],
            [
                "icon" => "mdi-mouse-off",
                "title" => "mdi-mouse-off"
            ],
            [
                "icon" => "mdi-mouse-variant",
                "title" => "mdi-mouse-variant"
            ],
            [
                "icon" => "mdi-mouse-variant-off",
                "title" => "mdi-mouse-variant-off"
            ],
            [
                "icon" => "mdi-move-resize",
                "title" => "mdi-move-resize"
            ],
            [
                "icon" => "mdi-move-resize-variant",
                "title" => "mdi-move-resize-variant"
            ],
            [
                "icon" => "mdi-movie",
                "title" => "mdi-movie"
            ],
            [
                "icon" => "mdi-movie-roll",
                "title" => "mdi-movie-roll"
            ],
            [
                "icon" => "mdi-multiplication",
                "title" => "mdi-multiplication"
            ],
            [
                "icon" => "mdi-multiplication-box",
                "title" => "mdi-multiplication-box"
            ],
            [
                "icon" => "mdi-mushroom",
                "title" => "mdi-mushroom"
            ],
            [
                "icon" => "mdi-mushroom-outline",
                "title" => "mdi-mushroom-outline"
            ],
            [
                "icon" => "mdi-music",
                "title" => "mdi-music"
            ],
            [
                "icon" => "mdi-music-box",
                "title" => "mdi-music-box"
            ],
            [
                "icon" => "mdi-music-box-outline",
                "title" => "mdi-music-box-outline"
            ],
            [
                "icon" => "mdi-music-circle",
                "title" => "mdi-music-circle"
            ],
            [
                "icon" => "mdi-music-note",
                "title" => "mdi-music-note"
            ],
            [
                "icon" => "mdi-music-note-bluetooth",
                "title" => "mdi-music-note-bluetooth"
            ],
            [
                "icon" => "mdi-music-note-bluetooth-off",
                "title" => "mdi-music-note-bluetooth-off"
            ],
            [
                "icon" => "mdi-music-note-eighth",
                "title" => "mdi-music-note-eighth"
            ],
            [
                "icon" => "mdi-music-note-half",
                "title" => "mdi-music-note-half"
            ],
            [
                "icon" => "mdi-music-note-off",
                "title" => "mdi-music-note-off"
            ],
            [
                "icon" => "mdi-music-note-quarter",
                "title" => "mdi-music-note-quarter"
            ],
            [
                "icon" => "mdi-music-note-sixteenth",
                "title" => "mdi-music-note-sixteenth"
            ],
            [
                "icon" => "mdi-music-note-whole",
                "title" => "mdi-music-note-whole"
            ],
            [
                "icon" => "mdi-music-off",
                "title" => "mdi-music-off"
            ],
            [
                "icon" => "mdi-nature",
                "title" => "mdi-nature"
            ],
            [
                "icon" => "mdi-nature-people",
                "title" => "mdi-nature-people"
            ],
            [
                "icon" => "mdi-navigation",
                "title" => "mdi-navigation"
            ],
            [
                "icon" => "mdi-near-me",
                "title" => "mdi-near-me"
            ],
            [
                "icon" => "mdi-needle",
                "title" => "mdi-needle"
            ],
            [
                "icon" => "mdi-nest-protect",
                "title" => "mdi-nest-protect"
            ],
            [
                "icon" => "mdi-nest-thermostat",
                "title" => "mdi-nest-thermostat"
            ],
            [
                "icon" => "mdi-netflix",
                "title" => "mdi-netflix"
            ],
            [
                "icon" => "mdi-network",
                "title" => "mdi-network"
            ],
            [
                "icon" => "mdi-new-box",
                "title" => "mdi-new-box"
            ],
            [
                "icon" => "mdi-newspaper",
                "title" => "mdi-newspaper"
            ],
            [
                "icon" => "mdi-nfc",
                "title" => "mdi-nfc"
            ],
            [
                "icon" => "mdi-nfc-tap",
                "title" => "mdi-nfc-tap"
            ],
            [
                "icon" => "mdi-nfc-variant",
                "title" => "mdi-nfc-variant"
            ],
            [
                "icon" => "mdi-ninja",
                "title" => "mdi-ninja"
            ],
            [
                "icon" => "mdi-nintendo-switch",
                "title" => "mdi-nintendo-switch"
            ],
            [
                "icon" => "mdi-nodejs",
                "title" => "mdi-nodejs"
            ],
            [
                "icon" => "mdi-note",
                "title" => "mdi-note"
            ],
            [
                "icon" => "mdi-note-multiple",
                "title" => "mdi-note-multiple"
            ],
            [
                "icon" => "mdi-note-multiple-outline",
                "title" => "mdi-note-multiple-outline"
            ],
            [
                "icon" => "mdi-note-outline",
                "title" => "mdi-note-outline"
            ],
            [
                "icon" => "mdi-note-plus",
                "title" => "mdi-note-plus"
            ],
            [
                "icon" => "mdi-note-plus-outline",
                "title" => "mdi-note-plus-outline"
            ],
            [
                "icon" => "mdi-note-text",
                "title" => "mdi-note-text"
            ],
            [
                "icon" => "mdi-notification-clear-all",
                "title" => "mdi-notification-clear-all"
            ],
            [
                "icon" => "mdi-npm",
                "title" => "mdi-npm"
            ],
            [
                "icon" => "mdi-nuke",
                "title" => "mdi-nuke"
            ],
            [
                "icon" => "mdi-null",
                "title" => "mdi-null"
            ],
            [
                "icon" => "mdi-numeric",
                "title" => "mdi-numeric"
            ],
            [
                "icon" => "mdi-numeric-0-box",
                "title" => "mdi-numeric-0-box"
            ],
            [
                "icon" => "mdi-numeric-0-box-multiple-outline",
                "title" => "mdi-numeric-0-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-0-box-outline",
                "title" => "mdi-numeric-0-box-outline"
            ],
            [
                "icon" => "mdi-numeric-1-box",
                "title" => "mdi-numeric-1-box"
            ],
            [
                "icon" => "mdi-numeric-1-box-multiple-outline",
                "title" => "mdi-numeric-1-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-1-box-outline",
                "title" => "mdi-numeric-1-box-outline"
            ],
            [
                "icon" => "mdi-numeric-2-box",
                "title" => "mdi-numeric-2-box"
            ],
            [
                "icon" => "mdi-numeric-2-box-multiple-outline",
                "title" => "mdi-numeric-2-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-2-box-outline",
                "title" => "mdi-numeric-2-box-outline"
            ],
            [
                "icon" => "mdi-numeric-3-box",
                "title" => "mdi-numeric-3-box"
            ],
            [
                "icon" => "mdi-numeric-3-box-multiple-outline",
                "title" => "mdi-numeric-3-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-3-box-outline",
                "title" => "mdi-numeric-3-box-outline"
            ],
            [
                "icon" => "mdi-numeric-4-box",
                "title" => "mdi-numeric-4-box"
            ],
            [
                "icon" => "mdi-numeric-4-box-multiple-outline",
                "title" => "mdi-numeric-4-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-4-box-outline",
                "title" => "mdi-numeric-4-box-outline"
            ],
            [
                "icon" => "mdi-numeric-5-box",
                "title" => "mdi-numeric-5-box"
            ],
            [
                "icon" => "mdi-numeric-5-box-multiple-outline",
                "title" => "mdi-numeric-5-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-5-box-outline",
                "title" => "mdi-numeric-5-box-outline"
            ],
            [
                "icon" => "mdi-numeric-6-box",
                "title" => "mdi-numeric-6-box"
            ],
            [
                "icon" => "mdi-numeric-6-box-multiple-outline",
                "title" => "mdi-numeric-6-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-6-box-outline",
                "title" => "mdi-numeric-6-box-outline"
            ],
            [
                "icon" => "mdi-numeric-7-box",
                "title" => "mdi-numeric-7-box"
            ],
            [
                "icon" => "mdi-numeric-7-box-multiple-outline",
                "title" => "mdi-numeric-7-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-7-box-outline",
                "title" => "mdi-numeric-7-box-outline"
            ],
            [
                "icon" => "mdi-numeric-8-box",
                "title" => "mdi-numeric-8-box"
            ],
            [
                "icon" => "mdi-numeric-8-box-multiple-outline",
                "title" => "mdi-numeric-8-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-8-box-outline",
                "title" => "mdi-numeric-8-box-outline"
            ],
            [
                "icon" => "mdi-numeric-9-box",
                "title" => "mdi-numeric-9-box"
            ],
            [
                "icon" => "mdi-numeric-9-box-multiple-outline",
                "title" => "mdi-numeric-9-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-9-box-outline",
                "title" => "mdi-numeric-9-box-outline"
            ],
            [
                "icon" => "mdi-numeric-9-plus-box",
                "title" => "mdi-numeric-9-plus-box"
            ],
            [
                "icon" => "mdi-numeric-9-plus-box-multiple-outline",
                "title" => "mdi-numeric-9-plus-box-multiple-outline"
            ],
            [
                "icon" => "mdi-numeric-9-plus-box-outline",
                "title" => "mdi-numeric-9-plus-box-outline"
            ],
            [
                "icon" => "mdi-nut",
                "title" => "mdi-nut"
            ],
            [
                "icon" => "mdi-nutrition",
                "title" => "mdi-nutrition"
            ],
            [
                "icon" => "mdi-oar",
                "title" => "mdi-oar"
            ],
            [
                "icon" => "mdi-octagon",
                "title" => "mdi-octagon"
            ],
            [
                "icon" => "mdi-octagon-outline",
                "title" => "mdi-octagon-outline"
            ],
            [
                "icon" => "mdi-octagram",
                "title" => "mdi-octagram"
            ],
            [
                "icon" => "mdi-octagram-outline",
                "title" => "mdi-octagram-outline"
            ],
            [
                "icon" => "mdi-odnoklassniki",
                "title" => "mdi-odnoklassniki"
            ],
            [
                "icon" => "mdi-office",
                "title" => "mdi-office"
            ],
            [
                "icon" => "mdi-oil",
                "title" => "mdi-oil"
            ],
            [
                "icon" => "mdi-oil-temperature",
                "title" => "mdi-oil-temperature"
            ],
            [
                "icon" => "mdi-omega",
                "title" => "mdi-omega"
            ],
            [
                "icon" => "mdi-onedrive",
                "title" => "mdi-onedrive"
            ],
            [
                "icon" => "mdi-onenote",
                "title" => "mdi-onenote"
            ],
            [
                "icon" => "mdi-opacity",
                "title" => "mdi-opacity"
            ],
            [
                "icon" => "mdi-open-in-app",
                "title" => "mdi-open-in-app"
            ],
            [
                "icon" => "mdi-open-in-new",
                "title" => "mdi-open-in-new"
            ],
            [
                "icon" => "mdi-openid",
                "title" => "mdi-openid"
            ],
            [
                "icon" => "mdi-opera",
                "title" => "mdi-opera"
            ],
            [
                "icon" => "mdi-orbit",
                "title" => "mdi-orbit"
            ],
            [
                "icon" => "mdi-ornament",
                "title" => "mdi-ornament"
            ],
            [
                "icon" => "mdi-ornament-variant",
                "title" => "mdi-ornament-variant"
            ],
            [
                "icon" => "mdi-owl",
                "title" => "mdi-owl"
            ],
            [
                "icon" => "mdi-package",
                "title" => "mdi-package"
            ],
            [
                "icon" => "mdi-package-down",
                "title" => "mdi-package-down"
            ],
            [
                "icon" => "mdi-package-up",
                "title" => "mdi-package-up"
            ],
            [
                "icon" => "mdi-package-variant",
                "title" => "mdi-package-variant"
            ],
            [
                "icon" => "mdi-package-variant-closed",
                "title" => "mdi-package-variant-closed"
            ],
            [
                "icon" => "mdi-page-first",
                "title" => "mdi-page-first"
            ],
            [
                "icon" => "mdi-page-last",
                "title" => "mdi-page-last"
            ],
            [
                "icon" => "mdi-page-layout-body",
                "title" => "mdi-page-layout-body"
            ],
            [
                "icon" => "mdi-page-layout-footer",
                "title" => "mdi-page-layout-footer"
            ],
            [
                "icon" => "mdi-page-layout-header",
                "title" => "mdi-page-layout-header"
            ],
            [
                "icon" => "mdi-page-layout-sidebar-left",
                "title" => "mdi-page-layout-sidebar-left"
            ],
            [
                "icon" => "mdi-page-layout-sidebar-right",
                "title" => "mdi-page-layout-sidebar-right"
            ],
            [
                "icon" => "mdi-palette",
                "title" => "mdi-palette"
            ],
            [
                "icon" => "mdi-palette-advanced",
                "title" => "mdi-palette-advanced"
            ],
            [
                "icon" => "mdi-panda",
                "title" => "mdi-panda"
            ],
            [
                "icon" => "mdi-pandora",
                "title" => "mdi-pandora"
            ],
            [
                "icon" => "mdi-panorama",
                "title" => "mdi-panorama"
            ],
            [
                "icon" => "mdi-panorama-fisheye",
                "title" => "mdi-panorama-fisheye"
            ],
            [
                "icon" => "mdi-panorama-horizontal",
                "title" => "mdi-panorama-horizontal"
            ],
            [
                "icon" => "mdi-panorama-vertical",
                "title" => "mdi-panorama-vertical"
            ],
            [
                "icon" => "mdi-panorama-wide-angle",
                "title" => "mdi-panorama-wide-angle"
            ],
            [
                "icon" => "mdi-paper-cut-vertical",
                "title" => "mdi-paper-cut-vertical"
            ],
            [
                "icon" => "mdi-paperclip",
                "title" => "mdi-paperclip"
            ],
            [
                "icon" => "mdi-parking",
                "title" => "mdi-parking"
            ],
            [
                "icon" => "mdi-passport",
                "title" => "mdi-passport"
            ],
            [
                "icon" => "mdi-pause",
                "title" => "mdi-pause"
            ],
            [
                "icon" => "mdi-pause-circle",
                "title" => "mdi-pause-circle"
            ],
            [
                "icon" => "mdi-pause-circle-outline",
                "title" => "mdi-pause-circle-outline"
            ],
            [
                "icon" => "mdi-pause-octagon",
                "title" => "mdi-pause-octagon"
            ],
            [
                "icon" => "mdi-pause-octagon-outline",
                "title" => "mdi-pause-octagon-outline"
            ],
            [
                "icon" => "mdi-paw",
                "title" => "mdi-paw"
            ],
            [
                "icon" => "mdi-paw-off",
                "title" => "mdi-paw-off"
            ],
            [
                "icon" => "mdi-pen",
                "title" => "mdi-pen"
            ],
            [
                "icon" => "mdi-pencil",
                "title" => "mdi-pencil"
            ],
            [
                "icon" => "mdi-pencil-box",
                "title" => "mdi-pencil-box"
            ],
            [
                "icon" => "mdi-pencil-box-outline",
                "title" => "mdi-pencil-box-outline"
            ],
            [
                "icon" => "mdi-pencil-circle",
                "title" => "mdi-pencil-circle"
            ],
            [
                "icon" => "mdi-pencil-circle-outline",
                "title" => "mdi-pencil-circle-outline"
            ],
            [
                "icon" => "mdi-pencil-lock",
                "title" => "mdi-pencil-lock"
            ],
            [
                "icon" => "mdi-pencil-off",
                "title" => "mdi-pencil-off"
            ],
            [
                "icon" => "mdi-pentagon",
                "title" => "mdi-pentagon"
            ],
            [
                "icon" => "mdi-pentagon-outline",
                "title" => "mdi-pentagon-outline"
            ],
            [
                "icon" => "mdi-percent",
                "title" => "mdi-percent"
            ],
            [
                "icon" => "mdi-periodic-table-co2",
                "title" => "mdi-periodic-table-co2"
            ],
            [
                "icon" => "mdi-periscope",
                "title" => "mdi-periscope"
            ],
            [
                "icon" => "mdi-pharmacy",
                "title" => "mdi-pharmacy"
            ],
            [
                "icon" => "mdi-phone",
                "title" => "mdi-phone"
            ],
            [
                "icon" => "mdi-phone-bluetooth",
                "title" => "mdi-phone-bluetooth"
            ],
            [
                "icon" => "mdi-phone-classic",
                "title" => "mdi-phone-classic"
            ],
            [
                "icon" => "mdi-phone-forward",
                "title" => "mdi-phone-forward"
            ],
            [
                "icon" => "mdi-phone-hangup",
                "title" => "mdi-phone-hangup"
            ],
            [
                "icon" => "mdi-phone-in-talk",
                "title" => "mdi-phone-in-talk"
            ],
            [
                "icon" => "mdi-phone-incoming",
                "title" => "mdi-phone-incoming"
            ],
            [
                "icon" => "mdi-phone-locked",
                "title" => "mdi-phone-locked"
            ],
            [
                "icon" => "mdi-phone-log",
                "title" => "mdi-phone-log"
            ],
            [
                "icon" => "mdi-phone-minus",
                "title" => "mdi-phone-minus"
            ],
            [
                "icon" => "mdi-phone-missed",
                "title" => "mdi-phone-missed"
            ],
            [
                "icon" => "mdi-phone-outgoing",
                "title" => "mdi-phone-outgoing"
            ],
            [
                "icon" => "mdi-phone-paused",
                "title" => "mdi-phone-paused"
            ],
            [
                "icon" => "mdi-phone-plus",
                "title" => "mdi-phone-plus"
            ],
            [
                "icon" => "mdi-phone-settings",
                "title" => "mdi-phone-settings"
            ],
            [
                "icon" => "mdi-phone-voip",
                "title" => "mdi-phone-voip"
            ],
            [
                "icon" => "mdi-pi",
                "title" => "mdi-pi"
            ],
            [
                "icon" => "mdi-pi-box",
                "title" => "mdi-pi-box"
            ],
            [
                "icon" => "mdi-piano",
                "title" => "mdi-piano"
            ],
            [
                "icon" => "mdi-pig",
                "title" => "mdi-pig"
            ],
            [
                "icon" => "mdi-pill",
                "title" => "mdi-pill"
            ],
            [
                "icon" => "mdi-pillar",
                "title" => "mdi-pillar"
            ],
            [
                "icon" => "mdi-pin",
                "title" => "mdi-pin"
            ],
            [
                "icon" => "mdi-pin-off",
                "title" => "mdi-pin-off"
            ],
            [
                "icon" => "mdi-pine-tree",
                "title" => "mdi-pine-tree"
            ],
            [
                "icon" => "mdi-pine-tree-box",
                "title" => "mdi-pine-tree-box"
            ],
            [
                "icon" => "mdi-pinterest",
                "title" => "mdi-pinterest"
            ],
            [
                "icon" => "mdi-pinterest-box",
                "title" => "mdi-pinterest-box"
            ],
            [
                "icon" => "mdi-pipe",
                "title" => "mdi-pipe"
            ],
            [
                "icon" => "mdi-pipe-disconnected",
                "title" => "mdi-pipe-disconnected"
            ],
            [
                "icon" => "mdi-pistol",
                "title" => "mdi-pistol"
            ],
            [
                "icon" => "mdi-pizza",
                "title" => "mdi-pizza"
            ],
            [
                "icon" => "mdi-plane-shield",
                "title" => "mdi-plane-shield"
            ],
            [
                "icon" => "mdi-play",
                "title" => "mdi-play"
            ],
            [
                "icon" => "mdi-play-box-outline",
                "title" => "mdi-play-box-outline"
            ],
            [
                "icon" => "mdi-play-circle",
                "title" => "mdi-play-circle"
            ],
            [
                "icon" => "mdi-play-circle-outline",
                "title" => "mdi-play-circle-outline"
            ],
            [
                "icon" => "mdi-play-pause",
                "title" => "mdi-play-pause"
            ],
            [
                "icon" => "mdi-play-protected-content",
                "title" => "mdi-play-protected-content"
            ],
            [
                "icon" => "mdi-playlist-check",
                "title" => "mdi-playlist-check"
            ],
            [
                "icon" => "mdi-playlist-minus",
                "title" => "mdi-playlist-minus"
            ],
            [
                "icon" => "mdi-playlist-play",
                "title" => "mdi-playlist-play"
            ],
            [
                "icon" => "mdi-playlist-plus",
                "title" => "mdi-playlist-plus"
            ],
            [
                "icon" => "mdi-playlist-remove",
                "title" => "mdi-playlist-remove"
            ],
            [
                "icon" => "mdi-playstation",
                "title" => "mdi-playstation"
            ],
            [
                "icon" => "mdi-plex",
                "title" => "mdi-plex"
            ],
            [
                "icon" => "mdi-plus",
                "title" => "mdi-plus"
            ],
            [
                "icon" => "mdi-plus-box",
                "title" => "mdi-plus-box"
            ],
            [
                "icon" => "mdi-plus-box-outline",
                "title" => "mdi-plus-box-outline"
            ],
            [
                "icon" => "mdi-plus-circle",
                "title" => "mdi-plus-circle"
            ],
            [
                "icon" => "mdi-plus-circle-multiple-outline",
                "title" => "mdi-plus-circle-multiple-outline"
            ],
            [
                "icon" => "mdi-plus-circle-outline",
                "title" => "mdi-plus-circle-outline"
            ],
            [
                "icon" => "mdi-plus-network",
                "title" => "mdi-plus-network"
            ],
            [
                "icon" => "mdi-plus-one",
                "title" => "mdi-plus-one"
            ],
            [
                "icon" => "mdi-plus-outline",
                "title" => "mdi-plus-outline"
            ],
            [
                "icon" => "mdi-pocket",
                "title" => "mdi-pocket"
            ],
            [
                "icon" => "mdi-pokeball",
                "title" => "mdi-pokeball"
            ],
            [
                "icon" => "mdi-polaroid",
                "title" => "mdi-polaroid"
            ],
            [
                "icon" => "mdi-poll",
                "title" => "mdi-poll"
            ],
            [
                "icon" => "mdi-poll-box",
                "title" => "mdi-poll-box"
            ],
            [
                "icon" => "mdi-polymer",
                "title" => "mdi-polymer"
            ],
            [
                "icon" => "mdi-pool",
                "title" => "mdi-pool"
            ],
            [
                "icon" => "mdi-popcorn",
                "title" => "mdi-popcorn"
            ],
            [
                "icon" => "mdi-pot",
                "title" => "mdi-pot"
            ],
            [
                "icon" => "mdi-pot-mix",
                "title" => "mdi-pot-mix"
            ],
            [
                "icon" => "mdi-pound",
                "title" => "mdi-pound"
            ],
            [
                "icon" => "mdi-pound-box",
                "title" => "mdi-pound-box"
            ],
            [
                "icon" => "mdi-power",
                "title" => "mdi-power"
            ],
            [
                "icon" => "mdi-power-plug",
                "title" => "mdi-power-plug"
            ],
            [
                "icon" => "mdi-power-plug-off",
                "title" => "mdi-power-plug-off"
            ],
            [
                "icon" => "mdi-power-settings",
                "title" => "mdi-power-settings"
            ],
            [
                "icon" => "mdi-power-socket",
                "title" => "mdi-power-socket"
            ],
            [
                "icon" => "mdi-power-socket-eu",
                "title" => "mdi-power-socket-eu"
            ],
            [
                "icon" => "mdi-power-socket-uk",
                "title" => "mdi-power-socket-uk"
            ],
            [
                "icon" => "mdi-power-socket-us",
                "title" => "mdi-power-socket-us"
            ],
            [
                "icon" => "mdi-prescription",
                "title" => "mdi-prescription"
            ],
            [
                "icon" => "mdi-presentation",
                "title" => "mdi-presentation"
            ],
            [
                "icon" => "mdi-presentation-play",
                "title" => "mdi-presentation-play"
            ],
            [
                "icon" => "mdi-printer",
                "title" => "mdi-printer"
            ],
            [
                "icon" => "mdi-printer-3d",
                "title" => "mdi-printer-3d"
            ],
            [
                "icon" => "mdi-printer-alert",
                "title" => "mdi-printer-alert"
            ],
            [
                "icon" => "mdi-printer-settings",
                "title" => "mdi-printer-settings"
            ],
            [
                "icon" => "mdi-priority-high",
                "title" => "mdi-priority-high"
            ],
            [
                "icon" => "mdi-priority-low",
                "title" => "mdi-priority-low"
            ],
            [
                "icon" => "mdi-professional-hexagon",
                "title" => "mdi-professional-hexagon"
            ],
            [
                "icon" => "mdi-projector",
                "title" => "mdi-projector"
            ],
            [
                "icon" => "mdi-projector-screen",
                "title" => "mdi-projector-screen"
            ],
            [
                "icon" => "mdi-publish",
                "title" => "mdi-publish"
            ],
            [
                "icon" => "mdi-pulse",
                "title" => "mdi-pulse"
            ],
            [
                "icon" => "mdi-puzzle",
                "title" => "mdi-puzzle"
            ],
            [
                "icon" => "mdi-qqchat",
                "title" => "mdi-qqchat"
            ],
            [
                "icon" => "mdi-qrcode",
                "title" => "mdi-qrcode"
            ],
            [
                "icon" => "mdi-qrcode-scan",
                "title" => "mdi-qrcode-scan"
            ],
            [
                "icon" => "mdi-quadcopter",
                "title" => "mdi-quadcopter"
            ],
            [
                "icon" => "mdi-quality-high",
                "title" => "mdi-quality-high"
            ],
            [
                "icon" => "mdi-quicktime",
                "title" => "mdi-quicktime"
            ],
            [
                "icon" => "mdi-radar",
                "title" => "mdi-radar"
            ],
            [
                "icon" => "mdi-radiator",
                "title" => "mdi-radiator"
            ],
            [
                "icon" => "mdi-radio",
                "title" => "mdi-radio"
            ],
            [
                "icon" => "mdi-radio-handheld",
                "title" => "mdi-radio-handheld"
            ],
            [
                "icon" => "mdi-radio-tower",
                "title" => "mdi-radio-tower"
            ],
            [
                "icon" => "mdi-radioactive",
                "title" => "mdi-radioactive"
            ],
            [
                "icon" => "mdi-radiobox-blank",
                "title" => "mdi-radiobox-blank"
            ],
            [
                "icon" => "mdi-radiobox-marked",
                "title" => "mdi-radiobox-marked"
            ],
            [
                "icon" => "mdi-raspberrypi",
                "title" => "mdi-raspberrypi"
            ],
            [
                "icon" => "mdi-ray-end",
                "title" => "mdi-ray-end"
            ],
            [
                "icon" => "mdi-ray-end-arrow",
                "title" => "mdi-ray-end-arrow"
            ],
            [
                "icon" => "mdi-ray-start",
                "title" => "mdi-ray-start"
            ],
            [
                "icon" => "mdi-ray-start-arrow",
                "title" => "mdi-ray-start-arrow"
            ],
            [
                "icon" => "mdi-ray-start-end",
                "title" => "mdi-ray-start-end"
            ],
            [
                "icon" => "mdi-ray-vertex",
                "title" => "mdi-ray-vertex"
            ],
            [
                "icon" => "mdi-rdio",
                "title" => "mdi-rdio"
            ],
            [
                "icon" => "mdi-react",
                "title" => "mdi-react"
            ],
            [
                "icon" => "mdi-read",
                "title" => "mdi-read"
            ],
            [
                "icon" => "mdi-readability",
                "title" => "mdi-readability"
            ],
            [
                "icon" => "mdi-receipt",
                "title" => "mdi-receipt"
            ],
            [
                "icon" => "mdi-record",
                "title" => "mdi-record"
            ],
            [
                "icon" => "mdi-record-rec",
                "title" => "mdi-record-rec"
            ],
            [
                "icon" => "mdi-recycle",
                "title" => "mdi-recycle"
            ],
            [
                "icon" => "mdi-reddit",
                "title" => "mdi-reddit"
            ],
            [
                "icon" => "mdi-redo",
                "title" => "mdi-redo"
            ],
            [
                "icon" => "mdi-redo-variant",
                "title" => "mdi-redo-variant"
            ],
            [
                "icon" => "mdi-refresh",
                "title" => "mdi-refresh"
            ],
            [
                "icon" => "mdi-regex",
                "title" => "mdi-regex"
            ],
            [
                "icon" => "mdi-relative-scale",
                "title" => "mdi-relative-scale"
            ],
            [
                "icon" => "mdi-reload",
                "title" => "mdi-reload"
            ],
            [
                "icon" => "mdi-remote",
                "title" => "mdi-remote"
            ],
            [
                "icon" => "mdi-rename-box",
                "title" => "mdi-rename-box"
            ],
            [
                "icon" => "mdi-reorder-horizontal",
                "title" => "mdi-reorder-horizontal"
            ],
            [
                "icon" => "mdi-reorder-vertical",
                "title" => "mdi-reorder-vertical"
            ],
            [
                "icon" => "mdi-repeat",
                "title" => "mdi-repeat"
            ],
            [
                "icon" => "mdi-repeat-off",
                "title" => "mdi-repeat-off"
            ],
            [
                "icon" => "mdi-repeat-once",
                "title" => "mdi-repeat-once"
            ],
            [
                "icon" => "mdi-replay",
                "title" => "mdi-replay"
            ],
            [
                "icon" => "mdi-reply",
                "title" => "mdi-reply"
            ],
            [
                "icon" => "mdi-reply-all",
                "title" => "mdi-reply-all"
            ],
            [
                "icon" => "mdi-reproduction",
                "title" => "mdi-reproduction"
            ],
            [
                "icon" => "mdi-resize-bottom-right",
                "title" => "mdi-resize-bottom-right"
            ],
            [
                "icon" => "mdi-responsive",
                "title" => "mdi-responsive"
            ],
            [
                "icon" => "mdi-restart",
                "title" => "mdi-restart"
            ],
            [
                "icon" => "mdi-restore",
                "title" => "mdi-restore"
            ],
            [
                "icon" => "mdi-rewind",
                "title" => "mdi-rewind"
            ],
            [
                "icon" => "mdi-rewind-outline",
                "title" => "mdi-rewind-outline"
            ],
            [
                "icon" => "mdi-rhombus",
                "title" => "mdi-rhombus"
            ],
            [
                "icon" => "mdi-rhombus-outline",
                "title" => "mdi-rhombus-outline"
            ],
            [
                "icon" => "mdi-ribbon",
                "title" => "mdi-ribbon"
            ],
            [
                "icon" => "mdi-rice",
                "title" => "mdi-rice"
            ],
            [
                "icon" => "mdi-ring",
                "title" => "mdi-ring"
            ],
            [
                "icon" => "mdi-road",
                "title" => "mdi-road"
            ],
            [
                "icon" => "mdi-road-variant",
                "title" => "mdi-road-variant"
            ],
            [
                "icon" => "mdi-robot",
                "title" => "mdi-robot"
            ],
            [
                "icon" => "mdi-rocket",
                "title" => "mdi-rocket"
            ],
            [
                "icon" => "mdi-roomba",
                "title" => "mdi-roomba"
            ],
            [
                "icon" => "mdi-rotate-3d",
                "title" => "mdi-rotate-3d"
            ],
            [
                "icon" => "mdi-rotate-left",
                "title" => "mdi-rotate-left"
            ],
            [
                "icon" => "mdi-rotate-left-variant",
                "title" => "mdi-rotate-left-variant"
            ],
            [
                "icon" => "mdi-rotate-right",
                "title" => "mdi-rotate-right"
            ],
            [
                "icon" => "mdi-rotate-right-variant",
                "title" => "mdi-rotate-right-variant"
            ],
            [
                "icon" => "mdi-rounded-corner",
                "title" => "mdi-rounded-corner"
            ],
            [
                "icon" => "mdi-router-wireless",
                "title" => "mdi-router-wireless"
            ],
            [
                "icon" => "mdi-routes",
                "title" => "mdi-routes"
            ],
            [
                "icon" => "mdi-rowing",
                "title" => "mdi-rowing"
            ],
            [
                "icon" => "mdi-rss",
                "title" => "mdi-rss"
            ],
            [
                "icon" => "mdi-rss-box",
                "title" => "mdi-rss-box"
            ],
            [
                "icon" => "mdi-ruler",
                "title" => "mdi-ruler"
            ],
            [
                "icon" => "mdi-run",
                "title" => "mdi-run"
            ],
            [
                "icon" => "mdi-run-fast",
                "title" => "mdi-run-fast"
            ],
            [
                "icon" => "mdi-sale",
                "title" => "mdi-sale"
            ],
            [
                "icon" => "mdi-sass",
                "title" => "mdi-sass"
            ],
            [
                "icon" => "mdi-satellite",
                "title" => "mdi-satellite"
            ],
            [
                "icon" => "mdi-satellite-variant",
                "title" => "mdi-satellite-variant"
            ],
            [
                "icon" => "mdi-saxophone",
                "title" => "mdi-saxophone"
            ],
            [
                "icon" => "mdi-scale",
                "title" => "mdi-scale"
            ],
            [
                "icon" => "mdi-scale-balance",
                "title" => "mdi-scale-balance"
            ],
            [
                "icon" => "mdi-scale-bathroom",
                "title" => "mdi-scale-bathroom"
            ],
            [
                "icon" => "mdi-scanner",
                "title" => "mdi-scanner"
            ],
            [
                "icon" => "mdi-school",
                "title" => "mdi-school"
            ],
            [
                "icon" => "mdi-screen-rotation",
                "title" => "mdi-screen-rotation"
            ],
            [
                "icon" => "mdi-screen-rotation-lock",
                "title" => "mdi-screen-rotation-lock"
            ],
            [
                "icon" => "mdi-screwdriver",
                "title" => "mdi-screwdriver"
            ],
            [
                "icon" => "mdi-script",
                "title" => "mdi-script"
            ],
            [
                "icon" => "mdi-sd",
                "title" => "mdi-sd"
            ],
            [
                "icon" => "mdi-seal",
                "title" => "mdi-seal"
            ],
            [
                "icon" => "mdi-search-web",
                "title" => "mdi-search-web"
            ],
            [
                "icon" => "mdi-seat-flat",
                "title" => "mdi-seat-flat"
            ],
            [
                "icon" => "mdi-seat-flat-angled",
                "title" => "mdi-seat-flat-angled"
            ],
            [
                "icon" => "mdi-seat-individual-suite",
                "title" => "mdi-seat-individual-suite"
            ],
            [
                "icon" => "mdi-seat-legroom-extra",
                "title" => "mdi-seat-legroom-extra"
            ],
            [
                "icon" => "mdi-seat-legroom-normal",
                "title" => "mdi-seat-legroom-normal"
            ],
            [
                "icon" => "mdi-seat-legroom-reduced",
                "title" => "mdi-seat-legroom-reduced"
            ],
            [
                "icon" => "mdi-seat-recline-extra",
                "title" => "mdi-seat-recline-extra"
            ],
            [
                "icon" => "mdi-seat-recline-normal",
                "title" => "mdi-seat-recline-normal"
            ],
            [
                "icon" => "mdi-security",
                "title" => "mdi-security"
            ],
            [
                "icon" => "mdi-security-home",
                "title" => "mdi-security-home"
            ],
            [
                "icon" => "mdi-security-network",
                "title" => "mdi-security-network"
            ],
            [
                "icon" => "mdi-select",
                "title" => "mdi-select"
            ],
            [
                "icon" => "mdi-select-all",
                "title" => "mdi-select-all"
            ],
            [
                "icon" => "mdi-select-inverse",
                "title" => "mdi-select-inverse"
            ],
            [
                "icon" => "mdi-select-off",
                "title" => "mdi-select-off"
            ],
            [
                "icon" => "mdi-selection",
                "title" => "mdi-selection"
            ],
            [
                "icon" => "mdi-selection-off",
                "title" => "mdi-selection-off"
            ],
            [
                "icon" => "mdi-send",
                "title" => "mdi-send"
            ],
            [
                "icon" => "mdi-send-secure",
                "title" => "mdi-send-secure"
            ],
            [
                "icon" => "mdi-serial-port",
                "title" => "mdi-serial-port"
            ],
            [
                "icon" => "mdi-server",
                "title" => "mdi-server"
            ],
            [
                "icon" => "mdi-server-minus",
                "title" => "mdi-server-minus"
            ],
            [
                "icon" => "mdi-server-network",
                "title" => "mdi-server-network"
            ],
            [
                "icon" => "mdi-server-network-off",
                "title" => "mdi-server-network-off"
            ],
            [
                "icon" => "mdi-server-off",
                "title" => "mdi-server-off"
            ],
            [
                "icon" => "mdi-server-plus",
                "title" => "mdi-server-plus"
            ],
            [
                "icon" => "mdi-server-remove",
                "title" => "mdi-server-remove"
            ],
            [
                "icon" => "mdi-server-security",
                "title" => "mdi-server-security"
            ],
            [
                "icon" => "mdi-set-all",
                "title" => "mdi-set-all"
            ],
            [
                "icon" => "mdi-set-center",
                "title" => "mdi-set-center"
            ],
            [
                "icon" => "mdi-set-center-right",
                "title" => "mdi-set-center-right"
            ],
            [
                "icon" => "mdi-set-left",
                "title" => "mdi-set-left"
            ],
            [
                "icon" => "mdi-set-left-center",
                "title" => "mdi-set-left-center"
            ],
            [
                "icon" => "mdi-set-left-right",
                "title" => "mdi-set-left-right"
            ],
            [
                "icon" => "mdi-set-none",
                "title" => "mdi-set-none"
            ],
            [
                "icon" => "mdi-set-right",
                "title" => "mdi-set-right"
            ],
            [
                "icon" => "mdi-settings",
                "title" => "mdi-settings"
            ],
            [
                "icon" => "mdi-settings-box",
                "title" => "mdi-settings-box"
            ],
            [
                "icon" => "mdi-shape-circle-plus",
                "title" => "mdi-shape-circle-plus"
            ],
            [
                "icon" => "mdi-shape-plus",
                "title" => "mdi-shape-plus"
            ],
            [
                "icon" => "mdi-shape-polygon-plus",
                "title" => "mdi-shape-polygon-plus"
            ],
            [
                "icon" => "mdi-shape-rectangle-plus",
                "title" => "mdi-shape-rectangle-plus"
            ],
            [
                "icon" => "mdi-shape-square-plus",
                "title" => "mdi-shape-square-plus"
            ],
            [
                "icon" => "mdi-share",
                "title" => "mdi-share"
            ],
            [
                "icon" => "mdi-share-variant",
                "title" => "mdi-share-variant"
            ],
            [
                "icon" => "mdi-shield",
                "title" => "mdi-shield"
            ],
            [
                "icon" => "mdi-shield-half-full",
                "title" => "mdi-shield-half-full"
            ],
            [
                "icon" => "mdi-shield-outline",
                "title" => "mdi-shield-outline"
            ],
            [
                "icon" => "mdi-shopping",
                "title" => "mdi-shopping"
            ],
            [
                "icon" => "mdi-shopping-music",
                "title" => "mdi-shopping-music"
            ],
            [
                "icon" => "mdi-shovel",
                "title" => "mdi-shovel"
            ],
            [
                "icon" => "mdi-shovel-off",
                "title" => "mdi-shovel-off"
            ],
            [
                "icon" => "mdi-shredder",
                "title" => "mdi-shredder"
            ],
            [
                "icon" => "mdi-shuffle",
                "title" => "mdi-shuffle"
            ],
            [
                "icon" => "mdi-shuffle-disabled",
                "title" => "mdi-shuffle-disabled"
            ],
            [
                "icon" => "mdi-shuffle-variant",
                "title" => "mdi-shuffle-variant"
            ],
            [
                "icon" => "mdi-sigma",
                "title" => "mdi-sigma"
            ],
            [
                "icon" => "mdi-sigma-lower",
                "title" => "mdi-sigma-lower"
            ],
            [
                "icon" => "mdi-sign-caution",
                "title" => "mdi-sign-caution"
            ],
            [
                "icon" => "mdi-sign-direction",
                "title" => "mdi-sign-direction"
            ],
            [
                "icon" => "mdi-sign-text",
                "title" => "mdi-sign-text"
            ],
            [
                "icon" => "mdi-signal",
                "title" => "mdi-signal"
            ],
            [
                "icon" => "mdi-signal-2g",
                "title" => "mdi-signal-2g"
            ],
            [
                "icon" => "mdi-signal-3g",
                "title" => "mdi-signal-3g"
            ],
            [
                "icon" => "mdi-signal-4g",
                "title" => "mdi-signal-4g"
            ],
            [
                "icon" => "mdi-signal-hspa",
                "title" => "mdi-signal-hspa"
            ],
            [
                "icon" => "mdi-signal-hspa-plus",
                "title" => "mdi-signal-hspa-plus"
            ],
            [
                "icon" => "mdi-signal-off",
                "title" => "mdi-signal-off"
            ],
            [
                "icon" => "mdi-signal-variant",
                "title" => "mdi-signal-variant"
            ],
            [
                "icon" => "mdi-silverware",
                "title" => "mdi-silverware"
            ],
            [
                "icon" => "mdi-silverware-fork",
                "title" => "mdi-silverware-fork"
            ],
            [
                "icon" => "mdi-silverware-spoon",
                "title" => "mdi-silverware-spoon"
            ],
            [
                "icon" => "mdi-silverware-variant",
                "title" => "mdi-silverware-variant"
            ],
            [
                "icon" => "mdi-sim",
                "title" => "mdi-sim"
            ],
            [
                "icon" => "mdi-sim-alert",
                "title" => "mdi-sim-alert"
            ],
            [
                "icon" => "mdi-sim-off",
                "title" => "mdi-sim-off"
            ],
            [
                "icon" => "mdi-sitemap",
                "title" => "mdi-sitemap"
            ],
            [
                "icon" => "mdi-skip-backward",
                "title" => "mdi-skip-backward"
            ],
            [
                "icon" => "mdi-skip-forward",
                "title" => "mdi-skip-forward"
            ],
            [
                "icon" => "mdi-skip-next",
                "title" => "mdi-skip-next"
            ],
            [
                "icon" => "mdi-skip-next-circle",
                "title" => "mdi-skip-next-circle"
            ],
            [
                "icon" => "mdi-skip-next-circle-outline",
                "title" => "mdi-skip-next-circle-outline"
            ],
            [
                "icon" => "mdi-skip-previous",
                "title" => "mdi-skip-previous"
            ],
            [
                "icon" => "mdi-skip-previous-circle",
                "title" => "mdi-skip-previous-circle"
            ],
            [
                "icon" => "mdi-skip-previous-circle-outline",
                "title" => "mdi-skip-previous-circle-outline"
            ],
            [
                "icon" => "mdi-skull",
                "title" => "mdi-skull"
            ],
            [
                "icon" => "mdi-skype",
                "title" => "mdi-skype"
            ],
            [
                "icon" => "mdi-skype-business",
                "title" => "mdi-skype-business"
            ],
            [
                "icon" => "mdi-slack",
                "title" => "mdi-slack"
            ],
            [
                "icon" => "mdi-sleep",
                "title" => "mdi-sleep"
            ],
            [
                "icon" => "mdi-sleep-off",
                "title" => "mdi-sleep-off"
            ],
            [
                "icon" => "mdi-smoking",
                "title" => "mdi-smoking"
            ],
            [
                "icon" => "mdi-smoking-off",
                "title" => "mdi-smoking-off"
            ],
            [
                "icon" => "mdi-snapchat",
                "title" => "mdi-snapchat"
            ],
            [
                "icon" => "mdi-snowflake",
                "title" => "mdi-snowflake"
            ],
            [
                "icon" => "mdi-snowman",
                "title" => "mdi-snowman"
            ],
            [
                "icon" => "mdi-soccer",
                "title" => "mdi-soccer"
            ],
            [
                "icon" => "mdi-sofa",
                "title" => "mdi-sofa"
            ],
            [
                "icon" => "mdi-solid",
                "title" => "mdi-solid"
            ],
            [
                "icon" => "mdi-sort",
                "title" => "mdi-sort"
            ],
            [
                "icon" => "mdi-sort-alphabetical",
                "title" => "mdi-sort-alphabetical"
            ],
            [
                "icon" => "mdi-sort-ascending",
                "title" => "mdi-sort-ascending"
            ],
            [
                "icon" => "mdi-sort-descending",
                "title" => "mdi-sort-descending"
            ],
            [
                "icon" => "mdi-sort-numeric",
                "title" => "mdi-sort-numeric"
            ],
            [
                "icon" => "mdi-sort-variant",
                "title" => "mdi-sort-variant"
            ],
            [
                "icon" => "mdi-soundcloud",
                "title" => "mdi-soundcloud"
            ],
            [
                "icon" => "mdi-source-branch",
                "title" => "mdi-source-branch"
            ],
            [
                "icon" => "mdi-source-commit",
                "title" => "mdi-source-commit"
            ],
            [
                "icon" => "mdi-source-commit-end",
                "title" => "mdi-source-commit-end"
            ],
            [
                "icon" => "mdi-source-commit-end-local",
                "title" => "mdi-source-commit-end-local"
            ],
            [
                "icon" => "mdi-source-commit-local",
                "title" => "mdi-source-commit-local"
            ],
            [
                "icon" => "mdi-source-commit-next-local",
                "title" => "mdi-source-commit-next-local"
            ],
            [
                "icon" => "mdi-source-commit-start",
                "title" => "mdi-source-commit-start"
            ],
            [
                "icon" => "mdi-source-commit-start-next-local",
                "title" => "mdi-source-commit-start-next-local"
            ],
            [
                "icon" => "mdi-source-fork",
                "title" => "mdi-source-fork"
            ],
            [
                "icon" => "mdi-source-merge",
                "title" => "mdi-source-merge"
            ],
            [
                "icon" => "mdi-source-pull",
                "title" => "mdi-source-pull"
            ],
            [
                "icon" => "mdi-soy-sauce",
                "title" => "mdi-soy-sauce"
            ],
            [
                "icon" => "mdi-speaker",
                "title" => "mdi-speaker"
            ],
            [
                "icon" => "mdi-speaker-off",
                "title" => "mdi-speaker-off"
            ],
            [
                "icon" => "mdi-speaker-wireless",
                "title" => "mdi-speaker-wireless"
            ],
            [
                "icon" => "mdi-speedometer",
                "title" => "mdi-speedometer"
            ],
            [
                "icon" => "mdi-spellcheck",
                "title" => "mdi-spellcheck"
            ],
            [
                "icon" => "mdi-spotify",
                "title" => "mdi-spotify"
            ],
            [
                "icon" => "mdi-spotlight",
                "title" => "mdi-spotlight"
            ],
            [
                "icon" => "mdi-spotlight-beam",
                "title" => "mdi-spotlight-beam"
            ],
            [
                "icon" => "mdi-spray",
                "title" => "mdi-spray"
            ],
            [
                "icon" => "mdi-square",
                "title" => "mdi-square"
            ],
            [
                "icon" => "mdi-square-inc",
                "title" => "mdi-square-inc"
            ],
            [
                "icon" => "mdi-square-inc-cash",
                "title" => "mdi-square-inc-cash"
            ],
            [
                "icon" => "mdi-square-outline",
                "title" => "mdi-square-outline"
            ],
            [
                "icon" => "mdi-square-root",
                "title" => "mdi-square-root"
            ],
            [
                "icon" => "mdi-stackexchange",
                "title" => "mdi-stackexchange"
            ],
            [
                "icon" => "mdi-stackoverflow",
                "title" => "mdi-stackoverflow"
            ],
            [
                "icon" => "mdi-stadium",
                "title" => "mdi-stadium"
            ],
            [
                "icon" => "mdi-stairs",
                "title" => "mdi-stairs"
            ],
            [
                "icon" => "mdi-standard-definition",
                "title" => "mdi-standard-definition"
            ],
            [
                "icon" => "mdi-star",
                "title" => "mdi-star"
            ],
            [
                "icon" => "mdi-star-circle",
                "title" => "mdi-star-circle"
            ],
            [
                "icon" => "mdi-star-half",
                "title" => "mdi-star-half"
            ],
            [
                "icon" => "mdi-star-off",
                "title" => "mdi-star-off"
            ],
            [
                "icon" => "mdi-star-outline",
                "title" => "mdi-star-outline"
            ],
            [
                "icon" => "mdi-steam",
                "title" => "mdi-steam"
            ],
            [
                "icon" => "mdi-steering",
                "title" => "mdi-steering"
            ],
            [
                "icon" => "mdi-step-backward",
                "title" => "mdi-step-backward"
            ],
            [
                "icon" => "mdi-step-backward-2",
                "title" => "mdi-step-backward-2"
            ],
            [
                "icon" => "mdi-step-forward",
                "title" => "mdi-step-forward"
            ],
            [
                "icon" => "mdi-step-forward-2",
                "title" => "mdi-step-forward-2"
            ],
            [
                "icon" => "mdi-stethoscope",
                "title" => "mdi-stethoscope"
            ],
            [
                "icon" => "mdi-sticker",
                "title" => "mdi-sticker"
            ],
            [
                "icon" => "mdi-sticker-emoji",
                "title" => "mdi-sticker-emoji"
            ],
            [
                "icon" => "mdi-stocking",
                "title" => "mdi-stocking"
            ],
            [
                "icon" => "mdi-stop",
                "title" => "mdi-stop"
            ],
            [
                "icon" => "mdi-stop-circle",
                "title" => "mdi-stop-circle"
            ],
            [
                "icon" => "mdi-stop-circle-outline",
                "title" => "mdi-stop-circle-outline"
            ],
            [
                "icon" => "mdi-store",
                "title" => "mdi-store"
            ],
            [
                "icon" => "mdi-store-24-hour",
                "title" => "mdi-store-24-hour"
            ],
            [
                "icon" => "mdi-stove",
                "title" => "mdi-stove"
            ],
            [
                "icon" => "mdi-subdirectory-arrow-left",
                "title" => "mdi-subdirectory-arrow-left"
            ],
            [
                "icon" => "mdi-subdirectory-arrow-right",
                "title" => "mdi-subdirectory-arrow-right"
            ],
            [
                "icon" => "mdi-subway",
                "title" => "mdi-subway"
            ],
            [
                "icon" => "mdi-subway-variant",
                "title" => "mdi-subway-variant"
            ],
            [
                "icon" => "mdi-summit",
                "title" => "mdi-summit"
            ],
            [
                "icon" => "mdi-sunglasses",
                "title" => "mdi-sunglasses"
            ],
            [
                "icon" => "mdi-surround-sound",
                "title" => "mdi-surround-sound"
            ],
            [
                "icon" => "mdi-surround-sound-2-0",
                "title" => "mdi-surround-sound-2-0"
            ],
            [
                "icon" => "mdi-surround-sound-3-1",
                "title" => "mdi-surround-sound-3-1"
            ],
            [
                "icon" => "mdi-surround-sound-5-1",
                "title" => "mdi-surround-sound-5-1"
            ],
            [
                "icon" => "mdi-surround-sound-7-1",
                "title" => "mdi-surround-sound-7-1"
            ],
            [
                "icon" => "mdi-svg",
                "title" => "mdi-svg"
            ],
            [
                "icon" => "mdi-swap-horizontal",
                "title" => "mdi-swap-horizontal"
            ],
            [
                "icon" => "mdi-swap-vertical",
                "title" => "mdi-swap-vertical"
            ],
            [
                "icon" => "mdi-swim",
                "title" => "mdi-swim"
            ],
            [
                "icon" => "mdi-switch",
                "title" => "mdi-switch"
            ],
            [
                "icon" => "mdi-sword",
                "title" => "mdi-sword"
            ],
            [
                "icon" => "mdi-sword-cross",
                "title" => "mdi-sword-cross"
            ],
            [
                "icon" => "mdi-sync",
                "title" => "mdi-sync"
            ],
            [
                "icon" => "mdi-sync-alert",
                "title" => "mdi-sync-alert"
            ],
            [
                "icon" => "mdi-sync-off",
                "title" => "mdi-sync-off"
            ],
            [
                "icon" => "mdi-tab",
                "title" => "mdi-tab"
            ],
            [
                "icon" => "mdi-tab-plus",
                "title" => "mdi-tab-plus"
            ],
            [
                "icon" => "mdi-tab-unselected",
                "title" => "mdi-tab-unselected"
            ],
            [
                "icon" => "mdi-table",
                "title" => "mdi-table"
            ],
            [
                "icon" => "mdi-table-column-plus-after",
                "title" => "mdi-table-column-plus-after"
            ],
            [
                "icon" => "mdi-table-column-plus-before",
                "title" => "mdi-table-column-plus-before"
            ],
            [
                "icon" => "mdi-table-column-remove",
                "title" => "mdi-table-column-remove"
            ],
            [
                "icon" => "mdi-table-column-width",
                "title" => "mdi-table-column-width"
            ],
            [
                "icon" => "mdi-table-edit",
                "title" => "mdi-table-edit"
            ],
            [
                "icon" => "mdi-table-large",
                "title" => "mdi-table-large"
            ],
            [
                "icon" => "mdi-table-row-height",
                "title" => "mdi-table-row-height"
            ],
            [
                "icon" => "mdi-table-row-plus-after",
                "title" => "mdi-table-row-plus-after"
            ],
            [
                "icon" => "mdi-table-row-plus-before",
                "title" => "mdi-table-row-plus-before"
            ],
            [
                "icon" => "mdi-table-row-remove",
                "title" => "mdi-table-row-remove"
            ],
            [
                "icon" => "mdi-tablet",
                "title" => "mdi-tablet"
            ],
            [
                "icon" => "mdi-tablet-android",
                "title" => "mdi-tablet-android"
            ],
            [
                "icon" => "mdi-tablet-ipad",
                "title" => "mdi-tablet-ipad"
            ],
            [
                "icon" => "mdi-taco",
                "title" => "mdi-taco"
            ],
            [
                "icon" => "mdi-tag",
                "title" => "mdi-tag"
            ],
            [
                "icon" => "mdi-tag-faces",
                "title" => "mdi-tag-faces"
            ],
            [
                "icon" => "mdi-tag-heart",
                "title" => "mdi-tag-heart"
            ],
            [
                "icon" => "mdi-tag-multiple",
                "title" => "mdi-tag-multiple"
            ],
            [
                "icon" => "mdi-tag-outline",
                "title" => "mdi-tag-outline"
            ],
            [
                "icon" => "mdi-tag-plus",
                "title" => "mdi-tag-plus"
            ],
            [
                "icon" => "mdi-tag-remove",
                "title" => "mdi-tag-remove"
            ],
            [
                "icon" => "mdi-tag-text-outline",
                "title" => "mdi-tag-text-outline"
            ],
            [
                "icon" => "mdi-target",
                "title" => "mdi-target"
            ],
            [
                "icon" => "mdi-taxi",
                "title" => "mdi-taxi"
            ],
            [
                "icon" => "mdi-teamviewer",
                "title" => "mdi-teamviewer"
            ],
            [
                "icon" => "mdi-telegram",
                "title" => "mdi-telegram"
            ],
            [
                "icon" => "mdi-television",
                "title" => "mdi-television"
            ],
            [
                "icon" => "mdi-television-classic",
                "title" => "mdi-television-classic"
            ],
            [
                "icon" => "mdi-television-guide",
                "title" => "mdi-television-guide"
            ],
            [
                "icon" => "mdi-temperature-celsius",
                "title" => "mdi-temperature-celsius"
            ],
            [
                "icon" => "mdi-temperature-fahrenheit",
                "title" => "mdi-temperature-fahrenheit"
            ],
            [
                "icon" => "mdi-temperature-kelvin",
                "title" => "mdi-temperature-kelvin"
            ],
            [
                "icon" => "mdi-tennis",
                "title" => "mdi-tennis"
            ],
            [
                "icon" => "mdi-tent",
                "title" => "mdi-tent"
            ],
            [
                "icon" => "mdi-terrain",
                "title" => "mdi-terrain"
            ],
            [
                "icon" => "mdi-test-tube",
                "title" => "mdi-test-tube"
            ],
            [
                "icon" => "mdi-text-shadow",
                "title" => "mdi-text-shadow"
            ],
            [
                "icon" => "mdi-text-to-speech",
                "title" => "mdi-text-to-speech"
            ],
            [
                "icon" => "mdi-text-to-speech-off",
                "title" => "mdi-text-to-speech-off"
            ],
            [
                "icon" => "mdi-textbox",
                "title" => "mdi-textbox"
            ],
            [
                "icon" => "mdi-textbox-password",
                "title" => "mdi-textbox-password"
            ],
            [
                "icon" => "mdi-texture",
                "title" => "mdi-texture"
            ],
            [
                "icon" => "mdi-theater",
                "title" => "mdi-theater"
            ],
            [
                "icon" => "mdi-theme-light-dark",
                "title" => "mdi-theme-light-dark"
            ],
            [
                "icon" => "mdi-thermometer",
                "title" => "mdi-thermometer"
            ],
            [
                "icon" => "mdi-thermometer-lines",
                "title" => "mdi-thermometer-lines"
            ],
            [
                "icon" => "mdi-thought-bubble",
                "title" => "mdi-thought-bubble"
            ],
            [
                "icon" => "mdi-thought-bubble-outline",
                "title" => "mdi-thought-bubble-outline"
            ],
            [
                "icon" => "mdi-thumb-down",
                "title" => "mdi-thumb-down"
            ],
            [
                "icon" => "mdi-thumb-down-outline",
                "title" => "mdi-thumb-down-outline"
            ],
            [
                "icon" => "mdi-thumb-up",
                "title" => "mdi-thumb-up"
            ],
            [
                "icon" => "mdi-thumb-up-outline",
                "title" => "mdi-thumb-up-outline"
            ],
            [
                "icon" => "mdi-thumbs-up-down",
                "title" => "mdi-thumbs-up-down"
            ],
            [
                "icon" => "mdi-ticket",
                "title" => "mdi-ticket"
            ],
            [
                "icon" => "mdi-ticket-account",
                "title" => "mdi-ticket-account"
            ],
            [
                "icon" => "mdi-ticket-confirmation",
                "title" => "mdi-ticket-confirmation"
            ],
            [
                "icon" => "mdi-ticket-percent",
                "title" => "mdi-ticket-percent"
            ],
            [
                "icon" => "mdi-tie",
                "title" => "mdi-tie"
            ],
            [
                "icon" => "mdi-tilde",
                "title" => "mdi-tilde"
            ],
            [
                "icon" => "mdi-timelapse",
                "title" => "mdi-timelapse"
            ],
            [
                "icon" => "mdi-timer",
                "title" => "mdi-timer"
            ],
            [
                "icon" => "mdi-timer-10",
                "title" => "mdi-timer-10"
            ],
            [
                "icon" => "mdi-timer-3",
                "title" => "mdi-timer-3"
            ],
            [
                "icon" => "mdi-timer-off",
                "title" => "mdi-timer-off"
            ],
            [
                "icon" => "mdi-timer-sand",
                "title" => "mdi-timer-sand"
            ],
            [
                "icon" => "mdi-timer-sand-empty",
                "title" => "mdi-timer-sand-empty"
            ],
            [
                "icon" => "mdi-timer-sand-full",
                "title" => "mdi-timer-sand-full"
            ],
            [
                "icon" => "mdi-timetable",
                "title" => "mdi-timetable"
            ],
            [
                "icon" => "mdi-toggle-switch",
                "title" => "mdi-toggle-switch"
            ],
            [
                "icon" => "mdi-toggle-switch-off",
                "title" => "mdi-toggle-switch-off"
            ],
            [
                "icon" => "mdi-tooltip",
                "title" => "mdi-tooltip"
            ],
            [
                "icon" => "mdi-tooltip-edit",
                "title" => "mdi-tooltip-edit"
            ],
            [
                "icon" => "mdi-tooltip-image",
                "title" => "mdi-tooltip-image"
            ],
            [
                "icon" => "mdi-tooltip-outline",
                "title" => "mdi-tooltip-outline"
            ],
            [
                "icon" => "mdi-tooltip-outline-plus",
                "title" => "mdi-tooltip-outline-plus"
            ],
            [
                "icon" => "mdi-tooltip-text",
                "title" => "mdi-tooltip-text"
            ],
            [
                "icon" => "mdi-tooth",
                "title" => "mdi-tooth"
            ],
            [
                "icon" => "mdi-tor",
                "title" => "mdi-tor"
            ],
            [
                "icon" => "mdi-tower-beach",
                "title" => "mdi-tower-beach"
            ],
            [
                "icon" => "mdi-tower-fire",
                "title" => "mdi-tower-fire"
            ],
            [
                "icon" => "mdi-trackpad",
                "title" => "mdi-trackpad"
            ],
            [
                "icon" => "mdi-traffic-light",
                "title" => "mdi-traffic-light"
            ],
            [
                "icon" => "mdi-train",
                "title" => "mdi-train"
            ],
            [
                "icon" => "mdi-tram",
                "title" => "mdi-tram"
            ],
            [
                "icon" => "mdi-transcribe",
                "title" => "mdi-transcribe"
            ],
            [
                "icon" => "mdi-transcribe-close",
                "title" => "mdi-transcribe-close"
            ],
            [
                "icon" => "mdi-transfer",
                "title" => "mdi-transfer"
            ],
            [
                "icon" => "mdi-transit-transfer",
                "title" => "mdi-transit-transfer"
            ],
            [
                "icon" => "mdi-translate",
                "title" => "mdi-translate"
            ],
            [
                "icon" => "mdi-treasure-chest",
                "title" => "mdi-treasure-chest"
            ],
            [
                "icon" => "mdi-tree",
                "title" => "mdi-tree"
            ],
            [
                "icon" => "mdi-trello",
                "title" => "mdi-trello"
            ],
            [
                "icon" => "mdi-trending-down",
                "title" => "mdi-trending-down"
            ],
            [
                "icon" => "mdi-trending-neutral",
                "title" => "mdi-trending-neutral"
            ],
            [
                "icon" => "mdi-trending-up",
                "title" => "mdi-trending-up"
            ],
            [
                "icon" => "mdi-triangle",
                "title" => "mdi-triangle"
            ],
            [
                "icon" => "mdi-triangle-outline",
                "title" => "mdi-triangle-outline"
            ],
            [
                "icon" => "mdi-trophy",
                "title" => "mdi-trophy"
            ],
            [
                "icon" => "mdi-trophy-award",
                "title" => "mdi-trophy-award"
            ],
            [
                "icon" => "mdi-trophy-outline",
                "title" => "mdi-trophy-outline"
            ],
            [
                "icon" => "mdi-trophy-variant",
                "title" => "mdi-trophy-variant"
            ],
            [
                "icon" => "mdi-trophy-variant-outline",
                "title" => "mdi-trophy-variant-outline"
            ],
            [
                "icon" => "mdi-truck",
                "title" => "mdi-truck"
            ],
            [
                "icon" => "mdi-truck-delivery",
                "title" => "mdi-truck-delivery"
            ],
            [
                "icon" => "mdi-truck-fast",
                "title" => "mdi-truck-fast"
            ],
            [
                "icon" => "mdi-truck-trailer",
                "title" => "mdi-truck-trailer"
            ],
            [
                "icon" => "mdi-tshirt-crew",
                "title" => "mdi-tshirt-crew"
            ],
            [
                "icon" => "mdi-tshirt-v",
                "title" => "mdi-tshirt-v"
            ],
            [
                "icon" => "mdi-tumblr",
                "title" => "mdi-tumblr"
            ],
            [
                "icon" => "mdi-tumblr-reblog",
                "title" => "mdi-tumblr-reblog"
            ],
            [
                "icon" => "mdi-tune",
                "title" => "mdi-tune"
            ],
            [
                "icon" => "mdi-tune-vertical",
                "title" => "mdi-tune-vertical"
            ],
            [
                "icon" => "mdi-twitch",
                "title" => "mdi-twitch"
            ],
            [
                "icon" => "mdi-twitter",
                "title" => "mdi-twitter"
            ],
            [
                "icon" => "mdi-twitter-box",
                "title" => "mdi-twitter-box"
            ],
            [
                "icon" => "mdi-twitter-circle",
                "title" => "mdi-twitter-circle"
            ],
            [
                "icon" => "mdi-twitter-retweet",
                "title" => "mdi-twitter-retweet"
            ],
            [
                "icon" => "mdi-uber",
                "title" => "mdi-uber"
            ],
            [
                "icon" => "mdi-ubuntu",
                "title" => "mdi-ubuntu"
            ],
            [
                "icon" => "mdi-ultra-high-definition",
                "title" => "mdi-ultra-high-definition"
            ],
            [
                "icon" => "mdi-umbraco",
                "title" => "mdi-umbraco"
            ],
            [
                "icon" => "mdi-umbrella",
                "title" => "mdi-umbrella"
            ],
            [
                "icon" => "mdi-umbrella-outline",
                "title" => "mdi-umbrella-outline"
            ],
            [
                "icon" => "mdi-undo",
                "title" => "mdi-undo"
            ],
            [
                "icon" => "mdi-undo-variant",
                "title" => "mdi-undo-variant"
            ],
            [
                "icon" => "mdi-unfold-less-horizontal",
                "title" => "mdi-unfold-less-horizontal"
            ],
            [
                "icon" => "mdi-unfold-less-vertical",
                "title" => "mdi-unfold-less-vertical"
            ],
            [
                "icon" => "mdi-unfold-more-horizontal",
                "title" => "mdi-unfold-more-horizontal"
            ],
            [
                "icon" => "mdi-unfold-more-vertical",
                "title" => "mdi-unfold-more-vertical"
            ],
            [
                "icon" => "mdi-ungroup",
                "title" => "mdi-ungroup"
            ],
            [
                "icon" => "mdi-unity",
                "title" => "mdi-unity"
            ],
            [
                "icon" => "mdi-untappd",
                "title" => "mdi-untappd"
            ],
            [
                "icon" => "mdi-update",
                "title" => "mdi-update"
            ],
            [
                "icon" => "mdi-upload",
                "title" => "mdi-upload"
            ],
            [
                "icon" => "mdi-upload-network",
                "title" => "mdi-upload-network"
            ],
            [
                "icon" => "mdi-usb",
                "title" => "mdi-usb"
            ],
            [
                "icon" => "mdi-van-passenger",
                "title" => "mdi-van-passenger"
            ],
            [
                "icon" => "mdi-van-utility",
                "title" => "mdi-van-utility"
            ],
            [
                "icon" => "mdi-vanish",
                "title" => "mdi-vanish"
            ],
            [
                "icon" => "mdi-vector-arrange-above",
                "title" => "mdi-vector-arrange-above"
            ],
            [
                "icon" => "mdi-vector-arrange-below",
                "title" => "mdi-vector-arrange-below"
            ],
            [
                "icon" => "mdi-vector-circle",
                "title" => "mdi-vector-circle"
            ],
            [
                "icon" => "mdi-vector-circle-variant",
                "title" => "mdi-vector-circle-variant"
            ],
            [
                "icon" => "mdi-vector-combine",
                "title" => "mdi-vector-combine"
            ],
            [
                "icon" => "mdi-vector-curve",
                "title" => "mdi-vector-curve"
            ],
            [
                "icon" => "mdi-vector-difference",
                "title" => "mdi-vector-difference"
            ],
            [
                "icon" => "mdi-vector-difference-ab",
                "title" => "mdi-vector-difference-ab"
            ],
            [
                "icon" => "mdi-vector-difference-ba",
                "title" => "mdi-vector-difference-ba"
            ],
            [
                "icon" => "mdi-vector-intersection",
                "title" => "mdi-vector-intersection"
            ],
            [
                "icon" => "mdi-vector-line",
                "title" => "mdi-vector-line"
            ],
            [
                "icon" => "mdi-vector-point",
                "title" => "mdi-vector-point"
            ],
            [
                "icon" => "mdi-vector-polygon",
                "title" => "mdi-vector-polygon"
            ],
            [
                "icon" => "mdi-vector-polyline",
                "title" => "mdi-vector-polyline"
            ],
            [
                "icon" => "mdi-vector-radius",
                "title" => "mdi-vector-radius"
            ],
            [
                "icon" => "mdi-vector-rectangle",
                "title" => "mdi-vector-rectangle"
            ],
            [
                "icon" => "mdi-vector-selection",
                "title" => "mdi-vector-selection"
            ],
            [
                "icon" => "mdi-vector-square",
                "title" => "mdi-vector-square"
            ],
            [
                "icon" => "mdi-vector-triangle",
                "title" => "mdi-vector-triangle"
            ],
            [
                "icon" => "mdi-vector-union",
                "title" => "mdi-vector-union"
            ],
            [
                "icon" => "mdi-verified",
                "title" => "mdi-verified"
            ],
            [
                "icon" => "mdi-vibrate",
                "title" => "mdi-vibrate"
            ],
            [
                "icon" => "mdi-video",
                "title" => "mdi-video"
            ],
            [
                "icon" => "mdi-video-3d",
                "title" => "mdi-video-3d"
            ],
            [
                "icon" => "mdi-video-off",
                "title" => "mdi-video-off"
            ],
            [
                "icon" => "mdi-video-switch",
                "title" => "mdi-video-switch"
            ],
            [
                "icon" => "mdi-view-agenda",
                "title" => "mdi-view-agenda"
            ],
            [
                "icon" => "mdi-view-array",
                "title" => "mdi-view-array"
            ],
            [
                "icon" => "mdi-view-carousel",
                "title" => "mdi-view-carousel"
            ],
            [
                "icon" => "mdi-view-column",
                "title" => "mdi-view-column"
            ],
            [
                "icon" => "mdi-view-dashboard",
                "title" => "mdi-view-dashboard"
            ],
            [
                "icon" => "mdi-view-day",
                "title" => "mdi-view-day"
            ],
            [
                "icon" => "mdi-view-grid",
                "title" => "mdi-view-grid"
            ],
            [
                "icon" => "mdi-view-headline",
                "title" => "mdi-view-headline"
            ],
            [
                "icon" => "mdi-view-list",
                "title" => "mdi-view-list"
            ],
            [
                "icon" => "mdi-view-module",
                "title" => "mdi-view-module"
            ],
            [
                "icon" => "mdi-view-parallel",
                "title" => "mdi-view-parallel"
            ],
            [
                "icon" => "mdi-view-quilt",
                "title" => "mdi-view-quilt"
            ],
            [
                "icon" => "mdi-view-sequential",
                "title" => "mdi-view-sequential"
            ],
            [
                "icon" => "mdi-view-stream",
                "title" => "mdi-view-stream"
            ],
            [
                "icon" => "mdi-view-week",
                "title" => "mdi-view-week"
            ],
            [
                "icon" => "mdi-vimeo",
                "title" => "mdi-vimeo"
            ],
            [
                "icon" => "mdi-vine",
                "title" => "mdi-vine"
            ],
            [
                "icon" => "mdi-violin",
                "title" => "mdi-violin"
            ],
            [
                "icon" => "mdi-visualstudio",
                "title" => "mdi-visualstudio"
            ],
            [
                "icon" => "mdi-vk",
                "title" => "mdi-vk"
            ],
            [
                "icon" => "mdi-vk-box",
                "title" => "mdi-vk-box"
            ],
            [
                "icon" => "mdi-vk-circle",
                "title" => "mdi-vk-circle"
            ],
            [
                "icon" => "mdi-vlc",
                "title" => "mdi-vlc"
            ],
            [
                "icon" => "mdi-voice",
                "title" => "mdi-voice"
            ],
            [
                "icon" => "mdi-voicemail",
                "title" => "mdi-voicemail"
            ],
            [
                "icon" => "mdi-volume-high",
                "title" => "mdi-volume-high"
            ],
            [
                "icon" => "mdi-volume-low",
                "title" => "mdi-volume-low"
            ],
            [
                "icon" => "mdi-volume-medium",
                "title" => "mdi-volume-medium"
            ],
            [
                "icon" => "mdi-volume-minus",
                "title" => "mdi-volume-minus"
            ],
            [
                "icon" => "mdi-volume-mute",
                "title" => "mdi-volume-mute"
            ],
            [
                "icon" => "mdi-volume-off",
                "title" => "mdi-volume-off"
            ],
            [
                "icon" => "mdi-volume-plus",
                "title" => "mdi-volume-plus"
            ],
            [
                "icon" => "mdi-vpn",
                "title" => "mdi-vpn"
            ],
            [
                "icon" => "mdi-walk",
                "title" => "mdi-walk"
            ],
            [
                "icon" => "mdi-wall",
                "title" => "mdi-wall"
            ],
            [
                "icon" => "mdi-wallet",
                "title" => "mdi-wallet"
            ],
            [
                "icon" => "mdi-wallet-giftcard",
                "title" => "mdi-wallet-giftcard"
            ],
            [
                "icon" => "mdi-wallet-membership",
                "title" => "mdi-wallet-membership"
            ],
            [
                "icon" => "mdi-wallet-travel",
                "title" => "mdi-wallet-travel"
            ],
            [
                "icon" => "mdi-wan",
                "title" => "mdi-wan"
            ],
            [
                "icon" => "mdi-washing-machine",
                "title" => "mdi-washing-machine"
            ],
            [
                "icon" => "mdi-watch",
                "title" => "mdi-watch"
            ],
            [
                "icon" => "mdi-watch-export",
                "title" => "mdi-watch-export"
            ],
            [
                "icon" => "mdi-watch-import",
                "title" => "mdi-watch-import"
            ],
            [
                "icon" => "mdi-watch-vibrate",
                "title" => "mdi-watch-vibrate"
            ],
            [
                "icon" => "mdi-water",
                "title" => "mdi-water"
            ],
            [
                "icon" => "mdi-water-off",
                "title" => "mdi-water-off"
            ],
            [
                "icon" => "mdi-water-percent",
                "title" => "mdi-water-percent"
            ],
            [
                "icon" => "mdi-water-pump",
                "title" => "mdi-water-pump"
            ],
            [
                "icon" => "mdi-watermark",
                "title" => "mdi-watermark"
            ],
            [
                "icon" => "mdi-waves",
                "title" => "mdi-waves"
            ],
            [
                "icon" => "mdi-weather-cloudy",
                "title" => "mdi-weather-cloudy"
            ],
            [
                "icon" => "mdi-weather-fog",
                "title" => "mdi-weather-fog"
            ],
            [
                "icon" => "mdi-weather-hail",
                "title" => "mdi-weather-hail"
            ],
            [
                "icon" => "mdi-weather-lightning",
                "title" => "mdi-weather-lightning"
            ],
            [
                "icon" => "mdi-weather-lightning-rainy",
                "title" => "mdi-weather-lightning-rainy"
            ],
            [
                "icon" => "mdi-weather-night",
                "title" => "mdi-weather-night"
            ],
            [
                "icon" => "mdi-weather-partlycloudy",
                "title" => "mdi-weather-partlycloudy"
            ],
            [
                "icon" => "mdi-weather-pouring",
                "title" => "mdi-weather-pouring"
            ],
            [
                "icon" => "mdi-weather-rainy",
                "title" => "mdi-weather-rainy"
            ],
            [
                "icon" => "mdi-weather-snowy",
                "title" => "mdi-weather-snowy"
            ],
            [
                "icon" => "mdi-weather-snowy-rainy",
                "title" => "mdi-weather-snowy-rainy"
            ],
            [
                "icon" => "mdi-weather-sunny",
                "title" => "mdi-weather-sunny"
            ],
            [
                "icon" => "mdi-weather-sunset",
                "title" => "mdi-weather-sunset"
            ],
            [
                "icon" => "mdi-weather-sunset-down",
                "title" => "mdi-weather-sunset-down"
            ],
            [
                "icon" => "mdi-weather-sunset-up",
                "title" => "mdi-weather-sunset-up"
            ],
            [
                "icon" => "mdi-weather-windy",
                "title" => "mdi-weather-windy"
            ],
            [
                "icon" => "mdi-weather-windy-variant",
                "title" => "mdi-weather-windy-variant"
            ],
            [
                "icon" => "mdi-web",
                "title" => "mdi-web"
            ],
            [
                "icon" => "mdi-webcam",
                "title" => "mdi-webcam"
            ],
            [
                "icon" => "mdi-webhook",
                "title" => "mdi-webhook"
            ],
            [
                "icon" => "mdi-webpack",
                "title" => "mdi-webpack"
            ],
            [
                "icon" => "mdi-wechat",
                "title" => "mdi-wechat"
            ],
            [
                "icon" => "mdi-weight",
                "title" => "mdi-weight"
            ],
            [
                "icon" => "mdi-weight-kilogram",
                "title" => "mdi-weight-kilogram"
            ],
            [
                "icon" => "mdi-whatsapp",
                "title" => "mdi-whatsapp"
            ],
            [
                "icon" => "mdi-wheelchair-accessibility",
                "title" => "mdi-wheelchair-accessibility"
            ],
            [
                "icon" => "mdi-white-balance-auto",
                "title" => "mdi-white-balance-auto"
            ],
            [
                "icon" => "mdi-white-balance-incandescent",
                "title" => "mdi-white-balance-incandescent"
            ],
            [
                "icon" => "mdi-white-balance-iridescent",
                "title" => "mdi-white-balance-iridescent"
            ],
            [
                "icon" => "mdi-white-balance-sunny",
                "title" => "mdi-white-balance-sunny"
            ],
            [
                "icon" => "mdi-widgets",
                "title" => "mdi-widgets"
            ],
            [
                "icon" => "mdi-wifi",
                "title" => "mdi-wifi"
            ],
            [
                "icon" => "mdi-wifi-off",
                "title" => "mdi-wifi-off"
            ],
            [
                "icon" => "mdi-wii",
                "title" => "mdi-wii"
            ],
            [
                "icon" => "mdi-wiiu",
                "title" => "mdi-wiiu"
            ],
            [
                "icon" => "mdi-wikipedia",
                "title" => "mdi-wikipedia"
            ],
            [
                "icon" => "mdi-window-close",
                "title" => "mdi-window-close"
            ],
            [
                "icon" => "mdi-window-closed",
                "title" => "mdi-window-closed"
            ],
            [
                "icon" => "mdi-window-maximize",
                "title" => "mdi-window-maximize"
            ],
            [
                "icon" => "mdi-window-minimize",
                "title" => "mdi-window-minimize"
            ],
            [
                "icon" => "mdi-window-open",
                "title" => "mdi-window-open"
            ],
            [
                "icon" => "mdi-window-restore",
                "title" => "mdi-window-restore"
            ],
            [
                "icon" => "mdi-windows",
                "title" => "mdi-windows"
            ],
            [
                "icon" => "mdi-wordpress",
                "title" => "mdi-wordpress"
            ],
            [
                "icon" => "mdi-worker",
                "title" => "mdi-worker"
            ],
            [
                "icon" => "mdi-wrap",
                "title" => "mdi-wrap"
            ],
            [
                "icon" => "mdi-wrench",
                "title" => "mdi-wrench"
            ],
            [
                "icon" => "mdi-wunderlist",
                "title" => "mdi-wunderlist"
            ],
            [
                "icon" => "mdi-xaml",
                "title" => "mdi-xaml"
            ],
            [
                "icon" => "mdi-xbox",
                "title" => "mdi-xbox"
            ],
            [
                "icon" => "mdi-xbox-controller",
                "title" => "mdi-xbox-controller"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-alert",
                "title" => "mdi-xbox-controller-battery-alert"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-empty",
                "title" => "mdi-xbox-controller-battery-empty"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-full",
                "title" => "mdi-xbox-controller-battery-full"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-low",
                "title" => "mdi-xbox-controller-battery-low"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-medium",
                "title" => "mdi-xbox-controller-battery-medium"
            ],
            [
                "icon" => "mdi-xbox-controller-battery-unknown",
                "title" => "mdi-xbox-controller-battery-unknown"
            ],
            [
                "icon" => "mdi-xbox-controller-off",
                "title" => "mdi-xbox-controller-off"
            ],
            [
                "icon" => "mdi-xda",
                "title" => "mdi-xda"
            ],
            [
                "icon" => "mdi-xing",
                "title" => "mdi-xing"
            ],
            [
                "icon" => "mdi-xing-box",
                "title" => "mdi-xing-box"
            ],
            [
                "icon" => "mdi-xing-circle",
                "title" => "mdi-xing-circle"
            ],
            [
                "icon" => "mdi-xml",
                "title" => "mdi-xml"
            ],
            [
                "icon" => "mdi-xmpp",
                "title" => "mdi-xmpp"
            ],
            [
                "icon" => "mdi-yammer",
                "title" => "mdi-yammer"
            ],
            [
                "icon" => "mdi-yeast",
                "title" => "mdi-yeast"
            ],
            [
                "icon" => "mdi-yelp",
                "title" => "mdi-yelp"
            ],
            [
                "icon" => "mdi-yin-yang",
                "title" => "mdi-yin-yang"
            ],
            [
                "icon" => "mdi-youtube-play",
                "title" => "mdi-youtube-play"
            ],
            [
                "icon" => "mdi-zip-box",
                "title" => "mdi-zip-box"
            ],
            [
                "icon" => "mdi-blank",
                "title" => "mdi-blank"
            ]
        ];
    }

    public function getSubitens($app = 0, $from = null)
    {
        $features = Feature::query()
            ->where([
                'application_id' => $app,
                'from' => $from
            ])->get();

        return json_decode(json_encode($features, true));
    }

    public function make()
    {
        $applications = Application::query()
            ->where([
                'status' => 'A',
                'display_menu' => 'S',
            ])->orderBy('order', 'asc')->get();

        $applications = json_decode(json_encode($applications), true);
        $menu = [];
        $menuFinal = [];
        foreach ($applications as $app) {
            $features = Feature::query()
                ->where([
                    'application_id' => $app['id'],
                    'status' => 'A',
                    'display_menu' => 'S',
                ])->orderBy('order', 'asc')
                ->get();
            $features = json_decode(json_encode($features), true);
            $this->construirMenu($features, $menuFinal, null);
            $app['sub_menus'] = $menuFinal;
            $menu[] = $app;
            $menuFinal = [];
        }

        return json_encode($menu);
    }

    public function construirMenu(array $menus, array &$menuFinal, $menuSuperiorId)
    {
        foreach ($menus as $menu) {
            if ($menu['from'] == $menuSuperiorId) {
                $routeCollection = Route::getRoutes()->getByName($menu['route']);
                if(!count($routeCollection->parameterNames())){
                    $menuFinal[] = $menu;
                }
            }
        }
        for ($i = 0; $i < count($menuFinal); $i++) {
            $menuFinal[$i]['sub_menus'] = [];
            $this->construirMenu($menus, $menuFinal[$i]['sub_menus'], $menuFinal[$i]['id']);
        }
    }

    public function create()
    {
        $route = null;

        if (Route::getCurrentRoute()->getName()) {
            $route = Route::getCurrentRoute()->getName();
        } elseif (Route::current()->uri) {
            $route = Route::current()->uri;
        }

        $this->menus['dashboard'] = [
            'title' => 'Painel',
            'icon' => 'fa fa-desktop',
            'link' => route('dashboard'),
            'route' => 'dashboard',
            'target' => '_blank',
            'info' => false,
            'info_icon' => 'info',
            'description' => 'Painel de controle',
            'show' => true,
            'active' => ($route === 'dashboard') ? true : false
        ];
        /*
                $this->menus['users'] = [
                    'title' => 'Usuários',
                    'icon' => 'fa fa-users',
                    'link' => route('users'),
                    'route' => 'users',
                    'description' => 'Lista de usuários',
                    'show' => true,
                    'info' => false,
                    'info_icon' => 'desktop',
                    'active' => (in_array($route, ['users']))  ? true : false,
                ];

                $this->menus['banners'] = [
                    'title' => 'Banners do site',
                    'icon' => 'fa fa-image',
                    'link' => route('banners'),
                    'route' => 'banners',
                    'description' => 'Banner da Home',
                    'show' => true,
                    'info' => false,
                    'info_icon' => 'image',
                    'active' => (in_array($route, ['banners']))  ? true : false,
                ];

                $this->menus['messages'] = [
                    'title' => 'Mensagens',
                    'icon' => 'fa fa-exclamation-triangle',
                    'link' => route('messages'),
                    'route' => 'messages',
                    'description' => 'Lista de mensagens',
                    'show' => true,
                    'info' => false,
                    'info_icon' => 'exclamation-triangle',
                    'active' => (in_array($route, ['messages']))  ? true : false,
                ];

                        $this->menus['posts'] = [
                            'title' => 'Postagens',
                            'icon' => 'fa fa-edit',
                            'link' => route('admin.posts'),
                            'route' => 'admin.posts',
                            'target' => '_blank',
                            'info' => false,
                            'info_icon' => 'warning',
                            'description' => 'Gerenciar postagem',
                            'show' => true,
                            'active' => (in_array($route, ['posts', 'posts-list', 'posts-add', 'posts-edit'])) ? true : false,
                            'subitens' => [
                                [
                                    'title' => 'Listar postagens',
                                    'icon' => 'fa fa-list-alt',
                                    'link' => route('admin.posts'),
                                    'route' => 'admin.posts',
                                    'target' => '_blank',
                                    'info' => '',
                                    'description' => '',
                                    'show' => true,
                                    'active' => ($route === 'admin.posts') ? true : false
                                ],
                                [
                                    'title' => 'Nova postagem',
                                    'icon' => 'fa fa-plus-circle',
                                    'link' => route('admin.posts.add'),
                                    'route' => 'admin.posts.add',
                                    'target' => '_blank',
                                    'info' => '',
                                    'description' => '',
                                    'show' => true,
                                    'active' => ($route === 'admin.posts.add') ? true : false
                                ]
                            ]
                        ];

        $this->menus['estilo-vida'] = [
            'title' => 'Estilos de vida',
            'icon' => 'fa fa-heart',
            'link' => route('estilo.vida.admin'),
            'route' => 'estilo.vida.admin',
            'description' => 'Estilos de vida',
            'show' => true,
            'info' => false,
            'info_icon' => 'heart',
            'active' => (in_array($route, ['estilo.vida.admin']))  ? true : false,
        ];

        $this->menus['depoimentos'] = [
            'title' => 'Depoimentos',
            'icon' => 'fa fa-user',
            'link' => route('depoimentos.admin'),
            'route' => 'depoimentos.admin',
            'description' => 'Depoimentos',
            'show' => true,
            'info' => false,
            'info_icon' => 'user',
            'active' => (in_array($route, ['depoimentos.admin']))  ? true : false,
        ];

        $this->menus['top-bairros'] = [
            'title' => 'Bairros',
            'icon' => 'fa fa-map-marker',
            'link' => route('top.bairros.admin'),
            'route' => 'top.bairros.admin',
            'description' => 'Bairros',
            'show' => true,
            'info' => false,
            'info_icon' => 'map-marker',
            'active' => (in_array($route, ['top.bairros']))  ? true : false,
        ];*/


        $this->menus = '[ { "href": "/", "title": "Dashboard", "icon": "fa fa-desktop", "route": "dashboard", "disabled": true, "notice": { "text": "Novo", "class": "notice-success" } }, { "segment": "CADASTRO", "href": "", "title": "Usuários", "icon": "fa fa-user", "disabled": true, "second_item": [ { "href": "/users", "title": "Cadastro", "icon": "fa fa-dashboard" }, { "href": "/users", "title": "Listar", "icon": "fa fa-list" }, { "title": "Permissões", "icon": "fa fa-blocked", "third_item": [ { "href": "/users", "title": "Editar", "icon": "fa fa-list" } ] }, { "title": "Configurações", "icon": "fa fa-list", "third_item": [ { "href": "/users", "title": "Conta", "icon": "fa fa-list" }, { "href": "/users", "title": "modules 1", "icon": "fa fa-list" }, { "title": "modules 2", "icon": "fa fa-list", "fourth_item": [ { "title": "Funcinalidades", "href": "/users", "icon": "fa fa-list" }, { "title": "Segurança", "href": "/users", "icon": "fa fa-list" } ] }, { "title": "modules 3", "icon": "fa fa-list", "fourth_item": [ { "title": "Funcinalidades do modulo 2", "href": "/users", "icon": "fa fa-list" }, { "title": "Segurança", "href": "/users", "icon": "fa fa-list" } ] } ] } ] } ]';

        return $this->menus;
    }

    private function getRoute()
    {
        if (Route::getCurrentRoute()->getName()) {
            return Route::getCurrentRoute()->getName();
        } elseif (Route::current()->uri) {
            return Route::current()->uri;
        }
    }
}

