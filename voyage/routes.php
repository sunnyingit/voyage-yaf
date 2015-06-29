<?php
Core_Router::group(array('prefix' => 'v1'), function() {
    Core_Router::group(array('prefix' => 'v2'), function() {
        Core_Router::get(':id', 'Main@echo');
        Core_Router::group(array('prefix' => 'v3'), function()  {
            Core_Router::get(':id', 'Main@echo');
        });
    });
});
