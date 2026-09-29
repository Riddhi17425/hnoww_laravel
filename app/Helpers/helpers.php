<?php

// use Route;

// APP FUNCTIONS
function appName() {
	return env('APP_NAME');
}

// ROUTE FUNCTIONS
function routePut($name, $args = []) {
	return $name && \Route::has($name) ? route($name, $args) : '#';
}
function routeCurrentName() {
	return \Route::getCurrentRoute()->getName();
}
function routeIsActive($name, $activeClass = "active") {
	return routeCurrentName() == $name ? $activeClass : '';
}


// BACKEND FUNCTIONS
function backendAssets($path) {
	return asset('backend/' . $path);
}
function backendView($key) {
	return 'backend.' . $key;
}
function backendRoute($key) {
	return 'backend.' . $key;
}
function backendRoutePut($key, $args = []) {
	return routePut(backendRoute($key), $args);
}

function addBusinessDays($date, $days) {
    if (!$date instanceof DateTimeInterface) {
        return $date;
    }

    $result = \Carbon\Carbon::instance($date)->copy();
    $offset = (int) $days;

    while ($offset > 0) {
        $result->addDay();
        if (!in_array($result->dayOfWeek, [0, 6], true)) {
            $offset--;
        }
    }

    while ($offset < 0) {
        $result->subDay();
        if (!in_array($result->dayOfWeek, [0, 6], true)) {
            $offset++;
        }
    }

    return $result;
}
