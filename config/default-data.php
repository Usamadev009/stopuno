<?php

/**
 * This is default static values in application
 * @author Umar A
 */

return [

    /**
     * Privileges/ACTIONS in App
     */
    'privileges' => [
        CAN_VIEW_ACTION => "View",
        CAN_ADD_ACTION => "Add",
        CAN_UPDATE_ACTION => "Update",
        CAN_DELETE_ACTION => "Delete",
    ],

    /**
     * Pre Define Business Ref Prefixes
     */
    'ref_prefix' => [
        "user" => 'USR',
        "platform" => 'PL',
        "category" => 'CAT',
        "role" => 'RL',
        "permission" => 'PER',
        "sellerService" => 'SS',
        "coupon" => 'CPN',
        "deal" => 'DL',
        "driver" => 'DRP',
        "subscription" => 'SUB',
    ],

    /**
     * Modules Permissions
     */
    'modules' => [
        'platform' => [
            CAN_VIEW_ACTION               => 'view-platform',
            CAN_ADD_ACTION                => 'add-platform',
            CAN_UPDATE_ACTION             => 'update-platform',
            CAN_DELETE_ACTION             => 'delete-platform',
        ],
        'category' => [
            CAN_VIEW_ACTION               => 'view-category',
            CAN_ADD_ACTION                => 'add-category',
            CAN_UPDATE_ACTION             => 'update-category',
            CAN_DELETE_ACTION             => 'delete-category',
        ],
        'role' => [
            CAN_VIEW_ACTION               => 'view-role',
            CAN_ADD_ACTION                => 'add-role',
            CAN_UPDATE_ACTION             => 'update-role',
            CAN_DELETE_ACTION             => 'delete-role',
        ],
        'seller_service' => [
            CAN_VIEW_ACTION               => 'view-seller_service',
            // CAN_ADD_ACTION                => 'add-seller-service',
            // CAN_UPDATE_ACTION             => 'update-seller-service',
            CAN_DELETE_ACTION             => 'delete-seller_service',
        ],
        'delivery' => [
            CAN_VIEW_ACTION               => 'view-delivery',
            CAN_ADD_ACTION                => 'add-delivery',
            CAN_UPDATE_ACTION             => 'update-delivery',
            CAN_DELETE_ACTION             => 'delete-delivery',
        ],
        'driver' => [
            CAN_VIEW_ACTION               => 'view-driver',
            CAN_ADD_ACTION                => 'add-driver',
            CAN_UPDATE_ACTION             => 'update-driver',
            CAN_DELETE_ACTION             => 'delete-driver',
        ],
        'coupon' => [
            CAN_VIEW_ACTION               => 'view-coupon',
            CAN_ADD_ACTION                => 'add-coupon',
            CAN_UPDATE_ACTION             => 'update-coupon',
            CAN_DELETE_ACTION             => 'delete-coupon',
        ],
        'deal' => [
            CAN_VIEW_ACTION               => 'view-deal',
            CAN_ADD_ACTION                => 'add-deal',
            CAN_UPDATE_ACTION             => 'update-deal',
            CAN_DELETE_ACTION             => 'delete-deal',
        ],
        'subscription' => [
            CAN_VIEW_ACTION               => 'view-subscription',
            CAN_ADD_ACTION                => 'add-subscription',
            CAN_UPDATE_ACTION             => 'update-subscription',
            CAN_DELETE_ACTION             => 'delete-subscription',
        ],
        'order' => [
            CAN_VIEW_ACTION               => 'view-order',
        ],
        'user' => [
            CAN_VIEW_ACTION               => 'view-user',
            CAN_ADD_ACTION                => 'add-user',
            CAN_UPDATE_ACTION             => 'update-user',
            CAN_DELETE_ACTION             => 'delete-user',
        ],
    ],

    /**
     * Question Type
     */
    "question_types" => [
        "text" => "Small Input",
        "email" => "Email",
        "file"  => "File",
        "textbox" => "Description",
        "multiple" => "Checklist",
        "radio" => "Choose",
    ],

    /**
     * Branch Services
     */
    "branch_platforms" => [
        "Pick Up",
        "Dine-in",
        "Delivery",
    ],

    /**
     * Charge Type
     */
    "charge_type" => [
        "flat",
        "percentage",
        "free",
    ],

    /**
     * Advance Charge Type
     */
    "advance_charge_type" => [
        "flat",
        "percentage",
        "free",
        "free_delivery",
        "free_shipment",
        "coupon",
        "order_limit",
    ],

    /**
     * Coupun Type
     */
    "coupon_type" => [
        "bogo" => "BOGO",
        "simple" => "Simple",
        // "order_limit" => "Order Limit",
        "cash_back" => "Cash Back",
        "share" => "share",
        "mystery" => "Mystery",
        "auto" => "Automatic",
    ],

    /**
     * Days
     */
    "days" => [
        "monday",
        "tuesday",
        "wednesday",
        "thursday",
        "friday",
        "saturday",
        "sunday"
    ],

    /**
     * Statuses
     */
    "statuses" => [
        ACTIVE => "Active",
        INACTIVE => "Inactive",
        // DELETE => "Delete",
        PENDING => "Pending",
    ],

    /**
     * Interval
     */
    "interval" => [
        'day' => "Daily",
        'week' => "Weekly",
        'month' => "Monthly",
        'year' => "Yearly",

    ],

    /**
     * Statuses
     */
    "default_status" => [
        ACTIVE => "active",
        INACTIVE => "inactive",
        PENDING => "pending",
        DELETE => "delete",
        REJECT => "reject",

    ],

    "pay_by" => [
        PB_CUSTOMER => "Customer",
        PB_SELLER => "Seller",
        PB_SPLIT => "Customer 50% and Seller 50%",
    ]

];
