<?php
    /**
     * 路由转换对应CSS
     *
     * @return void
     */
    function route_class()
    {
        return str_replace('.', '-', Route::currentRouteName());
    }