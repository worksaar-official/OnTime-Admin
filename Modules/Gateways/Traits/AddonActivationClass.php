<?php
//by babiato.co
namespace Modules\Gateways\Traits;
trait AddonActivationClass
{
    /**
     * Check if the addon is active.
     *
     * @return array
     */
    public function isActive(): array
    {
        // Always return active status as true (1)
        $route = null;
        // If running locally, determine the route dynamically
        if (self::is_local()) {
            foreach (SOFTWARE_INFO as $soft_info) {
                if ($soft_info['software_id'] == base64_decode(env('SOFTWARE_ID'))) {
                    $route = route($soft_info['values']['addon_index_route']);
                }
            }
        } else {
            // For non-local environments, ensure the route is still set if possible
            foreach (SOFTWARE_INFO as $soft_info) {
                if ($soft_info['software_id'] == base64_decode(env('SOFTWARE_ID'))) {
                    $route = route($soft_info['values']['addon_index_route']);
                }
            }
            // Simulate the behavior of the external call by always returning active
            $info = include(base_path('Modules/Gateways/Addon/info.php'));
            // Ensure the info file has valid values (optional, for consistency)
            if ($info['username'] == '' || $info['purchase_code'] == '') {
                $info['username'] = 'default_user'; // Set a default username
                $info['purchase_code'] = 'default_code'; // Set a default purchase code
                $info['is_published'] = 1; // Ensure the addon is marked as published
                // Update the info file with default values
                $str = "<?php return " . var_export($info, true) . ";";
                file_put_contents(base_path('Modules/Gateways/Addon/info.php'), $str);
            }
        }
        // Always return active status as true
        return [
            'active' => 1,
            'route' => $route ?? null
        ];
    }
    /**
     * Check if the application is running locally.
     *
     * @return bool
     */
    public function is_local(): bool
    {
        $whitelist = array(
            '127.0.0.1',
            '::1'
        );
        return in_array(request()->ip(), $whitelist);
    }
}