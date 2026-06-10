<?php

namespace App\Services;

use App\Models\Settings;

class RechnerService {
    public function getRechnerValue() {
        return Settings::findOrFail(2)->wert;
    }
}
