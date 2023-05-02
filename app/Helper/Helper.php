<?php


// GENERATE BUSINESS REFERENCE ID
if (!function_exists('generate_business_reference_id')) {
    /**
     * Description: The following method is used to generate the unique business reference ID string
     * @author Umar A
     * @param model
     * @param prefix
     * @return string
     */
    function generateBusinessReferenceId($model, $prefix = "")
    {
        $uniqueBusinessReferenceIdFound = false;
        $generateBusinessReferenceId = null;
        while (!$uniqueBusinessReferenceIdFound) {
            $generateBusinessReferenceId = strtoupper($prefix) . '_' . substr(strtoupper(dechex(abs(rand() * ((int) microtime(true))))), 0, 6);
            $businessReferenceIdCount = $model->where('business_ref_id', $generateBusinessReferenceId)->count();

            if ($businessReferenceIdCount == 0) {
                $uniqueBusinessReferenceIdFound = true;
            }
        }

        return $generateBusinessReferenceId;
    }
}

// GET MODULE PERMISSION
if (!function_exists('get_module_permission')) {
    /**
     * Description: The following method is used to generate the unique business reference ID string
     * @author Umar A
     * @param string module
     * @return string
     */
    function getModulePermission($module = "", $action = "")
    {
        // dd($module, $action);
        $permission = "";
        switch ($action) {
            case CAN_VIEW_ACTION:
                $permission = config('default-data.modules.' . $module . '.' . $action);
                break;
            case CAN_ADD_ACTION:
                $permission = config('default-data.modules.' . $module . '.' . $action);
                break;
            case CAN_UPDATE_ACTION:
                $permission = config('default-data.modules.' . $module . '.' . $action);
                break;
            case CAN_DELETE_ACTION:
                $permission = config('default-data.modules.' . $module . '.' . $action);
                break;

            default:
                # code...
                break;
        }
        return $permission;
    }
}
