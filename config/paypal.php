<?php
return array(
    // set your paypal credential
    'client_id' => 'ATONW2-PFiC8-qmhfT420UOQazQYBF_V7GdlKfan35l1Nn6PmY2x6bulD5M99E7pHrD0588pkcqomlKM',
    'secret' => 'ELq-3EdpopMK_iYOFx6uxMsc3UTgQYrg6lIJZfOXJFgEdDvcF6Wo1cfKZtCk_ogNiugw1afxC5Va8Gwn',
    /**
     * SDK configuration 
     */
    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode' => 'sandbox',
        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,
        /**
         * Whether want to log to a file
         */
        'log.LogEnabled' => true,
        /**
         * Specify the file that want to write on
         */
        'log.FileName' => storage_path() . '/logs/paypal.log',
        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel' => 'FINE'
    ),
);