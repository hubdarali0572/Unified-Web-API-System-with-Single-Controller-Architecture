$(document).ready(function() {
    // Predefined role permissions mapping
    const predefinedRoles = {
        'hr_role': [
            'view staff', 'create staff', 'edit staff', 'show staff', 'delete staff',
            'view staff leave', 'create staff leave', 'edit staff leave', 'show staff leave', 'delete staff leave',
            'view staff attendance', 'create staff attendance', 'edit staff attendance', 'show staff attendance', 'delete staff attendance',
            'view leaves', 'create leave', 'edit leave', 'show leave', 'delete leave', 'leave decision',
            'view payrollBatch', 'create payrollBatch', 'edit payrollBatch', 'show payrollBatch', 'delete payrollBatch', 'payrollBatch decision',
            'view roleManagement', 'create roleManagement', 'edit roleManagement', 'show roleManagement', 'delete roleManagement',
            'view leaveType', 'create leaveType', 'edit leaveType', 'show leaveType', 'delete leaveType',
            'view leaveQuota', 'create leaveQuota', 'edit leaveQuota', 'show leaveQuota', 'delete leaveQuota'
        ],
        'teacher_role': [
            'view classes', 'create class', 'edit class', 'show class', 'delete class',
            'view sections', 'create sections', 'edit sections', 'show sections', 'delete sections',
            'view subjects', 'create subject', 'edit subjects', 'show subject', 'delete subject',
            'view students', 'create student', 'edit student', 'show student', 'delete student',
            'view student leave', 'create student leave', 'edit student leave', 'show student leave', 'delete student leave',
            'view student attendance', 'create student attendance', 'show student attendance', 'edit student attendance', 'delete student attendance',
            'view timetables', 'create timetable', 'edit timetable', 'show timetable', 'delete timetable',
            'view leaves', 'create leave', 'edit leave', 'show leave', 'delete leave',
            'view attendance', 'create attendance', 'edit attendance', 'show attendance', 'delete attendance',
        ],
        'student_role': [
            'view leaves', 'create leave', 'edit leave', 'show leave', 'delete leave',
            'view attendance', 'create attendance', 'edit attendance', 'show attendance', 'delete attendance',
            'view students', 'show student',
            'view student leave', 'show student leave',
            'view student attendance', 'show student attendance',
            'view timetables', 'show timetable'
        ],
        'staff_role': [
            'view leaves', 'create leave', 'edit leave', 'show leave', 'delete leave',
            'view attendance', 'create attendance', 'edit attendance', 'show attendance', 'delete attendance',
            'view staff',
        ]
    };

    // Handle predefined role checkbox changes
    $('.predefined-role-checkbox').on('change', function() {
        const roleType = $(this).val();
        const isChecked = $(this).is(':checked');
        
        if (isChecked) {
            // Select permissions for this predefined role
            selectPermissionsForRole(roleType);
            showNotification(`Selected ${roleType.replace('_', ' ')} permissions`, 'success');
        } else {
            // Unselect permissions for this predefined role
            unselectPermissionsForRole(roleType);
            showNotification(`Unselected ${roleType.replace('_', ' ')} permissions`, 'info');
        }
    });

    // Function to select permissions for a predefined role
    function selectPermissionsForRole(roleType) {
        const permissions = predefinedRoles[roleType] || [];
        
        permissions.forEach(permissionName => {
            // Find checkbox by permission name
            $(`input[name="permissions[]"]`).each(function() {
                const label = $(this).next('label').text().trim();
                if (label === permissionName) {
                    $(this).prop('checked', true);
                }
            });
        });
    }

    // Function to unselect permissions for a predefined role
    function unselectPermissionsForRole(roleType) {
        const permissions = predefinedRoles[roleType] || [];
        
        permissions.forEach(permissionName => {
            // Find checkbox by permission name
            $(`input[name="permissions[]"]`).each(function() {
                const label = $(this).next('label').text().trim();
                if (label === permissionName) {
                    $(this).prop('checked', false);
                }
            });
        });
    }

    // Handle individual permission checkbox changes
    $('input[name="permissions[]"]').on('change', function() {
        updatePredefinedRoleCheckboxes();
    });

    // Function to update predefined role checkboxes based on selected permissions
    function updatePredefinedRoleCheckboxes() {
        $('.predefined-role-checkbox').each(function() {
            const roleType = $(this).val();
            const permissions = predefinedRoles[roleType] || [];
            let allPermissionsSelected = true;
            
            permissions.forEach(permissionName => {
                let permissionFound = false;
                $(`input[name="permissions[]"]`).each(function() {
                    const label = $(this).next('label').text().trim();
                    if (label === permissionName) {
                        permissionFound = true;
                        if (!$(this).is(':checked')) {
                            allPermissionsSelected = false;
                        }
                    }
                });
                if (!permissionFound) {
                    allPermissionsSelected = false;
                }
            });
            
            $(this).prop('checked', allPermissionsSelected);
        });
    }

    // Initialize predefined role checkboxes on page load
    updatePredefinedRoleCheckboxes();
    
    // Simple notification function
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = $(`
            <div class="alert alert-${type} alert-dismissible fade show" role="alert" style="position: fixed; top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                ${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `);
        
        // Add to body
        $('body').append(notification);
        
        // Auto remove after 3 seconds
        setTimeout(() => {
            notification.fadeOut(() => {
                notification.remove();
            });
        }, 3000);
    }
}); 