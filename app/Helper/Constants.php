<?php

/**
 * Description - CONSTANTS for overall app
 * @author Umar A
 */

define('SUPER_ADMIN', 1);
define('ADMIN', 2);

define('PAGINATE', 10);

// ROLE PERMISSIONS
define('CAN_VIEW_ACTION', 1);
define('CAN_ADD_ACTION', 2);
define('CAN_UPDATE_ACTION', 3);
define('CAN_DELETE_ACTION', 4);

//STATUSES
define('ACTIVE', 1);
define('INACTIVE', 2);
define('DELETE', 3);
define('PENDING', 4);
define('REJECT', 5);

// FOLDERS
define('PLATFORMS_PATH', 'uploads/platforms/');
define('SUBSCRIPTION_PATH', 'uploads/subscription/');
define('CATEGORY_PATH', 'uploads/category/');
define('DEAL_PATH', 'uploads/deal/');
define('USER_PATH', 'uploads/user/');

// BOOL
define('BOOL_NO', 0);
define('BOOL_YES', 1);

// PLATFORM TYPE
define('PLATFORM_TYPE', 2);

// PAID BY
define('PB_CUSTOMER', 1);
define('PB_SELLER', 2);
define('PB_SPLIT', 3);
